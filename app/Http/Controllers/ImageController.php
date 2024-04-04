<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ZipArchive;
class ImageController extends Controller
{
    public function downloadFile($filename)
    {
        {
            $photosDir = public_path('uploads');
            $photoPath = $photosDir . '/' . $filename;
            if (file_exists($photoPath)) {
                $zip = new ZipArchive;
                $zipFileName = $filename . '.zip';
                $zipFilePath = storage_path('app/' . $zipFileName);

                if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                    $zip->addFile($photoPath, $filename);

                    $zip->close();

                    return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
                } else {
                    return back()->with('error', 'Не удалось создать ZIP архив.');
                }
            } else {
                return back()->with('error', 'Выбранная фотография не найдена.');
            }

        }
    }

    public function sortImagesByDate()
    {
        $images = Image::orderBy('uploaded_at', 'desc')->get();
        return view('images', ['images' => $images]);
    }

    public function sortByFileName()
    {
        $images = Image::orderBy('fileName')->get();
        return view('images', ['images' => $images]);
    }

    public function sortImagesByName(Request $request)
    {
        $searchTerm = $request->input('name');
        $images = Image::where('fileName', 'like', '%'.$searchTerm.'%')->get();
        return view('images', ['images' => $images]);
    }


    public function index()
    {
        $images = Image::all();
        return view('images', ['images' => $images]);
    }

    public function showForm()
    {
        return view('upload_form', ["error" => ""]);
    }

    public function upload(Request $request)
    {
        $files = $request->file('images');
        if (!$request->hasFile('images')){
            return view("upload_form", ["error" => "Необходимо загрузить хотя бы один файл"]);
        }
        $count = count($files);
        if ($count > 5 ){
            return view("upload_form", ["error" => "Кол-во изображений не должно превышать пяти"]);
        }

        foreach ($files as $file) {
            $originalName = $file->getClientOriginalName();
            $fileName = Str::lower(Str::slug(pathinfo($originalName, PATHINFO_FILENAME))) . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if ($file->getSize() > 2097152){
                return view("upload_form", ["error" => "Размер файла слишком велик"]);
            }
            $file->move(public_path('uploads'), $fileName);

            Image::create([
                'fileName' => $fileName,
                'uploaded_at' => now(),
            ]);
        }

        return redirect(route("images"));
    }
}

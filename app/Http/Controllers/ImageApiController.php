<?php

namespace App\Http\Controllers;

use App\Models\Image;

class ImageApiController extends Controller
{
    public function index()
    {
        $files = Image::all();
        return response()->json($files);
    }

    public function findById($id)
    {
        $file = Image::find($id);

        if (!$file) {
            return response()->json(['message' => 'Изображение не найдено'], 404);
        }

        return response()->json($file);
    }
}

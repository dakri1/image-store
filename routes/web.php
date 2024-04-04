<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [\App\Http\Controllers\ImageController::class, "index"])->name("images");

Route::get('/upload', [\App\Http\Controllers\ImageController::class, "showForm"])->name("form");
Route::post('/upload', [\App\Http\Controllers\ImageController::class, "upload"])->name('upload');
Route::get('/images/search', [\App\Http\Controllers\ImageController::class, "sortImagesByName"])->name("searchByName");
Route::get('/images/sort', [\App\Http\Controllers\ImageController::class, "sortImagesByDate"])->name("sortByDate");
Route::get('/images/download/{filename}', [\App\Http\Controllers\ImageController::class, "downloadFile"])->name("download");
Route::get('/images/sort_by_name', [\App\Http\Controllers\ImageController::class, "sortByFileName"])->name("sortByFileName");

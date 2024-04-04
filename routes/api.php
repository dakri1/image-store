<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/images', [\App\Http\Controllers\ImageApiController::class, "index"]); // Вывести информацию о всех загруженных файлах
Route::get('/images/{id}', [\App\Http\Controllers\ImageApiController::class, "findById"]); // Получить данные о загруженном файле по ID


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//general
Route::any('/media/upload-file', [FileController::class, 'uploadFile'])->name('api.upload.file');
Route::any('/media/delete-file', [FileController::class, 'deleteFile'])->name('api.delete.file');
Route::any('/media/delete-file-by-uuid', [FileController::class, 'deleteFileByUUID'])->name('api.delete.file.by.uuid');

<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\TaskMiddleware;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Support\Facades\Route;

Route::middleware([TaskMiddleware::class])
    ->controller(TaskController::class)
    ->group(function () {
        Route::get('/', 'index'); // Nama rute jadi: task.index
        Route::get('/create-task/view', 'createView'); // Nama rute jadi: task.createView
        Route::post('/create-task', 'create'); // Nama rute jadi: task.create
    });

// Route::post('/upload', [UploadController::class, 'upload']);
// Route::get('/file', function () {
//     return 'OK: ' . 'storage/pictures/irvan.png';
// });
// Route::get('/download', function () {
//     return response()->download(storage_path());
// });

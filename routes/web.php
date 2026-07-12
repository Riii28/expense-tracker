<?php

use App\Http\Controllers\Web\AppController;
use Illuminate\Support\Facades\Route;

Route::controller(AppController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/create', 'create')->name('transactions.create');
});

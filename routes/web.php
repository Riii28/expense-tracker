<?php

use App\Http\Controllers\Web\TransactionController;
use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [AppController::class, 'index'])->name('home');
    
    Route::get('/transactions/edit/{id}', [AppController::class, 'edit'])
        ->name('transactions.edit');

    Route::get('/transactions/create', [AppController::class, 'create'])
        ->name('transactions.create');

    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])
        ->name('transactions.destroy');

    Route::patch('/transactions/{id}', [TransactionController::class, 'update'])
        ->name('transactions.update');
});

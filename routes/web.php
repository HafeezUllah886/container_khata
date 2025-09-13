<?php

use App\Http\Controllers\dashboardController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

    Route::post('/add-amount', [dashboardController::class, 'addAmount'])->name('add-amount');
    Route::post('/receive-uae', [dashboardController::class, 'receiveUae'])->name('receive-uae');

    Route::get('/delete-transaction/{id}/{from}/{to}', [dashboardController::class, 'delete'])->name('delete-transaction')->middleware(confirmPassword::class);

    Route::put('/edit-amount/{id}', [dashboardController::class, 'editAmount'])->name('edit-amount');
    Route::put('/edit-receive-uae/{id}', [dashboardController::class, 'editReceiveUae'])->name('edit-receive-uae');

    Route::get('/print/{from}/{to}', [dashboardController::class, 'print'])->name('print');

});



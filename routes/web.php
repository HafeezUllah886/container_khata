<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/finance.php';
require __DIR__ . '/purchase.php';
require __DIR__ . '/export.php';
require __DIR__ . '/stock.php';
require __DIR__ . '/reports.php';
require __DIR__ . '/setups.php';


Route::middleware('auth')->group(function () {

    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');


});



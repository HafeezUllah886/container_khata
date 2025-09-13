<?php


use App\Http\Controllers\StockController;
use App\Http\Middleware\adminCheck;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', adminCheck::class)->group(function () {

   Route::get('stock/{filter}', [StockController::class, 'index'])->name('stock.index');

});


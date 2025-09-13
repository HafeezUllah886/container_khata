<?php

use App\Http\Middleware\adminCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::middleware('auth', adminCheck::class)->group(function () {

   Route::resource('export', ExportController::class);

   Route::get('export/getproduct/{id}', [ExportController::class, 'getProduct'])->name('export.getproduct');
});

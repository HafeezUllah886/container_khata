<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchasePaymentsController;
use App\Http\Middleware\adminCheck;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;
use App\Exports\PurchasesExport;
use App\Imports\PurchasesImport;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware('auth', adminCheck::class)->group(function () {

    Route::resource('purchase', PurchaseController::class)->middleware(adminCheck::class);

    Route::get("purchases/delete/{id}", [PurchaseController::class, 'destroy'])->name('purchases.delete')->middleware(confirmPassword::class);

   
    Route::get('/download/sample', function () {
    
        $filePath = public_path('/assets/purchase_sample.xlsx');
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    
        return abort(404, 'File not found.');
    })->name('download.sample');

    Route::get('purchases/export', function () {
        $start = request()->query('start');
        $end = request()->query('end');
        return Excel::download(new PurchasesExport($start, $end), 'purchases.xlsx');
    })->name('purchases.export');
    
    Route::post('purchases/import', [PurchaseController::class, 'import'])->name('purchases.import');
});

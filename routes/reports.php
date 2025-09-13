<?php

use App\Http\Controllers\purchaseReportController;
use App\Http\Controllers\reports\ledgerReportController;
use App\Http\Middleware\adminCheck;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', adminCheck::class)->group(function () {

    Route::get('/reports/ledger', [ledgerReportController::class, 'index'])->name('reportLedger');
    Route::get('/reports/ledgerData', [ledgerReportController::class, 'reportData'])->name('reportLedgerData');

    Route::get('report/purchase', [purchaseReportController::class, 'index'])->name('reportPurchase');
    Route::get('report/purchaseData', [purchaseReportController::class, 'data'])->name('reportPurchaseData');
});

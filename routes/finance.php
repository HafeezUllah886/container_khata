<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\authController;
use App\Http\Controllers\CurrencymgmtController;
use App\Http\Controllers\DepositWithdrawController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IssuePaymentsController;
use App\Http\Controllers\PaymentCategoriesController;
use App\Http\Controllers\PaymentReceivingController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\ReceivePaymentsController;
use App\Http\Controllers\TransferController;
use App\Http\Middleware\adminCheck;
use App\Http\Middleware\confirmPassword;
use App\Models\attachment;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', adminCheck::class)->group(function () {
    Route::get('account/view/{filter}', [AccountsController::class, 'index'])->name('accountsList');
    Route::get('account/statement/{id}/{from}/{to}', [AccountsController::class, 'show'])->name('accountStatement');
    Route::get('account/status/{id}', [AccountsController::class, 'status'])->name('account.status');
    Route::resource('account', AccountsController::class);

    Route::resource('payment_categories', PaymentCategoriesController::class);
    Route::resource('receive_payments', ReceivePaymentsController::class);
    Route::post('receive_payments/import', [ReceivePaymentsController::class, 'import'])->name('receive_payments.import');
    Route::get('receive_payments/delete/{ref}', [ReceivePaymentsController::class, 'delete'])->name('receive_payments.delete')
    ->middleware(confirmPassword::class);
    
    Route::resource('issue_payments', IssuePaymentsController::class);
    Route::get('issue_payments/delete/{ref}', [IssuePaymentsController::class, 'delete'])->name('issue_payments.delete')
    ->middleware(confirmPassword::class);
    Route::post('issue_payments/import', [IssuePaymentsController::class, 'import'])->name('issue_payments.import');


    Route::get('/accountbalance/{id}', function ($id) {
        $result = getAccountBalance($id);

        return response()->json(['data' => $result]);
    });

    
});


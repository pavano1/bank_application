<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\admin\SavingsAccountController;
use App\Http\Controllers\transaction\TransactionController;

Route::get('register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistrationController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('no-cache');;
Route::post('/login', [LoginController::class, 'login']);

Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'check_role'])->group(function () {

    // Admin Routes (Only accessible if user is an admin)
    Route::get('admin/two-factor', [TwoFactorAuthenticationController::class, 'show'])
        ->name('admin.two-factor');

    Route::post('admin/two-factor', [TwoFactorAuthenticationController::class, 'store'])
        ->name('admin.two-factor.store');


    Route::post('user/send-two-factor-code', [TwoFactorAuthenticationController::class, 'sendTwoFactorCode'])
        ->name('user.send-two-factor-code');
    Route::post('admin/send-two-factor-code', [TwoFactorAuthenticationController::class, 'sendTwoFactorCode'])
        ->name('admin.send-two-factor-code');
    Route::get('admin/create-savings-accounts', [SavingsAccountController::class, 'create'])->name('admin.create_savings_accounts');
    Route::post('admin/save-savings-accounts', [SavingsAccountController::class, 'store'])->name('admin.save_savings_accounts');

    Route::get('/admin/accounts', [SavingsAccountController::class, 'showAccounts'])->name('admin.accounts');
    Route::get('/transaction/transfer', [TransactionController::class, 'create'])->name('transaction.transfer_form');
    Route::post('/transaction/transfer', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/transfer_history', [TransactionController::class, 'show'])->name('transaction.transfer_history');
    // User Routes (Accessible for non-admin users)


    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['auth'])->group(function () {

    Route::get('user/two-factor', [TwoFactorAuthenticationController::class, 'show'])
        ->name('user.two-factor');

    Route::post('user/two-factor', [TwoFactorAuthenticationController::class, 'store'])
        ->name('user.two-factor.store');
    // User dashboard route
    Route::get('user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/user/account', [SavingsAccountController::class, 'showAccounts'])->name('user.account');
    Route::get('/transaction/transfer', [TransactionController::class, 'create'])->name('transaction.transfer_form');
    Route::post('/transaction/transfer', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/transfer_history', [TransactionController::class, 'show'])->name('transaction.transfer_history');
});

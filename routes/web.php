<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;

Route::get('/', function () {
    return view('sites.index');
});

Route::prefix('panel')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login.view'); 
    })->name('panel.home');
});

Route::prefix('panel')->middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register.view');
    Route::view('/login', 'auth.login')->name('login.view');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('panel')->group(function () {
    Route::view('/', 'panel.dashboard.index')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/kroki', 'panel.steps.index')->name('steps');
    Route::view('/kupony', 'panel.coupons.index')->name('coupons');
    Route::view('/transakcje', 'panel.transactions.index')->name('transactions');

});

Route::middleware('auth')->group(function () {
    Route::post('/steps', [StepController::class, 'store'])->name('steps.store');
    Route::get('/steps', [StepController::class, 'index'])->name('steps.index');
    Route::get('/steps/summary', [StepController::class, 'getStepNumbersAndBudgets']);

    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/data', [CouponController::class, 'index'])->name('coupons.data');
    Route::delete('/coupons/{id}', [CouponController::class, 'destroy'])->name('coupons.destroy');
 
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');


    Route::get('/budget', [BudgetController::class, 'getBudget'])->name('budget.get');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\CouponController;

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
});

Route::middleware('auth')->group(function () {
    Route::post('/steps', [StepController::class, 'store'])->name('steps.store');
    Route::get('/steps', [StepController::class, 'index'])->name('steps.index');
    Route::get('/steps/summary', [StepController::class, 'getStepNumbersAndBudgets']);

    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/data', [CouponController::class, 'index'])->name('coupons.data');
 
});
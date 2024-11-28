<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::view('/', 'panel.dashboard.index')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
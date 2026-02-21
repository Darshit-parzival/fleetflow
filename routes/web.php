<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');


Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return "Dashboard (Protected)";
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('password.sendOtp');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('password.verify');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.verify.post');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

Route::get('/', function () {
    return redirect()->route('login');
});

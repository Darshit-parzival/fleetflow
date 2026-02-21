<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\TripExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route::get('/dashboard-ui', function () {
//     return view('dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('vehicles', VehicleController::class);
    Route::resource('trips', TripController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('maintenance', MaintenanceController::class);
    Route::resource('expenses', TripExpenseController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('password.sendOtp');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('password.verify');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.verify.post');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

Route::get('/', function () {
    return redirect()->route('login');
});

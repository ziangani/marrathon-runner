<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ConfirmationController;

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('home');

// Registration routes
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

// Payment routes
Route::get('/payment/{reference}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{reference}/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

// Confirmation routes
Route::get('/confirmation/{reference}', [ConfirmationController::class, 'show'])->name('confirmation.show');
Route::get('/confirmation/{reference}/download', [ConfirmationController::class, 'download'])->name('confirmation.download');
Route::get('/share/{reference}', [ConfirmationController::class, 'share'])->name('confirmation.share');

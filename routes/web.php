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
Route::get('/payment_callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/payment/{reference}/pending', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/payment/{reference}/check-status', [PaymentController::class, 'checkStatus'])->name('payment.check-status');

// Confirmation routes
Route::get('/confirmation/{reference}', [ConfirmationController::class, 'show'])->name('confirmation.show');
Route::get('/confirmation/{reference}/download', [ConfirmationController::class, 'download'])->name('confirmation.download');
Route::get('/share/{reference}', [ConfirmationController::class, 'share'])->name('confirmation.share');

<?php


use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/register', Auth\RegisterController::class)
    ->middleware('guest')
    ->name('register');

Route::post('/login', Auth\LoginController::class)
    ->middleware('guest')
    ->name('login');

Route::post('/forgot-password', Auth\ForgotPasswordController::class)
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', Auth\ResetPasswordController::class)
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', Auth\VerificationController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', Auth\VerificationNotificationController::class)
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', Auth\LogoutController::class)
    ->middleware('auth')
    ->name('logout');

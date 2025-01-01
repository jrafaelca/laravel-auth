<?php

use App\Http\Controllers\V1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('/user', v1\Auth\UserController::class)
            ->middleware(['auth:sanctum'])
            ->name('user');

        Route::post('/register', v1\Auth\RegisterController::class)
            ->middleware(['guest'])
            ->name('register');

        Route::post('/login', v1\Auth\LoginController::class)
            ->middleware(['guest'])
            ->name('login');

        Route::delete('/logout', v1\Auth\LogoutController::class)
            ->middleware(['auth:sanctum'])
            ->name('logout');

        Route::post('/forgot-password', v1\Auth\ForgotPasswordController::class)
            ->middleware(['guest'])
            ->name('forgot-password');

        Route::post('/reset-password', v1\Auth\ResetPasswordController::class)
            ->middleware(['guest'])
            ->name('reset-password');

        Route::post('/email/verify/resend', v1\Auth\VerificationResendController::class)
            ->middleware(['auth:sanctum', 'throttle:6,1'])
            ->name('verification.resend');

        Route::get('/email/verify/{id}/{hash}', v1\Auth\VerificationController::class)
            ->middleware(['auth:sanctum', 'signed'])
            ->name('verification.verify');
    });
});

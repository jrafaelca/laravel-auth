<?php

use App\Http\Controllers\V1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\V1\Auth\EmailVerifyController;
use App\Http\Controllers\V1\Auth\PasswordResetLinkController;
use App\Http\Controllers\V1\Auth\AuthenticatedSession;
use App\Http\Controllers\V1\Auth\LogoutController;
use App\Http\Controllers\V1\Auth\RegisteredUserController;
use App\Http\Controllers\V1\Auth\ResetPasswordController;
use App\Http\Controllers\V1\Auth\AuthenticatedUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('/user', AuthenticatedUserController::class)
            ->name('user');

        Route::post('/register', RegisteredUserController::class)
            ->name('register');

        Route::post('/login', AuthenticatedSession::class)
            ->name('login');

        Route::post('/forgot-password', PasswordResetLinkController::class)
            ->name('forgot-password');

        Route::post('/reset-password', ResetPasswordController::class)
            ->name('reset-password');

        Route::get('/email/verify/{id}/{hash}', EmailVerifyController::class)
            ->name('verification.verify');

        Route::post('/email/verification-notification', EmailVerificationNotificationController::class)
            ->name('verification.send');

        Route::post('/logout', LogoutController::class)
            ->name('logout');
    });
});




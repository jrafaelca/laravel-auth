<?php

use App\Http\Controllers\V1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('/user', V1\UserController::class)
        ->middleware('auth')
        ->name('user');
});

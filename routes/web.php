<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->to(config('app.frontend_url')));

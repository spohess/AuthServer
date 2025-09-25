<?php

declare(strict_types=1);

use App\Support\Auth\Controllers\Code\LoginController;
use App\Support\Auth\Controllers\Code\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('code')
    ->name('code.')
    ->group(function () {
        Route::post('login', LoginController::class)->name('login');
        Route::post('token', TokenController::class)->name('token');
    });

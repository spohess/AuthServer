<?php

declare(strict_types=1);

use App\Support\Auth\Controllers\CodeRequestController;
use App\Support\Auth\Controllers\CodeValidateController;
use Illuminate\Support\Facades\Route;

Route::prefix('code')
    ->name('code.')
    ->group(function () {
        Route::post('request', CodeRequestController::class)->name('request');
        Route::post('validate', CodeValidateController::class)->name('validate');
    });

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->name('auth.')
    ->group(__DIR__ . '/api/auth.php');

Route::prefix('manager')
    ->middleware(['auth:sanctum', 'isRoot'])
    ->name('manager.')
    ->group(__DIR__ . '/api/manager.php');

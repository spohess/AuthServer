<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->middleware(['auth:sanctum', 'isroot'])
    ->name('auth.')
    ->group(__DIR__ . '/api/auth.php');

<?php

declare(strict_types=1);

use App\Support\Auth\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class)->name('login');

Route::prefix('auth')
    ->middleware(['auth:sanctum', 'isroot'])
    ->name('auth.')
    ->group(__DIR__ . '/api/auth.php');

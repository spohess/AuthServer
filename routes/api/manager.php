<?php

declare(strict_types=1);

use App\Support\Auth\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

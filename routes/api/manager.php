<?php

declare(strict_types=1);

use App\Support\Auth\Controllers\ProfileController;
use App\Support\Auth\Controllers\SystemController;
use App\Support\Auth\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('systems', SystemController::class);
Route::apiResource('profiles', ProfileController::class)->only(['index']);

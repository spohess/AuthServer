<?php

declare(strict_types=1);

use App\Support\Manager\Controllers\ProfileController;
use App\Support\Manager\Controllers\SystemController;
use App\Support\Manager\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('systems', SystemController::class);
Route::apiResource('profiles', ProfileController::class)->only(['index']);

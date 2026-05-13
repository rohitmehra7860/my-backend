<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\App\Http\Controllers\UsersController;

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('users', UsersController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\App\Http\Controllers\BlogController;

Route::middleware(['auth:sanctum', 'permission:manage blog'])->group(function () {
    Route::apiResource('posts', BlogController::class);
});

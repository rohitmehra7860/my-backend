<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\App\Http\Controllers\ShopController;

Route::middleware(['auth:sanctum', 'permission:manage shop'])->group(function () {
    Route::apiResource('products', ShopController::class);
});

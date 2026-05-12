<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\App\Http\Controllers\ShopController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('shops', ShopController::class)->names('shop');
});

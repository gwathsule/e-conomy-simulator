<?php

use Illuminate\Support\Facades\Route;

Route::prefix('governo')->group(function () {
    Route::post('index', GovernoController::class . '@index');
    Route::post('store', GovernoController::class . '@store');
});
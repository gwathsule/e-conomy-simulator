<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Governo\GovernoController;

Route::prefix('governo')->group(function () {
    /** @see GovernoController::index() */
    Route::post('index', GovernoController::class . '@index');
    /** @see GovernoController::store() */
    Route::post('store', GovernoController::class . '@store');
});
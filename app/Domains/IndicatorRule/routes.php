<?php

use App\Domains\IndicatorRule\IndicatorRuleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/rules')->group(function () {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        /** @see IndicatorRuleController::createNewsRule() */
        Route::post('create-news-rule', IndicatorRuleController::class . '@createNewsRule')->name('create-news-rule');
    });
});

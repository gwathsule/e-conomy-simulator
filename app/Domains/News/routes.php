<?php

use App\Domains\News\NewsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/news')->group(function () {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        /** @see NewsController::newsPage() */
        Route::get('', NewsController::class . '@newsPage')->name('news');
        /** @see NewsController::createNews() */
        Route::post('create-news', NewsController::class . '@createNews')->name('create-news');
        /** @see NewsController::deleteNews() */
        Route::get('delete-news/{id}', NewsController::class . '@deleteNews')->name('delete-news');
    });
});

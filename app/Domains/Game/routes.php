<?php

use App\Domains\Game\GameController;
use Illuminate\Support\Facades\Route;

Route::prefix('game')->group(function () {
    Route::middleware(['auth'])->group(function () {
        /** @see GameController::newGame() */
        Route::post('new-game', GameController::class . '@newGame')->name('new-game');
    });
});

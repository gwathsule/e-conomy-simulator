<?php

use App\Domains\Jogo\jogoController;
use Illuminate\Support\Facades\Route;

Route::prefix('jogo')->group(function () {
    Route::middleware(['auth'])->group(function () {
        /** @see jogoController::novoJogo() */
        Route::post('novo-jogo', jogoController::class . '@novoJogo')->name('novo-jogo');
        /** @see jogoController::perfilJogoPage() */
        Route::get('jogo-perfil', jogoController::class . '@perfilJogoPage')->name('jogo-perfil');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Rodada\RodadaController;

Route::prefix('rodada')->group(function () {
    Route::middleware(['auth'])->group(function () {
        /** @see RodadaController::criarNovaRodada() */
        Route::get('nova-rodada/{jogoId}/{medidaId}', RodadaController::class . '@criarNovaRodada')->name('nova-rodada');
    });
});

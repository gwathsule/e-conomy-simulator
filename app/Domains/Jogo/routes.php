<?php

use App\Domains\Jogo\jogoController;
use Illuminate\Support\Facades\Route;

Route::prefix('jogo')->group(function () {
    Route::middleware(['auth'])->group(function () {
        /** @see jogoController::novoJogo() */
        Route::post('novo-jogo', jogoController::class . '@novoJogo')->name('novo-jogo');
        /** @see jogoController::novoJogoPage() */
        Route::get('novo-jogo', jogoController::class . '@novoJogoPage')->name('novo-jogo');
        /** @see jogoController::alterarJogo() */
        Route::post('alterar-jogo', jogoController::class . '@alterarJogo')->name('alterar-jogo');
        /** @see jogoController::relatoriosMensaisPage() */
        Route::get('relatorios-mensais', jogoController::class . '@relatoriosMensaisPage')->name('relatorios-mensais');
        /** @see jogoController::relatoriosAnuaisPage() */
        Route::get('relatorios-anuais', jogoController::class . '@relatoriosAnuaisPage')->name('relatorios-anuais');
        /** @see jogoController::perfilJogoPage() */
        Route::get('jogo-perfil', jogoController::class . '@perfilJogoPage')->name('jogo-perfil');
        /** @see jogoController::alterarJogoPage() */
        Route::get('alterar-jogo', jogoController::class . '@alterarJogoPage')->name('alterar-jogo');
    });
});

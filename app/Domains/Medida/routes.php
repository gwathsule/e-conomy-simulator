<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Medida\MedidaController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        /** @see MedidaController::novaMedida() */
        Route::post('medida/nova', MedidaController::class.'@novaMedida')->name('medida.nova');
        /** @see MedidaController::novaMedidaPage() */
        Route::get('medida/nova', MedidaController::class.'@novaMedidaPage')->name('medida.nova');

        /** @see MedidaController::editarMedida() */
        Route::post('medida/editar', MedidaController::class.'@editarMedida')->name('medida.editar');
        /** @see MedidaController::editarMedidaPage() */
        Route::get('medida/editar', MedidaController::class.'@editarMedidaPage')->name('medida.editar');

        /** @see MedidaController::deletarMedida() */
        Route::get('medida/deletar/{id}', MedidaController::class.'@deletarMedida')->name('medida.deletar');
    });
});

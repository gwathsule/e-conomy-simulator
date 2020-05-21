<?php

use App\Domains\Measure\MeasureController;
use Illuminate\Support\Facades\Route;

Route::prefix('measure')->group(function () {
    Route::middleware(['auth'])->group(function () {
        /** @see MeasureController::calcularRecolhimentoCompulsorio() */
        Route::post('recolhimento-compulsorio', MeasureController::class . '@calcularRecolhimentoCompulsorio')
            ->name('recolhimento-compulsorio');
    });
});

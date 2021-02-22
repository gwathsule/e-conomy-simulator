<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domains\User\Auth\JwtAuthController;
use App\Domains\Jogo\JogoApiController;
use App\Domains\Medida\MedidaApiController;
use App\Domains\Rodada\RodadaApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->group(function ($router) {
    /** Autenticação básica */
    /** @see JwtAuthController::login() */
    Route::post('login', JwtAuthController::class . '@login');
    /** @see JwtAuthController::logout() */
    Route::post('logout', JwtAuthController::class . '@logout');
    /** @see JwtAuthController::refresh() */
    Route::post('refresh', JwtAuthController::class . '@refresh');
    /** @see JwtAuthController::me() */
    Route::get('me', JwtAuthController::class . '@me');

    /** Jogo */
    /** @see JogoApiController::novoJogo() */
    Route::post('novo-jogo', JogoApiController::class . '@novoJogo');
    /** @see JogoApiController::getJogo() */
    Route::get('get-jogo', JogoApiController::class . '@getJogo');

    /** Medida */
    /** @see MedidaApiController::getMedidas() */
    Route::get('get-medidas', MedidaApiController::class . '@getMedidas');

    /** Rodada */
    /** @see RodadaApiController::criarNovaRodada() */
    Route::post('nova-rodada', RodadaApiController::class . '@criarNovaRodada');
});
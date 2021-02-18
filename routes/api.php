<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domains\User\Auth\JwtAuthController;
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
    Route::post('login', JwtAuthController::class . '@login');
    Route::post('logout', JwtAuthController::class . '@logout');
    Route::post('refresh', JwtAuthController::class . '@refresh');
    Route::get('me', JwtAuthController::class . '@me');
});
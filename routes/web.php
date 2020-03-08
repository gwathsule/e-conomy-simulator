<?php

use App\Http\Controllers\GovernoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('governo', GovernoController::class);
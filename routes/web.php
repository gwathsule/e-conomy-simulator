<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('angular');
});

Route::resource('governo', GovernoController::class);
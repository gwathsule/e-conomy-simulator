<?php

use App\Domains\User\Auth\LoginController;
use App\Domains\User\UserAdminController;
use App\Domains\User\UserController;
use Illuminate\Support\Facades\Route;

//the user routes are default, don't need prefix
Route::prefix('')->group(function () {
    Route::middleware(['auth'])->group(function () {
        /** @see UserController::homeUserPage() */
        Route::get('home', UserController::class.'@homeUserPage')->name('user.home');
    });

});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        /** @see UserAdminController::homeAdminPage() */
        Route::get('home', UserAdminController::class.'@homeAdminPage')->name('admin.home');
    });
});

//public routes
/** @see UserController::register() */
Route::post('register', UserController::class . '@register')->name('register');
/** @see UserController::registerPage() */
Route::get('register', UserController::class . '@registerPage')->name('register');

/** @see LoginController::login() */
Route::post('login', LoginController::class . '@login')->name('login');
/** @see LoginController::showLoginForm() */
Route::get('login', LoginController::class . '@showLoginForm')->name('login');
/** @see LoginController::logout() */
Route::get('logout', LoginController::class . '@logout')->name('logout');
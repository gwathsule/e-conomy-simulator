<?php

use App\Domains\User\Auth\ForgotPasswordController;
use App\Domains\User\Auth\LoginController;
use App\Domains\User\Auth\ResetPasswordController;
use App\Domains\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {

});

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

///** @see ForgotPasswordController::sendResetLinkEmail() */
//Route::post('password/email', ForgotPasswordController::class . '@sendResetLinkEmail')->name('password.email');
///** @see ForgotPasswordController::showLinkRequestForm() */
//Route::get('password/reset', ForgotPasswordController::class . '@showLinkRequestForm')->name('password.request');
///** @see ResetPasswordController::reset() */
//Route::post('password/reset', ResetPasswordController::class . '@reset')->name('password.update');
///** @see ResetPasswordController::showResetForm() */
//Route::get('password/reset/{token}', ResetPasswordController::class . '@showResetForm')->name('password.reset');

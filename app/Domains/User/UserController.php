<?php

namespace App\Domains\User;

use App\Domains\User\Services\RegisterUser;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            /** @var RegisterUser $service */
            $service = app()->make(RegisterUser::class);
            /** @var User $newUser */
            $newUser = $service->handle($request->toArray());
            Auth::login($newUser);
            return view('home');
        }catch (ValidationException $ex){
            dd($ex);
        }
    }
    public function registerPage()
    {
        return view('auth.register');
    }
}

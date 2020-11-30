<?php

namespace App\Domains\User;

use App\Domains\User\Services\RegisterUser;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Exception;
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
            return redirect('/');
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function homeUserPage()
    {
        /** @var User $user */
        $user = Auth::user();
        if(is_null($user->getJogoAtivo())) {
            return view('game.novoJogo');
        } else {
            return view('game.home')->with([
                'jogo' => $user->getJogoAtivo()
            ]);
        }
    }
}

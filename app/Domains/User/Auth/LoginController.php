<?php

namespace App\Domains\User\Auth;

use App\Domains\User\User;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Illuminate\Validation\ValidationException as CoreValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator as CoreValidator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'getToken']);
    }

    public function getToken(Request $request)
    {
        $input = $request->all();
        try {
            $validator = CoreValidator::make(
                $request->toArray(), [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );
            $validator->validate();
            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                /** @var User $userLogged */
                $userLogged = auth()->user();
                return json_encode([
                    'logado' => true,
                    'user' => $userLogged,
                ]);
            } else {
                return json_encode([
                    'logado' => false
                ]);
            }
        } catch (CoreValidationException $ex) {
            return json_encode([

                'code' => ValidationException::CODE,
                'category' => ValidationException::CATEGORY,
                'errors' => $ex->errors()
            ]);
        } catch (\Exception $ex) {
            return json_encode([

                'code' => InternalErrorException::CODE,
                'category' => InternalErrorException::CATEGORY,
                'errors' => $ex->errors()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            /** @var User $userLogged */
            $userLogged = auth()->user();
            if ($userLogged->is_admin) {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('user.home');
            }
        }else{
            return redirect()->route('login')
                ->withErrors(['Login inválido']);
        }
    }
}

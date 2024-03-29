<?php

namespace App\Domains\User\Auth;

use App\Domains\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'getToken']);
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
        try {
            $input = $request->all();

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                /** @var User $userLogged */
                $userLogged = auth()->user();
                if ($userLogged->is_admin) {
                    return redirect()->route('admin.home');
                } else {
                    return redirect()->route('user.home');
                }
            } else {
                return back()->with([
                    'response' => [
                        'type' => self::TYPE_ERROR_RETURN,
                        'message' => 'Login inválido',
                    ],
                ]);
            }
        } catch (ValidationException $ex) {
            $message = '';

            foreach ($ex->errors() as $error) {
                $message .= $error[0] . '<br/>';
            }
            return back()->with([
                'response' => [
                    'type' => self::TYPE_ERROR_RETURN,
                    'message' => $message,
                ],
            ]);
        } catch (\Exception $exception) {
            return back()->with([
                'response' => [
                    'type' => self::TYPE_ERROR_RETURN,
                    'message' => $exception->getMessage(),
                ],
            ]);
        }
    }
}

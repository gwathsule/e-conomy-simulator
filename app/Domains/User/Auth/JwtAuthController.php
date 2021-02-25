<?php

namespace App\Domains\User\Auth;

use App\Http\Controllers\Controller;

/**
 * tutorial utilizado para fazer a autenticação:
 * video 1: https://youtu.be/40g0vEXOFrU
 * video 2: https://youtu.be/CKqRX9CBljU
 * package: https://github.com/tymondesigns/jwt-auth
 * docs: https://jwt-auth.readthedocs.io/en/develop/
 *
 * Class JwtAuthController
 * @package App\Domains\User\Auth
 */
class JwtAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if(! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'invalid email or password'], 401);
        }
        return $this->respondWithToken($token);
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'access_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['msg' => 'User successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
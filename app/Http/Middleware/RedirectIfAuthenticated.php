<?php

namespace App\Http\Middleware;

use App\Domains\User\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            /** @var User $user */
            $user = Auth::user();
            if($user->is_admin) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('user.home');
            }
        }

        return $next($request);
    }
}

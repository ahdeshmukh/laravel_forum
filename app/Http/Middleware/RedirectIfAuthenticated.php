<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
            // https://pixelcave.com/blog/how-to-redirect-back-to-original-url-after-successful-login-in-laravel
            //return redirect(RouteServiceProvider::HOME);
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}

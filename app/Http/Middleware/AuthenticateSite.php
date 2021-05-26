<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Support\Facades\Auth;


class AuthenticateSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('auth-site')->check()) {
            return $next($request);
        }
        return redirect()->route('site-login')->with('error', 'خطأ في التسجيل!');
        
    }
}

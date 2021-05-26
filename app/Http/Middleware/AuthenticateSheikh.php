<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateSheikh
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
        if(Auth::guard('auth-site-sheikh')->check()) {
            return $next($request);
        }
        return redirect()->route('site-sheikh-login')->with('error', 'خطأ في التسجيل!');
        
    }
}

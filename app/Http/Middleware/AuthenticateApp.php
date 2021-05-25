<?php

namespace App\Http\Middleware;

use Middleware\AuthenticateApp as Middleware;
class AuthenticateApp extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return false;
    }
}

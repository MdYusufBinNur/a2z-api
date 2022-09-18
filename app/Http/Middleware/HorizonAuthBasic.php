<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;

class HorizonAuthBasic extends AuthenticateWithBasicAuth
{
    public function handle($request, Closure $next, $guard = null, $field = null)
    {
        return $this->auth->guard($guard)->basic('email') ?: $next($request);
    }
}

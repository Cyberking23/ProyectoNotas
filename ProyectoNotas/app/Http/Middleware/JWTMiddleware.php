<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('jwt_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        return $next($request);
    }
}

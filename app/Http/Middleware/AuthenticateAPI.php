<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAPI
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Custom-Token') !== 'valor_esperado') {
            return response()->json(['error' => 'Token no válido.'], 401);
        }
        return $next($request);
    }
}

<?php

namespace App\Support\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthRootMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->root) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}

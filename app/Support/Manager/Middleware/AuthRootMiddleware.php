<?php

declare(strict_types=1);

namespace App\Support\Manager\Middleware;

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

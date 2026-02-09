<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // cek login dulu
        if (!auth()->check()) {
            abort(403, 'Anda belum login');
        }

        // cek role user
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Anda tidak punya akses');
        }

        return $next($request);
    }
}

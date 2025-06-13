<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isDoctor()) {
            abort(403, 'Unauthorized action. Only doctors can access this area.');
        }

        return $next($request);
    }
} 
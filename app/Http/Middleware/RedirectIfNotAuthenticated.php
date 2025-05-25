<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $path = $request->path();
        if (
            !Auth::check() &&
            $path !== '/' &&
            $path !== 'login' &&
            $path !== 'register'
        ) {
            return response()->view('home');
        }
        return $next($request);
    }
}

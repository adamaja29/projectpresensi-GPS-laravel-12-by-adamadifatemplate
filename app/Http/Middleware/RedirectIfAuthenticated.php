<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as MiddlewareRedirectIfAuthenticated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends MiddlewareRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response | JsonResponse
    {
        if (Auth::guard('mahasiswa')->check()) {
            return redirect()->route('mahasiswa.home');
        } elseif (Auth::guard('dosen')->check()) {
            return redirect()->route('home');
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}

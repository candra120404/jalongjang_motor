<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jangan arahkan ke dashboard jika route yang diminta adalah 'login.index'
                if ($request->is('logout')) {
                    return $next($request); // Biar tetap di halaman login atau logout
                }
                return redirect('/overview'); // Arahkan ke dashboard jika sudah login
            }
        }

        return $next($request);
    }
}

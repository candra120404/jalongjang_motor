<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna belum login dan bukan mencoba mengakses halaman login
        if (!Auth::check() && !$request->routeIs('login.index')) {
            return redirect()->route('login.index');
        }

        // Jika pengguna sudah login tetapi mencoba mengakses halaman login
        if (Auth::check() && $request->routeIs('login.index')) {
            // Redirect ke halaman dashboard/overview setelah login
            return redirect()->route('overview.index');
        }

        // Lanjutkan ke permintaan berikutnya jika kondisi di atas tidak terpenuhi
        return $next($request);
    }
}

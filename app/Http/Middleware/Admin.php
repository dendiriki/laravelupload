<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna terautentikasi dan apakah perannya adalah Admin
        if (!Auth::check()) {
            // Jika pengguna tidak terautentikasi, arahkan ke halaman login
            return redirect('/login');
        } elseif (Auth::check() && Auth::user()->role !== 'Admin') {
            // Jika pengguna terautentikasi tetapi bukan admin, tampilkan error 403
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}


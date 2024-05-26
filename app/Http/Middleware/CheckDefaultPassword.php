<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckDefaultPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Hash::check('ispat1234567', Auth::user()->password)) {
            return redirect()->route('user.reset-password.form');
        }

        return $next($request);
    }
}

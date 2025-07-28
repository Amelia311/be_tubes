<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Session::get('login') || Session::get('role') !== $role) {
            return redirect('/login')->withErrors(['akses' => 'Anda tidak memiliki akses ke halaman tersebut.']);
        }

        return $next($request);
    }
}

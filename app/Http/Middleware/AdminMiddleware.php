<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user adalah admin
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
    }
}

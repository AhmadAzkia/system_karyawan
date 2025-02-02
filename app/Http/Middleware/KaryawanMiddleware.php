<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna adalah karyawan
        if (Auth::guard('web')->check()) {  // menggunakan guard 'web' untuk karyawan
            // Cek apakah akses ke halaman selain home atau absensi
            if ($request->is('home') || $request->is('absen')) {
                return $next($request);  // Lanjutkan ke halaman yang diperbolehkan
            }
            // Redirect jika mencoba mengakses halaman lain
            return redirect()->route('home')->with('error', 'Hanya admin yang dapat mengakses halaman ini.');
        }

        // Jika tidak terautentikasi, arahkan ke halaman login
        return redirect()->route('login');
    }
}

<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari karyawan berdasarkan username
        $karyawan = Karyawan::where('Nama_Karyawan', $request->username)->first();

        if ($karyawan) {
            // Ambil tanggal lahir dari kolom Tempat_Tanggal_Lahir
            $tanggal_lahir = explode(',', $karyawan->Tempat_Tanggal_Lahir)[1]; // Ambil tanggal lahir setelah koma
            $tanggal_lahir = trim($tanggal_lahir); // Hapus spasi

            // Bandingkan password (tanggal lahir) dengan input user
            if ($tanggal_lahir == $request->password) {
                // Login sukses, arahkan ke halaman home
                return redirect()->route('home'); // Ganti dengan route home
            }
        }

        // Jika login gagal
        return back()->withErrors(['error' => 'Username atau Password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Menghapus sesi login
        $request->session()->invalidate(); // Menghapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token untuk keamanan

        return redirect()->route('login'); // Redirect ke halaman login
    }
}

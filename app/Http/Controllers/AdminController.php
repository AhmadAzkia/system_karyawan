<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.admin_login');  // Pastikan halaman login admin berada di 'resources/views/Auth/admin_login.blade.php'
    }

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Handle an authentication attempt for the admin.
     *
     * @param  \Illuminate\Http\Request  $request

/******  24db6492-94f7-41ec-92b6-98fe79ae6931  *******/
    public function login(Request $request)
    {
        // Validasi input admin
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && $admin->password == $request->password) {
            // Login admin dengan guard 'admin'
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');  // Redirect ke halaman admin dashboard
        }

        return back()->withErrors(['error' => 'Username atau Password salah']);
    }



    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

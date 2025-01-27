<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    // Menampilkan halaman data gaji karyawan
    public function index()
    {
        // Mengambil semua data gaji karyawan
        $gaji = Gaji::with('karyawan')->get();  // Mengambil data gaji beserta data karyawan yang terkait

        // Menampilkan view dengan data gaji
        return view('gaji.index', compact('gaji'));
    }
}

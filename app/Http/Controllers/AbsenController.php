<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    // Menampilkan halaman data absen karyawan
    public function index()
    {
        // Mengambil semua data absen karyawan
        $absen = Absen::with('karyawan')->get();  // Mengambil data absen beserta data karyawan yang terkait

        // Menampilkan view dengan data absen
        return view('absen.index', compact('absen'));
    }
}

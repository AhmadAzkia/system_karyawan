<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    // Menampilkan halaman data absen karyawan
    public function index(Request $request)
    {
        // Handle search if any
        $search = $request->input('search');
        $absen = Absen::with('karyawan') // Assuming you have the relationship 'karyawan' for fetching Karyawan data
            ->when($search, function ($query, $search) {
                return $query->where('karyawan.Nama_Karyawan', 'LIKE', "%{$search}%")
                    ->orWhere('tanggal', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('absen.index', compact('absen'));
    }


    public function edit($id)
    {
        // Ambil data absen berdasarkan ID
        $absen = Absen::findOrFail($id);

        // Ambil data karyawan untuk dropdown
        $karyawan = Karyawan::all();

        // Tampilkan form edit dengan data absen dan karyawan
        return view('absen.edit', compact('absen', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'id_karyawan' => 'required|exists:karyawan,ID_Karyawan',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|string',
            'jam_masuk' => 'required|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s',
        ]);

        // Ambil data absen berdasarkan ID
        $absen = Absen::findOrFail($id);

        // Update data absen
        $absen->update($validated);

        // Redirect ke halaman lihat absen dengan pesan sukses
        return redirect()->route('absen.index')->with('success', 'Absen berhasil diperbarui!');
    }
        // Menampilkan halaman form absensi
        public function create()
        {
            $karyawans = Karyawan::all(); // Mengambil data karyawan
            return view('absen.create', compact('karyawans')); // Mengirim data karyawan ke view
        }

        // Menyimpan absensi
        public function store(Request $request)
        {
            $validated = $request->validate([
                'id_karyawan' => 'required|exists:karyawan,ID_Karyawan',
                'status_kehadiran' => 'required|in:Hadir,Izin,Alpa',
            ]);

            // Menyimpan data absensi
            Absen::create([
                'id_karyawan' => $validated['id_karyawan'],
                'tanggal' => now()->format('Y-m-d'),
                'status_kehadiran' => $validated['status_kehadiran'],
                'jam_masuk' => now()->format('H:i:s'),
            ]);

            return redirect()->route('home')->with('success', 'Absensi berhasil!');
        }
    }


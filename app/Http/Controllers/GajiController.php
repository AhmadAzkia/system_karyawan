<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Departemen;
use App\Models\Jabatan;
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

    // Menampilkan halaman untuk menambah gaji
    public function create()
    {
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        $karyawans = Karyawan::all();

        return view('gaji.create', compact('departemens', 'jabatans', 'karyawans'));
    }

    // Menyimpan data gaji baru
    public function store(Request $request)
    {
        // Debugging untuk memeriksa data yang diterima
        dd($request->all()); // Tambahkan untuk melihat apakah data yang dikirimkan benar

        $validated = $request->validate([
            'ID_Karyawan' => 'required|exists:karyawan,ID_Karyawan',
            'Gaji_Pokok' => 'required|numeric',
            'Tunjangan' => 'required|numeric',
        ]);

        // Ambil ID terakhir dan generate ID baru
        $lastGaji = Gaji::orderBy('ID_Gaji', 'desc')->first();
        $lastId = $lastGaji ? substr($lastGaji->ID_Gaji, 1) : 0;
        $newId = 'G' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Menambahkan awalan 'G' dan padding 3 digit

        // Simpan data gaji baru
        Gaji::create([
            'ID_Gaji' => $newId,
            'ID_Karyawan' => $validated['ID_Karyawan'],
            'Gaji_Pokok' => $validated['Gaji_Pokok'],
            'Tunjangan' => $validated['Tunjangan'],
        ]);

        return redirect()->route('gaji.index')->with('success', 'Gaji karyawan berhasil ditambahkan!');
    }



    // GajiController.php
    public function edit($id)
    {
        // Ambil data gaji berdasarkan ID
        $gaji = Gaji::findOrFail($id);

        // Ambil data jabatan terkait karyawan yang dipilih
        $jabatan = Jabatan::find($gaji->karyawan->ID_Jabatan);

        // Ambil karyawan yang terkait dengan gaji
        $karyawan = Karyawan::find($gaji->ID_Karyawan);

        // Ambil jabatan berdasarkan karyawan yang dipilih
        $jabatan = Jabatan::find($karyawan->ID_Jabatan);

        // Ambil semua karyawan dan jabatan untuk dropdown
        $karyawans = Karyawan::all();
        $jabatans = Jabatan::all();

        return view('gaji.edit', compact('gaji', 'jabatan', 'karyawan', 'karyawans', 'jabatans'));
    }



    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'ID_Karyawan' => 'required|exists:karyawan,ID_Karyawan',
            'Gaji_Pokok' => 'required|numeric',
            'Tunjangan' => 'required|numeric',
            'ID_Jabatan' => 'required|exists:jabatan,ID_Jabatan',
        ]);

        // Cari data gaji berdasarkan ID
        $gaji = Gaji::findOrFail($id);

        // Ambil data jabatan berdasarkan ID Jabatan yang dipilih
        $jabatan = Jabatan::find($validated['ID_Jabatan']);

        // Pastikan gaji pokok berada dalam rentang Min Gaji dan Max Gaji yang ditentukan di Jabatan
        if ($validated['Gaji_Pokok'] < $jabatan->Min_Gaji || $validated['Gaji_Pokok'] > $jabatan->Max_Gaji) {
            return back()->with('error', 'Gaji Pokok harus berada dalam rentang Min Gaji dan Max Gaji jabatan tersebut.');
        }

        // Update data gaji
        $gaji->update([
            'ID_Karyawan' => $validated['ID_Karyawan'],
            'Gaji_Pokok' => $validated['Gaji_Pokok'],
            'Tunjangan' => $validated['Tunjangan'],
        ]);

        // Redirect ke halaman daftar gaji dengan pesan sukses
        return redirect()->route('gaji.index')->with('success', 'Gaji karyawan berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil dihapus!');
    }
}

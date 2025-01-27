<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Menampilkan data karyawan
    public function index()
    {
        // Ambil semua data karyawan
        $karyawans = Karyawan::all();

        // Kirim data ke view
        return view('karyawan.index', compact('karyawans'));
    }

    // Menampilkan halaman form tambah karyawan
    public function create()
    {
        // Mengambil data departemen dan jabatan untuk dropdown
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();

        return view('karyawan.create', compact('departemens', 'jabatans'));
    }

    // Menyimpan data karyawan yang baru
    public function store(Request $request)
    {
        // Validasi input data
        $validated = $request->validate([
            'Nama_Karyawan' => 'required|string|max:100',
            'ID_Departemen' => 'required|exists:departemen,ID_Departemen',
            'ID_Jabatan' => 'required|exists:jabatan,ID_Jabatan',
            'Tanggal_Bergabung' => 'nullable|date',
            'Status_Karyawan' => 'required|string|in:aktif,non-aktif',
            'Jenis_Kelamin' => 'required|string|in:L,P',
            'Tempat_Tanggal_Lahir' => 'nullable|string|max:100',
            'Nomor_HP' => 'required|string|max:15',
        ]);

        // Ambil ID_Karyawan terakhir dan generate ID baru
        $lastKaryawan = Karyawan::orderBy('ID_Karyawan', 'desc')->first();
        $newId = $lastKaryawan ? 'K' . str_pad((int)substr($lastKaryawan->ID_Karyawan, 1) + 1, 3, '0', STR_PAD_LEFT) : 'K001';

        // Tambahkan ID Karyawan ke dalam data untuk disimpan
        $validated['ID_Karyawan'] = $newId;

        // Simpan data karyawan dengan ID yang sudah di-generate
        Karyawan::create($validated);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    // Mengambil jabatan berdasarkan ID departemen
    public function getJabatanByDepartemen($departemenId)
    {
        // Ambil jabatan berdasarkan ID_Departemen
        $jabatans = Jabatan::where('ID_Departemen', $departemenId)->get();

        return response()->json($jabatans);
    }

    // Menampilkan halaman edit karyawan
    public function edit($id)
    {
        // Ambil data karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);

        // Ambil data departemen dan jabatan untuk dropdown
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();

        // Tampilkan halaman edit dengan data karyawan, departemen, dan jabatan
        return view('karyawan.edit', compact('karyawan', 'departemens', 'jabatans'));
    }

    // Menyimpan perubahan data karyawan
    public function update(Request $request, $id)
    {
        // Validasi input data
        $validated = $request->validate([
            'Nama_Karyawan' => 'required|string|max:255',
            'ID_Departemen' => 'required|string',
            'ID_Jabatan' => 'required|string',
            'Tanggal_Bergabung' => 'nullable|date',
            'Status_Karyawan' => 'required|string',
            'Jenis_Kelamin' => 'required|string',
            'Tempat_Tanggal_Lahir' => 'nullable|string',
            'Nomor_HP' => 'nullable|string',
        ]);

        // Cek apakah karyawan ditemukan
        $karyawan = Karyawan::findOrFail($id);

        // Update data karyawan
        $karyawan->update($validated);

        // Redirect ke halaman index karyawan dengan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    // Menghapus data karyawan
    public function destroy(Karyawan $karyawan)
    {
        // Hapus data karyawan
        $karyawan->delete();

        // Redirect ke halaman index karyawan dengan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}

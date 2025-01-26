<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;

class DepartemenController extends Controller
{
    public function index()
    {
        $departments = Departemen::all();
        return view('departemen.index', compact('departments'));
    }

    public function create()
    {
        return view('departemen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Departemen' => 'required|string|max:255',
            'Deskripsi_Departemen' => 'nullable|string',
        ]);

        $lastDepartemen = Departemen::orderBy('ID_Departemen', 'desc')->first();
        $newIdNumber = $lastDepartemen ? ((int) substr($lastDepartemen->ID_Departemen, 1)) + 1 : 1;
        $newId = 'D' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);

        Departemen::create([
            'ID_Departemen' => $newId,
            'Nama_Departemen' => $request->Nama_Departemen,
            'Deskripsi_Departemen' => $request->Deskripsi_Departemen,
        ]);

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $department = Departemen::where('ID_Departemen', $id)->firstOrFail();
        return view('departemen.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Departemen' => 'required|string|max:255',
            'Deskripsi_Departemen' => 'nullable|string',
        ]);

        Departemen::where('ID_Departemen', $id)
            ->update([
                'Nama_Departemen' => $request->input('Nama_Departemen'),
                'Deskripsi_Departemen' => $request->input('Deskripsi_Departemen'),
            ]);

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID_Departemen
        $department = Departemen::where('ID_Departemen', $id)->first();
    
        // Jika data tidak ditemukan, beri error
        if (!$department) {
            return redirect()->route('departemen.index')->with('error', 'Departemen tidak ditemukan.');
        }
    
        // Hapus data
        $department->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil dihapus.');
    }
    

}

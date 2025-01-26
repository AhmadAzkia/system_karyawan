<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Jabatan;
use App\Models\Departemen;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        $departemen = Departemen::all();
        return view('jabatan.create', compact('departemen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Jabatan' => 'required|string|max:255',
            'Deskripsi_Jabatan' => 'nullable|string',
            'Min_Gaji' => 'required|numeric|min:0',
            'Max_Gaji' => 'required|numeric|min:0|gte:Min_Gaji',
            'ID_Departemen' => 'required|string|exists:Departemen,ID_Departemen',
        ]);

        $lastJabatan = Jabatan::orderBy('ID_Jabatan', 'desc')->first();
        $newIdNumber = $lastJabatan ? ((int) substr($lastJabatan->ID_Jabatan, 1)) + 1 : 1;
        $newId = 'J' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);

        Jabatan::create([
            'ID_Jabatan' => $newId,
            'Nama_Jabatan' => $request->Nama_Jabatan,
            'Deskripsi_Jabatan' => $request->Deskripsi_Jabatan,
            'Min_Gaji' => $request->Min_Gaji,
            'Max_Gaji' => $request->Max_Gaji,
            'ID_Departemen' => $request->ID_Departemen,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $departemen = Departemen::all();
        return view('jabatan.edit', compact('jabatan', 'departemen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Jabatan' => 'required|string|max:255',
            'Deskripsi_Jabatan' => 'nullable|string',
            'Min_Gaji' => 'required|numeric|min:0',
            'Max_Gaji' => 'required|numeric|min:0|gte:Min_Gaji',
            'ID_Departemen' => 'required|string|exists:Departemen,ID_Departemen',
        ]);

        Jabatan::where('ID_Jabatan', $id)->update([
            'Nama_Jabatan' => $request->Nama_Jabatan,
            'Deskripsi_Jabatan' => $request->Deskripsi_Jabatan,
            'Min_Gaji' => $request->Min_Gaji,
            'Max_Gaji' => $request->Max_Gaji,
            'ID_Departemen' => $request->ID_Departemen,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Jabatan::where('ID_Jabatan', $id)->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}

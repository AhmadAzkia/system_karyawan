<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $departemen = DB::table('departemen')
            ->leftJoin('karyawans', 'departemen.ID_Departemen', '=', 'karyawans.ID_Departemen')
            ->select('departemen.Nama_Departemen', DB::raw('COUNT(karyawans.ID_Karyawan) as total_karyawan'))
            ->groupBy('departemen.ID_Departemen', 'departemen.Nama_Departemen')
            ->get();

        return view('dashboard', compact('departemen'));
    }
}


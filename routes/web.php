<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\DB;

// Halaman utama
Route::get('/', function () {
    $total_departemen = DB::table('departemen')->count();
    $total_jabatan = DB::table('jabatan')->count();
    $total_karyawan = DB::table('Karyawan')->count();

    $departemen = DB::table('departemen')
        ->leftJoin('Karyawan', 'departemen.ID_Departemen', '=', 'Karyawan.ID_Departemen')
        ->select('departemen.Nama_Departemen', DB::raw('COUNT(Karyawan.ID_Karyawan) as total_karyawan'))
        ->groupBy('departemen.ID_Departemen', 'departemen.Nama_Departemen')
        ->get();

    $jabatan = DB::table('jabatan')
        ->select('Nama_Jabatan', 'Min_Gaji', 'Max_Gaji')
        ->get();

    return view('welcome', compact('total_departemen', 'total_jabatan', 'total_karyawan', 'departemen', 'jabatan'));
});

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Karyawan CRUD
Route::resource('karyawan', KaryawanController::class);

// Jabatan CRUD
Route::resource('jabatan', JabatanController::class);

// Departemen CRUD
Route::resource('departemen', DepartemenController::class);

// Route untuk get-jabatan berdasarkan departemen
Route::get('/get-jabatan/{departemen_id}', [KaryawanController::class, 'getJabatanByDepartemen']);

// Route untuk gaji
//Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');

// Route untuk absen
Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');


Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
Route::get('/gaji/edit/{id}', [GajiController::class, 'edit'])->name('gaji.edit');
Route::delete('/gaji/delete/{id}', [GajiController::class, 'destroy'])->name('gaji.delete');


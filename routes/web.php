<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Halaman utama
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('Auth.HalamanLogin');
})->name('Auth.HalamanLogin');

// Halaman welcome
Route::get('/welcome', function () {
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

// Route untuk ke halaman create gaji
Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create');

// Route untuk membuat gaji
Route::post('/gaji', [GajiController::class, 'store'])->name('gaji.store');

// Route untuk delete gaji
Route::delete('/gaji/{id}', [GajiController::class, 'destroy'])->name('gaji.destroy');


Route::get('/get-jabatan/{departemenId}', function ($departemenId) {
    return DB::table('jabatan')->where('ID_Departemen', $departemenId)->get();
});

Route::get('/get-karyawan/{jabatanId}', function ($jabatanId) {
    return DB::table('karyawan')->where('ID_Jabatan', $jabatanId)->get();
});

// Rute untuk edit
Route::get('/gaji/{id}/edit', [GajiController::class, 'edit'])->name('gaji.edit');

// Rute untuk update data gaji
Route::put('/gaji/{id}', [GajiController::class, 'update'])->name('gaji.update');

// Rute untuk delete
Route::delete('/gaji/{id}', [GajiController::class, 'destroy'])->name('gaji.destroy');


// Route untuk absen
Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');

// Route absen
Route::get('/absen/{id}/edit', [AbsenController::class, 'edit'])->name('absen.edit');
Route::put('/absen/{id}', [AbsenController::class, 'update'])->name('absen.update');

// Menampilkan form absensi
Route::get('/absensi', [AbsenController::class, 'create'])->name('absen.create');

// Menyimpan data absensi
Route::post('/absensi', [AbsenController::class, 'store'])->name('absen.store');

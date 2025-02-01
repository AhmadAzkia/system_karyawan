<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    // Nama tabel absensi
    protected $table = 'absensi';

    // Primary key
    protected $primaryKey = 'id_absensi';

    // Jika ID tidak auto-increment
    public $incrementing = true;

    // Timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_karyawan',
        'tanggal',
        'status_kehadiran',
        'jam_masuk',
        'jam_keluar',
    ];

    // Relasi dengan karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'ID_Karyawan');
    }
}

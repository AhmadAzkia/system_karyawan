<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absensi';  // Sesuaikan dengan nama tabel

    // Kolom yang dapat diisi
    protected $fillable = [
        'ID_Karyawan',
        'Tanggal',
        'Status_Absen'
    ];

    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'ID_Karyawan');
    }
}

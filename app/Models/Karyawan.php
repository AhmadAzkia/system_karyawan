<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Karyawan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'Karyawan';

    // Kolom primary key
    protected $primaryKey = 'ID_Karyawan';

    // Jika primary key tidak auto-increment
    public $incrementing = false;

    // Tipe data primary key (misalnya VARCHAR)
    protected $keyType = 'string';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'ID_Karyawan',
        'Nama_Karyawan',
        'ID_Departemen',
        'ID_Jabatan',
        'Tanggal_Bergabung',
        'Status_Karyawan',
        'Jenis_Kelamin',
        'Tempat_Tanggal_Lahir',
        'Nomor_HP',
    ];

    // Nonaktifkan timestamps jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;

    // Relasi ke tabel Gaji
    public function gaji()
    {
        return $this->hasOne(Gaji::class, 'ID_Karyawan', 'ID_Karyawan');
    }

    // Relasi ke tabel Departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'ID_Departemen', 'ID_Departemen');
    }

    // Relasi ke tabel Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'ID_Jabatan', 'ID_Jabatan');
    }

    // Pengaturan default nilai untuk beberapa kolom
    protected $attributes = [
        'Status_Karyawan' => 'aktif', // Default untuk Status_Karyawan
    ];

    // Menggunakan casting untuk konversi tipe data
    protected $casts = [
        'Tanggal_Bergabung' => 'date', // Casting Tanggal_Bergabung menjadi tipe date
    ];

    // Menyembunyikan kolom tertentu
    protected $hidden = [
        'Nomor_HP', // Menyembunyikan Nomor_HP saat dikirim ke view
    ];
}

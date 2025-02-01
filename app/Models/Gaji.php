<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'Gaji';
    protected $primaryKey = 'ID_Gaji';  // Tentukan primary key
    public $incrementing = false;  // Karena ID_Gaji adalah string
    protected $fillable = ['ID_Karyawan', 'Gaji_Pokok', 'Tunjangan'];

    // Nonaktifkan timestamps jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'ID_Karyawan', 'ID_Karyawan');
    }

    // Gaji.php Model
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'ID_Jabatan', 'ID_Jabatan');
    }
}

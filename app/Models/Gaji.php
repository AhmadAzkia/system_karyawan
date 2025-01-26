<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'Gaji'; // Nama tabel gaji

    protected $primaryKey = 'ID_Gaji'; // Primary key tabel Gaji

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'ID_Gaji',
        'ID_Karyawan', // Foreign key
        'Nominal',     // Kolom nominal gaji
    ];

    public $timestamps = false;

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'ID_Karyawan', 'ID_Karyawan');
    }
}

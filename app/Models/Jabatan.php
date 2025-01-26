<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'Jabatan'; // Nama tabel
    protected $primaryKey = 'ID_Jabatan'; // Primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'string'; // Jika primary key berupa string

    protected $fillable = [
        'ID_Jabatan',
        'Nama_Jabatan',
        'Deskripsi_Jabatan',
        'Min_Gaji',
        'Max_Gaji',
        'ID_Departemen',
    ];

    public $timestamps = false; // Jika tabel tidak memiliki kolom timestamps
}

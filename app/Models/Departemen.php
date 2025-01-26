<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'Departemen';
    protected $primaryKey = 'ID_Departemen';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Departemen',
        'Nama_Departemen',
        'Deskripsi_Departemen',
    ];

    public $timestamps = false;
}

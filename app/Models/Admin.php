<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Pastikan meng-extend Authenticatable
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Nama tabel di database
    protected $table = 'admins';  // Gunakan tabel 'admins'

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['username', 'password'];

    // Kolom yang harus disembunyikan
    protected $hidden = ['password'];

    // Menentukan kolom untuk login
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}

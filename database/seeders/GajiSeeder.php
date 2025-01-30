<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gaji;
use App\Models\Karyawan;

class GajiSeeder extends Seeder
{
    public function run()
    {
        $karyawan = Karyawan::first();

        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'gaji_pokok' => 5000000,
            'tunjangan' => 1000000,
            'total_gaji' => 6000000
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateIdGajiColumnInGajiTable extends Migration
{
    public function up()
    {
        Schema::table('Gaji', function (Blueprint $table) {
            // Menghapus primary key jika sudah ada
            $table->dropPrimary();

            // Mengubah kolom ID_Gaji menjadi string dan menjadikannya primary key
            $table->string('ID_Gaji')->primary()->change();
        });
    }

    public function down()
    {
        Schema::table('Gaji', function (Blueprint $table) {
            // Cek apakah kolom ID_Gaji sudah bertipe string dan memiliki primary key
            $primaryKeyExists = DB::select('SHOW KEYS FROM Gaji WHERE Key_name = "PRIMARY"');
            if (count($primaryKeyExists) > 0) {
                $table->dropPrimary(); // Menghapus primary key jika ada
            }

            // Pastikan kolom ID_Gaji tetap dalam format string
            $table->string('ID_Gaji')->primary()->change();  // Kembali ke string
        });
    }

}

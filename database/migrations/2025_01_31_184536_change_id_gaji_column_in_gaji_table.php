<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdGajiColumnInGajiTable extends Migration
{
    public function up()
    {
        Schema::table('Gaji', function (Blueprint $table) {
            // Hapus primary key yang ada
            $table->dropPrimary();

            // Tentukan ID_Gaji sebagai primary key
            $table->string('ID_Gaji')->primary()->change();
        });
    }

    public function down()
    {
        Schema::table('Gaji', function (Blueprint $table) {
            // Kembalikan ke format sebelumnya jika rollback
            $table->integer('ID_Gaji')->change();
            $table->primary('ID_Gaji');
        });
    }
}

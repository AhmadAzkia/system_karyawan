<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIdAbsensiColumnInAbsensiTable extends Migration
{
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            // Mengubah kolom id_absensi menjadi VARCHAR untuk menyimpan ID dengan format A001, A002, dll.
            $table->string('id_absensi', 5)->primary()->change();
        });
    }

    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {
            // Mengembalikan kolom id_absensi ke tipe INT jika rollback
            $table->integer('id_absensi')->primary()->change();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoDokumentasiToPrestasiTable extends Migration
{
    public function up()
    {
        Schema::table('prestasi', function (Blueprint $table) {
            // Tambah kolom foto_dokumentasi (bisa multiple dipisah koma)
            $table->text('foto_dokumentasi')->nullable()->after('deskripsi');
            // Tambah kolom penyelenggara
            $table->string('penyelenggara')->nullable()->after('deskripsi');
            // Tambah kolom lokasi
            $table->string('lokasi')->nullable()->after('deskripsi');
        });
    }

    public function down()
    {
        Schema::table('prestasi', function (Blueprint $table) {
            $table->dropColumn(['foto_dokumentasi', 'penyelenggara', 'lokasi']);
        });
    }
}
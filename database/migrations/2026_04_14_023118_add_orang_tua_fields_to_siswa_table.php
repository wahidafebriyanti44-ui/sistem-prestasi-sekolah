<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('nama_ayah', 100)->nullable()->after('mata_pelajaran_favorit');
            $table->string('nama_ibu', 100)->nullable()->after('nama_ayah');
            $table->string('no_hp_orangtua', 20)->nullable()->after('nama_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['nama_ayah', 'nama_ibu', 'no_hp_orangtua']);
        });
    }
};
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
        Schema::create('siswa_eskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->onDelete('cascade');
            $table->foreignId('eskul_id')
                  ->constrained('eskul')
                  ->onDelete('cascade');
            $table->year('tahun_masuk')->nullable();
            $table->text('keterangan')->nullable()->comment('Misal: sebagai ketua, dll');
            $table->timestamps();
            
            // Unique constraint biar siswa ga daftar eskul yang sama 2x
            $table->unique(['siswa_id', 'eskul_id', 'tahun_masuk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_eskul');
    }
};
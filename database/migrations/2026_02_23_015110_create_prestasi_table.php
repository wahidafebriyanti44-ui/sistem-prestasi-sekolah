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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->onDelete('cascade');
            $table->enum('jenis_prestasi', ['akademik', 'non_akademik']);
            $table->string('nama_lomba');
            $table->enum('tingkat', [
                'sekolah', 
                'kecamatan', 
                'kabupaten', 
                'provinsi', 
                'nasional', 
                'internasional'
            ]);
            $table->string('peringkat')->nullable()->comment('Juara 1, Harapan 1, Peserta, dll');
            $table->year('tahun');
            $table->text('deskripsi')->nullable();
            $table->string('file_sertifikat')->nullable()->comment('Path file upload');
            $table->enum('status', ['pending', 'diverifikasi'])->default('pending');
            $table->foreignId('diverifikasi_oleh')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
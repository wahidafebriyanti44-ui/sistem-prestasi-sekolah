<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hafalan_quran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->boolean('is_active')->default(false); // aktif atau tidak
            $table->integer('juz')->nullable(); // jumlah juz yang dihafal (1-30)
            $table->text('description')->nullable(); // deskripsi/keterangan
            $table->date('start_date')->nullable(); // tanggal mulai menghafal
            $table->string('target_juz')->nullable(); // target hafalan (contoh: "30 juz" atau "juz 1-5")
            $table->string('pembimbing')->nullable(); // nama pembimbing/guru
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hafalan_quran');
    }
};
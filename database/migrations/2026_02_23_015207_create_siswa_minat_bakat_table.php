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
        Schema::create('siswa_minat_bakat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->onDelete('cascade');
            $table->foreignId('minat_bakat_id')
                  ->constrained('minat_bakat')
                  ->onDelete('cascade');
            $table->timestamps();
            
            // Unique constraint biar siswa ga punya minat yang sama 2x
            $table->unique(['siswa_id', 'minat_bakat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_minat_bakat');
    }
};
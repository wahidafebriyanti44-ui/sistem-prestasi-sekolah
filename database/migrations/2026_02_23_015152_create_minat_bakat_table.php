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
        Schema::create('minat_bakat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_minat', 100);
            $table->string('kategori', 50)->nullable()->comment('Olahraga, Seni, Sains, dll');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minat_bakat');
    }
};
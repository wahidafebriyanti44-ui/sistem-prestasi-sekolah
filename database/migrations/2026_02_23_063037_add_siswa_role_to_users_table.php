<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan 'siswa' ke dalam enum
        DB::statement("ALTER TABLE users MODIFY role ENUM('super_admin', 'admin_sekolah', 'guru', 'siswa') NOT NULL DEFAULT 'guru'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum awal
        DB::statement("ALTER TABLE users MODIFY role ENUM('super_admin', 'admin_sekolah', 'guru') NOT NULL DEFAULT 'guru'");
    }
};
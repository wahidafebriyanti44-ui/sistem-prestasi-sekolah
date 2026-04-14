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
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom school_id (nullable untuk super admin)
            $table->foreignId('school_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('schools')
                  ->onDelete('cascade');
            
            // Tambah kolom role
            $table->enum('role', ['super_admin', 'admin_sekolah', 'guru'])
                  ->default('guru')
                  ->after('password');
            
            // Tambah kolom is_active
            $table->boolean('is_active')
                  ->default(true)
                  ->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['school_id']);
            // Hapus kolom
            $table->dropColumn(['school_id', 'role', 'is_active']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            // Tambah kolom untuk kelengkapan data sekolah
            $table->string('city')->nullable()->after('address');
            $table->string('province')->nullable()->after('city');
            $table->string('postal_code', 10)->nullable()->after('province');
            $table->enum('school_level', ['sd', 'smp', 'sma', 'smk'])->nullable()->after('postal_code');
            
            // Kolom untuk verifikasi
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->after('school_level');
            $table->string('registration_token')->unique()->nullable()->after('status');
            $table->timestamp('verified_at')->nullable()->after('registration_token');
            $table->foreignId('verified_by')->nullable()->after('verified_at')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn([
                'city', 'province', 'postal_code', 'school_level',
                'status', 'registration_token', 'verified_at', 'verified_by'
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ❌ HAPUS INI (karena sudah ada)
            // $table->string('role')->default('user')->after('email');

            // ✅ Tambahkan yang belum ada saja
            if (!Schema::hasColumn('users', 'school_id')) {
                $table->foreignId('school_id')->nullable()->constrained()->after('role');
            }

            // kalau nanti mau dipakai:
            // if (!Schema::hasColumn('users', 'is_active')) {
            //     $table->boolean('is_active')->default(true)->after('school_id');
            // }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ❌ jangan hapus 'role' karena bukan dari migration ini

            $table->dropColumn(['school_id']);
            // $table->dropColumn(['is_active']);
        });
    }
};
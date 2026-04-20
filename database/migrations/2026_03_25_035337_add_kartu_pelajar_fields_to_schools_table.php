<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->string('kepala_sekolah')->nullable()->after('email');
            $table->string('nip_kepala_sekolah')->nullable()->after('kepala_sekolah');
            $table->string('ttd_digital')->nullable()->after('nip_kepala_sekolah');
            $table->string('logo_sekolah')->nullable()->after('ttd_digital');
        });
    }

    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['kepala_sekolah', 'nip_kepala_sekolah', 'ttd_digital', 'logo_sekolah']);
        });
    }
};
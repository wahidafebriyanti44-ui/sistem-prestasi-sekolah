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
        Schema::table('schools', function (Blueprint $table) {

            if (!Schema::hasColumn('schools', 'kepala_sekolah')) {
                $table->string('kepala_sekolah')->nullable()->after('npsn');
            }

            if (!Schema::hasColumn('schools', 'nip_kepala_sekolah')) {
                $table->string('nip_kepala_sekolah')->nullable()->after('kepala_sekolah');
            }

            if (!Schema::hasColumn('schools', 'logo_sekolah')) {
                $table->string('logo_sekolah')->nullable()->after('nip_kepala_sekolah');
            }

            if (!Schema::hasColumn('schools', 'ttd_digital')) {
                $table->string('ttd_digital')->nullable()->after('logo_sekolah');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {

            if (Schema::hasColumn('schools', 'kepala_sekolah')) {
                $table->dropColumn('kepala_sekolah');
            }

            if (Schema::hasColumn('schools', 'nip_kepala_sekolah')) {
                $table->dropColumn('nip_kepala_sekolah');
            }

            if (Schema::hasColumn('schools', 'logo_sekolah')) {
                $table->dropColumn('logo_sekolah');
            }

            if (Schema::hasColumn('schools', 'ttd_digital')) {
                $table->dropColumn('ttd_digital');
            }

        });
    }
};
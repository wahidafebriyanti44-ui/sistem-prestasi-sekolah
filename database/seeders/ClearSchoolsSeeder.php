<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClearSchoolsSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Hapus semua user yang terkait sekolah (bukan super admin)
        User::where('role', '!=', User::ROLE_SUPER_ADMIN)->delete();
        
        // Hapus semua sekolah
        School::truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $this->command->info('✅ Semua data sekolah dan user (non super admin) telah dihapus!');
    }
}
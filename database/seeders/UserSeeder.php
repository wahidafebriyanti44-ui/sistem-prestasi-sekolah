<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('=====================================');
        $this->command->info('🌱 SEEDING DATA USER');
        $this->command->info('=====================================');

        // Kosongkan tabel users (tapi jangan hapus schools karena nanti sekolah akan daftar sendiri)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // 1. SUPER ADMIN (tidak terikat sekolah)
        $superAdmin = User::create([
            'school_id' => null,
            'name' => 'Super Administrator',
            'email' => 'superadmin@sipres.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => User::ROLE_SUPER_ADMIN,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Super Admin berhasil dibuat:');
        $this->command->info('   📧 Email: superadmin@sipres.com');
        $this->command->info('   🔑 Password: password');
        $this->command->info('');

        // 2. TAMPILKAN INFORMASI
        $this->command->info('=====================================');
        $this->command->info('📝 INFORMASI SISTEM');
        $this->command->info('=====================================');
        $this->command->info('🏫 Sekolah:');
        $this->command->info('   Sekolah dapat mendaftar sendiri melalui halaman:');
        $this->command->info('   🔗 ' . url('/register-sekolah'));
        $this->command->info('');
        $this->command->info('📧 Verifikasi:');
        $this->command->info('   • OTP akan dikirim ke email sekolah yang didaftarkan');
        $this->command->info('   • Setelah registrasi, status sekolah = "Menunggu Verifikasi"');
        $this->command->info('   • Super Admin harus memverifikasi sekolah terlebih dahulu');
        $this->command->info('');
        $this->command->info('👥 Pengguna:');
        $this->command->info('   • Super Admin: superadmin@sipres.com / password');
        $this->command->info('   • Admin Sekolah: dibuat saat registrasi sekolah');
        $this->command->info('   • Guru: ditambahkan oleh Admin Sekolah setelah login');
        $this->command->info('   • Siswa: ditambahkan oleh Admin Sekolah setelah login');
        $this->command->info('=====================================');
        $this->command->info('');
        $this->command->info('✅ SEEDING SELESAI!');
        $this->command->info('=====================================');
    }
}
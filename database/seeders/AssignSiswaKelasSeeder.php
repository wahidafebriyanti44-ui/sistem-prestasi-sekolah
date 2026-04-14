<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class AssignSiswaKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('=====================================');
        $this->command->info('🚀 MULAI MENGASSIGN KELAS KE SISWA...');
        $this->command->info('=====================================');

        // Ambil semua data siswa
        $siswa = Siswa::all();
        
        if ($siswa->isEmpty()) {
            $this->command->error('❌ Tidak ada data siswa!');
            return;
        }

        $berhasil = 0;
        $gagal = 0;

        foreach ($siswa as $s) {
            // Cari kelas dari sekolah yang sama dengan siswa
            $kelas = Kelas::where('school_id', $s->school_id)
                         ->inRandomOrder()
                         ->first();

            if ($kelas) {
                // Update kelas_id siswa
                $s->kelas_id = $kelas->id;
                $s->save();
                
                $berhasil++;
                $this->command->info("✅ {$s->nama_lengkap} -> Kelas {$kelas->nama_kelas}");
            } else {
                $gagal++;
                $this->command->error("❌ {$s->nama_lengkap} - Tidak ada kelas di sekolah ini");
            }
        }

        $this->command->info('=====================================');
        $this->command->info("✅ BERHASIL: {$berhasil} siswa");
        $this->command->info("❌ GAGAL: {$gagal} siswa");
        $this->command->info('=====================================');
        
        // Tampilkan 5 data terakhir untuk verifikasi
        $this->command->info('📊 DATA TERBARU:');
        $recent = Siswa::with('kelas')->latest()->take(5)->get();
        
        foreach ($recent as $s) {
            $namaKelas = $s->kelas->nama_kelas ?? 'BELUM ADA KELAS';
            $this->command->info("   - {$s->nama_lengkap}: {$namaKelas}");
        }
        
        $this->command->info('=====================================');
    }
}
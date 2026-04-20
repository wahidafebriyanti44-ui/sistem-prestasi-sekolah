<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MinatBakat;
use App\Models\School;
use Illuminate\Support\Facades\DB;

class MinatBakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MATIKAN FOREIGN KEY CHECKS DULU
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Kosongkan tabel minat_bakat
        MinatBakat::truncate();
        
        // NYALAKAN LAGI FOREIGN KEY CHECKS
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Ambil semua sekolah
        $schools = School::all();

        if ($schools->isEmpty()) {
            $this->command->error('❌ Tidak ada data sekolah! Jalankan SchoolSeeder dulu.');
            return;
        }

        // Data minat & bakat (tanpa school_id)
        $minatBakat = [
            // Olahraga
            ['nama_minat' => 'Sepak Bola', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Futsal', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Basket', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Voli', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Bulu Tangkis', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Renang', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Atletik', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Pencak Silat', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Karate', 'kategori' => 'olahraga'],
            ['nama_minat' => 'Taekwondo', 'kategori' => 'olahraga'],
            
            // Seni
            ['nama_minat' => 'Melukis', 'kategori' => 'seni'],
            ['nama_minat' => 'Menggambar', 'kategori' => 'seni'],
            ['nama_minat' => 'Menyanyi', 'kategori' => 'seni'],
            ['nama_minat' => 'Bermain Musik', 'kategori' => 'seni'],
            ['nama_minat' => 'Menari', 'kategori' => 'seni'],
            ['nama_minat' => 'Teater', 'kategori' => 'seni'],
            ['nama_minat' => 'Musik (Gitar)', 'kategori' => 'seni'],
            ['nama_minat' => 'Musik (Piano)', 'kategori' => 'seni'],
            ['nama_minat' => 'Musik (Drum)', 'kategori' => 'seni'],
            ['nama_minat' => 'Paduan Suara', 'kategori' => 'seni'],
            
            // Sains
            ['nama_minat' => 'Matematika', 'kategori' => 'sains'],
            ['nama_minat' => 'Fisika', 'kategori' => 'sains'],
            ['nama_minat' => 'Kimia', 'kategori' => 'sains'],
            ['nama_minat' => 'Biologi', 'kategori' => 'sains'],
            ['nama_minat' => 'Astronomi', 'kategori' => 'sains'],
            ['nama_minat' => 'Robotik', 'kategori' => 'sains'],
            ['nama_minat' => 'Research', 'kategori' => 'sains'],
            ['nama_minat' => 'Olimpiade Sains', 'kategori' => 'sains'],
            
            // Bahasa
            ['nama_minat' => 'Bahasa Inggris', 'kategori' => 'bahasa'],
            ['nama_minat' => 'Bahasa Jepang', 'kategori' => 'bahasa'],
            ['nama_minat' => 'Bahasa Korea', 'kategori' => 'bahasa'],
            ['nama_minat' => 'Bahasa Mandarin', 'kategori' => 'bahasa'],
            ['nama_minat' => 'Bahasa Arab', 'kategori' => 'bahasa'],
            ['nama_minat' => 'Bahasa Jerman', 'kategori' => 'bahasa'],
            ['nama_minat' => 'Bahasa Perancis', 'kategori' => 'bahasa'],
            
            // Teknologi
            ['nama_minat' => 'Pemrograman Web', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Pemrograman Mobile', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Desain Grafis', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Editing Video', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Animasi', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Jaringan Komputer', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Cyber Security', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Data Science', 'kategori' => 'teknologi'],
            ['nama_minat' => 'Artificial Intelligence', 'kategori' => 'teknologi'],
            
            // Lainnya
            ['nama_minat' => 'Menulis Cerita', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Menulis Puisi', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Fotografi', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Videografi', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Memasak', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Baking', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Berkebun', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Traveling', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Membaca Buku', 'kategori' => 'lainnya'],
            ['nama_minat' => 'Meditasi', 'kategori' => 'lainnya'],
        ];

        // Insert data untuk SETIAP SEKOLAH
        foreach ($schools as $school) {
            foreach ($minatBakat as $item) {
                MinatBakat::create([
                    'school_id' => $school->id,
                    'nama_minat' => $item['nama_minat'] . ' - ' . $school->name,
                    'kategori' => $item['kategori'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $this->command->info("✅ Minat bakat untuk {$school->name} berhasil dibuat");
        }

        $this->command->info('=====================================');
        $this->command->info('✅ DATA MINAT & BAKAT BERHASIL DIISI!');
        $this->command->info('📊 Total: ' . (count($minatBakat) * $schools->count()) . ' item');
        $this->command->info('=====================================');
    }
}
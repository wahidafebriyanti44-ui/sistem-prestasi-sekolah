<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahIndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Provinsi (34 provinsi)
        $provinsi = [
            ['kode' => '11', 'nama' => 'ACEH'],
            ['kode' => '12', 'nama' => 'SUMATERA UTARA'],
            ['kode' => '13', 'nama' => 'SUMATERA BARAT'],
            ['kode' => '14', 'nama' => 'RIAU'],
            ['kode' => '15', 'nama' => 'JAMBI'],
            ['kode' => '16', 'nama' => 'SUMATERA SELATAN'],
            ['kode' => '17', 'nama' => 'BENGKULU'],
            ['kode' => '18', 'nama' => 'LAMPUNG'],
            ['kode' => '19', 'nama' => 'KEPULAUAN BANGKA BELITUNG'],
            ['kode' => '21', 'nama' => 'KEPULAUAN RIAU'],
            ['kode' => '31', 'nama' => 'DKI JAKARTA'],
            ['kode' => '32', 'nama' => 'JAWA BARAT'],
            ['kode' => '33', 'nama' => 'JAWA TENGAH'],
            ['kode' => '34', 'nama' => 'DI YOGYAKARTA'],
            ['kode' => '35', 'nama' => 'JAWA TIMUR'],
            ['kode' => '36', 'nama' => 'BANTEN'],
            ['kode' => '51', 'nama' => 'BALI'],
            ['kode' => '52', 'nama' => 'NUSA TENGGARA BARAT'],
            ['kode' => '53', 'nama' => 'NUSA TENGGARA TIMUR'],
            ['kode' => '61', 'nama' => 'KALIMANTAN BARAT'],
            ['kode' => '62', 'nama' => 'KALIMANTAN TENGAH'],
            ['kode' => '63', 'nama' => 'KALIMANTAN SELATAN'],
            ['kode' => '64', 'nama' => 'KALIMANTAN TIMUR'],
            ['kode' => '65', 'nama' => 'KALIMANTAN UTARA'],
            ['kode' => '71', 'nama' => 'SULAWESI UTARA'],
            ['kode' => '72', 'nama' => 'SULAWESI TENGAH'],
            ['kode' => '73', 'nama' => 'SULAWESI SELATAN'],
            ['kode' => '74', 'nama' => 'SULAWESI TENGGARA'],
            ['kode' => '75', 'nama' => 'GORONTALO'],
            ['kode' => '76', 'nama' => 'SULAWESI BARAT'],
            ['kode' => '81', 'nama' => 'MALUKU'],
            ['kode' => '82', 'nama' => 'MALUKU UTARA'],
            ['kode' => '91', 'nama' => 'PAPUA'],
            ['kode' => '92', 'nama' => 'PAPUA BARAT'],
        ];

        foreach ($provinsi as $p) {
            DB::table('provinsi')->insert([
                'kode' => $p['kode'],
                'nama' => $p['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Data Kabupaten (contoh untuk beberapa provinsi)
        $kabupaten = [
            // DKI JAKARTA (provinsi_id = 11)
            ['kode' => '3171', 'provinsi_id' => 11, 'nama' => 'KOTA JAKARTA SELATAN'],
            ['kode' => '3172', 'provinsi_id' => 11, 'nama' => 'KOTA JAKARTA TIMUR'],
            ['kode' => '3173', 'provinsi_id' => 11, 'nama' => 'KOTA JAKARTA PUSAT'],
            ['kode' => '3174', 'provinsi_id' => 11, 'nama' => 'KOTA JAKARTA BARAT'],
            ['kode' => '3175', 'provinsi_id' => 11, 'nama' => 'KOTA JAKARTA UTARA'],
            ['kode' => '3176', 'provinsi_id' => 11, 'nama' => 'KABUPATEN KEPULAUAN SERIBU'],
            
            // JAWA BARAT (provinsi_id = 12)
            ['kode' => '3271', 'provinsi_id' => 12, 'nama' => 'KOTA BOGOR'],
            ['kode' => '3272', 'provinsi_id' => 12, 'nama' => 'KOTA SUKABUMI'],
            ['kode' => '3273', 'provinsi_id' => 12, 'nama' => 'KOTA BANDUNG'],
            ['kode' => '3274', 'provinsi_id' => 12, 'nama' => 'KOTA CIREBON'],
            ['kode' => '3275', 'provinsi_id' => 12, 'nama' => 'KOTA BEKASI'],
            ['kode' => '3276', 'provinsi_id' => 12, 'nama' => 'KOTA DEPOK'],
            ['kode' => '3277', 'provinsi_id' => 12, 'nama' => 'KOTA CIMAHI'],
            ['kode' => '3278', 'provinsi_id' => 12, 'nama' => 'KOTA TASIKMALAYA'],
            ['kode' => '3279', 'provinsi_id' => 12, 'nama' => 'KOTA BANJAR'],
            ['kode' => '3201', 'provinsi_id' => 12, 'nama' => 'KABUPATEN BOGOR'],
            ['kode' => '3202', 'provinsi_id' => 12, 'nama' => 'KABUPATEN SUKABUMI'],
            ['kode' => '3203', 'provinsi_id' => 12, 'nama' => 'KABUPATEN CIANJUR'],
            ['kode' => '3204', 'provinsi_id' => 12, 'nama' => 'KABUPATEN BANDUNG'],
            ['kode' => '3205', 'provinsi_id' => 12, 'nama' => 'KABUPATEN GARUT'],
            ['kode' => '3206', 'provinsi_id' => 12, 'nama' => 'KABUPATEN TASIKMALAYA'],
            ['kode' => '3207', 'provinsi_id' => 12, 'nama' => 'KABUPATEN CIAMIS'],
            ['kode' => '3208', 'provinsi_id' => 12, 'nama' => 'KABUPATEN KUNINGAN'],
            ['kode' => '3209', 'provinsi_id' => 12, 'nama' => 'KABUPATEN CIREBON'],
            ['kode' => '3210', 'provinsi_id' => 12, 'nama' => 'KABUPATEN MAJALENGKA'],
            ['kode' => '3211', 'provinsi_id' => 12, 'nama' => 'KABUPATEN SUMEDANG'],
            ['kode' => '3212', 'provinsi_id' => 12, 'nama' => 'KABUPATEN INDRAMAYU'],
            ['kode' => '3213', 'provinsi_id' => 12, 'nama' => 'KABUPATEN SUBANG'],
            ['kode' => '3214', 'provinsi_id' => 12, 'nama' => 'KABUPATEN PURWAKARTA'],
            ['kode' => '3215', 'provinsi_id' => 12, 'nama' => 'KABUPATEN KARAWANG'],
            ['kode' => '3216', 'provinsi_id' => 12, 'nama' => 'KABUPATEN BEKASI'],
            ['kode' => '3217', 'provinsi_id' => 12, 'nama' => 'KABUPATEN BANDUNG BARAT'],
            ['kode' => '3218', 'provinsi_id' => 12, 'nama' => 'KABUPATEN PANGANDARAN'],
        ];

        foreach ($kabupaten as $k) {
            DB::table('kabupaten')->insert([
                'kode' => $k['kode'],
                'provinsi_id' => $k['provinsi_id'],
                'nama' => $k['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
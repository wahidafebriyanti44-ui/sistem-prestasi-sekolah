<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([   
            UserSeeder::class,          
            MinatBakatSeeder::class,    
        ]);

        $this->command->newLine();
        $this->command->info('🎉 SEMUA SEEDER BERHASIL DIJALANKAN!');
        $this->command->newLine();
    }
}
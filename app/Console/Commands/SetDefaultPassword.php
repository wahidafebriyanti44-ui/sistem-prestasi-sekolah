<?php


namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetDefaultPassword extends Command
{
    protected $signature = 'user:set-default-password {email?} {--all : Set for all users without password}';
    protected $description = 'Set default password for users';

    public function handle()
    {
        $email = $this->argument('email');
        $all = $this->option('all');
        
        if ($email) {
            // Set password untuk user tertentu
            $user = User::where('email', $email)->first();
            if ($user) {
                $defaultPassword = 'password123';
                $user->password = Hash::make($defaultPassword);
                $user->save();
                $this->info("✅ Password untuk {$email} telah diset menjadi: {$defaultPassword}");
            } else {
                $this->error("❌ User dengan email {$email} tidak ditemukan!");
            }
        } elseif ($all) {
            // Set password untuk semua user yang tidak punya password
            $users = User::whereNull('password')->orWhere('password', '')->get();
            $defaultPassword = 'password123';
            $count = 0;
            
            foreach ($users as $user) {
                $user->password = Hash::make($defaultPassword);
                $user->save();
                $this->info("✅ Password untuk {$user->email} telah diset menjadi: {$defaultPassword}");
                $count++;
            }
            
            $this->info("\n📊 Total {$count} user telah diupdate.");
        } else {
            $this->error("Gunakan: php artisan user:set-default-password {email} --all");
        }
    }
}
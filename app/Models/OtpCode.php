<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 
        'code', 
        'type', 
        'expires_at', 
        'used_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    // Tipe OTP
    const TYPE_REGISTER_SCHOOL = 'register_school';
    const TYPE_VERIFY_EMAIL = 'verify_email';
    const TYPE_RESET_PASSWORD = 'reset_password';

    /**
     * Cek apakah OTP masih valid
     */
    public function isValid()
    {
        return !$this->used_at && $this->expires_at > now();
    }

    /**
     * Tandai OTP sudah digunakan
     */
    public function markAsUsed()
    {
        $this->used_at = now();
        $this->save();
    }

    /**
     * Generate kode OTP random 6 digit
     */
    public static function generateCode($length = 6)
    {
        return str_pad(random_int(0, 999999), $length, '0', STR_PAD_LEFT);
    }

    /**
     * Buat OTP baru
     */
    public static function createOtp($email, $type, $minutes = 10)
    {
        // Hapus OTP lama yang belum digunakan
        self::where('email', $email)
            ->where('type', $type)
            ->whereNull('used_at')
            ->delete();

        $code = self::generateCode();
        
        return self::create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'expires_at' => now()->addMinutes($minutes),
        ]);
    }

    /**
     * Verifikasi OTP
     */
    public static function verify($email, $code, $type)
    {
        $otp = self::where('email', $email)
            ->where('code', $code)
            ->where('type', $type)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            return false;
        }

        $otp->markAsUsed();
        return true;
    }
}
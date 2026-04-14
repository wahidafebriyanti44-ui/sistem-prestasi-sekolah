<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use App\Notifications\CustomResetPassword; 

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Role constants
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN_SEKOLAH = 'admin_sekolah';
    const ROLE_GURU = 'guru';
    const ROLE_SISWA = 'siswa';

    protected $fillable = [
        'school_id',
        'name',
        'email',
        'phone',
        'password',
        'role',
        'is_active',
        'avatar',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * ============== RELASI KE TABEL LAIN ==============
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function waliKelas()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function verifikasiPrestasi()
    {
        return $this->hasMany(Prestasi::class, 'diverifikasi_oleh');
    }

    /**
     * ============== ACCESSOR UNTUK AVATAR ==============
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return asset('storage/' . $this->avatar);
        }
        
        $colors = [
            'super_admin' => '2A5C8A',
            'admin_sekolah' => '28A745',
            'guru' => 'FFC107',
            'siswa' => 'DC3545',
        ];
        
        $color = $colors[$this->role] ?? '2A5C8A';
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . 
               '&background=' . $color . 
               '&color=fff&size=100&length=2&bold=true&rounded=true';
    }

    public function getAvatarThumbnailAttribute()
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return asset('storage/' . $this->avatar);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . 
               '&background=2A5C8A&color=fff&size=50&length=1&bold=true&rounded=true';
    }

    /**
     * CEK APAKAH USER MEMILIKI AVATAR CUSTOM
     * ⚠️ METHOD INI YANG HILANG, TAMBAHKAN!
     */
    public function hasCustomAvatar()
    {
        return !is_null($this->avatar) && Storage::disk('public')->exists($this->avatar);
    }

    public function getAvatarPathAttribute()
    {
        return $this->avatar;
    }

    /**
     * ============== CEK ROLE ==============
     */
    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isAdminSekolah()
    {
        return $this->role === self::ROLE_ADMIN_SEKOLAH;
    }

    public function isGuru()
    {
        return $this->role === self::ROLE_GURU;
    }

    public function isWaliKelas()
    {
        if (!$this->isGuru()) {
            return false;
        }

        return ($this->teacher && $this->teacher->is_homeroom) || $this->waliKelas()->exists();
    }

    public function isSiswa()
    {
        return $this->role === self::ROLE_SISWA;
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function getRoleIndonesianAttribute()
    {
        $roles = [
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_ADMIN_SEKOLAH => 'Admin Sekolah',
            self::ROLE_GURU => 'Guru',
            self::ROLE_SISWA => 'Siswa',
        ];
        return $roles[$this->role] ?? $this->role;
    }

    
     /**
     * Kirim notifikasi reset password dengan custom template
     * ⬇️⬇️⬇️ TAMBAHKAN METHOD INI ⬇️⬇️⬇️
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    /**
     * ============== SCOPE ==============
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeBySchool($query, $schoolId)
    {
        return $query->where('school_id', $schoolId);
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    
    protected $fillable = [
        'name',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'email',
        'npsn',
        'school_level',
        'status',
        'registration_token',
        'verified_at',
        'verified_by',
        // TAMBAHKAN FIELD BARU UNTUK KARTU PELAJAR
        'kepala_sekolah',
        'nip_kepala_sekolah',
        'ttd_digital',
        'logo_sekolah',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_REJECTED = 'rejected';

    // School level constants
    const LEVEL_SD = 'sd';
    const LEVEL_SMP = 'smp';
    const LEVEL_SMA = 'sma';
    const LEVEL_SMK = 'smk';

    /**
     * RELASI KE TABEL LAIN
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function eskul()
    {
        return $this->hasMany(Eskul::class);
    }

    public function admin()
    {
        return $this->hasOne(User::class)->where('role', User::ROLE_ADMIN_SEKOLAH);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * ACCESSORS untuk Logo dan TTD
     */
    
    // URL Logo Sekolah (menggunakan public/uploads/logo)
    public function getLogoUrlAttribute()
    {
        if ($this->logo_sekolah) {
            // Cek di folder public/uploads/logo
            if (file_exists(public_path('uploads/logo/' . $this->logo_sekolah))) {
                return asset('uploads/logo/' . $this->logo_sekolah);
            }
            // Cek di folder storage (alternatif)
            if (file_exists(storage_path('app/public/logos/' . $this->logo_sekolah))) {
                return asset('storage/logos/' . $this->logo_sekolah);
            }
        }
        return null;
    }

    // URL Tanda Tangan Digital
    public function getTtdUrlAttribute()
    {
        if ($this->ttd_digital) {
            // Cek di folder public/uploads/ttd
            if (file_exists(public_path('uploads/ttd/' . $this->ttd_digital))) {
                return asset('uploads/ttd/' . $this->ttd_digital);
            }
            // Cek di folder storage (alternatif)
            if (file_exists(storage_path('app/public/ttd/' . $this->ttd_digital))) {
                return asset('storage/ttd/' . $this->ttd_digital);
            }
        }
        return null;
    }

    // Logo untuk display dengan fallback
    public function getLogoDisplayAttribute()
    {
        $logoUrl = $this->logo_url;
        if ($logoUrl) {
            return $logoUrl;
        }
        // Fallback ke UI Avatars
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name ?? 'S') . '&background=2A5C8A&color=fff&size=120';
    }

    // Nama sekolah untuk tampilan (alias dari name)
    public function getNamaSekolahAttribute()
    {
        return $this->name;
    }

    /**
     * STATUS METHODS
     */
    public function isVerified()
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_VERIFIED => 'Terverifikasi',
            self::STATUS_REJECTED => 'Ditolak',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_VERIFIED => 'badge-success',
            self::STATUS_REJECTED => 'badge-danger',
        ];
        return $classes[$this->status] ?? 'badge-secondary';
    }

    public function getSchoolLevelLabelAttribute()
    {
        $levels = [
            self::LEVEL_SD => 'SD / MI',
            self::LEVEL_SMP => 'SMP / MTs',
            self::LEVEL_SMA => 'SMA / MA',
            self::LEVEL_SMK => 'SMK',
        ];
        return $levels[$this->school_level] ?? '-';
    }
}
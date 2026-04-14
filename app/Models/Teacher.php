<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    
    protected $fillable = [
        'user_id',
        'school_id',
        'nip',
        'nuptk',
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'birth_place',
        'birth_date',
        'photo',
        'is_active',
        'is_homeroom',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
        'is_homeroom' => 'boolean',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke School
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Relasi ke Kelas (sebagai wali kelas)
    public function homeroom()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id', 'user_id');
    }

    /**
     * ACCESSOR - URL FOTO (DIPERBAIKI)
     */
    public function getPhotoUrlAttribute()
    {
        // Jika tidak ada foto, return default avatar
        if (!$this->photo) {
            return $this->getDefaultAvatarUrl();
        }
        
        // Cek di folder public/uploads/foto-guru (rekomendasi)
        if (file_exists(public_path('uploads/foto-guru/' . $this->photo))) {
            return asset('uploads/foto-guru/' . $this->photo);
        }
        
        // Cek di folder storage (jika pakai storage)
        if (file_exists(storage_path('app/public/teachers/' . $this->photo))) {
            return asset('storage/teachers/' . $this->photo);
        }
        
        // Jika file tidak ditemukan, return default avatar
        return $this->getDefaultAvatarUrl();
    }
    
    /**
     * Default avatar berdasarkan nama
     */
    public function getDefaultAvatarUrl()
    {
        $name = urlencode($this->name);
        $background = '2A5C8A';
        return "https://ui-avatars.com/api/?name={$name}&background={$background}&color=fff&size=100";
    }
    
    /**
     * Inisial nama untuk avatar placeholder
     */
    public function getAvatarInitialAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
            if (strlen($initials) >= 2) break;
        }
        
        return $initials ?: strtoupper(substr($this->name, 0, 2));
    }

    // Accessor untuk jenis kelamin dalam teks
    public function getGenderTextAttribute()
    {
        if ($this->gender == 'L') {
            return 'Laki-laki';
        } elseif ($this->gender == 'P') {
            return 'Perempuan';
        }
        return '-';
    }

    // Scope untuk filter aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk filter wali kelas
    public function scopeHomeroom($query)
    {
        return $query->where('is_homeroom', true);
    }
}
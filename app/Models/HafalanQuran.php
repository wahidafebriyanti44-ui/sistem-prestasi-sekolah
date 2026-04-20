<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HafalanQuran extends Model
{
    use HasFactory;

    protected $table = 'hafalan_quran';

    protected $fillable = [
        'siswa_id',
        'school_id',
        'is_active',
        'juz',
        'description',
        'start_date',
        'target_juz',
        'pembimbing'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date'
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke School
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Accessor untuk status hafalan
    public function getStatusTextAttribute()
    {
        if ($this->is_active) {
            return '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Aktif</span>';
        }
        return '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Tidak Aktif</span>';
    }

    // Accessor untuk info hafalan
    public function getHafalanInfoAttribute()
    {
        if ($this->is_active && $this->juz) {
            return "Juz {$this->juz}";
        }
        return '-';
    }
}
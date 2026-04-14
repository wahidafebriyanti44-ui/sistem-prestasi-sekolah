<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    use HasFactory;

    protected $table = 'eskul';
    
    protected $fillable = [
        'school_id',
        'nama_eskul',
        'pembina'
    ];

    /**
     * RELASI KE TABEL LAIN
     */
    
    // Many to One: Eskul milik satu sekolah
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Many to Many: Eskul diikuti banyak siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_eskul')
                    ->withPivot('tahun_masuk', 'keterangan')
                    ->withTimestamps();
    }

    /**
     * ACCESSORS
     */
    public function getJumlahAnggotaAttribute()
    {
        return $this->siswa()->count();
    }

    public function getLogoUrlAttribute()
    {
        // Untuk logo eskul jika ada
        return null;
    }

    /**
     * SCOPE
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_eskul', 'like', "%{$search}%");
    }
}
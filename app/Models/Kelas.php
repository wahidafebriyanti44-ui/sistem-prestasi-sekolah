<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $fillable = [
        'school_id',
        'nama_kelas',
        'tingkat',
        'wali_kelas_id'
    ];

    /**
     * RELASI KE TABEL LAIN
     */
    
    // Many to One: Kelas milik satu sekolah
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Many to One: Kelas punya satu wali kelas (User)
    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    // One to Many: Satu kelas punya banyak siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    /**
     * ACCESSORS
     */
    public function getJumlahSiswaAttribute()
    {
        return $this->siswa()->count();
    }

    public function getNamaLengkapAttribute()
    {
        return $this->nama_kelas . ' (' . $this->tingkat . ')';
    }

    /**
     * SCOPE
     */
    public function scopeTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }
}
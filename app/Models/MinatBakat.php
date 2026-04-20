<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatBakat extends Model
{
    use HasFactory;

    protected $table = 'minat_bakat';
    
    protected $fillable = [
        'school_id',
        'nama_minat',
        'kategori'
    ];

    // Relasi ke sekolah
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_minat_bakat')
                    ->withTimestamps();
    }
}
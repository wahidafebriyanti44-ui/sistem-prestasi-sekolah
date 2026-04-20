<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';
    protected $fillable = ['kode', 'provinsi_id', 'nama'];
    
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}
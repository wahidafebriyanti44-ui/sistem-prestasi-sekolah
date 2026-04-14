<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    
    protected $fillable = [
        'school_id',
        'kelas_id',
        'user_id',
        'nis',
        'nisn',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'foto',
        'mata_pelajaran_favorit',   
        'nama_ayah',        // <-- TAMBAHKAN INI
        'nama_ibu',         // <-- TAMBAHKAN INI
        'no_hp_orangtua',   // <-- TAMBAHKAN INI
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    /**
     * RELASI KE TABEL LAIN
     */
    
    // Many to One: Siswa milik satu sekolah
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Many to One: Siswa berada di satu kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // One to One: Siswa punya satu akun user (untuk login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One to Many: Satu siswa punya banyak prestasi
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    // Many to Many: Siswa ikut banyak eskul (dengan tabel pivot siswa_eskul)
    public function eskul()
    {
        return $this->belongsToMany(Eskul::class, 'siswa_eskul')
                    ->withPivot('tahun_masuk', 'keterangan')
                    ->withTimestamps();
    }

    // Many to Many: Siswa punya banyak minat bakat (dengan tabel pivot siswa_minat_bakat)
    public function minatBakat()
    {
        return $this->belongsToMany(MinatBakat::class, 'siswa_minat_bakat')
                    ->withTimestamps();
    }

    // One to One: Siswa punya satu data hafalan quran
    public function hafalanQuran()
    {
         return $this->hasOne(HafalanQuran::class);
    }
    
    /**
     * ACCESSORS & MUTATORS
     */
    
    // URL foto - VERSI BARU (public/uploads)
    public function getFotoUrlAttribute()
    {
        if ($this->foto && file_exists(public_path('uploads/foto-siswa/' . $this->foto))) {
            return asset('uploads/foto-siswa/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * ACCESSORS UNTUK TAMPILAN HOME (FOTO PROFIL SISWA)
     */
    
    // Foto profil URL (untuk tampilan home) - return null jika tidak ada foto
    public function getFotoProfilUrlAttribute()
    {
        if ($this->foto && file_exists(public_path('uploads/foto-siswa/' . $this->foto))) {
            return asset('uploads/foto-siswa/' . $this->foto);
        }
        return null;
    }

    // Avatar initial (inisial nama) untuk placeholder jika tidak ada foto
    public function getAvatarInitialAttribute()
    {
        $words = explode(' ', $this->nama_lengkap);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
            if (strlen($initials) >= 2) break;
        }
        
        return $initials ?: strtoupper(substr($this->nama_lengkap, 0, 2));
    }

    // Umur siswa
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : null;
    }

    // Nama lengkap dengan NIS
    public function getNamaWithNisAttribute()
    {
        return $this->nama_lengkap . ' (' . $this->nis . ')';
    }

    // Jenis kelamin dalam teks
    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Status akun
    public function getStatusAkunAttribute()
    {
        if ($this->user_id) {
            return $this->user->is_active ? 'Aktif' : 'Nonaktif';
        }
        return 'Belum Punya Akun';
    }

    // Badge status akun (untuk view)
    public function getStatusAkunBadgeAttribute()
    {
        if (!$this->user_id) {
            return '<span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">Belum Punya Akun</span>';
        }
        
        return $this->user->is_active 
            ? '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Akun Aktif</span>'
            : '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Akun Nonaktif</span>';
    }

    /**
     * SCOPE (FILTER)
     */
    
    // Filter berdasarkan kelas
    public function scopeKelas($query, $kelasId)
    {
        return $query->where('kelas_id', $kelasId);
    }

    // Filter berdasarkan jenis kelamin
    public function scopeJenisKelamin($query, $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    // Filter berdasarkan pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_lengkap', 'like', "%{$search}%")
                     ->orWhere('nis', 'like', "%{$search}%")
                     ->orWhere('nisn', 'like', "%{$search}%");
    }

    // Filter siswa yang sudah punya akun
    public function scopeSudahPunyaAkun($query)
    {
        return $query->whereNotNull('user_id');
    }

    // Filter siswa yang belum punya akun
    public function scopeBelumPunyaAkun($query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * BOOT (EVENT)
     */
    protected static function booted()
    {
        static::deleting(function ($siswa) {
            // Hapus foto dari folder public/uploads/foto-siswa
            if ($siswa->foto && file_exists(public_path('uploads/foto-siswa/' . $siswa->foto))) {
                unlink(public_path('uploads/foto-siswa/' . $siswa->foto));
            }
            
            // Hapus user terkait jika ada
            if ($siswa->user_id) {
                $siswa->user->delete();
            }
        });
    }
}
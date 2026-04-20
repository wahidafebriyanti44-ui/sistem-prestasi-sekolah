<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    
    protected $fillable = [
        'siswa_id',
        'jenis_prestasi',
        'nama_lomba',
        'tingkat',
        'peringkat',
        'tahun',
        'deskripsi',
        'file_sertifikat',
        'status',
        'diverifikasi_oleh',
        'provinsi_id',      // <=== TAMBAHKAN INI
        'kabupaten_id'      // <=== TAMBAHKAN INI
    ];

    protected $casts = [
        'tahun' => 'integer',
        'provinsi_id' => 'integer',
        'kabupaten_id' => 'integer'
    ];

    /**
     * RELASI KE TABEL LAIN
     */
    
    // Many to One: Prestasi milik satu siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Many to One: Prestasi diverifikasi oleh satu user
    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    /**
     * RELASI INDOREGION
     */
    
    // Relasi ke provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    // Relasi ke kabupaten
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    /**
     * ACCESSORS
     */
    
    // URL sertifikat - CEK DI BEBERAPA LOKASI
    public function getSertifikatUrlAttribute()
    {
        if (!$this->file_sertifikat) {
            return null;
        }
        
        // Cek di public/uploads/sertifikat (prioritas)
        if (file_exists(public_path('uploads/sertifikat/' . $this->file_sertifikat))) {
            return asset('uploads/sertifikat/' . $this->file_sertifikat);
        }
        
        // Cek di public/storage/sertifikat
        if (file_exists(public_path('storage/sertifikat/' . $this->file_sertifikat))) {
            return asset('storage/sertifikat/' . $this->file_sertifikat);
        }
        
        // Cek di storage/app/public/sertifikat
        if (file_exists(storage_path('app/public/sertifikat/' . $this->file_sertifikat))) {
            return asset('storage/sertifikat/' . $this->file_sertifikat);
        }
        
        // File tidak ditemukan
        return null;
    }

    // Cek apakah file sertifikat ada
    public function getSertifikatExistsAttribute()
    {
        if (!$this->file_sertifikat) {
            return false;
        }
        
        return file_exists(public_path('uploads/sertifikat/' . $this->file_sertifikat)) ||
               file_exists(public_path('storage/sertifikat/' . $this->file_sertifikat)) ||
               file_exists(storage_path('app/public/sertifikat/' . $this->file_sertifikat));
    }

    // Path lengkap file sertifikat
    public function getSertifikatPathAttribute()
    {
        if (!$this->file_sertifikat) {
            return null;
        }
        
        if (file_exists(public_path('uploads/sertifikat/' . $this->file_sertifikat))) {
            return public_path('uploads/sertifikat/' . $this->file_sertifikat);
        }
        
        if (file_exists(public_path('storage/sertifikat/' . $this->file_sertifikat))) {
            return public_path('storage/sertifikat/' . $this->file_sertifikat);
        }
        
        if (file_exists(storage_path('app/public/sertifikat/' . $this->file_sertifikat))) {
            return storage_path('app/public/sertifikat/' . $this->file_sertifikat);
        }
        
        return null;
    }

    /**
     * GETTER UNTUK NAMA WILAYAH (PROVINSI + KABUPATEN)
     */
    
    // Nama provinsi
    public function getNamaProvinsiAttribute()
    {
        return $this->provinsi ? $this->provinsi->nama : '-';
    }

    // Nama kabupaten
    public function getNamaKabupatenAttribute()
    {
        return $this->kabupaten ? $this->kabupaten->nama : '-';
    }

    // Wilayah lengkap (Kabupaten, Provinsi)
    public function getWilayahLengkapAttribute()
    {
        if ($this->kabupaten && $this->provinsi) {
            return $this->kabupaten->nama . ', ' . $this->provinsi->nama;
        }
        if ($this->provinsi) {
            return $this->provinsi->nama;
        }
        return '-';
    }

    /**
     * GETTER UNTUK RANK CLASS (WARNA BADGE) - UNTUK TAMPILAN HOME
     */
    public function getRankClassAttribute()
    {
        $peringkat = strtolower($this->peringkat);
        
        if (str_contains($peringkat, '1') || str_contains($peringkat, 'emas') || str_contains($peringkat, 'gold')) {
            return 'rank-gold';
        }
        
        if (str_contains($peringkat, '2') || str_contains($peringkat, 'perak') || str_contains($peringkat, 'silver')) {
            return 'rank-silver';
        }
        
        if (str_contains($peringkat, '3') || str_contains($peringkat, 'perunggu') || str_contains($peringkat, 'bronze')) {
            return 'rank-bronze';
        }
        
        return '';
    }

    /**
     * GETTER UNTUK FOTO DOKUMENTASI LOMBA
     * Untuk menyimpan foto dokumentasi, nanti bisa ditambahkan field 'foto_dokumentasi' di migration
     * Untuk sementara return array kosong
     */
    public function getFotoDokumentasiAttribute()
    {
        // Jika nanti sudah menambahkan field foto_dokumentasi, gunakan kode ini:
        // if (!$this->foto_dokumentasi) {
        //     return [];
        // }
        // $fotos = explode(',', $this->foto_dokumentasi);
        // $result = [];
        // foreach ($fotos as $foto) {
        //     $foto = trim($foto);
        //     if (file_exists(public_path('uploads/dokumentasi/' . $foto))) {
        //         $result[] = asset('uploads/dokumentasi/' . $foto);
        //     } else {
        //         $result[] = asset('images/no-image.png');
        //     }
        // }
        // return $result;
        
        // Untuk sementara return array kosong
        return [];
    }

    /**
     * GETTER UNTUK PENYELENGGARA LOMBA
     * Bisa ditambahkan field 'penyelenggara' di migration nanti
     */
    public function getPenyelenggaraAttribute()
    {
        // Jika nanti sudah menambahkan field penyelenggara:
        // return $this->penyelenggara;
        
        // Untuk sementara return null
        return null;
    }

    /**
     * GETTER UNTUK LOKASI LOMBA (DARI WILAYAH)
     * Sekarang menggunakan data provinsi dan kabupaten
     */
    public function getLokasiLombaAttribute()
    {
        return $this->wilayah_lengkap;
    }

    /**
     * GETTER UNTUK NARASI CERITA (MENGGUNAKAN FIELD DESKRIPSI)
     */
    public function getNarasiAttribute()
    {
        return $this->deskripsi ?? 'Tidak ada deskripsi untuk prestasi ini.';
    }

    // Badge status
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu Verifikasi</span>',
            'diverifikasi' => '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Terverifikasi</span>',
            default => '<span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">' . $this->status . '</span>'
        };
    }

    // Badge jenis prestasi
    public function getJenisPrestasiBadgeAttribute()
    {
        return $this->jenis_prestasi == 'akademik'
            ? '<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Akademik</span>'
            : '<span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">Non Akademik</span>';
    }

    // Badge tingkat
    public function getTingkatBadgeAttribute()
    {
        $colors = [
            'sekolah' => 'gray',
            'kecamatan' => 'blue',
            'kabupaten' => 'green',
            'provinsi' => 'purple',
            'nasional' => 'orange',
            'internasional' => 'red'
        ];
        
        $color = $colors[$this->tingkat] ?? 'gray';
        
        return "<span class=\"px-2 py-1 bg-{$color}-100 text-{$color}-800 rounded-full text-xs\">" . ucfirst($this->tingkat) . "</span>";
    }

    /**
     * SCOPE (FILTER)
     */
    
    // Filter status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Filter tahun
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    // Filter jenis prestasi
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis_prestasi', $jenis);
    }

    // Filter tingkat
    public function scopeTingkat($query, $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }

    // Filter provinsi
    public function scopeProvinsi($query, $provinsiId)
    {
        return $query->where('provinsi_id', $provinsiId);
    }

    // Filter kabupaten
    public function scopeKabupaten($query, $kabupatenId)
    {
        return $query->where('kabupaten_id', $kabupatenId);
    }

    // Yang belum diverifikasi
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Yang sudah diverifikasi
    public function scopeTerverifikasi($query)
    {
        return $query->where('status', 'diverifikasi');
    }
}
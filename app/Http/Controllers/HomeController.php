<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\School;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman Home - Menampilkan dashboard utama
     */
    public function index()
    {
        // Ambil tahun terbaru yang ada di database (prestasi yang sudah diverifikasi)
        $tahunTerbaru = Prestasi::where('status', 'diverifikasi')->max('tahun');
        
        // Jika tidak ada prestasi sama sekali, set default ke tahun sekarang
        if (!$tahunTerbaru) {
            $tahunTerbaru = date('Y');
        }
        
        // Ambil prestasi dengan tahun terbaru saja
        $prestasiTerbaru = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->where('tahun', $tahunTerbaru)
            ->latest()
            ->take(6)
            ->get();
        
        return view('home', [
            'totalSekolah'    => School::count(),
            'totalSiswa'      => Siswa::count(),
            'totalPrestasi'   => Prestasi::where('status', 'diverifikasi')->count(),
            'prestasiTerbaru' => $prestasiTerbaru,
            'tahunDitampilkan' => $tahunTerbaru,
        ]);
    }

    /**
     * Halaman Detail Prestasi
     */
    public function detailPrestasi($id)
    {
        $prestasi = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->findOrFail($id);
        
        $prestasiLainnya = Prestasi::with(['siswa'])
            ->where('siswa_id', $prestasi->siswa_id)
            ->where('id', '!=', $id)
            ->where('status', 'diverifikasi')
            ->orderBy('tahun', 'desc')
            ->take(3)
            ->get();
        
        return view('prestasi-detail', compact('prestasi', 'prestasiLainnya'));
    }

    /**
     * Halaman Semua Prestasi (GALERI)
     * Menampilkan SEMUA prestasi, bisa difilter
     */
    public function semuaPrestasi(Request $request)
    {
        $query = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc');
        
        // Pencarian (keyword)
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function($q) use ($keyword) {
                $q->where('nama_lomba', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%")
                  ->orWhereHas('siswa', function($sq) use ($keyword) {
                      $sq->where('nama_lengkap', 'like', "%{$keyword}%");
                  });
            });
        }

        // Filter berdasarkan sekolah
        if ($request->filled('school_id')) {
            $schoolId = $request->school_id;
            $query->whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            });
        }
        
        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        
        // Filter berdasarkan jenis prestasi
        if ($request->filled('jenis')) {
            $query->where('jenis_prestasi', $request->jenis);
        }
        
        // Filter berdasarkan tingkat
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }
        
        $prestasi = $query->paginate(12)->withQueryString();
        
        // Data untuk filter tahun
        $tahunList = Prestasi::where('status', 'diverifikasi')
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
        
        // === PERBAIKAN: Ambil SEMUA sekolah (tanpa filter status) ===
        // Karena mungkin status sekolah masih pending atau belum di-set
        $sekolahList = School::orderBy('name', 'asc')->get();
        
        // Atau jika tetap ingin filter, gunakan ini:
        // $sekolahList = School::where('status', 'verified')->orderBy('name', 'asc')->get();
        
        return view('prestasi-semua', compact('prestasi', 'tahunList', 'sekolahList'));
    }

    /**
     * API untuk load lebih banyak prestasi (AJAX)
     */
    public function loadMorePrestasi(Request $request)
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 6);
        
        $prestasi = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $prestasi
        ]);
    }

    /**
     * Halaman Prestasi berdasarkan siswa
     */
    public function prestasiBySiswa($siswaId)
    {
        $siswa = Siswa::with('school')->findOrFail($siswaId);
        
        $prestasi = Prestasi::with(['siswa.school'])
            ->where('siswa_id', $siswaId)
            ->where('status', 'diverifikasi')
            ->orderBy('tahun', 'desc')
            ->paginate(10);
        
        return view('prestasi-siswa', compact('siswa', 'prestasi'));
    }

    /**
     * Halaman Prestasi berdasarkan sekolah
     */
    public function prestasiBySekolah($sekolahId)
    {
        $sekolah = School::findOrFail($sekolahId);
        
        $prestasi = Prestasi::with(['siswa.school'])
            ->whereHas('siswa', function($query) use ($sekolahId) {
                $query->where('school_id', $sekolahId);
            })
            ->where('status', 'diverifikasi')
            ->orderBy('tahun', 'desc')
            ->paginate(10);
        
        return view('prestasi-sekolah', compact('sekolah', 'prestasi'));
    }

    /**
     * Pencarian Prestasi
     */
    public function cariPrestasi(Request $request)
    {
        $keyword = $request->get('q');
        
        $prestasi = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->where(function($query) use ($keyword) {
                $query->where('nama_lomba', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%")
                    ->orWhereHas('siswa', function($q) use ($keyword) {
                        $q->where('nama_lengkap', 'like', "%{$keyword}%");
                    });
            })
            ->orderBy('tahun', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('prestasi-cari', compact('prestasi', 'keyword'));
    }
}
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
        return view('home', [
            'totalSekolah'    => School::count(),
            'totalSiswa'      => Siswa::count(),
            'totalPrestasi'   => Prestasi::where('status', 'diverifikasi')->count(),
            'prestasiTerbaru' => Prestasi::with(['siswa.school'])
                ->where('status', 'diverifikasi')
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }

    /**
     * Halaman Detail Prestasi
     * Menampilkan detail lengkap prestasi termasuk narasi dan dokumentasi
     */
    public function detailPrestasi($id)
    {
        // Ambil data prestasi dengan relasi siswa dan school
        $prestasi = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->findOrFail($id);
        
        // Ambil prestasi lain dari siswa yang sama (untuk rekomendasi)
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
     * Halaman Semua Prestasi
     * Menampilkan semua prestasi dengan filter
     */
    public function semuaPrestasi(Request $request)
    {
        $query = Prestasi::with(['siswa.school'])
            ->where('status', 'diverifikasi')
            ->orderBy('created_at', 'desc');
        
        // Pencarian (keyword)
        if ($request->has('q') && $request->q) {
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
        if ($request->has('school_id') && $request->school_id) {
            $schoolId = $request->school_id;
            $query->whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            });
        }
        
        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        
        // Filter berdasarkan jenis prestasi
        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_prestasi', $request->jenis);
        }
        
        // Filter berdasarkan tingkat
        if ($request->has('tingkat') && $request->tingkat) {
            $query->where('tingkat', $request->tingkat);
        }
        
        $prestasi = $query->paginate(12)->withQueryString();
        
        // Data untuk filter
        $tahunList = Prestasi::where('status', 'diverifikasi')
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
            
        $sekolahList = School::where('status', School::STATUS_VERIFIED)
            ->orderBy('name', 'asc')
            ->get();
        
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
            ->latest()
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
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('prestasi-cari', compact('prestasi', 'keyword'));
    }
}
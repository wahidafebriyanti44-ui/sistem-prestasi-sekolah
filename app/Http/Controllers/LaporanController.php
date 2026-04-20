<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\School;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\User;           // <-- TAMBAHKAN INI
use App\Models\Kelas;          // <-- TAMBAHKAN INI
use App\Models\Eskul;          // <-- TAMBAHKAN INI
use App\Models\MinatBakat;     // <-- TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // <-- TAMBAHKAN INI UNTUK PDF

class LaporanController extends Controller
{
    /**
     * Halaman utama laporan
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Cek akses
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Query dasar prestasi
        $query = Prestasi::with(['siswa', 'siswa.kelas', 'siswa.school', 'verifikator']);
        
        // Filter berdasarkan sekolah (kecuali super admin)
        if ($user->role != 'super_admin') {
            $query->whereHas('siswa', function($q) use ($user) {
                $q->where('school_id', $user->school_id);
            });
        }
        
        // Filter berdasarkan tanggal mulai
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }
        
        // Filter berdasarkan tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan jenis prestasi
        if ($request->filled('jenis')) {
            $query->where('jenis_prestasi', $request->jenis);
        }
        
        // Filter berdasarkan tingkat
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }
        
        // Filter berdasarkan provinsi
        if ($request->filled('provinsi_id')) {
            $query->where('provinsi_id', $request->provinsi_id);
        }
        
        // Ambil data dengan pagination
        $prestasi = $query->latest()->paginate(15)->withQueryString();
        
        // Data untuk filter provinsi
        $provinsiList = Provinsi::orderBy('nama')->get();
        
        return view('laporan.index', compact('prestasi', 'provinsiList'));
    }

    /**
     * PDF Laporan Detail Siswa
     */
    public function pdfSiswa($id)
    {
        $user = Auth::user();
        $siswa = Siswa::with(['kelas.waliKelas', 'prestasi', 'eskul', 'minatBakat', 'school'])->findOrFail($id);
        
        // Cek akses
        if ($user->role != 'super_admin' && $user->school_id != $siswa->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data siswa ini.');
        }
        
        $data = [
            'siswa' => $siswa,
            'totalPrestasi' => $siswa->prestasi->count(),
            'prestasiTerverifikasi' => $siswa->prestasi->where('status', 'diverifikasi')->count(),
            'prestasiPending' => $siswa->prestasi->where('status', 'pending')->count(),
            'school' => $siswa->school,
            'title' => 'Laporan Data Siswa - ' . $siswa->nama_lengkap,
            'date' => now()->format('d F Y')
        ];
        
        $pdf = Pdf::loadView('laporan.pdf.siswa', $data);
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('Laporan_Siswa_' . $siswa->nama_lengkap . '.pdf');
    }

    /**
     * PDF Laporan Sekolah (untuk Admin Sekolah)
     */
    public function pdfSekolah()
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat mengakses laporan ini.');
        }
        
        $schoolId = $user->school_id;
        $school = School::findOrFail($schoolId);
        
        $data = [
            'school' => $school,
            'totalSiswa' => Siswa::where('school_id', $schoolId)->count(),
            'totalPrestasi' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->count(),
            'totalGuru' => User::where('school_id', $schoolId)->where('role', 'guru')->count(),
            'totalKelas' => Kelas::where('school_id', $schoolId)->count(),
            'totalEskul' => Eskul::where('school_id', $schoolId)->count(),
            'totalMinat' => MinatBakat::where('school_id', $schoolId)->count(),
            'prestasiPending' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->where('status', 'pending')->count(),
            'prestasiTerverifikasi' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->where('status', 'diverifikasi')->count(),
            'siswaPerKelas' => Kelas::where('school_id', $schoolId)
                ->withCount('siswa')
                ->get(),
            'prestasiPerTingkat' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->selectRaw('tingkat, count(*) as total')
                ->groupBy('tingkat')
                ->get(),
            'prestasiPerTahun' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->selectRaw('tahun, count(*) as total')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->get(),
            'title' => 'Laporan Data Sekolah - ' . $school->name,
            'date' => now()->format('d F Y')
        ];
        
        $pdf = Pdf::loadView('laporan.pdf.sekolah', $data);
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('Laporan_Sekolah_' . $school->name . '.pdf');
    }

    /**
     * PDF Laporan Super Admin (Statistik Nasional)
     */
    public function pdfSuperAdmin()
    {
        $user = Auth::user();
        
        if ($user->role != 'super_admin') {
            abort(403, 'Hanya Super Admin yang dapat mengakses laporan ini.');
        }
        
        $data = [
            'totalSekolah' => School::count(),
            'totalSiswa' => Siswa::count(),
            'totalPrestasi' => Prestasi::count(),
            'totalGuru' => User::where('role', 'guru')->count(),
            'totalAdmin' => User::where('role', 'admin_sekolah')->count(),
            'totalKelas' => Kelas::count(),
            'totalEskul' => Eskul::count(),
            'totalMinat' => MinatBakat::count(),
            'prestasiPending' => Prestasi::where('status', 'pending')->count(),
            'prestasiTerverifikasi' => Prestasi::where('status', 'diverifikasi')->count(),
            'prestasiPerTingkat' => Prestasi::selectRaw('tingkat, count(*) as total')
                ->groupBy('tingkat')
                ->get(),
            'prestasiPerTahun' => Prestasi::selectRaw('tahun, count(*) as total')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->get(),
            'prestasiPerJenis' => Prestasi::selectRaw('jenis_prestasi, count(*) as total')
                ->groupBy('jenis_prestasi')
                ->get(),
            'sekolahTeraktif' => School::withCount('siswa')
                ->orderBy('siswa_count', 'desc')
                ->take(10)
                ->get(),
            'title' => 'Laporan Statistik Nasional SIPRES',
            'date' => now()->format('d F Y')
        ];
        
        $pdf = Pdf::loadView('laporan.pdf.super_admin', $data);
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('Laporan_Statistik_Nasional_SIPRES.pdf');
    }

    /**
     * PDF Laporan Semua Siswa (untuk Admin Sekolah)
     */
    public function pdfSemuaSiswa()
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat mengakses laporan ini.');
        }
        
        $schoolId = $user->school_id;
        $siswa = Siswa::with(['kelas'])->where('school_id', $schoolId)->orderBy('nama_lengkap')->get();
        
        $data = [
            'siswa' => $siswa,
            'totalSiswa' => $siswa->count(),
            'school' => School::find($schoolId),
            'title' => 'Laporan Data Semua Siswa',
            'date' => now()->format('d F Y')
        ];
        
        $pdf = Pdf::loadView('laporan.pdf.semua_siswa', $data);
        $pdf->setPaper('a4', 'landscape');
        
        return $pdf->download('Laporan_Semua_Siswa.pdf');
    }
}
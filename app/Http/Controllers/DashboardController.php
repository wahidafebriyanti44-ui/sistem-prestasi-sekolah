<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Kelas;
use App\Models\User;
use App\Models\School; // <-- TAMBAHKAN INI (PENTING!)
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard sesuai role user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Cek role user
        if ($user->role == 'super_admin') {
            return $this->superAdmin(); // <-- PERBAIKAN: panggil superAdmin(), bukan superAdminDashboard()
        } elseif ($user->role == 'admin_sekolah') {
            return $this->adminSekolahDashboard();
        } elseif ($user->role == 'guru') {
            return $this->guruDashboard();
        } elseif ($user->role == 'siswa') {
            return $this->siswaDashboard();
        } else {
            // Role tidak dikenal
            abort(403, 'Role tidak valid');
        }
    }

    /**
     * Dashboard untuk Super Admin
     */
    public function superAdmin() // <-- NAMA METHOD INI YANG HARUS DIPANGGIL
    {
        // Pastikan model School sudah di-import di atas (use App\Models\School;)
        $totalSekolah = School::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalAdmin = User::where('role', 'admin_sekolah')->count();
        $totalSiswa = Siswa::count();
        $totalPrestasi = Prestasi::count();
        
        // Hitung statistik prestasi berdasarkan tingkat
        $prestasiSekolah = Prestasi::where('tingkat', 'sekolah')->count();
        $prestasiKabKota = Prestasi::whereIn('tingkat', ['kabupaten', 'kota'])->count();
        $prestasiProvinsi = Prestasi::where('tingkat', 'provinsi')->count();
        $prestasiNasional = Prestasi::where('tingkat', 'nasional')->count();
        $prestasiInternasional = Prestasi::where('tingkat', 'internasional')->count();

        // Ambil 5 sekolah terbaru
        $sekolahTerbaru = School::latest()->take(5)->get();
        
        // Ambil 5 prestasi terbaru dengan relasi siswa
        $prestasiTerbaru = Prestasi::with('siswa')->latest()->take(5)->get();
        
        $data = [
            'totalSekolah' => $totalSekolah,
            'totalGuru' => $totalGuru,
            'totalAdmin' => $totalAdmin,
            'totalSiswa' => $totalSiswa,
            'totalPrestasi' => $totalPrestasi,
            'prestasiSekolah' => $prestasiSekolah,
            'prestasiKabKota' => $prestasiKabKota,
            'prestasiProvinsi' => $prestasiProvinsi,
            'prestasiNasional' => $prestasiNasional,
            'prestasiInternasional' => $prestasiInternasional,
            'sekolahTerbaru' => $sekolahTerbaru,
            'prestasiTerbaru' => $prestasiTerbaru,
        ];
        
        return view('dashboard.super_admin', $data);
    }

    /**
     * Dashboard untuk Admin Sekolah
     */
    private function adminSekolahDashboard()
    {
        $schoolId = Auth::user()->school_id;
        
        $data = [
            'totalSiswa' => Siswa::where('school_id', $schoolId)->count(),
            'totalGuru' => User::where('school_id', $schoolId)->where('role', 'guru')->count(),
            'totalKelas' => Kelas::where('school_id', $schoolId)->count(),
            'totalPrestasi' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->count(),
            'prestasiPending' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->where('status', 'pending')->count(),
            'prestasiTerverifikasi' => Prestasi::whereHas('siswa', function($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })->where('status', 'diverifikasi')->count(),
            'siswaPerKelas' => Kelas::where('school_id', $schoolId)
                ->withCount('siswa')
                ->get(),
            'prestasiTerbaru' => Prestasi::with('siswa')
                ->whereHas('siswa', function($q) use ($schoolId) {
                    $q->where('school_id', $schoolId);
                })
                ->latest()
                ->take(5)
                ->get(),
        ];
        
        return view('dashboard.admin_sekolah', $data);
    }

    /**
     * Dashboard untuk Guru
     */
    private function guruDashboard()
    {
        $user = Auth::user();
        
        // 1. Ambil data guru dari tabel teachers
        $teacher = Teacher::where('user_id', $user->id)->first();
        
        // 2. Cari kelas yang diampu sebagai wali kelas
        $kelasWali = Kelas::where('wali_kelas_id', $user->id)->first();
        
        // 3. Tentukan status wali kelas
        $isHomeroom = false;
        if ($kelasWali) {
            $isHomeroom = true;
        }
        
        // 4. Inisialisasi variabel default
        $totalSiswa = 0;
        $siswaLaki = 0;
        $siswaPerempuan = 0;
        $totalPrestasi = 0;
        $prestasiPending = 0;
        $prestasiBulanIni = 0;
        $siswaTerbaru = [];
        $prestasiTerbaru = [];
        
        // 5. Jika guru adalah wali kelas, hitung data dari kelasnya
        if ($kelasWali) {
            // Ambil semua siswa di kelas ini
            $siswaIds = $kelasWali->siswa()->pluck('id');
            $totalSiswa = $siswaIds->count();
            
            // Hitung siswa berdasarkan jenis kelamin
            $siswaLaki = $kelasWali->siswa()->where('jenis_kelamin', 'L')->count();
            $siswaPerempuan = $kelasWali->siswa()->where('jenis_kelamin', 'P')->count();
            
            // Ambil siswa terbaru (5 terakhir)
            $siswaTerbaru = $kelasWali->siswa()->latest()->take(5)->get();
            
            // Hitung total prestasi dari semua siswa di kelas ini
            $totalPrestasi = Prestasi::whereIn('siswa_id', $siswaIds)->count();
            
            // Hitung prestasi pending
            $prestasiPending = Prestasi::whereIn('siswa_id', $siswaIds)
                ->where('status', 'pending')
                ->count();
            
            // Hitung prestasi bulan ini
            $prestasiBulanIni = Prestasi::whereIn('siswa_id', $siswaIds)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
            
            // Ambil 5 prestasi terbaru dari siswa di kelas ini
            $prestasiTerbaru = Prestasi::with('siswa')
                ->whereIn('siswa_id', $siswaIds)
                ->latest()
                ->take(5)
                ->get();
        } else {
            // Jika bukan wali kelas, tampilkan semua prestasi di sekolahnya (opsional)
            $schoolId = $user->school_id;
            
            // Ambil 5 prestasi terbaru di sekolah (untuk guru biasa)
            $prestasiTerbaru = Prestasi::with('siswa')
                ->whereHas('siswa', function($q) use ($schoolId) {
                    $q->where('school_id', $schoolId);
                })
                ->latest()
                ->take(5)
                ->get();
        }
        
        // 6. Data lengkap untuk dikirim ke view
        $data = [
            'user' => $user,
            'teacher' => $teacher,
            'isHomeroom' => $isHomeroom,
            'kelasWali' => $kelasWali,
            'totalSiswa' => $totalSiswa,
            'siswaLaki' => $siswaLaki,
            'siswaPerempuan' => $siswaPerempuan,
            'totalPrestasi' => $totalPrestasi,
            'prestasiPending' => $prestasiPending,
            'prestasiBulanIni' => $prestasiBulanIni,
            'siswaTerbaru' => $siswaTerbaru,
            'prestasiTerbaru' => $prestasiTerbaru,
        ];
        
        return view('dashboard.guru', $data);
    }

    /**
     * Dashboard untuk Siswa
     */
    private function siswaDashboard()
    {
        $user = Auth::user();
        
        // Ambil data siswa berdasarkan user_id
        $siswa = Siswa::where('user_id', $user->id)->first();
        
        $data = [
            'siswa' => $siswa,
            'totalPrestasi' => $siswa ? $siswa->prestasi()->count() : 0,
            'prestasiTerverifikasi' => $siswa ? $siswa->prestasi()->where('status', 'diverifikasi')->count() : 0,
            'prestasiPending' => $siswa ? $siswa->prestasi()->where('status', 'pending')->count() : 0,
            'eskulDiikuti' => $siswa ? $siswa->eskul()->get() : [],
            'minatSiswa' => $siswa ? $siswa->minatBakat()->get() : [],
        ];
        
        return view('dashboard.siswa', $data);
    }
}
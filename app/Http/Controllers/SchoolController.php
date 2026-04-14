<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek akses manual - hanya super admin
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access. Hanya Super Admin yang dapat mengakses halaman ini.');
        }
        
        $schools = School::latest()->paginate(10);
        return view('schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek akses manual
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access. Hanya Super Admin yang dapat mengakses halaman ini.');
        }
        
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek akses manual
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access. Hanya Super Admin yang dapat mengakses halaman ini.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'required|string|unique:schools,npsn|max:20',
            'email' => 'required|email|unique:schools,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'school_level' => 'nullable|string|in:sd,smp,sma,smk',
            'kepala_sekolah' => 'nullable|string|max:255',
            'nip_kepala_sekolah' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['status'] = School::STATUS_PENDING;
        
        School::create($data);

        return redirect()->route('schools.index')
            ->with('success', 'Sekolah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        // Cek akses manual - super admin atau admin sekolah yang bersangkutan
        $user = Auth::user();
        
        if ($user->role === 'super_admin') {
            // Super admin bisa lihat semua
        } elseif ($user->role === 'admin_sekolah' && $user->school_id == $school->id) {
            // Admin sekolah bisa lihat sekolahnya sendiri
        } else {
            abort(403, 'Unauthorized access. Anda tidak memiliki akses ke halaman ini.');
        }
        
        $school->load(['users', 'kelas', 'siswa']);
        
        $stats = [
            'totalGuru' => $school->users()->where('role', 'guru')->count(),
            'totalAdmin' => $school->users()->where('role', 'admin_sekolah')->count(),
            'totalSiswa' => $school->siswa()->count(),
            'totalKelas' => $school->kelas()->count(),
        ];
        
        return view('schools.show', compact('school', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        // Cek akses manual - super admin atau admin sekolah yang bersangkutan
        $user = Auth::user();
        
        if ($user->role === 'super_admin') {
            // Super admin bisa edit semua
            return view('schools.edit', compact('school'));
        } elseif ($user->role === 'admin_sekolah' && $user->school_id == $school->id) {
            // Admin sekolah bisa edit sekolahnya sendiri
            return view('schools.edit', compact('school'));
        }
        
        abort(403, 'Unauthorized access. Anda tidak memiliki akses ke halaman ini.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        // Cek akses manual - super admin atau admin sekolah yang bersangkutan
        $user = Auth::user();
        
        if ($user->role !== 'super_admin' && !($user->role === 'admin_sekolah' && $user->school_id == $school->id)) {
            abort(403, 'Unauthorized access. Anda tidak memiliki akses untuk mengedit data ini.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'required|string|unique:schools,npsn,' . $school->id . '|max:20',
            'email' => 'required|email|unique:schools,email,' . $school->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'school_level' => 'nullable|string|in:sd,smp,sma,smk',
            // Validasi field baru untuk kartu pelajar
            'kepala_sekolah' => 'nullable|string|max:255',
            'nip_kepala_sekolah' => 'nullable|string|max:50',
            'ttd_digital' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'logo_sekolah' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $data = $request->except(['ttd_digital', 'logo_sekolah']);

        // Upload Tanda Tangan Digital
        if ($request->hasFile('ttd_digital')) {
            // Hapus file lama jika ada
            if ($school->ttd_digital && file_exists(public_path('uploads/ttd/' . $school->ttd_digital))) {
                unlink(public_path('uploads/ttd/' . $school->ttd_digital));
            }
            
            $ttd = $request->file('ttd_digital');
            $nama_ttd = time() . '_ttd.' . $ttd->getClientOriginalExtension();
            $ttd->move(public_path('uploads/ttd'), $nama_ttd);
            $data['ttd_digital'] = $nama_ttd;
        }

        // Upload Logo Sekolah
        if ($request->hasFile('logo_sekolah')) {
            // Hapus file lama jika ada
            if ($school->logo_sekolah && file_exists(public_path('uploads/logo/' . $school->logo_sekolah))) {
                unlink(public_path('uploads/logo/' . $school->logo_sekolah));
            }
            
            $logo = $request->file('logo_sekolah');
            $nama_logo = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/logo'), $nama_logo);
            $data['logo_sekolah'] = $nama_logo;
        }

        $school->update($data);

        // Redirect sesuai role
        if ($user->role === 'super_admin') {
            return redirect()->route('schools.index')
                ->with('success', 'Data sekolah berhasil diperbarui.');
        } else {
            return redirect()->route('dashboard')
                ->with('success', 'Data sekolah berhasil diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        // Cek akses manual
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access. Hanya Super Admin yang dapat mengakses halaman ini.');
        }
        
        // Cek apakah masih ada data terkait
        if ($school->users()->count() > 0 || $school->siswa()->count() > 0) {
            return redirect()->route('schools.index')
                ->with('error', 'Tidak dapat menghapus sekolah karena masih memiliki data terkait.');
        }

        // Hapus file TTD dan Logo jika ada
        if ($school->ttd_digital && file_exists(public_path('uploads/ttd/' . $school->ttd_digital))) {
            unlink(public_path('uploads/ttd/' . $school->ttd_digital));
        }
        
        if ($school->logo_sekolah && file_exists(public_path('uploads/logo/' . $school->logo_sekolah))) {
            unlink(public_path('uploads/logo/' . $school->logo_sekolah));
        }

        $school->delete();

        return redirect()->route('schools.index')
            ->with('success', 'Sekolah berhasil dihapus.');
    }
    
    /**
     * Verify a school (change status from pending to active)
     */
    public function verify(School $school)
    {
        // Cek akses manual - hanya super admin yang bisa verifikasi
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized access. Hanya Super Admin yang dapat melakukan verifikasi.');
        }
        
        // Cek apakah status sekolah pending
        if ($school->status !== 'pending') {
            return redirect()->route('schools.index')
                ->with('error', 'Sekolah tidak dapat diverifikasi karena statusnya bukan "Pending". Status saat ini: ' . ucfirst($school->status));
        }
        
        // Update status sekolah menjadi aktif (verified)
        $school->update([
            'status' => School::STATUS_VERIFIED,
            'verified_at' => now(),
            'verified_by' => Auth::id(),
        ]);
        
        // Aktifkan user admin sekolah yang terkait
        $adminUsers = $school->users()->where('role', 'admin_sekolah')->get();
        
        if ($adminUsers->count() > 0) {
            foreach ($adminUsers as $admin) {
                // Set is_active ke true
                if (in_array('is_active', $admin->getFillable())) {
                    $admin->update(['is_active' => true]);
                }
            }
            
            return redirect()->route('schools.index')
                ->with('success', 'Sekolah "' . $school->name . '" berhasil diverifikasi! ' . $adminUsers->count() . ' akun admin sekolah telah diaktifkan.');
        }
        
        return redirect()->route('schools.index')
            ->with('success', 'Sekolah "' . $school->name . '" berhasil diverifikasi!');
    }
    
    /**
     * Show profile sekolah untuk admin sekolah
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Hanya admin sekolah yang bisa akses
        if ($user->role !== 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat mengakses halaman ini.');
        }
        
        $school = $user->school;
        
        if (!$school) {
            abort(404, 'Data sekolah tidak ditemukan.');
        }
        
        $stats = [
            'totalGuru' => $school->users()->where('role', 'guru')->count(),
            'totalSiswa' => $school->siswa()->count(),
            'totalKelas' => $school->kelas()->count(),
            'totalPrestasi' => \App\Models\Prestasi::whereHas('siswa', function($q) use ($school) {
                $q->where('school_id', $school->id);
            })->count(),
        ];
        
        return view('schools.profile', compact('school', 'stats'));
    }
}
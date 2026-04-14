<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SchoolProfileController extends Controller
{
    /**
     * Menampilkan halaman index profil sekolah (mode view)
     */
    public function index()
    {
        // Cek role manual
        if (Auth::user()->role !== 'admin_sekolah') {
            abort(403, 'Akses ditolak. Hanya admin sekolah yang dapat mengakses halaman ini.');
        }
        
        $user = Auth::user();
        $school = School::find($user->school_id);
        
        return view('school.indexprofil', compact('school'));
    }

    /**
     * Menampilkan form create profil sekolah
     */
    public function create()
    {
        // Cek role manual
        if (Auth::user()->role !== 'admin_sekolah') {
            abort(403, 'Akses ditolak. Hanya admin sekolah yang dapat mengakses halaman ini.');
        }
        
        $user = Auth::user();
        $school = School::find($user->school_id);
        
        // Jika sudah ada data, redirect ke edit
        if ($school) {
            return redirect()->route('school.profile.edit')
                ->with('info', 'Profil sekolah sudah ada. Silakan edit langsung.');
        }
        
        return view('schools.create');
    }

    /**
     * Menyimpan data profil sekolah baru
     */
    public function store(Request $request)
    {
        // Cek role manual
        if (Auth::user()->role !== 'admin_sekolah') {
            abort(403, 'Akses ditolak. Hanya admin sekolah yang dapat mengakses halaman ini.');
        }
        
        $user = Auth::user();
        
        // Cek apakah sudah ada data
        $existingSchool = School::find($user->school_id);
        if ($existingSchool) {
            return redirect()->route('school.profile.edit')
                ->with('error', 'Profil sekolah sudah ada. Silakan edit langsung.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'required|string|max:20|unique:schools,npsn',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:schools,email',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'kepala_sekolah' => 'nullable|string|max:255',
            'nip_kepala_sekolah' => 'nullable|string|max:50',
            'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ttd_digital' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['logo_sekolah', 'ttd_digital']);
        $data['user_id'] = $user->id;

        // Upload Logo ke public/uploads/logo
        if ($request->hasFile('logo_sekolah')) {
            $logo = $request->file('logo_sekolah');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            
            // Pastikan folder ada
            if (!File::exists(public_path('uploads/logo'))) {
                File::makeDirectory(public_path('uploads/logo'), 0777, true);
            }
            
            $logo->move(public_path('uploads/logo'), $logoName);
            $data['logo_sekolah'] = $logoName;
        }

        // Upload TTD ke public/uploads/ttd
        if ($request->hasFile('ttd_digital')) {
            $ttd = $request->file('ttd_digital');
            $ttdName = time() . '_ttd.' . $ttd->getClientOriginalExtension();
            
            // Pastikan folder ada
            if (!File::exists(public_path('uploads/ttd'))) {
                File::makeDirectory(public_path('uploads/ttd'), 0777, true);
            }
            
            $ttd->move(public_path('uploads/ttd'), $ttdName);
            $data['ttd_digital'] = $ttdName;
        }

        $school = School::create($data);
        
        // Update user dengan school_id
        $user->school_id = $school->id;
        $user->save();

        return redirect()->route('school.profile.index')
            ->with('success', 'Profil sekolah berhasil dibuat.');
    }

    /**
     * Menampilkan form edit profil sekolah
     */
    public function edit()
    {
        // Cek role manual di sini
        if (Auth::user()->role !== 'admin_sekolah') {
            abort(403, 'Akses ditolak. Hanya admin sekolah yang dapat mengakses halaman ini.');
        }
        
        $user = Auth::user();
        $school = School::find($user->school_id);
        
        if (!$school) {
            return redirect()->route('school.profile.create')
                ->with('info', 'Silakan buat profil sekolah terlebih dahulu.');
        }
        
        return view('schools.profile', compact('school'));
    }

    /**
     * Update profil sekolah
     */
    public function update(Request $request)
    {
        // Cek role manual di sini
        if (Auth::user()->role !== 'admin_sekolah') {
            abort(403, 'Akses ditolak. Hanya admin sekolah yang dapat mengakses halaman ini.');
        }
        
        $user = Auth::user();
        $school = School::find($user->school_id);
        
        if (!$school) {
            return redirect()->route('school.profile.create')
                ->with('error', 'Data sekolah tidak ditemukan. Silakan buat profil terlebih dahulu.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'npsn' => 'required|string|max:20|unique:schools,npsn,' . $school->id,
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:schools,email,' . $school->id,
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'kepala_sekolah' => 'nullable|string|max:255',
            'nip_kepala_sekolah' => 'nullable|string|max:50',
            'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ttd_digital' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['logo_sekolah', 'ttd_digital']);

        // Upload Logo ke public/uploads/logo
        if ($request->hasFile('logo_sekolah')) {
            // Hapus logo lama
            if ($school->logo_sekolah) {
                $oldLogoPath = public_path('uploads/logo/' . $school->logo_sekolah);
                if (File::exists($oldLogoPath)) {
                    File::delete($oldLogoPath);
                }
            }
            
            $logo = $request->file('logo_sekolah');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            
            // Pastikan folder ada
            if (!File::exists(public_path('uploads/logo'))) {
                File::makeDirectory(public_path('uploads/logo'), 0777, true);
            }
            
            $logo->move(public_path('uploads/logo'), $logoName);
            $data['logo_sekolah'] = $logoName;
        }

        // Upload TTD ke public/uploads/ttd
        if ($request->hasFile('ttd_digital')) {
            // Hapus TTD lama
            if ($school->ttd_digital) {
                $oldTtdPath = public_path('uploads/ttd/' . $school->ttd_digital);
                if (File::exists($oldTtdPath)) {
                    File::delete($oldTtdPath);
                }
            }
            
            $ttd = $request->file('ttd_digital');
            $ttdName = time() . '_ttd.' . $ttd->getClientOriginalExtension();
            
            // Pastikan folder ada
            if (!File::exists(public_path('uploads/ttd'))) {
                File::makeDirectory(public_path('uploads/ttd'), 0777, true);
            }
            
            $ttd->move(public_path('uploads/ttd'), $ttdName);
            $data['ttd_digital'] = $ttdName;
        }

        $school->update($data);

        return redirect()->route('school.profile.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
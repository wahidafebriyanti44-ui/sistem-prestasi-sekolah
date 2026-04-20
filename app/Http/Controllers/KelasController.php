<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Cek akses (Super Admin, Admin Sekolah, dan Guru)
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Base query
        $query = Kelas::with(['waliKelas', 'school']);
        
        // Filter berdasarkan role
        if ($user->role == 'admin_sekolah' || $user->role == 'guru') {
            $query->where('school_id', $user->school_id);
        }
        
        // Filter berdasarkan tingkat
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }
        
        // Filter berdasarkan sekolah (untuk super admin)
        if ($user->role == 'super_admin' && $request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }
        
        // Hitung jumlah siswa per kelas
        $query->withCount('siswa');
        
        // Order by school dan tingkat
        $query->orderBy('school_id')->orderBy('tingkat')->orderBy('nama_kelas');
        
        // Get data
        $kelas = $query->paginate(12)->withQueryString();
        
        // Untuk super admin, ambil semua sekolah untuk filter
        $schools = collect();
        if ($user->role == 'super_admin') {
            $schools = School::orderBy('name')->get(); // PERBAIKAN: name
        }
        
        return view('kelas.index', compact('kelas', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
   
{
    $user = Auth::user();
    
    if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
        abort(403, 'Hanya Super Admin atau Admin Sekolah yang dapat menambah kelas.');
    }
    
    if ($user->role == 'super_admin') {
        $guruList = User::where('role', 'guru')->with('school')->orderBy('name')->get();
        $schools = School::orderBy('name')->get();
        return view('kelas.create', compact('guruList', 'schools'));
    } else {
        $guruList = User::where('school_id', $user->school_id)->where('role', 'guru')->orderBy('name')->get();
        return view('kelas.create', compact('guruList'));
    }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Super Admin atau Admin Sekolah yang dapat menambah kelas.');
        }
        
        $rules = [
            'nama_kelas' => 'required|string|max:50',
            'tingkat' => 'required|string|max:20',
            'wali_kelas_id' => 'nullable|exists:users,id',
        ];
        
        if ($user->role == 'super_admin') {
            $rules['school_id'] = 'required|exists:schools,id';
        }
        
        $request->validate($rules);

        if ($user->role == 'super_admin') {
            $schoolId = $request->school_id;
        } else {
            $schoolId = $user->school_id;
        }

        if ($request->filled('wali_kelas_id')) {
            $waliKelas = User::find($request->wali_kelas_id);
            
            if (!$waliKelas || $waliKelas->role != 'guru') {
                return back()->withInput()->withErrors(['wali_kelas_id' => 'User yang dipilih bukan guru.']);
            }
            
            if ($user->role != 'super_admin' && $waliKelas->school_id != $user->school_id) {
                return back()->withInput()->withErrors(['wali_kelas_id' => 'Wali kelas tidak valid untuk sekolah ini.']);
            }
            
            if ($user->role == 'super_admin' && $waliKelas->school_id != $schoolId) {
                return back()->withInput()->withErrors(['wali_kelas_id' => 'Wali kelas tidak berada di sekolah yang dipilih.']);
            }
        }

        $exists = Kelas::where('school_id', $schoolId)
                      ->where('nama_kelas', $request->nama_kelas)
                      ->where('tingkat', $request->tingkat)
                      ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['nama_kelas' => 'Kelas dengan nama dan tingkat tersebut sudah ada di sekolah ini.']);
        }

        Kelas::create([
            'school_id' => $schoolId,
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $kelas = Kelas::with(['waliKelas', 'school', 'siswa' => function($q) {
                        $q->orderBy('nama_lengkap');
                    }])->findOrFail($id);
        
        if ($user->role != 'super_admin' && $kelas->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data kelas ini.');
        }

        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Super Admin atau Admin Sekolah yang dapat mengedit kelas.');
        }
        
        $kelas = Kelas::findOrFail($id);
        
        if ($user->role != 'super_admin' && $kelas->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data kelas ini.');
        }
        
        if ($user->role == 'super_admin') {
            $guruList = User::where('role', 'guru')
                           ->with('school')
                           ->orderBy('name')
                           ->get();
        } else {
            $guruList = User::where('school_id', $user->school_id)
                           ->where('role', 'guru')
                           ->orderBy('name')
                           ->get();
        }
        
        return view('kelas.edit', compact('kelas', 'guruList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Super Admin atau Admin Sekolah yang dapat mengupdate kelas.');
        }
        
        $kelas = Kelas::findOrFail($id);
        
        if ($user->role != 'super_admin' && $kelas->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data kelas ini.');
        }
        
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'tingkat' => 'required|string|max:20',
            'wali_kelas_id' => 'nullable|exists:users,id',
        ]);

        if ($request->filled('wali_kelas_id')) {
            $waliKelas = User::find($request->wali_kelas_id);
            
            if (!$waliKelas || $waliKelas->role != 'guru') {
                return back()->withInput()->withErrors(['wali_kelas_id' => 'User yang dipilih bukan guru.']);
            }
            
            if ($user->role != 'super_admin' && $waliKelas->school_id != $user->school_id) {
                return back()->withInput()->withErrors(['wali_kelas_id' => 'Wali kelas tidak valid untuk sekolah ini.']);
            }
        }

        $exists = Kelas::where('school_id', $kelas->school_id)
                      ->where('nama_kelas', $request->nama_kelas)
                      ->where('tingkat', $request->tingkat)
                      ->where('id', '!=', $id)
                      ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['nama_kelas' => 'Kelas dengan nama dan tingkat tersebut sudah ada di sekolah ini.']);
        }

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'wali_kelas_id' => $request->wali_kelas_id,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Super Admin atau Admin Sekolah yang dapat menghapus kelas.');
        }
        
        $kelas = Kelas::findOrFail($id);
        
        if ($user->role != 'super_admin' && $kelas->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data kelas ini.');
        }
        
        if ($kelas->siswa()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus kelas karena masih memiliki siswa.');
        }
        
        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
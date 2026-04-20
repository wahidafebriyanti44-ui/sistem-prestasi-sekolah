<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use App\Models\School; // <-- TAMBAHKAN INI!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Base query dengan relasi school
        $query = Eskul::with('school');
        
        // Filter berdasarkan role
        if ($user->role != 'super_admin') {
            // Untuk admin sekolah dan guru, hanya lihat eskul di sekolahnya
            $query->where('school_id', $user->school_id);
        }
        
        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_eskul', 'like', "%{$search}%");
        }
        
        // Filter berdasarkan sekolah (untuk super admin)
        if ($user->role == 'super_admin' && $request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }
        
        // Hitung jumlah anggota per eskul
        $query->withCount('siswa');
        
        // Order by nama eskul
        $query->orderBy('nama_eskul');
        
        // Pagination
        $eskul = $query->paginate(12)->withQueryString();
        
        // Untuk super admin, ambil semua sekolah untuk filter
        $schools = collect();
        if ($user->role == 'super_admin') {
            $schools = School::orderBy('name')->get();
        }
        
        return view('eskul.index', compact('eskul', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        // Hanya admin_sekolah yang boleh akses halaman create
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat menambah eskul.');
        }
        
        return view('eskul.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Hanya admin_sekolah yang boleh akses
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat menambah eskul.');
        }
        
        $request->validate([
            'nama_eskul' => 'required|string|max:100',
            'pembina' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['school_id'] = $user->school_id;

        Eskul::create($data);

        return redirect()->route('eskul.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Eskul $eskul)
    {
        // Cek akses
        $this->authorizeAccess($eskul);
        
        $eskul->load(['siswa' => function($q) {
            $q->withPivot('tahun_masuk', 'keterangan');
        }]);
        
        return view('eskul.show', compact('eskul'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eskul $eskul)
    {
        // Cek akses
        $this->authorizeAccess($eskul);
        
        return view('eskul.edit', compact('eskul'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eskul $eskul)
    {
        // Cek akses
        $this->authorizeAccess($eskul);
        
        $request->validate([
            'nama_eskul' => 'required|string|max:100',
            'pembina' => 'nullable|string|max:255',
        ]);

        $eskul->update($request->all());

        return redirect()->route('eskul.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eskul $eskul)
    {
        // Cek akses
        $this->authorizeAccess($eskul);
        
        // Cek apakah masih ada anggota
        if ($eskul->siswa()->count() > 0) {
            return redirect()->route('eskul.index')
                ->with('error', 'Tidak dapat menghapus eskul karena masih memiliki anggota.');
        }

        $eskul->delete();

        return redirect()->route('eskul.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }

    /**
     * Cek akses user ke data eskul
     */
    private function authorizeAccess(Eskul $eskul)
    {
        $user = Auth::user();
        
        if ($user->role == 'super_admin') {
            return true;
        }
        
        if ($user->school_id != $eskul->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data eskul ini.');
        }
        
        return true;
    }
}
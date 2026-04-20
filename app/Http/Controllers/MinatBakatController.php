<?php

namespace App\Http\Controllers;

use App\Models\MinatBakat;
use App\Models\Siswa;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinatBakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $query = MinatBakat::with('school')->withCount('siswa');
        
        if ($user->role != 'super_admin') {
            $query->where('school_id', $user->school_id);
        }
        
        if ($user->role == 'super_admin' && $request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }
        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_minat', 'like', "%{$search}%");
        }
        
        $query->orderBy('nama_minat');
        
        $perPage = $request->get('per_page', 10);
        $minatBakat = $query->paginate($perPage)->withQueryString();
        
        if ($user->role == 'super_admin') {
            $schools = School::orderBy('name')->get();
        } else {
            $schools = collect();
        }
        
        return view('minat_bakat.index', compact('minatBakat', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat menambah minat bakat.');
        }
        
        $kategoriList = ['olahraga', 'seni', 'sains', 'bahasa', 'teknologi', 'lainnya'];
        
        return view('minat_bakat.create', compact('kategoriList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat menambah minat bakat.');
        }
        
        $request->validate([
            'nama_minat' => 'required|string|max:100|unique:minat_bakat,nama_minat,NULL,id,school_id,' . $user->school_id,
            'kategori' => 'required|in:olahraga,seni,sains,bahasa,teknologi,lainnya',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['school_id'] = $user->school_id;

        MinatBakat::create($data);

        return redirect()->route('minat-bakat.index')
            ->with('success', 'Minat bakat berhasil ditambahkan.');
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
        
        // Cari minat bakat berdasarkan ID
        $minatBakat = MinatBakat::with('siswa')->findOrFail($id);
        
        if ($user->role != 'super_admin' && $user->school_id != $minatBakat->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        // Ambil daftar siswa yang BELUM memiliki minat bakat ini
        $siswaAvailable = Siswa::where('school_id', $minatBakat->school_id)
            ->whereDoesntHave('minatBakat', function($q) use ($minatBakat) {
                $q->where('minat_bakat_id', $minatBakat->id);
            })
            ->orderBy('nama_lengkap')
            ->get();
        
        return view('minat_bakat.show', compact('minatBakat', 'siswaAvailable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat mengedit minat bakat.');
        }
        
        $minatBakat = MinatBakat::findOrFail($id);
        
        if ($user->school_id != $minatBakat->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data minat bakat ini.');
        }
        
        $kategoriList = ['olahraga', 'seni', 'sains', 'bahasa', 'teknologi', 'lainnya'];
        
        return view('minat_bakat.edit', compact('minatBakat', 'kategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat mengupdate minat bakat.');
        }
        
        $minatBakat = MinatBakat::findOrFail($id);
        
        if ($user->school_id != $minatBakat->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data minat bakat ini.');
        }
        
        $request->validate([
            'nama_minat' => 'required|string|max:100|unique:minat_bakat,nama_minat,' . $minatBakat->id . ',id,school_id,' . $user->school_id,
            'kategori' => 'required|in:olahraga,seni,sains,bahasa,teknologi,lainnya',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $minatBakat->update($request->all());

        return redirect()->route('minat-bakat.index')
            ->with('success', 'Minat bakat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah') {
            abort(403, 'Hanya Admin Sekolah yang dapat menghapus minat bakat.');
        }
        
        $minatBakat = MinatBakat::findOrFail($id);
        
        if ($user->school_id != $minatBakat->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data minat bakat ini.');
        }
        
        $siswaCount = $minatBakat->siswa()->count();
        if ($siswaCount > 0) {
            return redirect()->route('minat-bakat.index')
                ->with('error', 'Tidak dapat menghapus karena masih digunakan oleh ' . $siswaCount . ' siswa.');
        }

        $minatBakat->delete();

        return redirect()->route('minat-bakat.index')
            ->with('success', 'Minat bakat berhasil dihapus.');
    }

    /**
     * Add siswa to minat bakat
     */
    public function addSiswa(Request $request, $id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Admin yang dapat menambah siswa ke minat & bakat.');
        }
        
        $minatBakat = MinatBakat::findOrFail($id);
        
        if ($user->role != 'super_admin' && $minatBakat->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id'
        ]);
        
        // Cek apakah siswa sudah memiliki minat bakat ini
        if ($minatBakat->siswa()->where('siswa_id', $request->siswa_id)->exists()) {
            return redirect()->route('minat-bakat.show', $minatBakat)->with('error', 'Siswa sudah memiliki minat & bakat ini.');
        }
        
        $minatBakat->siswa()->attach($request->siswa_id);
        
        return redirect()->route('minat-bakat.show', $minatBakat)->with('success', 'Siswa berhasil ditambahkan ke minat & bakat.');
    }

    /**
     * Remove siswa from minat bakat
     */
    public function removeSiswa($minatBakatId, $siswaId)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Admin yang dapat menghapus siswa dari minat & bakat.');
        }
        
        $minatBakat = MinatBakat::findOrFail($minatBakatId);
        
        if ($user->role != 'super_admin' && $minatBakat->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        $minatBakat->siswa()->detach($siswaId);
        
        return redirect()->route('minat-bakat.show', $minatBakat)->with('success', 'Siswa berhasil dihapus dari minat & bakat.');
    }
}
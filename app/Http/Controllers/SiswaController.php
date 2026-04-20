<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
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
        
        $query = Siswa::with(['kelas', 'kelas.school', 'user']);
        
        if ($user->role != 'super_admin') {
            $query->where('school_id', $user->school_id);
        }
        
        if ($user->role == 'super_admin' && $request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }
        
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }
        
        $query->orderBy('nama_lengkap');
        $siswa = $query->paginate(15)->withQueryString();
        
        if ($user->role == 'super_admin') {
            $kelasList = Kelas::with('school')->orderBy('nama_kelas')->get();
            $schools = School::orderBy('name')->get();
        } else {
            $kelasList = Kelas::where('school_id', $user->school_id)->orderBy('nama_kelas')->get();
            $schools = collect();
        }
        
        return view('siswa.index', compact('siswa', 'kelasList', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat menambah siswa.');
        }
        
        if ($user->role == 'admin_sekolah') {
            $kelas = Kelas::where('school_id', $user->school_id)->orderBy('nama_kelas')->get();
        } else {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->orderBy('nama_kelas')->get();
        }
        
        return view('siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat menambah siswa.');
        }
        
        $request->validate([
            'nis' => 'required|string|unique:siswa,nis|max:20',
            'nisn' => 'nullable|string|unique:siswa,nisn|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:users,email',
            'kelas_id' => 'nullable|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mata_pelajaran_favorit' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:100',
            'no_hp_orangtua' => 'nullable|string|max:20',
        ]);

        $data = $request->all();
        $data['school_id'] = $user->school_id;

        // Upload foto
        if ($request->hasFile('foto')) {
            if (!file_exists(public_path('uploads/foto-siswa'))) {
                mkdir(public_path('uploads/foto-siswa'), 0777, true);
            }
            
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $foto->getClientOriginalName());
            $foto->move(public_path('uploads/foto-siswa'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        // Buat akun user untuk siswa
        if ($request->filled('email')) {
            $newUser = User::create([
                'school_id' => $user->school_id,
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->nis),
                'role' => 'siswa',
                'is_active' => true
            ]);
            $data['user_id'] = $newUser->id;
        }

        Siswa::create($data);

        $message = 'Data siswa berhasil ditambahkan.';
        if ($request->filled('email')) {
            $message .= ' Password default: ' . $request->nis;
        }

        return redirect()->route('siswa.index')->with('success', $message);
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
        
        $siswa = Siswa::with(['kelas.waliKelas', 'kelas.school', 'prestasi', 'eskul', 'minatBakat', 'hafalanQuran', 'user'])
                      ->findOrFail($id);
        
        $this->authorizeAccess($siswa);
        
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat mengedit siswa.');
        }
        
        $siswa = Siswa::findOrFail($id);
        $this->authorizeAccess($siswa);
        
        if ($user->role == 'admin_sekolah') {
            $kelas = Kelas::where('school_id', $user->school_id)->orderBy('nama_kelas')->get();
        } else {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->orderBy('nama_kelas')->get();
        }
        
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat mengupdate siswa.');
        }
        
        $siswa = Siswa::findOrFail($id);
        $this->authorizeAccess($siswa);
        
        $request->validate([
            'nis' => 'required|string|unique:siswa,nis,' . $siswa->id . '|max:20',
            'nisn' => 'nullable|string|unique:siswa,nisn,' . $siswa->id . '|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:users,email,' . ($siswa->user_id ?? 'NULL'),
            'kelas_id' => 'nullable|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mata_pelajaran_favorit' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:100',
            'no_hp_orangtua' => 'nullable|string|max:20',
        ]);

        $data = $request->all();

        // Upload foto baru
        if ($request->hasFile('foto')) {
            if (!file_exists(public_path('uploads/foto-siswa'))) {
                mkdir(public_path('uploads/foto-siswa'), 0777, true);
            }
            
            if ($siswa->foto && file_exists(public_path('uploads/foto-siswa/' . $siswa->foto))) {
                unlink(public_path('uploads/foto-siswa/' . $siswa->foto));
            }
            
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $foto->getClientOriginalName());
            $foto->move(public_path('uploads/foto-siswa'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        // Update user
        if ($siswa->user_id && $request->filled('email')) {
            $siswa->user->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email
            ]);
        } elseif ($request->filled('email') && !$siswa->user_id) {
            $newUser = User::create([
                'school_id' => $user->school_id,
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->nis),
                'role' => 'siswa',
                'is_active' => true
            ]);
            $data['user_id'] = $newUser->id;
        }

        // UPDATE DATA SISWA - PASTIKAN FIELD ORANG TUA TERSIMPAN
        $siswa->update([
            'nis' => $data['nis'],
            'nisn' => $data['nisn'] ?? null,
            'nama_lengkap' => $data['nama_lengkap'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'] ?? null,
            'email' => $data['email'] ?? null,
            'kelas_id' => $data['kelas_id'] ?? null,
            'foto' => $data['foto'] ?? $siswa->foto,
            'mata_pelajaran_favorit' => $data['mata_pelajaran_favorit'] ?? null,
            'nama_ayah' => $data['nama_ayah'] ?? null,      // <-- PASTIKAN INI ADA
            'nama_ibu' => $data['nama_ibu'] ?? null,        // <-- PASTIKAN INI ADA
            'no_hp_orangtua' => $data['no_hp_orangtua'] ?? null,  // <-- PASTIKAN INI ADA
            'user_id' => $data['user_id'] ?? $siswa->user_id
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat menghapus siswa.');
        }
        
        $siswa = Siswa::findOrFail($id);
        $this->authorizeAccess($siswa);
        
        if ($siswa->foto && file_exists(public_path('uploads/foto-siswa/' . $siswa->foto))) {
            unlink(public_path('uploads/foto-siswa/' . $siswa->foto));
        }
        
        if ($siswa->user_id) {
            $siswa->user->delete();
        }
        
        $siswa->eskul()->detach();
        $siswa->minatBakat()->detach();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Search siswa (AJAX)
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        
        $query = Siswa::with(['kelas']);
        
        if ($user->role != 'super_admin') {
            $query->where('school_id', $user->school_id);
        }
        
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }
        
        $siswa = $query->limit(10)->get();
        
        if ($request->ajax()) {
            return response()->json($siswa);
        }
        
        return redirect()->route('siswa.index');
    }

    /**
     * Tambah eskul untuk siswa
     */
    public function addEskul(Request $request, $id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat menambah eskul.');
        }
        
        $siswa = Siswa::findOrFail($id);
        $this->authorizeAccess($siswa);
        
        $request->validate([
            'eskul_id' => 'required|exists:eskul,id',
            'tahun_masuk' => 'required|integer|min:2000|max:' . date('Y'),
            'keterangan' => 'nullable|string|max:255'
        ]);

        $exists = $siswa->eskul()
            ->wherePivot('eskul_id', $request->eskul_id)
            ->wherePivot('tahun_masuk', $request->tahun_masuk)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Siswa sudah terdaftar di eskul ini pada tahun ' . $request->tahun_masuk);
        }

        $siswa->eskul()->attach($request->eskul_id, [
            'tahun_masuk' => $request->tahun_masuk,
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Tambah minat bakat untuk siswa
     */
    public function addMinat(Request $request, $id)
    {
        $user = Auth::user();
        
        if ($user->role != 'admin_sekolah' && !$user->isWaliKelas()) {
            abort(403, 'Hanya Admin Sekolah atau Wali Kelas yang dapat menambah minat.');
        }
        
        $siswa = Siswa::findOrFail($id);
        $this->authorizeAccess($siswa);
        
        $request->validate([
            'minat_bakat_id' => 'required|exists:minat_bakat,id'
        ]);

        if ($siswa->minatBakat()->where('minat_bakat_id', $request->minat_bakat_id)->exists()) {
            return back()->with('error', 'Siswa sudah memiliki minat/bakat ini.');
        }

        $siswa->minatBakat()->attach($request->minat_bakat_id);

        return back()->with('success', 'Minat bakat berhasil ditambahkan.');
    }

    /**
     * Cek akses user ke data siswa
     */
    private function authorizeAccess($siswa)
    {
        $user = Auth::user();
        
        if ($user->role == 'super_admin') {
            return true;
        }
        
        if ($user->school_id != $siswa->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data siswa ini.');
        }
        
        return true;
    }
}
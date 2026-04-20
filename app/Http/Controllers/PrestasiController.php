<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\School;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
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
        
        $query = Prestasi::with(['siswa', 'siswa.kelas', 'siswa.school', 'verifikator', 'provinsi', 'kabupaten']);
        
        if ($user->role != 'super_admin') {
            $query->whereHas('siswa', function($q) use ($user) {
                $q->where('school_id', $user->school_id);
            });
        }
        
        if ($user->role == 'super_admin' && $request->filled('school_id')) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('school_id', $request->school_id);
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('jenis')) {
            $query->where('jenis_prestasi', $request->jenis);
        }
        
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }
        
        // ========== FITUR INDOREGION (TAMBAHAN) ==========
        // Filter berdasarkan provinsi
        if ($request->filled('provinsi_id')) {
            $query->where('provinsi_id', $request->provinsi_id);
        }
        
        // Filter berdasarkan kabupaten
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }
        // =================================================
        
        $prestasi = $query->latest()->paginate(15)->withQueryString();
        
        $tahunList = Prestasi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        
        if ($user->role == 'super_admin') {
            $schools = School::orderBy('name')->get();
        } else {
            $schools = collect();
        }
        
        // ========== DATA UNTUK INDOREGION ==========
        $provinsiList = Provinsi::orderBy('nama')->get();
        // ===========================================
        
        return view('prestasi.index', compact('prestasi', 'tahunList', 'schools', 'provinsiList'));
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
        
        $prestasi = Prestasi::with(['siswa', 'siswa.kelas', 'siswa.school', 'verifikator', 'provinsi', 'kabupaten'])
                            ->findOrFail($id);
        
        if ($user->role != 'super_admin' && $prestasi->siswa->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data prestasi ini.');
        }
        
        return view('prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $siswa_id = $request->get('siswa_id');
        
        // ========== DATA UNTUK INDOREGION ==========
        $provinsiList = Provinsi::orderBy('nama')->get();
        // ===========================================
        
        if ($siswa_id) {
            $siswa = Siswa::findOrFail($siswa_id);
            return view('prestasi.create', compact('siswa', 'provinsiList'));
        }
        
        $siswaQuery = Siswa::with('kelas');
        
        if ($user->role != 'super_admin') {
            $siswaQuery->where('school_id', $user->school_id);
        }
        
        $siswaList = $siswaQuery->orderBy('nama_lengkap')->get();
        
        return view('prestasi.create', compact('siswaList', 'provinsiList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'jenis_prestasi' => 'required|in:akademik,non_akademik',
            'peringkat' => 'required|string|max:100',
            'tahun' => 'required|integer|min:2000|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // ========== VALIDASI INDOREGION ==========
            'provinsi_id' => 'nullable|exists:provinsi,id',
            'kabupaten_id' => 'nullable|exists:kabupaten,id',
            // =========================================
        ]);
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        
        if ($user->role != 'super_admin' && $siswa->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data siswa ini.');
        }
        
        $data = $request->all();
        $data['status'] = 'pending';
        
        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            
            if (!file_exists(public_path('uploads/sertifikat'))) {
                mkdir(public_path('uploads/sertifikat'), 0777, true);
            }
            
            $file->move(public_path('uploads/sertifikat'), $filename);
            $data['file_sertifikat'] = $filename;
        }
        
        Prestasi::create($data);
        
        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Admin yang dapat mengedit prestasi.');
        }
        
        $prestasi = Prestasi::with('siswa')->findOrFail($id);
        
        if ($user->role != 'super_admin' && $prestasi->siswa->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        // ========== DATA UNTUK INDOREGION ==========
        $provinsiList = Provinsi::orderBy('nama')->get();
        $kabupatenList = collect();
        
        if ($prestasi->provinsi_id) {
            $kabupatenList = Kabupaten::where('provinsi_id', $prestasi->provinsi_id)->orderBy('nama')->get();
        }
        // ===========================================
        
        return view('prestasi.edit', compact('prestasi', 'provinsiList', 'kabupatenList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Admin yang dapat mengupdate prestasi.');
        }
        
        $prestasi = Prestasi::with('siswa')->findOrFail($id);
        
        if ($user->role != 'super_admin' && $prestasi->siswa->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|string|max:100',
            'jenis_prestasi' => 'required|in:akademik,non_akademik',
            'peringkat' => 'required|string|max:100',
            'tahun' => 'required|integer|min:2000|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // ========== VALIDASI INDOREGION ==========
            'provinsi_id' => 'nullable|exists:provinsi,id',
            'kabupaten_id' => 'nullable|exists:kabupaten,id',
            // =========================================
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('file_sertifikat')) {
            if ($prestasi->file_sertifikat && file_exists(public_path('uploads/sertifikat/' . $prestasi->file_sertifikat))) {
                unlink(public_path('uploads/sertifikat/' . $prestasi->file_sertifikat));
            }
            
            $file = $request->file('file_sertifikat');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('uploads/sertifikat'), $filename);
            $data['file_sertifikat'] = $filename;
        }
        
        $prestasi->update($data);
        
        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Admin yang dapat menghapus prestasi.');
        }
        
        $prestasi = Prestasi::with('siswa')->findOrFail($id);
        
        if ($user->role != 'super_admin' && $prestasi->siswa->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        if ($prestasi->file_sertifikat && file_exists(public_path('uploads/sertifikat/' . $prestasi->file_sertifikat))) {
            unlink(public_path('uploads/sertifikat/' . $prestasi->file_sertifikat));
        }
        
        $prestasi->delete();
        
        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
    }

    /**
     * Verify prestasi (ubah status pending -> diverifikasi)
     */
    public function verify($id)
    {
        $user = Auth::user();
        
        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403, 'Hanya Admin yang dapat memverifikasi prestasi.');
        }
        
        $prestasi = Prestasi::with('siswa')->findOrFail($id);
        
        if ($user->role != 'super_admin' && $prestasi->siswa->school_id != $user->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
        
        $prestasi->update([
            'status' => 'diverifikasi',
            'diverifikasi_oleh' => $user->id,
            'tanggal_verifikasi' => now()
        ]);
        
        return redirect()->back()->with('success', 'Prestasi berhasil diverifikasi.');
    }

    /**
     * ========== METHOD BARU UNTUK INDOREGION ==========
     * Get kabupaten list based on provinsi_id (AJAX)
     */
    public function getKabupaten(Request $request)
    {
        $provinsiId = $request->query('provinsi_id') ?? $request->input('provinsi_id');
        
        if (!$provinsiId) {
            return response()->json([]);
        }
        
        $kabupaten = Kabupaten::where('provinsi_id', $provinsiId)
                              ->orderBy('nama')
                              ->get(['id', 'nama']);
        
        return response()->json($kabupaten);
    }
}
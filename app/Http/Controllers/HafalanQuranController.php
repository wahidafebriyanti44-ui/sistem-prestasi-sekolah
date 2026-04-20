<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\HafalanQuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HafalanQuranController extends Controller
{
    /**
     * Show form to edit hafalan quran for a student
     */
    public function edit(Siswa $siswa)
    {
        $user = Auth::user();
        
        // Cek akses
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        // Cek akses ke data siswa
        if ($user->role != 'super_admin' && $user->school_id != $siswa->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data siswa ini.');
        }
        
        // Ambil data hafalan jika ada
        $hafalan = $siswa->hafalanQuran;
        
        return view('siswa.hafalan', compact('siswa', 'hafalan'));
    }
    
    /**
     * Update or create hafalan quran data
     */
    public function update(Request $request, Siswa $siswa)
    {
        $user = Auth::user();
        
        // Cek akses
        if (!in_array($user->role, ['super_admin', 'admin_sekolah', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        
        // Cek akses ke data siswa
        if ($user->role != 'super_admin' && $user->school_id != $siswa->school_id) {
            abort(403, 'Anda tidak memiliki akses ke data siswa ini.');
        }
        
        $request->validate([
            'is_active' => 'boolean',
            'juz' => 'nullable|integer|min:1|max:30',
            'description' => 'nullable|string|max:500',
            'start_date' => 'nullable|date',
            'target_juz' => 'nullable|string|max:100',
            'pembimbing' => 'nullable|string|max:255',
        ]);
        
        // Jika aktif tapi juz kosong, beri error
        if ($request->is_active && !$request->juz) {
            return back()->with('error', 'Jika status aktif, jumlah juz harus diisi.');
        }
        
        // Update atau create
        $hafalan = HafalanQuran::updateOrCreate(
            ['siswa_id' => $siswa->id],
            [
                'school_id' => $siswa->school_id,
                'is_active' => $request->is_active ?? false,
                'juz' => $request->juz,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'target_juz' => $request->target_juz,
                'pembimbing' => $request->pembimbing,
            ]
        );
        
        return redirect()->route('siswa.show', $siswa)
            ->with('success', 'Data hafalan Qur\'an berhasil diperbarui.');
    }
}
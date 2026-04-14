<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\School; // <-- TAMBAHKAN INI
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403);
        }

        $query = Teacher::with(['user', 'school']);

        if ($user->role != 'super_admin') {
            $query->where('school_id', $user->school_id);
        }

        // Filter sekolah (khusus super admin) - TAMBAHKAN INI
        if ($user->role == 'super_admin' && $request->filled('school_id')) {
            $query->where('school_id', $request->school_id);
        }

        // Filter status
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status == 'active') {
                $query->where('is_active', true);
            } elseif ($status == 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('nuptk', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $teachers = $query->orderBy('name')->paginate(15)->withQueryString();

        // TAMBAHKAN INI - Ambil daftar sekolah untuk filter (khusus super admin)
        if ($user->role == 'super_admin') {
            $schools = School::orderBy('name')->get();
        } else {
            $schools = collect(); // empty collection untuk admin sekolah
        }

        // KIRIMKAN $schools KE VIEW
        return view('teachers.index', compact('teachers', 'schools'));
    }

    public function create()
    {
        $user = Auth::user();

        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403);
        }

        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['super_admin', 'admin_sekolah'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'nullable|string|unique:teachers,nip|max:20',
            'nuptk' => 'nullable|string|unique:teachers,nuptk|max:20',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:L,P',
            'birth_place' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
            'is_homeroom' => 'nullable|boolean',
        ]);

        try {
            // Upload foto ke public/uploads/foto-guru
            $photoName = null;
            if ($request->hasFile('photo')) {
                $foto = $request->file('photo');
                $photoName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $foto->getClientOriginalName());
                
                // Buat folder jika belum ada
                $folderPath = public_path('uploads/foto-guru');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                
                // Pindahkan file
                $foto->move($folderPath, $photoName);
            }
            
            // Generate password random 8 karakter
            $defaultPassword = Str::random(8);
            
            // Buat user login
            $newUser = User::create([
                'school_id' => $user->school_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($defaultPassword),
                'role' => 'guru',
                'is_active' => $request->is_active ?? true,
            ]);

            // Simpan data teacher
            Teacher::create([
                'user_id' => $newUser->id,
                'school_id' => $user->school_id,
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'nuptk' => $request->nuptk,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'photo' => $photoName,
                'is_active' => $request->is_active ?? true,
                'is_homeroom' => $request->is_homeroom ?? false,
            ]);

            $message = "✅ Guru {$request->name} berhasil ditambahkan!\n📧 Email: {$request->email}\n🔑 Password sementara: {$defaultPassword}\n\n⚠️ Simpan password ini dan berikan ke guru yang bersangkutan.";
            
            if ($photoName) {
                $message .= "\n📸 Foto berhasil diupload.";
            }

            return redirect()->route('teachers.index')->with('success', $message);

        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan guru: ' . $e->getMessage());
        }
    }

    public function show(Teacher $teacher)
    {
        $this->authorizeAccess($teacher);
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $this->authorizeAccess($teacher);
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $this->authorizeAccess($teacher);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'nip' => 'nullable|string|unique:teachers,nip,' . $teacher->id . '|max:20',
            'nuptk' => 'nullable|string|unique:teachers,nuptk,' . $teacher->id . '|max:20',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:L,P',
            'birth_place' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable|boolean',
            'is_homeroom' => 'nullable|boolean',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($teacher->photo) {
                $oldPath = public_path('uploads/foto-guru/' . $teacher->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            $foto = $request->file('photo');
            $photoName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $foto->getClientOriginalName());
            
            $folderPath = public_path('uploads/foto-guru');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            
            $foto->move($folderPath, $photoName);
            $teacher->photo = $photoName;
        }

        // Update user
        if ($teacher->user) {
            $teacher->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => $request->is_active ?? true,
            ]);
        }

        // Update teacher
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'nuptk' => $request->nuptk,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'is_active' => $request->is_active ?? true,
            'is_homeroom' => $request->is_homeroom ?? false,
        ]);

        // Update foto jika ada perubahan
        if (isset($photoName)) {
            $teacher->photo = $photoName;
            $teacher->save();
        }

        return redirect()->route('teachers.index')->with('success', '✅ Data guru berhasil diupdate');
    }

    public function resetPassword($id)
    {
        $teacher = Teacher::findOrFail($id);
        $this->authorizeAccess($teacher);
        
        $newPassword = Str::random(8);
        
        if ($teacher->user) {
            $teacher->user->password = Hash::make($newPassword);
            $teacher->user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset',
                'new_password' => $newPassword,
                'email' => $teacher->email,
                'name' => $teacher->name
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    public function destroy(Teacher $teacher)
    {
        $this->authorizeAccess($teacher);

        // Hapus foto jika ada
        if ($teacher->photo) {
            $photoPath = public_path('uploads/foto-guru/' . $teacher->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        if ($teacher->user) {
            $teacher->user->delete();
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', '✅ Data guru berhasil dihapus');
    }

    private function authorizeAccess(Teacher $teacher)
    {
        $user = Auth::user();

        if ($user->role == 'super_admin') return true;

        if ($user->school_id != $teacher->school_id) {
            abort(403);
        }
    }
}
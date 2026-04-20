<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $users = User::with('school')
            ->when($request->search, function($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($request->role, function($query, $role) {
                $query->where('role', $role);
            })
            ->when($request->school_id, function($query, $schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $schools = School::all();
        $roles = ['super_admin', 'admin_sekolah', 'guru'];

        return view('users.index', compact('users', 'schools', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $schools = School::all();
        $roles = ['admin_sekolah', 'guru']; // Super admin tidak bisa dibuat dari sini
        
        return view('users.create', compact('schools', 'roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin_sekolah,guru',
            'school_id' => 'required_if:role,admin_sekolah,guru|exists:schools,id|nullable',
        ]);

        // Generate random password
        $newPassword = Str::random(8);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'school_id' => $request->school_id,
            'password' => Hash::make($newPassword),
            'is_active' => true,
        ]);

        return redirect()->route('users.index')
            ->with('success', "User {$user->name} berhasil ditambahkan. Password: {$newPassword}");
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $schools = School::all();
        $roles = ['super_admin', 'admin_sekolah', 'guru'];
        
        return view('users.edit', compact('user', 'schools', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:super_admin,admin_sekolah,guru',
            'school_id' => 'required_if:role,admin_sekolah,guru|exists:schools,id|nullable',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'school_id' => $request->role == 'super_admin' ? null : $request->school_id,
        ]);

        return redirect()->route('users.index')
            ->with('success', "User {$user->name} berhasil diperbarui.");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat menghapus akun Anda sendiri.'
                ], 403);
            }
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $userName = $user->name;
        $user->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "User {$userName} berhasil dihapus."
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', "User {$userName} berhasil dihapus.");
    }

    /**
     * Reset password untuk user (guru/siswa/admin)
     */
    public function resetPassword(Request $request, User $user)
    {
        // Generate random password (8 karakter)
        $newPassword = Str::random(8);
        
        // Set password baru
        $user->password = Hash::make($newPassword);
        $user->save();
        
        // Return response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset',
                'new_password' => $newPassword,
                'user_name' => $user->name,
                'user_email' => $user->email
            ]);
        }
        
        return redirect()->back()->with('success', "Password untuk {$user->name} telah direset menjadi: {$newPassword}");
    }
    
    /**
     * Set password manual untuk user
     */
    public function setPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diupdate'
            ]);
        }
        
        return redirect()->back()->with('success', 'Password berhasil diupdate');
    }
    
    /**
     * Toggle status aktif/nonaktif user
     */
    public function toggleActive(User $user)
    {
        // Prevent disabling yourself
        if ($user->id === auth()->id()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak dapat menonaktifkan akun Anda sendiri.'
                ], 403);
            }
            return redirect()->back()->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }
        
        $user->is_active = !$user->is_active;
        $user->save();
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status user berhasil diubah',
                'is_active' => $user->is_active
            ]);
        }
        
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "User {$user->name} berhasil {$status}.");
    }
}
<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
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
        
        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diupdate'
        ]);
    }
    
    /**
     * List semua user (untuk super admin)
     */
    public function index()
    {
        $users = User::with('school')->paginate(20);
        return view('users.index', compact('users'));
    }
    
    /**
     * Toggle status aktif/nonaktif user
     */
    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Status user berhasil diubah',
            'is_active' => $user->is_active
        ]);
    }
}
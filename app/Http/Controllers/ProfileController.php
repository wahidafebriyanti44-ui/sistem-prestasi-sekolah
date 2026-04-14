<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        try {
            // Update name
            $user->name = $request->name;
            
            // Update email
            $user->email = $request->email;
            
            // Update password jika diisi
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Hapus avatar lama jika ada
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                
                // Upload avatar baru dengan nama yang unik
                $file = $request->file('avatar');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $avatarPath = $file->storeAs('avatars', $fileName, 'public');
                
                // Simpan path ke database
                $user->avatar = $avatarPath;
                
                // Log untuk debugging
                \Log::info('Avatar uploaded successfully', [
                    'user_id' => $user->id,
                    'path' => $avatarPath,
                    'url' => asset('storage/' . $avatarPath)
                ]);
            }
            
            // Simpan perubahan
            $user->save();
            
            return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
            
        } catch (\Exception $e) {
            // Log error
            \Log::error('Profile update failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()
                ->with('error', 'Gagal memperbarui profile: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        
        try {
            // Hapus avatar jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Logout user
            Auth::logout();
            
            // Hapus user
            $user->delete();
            
            // Invalidate session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect('/')->with('success', 'Akun berhasil dihapus.');
            
        } catch (\Exception $e) {
            \Log::error('Account deletion failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()->with('error', 'Gagal menghapus akun: ' . $e->getMessage());
        }
    }

    /**
     * Remove avatar only (optional method)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAvatar(Request $request)
    {
        $user = Auth::user();
        
        try {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
                $user->avatar = null;
                $user->save();
                
                return redirect()->back()->with('success', 'Avatar berhasil dihapus.');
            }
            
            return redirect()->back()->with('error', 'Tidak ada avatar untuk dihapus.');
            
        } catch (\Exception $e) {
            \Log::error('Avatar removal failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()->with('error', 'Gagal menghapus avatar: ' . $e->getMessage());
        }
    }
}
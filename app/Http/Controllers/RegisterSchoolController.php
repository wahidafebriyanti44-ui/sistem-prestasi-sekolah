<?php

namespace App\Http\Controllers;

use App\Mail\SchoolOtpMail;
use App\Models\OtpCode;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterSchoolController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-school');
    }

    public function sendOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:schools,email|unique:users,email',
                'name' => 'required|string|max:255',
                'npsn' => 'required|string|size:8|unique:schools,npsn',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'postal_code' => 'nullable|string|max:10',
                'school_level' => 'required|in:sd,smp,sma,smk',
            ]);

            session(['school_registration' => $validated]);

            // Hapus OTP lama
            OtpCode::where('email', $validated['email'])
                ->where('type', OtpCode::TYPE_REGISTER_SCHOOL)
                ->delete();

            // Buat OTP baru
            $otp = OtpCode::createOtp($validated['email'], OtpCode::TYPE_REGISTER_SCHOOL);

            // Kirim email dengan OTP
            Mail::to($validated['email'])->send(new SchoolOtpMail($otp->code, $validated['name']));

            Log::info('OTP dikirim ke email', [
                'email' => $validated['email'],
                'otp' => $otp->code
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke email ' . $validated['email'],
                'debug_otp' => $otp->code // Hanya untuk development
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending OTP: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim OTP. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtpAndRegister(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'otp' => 'required|string|size:6',
                'password' => 'required|string|min:6|confirmed',
                'admin_name' => 'required|string|max:255',
                'admin_phone' => 'required|string|max:20',
            ]);

            $sessionData = session('school_registration');
            
            if (!$sessionData || $sessionData['email'] !== $validated['email']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi registrasi tidak valid. Silakan mulai ulang.'
                ], 400);
            }

            $isValid = OtpCode::verify($validated['email'], $validated['otp'], OtpCode::TYPE_REGISTER_SCHOOL);
            
            if (!$isValid) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode OTP tidak valid atau sudah kadaluarsa.'
                ], 400);
            }

            DB::beginTransaction();

            $school = School::create([
                'name' => $sessionData['name'],
                'npsn' => $sessionData['npsn'],
                'address' => $sessionData['address'],
                'phone' => $sessionData['phone'],
                'email' => $sessionData['email'],
                'city' => $sessionData['city'],
                'province' => $sessionData['province'],
                'postal_code' => $sessionData['postal_code'] ?? null,
                'school_level' => $sessionData['school_level'],
                'status' => School::STATUS_PENDING,
                'registration_token' => Str::random(32),
            ]);

            $admin = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['email'],
                'phone' => $validated['admin_phone'],
                'password' => Hash::make($validated['password']),
                'role' => User::ROLE_ADMIN_SEKOLAH,
                'school_id' => $school->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            DB::commit();
            session()->forget('school_registration');

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Silakan login setelah akun diverifikasi.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error registrasi sekolah: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
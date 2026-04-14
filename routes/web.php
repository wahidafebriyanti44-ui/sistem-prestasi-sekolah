<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolProfileController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterSchoolController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HafalanQuranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============= PUBLIC ROUTES =============
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============= PRESTASI PUBLIK =============
Route::prefix('publik')->name('publik.')->group(function () {
    Route::get('/prestasi', [HomeController::class, 'semuaPrestasi'])->name('prestasi.semua');
    Route::get('/prestasi/{id}', [HomeController::class, 'detailPrestasi'])->name('prestasi.detail');
    Route::get('/prestasi/siswa/{siswaId}', [HomeController::class, 'prestasiBySiswa'])->name('prestasi.siswa');
    Route::get('/prestasi/sekolah/{sekolahId}', [HomeController::class, 'prestasiBySekolah'])->name('prestasi.sekolah');
    Route::get('/prestasi/cari', [HomeController::class, 'cariPrestasi'])->name('prestasi.cari');
    Route::get('/prestasi/load-more', [HomeController::class, 'loadMorePrestasi'])->name('prestasi.load-more');
});

// TEST EMAIL
Route::get('/test-email', function () {
    return 'Test email berhasil';
});

// ============= REGISTRASI SEKOLAH (PUBLIC) =============
Route::get('/register-sekolah', [RegisterSchoolController::class, 'showRegisterForm'])->name('register.school');
Route::post('/register-sekolah/send-otp', [RegisterSchoolController::class, 'sendOtp'])->name('register.school.send-otp');
Route::post('/register-sekolah/verify-otp', [RegisterSchoolController::class, 'verifyOtpAndRegister'])->name('register.school.verify-otp');

// ============= ROUTES YANG MEMERLUKAN AUTHENTICATION =============
Route::middleware(['auth', 'verified'])->group(function () {

    // ================= USER MANAGEMENT =================
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::prefix('user')->group(function () {
        Route::post('/reset-password/{user}', [UserController::class, 'resetPassword'])->name('user.reset-password');
        Route::post('/set-password/{user}', [UserController::class, 'setPassword'])->name('user.set-password');
        Route::post('/toggle-active/{user}', [UserController::class, 'toggleActive'])->name('user.toggle-active');
    });

    // ================= DASHBOARD =================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ================= SCHOOLS =================
    Route::resource('schools', SchoolController::class);
    Route::patch('/schools/{school}/verify', [SchoolController::class, 'verify'])->name('schools.verify');

    // ================= SCHOOL PROFILE (PROFIL SEKOLAH UNTUK ADMIN SEKOLAH) =================
    // Redirect route untuk kompatibilitas dengan link lama
    Route::get('/school/profile', function() {
        return redirect()->route('school.profile.index');
    })->name('school.profile');
    
    // Route untuk menampilkan halaman index profil sekolah (view indexprofil.blade.php)
    Route::get('/school/profile/index', [SchoolProfileController::class, 'index'])->name('school.profile.index');
    
    // Route untuk menampilkan form create profil sekolah
    Route::get('/school/profile/create', [SchoolProfileController::class, 'create'])->name('school.profile.create');
    
    // Route untuk menyimpan data profil sekolah baru
    Route::post('/school/profile', [SchoolProfileController::class, 'store'])->name('school.profile.store');
    
    // Route untuk menampilkan form edit profil sekolah
    Route::get('/school/profile/edit', [SchoolProfileController::class, 'edit'])->name('school.profile.edit');
    
    // Route untuk update profil sekolah
    Route::put('/school/profile', [SchoolProfileController::class, 'update'])->name('school.profile.update');

    // ================= ROUTE KELAS =================
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // ================= SISWA =================
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/siswa/search', [SiswaController::class, 'search'])->name('siswa.search');
    Route::post('/siswa/{id}/eskul', [SiswaController::class, 'addEskul'])->name('siswa.eskul.add');
    Route::post('/siswa/{id}/minat', [SiswaController::class, 'addMinat'])->name('siswa.minat.add');

    // ================= PRESTASI =================
    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/prestasi/{prestasi}', [PrestasiController::class, 'show'])->name('prestasi.show');
    Route::get('/prestasi/{prestasi}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/prestasi/{prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{prestasi}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    Route::patch('/prestasi/{prestasi}/verify', [PrestasiController::class, 'verify'])->name('prestasi.verify');
    Route::patch('/prestasi/{prestasi}/reject', [PrestasiController::class, 'reject'])->name('prestasi.reject');

    // ================= EKSTRAKURIKULER =================
    Route::get('/eskul', [EskulController::class, 'index'])->name('eskul.index');
    Route::get('/eskul/create', [EskulController::class, 'create'])->name('eskul.create');
    Route::post('/eskul', [EskulController::class, 'store'])->name('eskul.store');
    Route::get('/eskul/{eskul}', [EskulController::class, 'show'])->name('eskul.show');
    Route::get('/eskul/{eskul}/edit', [EskulController::class, 'edit'])->name('eskul.edit');
    Route::put('/eskul/{eskul}', [EskulController::class, 'update'])->name('eskul.update');
    Route::delete('/eskul/{eskul}', [EskulController::class, 'destroy'])->name('eskul.destroy');

   // ================= MINAT BAKAT =================
Route::get('/minat-bakat', [MinatBakatController::class, 'index'])->name('minat-bakat.index');
Route::get('/minat-bakat/create', [MinatBakatController::class, 'create'])->name('minat-bakat.create');
Route::post('/minat-bakat', [MinatBakatController::class, 'store'])->name('minat-bakat.store');
Route::get('/minat-bakat/{minatBakat}', [MinatBakatController::class, 'show'])->name('minat-bakat.show');
Route::get('/minat-bakat/{minatBakat}/edit', [MinatBakatController::class, 'edit'])->name('minat-bakat.edit');
Route::put('/minat-bakat/{minatBakat}', [MinatBakatController::class, 'update'])->name('minat-bakat.update');
Route::delete('/minat-bakat/{minatBakat}', [MinatBakatController::class, 'destroy'])->name('minat-bakat.destroy');

// TAMBAHKAN ROUTE INI
Route::post('/minat-bakat/{minatBakat}/add-siswa', [MinatBakatController::class, 'addSiswa'])->name('minat-bakat.addSiswa');

    // ================= TEACHER (GURU) =================
    Route::resource('teachers', TeacherController::class);
    Route::post('/teachers/{id}/reset-password', [TeacherController::class, 'resetPassword'])->name('teachers.reset-password');

    // ================= HAFALAN QURAN =================
    Route::get('/siswa/{siswa}/hafalan', [HafalanQuranController::class, 'edit'])->name('siswa.hafalan.edit');
    Route::put('/siswa/{siswa}/hafalan', [HafalanQuranController::class, 'update'])->name('siswa.hafalan.update');
});

require __DIR__.'/auth.php';
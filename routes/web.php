

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
use App\Http\Controllers\LaporanController;
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
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/users', [UsersController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

Route::prefix('user')->group(function () {
    Route::post('/reset-password/{user}', [UsersController::class, 'resetPassword'])->name('user.reset-password');
    Route::post('/set-password/{user}', [UsersController::class, 'setPassword'])->name('user.set-password');
    Route::post('/toggle-active/{user}', [UsersController::class, 'toggleActive'])->name('user.toggle-active');
});

    // ================= DASHBOARD =================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // ================= SCHOOLS (KELOLA SEKOLAH - SUPER ADMIN) =================
    Route::resource('schools', SchoolController::class);
    Route::patch('/schools/{school}/verify', [SchoolController::class, 'verify'])->name('schools.verify');

   // ================= SCHOOL PROFILE (PROFIL SEKOLAH - ADMIN SEKOLAH) =================
Route::get('/school/profile', [SchoolProfileController::class, 'index'])->name('school.profile');
Route::get('/school/profile/create', [SchoolProfileController::class, 'create'])->name('school.profile.create');
Route::post('/school/profile', [SchoolProfileController::class, 'store'])->name('school.profile.store');
Route::get('/school/profile/edit', [SchoolProfileController::class, 'edit'])->name('school.profile.edit');
Route::put('/school/profile', [SchoolProfileController::class, 'update'])->name('school.profile.update');


    // ================= KELAS =================
    Route::resource('kelas', KelasController::class);

    // ================= SISWA =================
    Route::resource('siswa', SiswaController::class);
    Route::get('/siswa/search', [SiswaController::class, 'search'])->name('siswa.search');
    Route::post('/siswa/{id}/eskul', [SiswaController::class, 'addEskul'])->name('siswa.eskul.add');
    Route::post('/siswa/{id}/minat', [SiswaController::class, 'addMinat'])->name('siswa.minat.add');

    // ================= PRESTASI =================
    Route::resource('prestasi', PrestasiController::class);
    Route::patch('/prestasi/{prestasi}/verify', [PrestasiController::class, 'verify'])->name('prestasi.verify');
    Route::patch('/prestasi/{prestasi}/reject', [PrestasiController::class, 'reject'])->name('prestasi.reject');

    // ================= ROUTE INDOREGION (AJAX GET KABUPATEN) =================
    Route::get('/get-kabupaten', [PrestasiController::class, 'getKabupaten'])->name('get.kabupaten');

    // ================= EKSTRAKURIKULER =================
    Route::resource('eskul', EskulController::class);

    // ================= MINAT BAKAT =================
    Route::resource('minat-bakat', MinatBakatController::class);
    Route::post('/minat-bakat/{minatBakat}/add-siswa', [MinatBakatController::class, 'addSiswa'])->name('minat-bakat.addSiswa');

    // ================= TEACHER (GURU) =================
    Route::resource('teachers', TeacherController::class);
    Route::post('/teachers/{id}/reset-password', [TeacherController::class, 'resetPassword'])->name('teachers.reset-password');

    // ================= HAFALAN QURAN =================
    Route::get('/siswa/{siswa}/hafalan', [HafalanQuranController::class, 'edit'])->name('siswa.hafalan.edit');
    Route::put('/siswa/{siswa}/hafalan', [HafalanQuranController::class, 'update'])->name('siswa.hafalan.update');

    // ============= LAPORAN PDF =============
    Route::prefix('laporan')->name('laporan.')->group(function () {
        // Halaman index laporan
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        
        // PDF Detail Siswa (semua role)
        Route::get('/siswa/{id}/pdf', [LaporanController::class, 'pdfSiswa'])->name('pdf.siswa');
        
        // PDF Statistik Sekolah (Admin Sekolah)
        Route::get('/sekolah/pdf', [LaporanController::class, 'pdfSekolah'])->name('pdf.sekolah');
        
        // PDF Data Semua Siswa (Admin Sekolah)
        Route::get('/semua-siswa/pdf', [LaporanController::class, 'pdfSemuaSiswa'])->name('pdf.semua_siswa');
        
        // PDF Statistik Nasional (Super Admin)
        Route::get('/super-admin/pdf', [LaporanController::class, 'pdfSuperAdmin'])->name('pdf.superadmin');
    });
});



// ============= AUTH ROUTES (BAWAAN LARAVEL BREEZE) =============
require __DIR__.'/auth.php';
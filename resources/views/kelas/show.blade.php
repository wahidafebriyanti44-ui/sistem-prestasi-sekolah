<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Kelas - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f5fa; min-height: 100vh; }
        :root {
            --primary: #2A5C8A; --primary-dark: #1E4A73; --primary-light: #4A7BA9;
            --primary-soft: #E8F0FE; --secondary: #5F6B7A; --success: #28A745;
            --danger: #DC3545; --warning: #FFC107; --dark: #2D3E50;
            --gray-soft: #F8FAFC; --sidebar-width: 260px;
        }
        .container { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #FFFFFF 0%, #F5F9FF 100%);
            border-right: 1px solid rgba(42, 92, 138, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.03);
            padding-bottom: 20px;
        }
        .sidebar-header { padding: 15px 15px 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 8px; }
        .brand-icon { width: 35px; height: 35px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(42, 92, 138, 0.2); }
        .brand-icon i { font-size: 18px; color: white; }
        .brand-text { font-size: 18px; font-weight: 800; color: var(--primary); }
        .brand-sub { font-size: 9px; color: var(--secondary); }
        
        .sidebar-profile { padding: 5px 15px 10px; border-bottom: 1px solid rgba(42, 92, 138, 0.08); margin-bottom: 5px; }
        .profile-card { background: var(--gray-soft); border-radius: 12px; padding: 10px; border: 1px solid rgba(42, 92, 138, 0.08); }
        .profile-avatar-wrapper { position: relative; width: 45px; height: 45px; margin-bottom: 8px; cursor: pointer; }
        .profile-avatar { width: 100%; height: 100%; border-radius: 12px; object-fit: cover; border: 2px solid white; }
        .avatar-upload { position: absolute; bottom: -2px; right: -2px; width: 20px; height: 20px; background: var(--primary); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; border: 2px solid white; font-size: 10px; }
        .profile-name { font-size: 13px; font-weight: 700; color: var(--dark); margin-bottom: 3px; }
        .profile-role { display: inline-flex; align-items: center; gap: 4px; background: rgba(42, 92, 138, 0.1); padding: 3px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; color: var(--primary); }
        .profile-email { font-size: 10px; color: var(--secondary); margin-top: 6px; display: flex; align-items: center; gap: 4px; background: white; padding: 5px 8px; border-radius: 8px; }
        .profile-email i { color: var(--primary); }
        
        .menu-title { padding: 10px 15px 3px; font-size: 9px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; }
        .sidebar-menu { list-style: none; padding: 0 10px; }
        .sidebar-menu li { margin-bottom: 2px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 8px; padding: 8px 10px; color: var(--secondary); text-decoration: none; border-radius: 10px; font-weight: 500; font-size: 12px; }
        .sidebar-menu a i { width: 18px; font-size: 14px; }
        .sidebar-menu a:hover { background: var(--primary-soft); color: var(--primary); }
        .sidebar-menu a.active { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; box-shadow: 0 4px 8px rgba(42, 92, 138, 0.25); }
        .sidebar-menu a.active i { color: white; }
        
        .sidebar-footer { position: sticky; bottom: 0; padding: 10px 15px; background: white; border-top: 1px solid rgba(42, 92, 138, 0.08); margin-top: 10px; }
        .logout-btn { display: flex; align-items: center; gap: 8px; padding: 8px 10px; background: #FFF1F0; color: var(--danger); border: none; border-radius: 10px; font-weight: 600; font-size: 12px; cursor: pointer; width: 100%; }
        .logout-btn:hover { background: var(--danger); color: white; }
        
        .main-content { flex: 1; margin-left: var(--sidebar-width); padding: 20px; transition: margin-left 0.3s ease; }
        .top-nav { background: white; padding: 15px 20px; border-radius: 16px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(42, 92, 138, 0.08); }
        .page-title h1 { font-size: 20px; font-weight: 700; color: var(--dark); margin-bottom: 3px; }
        .page-title p { color: var(--secondary); font-size: 12px; display: flex; align-items: center; gap: 5px; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .notification { position: relative; width: 38px; height: 38px; background: #F5F8FA; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .badge-count { position: absolute; top: -5px; right: -5px; background: var(--danger); color: white; font-size: 9px; padding: 2px 5px; border-radius: 20px; border: 2px solid white; font-weight: 700; }
        .user-dropdown { display: flex; align-items: center; gap: 8px; background: #F5F8FA; padding: 5px 5px 5px 12px; border-radius: 30px; cursor: pointer; }
        .user-avatar { width: 32px; height: 32px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px; }
        .user-avatar img { width: 100%; height: 100%; border-radius: 8px; object-fit: cover; }
        
        /* Action Bar */
        .action-bar { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; font-family: 'Inter', sans-serif; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; box-shadow: 0 4px 8px rgba(42, 92, 138, 0.25); }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-2px); }
        .btn-edit { background: var(--warning); color: var(--dark); }
        .btn-edit:hover { opacity: 0.9; transform: translateY(-2px); }
        .btn-back { background: #F1F4F9; color: var(--dark); border: 1px solid rgba(42, 92, 138, 0.1); }
        .btn-back:hover { background: #E5E9F0; }
        
        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px; }
        .stat-card { background: white; padding: 20px; border-radius: 16px; border: 1px solid rgba(42, 92, 138, 0.08); display: flex; align-items: center; justify-content: space-between; }
        .stat-info h3 { font-size: 12px; font-weight: 600; color: var(--secondary); margin-bottom: 5px; }
        .stat-info p { font-size: 24px; font-weight: 700; color: var(--dark); }
        .stat-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .stat-icon.blue { background: var(--primary-soft); color: var(--primary); }
        .stat-icon.green { background: #E3F2E9; color: var(--success); }
        .stat-icon.purple { background: #F0E6FF; color: #8B5CF6; }
        .stat-icon.yellow { background: #FFF4E5; color: var(--warning); }
        
        /* Card */
        .card { background: white; border-radius: 16px; border: 1px solid rgba(42, 92, 138, 0.08); margin-bottom: 25px; overflow: hidden; }
        .card-header { padding: 20px; border-bottom: 1px solid rgba(42, 92, 138, 0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .card-header h2 { font-size: 18px; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 8px; }
        .card-header h2 i { color: var(--primary); }
        .card-body { padding: 20px; }
        
        /* Info Grid */
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .info-item { margin-bottom: 15px; padding: 15px; background: var(--gray-soft); border-radius: 12px; border: 1px solid rgba(42, 92, 138, 0.05); }
        .info-label { font-size: 11px; color: var(--secondary); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.3px; }
        .info-value { font-size: 14px; color: var(--dark); font-weight: 600; display: flex; align-items: center; gap: 8px; }
        .info-value i { width: 18px; color: var(--primary); }
        
        /* Students Grid */
        .students-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
        .student-item { background: var(--gray-soft); padding: 15px; border-radius: 12px; display: flex; align-items: center; gap: 15px; border: 1px solid rgba(42, 92, 138, 0.05); transition: all 0.2s ease; }
        .student-item:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        .student-avatar { width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 20px; flex-shrink: 0; }
        .student-avatar img { width: 100%; height: 100%; border-radius: 12px; object-fit: cover; }
        .student-info { flex: 1; }
        .student-info h4 { font-size: 15px; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .student-info p { font-size: 12px; color: var(--secondary); display: flex; align-items: center; gap: 5px; margin-bottom: 3px; }
        .student-info p i { width: 14px; color: var(--primary); font-size: 11px; }
        .student-link { width: 32px; height: 32px; background: var(--primary-soft); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--primary); text-decoration: none; transition: all 0.2s ease; }
        .student-link:hover { background: var(--primary); color: white; }
        
        /* Empty State */
        .empty-state { text-align: center; padding: 60px 20px; background: var(--gray-soft); border-radius: 16px; }
        .empty-state i { font-size: 60px; color: #ddd; margin-bottom: 15px; }
        .empty-state p { color: var(--secondary); margin-bottom: 20px; font-size: 14px; }
        
        .alert { padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 500; font-size: 13px; border-left: 4px solid; }
        .alert-success { background: #E3F2E9; color: #065F46; border-left-color: var(--success); }
        .alert-danger { background: #FFE9E9; color: var(--danger); border-left-color: var(--danger); }
        
        .mobile-menu-btn { display: none; position: fixed; top: 15px; left: 15px; z-index: 1001; width: 40px; height: 40px; background: var(--primary); border: none; border-radius: 10px; color: white; font-size: 18px; cursor: pointer; }
        
        @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); position: fixed; width: 240px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-menu-btn { display: block; }
            .top-nav { flex-direction: column; align-items: flex-start; padding-top: 60px; }
            .user-info { width: 100%; justify-content: space-between; }
            .stats-grid { grid-template-columns: 1fr; }
            .info-grid { grid-template-columns: 1fr; }
            .students-grid { grid-template-columns: 1fr; }
            .action-bar { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
        }
        
        .profile-modal { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(5px); }
        .profile-modal.active { display: flex; }
        .modal-content { background: white; border-radius: 20px; max-width: 450px; width: 90%; max-height: 90vh; overflow-y: auto; }
        .modal-header { padding: 20px; border-bottom: 1px solid rgba(42, 92, 138, 0.08); }
        .modal-header h3 { font-size: 20px; font-weight: 700; color: var(--dark); }
        .modal-body { padding: 20px; }
        .modal-footer { padding: 15px 20px; border-top: 1px solid rgba(42, 92, 138, 0.08); display: flex; gap: 12px; justify-content: flex-end; }
        .btn-save { padding: 10px 20px; background: var(--primary); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .btn-cancel { padding: 10px 20px; background: #F1F4F9; color: var(--dark); border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .current-avatar { margin-top: 8px; display: flex; align-items: center; gap: 8px; padding: 8px; background: var(--gray-soft); border-radius: 10px; }
        .current-avatar img { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>

    <div class="container">
       <!-- Sidebar - SAMA UNTUK SEMUA ROLE DAN SEMUA HALAMAN -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="brand-wrapper">
            <div class="brand-icon">
                <i class="fas fa-medal"></i>
            </div>
            <div>
                <div class="brand-text">SIPRES</div>
                <div class="brand-sub">Sistem Prestasi Siswa</div>
            </div>
        </div>
    </div>

    <div class="sidebar-profile">
        <div class="profile-card">
            <div class="profile-avatar-wrapper" onclick="openProfileModal()">
                <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'User').'&background=2A5C8A&color=fff&size=100' }}" 
                     class="profile-avatar" 
                     id="profileImage">
                <div class="avatar-upload">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
            <div class="profile-role">
                @if(Auth::user()->role == 'super_admin')
                    <i class="fas fa-crown"></i> SUPER ADMIN
                @elseif(Auth::user()->role == 'admin_sekolah')
                    <i class="fas fa-school"></i> ADMIN SEKOLAH
                @else
                    <i class="fas fa-chalkboard-teacher"></i> GURU
                @endif
            </div>
            <div class="profile-email">
                <i class="far fa-envelope"></i>
                {{ Auth::user()->email ?? 'user@sipres.com' }}
            </div>
        </div>
    </div>
    
    @php
        $currentRoute = request()->route()->getName();
        $user = Auth::user();
    @endphp

    <!-- MENU UTAMA - SAMA UNTUK SEMUA ROLE -->
    <div class="menu-title">MENU UTAMA</div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
    </ul>

    <!-- MANAJEMEN DATA - SAMA URUTANNYA UNTUK SEMUA -->
    <div class="menu-title">DATA MASTER</div>
    <ul class="sidebar-menu">
        <!-- Profil Sekolah - Hanya untuk Admin Sekolah -->
        @if($user->role == 'admin_sekolah')
        <li>
            <a href="{{ route('school.profile') }}" class="{{ $currentRoute == 'school.profile' ? 'active' : '' }}">
                <i class="fas fa-building"></i> Profil Sekolah
            </a>
        </li>
        @endif

        <!-- Kelas - Semua role bisa akses -->
        <li>
            <a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                <i class="fas fa-school"></i> Kelas
            </a>
        </li>

        <!-- Siswa - Semua role bisa akses -->
        <li>
            <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Siswa
            </a>
        </li>

        <!-- Guru - Hanya untuk Super Admin dan Admin Sekolah -->
        @if(in_array($user->role, ['super_admin', 'admin_sekolah']))
        <li>
            <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Guru
            </a>
        </li>
        @endif

        <!-- Prestasi - Semua role bisa akses -->
        <li>
            <a href="{{ route('prestasi.index') }}" class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                <i class="fas fa-trophy"></i> Prestasi
            </a>
        </li>

        <!-- Ekstrakurikuler - Semua role bisa akses -->
        <li>
            <a href="{{ route('eskul.index') }}" class="{{ request()->routeIs('eskul.*') ? 'active' : '' }}">
                <i class="fas fa-futbol"></i> Ekstrakurikuler
            </a>
        </li>

        <!-- Minat & Bakat - Semua role bisa akses -->
        <li>
            <a href="{{ route('minat-bakat.index') }}" class="{{ request()->routeIs('minat-bakat.*') ? 'active' : '' }}">
                <i class="fas fa-heart"></i> Minat & Bakat
            </a>
        </li>
    </ul>

    <!-- SUPER ADMIN ONLY - KELOLA SEKOLAH -->
    @if($user->role == 'super_admin')
    <div class="menu-title">SUPER ADMIN</div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('schools.index') }}" class="{{ request()->routeIs('schools.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Kelola Sekolah
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i> Kelola User
            </a>
        </li>
    </ul>
    @endif

    <!-- LOGOUT -->
    <div class="sidebar-footer">
        <button onclick="confirmLogout()" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar dari SIPRES</span>
        </button>
    </div>
</div>
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <div class="top-nav">
                <div class="page-title">
                    <h1>Detail Kelas</h1>
                    <p><i class="fas fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="user-info">
                    <div class="notification"><i class="far fa-bell"></i><span class="badge-count">3</span></div>
                    <div class="user-dropdown" onclick="openProfileModal()">
                        <div class="user-avatar">@if(Auth::user() && Auth::user()->avatar)<img src="{{ Auth::user()->avatar_url }}">@else{{ substr(Auth::user()->name ?? 'AD', 0, 1) }}@endif</div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span><i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif

            <!-- Action Buttons -->
            <div class="action-bar">
                <a href="{{ route('kelas.index') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                
                @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-edit"><i class="fas fa-edit"></i> Edit Kelas</a>
                @endif
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info"><h3>Total Siswa</h3><p>{{ $kelas->siswa->count() }}</p></div>
                    <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Total Prestasi</h3>
                        <p>{{ $kelas->siswa->sum(function($s) { return $s->prestasi->count(); }) }}</p>
                    </div>
                    <div class="stat-icon green"><i class="fas fa-trophy"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info"><h3>Wali Kelas</h3><p>{{ $kelas->waliKelas ? 'Ada' : 'Tidak Ada' }}</p></div>
                    <div class="stat-icon purple"><i class="fas fa-user-tie"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info"><h3>Tingkat</h3><p>{{ $kelas->tingkat }}</p></div>
                    <div class="stat-icon yellow"><i class="fas fa-layer-group"></i></div>
                </div>
            </div>

            <!-- Informasi Kelas -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-info-circle"></i> Informasi Kelas</h2>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div>
                            <div class="info-item">
                                <div class="info-label">Nama Kelas</div>
                                <div class="info-value"><i class="fas fa-school"></i> {{ $kelas->nama_kelas }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tingkat</div>
                                <div class="info-value"><i class="fas fa-layer-group"></i> Kelas {{ $kelas->tingkat }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Sekolah</div>
                                <div class="info-value"><i class="fas fa-building"></i> {{ $kelas->school->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="info-item">
                                <div class="info-label">Wali Kelas</div>
                                <div class="info-value"><i class="fas fa-user-tie"></i> {{ $kelas->waliKelas->name ?? 'Belum ada wali kelas' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email Wali Kelas</div>
                                <div class="info-value"><i class="fas fa-envelope"></i> {{ $kelas->waliKelas->email ?? '-' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Dibuat Pada</div>
                                <div class="info-value"><i class="fas fa-calendar"></i> {{ $kelas->created_at ? $kelas->created_at->translatedFormat('d F Y') : '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Siswa -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-users"></i> Daftar Siswa ({{ $kelas->siswa->count() }})</h2>
                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                    <a href="{{ route('siswa.create', ['kelas_id' => $kelas->id]) }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 12px;">
                        <i class="fas fa-plus"></i> Tambah Siswa
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($kelas->siswa->count() > 0)
                    <div class="students-grid">
                        @foreach($kelas->siswa as $siswa)
                        <div class="student-item">
                            <div class="student-avatar">
                                @if($siswa->foto)<img src="{{ $siswa->foto_url }}">@else{{ substr($siswa->nama_lengkap, 0, 1) }}@endif
                            </div>
                            <div class="student-info">
                                <h4>{{ $siswa->nama_lengkap }}</h4>
                                <p><i class="fas fa-id-card"></i> NIS: {{ $siswa->nis ?? '-' }}</p>
                                <p><i class="fas fa-trophy"></i> Prestasi: {{ $siswa->prestasi->count() }}</p>
                            </div>
                            <a href="{{ route('siswa.show', $siswa->id) }}" class="student-link" title="Lihat Detail"><i class="fas fa-arrow-right"></i></a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-users-slash"></i>
                        <p>Belum ada siswa di kelas ini</p>
                        @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                        <a href="{{ route('siswa.create', ['kelas_id' => $kelas->id]) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Siswa Sekarang</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header"><h3><i class="fas fa-user-edit"></i> Edit Profile</h3></div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-camera"></i> Foto Profile</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <small style="color: var(--secondary); display: block; margin-top: 5px;">Format: JPG, PNG. Maks: 2MB</small>
                        @if(Auth::user() && Auth::user()->avatar)
                        <div class="current-avatar"><img src="{{ Auth::user()->avatar_url }}"><span>Avatar saat ini</span></div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-lock"></i> Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeProfileModal()"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>

    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function openProfileModal() { document.getElementById('profileModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
        function closeProfileModal() { document.getElementById('profileModal').classList.remove('active'); document.body.style.overflow = ''; }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) { document.getElementById('profileImage').src = e.target.result; };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function confirmLogout() { if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) document.getElementById('logout-form').submit(); }
        window.addEventListener('click', function(e) { const modal = document.getElementById('profileModal'); if (e.target === modal) closeProfileModal(); });
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar'), mobileBtn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768 && sidebar.classList.contains('active') && !sidebar.contains(event.target) && !mobileBtn.contains(event.target)) sidebar.classList.remove('active');
        });
        setTimeout(() => { document.querySelectorAll('.alert').forEach(alert => { alert.style.transition = 'opacity 0.5s ease'; alert.style.opacity = '0'; setTimeout(() => alert.remove(), 500); }); }, 5000);
    </script>
</body>
</html>
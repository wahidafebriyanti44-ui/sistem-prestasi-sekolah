<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Prestasi - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f5fa;
            min-height: 100vh;
        }

        :root {
            --primary: #2A5C8A;
            --primary-dark: #1E4A73;
            --primary-light: #4A7BA9;
            --primary-soft: #E8F0FE;
            --secondary: #5F6B7A;
            --success: #28A745;
            --danger: #DC3545;
            --warning: #FFC107;
            --dark: #2D3E50;
            --light: #FFFFFF;
            --gray-soft: #F8FAFC;
            --sidebar-width: 260px;
        }

        /* Container */
        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #FFFFFF 0%, #F5F9FF 100%);
            border-right: 1px solid rgba(42, 92, 138, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.03);
            padding-bottom: 20px;
        }

        .sidebar-header {
            padding: 15px 15px 5px;
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.2);
        }

        .brand-icon i {
            font-size: 18px;
            color: white;
        }

        .brand-text {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .brand-sub {
            font-size: 9px;
            color: var(--secondary);
            margin-top: 0px;
        }

        .sidebar-profile {
            padding: 5px 15px 10px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            margin-bottom: 5px;
        }

        .profile-card {
            background: var(--gray-soft);
            border-radius: 12px;
            padding: 10px;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .profile-avatar-wrapper {
            position: relative;
            width: 45px;
            height: 45px;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.15);
        }

        .avatar-upload {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            border: 2px solid white;
            font-size: 10px;
            transition: all 0.2s ease;
        }

        .avatar-upload:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
        }

        .profile-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 3px;
        }

        .profile-role {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: rgba(42, 92, 138, 0.1);
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            color: var(--primary);
        }

        .profile-role i {
            font-size: 9px;
            color: #FFB800;
        }

        .profile-email {
            font-size: 10px;
            color: var(--secondary);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
            background: white;
            padding: 5px 8px;
            border-radius: 8px;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .profile-email i {
            color: var(--primary);
            font-size: 10px;
        }

        .menu-title {
            padding: 10px 15px 3px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--secondary);
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 10px;
        }

        .sidebar-menu li {
            margin-bottom: 2px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            color: var(--secondary);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 12px;
        }

        .sidebar-menu a i {
            width: 18px;
            font-size: 14px;
            color: var(--secondary);
        }

        .sidebar-menu a:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .sidebar-menu a:hover i {
            color: var(--primary);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.25);
        }

        .sidebar-menu a.active i {
            color: white;
        }

        .sidebar-footer {
            position: sticky;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 15px;
            background: white;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
            margin-top: 10px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            background: #FFF1F0;
            color: var(--danger);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            width: 100%;
            border: 1px solid rgba(220, 53, 69, 0.1);
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
        }

        .logout-btn i {
            width: 18px;
            font-size: 14px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .top-nav {
            background: white;
            padding: 15px 20px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .page-title h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 3px;
        }

        .page-title p {
            color: var(--secondary);
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification {
            position: relative;
            width: 38px;
            height: 38px;
            background: #F5F8FA;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .notification i {
            font-size: 16px;
            color: var(--secondary);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 9px;
            padding: 2px 5px;
            border-radius: 20px;
            border: 2px solid white;
            font-weight: 700;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #F5F8FA;
            padding: 5px 5px 5px 12px;
            border-radius: 30px;
            cursor: pointer;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .user-dropdown span {
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
        }

        .user-dropdown i {
            font-size: 11px;
            color: var(--secondary);
            margin-right: 5px;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .action-bar h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.25);
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--gray-soft);
            color: var(--dark);
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .btn-secondary:hover {
            background: #E5E9F0;
        }

        .btn i {
            margin-right: 6px;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
        }

        .card-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-header h2 i {
            color: var(--primary);
        }

        .card-body {
            padding: 20px;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 600;
            font-size: 13px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 12px;
            font-size: 13px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 12px;
            font-size: 13px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
            background-color: white;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Required Field */
        .required {
            color: var(--danger);
            margin-left: 2px;
        }

        .required-note {
            font-size: 12px;
            color: var(--secondary);
            margin-top: 10px;
            background: var(--gray-soft);
            padding: 8px 12px;
            border-radius: 8px;
        }

        .required-note .required {
            font-size: 14px;
        }

        /* Error Styles */
        .is-invalid {
            border-color: var(--danger) !important;
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 12px;
            margin-top: 4px;
            font-weight: 500;
        }

        /* Info Siswa Card */
        .student-info-card {
            background: var(--primary-soft);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.2);
        }

        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-details h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .student-details p {
            font-size: 12px;
            color: var(--secondary);
        }

        /* File Upload */
        .upload-container {
            border: 2px dashed #E5E9F0;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
            background: var(--gray-soft);
        }

        .upload-container:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .upload-icon {
            font-size: 48px;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .upload-text {
            color: var(--secondary);
            margin-bottom: 15px;
            font-size: 14px;
        }

        .file-label {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            background: white;
            color: var(--primary);
            font-weight: 600;
            font-size: 13px;
            border: 1px solid rgba(42, 92, 138, 0.2);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .file-label:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .file-help {
            font-size: 11px;
            color: var(--secondary);
            margin-top: 8px;
        }

        .selected-file {
            margin-top: 10px;
            padding: 10px;
            background: #E3F2E9;
            border-radius: 8px;
            color: var(--success);
            font-size: 13px;
            display: none;
            align-items: center;
            gap: 8px;
        }

        .selected-file i {
            font-size: 16px;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 13px;
            border-left: 4px solid;
        }

        .alert-danger {
            background: #FFE9E9;
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .debug-info {
            background: var(--primary-soft);
            color: var(--primary);
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            width: 40px;
            height: 40px;
            background: var(--primary);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                width: 240px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .top-nav {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
                padding-top: 60px;
            }

            .user-info {
                width: 100%;
                justify-content: space-between;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .student-info-card {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 10px;
            }

            .top-nav {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

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
            <!-- Top Navigation -->
            <div class="top-nav">
                <div class="page-title">
                    <h1>Tambah Prestasi Baru</h1>
                    <p>
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </p>
                </div>
                <div class="user-info">
                    <div class="notification">
                        <i class="far fa-bell"></i>
                        <span class="badge-count">3</span>
                    </div>
                    <div class="user-dropdown" onclick="openProfileModal()">
                        <div class="user-avatar">
                            @if(Auth::user() && Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar_url }}" alt="Avatar">
                            @else
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            @endif
                        </div>
                        <span>{{ Auth::user()->name ?? 'User' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('debug'))
            <div class="debug-info">
                <i class="fas fa-info-circle"></i> {{ session('debug') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> 
                <span>Terdapat kesalahan pada input data. Silakan periksa kembali.</span>
            </div>
            @endif

            <!-- Action Bar -->
            <div class="action-bar">
                <h2>Form Tambah Prestasi</h2>
                <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Form Card -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-trophy"></i>
                        Data Prestasi
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if(isset($siswa))
                        <!-- Hidden input jika dari halaman siswa -->
                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                        
                        <!-- Info siswa (readonly) -->
                        <div class="student-info-card">
                            <div class="student-avatar">
                                @if($siswa->foto)
                                    <img src="{{ $siswa->foto_url }}" alt="{{ $siswa->nama_lengkap }}">
                                @else
                                    {{ substr($siswa->nama_lengkap, 0, 1) }}
                                @endif
                            </div>
                            <div class="student-details">
                                <h3>{{ $siswa->nama_lengkap }}</h3>
                                <p>NIS: {{ $siswa->nis }} | Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="form-grid">
                            <!-- Pilih Siswa -->
                            @if(!isset($siswa))
                            <div class="full-width">
                                <div class="form-group">
                                    <label for="siswa_id" class="form-label">
                                        Pilih Siswa <span class="required">*</span>
                                    </label>
                                    <select id="siswa_id" 
                                            name="siswa_id" 
                                            class="form-select @error('siswa_id') is-invalid @enderror" 
                                            required>
                                        <option value="">Pilih Siswa</option>
                                        @foreach($siswaList as $s)
                                        <option value="{{ $s->id }}" {{ old('siswa_id') == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_lengkap }} ({{ $s->nis }}) - {{ $s->kelas->nama_kelas ?? 'Tanpa Kelas' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('siswa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <!-- Jenis Prestasi -->
                            <div class="form-group">
                                <label for="jenis_prestasi" class="form-label">
                                    Jenis Prestasi <span class="required">*</span>
                                </label>
                                <select id="jenis_prestasi" 
                                        name="jenis_prestasi" 
                                        class="form-select @error('jenis_prestasi') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="akademik" {{ old('jenis_prestasi') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="non_akademik" {{ old('jenis_prestasi') == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                                </select>
                                @error('jenis_prestasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Lomba -->
                            <div class="form-group">
                                <label for="nama_lomba" class="form-label">
                                    Nama Lomba <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="nama_lomba" 
                                       name="nama_lomba" 
                                       value="{{ old('nama_lomba') }}" 
                                       class="form-control @error('nama_lomba') is-invalid @enderror" 
                                       placeholder="Contoh: Olimpiade Matematika"
                                       required>
                                @error('nama_lomba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tingkat -->
                            <div class="form-group">
                                <label for="tingkat" class="form-label">
                                    Tingkat Lomba <span class="required">*</span>
                                </label>
                                <select id="tingkat" 
                                        name="tingkat" 
                                        class="form-select @error('tingkat') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="sekolah" {{ old('tingkat') == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="kecamatan" {{ old('tingkat') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="kabupaten" {{ old('tingkat') == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    <option value="provinsi" {{ old('tingkat') == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="nasional" {{ old('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="internasional" {{ old('tingkat') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Peringkat -->
                            <div class="form-group">
                                <label for="peringkat" class="form-label">
                                    Peringkat/Hasil <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="peringkat" 
                                       name="peringkat" 
                                       value="{{ old('peringkat') }}" 
                                       class="form-control @error('peringkat') is-invalid @enderror" 
                                       placeholder="Contoh: Juara 1, Harapan 1, Peserta"
                                       required>
                                @error('peringkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tahun -->
                            <div class="form-group">
                                <label for="tahun" class="form-label">
                                    Tahun <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       id="tahun" 
                                       name="tahun" 
                                       value="{{ old('tahun', date('Y')) }}" 
                                       class="form-control @error('tahun') is-invalid @enderror" 
                                       min="2000" 
                                       max="{{ date('Y') }}"
                                       required>
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="full-width">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" 
                                              name="deskripsi" 
                                              class="form-control @error('deskripsi') is-invalid @enderror" 
                                              rows="3"
                                              placeholder="Deskripsi prestasi (opsional)">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Upload Sertifikat -->
                            <div class="full-width">
                                <div class="form-group">
                                    <label class="form-label">Upload Sertifikat</label>
                                    <div class="upload-container" onclick="document.getElementById('file_sertifikat').click()">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p class="upload-text">Klik untuk upload file sertifikat (PDF/JPG/PNG)</p>
                                        <span class="file-label" for="file_sertifikat">Pilih File</span>
                                        <p class="file-help">Maksimal 5MB</p>
                                    </div>
                                    <input type="file" 
                                           id="file_sertifikat"
                                           name="file_sertifikat" 
                                           accept=".pdf,.jpg,.jpeg,.png"
                                           class="file-input @error('file_sertifikat') is-invalid @enderror"
                                           style="display: none;">
                                    <div id="selectedFile" class="selected-file">
                                        <i class="fas fa-check-circle"></i> 
                                        <span id="fileName"></span>
                                    </div>
                                    @error('file_sertifikat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="required-note">
                            <span class="required">*</span> Wajib diisi
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Prestasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="profile-modal" id="profileModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
        <div class="modal-content" style="background: white; padding: 30px; border-radius: 20px; max-width: 400px; width: 90%;">
            <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 5px; color: var(--dark);">Edit Profile</h3>
            <p style="color: var(--secondary); margin-bottom: 20px; font-size: 13px;">Perbarui informasi profile Anda</p>
            
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--dark); font-size: 12px;">
                        <i class="fas fa-camera" style="color: var(--primary); margin-right: 4px;"></i>
                        Foto Profile
                    </label>
                    <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)" style="width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; font-size: 13px;">
                    <small style="color: var(--secondary); margin-top: 5px; display: block;">Format: JPG, PNG. Maks: 2MB</small>
                    
                    @if(Auth::user() && Auth::user()->avatar)
                    <div class="current-avatar" style="margin-top: 8px; display: flex; align-items: center; gap: 8px; padding: 8px; background: var(--gray-soft); border-radius: 10px;">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                        <span style="font-size: 12px; color: var(--secondary);">Avatar saat ini</span>
                    </div>
                    @endif
                </div>
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--dark); font-size: 12px;">
                        <i class="fas fa-user" style="color: var(--primary); margin-right: 4px;"></i>
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required style="width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; font-size: 13px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--dark); font-size: 12px;">
                        <i class="fas fa-envelope" style="color: var(--primary); margin-right: 4px;"></i>
                        Email
                    </label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required style="width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; font-size: 13px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--dark); font-size: 12px;">
                        <i class="fas fa-lock" style="color: var(--primary); margin-right: 4px;"></i>
                        Password Baru
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah" style="width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; font-size: 13px;">
                </div>
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--dark); font-size: 12px;">
                        <i class="fas fa-lock" style="color: var(--primary); margin-right: 4px;"></i>
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" style="width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; font-size: 13px;">
                </div>
                
                <div class="modal-actions" style="display: flex; gap: 12px; margin-top: 20px;">
                    <button type="button" class="btn-cancel" onclick="closeProfileModal()" style="flex: 1; padding: 12px; background: #F1F4F9; color: var(--dark); border: none; border-radius: 10px; font-weight: 600; font-size: 13px; cursor: pointer;">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn-save" style="flex: 1; padding: 12px; background: var(--primary); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 13px; cursor: pointer;">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    <!-- JavaScript -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        function openProfileModal() {
            document.getElementById('profileModal').style.display = 'flex';
        }

        function closeProfileModal() {
            document.getElementById('profileModal').style.display = 'none';
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmLogout() {
            if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Handle file selection
        document.getElementById('file_sertifikat').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const selectedFileDiv = document.getElementById('selectedFile');
            const fileNameSpan = document.getElementById('fileName');
            const uploadText = document.querySelector('.upload-text');
            
            if (file) {
                // Validasi ukuran file (maks 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB');
                    this.value = '';
                    selectedFileDiv.style.display = 'none';
                    return;
                }
                
                // Validasi tipe file
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Tipe file harus PDF, JPG, atau PNG');
                    this.value = '';
                    selectedFileDiv.style.display = 'none';
                    return;
                }
                
                fileNameSpan.textContent = file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
                selectedFileDiv.style.display = 'flex';
                uploadText.innerHTML = '<i class="fas fa-check-circle" style="color: #28a745;"></i> File dipilih';
            } else {
                selectedFileDiv.style.display = 'none';
                uploadText.innerHTML = 'Klik untuk upload file sertifikat (PDF/JPG/PNG)';
            }
        });

        // Trigger file input when clicking on upload container
        document.querySelector('.upload-container').addEventListener('click', function() {
            document.getElementById('file_sertifikat').click();
        });

        window.addEventListener('click', function(e) {
            const modal = document.getElementById('profileModal');
            if (e.target === modal) {
                closeProfileModal();
            }
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768) {
                if (sidebar.classList.contains('active') && 
                    !sidebar.contains(event.target) && 
                    !mobileBtn.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
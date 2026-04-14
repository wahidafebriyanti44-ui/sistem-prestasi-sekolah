<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Sekolah - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* (SEMUA CSS SAMA SEPERTI SEBELUMNYA, TIDAK BERUBAH) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
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
            --info: #17A2B8;
            --dark: #2D3E50;
            --light: #FFFFFF;
            --gray-soft: #F8FAFC;
            --gray-border: #E5E9F0;
            --sidebar-width: 260px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-primary: 0 4px 15px rgba(42, 92, 138, 0.2);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFE 100%);
            border-right: 1px solid rgba(42, 92, 138, 0.08);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        .sidebar-header {
            padding: 20px 20px 10px;
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-primary);
        }

        .brand-icon i {
            font-size: 20px;
            color: white;
        }

        .brand-text {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .brand-sub {
            font-size: 9px;
            color: var(--secondary);
            margin-top: 2px;
        }

        .sidebar-profile {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            margin-bottom: 10px;
        }

        .profile-card {
            background: var(--gray-soft);
            border-radius: 16px;
            padding: 15px;
            border: 1px solid rgba(42, 92, 138, 0.08);
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .profile-avatar-wrapper {
            position: relative;
            width: 55px;
            height: 55px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 14px;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: var(--shadow-sm);
        }

        .avatar-upload {
            position: absolute;
            bottom: -3px;
            right: -3px;
            width: 22px;
            height: 22px;
            background: var(--primary);
            border-radius: 8px;
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
            transform: scale(1.1);
        }

        .profile-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .profile-role {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(42, 92, 138, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            color: var(--primary);
        }

        .profile-email {
            font-size: 10px;
            color: var(--secondary);
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            background: white;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .menu-title {
            padding: 15px 20px 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--secondary);
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 12px;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: var(--secondary);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 13px;
        }

        .sidebar-menu a i {
            width: 20px;
            font-size: 16px;
            color: var(--secondary);
            transition: all 0.2s ease;
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
            box-shadow: var(--shadow-primary);
        }

        .sidebar-menu a.active i {
            color: white;
        }

        .sidebar-footer {
            position: sticky;
            bottom: 0;
            padding: 15px 20px;
            background: white;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
            margin-top: 20px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            background: #FFF5F5;
            color: var(--danger);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 25px 30px;
            transition: margin-left 0.3s ease;
        }

        .top-nav {
            background: white;
            padding: 15px 25px;
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(42, 92, 138, 0.06);
        }

        .page-title h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title p {
            color: var(--secondary);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification {
            position: relative;
            width: 42px;
            height: 42px;
            background: var(--gray-soft);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .notification:hover {
            background: var(--primary-soft);
        }

        .notification i {
            font-size: 18px;
            color: var(--secondary);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 20px;
            border: 2px solid white;
            font-weight: 700;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--gray-soft);
            padding: 6px 6px 6px 15px;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-dropdown:hover {
            background: var(--primary-soft);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 24px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.06);
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        .card-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h2 i {
            color: var(--primary);
            font-size: 20px;
        }

        .card-body {
            padding: 25px;
        }

        .profile-hero {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--gray-border);
        }

        .profile-hero-logo {
            text-align: center;
        }

        .profile-hero-logo img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 20px;
            padding: 15px;
            background: var(--gray-soft);
            border: 1px solid var(--gray-border);
        }

        .profile-hero-info h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .profile-hero-info .npsn {
            color: var(--primary);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .profile-hero-info .address {
            color: var(--secondary);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: var(--gray-soft);
            border-radius: 16px;
            padding: 18px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .info-card .info-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .info-card .info-icon i {
            font-size: 22px;
            color: var(--primary);
        }

        .info-card .info-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-card .info-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin: 25px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-soft);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--primary);
        }

        .two-columns {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detail-item {
            margin-bottom: 20px;
        }

        .detail-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            word-break: break-word;
        }

        .logo-ttd-section {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-top: 10px;
        }

        .logo-box, .ttd-box {
            background: var(--gray-soft);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
        }

        .logo-box img {
            max-width: 150px;
            max-height: 120px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .ttd-box img {
            max-height: 80px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .logo-box p, .ttd-box p {
            font-size: 12px;
            color: var(--secondary);
            margin-top: 10px;
        }

        .btn-edit, .btn-create {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-primary);
        }

        .btn-edit:hover, .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(42, 92, 138, 0.3);
            color: white;
        }

        .btn-create {
            background: linear-gradient(135deg, var(--success), #34CE57);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }

        .alert {
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 13px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #E8F5E9;
            color: #2E7D32;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: #FFEBEE;
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .empty-state {
            text-align: center;
            padding: 60px 40px;
        }

        .empty-state-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-soft), #f0f7ff);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .empty-state-icon i {
            font-size: 50px;
            color: var(--primary);
            opacity: 0.7;
        }

        .empty-state h3 {
            font-size: 20px;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--secondary);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            width: 45px;
            height: 45px;
            background: var(--primary);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 20px;
            cursor: pointer;
            box-shadow: var(--shadow-primary);
        }

        .profile-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .profile-modal.active {
            display: flex;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 28px;
            max-width: 480px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
            font-size: 13px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-border);
            border-radius: 12px;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1);
        }

        @media (max-width: 1024px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                width: 260px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .mobile-menu-btn {
                display: block;
            }

            .top-nav {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
                padding-top: 70px;
            }

            .user-info {
                width: 100%;
                justify-content: space-between;
            }

            .profile-hero {
                flex-direction: column;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .two-columns {
                grid-template-columns: 1fr;
            }

            .logo-ttd-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="container">
        <!-- Sidebar - SAMA UNTUK SEMUA ROLE (Super Admin, Admin Sekolah, Guru) -->
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
                    <h1>Profil Sekolah</h1>
                    <p><i class="fas fa-calendar-alt"></i> {{ now()->format('l, d F Y') }}</p>
                </div>
                <div class="user-info">
                    <div class="notification">
                        <i class="far fa-bell"></i>
                        <span class="badge-count">3</span>
                    </div>
                    <div class="user-dropdown" onclick="openProfileModal()">
                        <div class="user-avatar">
                            @if(Auth::user() && Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                            @else
                                {{ substr(Auth::user()->name ?? 'AD', 0, 1) }}
                            @endif
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin Sekolah' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle fa-lg"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle fa-lg"></i> {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle fa-lg"></i> Terdapat kesalahan pada form. Silakan periksa kembali.
            </div>
            @endif

            @if($school)
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-building"></i> Profil Sekolah</h2>
                    <a href="{{ route('school.profile.edit') }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
                <div class="card-body">
                    <!-- Hero Section -->
                    <div class="profile-hero">
                        <div class="profile-hero-logo">
                            @php
                                // Cek logo di berbagai kemungkinan path
                                $logoPath = null;
                                if($school->logo_sekolah) {
                                    if(file_exists(public_path('uploads/logo/' . $school->logo_sekolah))) {
                                        $logoPath = asset('uploads/logo/' . $school->logo_sekolah);
                                    } elseif(file_exists(public_path('storage/logos/' . $school->logo_sekolah))) {
                                        $logoPath = asset('storage/logos/' . $school->logo_sekolah);
                                    } elseif(file_exists(storage_path('app/public/logos/' . $school->logo_sekolah))) {
                                        $logoPath = asset('storage/logos/' . $school->logo_sekolah);
                                    }
                                }
                            @endphp
                            @if($logoPath)
                                <img src="{{ $logoPath }}" alt="Logo Sekolah">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($school->name ?? 'S') }}&background=2A5C8A&color=fff&size=120&rounded=false" alt="Logo">
                            @endif
                        </div>
                        <div class="profile-hero-info">
                            <h3>{{ $school->name ?? '-' }}</h3>
                            <div class="npsn">
                                <i class="fas fa-qrcode"></i> NPSN: {{ $school->npsn ?? '-' }}
                            </div>
                            <div class="address">
                                <i class="fas fa-map-marker-alt"></i> {{ $school->address ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- Info Cards -->
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="info-label">Telepon</div>
                            <div class="info-value">{{ $school->phone ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $school->email ?? '-' }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-icon"><i class="fas fa-globe"></i></div>
                            <div class="info-label">Kota / Provinsi</div>
                            <div class="info-value">{{ $school->city ?? '-' }} / {{ $school->province ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Kepala Sekolah Section -->
                    <div class="section-title">
                        <i class="fas fa-user-tie"></i> Data Kepala Sekolah
                    </div>
                    <div class="two-columns">
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-user"></i> Nama Kepala Sekolah</div>
                            <div class="detail-value">{{ $school->kepala_sekolah ?? '-' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-id-card"></i> NIP Kepala Sekolah</div>
                            <div class="detail-value">{{ $school->nip_kepala_sekolah ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Logo & TTD Section -->
                    <div class="section-title">
                        <i class="fas fa-images"></i> Logo & Tanda Tangan Digital
                    </div>
                    <div class="logo-ttd-section">
                        <div class="logo-box">
                            @php
                                $logoDisplayPath = null;
                                if($school->logo_sekolah) {
                                    if(file_exists(public_path('uploads/logo/' . $school->logo_sekolah))) {
                                        $logoDisplayPath = asset('uploads/logo/' . $school->logo_sekolah);
                                    } elseif(file_exists(public_path('storage/logos/' . $school->logo_sekolah))) {
                                        $logoDisplayPath = asset('storage/logos/' . $school->logo_sekolah);
                                    }
                                }
                            @endphp
                            @if($logoDisplayPath)
                                <img src="{{ $logoDisplayPath }}" alt="Logo Sekolah">
                            @else
                                <i class="fas fa-image" style="font-size: 60px; color: var(--secondary); opacity: 0.5;"></i>
                            @endif
                            <p><i class="fas fa-image"></i> Logo Sekolah</p>
                        </div>
                        <div class="ttd-box">
                            @php
                                $ttdPath = null;
                                if($school->ttd_digital) {
                                    if(file_exists(public_path('uploads/ttd/' . $school->ttd_digital))) {
                                        $ttdPath = asset('uploads/ttd/' . $school->ttd_digital);
                                    } elseif(file_exists(public_path('storage/ttd/' . $school->ttd_digital))) {
                                        $ttdPath = asset('storage/ttd/' . $school->ttd_digital);
                                    }
                                }
                            @endphp
                            @if($ttdPath)
                                <img src="{{ $ttdPath }}" alt="Tanda Tangan">
                            @else
                                <i class="fas fa-pen-fancy" style="font-size: 60px; color: var(--secondary); opacity: 0.5;"></i>
                            @endif
                            <p><i class="fas fa-pen-fancy"></i> Tanda Tangan Digital Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-info-circle"></i> Informasi Sistem</h2>
                </div>
                <div class="card-body">
                    <div class="two-columns">
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-database"></i> Data Profil Terakhir Diupdate</div>
                            <div class="detail-value">
                                @if($school->updated_at)
                                    {{ $school->updated_at->format('d F Y H:i:s') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-clock"></i> Dibuat Pada</div>
                            <div class="detail-value">
                                @if($school->created_at)
                                    {{ $school->created_at->format('d F Y H:i:s') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="card">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>Belum Ada Data Profil Sekolah</h3>
                    <p>Silakan lengkapi data profil sekolah terlebih dahulu untuk<br>mengoptimalkan sistem SIPRES</p>
                    <a href="{{ route('school.profile.create') }}" class="btn-create">
                        <i class="fas fa-plus"></i> Buat Profil Sekolah
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <div style="padding: 30px;">
                <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 8px; color: var(--dark);">Edit Profile</h3>
                <p style="color: var(--secondary); margin-bottom: 25px; font-size: 13px;">Perbarui informasi profile Anda</p>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label><i class="fas fa-camera"></i> Foto Profile</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <small style="color: var(--secondary); margin-top: 6px; display: block;">Format: JPG, PNG. Maks: 2MB</small>
                        
                        @if(Auth::user() && Auth::user()->avatar)
                        <div style="margin-top: 12px; display: flex; align-items: center; gap: 10px; padding: 10px; background: var(--gray-soft); border-radius: 12px;">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar" style="width: 45px; height: 45px; border-radius: 10px; object-fit: cover;">
                            <span style="font-size: 12px; color: var(--secondary);">Avatar saat ini</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru">
                    </div>
                    
                    <div style="display: flex; gap: 12px; margin-top: 25px;">
                        <button type="button" onclick="closeProfileModal()" style="flex:1; padding:12px; background:#F1F4F9; border:none; border-radius:12px; font-weight:600; cursor:pointer;">Batal</button>
                        <button type="submit" style="flex:1; padding:12px; background:linear-gradient(135deg, var(--primary), var(--primary-light)); color:white; border:none; border-radius:12px; font-weight:600; cursor:pointer;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        function openProfileModal() {
            document.getElementById('profileModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeProfileModal() {
            document.getElementById('profileModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileImage = document.getElementById('profileImage');
                    if (profileImage) {
                        profileImage.src = e.target.result;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmLogout() {
            if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) {
                document.getElementById('logout-form').submit();
            }
        }

        window.addEventListener('click', function(e) {
            const modal = document.getElementById('profileModal');
            if (e.target === modal) closeProfileModal();
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
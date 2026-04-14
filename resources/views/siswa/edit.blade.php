<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Siswa - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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

        .badge {
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

        /* Card Styles */
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
            background: white;
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
            font-size: 20px;
        }

        .card-body {
            padding: 20px;
        }

        /* Section Title */
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin: 25px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--primary);
            font-size: 18px;
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

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 600;
            font-size: 13px;
        }

        .form-label i {
            color: var(--primary);
            margin-right: 6px;
            font-size: 12px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #E5E9F0;
            border-radius: 12px;
            font-size: 14px;
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
            padding: 12px 16px;
            border: 2px solid #E5E9F0;
            border-radius: 12px;
            font-size: 14px;
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

        .full-width {
            grid-column: 1 / -1;
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
        }

        /* File Upload */
        .upload-container {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .preview-circle {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            background: var(--gray-soft);
            border: 2px dashed #E5E9F0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            font-size: 32px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .preview-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-input-wrapper {
            flex: 1;
        }

        .file-input {
            width: 100%;
            padding: 8px 0;
            font-family: 'Inter', sans-serif;
        }

        .file-input::file-selector-button {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-right: 15px;
        }

        .file-input::file-selector-button:hover {
            background: var(--primary);
            color: white;
        }

        .file-help {
            font-size: 11px;
            color: var(--secondary);
            margin-top: 6px;
        }

        .current-photo-info {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            padding: 10px 12px;
            background: var(--gray-soft);
            border-radius: 10px;
            font-size: 12px;
            color: var(--secondary);
            border: 1px solid rgba(42, 92, 138, 0.05);
        }

        .current-photo-info i {
            color: var(--success);
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 12px 24px;
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
            background: #F1F4F9;
            color: var(--dark);
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .btn-secondary:hover {
            background: #E5E9F0;
        }

        .btn i {
            margin-right: 8px;
        }

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

        .alert-success {
            background: #E3F2E9;
            color: #065F46;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: #FFE9E9;
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .alert i {
            font-size: 16px;
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

            .upload-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .preview-circle {
                margin: 0 auto;
            }

            .file-input-wrapper {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 10px;
            }

            .top-nav {
                padding: 10px 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
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
        <!-- Sidebar -->
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

            <div class="menu-title">MENU UTAMA</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
            </ul>

            <div class="menu-title">DATA MASTER</div>
            <ul class="sidebar-menu">
                @if($user->role == 'admin_sekolah')
                <li>
                    <a href="{{ route('school.profile') }}" class="{{ $currentRoute == 'school.profile' ? 'active' : '' }}">
                        <i class="fas fa-building"></i> Profil Sekolah
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                        <i class="fas fa-school"></i> Kelas
                    </a>
                </li>

                <li>
                    <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Siswa
                    </a>
                </li>

                @if(in_array($user->role, ['super_admin', 'admin_sekolah']))
                <li>
                    <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i> Guru
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('prestasi.index') }}" class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy"></i> Prestasi
                    </a>
                </li>

                <li>
                    <a href="{{ route('eskul.index') }}" class="{{ request()->routeIs('eskul.*') ? 'active' : '' }}">
                        <i class="fas fa-futbol"></i> Ekstrakurikuler
                    </a>
                </li>

                <li>
                    <a href="{{ route('minat-bakat.index') }}" class="{{ request()->routeIs('minat-bakat.*') ? 'active' : '' }}">
                        <i class="fas fa-heart"></i> Minat & Bakat
                    </a>
                </li>
            </ul>

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
                    <h1>Edit Data Siswa</h1>
                    <p>
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('l, d F Y') }}
                    </p>
                </div>
                <div class="user-info">
                    <div class="notification">
                        <i class="far fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="user-dropdown" onclick="openProfileModal()">
                        <div class="user-avatar">
                            @if(Auth::user() && Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            @else
                                {{ substr(Auth::user()->name ?? 'SA', 0, 1) }}
                            @endif
                        </div>
                        <span>{{ Auth::user()->name ?? 'Super Admin' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> 
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> 
                <span>Terdapat kesalahan pada input data. Silakan periksa kembali.</span>
            </div>
            @endif

            <!-- Form Card -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-user-edit"></i>
                        Form Edit Siswa
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.update', $siswa) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Data Pribadi -->
                        <div class="section-title">
                            <i class="fas fa-user-circle"></i>
                            Data Pribadi
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nis" class="form-label">
                                    <i class="fas fa-id-card"></i>
                                    NIS <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="nis" 
                                       name="nis" 
                                       value="{{ old('nis', $siswa->nis) }}" 
                                       class="form-control @error('nis') is-invalid @enderror" 
                                       placeholder="Masukkan NIS"
                                       required>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nisn" class="form-label">
                                    <i class="fas fa-qrcode"></i>
                                    NISN
                                </label>
                                <input type="text" 
                                       id="nisn" 
                                       name="nisn" 
                                       value="{{ old('nisn', $siswa->nisn) }}"
                                       class="form-control @error('nisn') is-invalid @enderror" 
                                       placeholder="Masukkan NISN">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group full-width">
                                <label for="nama_lengkap" class="form-label">
                                    <i class="fas fa-user"></i>
                                    Nama Lengkap <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="nama_lengkap" 
                                       name="nama_lengkap" 
                                       value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" 
                                       class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Tempat Lahir <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="tempat_lahir" 
                                       name="tempat_lahir" 
                                       value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" 
                                       class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                       placeholder="Tempat lahir"
                                       required>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-label">
                                    <i class="fas fa-calendar"></i>
                                    Tanggal Lahir <span class="required">*</span>
                                </label>
                                <input type="date" 
                                       id="tanggal_lahir" 
                                       name="tanggal_lahir" 
                                       value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}" 
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                       required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">
                                    <i class="fas fa-venus-mars"></i>
                                    Jenis Kelamin <span class="required">*</span>
                                </label>
                                <select id="jenis_kelamin" 
                                        name="jenis_kelamin" 
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kelas_id" class="form-label">
                                    <i class="fas fa-school"></i>
                                    Kelas
                                </label>
                                <select id="kelas_id" 
                                        name="kelas_id" 
                                        class="form-select @error('kelas_id') is-invalid @enderror">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group full-width">
                                <label for="alamat" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Alamat <span class="required">*</span>
                                </label>
                                <textarea id="alamat" 
                                          name="alamat" 
                                          class="form-control @error('alamat') is-invalid @enderror" 
                                          placeholder="Alamat lengkap"
                                          required>{{ old('alamat', $siswa->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp" class="form-label">
                                    <i class="fas fa-phone"></i>
                                    No. HP
                                </label>
                                <input type="text" 
                                       id="no_hp" 
                                       name="no_hp" 
                                       value="{{ old('no_hp', $siswa->no_hp) }}"
                                       class="form-control @error('no_hp') is-invalid @enderror" 
                                       placeholder="0812xxxxxx">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Email
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $siswa->email) }}"
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="siswa@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($siswa->user_id)
                                <div class="current-photo-info">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Terhubung dengan akun: <strong>{{ $siswa->user->email ?? $siswa->email }}</strong></span>
                                </div>
                                @endif
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-camera"></i>
                                    Foto Siswa
                                </label>
                                <div class="upload-container">
                                    <div class="preview-circle" id="preview">
                                        @if($siswa->foto)
                                            <img src="{{ asset('uploads/foto-siswa/' . $siswa->foto) }}" alt="{{ $siswa->nama_lengkap }}">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="file-input-wrapper">
                                        <input type="file" 
                                               id="foto"
                                               name="foto" 
                                               accept="image/*"
                                               class="file-input @error('foto') is-invalid @enderror"
                                               onchange="previewImage(this)">
                                        <div class="file-help">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
                                        @if($siswa->foto)
                                        <div class="current-photo-info">
                                            <i class="fas fa-info-circle"></i>
                                            <span>Foto saat ini: {{ $siswa->foto }}</span>
                                        </div>
                                        @endif
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mata_pelajaran_favorit" class="form-label">
                                    <i class="fas fa-book"></i>
                                    Mata Pelajaran Favorit
                                </label>
                                <input type="text" 
                                       id="mata_pelajaran_favorit" 
                                       name="mata_pelajaran_favorit" 
                                       value="{{ old('mata_pelajaran_favorit', $siswa->mata_pelajaran_favorit) }}"
                                       class="form-control @error('mata_pelajaran_favorit') is-invalid @enderror" 
                                       placeholder="Contoh: Matematika">
                                @error('mata_pelajaran_favorit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <div class="section-title">
                            <i class="fas fa-users"></i>
                            Data Orang Tua
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nama_ayah" class="form-label">
                                    <i class="fas fa-male"></i>
                                    Nama Ayah
                                </label>
                                <input type="text" 
                                       id="nama_ayah" 
                                       name="nama_ayah" 
                                       value="{{ old('nama_ayah', $siswa->nama_ayah) }}"
                                       class="form-control @error('nama_ayah') is-invalid @enderror" 
                                       placeholder="Nama ayah">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_ibu" class="form-label">
                                    <i class="fas fa-female"></i>
                                    Nama Ibu
                                </label>
                                <input type="text" 
                                       id="nama_ibu" 
                                       name="nama_ibu" 
                                       value="{{ old('nama_ibu', $siswa->nama_ibu) }}"
                                       class="form-control @error('nama_ibu') is-invalid @enderror" 
                                       placeholder="Nama ibu">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp_orangtua" class="form-label">
                                    <i class="fas fa-phone-alt"></i>
                                    No. HP Orang Tua
                                </label>
                                <input type="text" 
                                       id="no_hp_orangtua" 
                                       name="no_hp_orangtua" 
                                       value="{{ old('no_hp_orangtua', $siswa->no_hp_orangtua) }}"
                                       class="form-control @error('no_hp_orangtua') is-invalid @enderror" 
                                       placeholder="No HP orang tua">
                                @error('no_hp_orangtua')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="required-note">
                            <span class="required">*</span> Wajib diisi
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Data Siswa
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
            
            <form method="POST" action="/profile/update" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 5px; color: var(--dark); font-size: 12px;">
                        <i class="fas fa-camera" style="color: var(--primary); margin-right: 4px;"></i>
                        Foto Profile
                    </label>
                    <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewProfileImage(this)" style="width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; font-size: 13px;">
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
                const file = input.files[0];
                
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    input.value = '';
                    return;
                }
                
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar!');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
                }
                reader.readAsDataURL(file);
            }
        }

        function previewProfileImage(input) {
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
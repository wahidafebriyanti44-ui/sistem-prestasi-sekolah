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
            padding: 15px 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        .card-header h2 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-header h2 i {
            color: var(--primary);
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
        }

        .form-group label i {
            color: var(--primary);
            margin-right: 6px;
        }

        .form-group .required {
            color: var(--danger);
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .form-control.is-invalid {
            border-color: var(--danger);
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 11px;
            margin-top: 5px;
            display: block;
        }

        .form-text {
            font-size: 11px;
            color: var(--secondary);
            margin-top: 5px;
        }

        /* File Input */
        .file-input-wrapper input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 2px dashed #E5E9F0;
            border-radius: 10px;
            background: var(--gray-soft);
            cursor: pointer;
        }

        .file-input-wrapper input[type="file"]:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        /* Current File Preview */
        .current-file {
            margin-top: 8px;
            padding: 8px 12px;
            background: var(--gray-soft);
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .current-file img {
            height: 50px;
            border-radius: 8px;
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .current-file .file-info {
            flex: 1;
        }

        .current-file .file-info p {
            font-size: 12px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 2px;
        }

        .current-file .file-info small {
            font-size: 10px;
            color: var(--secondary);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
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

        /* Row Grid */
        .row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .col-full {
            grid-column: span 2;
        }

        .section-title {
            grid-column: span 2;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin: 20px 0 10px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-soft);
        }

        .form-actions {
            grid-column: span 2;
            display: flex;
            gap: 12px;
            margin-top: 10px;
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

        /* Profile Modal */
        .profile-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .profile-modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 450px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .col-full {
                grid-column: span 1;
            }
            
            .section-title {
                grid-column: span 1;
            }
            
            .form-actions {
                grid-column: span 1;
            }
        }

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
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
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
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin').'&background=2A5C8A&color=fff&size=100' }}" 
                             alt="Profile" 
                             class="profile-avatar"
                             id="profileImage">
                        <div class="avatar-upload">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <div class="profile-name">{{ Auth::user()->name ?? 'Admin Sekolah' }}</div>
                    <div class="profile-role">
                        <i class="fas fa-building"></i>
                        {{ strtoupper(str_replace('_', ' ', Auth::user()->role ?? 'ADMIN SEKOLAH')) }}
                    </div>
                    <div class="profile-email">
                        <i class="far fa-envelope"></i>
                        {{ Auth::user()->email ?? 'admin@sekolah.com' }}
                    </div>
                </div>
            </div>
            
            @php
                $currentRoute = request()->route()->getName();
            @endphp

            <div class="menu-title">MANAJEMEN DATA</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('school.profile') }}" class="{{ $currentRoute == 'school.profile' ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        Profil Sekolah
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas.index') }}" class="{{ str_starts_with($currentRoute, 'kelas.') ? 'active' : '' }}">
                        <i class="fas fa-school"></i>
                        Kelas
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.index') }}" class="{{ str_starts_with($currentRoute, 'siswa.') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}" class="{{ str_starts_with($currentRoute, 'teachers.') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        Guru
                    </a>
                </li>
                <li>
                    <a href="{{ route('prestasi.index') }}" class="{{ str_starts_with($currentRoute, 'prestasi.') ? 'active' : '' }}">
                        <i class="fas fa-trophy"></i>
                        Prestasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('eskul.index') }}" class="{{ str_starts_with($currentRoute, 'eskul.') ? 'active' : '' }}">
                        <i class="fas fa-futbol"></i>
                        Ekstrakurikuler
                    </a>
                </li>
                <li>
                    <a href="{{ route('minat-bakat.index') }}" class="{{ str_starts_with($currentRoute, 'minat-bakat.') ? 'active' : '' }}">
                        <i class="fas fa-heart"></i>
                        Minat & Bakat
                    </a>
                </li>
            </ul>

            <!-- ========== TAMBAHKAN MENU LAPORAN DI SINI ========== -->
    <div class="menu-title">LAPORAN</div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan Prestasi
            </a>
        </li>
        @if(Auth::user()->role == 'super_admin')
        <li>
            <a href="{{ route('laporan.pdf.superadmin') }}" target="_blank">
                <i class="fas fa-chart-bar"></i> Statistik Nasional
            </a>
        </li>
        @endif
        @if(Auth::user()->role == 'admin_sekolah')
        <li>
            <a href="{{ route('laporan.pdf.sekolah') }}" target="_blank">
                <i class="fas fa-print"></i> Cetak Laporan PDF
            </a>
        </li>
        @endif
    </ul>
    <!-- ================================================== -->

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
                    <h1>Profil Sekolah</h1>
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
                                <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            @else
                                {{ substr(Auth::user()->name ?? 'AD', 0, 1) }}
                            @endif
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin Sekolah' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Terdapat kesalahan pada form. Silakan periksa kembali.
            </div>
            @endif

            <!-- Form Card -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-building"></i>
                        Informasi Sekolah
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('school.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Data Identitas Sekolah -->
                            <div class="col-full">
                                <h3 class="section-title">
                                    <i class="fas fa-address-card"></i> Data Identitas Sekolah
                                </h3>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-school"></i> Nama Sekolah
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $school->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-qrcode"></i> NPSN
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="npsn" class="form-control @error('npsn') is-invalid @enderror" 
                                       value="{{ old('npsn', $school->npsn) }}" required>
                                @error('npsn')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-phone"></i> Telepon
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone', $school->phone) }}" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-envelope"></i> Email
                                    <span class="required">*</span>
                                </label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $school->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-full">
                                <label>
                                    <i class="fas fa-map-marker-alt"></i> Alamat
                                    <span class="required">*</span>
                                </label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $school->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Data Kepala Sekolah untuk Kartu Pelajar -->
                            <div class="col-full">
                                <h3 class="section-title">
                                    <i class="fas fa-user-tie"></i> Data Kepala Sekolah (Untuk Kartu Pelajar)
                                </h3>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-user"></i> Nama Kepala Sekolah
                                </label>
                                <input type="text" name="kepala_sekolah" class="form-control @error('kepala_sekolah') is-invalid @enderror" 
                                       value="{{ old('kepala_sekolah', $school->kepala_sekolah) }}" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Pd">
                                <div class="form-text">Nama kepala sekolah akan tercetak di kartu pelajar</div>
                                @error('kepala_sekolah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-id-card"></i> NIP Kepala Sekolah
                                </label>
                                <input type="text" name="nip_kepala_sekolah" class="form-control @error('nip_kepala_sekolah') is-invalid @enderror" 
                                       value="{{ old('nip_kepala_sekolah', $school->nip_kepala_sekolah) }}" placeholder="Contoh: 196512311990011001">
                                <div class="form-text">NIP kepala sekolah akan tercetak di kartu pelajar</div>
                                @error('nip_kepala_sekolah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Upload Logo dan TTD -->
                            <div class="col-full">
                                <h3 class="section-title">
                                    <i class="fas fa-images"></i> Logo & Tanda Tangan Digital
                                </h3>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-image"></i> Logo Sekolah
                                </label>
                                @if($school->logo_sekolah)
                                    <div class="current-file">
                                        <img src="{{ asset('storage/logos/' . $school->logo_sekolah) }}" alt="Logo">
                                        <div class="file-info">
                                            <p>Logo saat ini</p>
                                            <small>Upload file baru jika ingin mengganti</small>
                                        </div>
                                    </div>
                                @endif
                                <div class="file-input-wrapper">
                                    <input type="file" name="logo_sekolah" class="form-control-file @error('logo_sekolah') is-invalid @enderror" accept="image/png,image/jpeg">
                                </div>
                                <div class="form-text">Format: PNG/JPG. Ukuran maksimal 2MB. Rekomendasi ukuran 200x200px.</div>
                                @error('logo_sekolah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-pen-fancy"></i> Tanda Tangan Digital (TTD) Kepala Sekolah
                                </label>
                                @if($school->ttd_digital)
                                    <div class="current-file">
                                        <img src="{{ asset('storage/ttd/' . $school->ttd_digital) }}" alt="TTD" style="height: 50px;">
                                        <div class="file-info">
                                            <p>Tanda tangan saat ini</p>
                                            <small>Upload file baru jika ingin mengganti</small>
                                        </div>
                                    </div>
                                @endif
                                <div class="file-input-wrapper">
                                    <input type="file" name="ttd_digital" class="form-control-file @error('ttd_digital') is-invalid @enderror" accept="image/png,image/jpeg">
                                </div>
                                <div class="form-text">Format: PNG/JPG. Ukuran maksimal 2MB. Upload file tanda tangan dengan background putih untuk hasil terbaik.</div>
                                @error('ttd_digital')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <div style="padding: 25px;">
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 5px; color: var(--dark);">Edit Profile</h3>
                <p style="color: var(--secondary); margin-bottom: 20px; font-size: 13px;">Perbarui informasi profile Anda</p>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
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
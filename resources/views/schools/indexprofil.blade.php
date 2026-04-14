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

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #FFFFFF 0%, #F5F9FF 100%);
            border-right: 1px solid rgba(42, 92, 138, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
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
        }

        .brand-icon i {
            font-size: 18px;
            color: white;
        }

        .brand-text {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary);
        }

        .brand-sub {
            font-size: 9px;
            color: var(--secondary);
        }

        .sidebar-profile {
            padding: 5px 15px 10px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
        }

        .profile-card {
            background: var(--gray-soft);
            border-radius: 12px;
            padding: 10px;
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
            font-size: 10px;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
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
        }

        .menu-title {
            padding: 10px 15px 3px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--secondary);
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
            font-weight: 500;
            font-size: 12px;
        }

        .sidebar-menu a i {
            width: 18px;
            font-size: 14px;
        }

        .sidebar-menu a:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .sidebar-footer {
            position: sticky;
            bottom: 0;
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
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        .top-nav {
            background: white;
            padding: 15px 20px;
            border-radius: 16px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        .page-title p {
            color: var(--secondary);
            font-size: 12px;
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

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 9px;
            padding: 2px 5px;
            border-radius: 20px;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #F5F8FA;
            padding: 5px 5px 5px 12px;
            border-radius: 30px;
            cursor: pointer;
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
        }

        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .card-body {
            padding: 20px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
        }

        .detail-value.text-muted {
            color: var(--secondary);
            font-style: italic;
        }

        .logo-preview {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .logo-box img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border: 1px solid rgba(42, 92, 138, 0.1);
            border-radius: 12px;
            padding: 10px;
            background: var(--gray-soft);
        }

        .ttd-preview img {
            max-height: 60px;
            border: 1px solid rgba(42, 92, 138, 0.1);
            border-radius: 8px;
            padding: 8px;
            background: var(--gray-soft);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-edit:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-create {
            background: linear-gradient(135deg, var(--success), #34CE57);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: var(--primary-light);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--secondary);
            font-size: 13px;
            margin-bottom: 20px;
        }

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
        }

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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark);
            font-size: 12px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
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
                padding-top: 60px;
            }

            .detail-grid {
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
                             alt="Profile" class="profile-avatar" id="profileImage">
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
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('school.profile.index') }}" class="{{ $currentRoute == 'school.profile.index' ? 'active' : '' }}">
                        <i class="fas fa-building"></i> Profil Sekolah
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas.index') }}" class="{{ str_starts_with($currentRoute, 'kelas.') ? 'active' : '' }}">
                        <i class="fas fa-school"></i> Kelas
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.index') }}" class="{{ str_starts_with($currentRoute, 'siswa.') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}" class="{{ str_starts_with($currentRoute, 'teachers.') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i> Guru
                    </a>
                </li>
                <li>
                    <a href="{{ route('prestasi.index') }}" class="{{ str_starts_with($currentRoute, 'prestasi.') ? 'active' : '' }}">
                        <i class="fas fa-trophy"></i> Prestasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('eskul.index') }}" class="{{ str_starts_with($currentRoute, 'eskul.') ? 'active' : '' }}">
                        <i class="fas fa-futbol"></i> Ekstrakurikuler
                    </a>
                </li>
                <li>
                    <a href="{{ route('minat-bakat.index') }}" class="{{ str_starts_with($currentRoute, 'minat-bakat.') ? 'active' : '' }}">
                        <i class="fas fa-heart"></i> Minat & Bakat
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <button onclick="confirmLogout()" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Keluar dari SIPRES
                </button>
            </div>
        </div>

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

            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-building"></i> Informasi Sekolah</h2>
                    @if($school)
                        <a href="{{ route('school.profile.edit') }}" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                    @else
                        <a href="{{ route('school.profile.create') }}" class="btn-create">
                            <i class="fas fa-plus"></i> Buat Profil Sekolah
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($school)
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-school"></i> Nama Sekolah</div>
                                <div class="detail-value">{{ $school->name ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-qrcode"></i> NPSN</div>
                                <div class="detail-value">{{ $school->npsn ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-phone"></i> Telepon</div>
                                <div class="detail-value">{{ $school->phone ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-envelope"></i> Email</div>
                                <div class="detail-value">{{ $school->email ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-map-marker-alt"></i> Alamat</div>
                                <div class="detail-value">{{ $school->address ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-user-tie"></i> Kepala Sekolah</div>
                                <div class="detail-value">{{ $school->kepala_sekolah ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-id-card"></i> NIP Kepala Sekolah</div>
                                <div class="detail-value">{{ $school->nip_kepala_sekolah ?? '-' }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-image"></i> Logo Sekolah</div>
                                <div class="logo-preview">
                                    @if($school->logo_sekolah)
                                        <div class="logo-box">
                                            <img src="{{ asset('storage/logos/' . $school->logo_sekolah) }}" alt="Logo">
                                            <p>Logo Sekolah</p>
                                        </div>
                                    @else
                                        <span class="detail-value text-muted">Belum diupload</span>
                                    @endif
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label"><i class="fas fa-pen-fancy"></i> Tanda Tangan Digital</div>
                                @if($school->ttd_digital)
                                    <div class="ttd-preview">
                                        <img src="{{ asset('storage/ttd/' . $school->ttd_digital) }}" alt="TTD">
                                        <p style="font-size: 11px; color: var(--secondary); margin-top: 5px;">TTD Kepala Sekolah</p>
                                    </div>
                                @else
                                    <span class="detail-value text-muted">Belum diupload</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-building"></i>
                            <h3>Belum Ada Data Profil Sekolah</h3>
                            <p>Silakan lengkapi data profil sekolah terlebih dahulu</p>
                            <a href="{{ route('school.profile.create') }}" class="btn-create">
                                <i class="fas fa-plus"></i> Buat Profil Sekolah
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-info-circle"></i> Informasi Sistem</h2>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-database"></i> Terakhir Diupdate</div>
                            <div class="detail-value">
                                @if($school && $school->updated_at)
                                    {{ $school->updated_at->format('d F Y H:i:s') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-clock"></i> Dibuat Pada</div>
                            <div class="detail-value">
                                @if($school && $school->created_at)
                                    {{ $school->created_at->format('d F Y H:i:s') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <div style="padding: 25px;">
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 5px;">Edit Profile</h3>
                <p style="color: var(--secondary); margin-bottom: 20px;">Perbarui informasi profile Anda</p>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label><i class="fas fa-camera"></i> Foto Profile</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <small style="color: var(--secondary);">Format: JPG, PNG. Maks: 2MB</small>
                        @if(Auth::user() && Auth::user()->avatar)
                        <div style="margin-top: 8px;">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar" style="width: 40px; border-radius: 8px;">
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
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    
                    <div style="display: flex; gap: 12px; margin-top: 20px;">
                        <button type="button" onclick="closeProfileModal()" style="flex:1; padding:12px; background:#F1F4F9; border:none; border-radius:10px; font-weight:600; cursor:pointer;">Batal</button>
                        <button type="submit" style="flex:1; padding:12px; background:var(--primary); color:white; border:none; border-radius:10px; font-weight:600; cursor:pointer;">Simpan</button>
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
            if (e.target === modal) closeProfileModal();
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
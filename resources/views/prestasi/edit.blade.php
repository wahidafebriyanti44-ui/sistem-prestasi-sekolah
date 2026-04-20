<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Prestasi - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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

        .is-invalid {
            border-color: var(--danger) !important;
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 12px;
            margin-top: 4px;
            font-weight: 500;
        }

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

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-pending {
            background: #FFF4E5;
            color: #B76E00;
        }

        .status-verified {
            background: #E3F2E9;
            color: var(--success);
        }

        .current-file {
            background: var(--gray-soft);
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-info i {
            font-size: 24px;
            color: var(--danger);
        }

        .file-name {
            font-size: 13px;
            color: var(--dark);
            font-weight: 500;
        }

        .file-link {
            background: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .file-link:hover {
            opacity: 0.9;
        }

        .upload-container {
            border: 2px dashed #E5E9F0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.2s ease;
            background: var(--gray-soft);
        }

        .upload-container:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .upload-icon {
            font-size: 40px;
            color: var(--secondary);
            margin-bottom: 8px;
        }

        .upload-text {
            color: var(--secondary);
            margin-bottom: 10px;
            font-size: 13px;
        }

        .file-input {
            width: 100%;
            padding: 8px 0;
        }

        .file-input::file-selector-button {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: white;
            color: var(--primary);
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            border: 1px solid rgba(42, 92, 138, 0.2);
            transition: all 0.2s ease;
        }

        .file-input::file-selector-button:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .file-help {
            font-size: 11px;
            color: var(--secondary);
            margin-top: 8px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
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

        .profile-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            max-width: 400px;
            width: 90%;
        }

        .form-group-modal {
            margin-bottom: 15px;
        }

        .current-avatar {
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            background: var(--gray-soft);
            border-radius: 10px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-cancel {
            flex: 1;
            padding: 12px;
            background: #F1F4F9;
            color: var(--dark);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-save {
            flex: 1;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
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
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.3);
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
                flex-direction: column-reverse;
            }
            .btn {
                width: 100%;
                text-align: center;
            }
            .current-file {
                flex-direction: column;
                align-items: flex-start;
            }
            .file-link {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
            .student-info-card {
                flex-direction: column;
                text-align: center;
            }
            .form-grid {
                grid-template-columns: 1fr;
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
            <div class="top-nav">
                <div class="page-title">
                    <h1>Edit Data Prestasi</h1>
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

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                <span class="status-badge {{ $prestasi->status == 'pending' ? 'status-pending' : 'status-verified' }}">
                    <i class="fas {{ $prestasi->status == 'pending' ? 'fa-clock' : 'fa-check-circle' }}"></i>
                    Status: {{ ucfirst($prestasi->status) }}
                </span>
                
                <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-edit"></i>
                        Form Edit Prestasi
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('prestasi.update', $prestasi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="student-info-card">
                            <div class="student-avatar">
                                @if($prestasi->siswa && $prestasi->siswa->foto)
                                    <img src="{{ $prestasi->siswa->foto_url }}" alt="{{ $prestasi->siswa->nama_lengkap }}">
                                @else
                                    {{ substr($prestasi->siswa->nama_lengkap ?? 'S', 0, 1) }}
                                @endif
                            </div>
                            <div class="student-details">
                                <h3>{{ $prestasi->siswa->nama_lengkap ?? 'Unknown' }}</h3>
                                <p>NIS: {{ $prestasi->siswa->nis ?? '-' }} | Kelas: {{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}</p>
                            </div>
                            <input type="hidden" name="siswa_id" value="{{ $prestasi->siswa_id }}">
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="jenis_prestasi" class="form-label">
                                    Jenis Prestasi <span class="required">*</span>
                                </label>
                                <select id="jenis_prestasi" 
                                        name="jenis_prestasi" 
                                        class="form-select @error('jenis_prestasi') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="akademik" {{ old('jenis_prestasi', $prestasi->jenis_prestasi) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="non_akademik" {{ old('jenis_prestasi', $prestasi->jenis_prestasi) == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                                </select>
                                @error('jenis_prestasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_lomba" class="form-label">
                                    Nama Lomba <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="nama_lomba" 
                                       name="nama_lomba" 
                                       value="{{ old('nama_lomba', $prestasi->nama_lomba) }}" 
                                       class="form-control @error('nama_lomba') is-invalid @enderror" 
                                       placeholder="Contoh: Olimpiade Matematika"
                                       required>
                                @error('nama_lomba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tingkat" class="form-label">
                                    Tingkat Lomba <span class="required">*</span>
                                </label>
                                <select id="tingkat" 
                                        name="tingkat" 
                                        class="form-select @error('tingkat') is-invalid @enderror" 
                                        required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="sekolah" {{ old('tingkat', $prestasi->tingkat) == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                                    <option value="kecamatan" {{ old('tingkat', $prestasi->tingkat) == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                    <option value="kabupaten" {{ old('tingkat', $prestasi->tingkat) == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                    <option value="provinsi" {{ old('tingkat', $prestasi->tingkat) == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="nasional" {{ old('tingkat', $prestasi->tingkat) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="internasional" {{ old('tingkat', $prestasi->tingkat) == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('tingkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="peringkat" class="form-label">
                                    Peringkat/Hasil <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       id="peringkat" 
                                       name="peringkat" 
                                       value="{{ old('peringkat', $prestasi->peringkat) }}" 
                                       class="form-control @error('peringkat') is-invalid @enderror" 
                                       placeholder="Contoh: Juara 1, Harapan 1, Peserta"
                                       required>
                                @error('peringkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tahun" class="form-label">
                                    Tahun <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       id="tahun" 
                                       name="tahun" 
                                       value="{{ old('tahun', $prestasi->tahun) }}" 
                                       class="form-control @error('tahun') is-invalid @enderror" 
                                       min="2000" 
                                       max="{{ date('Y') }}"
                                       required>
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ========== FITUR INDOREGION - PROVINSI & KABUPATEN ========== -->
                            <div class="form-group">
                                <label for="provinsi_id" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> Provinsi
                                </label>
                                <select id="provinsi_id" 
                                        name="provinsi_id" 
                                        class="form-select @error('provinsi_id') is-invalid @enderror">
                                    <option value="">Pilih Provinsi (Opsional)</option>
                                    @foreach($provinsiList ?? [] as $provinsi)
                                    <option value="{{ $provinsi->id }}" {{ old('provinsi_id', $prestasi->provinsi_id) == $provinsi->id ? 'selected' : '' }}>
                                        {{ $provinsi->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('provinsi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kabupaten_id" class="form-label">
                                    <i class="fas fa-city"></i> Kabupaten/Kota
                                </label>
                                <select id="kabupaten_id" 
                                        name="kabupaten_id" 
                                        class="form-select @error('kabupaten_id') is-invalid @enderror">
                                    <option value="">Pilih Provinsi terlebih dahulu</option>
                                    @if($prestasi->provinsi_id && isset($kabupatenList))
                                        @foreach($kabupatenList as $kabupaten)
                                        <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $prestasi->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>
                                            {{ $kabupaten->nama }}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('kabupaten_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="full-width">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" 
                                              name="deskripsi" 
                                              class="form-control @error('deskripsi') is-invalid @enderror" 
                                              rows="3"
                                              placeholder="Deskripsi prestasi (opsional)">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="full-width">
                                <div class="form-group">
                                    <label class="form-label">Upload Sertifikat</label>
                                    
                                    @if($prestasi->file_sertifikat)
                                    <div class="current-file">
                                        <div class="file-info">
                                            <i class="fas fa-file-pdf"></i>
                                            <span class="file-name">{{ basename($prestasi->file_sertifikat) }}</span>
                                        </div>
                                        <a href="{{ $prestasi->sertifikat_url }}" target="_blank" class="file-link">
                                            <i class="fas fa-eye"></i> Lihat Sertifikat
                                        </a>
                                    </div>
                                    @endif

                                    <div class="upload-container">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p class="upload-text">Upload file sertifikat baru (kosongkan jika tidak ingin mengubah)</p>
                                        <input type="file" 
                                               id="file_sertifikat"
                                               name="file_sertifikat" 
                                               accept=".pdf,.jpg,.jpeg,.png"
                                               class="file-input @error('file_sertifikat') is-invalid @enderror">
                                        <p class="file-help">Maksimal 5MB. Format: PDF, JPG, PNG</p>
                                        @error('file_sertifikat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="required-note">
                            <span class="required">*</span> Wajib diisi
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Data Prestasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <h3>Edit Profile</h3>
            <p>Perbarui informasi profile Anda</p>
            
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group-modal">
                    <label class="form-label">Foto Profile</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                    <small style="color: var(--secondary); margin-top: 5px; display: block;">Format: JPG, PNG. Maks: 2MB</small>
                    
                    @if(Auth::user() && Auth::user()->avatar)
                    <div class="current-avatar">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar">
                        <span>Avatar saat ini</span>
                    </div>
                    @endif
                </div>
                
                <div class="form-group-modal">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                
                <div class="form-group-modal">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
                
                <div class="form-group-modal">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                
                <div class="form-group-modal">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeProfileModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

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

        // ========== INDOREGION - DYNAMIC KABUPATEN UNTUK EDIT ==========
        const provinsiSelect = document.getElementById('provinsi_id');
        const kabupatenSelect = document.getElementById('kabupaten_id');
        const selectedKabupatenId = "{{ old('kabupaten_id', $prestasi->kabupaten_id) }}";

        function loadKabupaten(provinsiId, selectedId = null) {
            if (provinsiId) {
                kabupatenSelect.disabled = true;
                kabupatenSelect.innerHTML = '<option value="">Memuat...</option>';
                
                fetch('{{ route("get.kabupaten") }}?provinsi_id=' + provinsiId)
                    .then(response => response.json())
                    .then(data => {
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                        data.forEach(function(kabupaten) {
                            const selected = (selectedId && selectedId == kabupaten.id) ? 'selected' : '';
                            kabupatenSelect.innerHTML += '<option value="' + kabupaten.id + '" ' + selected + '>' + kabupaten.nama + '</option>';
                        });
                        kabupatenSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        kabupatenSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                        kabupatenSelect.disabled = true;
                    });
            } else {
                kabupatenSelect.innerHTML = '<option value="">Pilih Provinsi terlebih dahulu</option>';
                kabupatenSelect.disabled = true;
            }
        }

        // Event listener untuk perubahan provinsi
        provinsiSelect.addEventListener('change', function() {
            loadKabupaten(this.value);
        });

        // Load kabupaten pada saat halaman dimuat (jika ada provinsi yang sudah dipilih)
        if (provinsiSelect.value) {
            loadKabupaten(provinsiSelect.value, selectedKabupatenId);
        }

        // File upload handler
        document.getElementById('file_sertifikat').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const uploadContainer = this.closest('.upload-container');
                const uploadText = uploadContainer.querySelector('.upload-text');
                uploadText.innerHTML = `<i class="fas fa-check-circle" style="color: #28a745;"></i> File baru dipilih: ${fileName}`;
            }
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
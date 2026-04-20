<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Prestasi - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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

        /* Info Banner */
        .info-banner {
            background: linear-gradient(135deg, #E8F0FE 0%, #D4E4F5 100%);
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid var(--primary);
            flex-wrap: wrap;
        }
        .info-banner i {
            font-size: 20px;
            color: var(--primary);
        }
        .filter-badge {
            background: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            color: var(--primary);
            font-weight: 600;
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }
        .filter-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-soft);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filter-title i {
            color: var(--primary);
        }
        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }
        .filter-group {
            flex: 1;
            min-width: 150px;
        }
        .filter-label {
            display: block;
            margin-bottom: 6px;
            color: var(--secondary);
            font-size: 12px;
            font-weight: 600;
        }
        .filter-select, .filter-input {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
            background-color: white;
        }
        .filter-select:focus, .filter-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1);
        }
        .filter-actions {
            display: flex;
            gap: 10px;
        }
        .btn-filter {
            background: var(--gray-soft);
            color: var(--dark);
            padding: 10px 20px;
            border: 1px solid rgba(42, 92, 138, 0.1);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        .btn-filter:hover {
            background: #E5E9F0;
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
            padding: 15px 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        .card-header h3 {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-header h3 i {
            color: white;
        }
        .btn-pdf {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.2s;
            backdrop-filter: blur(10px);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        .btn-pdf:hover {
            background: white;
            color: var(--danger);
            transform: translateY(-2px);
        }
        .card-body {
            padding: 0;
        }

        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th {
            text-align: left;
            padding: 12px 16px;
            background-color: var(--gray-soft);
            color: var(--secondary);
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 2px solid rgba(42, 92, 138, 0.08);
        }
        table td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            color: var(--dark);
            font-size: 13px;
            vertical-align: middle;
        }
        table tr:hover {
            background-color: var(--gray-soft);
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.2);
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .badge-pending { background: #FFF4E5; color: #B76E00; }
        .badge-verified { background: #E3F2E9; color: #065F46; }

        .badge-blue { background: #E3F2FD; color: #1976D2; padding: 4px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; }
        .badge-purple { background: #F3E5F5; color: #7B1FA2; padding: 4px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; }
        .badge-gray { background: #F1F4F9; color: #5F6B7A; padding: 4px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; }
        .badge-green { background: #E3F2E9; color: #2E7D32; padding: 4px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; }
        .badge-yellow { background: #FFF4E5; color: #B76E00; padding: 4px 8px; border-radius: 6px; font-size: 10px; font-weight: 600; }

        .achievement-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            margin-top: 4px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 15px;
        }
        .empty-state p {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 14px;
        }

        .pagination-container {
            margin-top: 20px;
            padding: 15px 20px;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .pagination-info {
            color: var(--secondary);
            font-size: 13px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }
        .pagination .page-item {
            list-style: none;
            margin: 0;
        }
        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 10px;
            border: 1px solid rgba(42, 92, 138, 0.1);
            border-radius: 10px;
            color: var(--secondary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
            background: white;
        }
        .pagination .page-link:hover {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: var(--primary);
        }
        .pagination .active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Alert */
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

        /* Modal */
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
        .profile-modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            max-width: 400px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
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
        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
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

        @media (max-width: 1200px) {
            table { min-width: 800px; }
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
            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-group {
                width: 100%;
            }
            .filter-actions {
                width: 100%;
                flex-direction: column;
            }
            .btn-filter {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
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

            <!-- MENU LAPORAN -->
            <div class="menu-title">LAPORAN</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> Laporan Prestasi
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
                    <h1>Laporan Prestasi</h1>
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

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> 
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <!-- Filter Card -->
            <div class="filter-card">
                <div class="filter-title">
                    <i class="fas fa-filter"></i> Pilih Laporan & Filter Data
                </div>
                
                <form method="GET" action="{{ route('laporan.index') }}" class="filter-form" id="laporanForm">
                    <!-- Pilihan Jenis Laporan -->
                    <div class="filter-group" style="min-width: 200px;">
                        <label class="filter-label"><i class="fas fa-file-alt"></i> Jenis Laporan</label>
                        <select name="jenis_laporan" class="filter-select" id="jenisLaporan" onchange="this.form.submit()">
                            <option value="prestasi" {{ request('jenis_laporan') == 'prestasi' || !request('jenis_laporan') ? 'selected' : '' }}>
                                📊 Laporan Prestasi
                            </option>
                            
                            @if(Auth::user()->role == 'super_admin')
                            <option value="statistik_nasional" {{ request('jenis_laporan') == 'statistik_nasional' ? 'selected' : '' }}>
                                🏆 Statistik Nasional
                            </option>
                            @endif
                            
                            @if(Auth::user()->role == 'admin_sekolah')
                            <option value="statistik_sekolah" {{ request('jenis_laporan') == 'statistik_sekolah' ? 'selected' : '' }}>
                                📈 Statistik Sekolah
                            </option>
                            <option value="semua_siswa" {{ request('jenis_laporan') == 'semua_siswa' ? 'selected' : '' }}>
                                👨‍🎓 Data Semua Siswa
                            </option>
                            <option value="kartu_pelajar" {{ request('jenis_laporan') == 'kartu_pelajar' ? 'selected' : '' }}>
                                🪪 Cetak Kartu Pelajar
                            </option>
                            @endif
                            
                            @if(Auth::user()->role == 'guru')
                            <option value="prestasi_kelas" {{ request('jenis_laporan') == 'prestasi_kelas' ? 'selected' : '' }}>
                                📚 Prestasi Kelas
                            </option>
                            @endif
                        </select>
                    </div>
                    
                    <!-- Filter untuk laporan prestasi -->
                    @if(request('jenis_laporan') == 'prestasi' || !request('jenis_laporan'))
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-calendar-alt"></i> Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="filter-input" value="{{ request('tanggal_mulai') }}">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-calendar-alt"></i> Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="filter-input" value="{{ request('tanggal_akhir') }}">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-flag-checkered"></i> Status</label>
                        <select name="status" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-trophy"></i> Jenis Prestasi</label>
                        <select name="jenis" class="filter-select">
                            <option value="">Semua Jenis</option>
                            <option value="akademik" {{ request('jenis') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="non_akademik" {{ request('jenis') == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-geo-alt"></i> Tingkat</label>
                        <select name="tingkat" class="filter-select">
                            <option value="">Semua Tingkat</option>
                            <option value="sekolah" {{ request('tingkat') == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                            <option value="kecamatan" {{ request('tingkat') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="kabupaten" {{ request('tingkat') == 'kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                            <option value="provinsi" {{ request('tingkat') == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                            <option value="nasional" {{ request('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="internasional" {{ request('tingkat') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-map-marker-alt"></i> Provinsi</label>
                        <select name="provinsi_id" class="filter-select">
                            <option value="">Semua Provinsi</option>
                            @if(isset($provinsiList))
                                @foreach($provinsiList as $prov)
                                <option value="{{ $prov->id }}" {{ request('provinsi_id') == $prov->id ? 'selected' : '' }}>{{ $prov->nama }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('laporan.index') }}" class="btn-filter">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                    @endif
                    
                    <!-- Filter untuk kartu pelajar -->
                    @if(request('jenis_laporan') == 'kartu_pelajar' && Auth::user()->role == 'admin_sekolah')
                    <div class="filter-group" style="min-width: 250px;">
                        <label class="filter-label"><i class="fas fa-user-graduate"></i> Pilih Siswa</label>
                        <select id="siswa_id" class="filter-select">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach(\App\Models\Siswa::where('school_id', Auth::user()->school_id)->orderBy('nama_lengkap')->get() as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_lengkap }} ({{ $s->nis }})</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </form>
            </div>

            <!-- Informasi Filter Aktif -->
            @if(request('tanggal_mulai') || request('tanggal_akhir') || request('status') || request('jenis') || request('tingkat') || request('provinsi_id'))
            <div class="info-banner">
                <i class="fas fa-info-circle"></i>
                <strong>Filter aktif:</strong>
                @if(request('tanggal_mulai')) <span class="filter-badge"><i class="fas fa-calendar"></i> {{ request('tanggal_mulai') }} s/d {{ request('tanggal_akhir') ?? 'sekarang' }}</span> @endif
                @if(request('status')) <span class="filter-badge"><i class="fas fa-flag"></i> {{ request('status') == 'pending' ? 'Pending' : 'Terverifikasi' }}</span> @endif
                @if(request('jenis')) <span class="filter-badge"><i class="fas fa-trophy"></i> {{ ucfirst(request('jenis')) }}</span> @endif
                @if(request('tingkat')) <span class="filter-badge"><i class="fas fa-geo-alt"></i> {{ ucfirst(request('tingkat')) }}</span> @endif
                @if(request('provinsi_id') && isset($provinsiList))
                    @php
                        $provinsiTerpilih = $provinsiList->firstWhere('id', request('provinsi_id'));
                    @endphp
                    @if($provinsiTerpilih)
                    <span class="filter-badge"><i class="fas fa-map-marker-alt"></i> {{ $provinsiTerpilih->nama }}</span>
                    @endif
                @endif
                <a href="{{ route('laporan.index') }}" style="margin-left: auto; color: var(--primary); text-decoration: none; font-size: 12px;">
                    <i class="fas fa-times-circle"></i> Hapus semua
                </a>
            </div>
            @endif

            <!-- Tabel / Konten Laporan -->
            <div class="card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-file-alt"></i>
                        @if(request('jenis_laporan') == 'statistik_nasional')
                            🏆 Statistik Nasional
                        @elseif(request('jenis_laporan') == 'statistik_sekolah')
                            📈 Statistik Sekolah
                        @elseif(request('jenis_laporan') == 'semua_siswa')
                            👨‍🎓 Data Semua Siswa
                        @elseif(request('jenis_laporan') == 'prestasi_kelas')
                            📚 Prestasi Kelas
                        @else
                            📋 Laporan Data Prestasi
                        @endif
                        <span style="background: rgba(255,255,255,0.2) !important; color: white !important; padding: 2px 8px; border-radius: 20px; font-size: 11px; margin-left: 8px;">
                            {{ $prestasi->total() ?? 0 }} Data
                        </span>
                    </h3>
                    
                    <div class="d-flex gap-2">
                        <!-- Tombol download sesuai jenis laporan -->
                        @if(request('jenis_laporan') == 'statistik_nasional' && Auth::user()->role == 'super_admin')
                        <a href="{{ route('laporan.pdf.superadmin') }}" target="_blank" class="btn-pdf">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        @endif
                        
                        @if(request('jenis_laporan') == 'statistik_sekolah' && Auth::user()->role == 'admin_sekolah')
                        <a href="{{ route('laporan.pdf.sekolah') }}" target="_blank" class="btn-pdf">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        @endif
                        
                        @if(request('jenis_laporan') == 'semua_siswa' && Auth::user()->role == 'admin_sekolah')
                        <a href="{{ route('laporan.pdf.semua_siswa') }}" target="_blank" class="btn-pdf">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        @endif
                        
                        @if(request('jenis_laporan') == 'kartu_pelajar' && Auth::user()->role == 'admin_sekolah')
                        <button onclick="cetakKartu()" class="btn-pdf">
                            <i class="fas fa-print"></i> Cetak Kartu
                        </button>
                        @endif
                        
                        @if((request('jenis_laporan') == 'prestasi' || !request('jenis_laporan')) && in_array(Auth::user()->role, ['admin_sekolah', 'super_admin']))
                        <form action="{{ Auth::user()->role == 'super_admin' ? route('laporan.pdf.superadmin') : route('laporan.pdf.sekolah') }}" method="GET" target="_blank">
                            <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                            <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                            <input type="hidden" name="tingkat" value="{{ request('tingkat') }}">
                            <input type="hidden" name="provinsi_id" value="{{ request('provinsi_id') }}">
                            <button type="submit" class="btn-pdf">
                                <i class="fas fa-file-pdf"></i> PDF Filter Ini
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                
                <div class="card-body">
                    @if(request('jenis_laporan') == 'semua_siswa' && Auth::user()->role == 'admin_sekolah')
                        <!-- Tabel Semua Siswa -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th>JK</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Status Akun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $semuaSiswa = \App\Models\Siswa::where('school_id', Auth::user()->school_id)->orderBy('nama_lengkap')->get();
                                    @endphp
                                    @foreach($semuaSiswa as $index => $s)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $s->nis }}</td>
                                        <td>{{ $s->nama_lengkap }}</td>
                                        <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                        <td>{{ $s->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                                        <td>{{ $s->no_hp ?? '-' }}</td>
                                        <td>{{ $s->user->email ?? ($s->email ?? '-') }}</td>
                                        <td>
                                            @if($s->user_id)
                                                <span class="badge-status badge-verified">Aktif</span>
                                            @else
                                                <span class="badge-status badge-pending">Tidak Punya</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif(request('jenis_laporan') == 'kartu_pelajar' && Auth::user()->role == 'admin_sekolah')
                        <!-- Preview Kartu Pelajar -->
                        <div style="text-align: center; padding: 40px;">
                            <i class="fas fa-id-card" style="font-size: 60px; color: var(--primary); margin-bottom: 20px;"></i>
                            <h3 style="margin-bottom: 15px;">Cetak Kartu Pelajar</h3>
                            <p style="color: var(--secondary); margin-bottom: 20px;">Pilih siswa dari filter di atas, lalu klik tombol "Cetak Kartu"</p>
                            <div class="info-banner" style="display: inline-flex; width: auto;">
                                <i class="fas fa-info-circle"></i>
                                Kartu akan dicetak dengan ukuran KTP standar (8.56 cm x 5.4 cm)
                            </div>
                        </div>
                    @else
                        <!-- Tabel Laporan Prestasi -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="40">No</th>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Sekolah</th>
                                        <th>Prestasi</th>
                                        <th>Tingkat</th>
                                        <th>Peringkat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prestasi as $index => $p)
                                    <tr>
                                        <td class="text-center">{{ $prestasi->firstItem() + $index }}</td>
                                        <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <div class="avatar-circle">
                                                    @if($p->siswa && $p->siswa->foto)
                                                        <img src="{{ $p->siswa->foto_url }}" alt="{{ $p->siswa->nama_lengkap }}" style="width:100%;height:100%;object-fit:cover;">
                                                    @else
                                                        {{ substr($p->siswa->nama_lengkap ?? 'S', 0, 1) }}
                                                    @endif
                                                </div>
                                                <div style="margin-left: 10px;">
                                                    <div style="font-weight: 600;">{{ $p->siswa->nama_lengkap ?? '-' }}</div>
                                                    <div style="font-size: 10px; color: var(--secondary);">Kelas: {{ $p->siswa->kelas->nama_kelas ?? '-' }}</div>
                                                </div>
                                            </div>
                                         </td>
                                        <td>{{ $p->siswa->school->name ?? '-' }}</td>
                                        <td>
                                            <div class="badge {{ $p->jenis_prestasi == 'akademik' ? 'badge-blue' : 'badge-purple' }}" style="display: inline-block; margin-bottom: 4px;">
                                                {{ ucfirst($p->jenis_prestasi) }}
                                            </div>
                                            <div class="achievement-name">{{ $p->nama_lomba }}</div>
                                         </td>
                                        <td>
                                            @php
                                                $tingkatIcon = match($p->tingkat) {
                                                    'sekolah' => 'fa-school',
                                                    'kecamatan' => 'fa-city',
                                                    'kabupaten' => 'fa-city',
                                                    'provinsi' => 'fa-map',
                                                    'nasional' => 'fa-flag',
                                                    'internasional' => 'fa-globe',
                                                    default => 'fa-tag'
                                                };
                                                $tingkatColors = [
                                                    'sekolah' => 'badge-gray',
                                                    'kecamatan' => 'badge-blue',
                                                    'kabupaten' => 'badge-blue',
                                                    'provinsi' => 'badge-purple',
                                                    'nasional' => 'badge-green',
                                                    'internasional' => 'badge-yellow'
                                                ];
                                                $color = $tingkatColors[$p->tingkat] ?? 'badge-gray';
                                            @endphp
                                            <span class="badge {{ $color }}">
                                                <i class="fas {{ $tingkatIcon }}"></i> {{ ucfirst($p->tingkat) }}
                                            </span>
                                         </td>
                                        <td>{{ $p->peringkat }}</td>
                                        <td>
                                            @if($p->status == 'pending')
                                                <span class="badge-status badge-pending">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @else
                                                <span class="badge-status badge-verified">
                                                    <i class="fas fa-check-circle"></i> Terverifikasi
                                                </span>
                                            @endif
                                         </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="empty-state">
                                                <i class="fas fa-file-alt"></i>
                                                <p>Tidak ada data prestasi yang ditemukan</p>
                                                <a href="{{ route('laporan.index') }}" class="btn-filter">
                                                    <i class="fas fa-undo"></i> Reset Filter
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($prestasi->hasPages())
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan {{ $prestasi->firstItem() ?? 0 }} sampai {{ $prestasi->lastItem() ?? 0 }} 
                                dari {{ $prestasi->total() ?? 0 }} data
                            </div>
                            <div class="pagination">
                                {{ $prestasi->appends(request()->query())->links() }}
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 5px;">Edit Profile</h3>
            <p style="color: var(--secondary); margin-bottom: 20px;">Perbarui informasi profile Anda</p>
            
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-camera"></i> Foto Profile
                    </label>
                    <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                    <small style="color: var(--secondary); margin-top: 5px; display: block;">Format: JPG, PNG. Maks: 2MB</small>
                    
                    @if(Auth::user() && Auth::user()->avatar)
                    <div style="margin-top: 8px; display: flex; align-items: center; gap: 8px; padding: 8px; background: var(--gray-soft); border-radius: 10px;">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                        <span style="font-size: 12px; color: var(--secondary);">Avatar saat ini</span>
                    </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i> Nama Lengkap
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i> Password Baru
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i> Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeProfileModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Simpan
                    </button>
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
        
        function cetakKartu() {
            const siswaId = document.getElementById('siswa_id').value;
            if (!siswaId) {
                alert('Pilih siswa terlebih dahulu!');
                return;
            }
            window.open('/siswa/' + siswaId, '_blank');
            // Atau jika ada route khusus cetak kartu:
            // window.open('/laporan/kartu-pelajar/' + siswaId, '_blank');
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
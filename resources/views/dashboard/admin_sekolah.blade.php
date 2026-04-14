<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin Sekolah - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            padding: 18px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .stat-info h3 {
            font-size: 12px;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 4px;
        }

        .stat-info p {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-icon.blue {
            background: #E8F0FE;
            color: var(--primary);
        }

        .stat-icon.green {
            background: #E3F2E9;
            color: var(--success);
        }

        .stat-icon.purple {
            background: #F0E6FF;
            color: #8B5CF6;
        }

        .stat-icon.yellow {
            background: #FFF4E5;
            color: var(--warning);
        }

        /* Action Buttons */
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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

        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
        }

        /* Stats Detail */
        .stats-detail {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-card {
            background: white;
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-badge {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 600;
        }

        .detail-badge.green {
            background: #E3F2E9;
            color: var(--success);
        }

        .detail-badge.yellow {
            background: #FFF4E5;
            color: #B76E00;
        }

        .detail-badge.blue {
            background: #E8F0FE;
            color: var(--primary);
        }

        .detail-info {
            flex: 1;
        }

        .detail-info .label {
            font-size: 11px;
            color: var(--secondary);
            margin-bottom: 2px;
        }

        .detail-info .value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

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

        .card-header h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .card-header h3 i {
            color: var(--primary);
            font-size: 16px;
        }

        .card-header a {
            color: var(--primary);
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 5px 10px;
            border-radius: 20px;
            background: var(--primary-soft);
        }

        .card-body {
            padding: 15px;
        }

        /* Distribution List */
        .distribution-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .distribution-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .distribution-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }

        .distribution-name {
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .distribution-name i {
            color: var(--primary);
            font-size: 12px;
        }

        .distribution-value {
            color: var(--secondary);
            font-weight: 500;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #E5E9F0;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 3px;
            transition: width 0.3s;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .quick-action-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .quick-action-item:hover {
            transform: translateX(5px);
        }

        .quick-action-item.blue {
            background: #E8F0FE;
            color: var(--primary);
        }

        .quick-action-item.green {
            background: #E3F2E9;
            color: var(--success);
        }

        .quick-action-item.yellow {
            background: #FFF4E5;
            color: #B76E00;
        }

        .quick-action-item.purple {
            background: #F0E6FF;
            color: #8B5CF6;
        }

        .quick-action-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-right: 12px;
        }

        .quick-action-text {
            flex: 1;
            font-weight: 600;
            font-size: 13px;
        }

        .quick-action-arrow {
            margin-left: 10px;
            font-size: 12px;
            opacity: 0.7;
        }

        /* Alert Card */
        .alert-card {
            background: #FEF3C7;
            border: 1px solid #FDE68A;
            border-radius: 16px;
            padding: 15px 20px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .alert-icon {
            width: 48px;
            height: 48px;
            background: #FCD34D;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #92400E;
            font-size: 20px;
        }

        .alert-text h3 {
            font-size: 15px;
            font-weight: 700;
            color: #92400E;
            margin-bottom: 3px;
        }

        .alert-text p {
            font-size: 12px;
            color: #92400E;
            opacity: 0.8;
        }

        .alert-button {
            background: #92400E;
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .alert-button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Table Styles */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            text-align: left;
            padding: 10px 12px;
            color: var(--secondary);
            font-weight: 600;
            font-size: 11px;
            border-bottom: 2px solid rgba(42, 92, 138, 0.08);
        }

        .table td {
            padding: 10px 12px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            color: var(--dark);
            font-size: 12px;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-pending {
            background: #FFF4E5;
            color: #B76E00;
        }

        .badge-success {
            background: #E3F2E9;
            color: var(--success);
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 15px;
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

        /* Profile Modal */
        .profile-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
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
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .modal-content p {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 13px;
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

        .form-label i {
            color: var(--primary);
            margin-right: 4px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
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

        .current-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
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
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            .stats-detail {
                grid-template-columns: 1fr;
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
            .stats-grid {
                grid-template-columns: 1fr;
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
            .action-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .alert-card {
                flex-direction: column;
                text-align: center;
            }
            .alert-content {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="container">
        <!-- SIDEBAR - SAMA PERSIS UNTUK SEMUA ROLE -->
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
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin Sekolah').'&background=2A5C8A&color=fff&size=100' }}" 
                             class="profile-avatar" 
                             id="profileImage">
                        <div class="avatar-upload">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <div class="profile-name">{{ Auth::user()->name ?? 'Admin Sekolah' }}</div>
                    <div class="profile-role">
                        <i class="fas fa-school"></i> ADMIN SEKOLAH
                    </div>
                    <div class="profile-email">
                        <i class="far fa-envelope"></i>
                        {{ Auth::user()->email ?? 'admin@sekolah.sch.id' }}
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

            <!-- SUPER ADMIN ONLY - KELOLA SEKOLAH (TIDAK MUNCUL UNTUK ADMIN SEKOLAH) -->
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
                <div class="page-title"><h1>Dashboard Admin Sekolah</h1><p><i class="fas fa-calendar-alt"></i> {{ now()->format('l, d F Y') }}</p></div>
                <div class="user-info">
                    <div class="notification"><i class="far fa-bell"></i><span class="badge">{{ $prestasiPending ?? 0 }}</span></div>
                    <div class="user-dropdown" onclick="openProfileModal()">
                        <div class="user-avatar">@if(Auth::user() && Auth::user()->avatar)<img src="{{ Auth::user()->avatar_url }}">@else{{ substr(Auth::user()->name ?? 'AS', 0, 1) }}@endif</div>
                        <span>{{ Auth::user()->name ?? 'Admin Sekolah' }}</span><i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            @if(session('success'))<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif

            <div class="action-bar">
                <h2>Ringkasan Data Sekolah</h2>
            </div>

            <div class="stats-grid">
                <div class="stat-card"><div class="stat-info"><h3>Total Siswa</h3><p>{{ $totalSiswa ?? 0 }}</p></div><div class="stat-icon blue"><i class="fas fa-users"></i></div></div>
                <div class="stat-card"><div class="stat-info"><h3>Total Guru</h3><p>{{ $totalGuru ?? 0 }}</p></div><div class="stat-icon green"><i class="fas fa-chalkboard-teacher"></i></div></div>
                <div class="stat-card"><div class="stat-info"><h3>Total Prestasi</h3><p>{{ $totalPrestasi ?? 0 }}</p></div><div class="stat-icon purple"><i class="fas fa-trophy"></i></div></div>
                <div class="stat-card"><div class="stat-info"><h3>Total Kelas</h3><p>{{ $totalKelas ?? 0 }}</p></div><div class="stat-icon yellow"><i class="fas fa-school"></i></div></div>
            </div>

            <div class="stats-detail">
                <div class="detail-card"><div class="detail-badge green"><i class="fas fa-check-circle"></i></div><div class="detail-info"><div class="label">Prestasi Terverifikasi</div><div class="value">{{ $prestasiTerverifikasi ?? 0 }}</div></div></div>
                <div class="detail-card"><div class="detail-badge yellow"><i class="fas fa-clock"></i></div><div class="detail-info"><div class="label">Prestasi Pending</div><div class="value">{{ $prestasiPending ?? 0 }}</div></div></div>
                <div class="detail-card"><div class="detail-badge blue"><i class="fas fa-chart-line"></i></div><div class="detail-info"><div class="label">Rata-rata Prestasi/Siswa</div><div class="value">{{ ($totalSiswa ?? 0) > 0 ? round(($totalPrestasi ?? 0) / ($totalSiswa ?? 1), 1) : 0 }}</div></div></div>
            </div>

            <div class="content-grid">
                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-chart-pie"></i> Distribusi Siswa per Kelas</h3><a href="{{ route('kelas.index') }}">Lihat Semua <i class="fas fa-arrow-right"></i></a></div>
                    <div class="card-body">
                        @if(isset($siswaPerKelas) && count($siswaPerKelas) > 0)
                            <div class="distribution-list">
                                @foreach($siswaPerKelas as $kelas)
                                <div class="distribution-item">
                                    <div class="distribution-header"><span class="distribution-name"><i class="fas fa-school"></i> {{ $kelas->nama_kelas }}</span><span class="distribution-value">{{ $kelas->siswa_count }} siswa</span></div>
                                    @php $maxSiswa = $siswaPerKelas->max('siswa_count'); $percentage = $maxSiswa > 0 ? ($kelas->siswa_count / $maxSiswa) * 100 : 0; @endphp
                                    <div class="progress-bar"><div class="progress-fill" style="width: {{ $percentage }}%;"></div></div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p style="text-align: center; color: var(--secondary); padding: 30px;"><i class="fas fa-chart-pie" style="font-size: 2.5rem; opacity: 0.3; margin-bottom: 10px; display: block;"></i>Belum ada data kelas</p>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h3><i class="fas fa-bolt"></i> Aksi Cepat</h3></div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('siswa.create') }}" class="quick-action-item blue"><div class="quick-action-icon"><i class="fas fa-user-plus"></i></div><span class="quick-action-text">Tambah Siswa Baru</span><i class="fas fa-arrow-right quick-action-arrow"></i></a>
                            <a href="{{ route('teachers.create') }}" class="quick-action-item green"><div class="quick-action-icon"><i class="fas fa-chalkboard-teacher"></i></div><span class="quick-action-text">Tambah Guru</span><i class="fas fa-arrow-right quick-action-arrow"></i></a>
                            <a href="{{ route('kelas.create') }}" class="quick-action-item yellow"><div class="quick-action-icon"><i class="fas fa-school"></i></div><span class="quick-action-text">Tambah Kelas</span><i class="fas fa-arrow-right quick-action-arrow"></i></a>
                            <a href="{{ route('prestasi.create') }}" class="quick-action-item purple"><div class="quick-action-icon"><i class="fas fa-trophy"></i></div><span class="quick-action-text">Input Prestasi</span><i class="fas fa-arrow-right quick-action-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($prestasiPending) && $prestasiPending > 0)
            <div class="alert-card">
                <div class="alert-content"><div class="alert-icon"><i class="fas fa-clock"></i></div><div class="alert-text"><h3>Ada {{ $prestasiPending }} prestasi pending</h3><p>Prestasi yang perlu diverifikasi</p></div></div>
                <a href="{{ route('prestasi.index', ['status' => 'pending']) }}" class="alert-button"><i class="fas fa-check-circle"></i> Verifikasi Sekarang</a>
            </div>
            @endif

            <div class="card">
                <div class="card-header"><h3><i class="fas fa-trophy"></i> Prestasi Terbaru</h3><a href="{{ route('prestasi.index') }}">Lihat Semua <i class="fas fa-arrow-right"></i></a></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Siswa</th><th>Kelas</th><th>Prestasi</th><th>Tingkat</th><th>Status</th></tr</thead>
                            <tbody>
                                @forelse($prestasiTerbaru ?? [] as $prestasi)
                                <tr>
                                    <td><div style="display: flex; align-items: center; gap: 8px;"><div class="detail-badge blue" style="width: 28px; height: 28px; font-size: 12px;">{{ substr($prestasi->siswa->nama_lengkap ?? 'S', 0, 1) }}</div><span style="font-weight: 600;">{{ $prestasi->siswa->nama_lengkap ?? 'Unknown' }}</span></div></td>
                                    <td>{{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ Str::limit($prestasi->nama_lomba ?? '-', 40) }}</td>
                                    <td>{{ ucfirst($prestasi->tingkat ?? '-') }}</td>
                                    <td>@if(($prestasi->status ?? '') == 'pending')<span class="badge-status badge-pending"><i class="fas fa-clock"></i> Pending</span>@else<span class="badge-status badge-success"><i class="fas fa-check-circle"></i> Terverifikasi</span>@endif</span></div></div></td>
                                </tr>
                                @empty
                                <tr><td colspan="5" style="text-align: center; padding: 30px;"><i class="fas fa-trophy" style="font-size: 40px; opacity: 0.3; margin-bottom: 10px; display: block;"></i>Belum ada data prestasi</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <h3>Edit Profile</h3><p>Perbarui informasi profile Anda</p>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group"><label class="form-label"><i class="fas fa-camera"></i> Foto Profile</label><input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)"><small style="color: var(--secondary); margin-top: 5px; display: block;">Format: JPG, PNG. Maks: 2MB</small>@if(Auth::user() && Auth::user()->avatar)<div class="current-avatar"><img src="{{ Auth::user()->avatar_url }}"><span>Avatar saat ini</span></div>@endif</div>
                <div class="form-group"><label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label><input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required></div>
                <div class="form-group"><label class="form-label"><i class="fas fa-envelope"></i> Email</label><input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required></div>
                <div class="form-group"><label class="form-label"><i class="fas fa-lock"></i> Password Baru</label><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah"></div>
                <div class="form-group"><label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control"></div>
                <div class="modal-actions"><button type="button" class="btn-cancel" onclick="closeProfileModal()"><i class="fas fa-times"></i> Batal</button><button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button></div>
            </form>
        </div>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>

    <script>
        function toggleSidebar(){ document.getElementById('sidebar').classList.toggle('active'); }
        function openProfileModal(){ document.getElementById('profileModal').classList.add('active'); }
        function closeProfileModal(){ document.getElementById('profileModal').classList.remove('active'); }
        function previewImage(input){ if(input.files && input.files[0]){ const reader=new FileReader(); reader.onload=function(e){ document.getElementById('profileImage').src=e.target.result; }; reader.readAsDataURL(input.files[0]); } }
        function confirmLogout(){ if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) document.getElementById('logout-form').submit(); }
        window.addEventListener('click',function(e){ const modal=document.getElementById('profileModal'); if(e.target===modal) closeProfileModal(); });
        document.addEventListener('click',function(event){ const sidebar=document.getElementById('sidebar'); const mobileBtn=document.querySelector('.mobile-menu-btn'); if(window.innerWidth<=768){ if(sidebar.classList.contains('active')&&!sidebar.contains(event.target)&&!mobileBtn.contains(event.target)) sidebar.classList.remove('active'); } });
        setTimeout(()=>{ document.querySelectorAll('.alert').forEach(alert=>{ alert.style.transition='opacity 0.5s ease'; alert.style.opacity='0'; setTimeout(()=>alert.remove(),500); }); },5000);
    </script>
</body>
</html>
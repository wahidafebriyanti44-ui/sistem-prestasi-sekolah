<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Prestasi - SIPRES | Sistem Informasi Prestasi Siswa</title>

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

        .btn-secondary {
            background: var(--gray-soft);
            color: var(--dark);
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .btn-secondary:hover {
            background: #E5E9F0;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: var(--warning);
            color: #212529;
        }

        .btn-warning:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn i {
            margin-right: 6px;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.08);
            margin-bottom: 25px;
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

        .card-header h3 {
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body {
            padding: 20px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-size: 12px;
            color: var(--secondary);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .info-value {
            font-size: 15px;
            color: var(--dark);
            font-weight: 600;
        }

        .info-value i {
            margin-right: 8px;
            color: var(--primary);
            width: 20px;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-blue {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .badge-green {
            background: #E3F2E9;
            color: var(--success);
        }

        .badge-yellow {
            background: #FFF4E5;
            color: #B76E00;
        }

        .badge-purple {
            background: #F3E5F5;
            color: #7B1FA2;
        }

        .badge-pending {
            background: #FFF4E5;
            color: #B76E00;
        }

        .badge-verified {
            background: #E3F2E9;
            color: var(--success);
        }

        .badge-rejected {
            background: #FFE9E9;
            color: var(--danger);
        }

        /* Jenis & Tingkat Badge */
        .jenis-badge, .tingkat-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .jenis-akademik {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .jenis-non-akademik {
            background: #F3E5F5;
            color: #7B1FA2;
        }

        .tingkat-sekolah {
            background: #F1F4F9;
            color: var(--dark);
        }

        .tingkat-kecamatan, .tingkat-kabupaten, .tingkat-provinsi {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .tingkat-nasional {
            background: #FFF4E5;
            color: #B76E00;
        }

        .tingkat-internasional {
            background: #FFE9E9;
            color: var(--danger);
        }

        /* Student Card */
        .student-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .student-header {
            background: linear-gradient(135deg, var(--success), #20c997);
            padding: 15px 20px;
            color: white;
        }

        .student-header h3 {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .student-body {
            padding: 20px;
        }

        .student-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .student-avatar {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-avatar .no-photo {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: 700;
        }

        .student-name h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .student-name p {
            font-size: 12px;
            color: var(--secondary);
        }

        .student-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
        }

        .student-detail:last-child {
            border-bottom: none;
        }

        .student-detail i {
            width: 20px;
            color: var(--success);
        }

        .student-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 15px;
            color: var(--success);
            text-decoration: none;
            font-weight: 600;
            font-size: 12px;
            padding: 8px 12px;
            background: #E3F2E9;
            border-radius: 8px;
        }

        .student-link:hover {
            background: var(--success);
            color: white;
        }

        /* Certificate & Verifier Card */
        .certificate-card, .verifier-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.08);
            margin-top: 25px;
        }

        .certificate-header {
            background: linear-gradient(135deg, var(--danger), #c82333);
            padding: 15px 20px;
            color: white;
        }

        .verifier-header {
            background: linear-gradient(135deg, var(--secondary), #5a6268);
            padding: 15px 20px;
            color: white;
        }

        .certificate-header h3, .verifier-header h3 {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .certificate-body, .verifier-body {
            padding: 20px;
        }

        .certificate-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .certificate-detail {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            min-width: 200px;
        }

        .certificate-icon {
            width: 50px;
            height: 50px;
            background: #FFE9E9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--danger);
            font-size: 24px;
        }

        .certificate-text h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .certificate-text p {
            font-size: 12px;
            color: var(--secondary);
        }

        .certificate-text .file-size {
            font-size: 11px;
            color: #999;
            margin-top: 2px;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--danger);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        .btn-download:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .verifier-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .verifier-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            background: var(--gray-soft);
            border-radius: 10px;
        }

        .verifier-item i {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            font-size: 16px;
        }

        .verifier-item-content .label {
            font-size: 11px;
            color: var(--secondary);
            margin-bottom: 2px;
        }

        .verifier-item-content .value {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
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
            color: #991B1B;
            border-left-color: var(--danger);
        }

        /* Modal Styles */
        .profile-modal, .rejection-modal {
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
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
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

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        .btn-save-danger {
            background: var(--danger);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
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

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .student-profile {
                flex-direction: column;
                text-align: center;
            }

            div[style*="grid-template-columns: 2fr 1fr"] {
                grid-template-columns: 1fr !important;
            }

            .student-link {
                width: 100%;
                justify-content: center;
            }

            .certificate-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-download {
                width: 100%;
                justify-content: center;
            }

            .verifier-grid {
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

            .certificate-detail {
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
                    <h1>Detail Prestasi</h1>
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
            @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <span>{{ session('success') }}</span></div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <span>{{ session('error') }}</span></div>
            @endif

            <!-- Status Badge -->
            <div class="action-bar">
                <div>
                    @if($prestasi->status == 'pending')
                        <span class="status-badge badge-pending"><i class="fas fa-clock"></i> Menunggu Verifikasi</span>
                    @elseif($prestasi->status == 'verified')
                        <span class="status-badge badge-verified"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                    @elseif($prestasi->status == 'rejected')
                        <span class="status-badge badge-rejected"><i class="fas fa-times-circle"></i> Ditolak</span>
                    @endif
                </div>
            </div>

            <!-- Action Bar -->
            <div class="action-bar">
                <a href="{{ route('prestasi.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @if($prestasi->status == 'pending' && (in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']) || Auth::user()->isWaliKelas()))
                        <form action="{{ route('prestasi.verify', $prestasi) }}" method="POST" style="display: inline;">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-success" onclick="return confirm('Verifikasi prestasi ini?')"><i class="fas fa-check"></i> Verifikasi</button>
                        </form>
                    @endif
                    @if($prestasi->status == 'pending' && (in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']) || Auth::user()->isWaliKelas()))
                        <button type="button" class="btn btn-danger" onclick="openRejectModal()"><i class="fas fa-times"></i> Tolak</button>
                    @endif
                    @if(Auth::user()->role == 'admin_sekolah' || Auth::user()->isWaliKelas())
                        <a href="{{ route('prestasi.edit', $prestasi) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    @endif
                </div>
            </div>

            <!-- Main Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
                <!-- Left Column -->
                <div>
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(135deg, var(--primary), var(--primary-light));">
                            <h3 style="color: white;"><i class="fas fa-trophy"></i> Informasi Prestasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Jenis Prestasi</div>
                                    <div class="info-value">
                                        @if($prestasi->jenis_prestasi == 'akademik')
                                            <span class="jenis-badge jenis-akademik"><i class="fas fa-graduation-cap"></i> Akademik</span>
                                        @else
                                            <span class="jenis-badge jenis-non-akademik"><i class="fas fa-palette"></i> Non Akademik</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Nama Lomba</div>
                                    <div class="info-value"><i class="fas fa-medal"></i> {{ $prestasi->nama_lomba }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Tingkat</div>
                                    <div class="info-value">
                                        @php
                                            $tingkatClass = match($prestasi->tingkat) {
                                                'sekolah' => 'tingkat-sekolah',
                                                'kecamatan', 'kabupaten', 'provinsi' => 'tingkat-kecamatan',
                                                'nasional' => 'tingkat-nasional',
                                                'internasional' => 'tingkat-internasional',
                                                default => 'tingkat-sekolah'
                                            };
                                            $tingkatIcon = match($prestasi->tingkat) {
                                                'sekolah' => 'fa-school',
                                                'kecamatan', 'kabupaten', 'provinsi' => 'fa-map',
                                                'nasional' => 'fa-flag',
                                                'internasional' => 'fa-globe',
                                                default => 'fa-tag'
                                            };
                                        @endphp
                                        <span class="tingkat-badge {{ $tingkatClass }}"><i class="fas {{ $tingkatIcon }}"></i> {{ ucfirst($prestasi->tingkat) }}</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Peringkat/Hasil</div>
                                    <div class="info-value"><i class="fas fa-star"></i> {{ $prestasi->peringkat }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Tahun</div>
                                    <div class="info-value"><i class="fas fa-calendar"></i> {{ $prestasi->tahun }}</div>
                                </div>
                                @if($prestasi->deskripsi)
                                    <div class="info-item" style="grid-column: 1 / -1;">
                                        <div class="info-label">Deskripsi</div>
                                        <div class="info-value" style="font-weight: normal; line-height: 1.6;">{{ $prestasi->deskripsi }}</div>
                                    </div>
                                @endif
                                @if($prestasi->alasan_penolakan)
                                    <div class="info-item" style="grid-column: 1 / -1;">
                                        <div class="info-label">Alasan Penolakan</div>
                                        <div class="info-value" style="font-weight: normal; line-height: 1.6; color: var(--danger);"><i class="fas fa-comment"></i> {{ $prestasi->alasan_penolakan }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($prestasi->file_sertifikat)
                        <div class="certificate-card">
                            <div class="certificate-header"><h3><i class="fas fa-file-pdf"></i> Sertifikat</h3></div>
                            <div class="certificate-body">
                                <div class="certificate-info">
                                    <div class="certificate-detail">
                                        <div class="certificate-icon"><i class="fas fa-file-pdf"></i></div>
                                        <div class="certificate-text"><h4>{{ basename($prestasi->file_sertifikat) }}</h4><p>File sertifikat prestasi</p></div>
                                    </div>
                                    <a href="{{ $prestasi->sertifikat_url }}" target="_blank" class="btn-download"><i class="fas fa-download"></i> Download</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($prestasi->status == 'verified' && $prestasi->verifikator)
                        <div class="verifier-card">
                            <div class="verifier-header"><h3><i class="fas fa-check-circle"></i> Informasi Verifikasi</h3></div>
                            <div class="verifier-body">
                                <div class="verifier-grid">
                                    <div class="verifier-item"><i class="fas fa-user-check"></i><div class="verifier-item-content"><div class="label">Diverifikasi oleh</div><div class="value">{{ $prestasi->verifikator->name }}</div></div></div>
                                    <div class="verifier-item"><i class="fas fa-clock"></i><div class="verifier-item-content"><div class="label">Tanggal Verifikasi</div><div class="value">{{ $prestasi->verified_at ? $prestasi->verified_at->format('d/m/Y H:i') : $prestasi->updated_at->format('d/m/Y H:i') }}</div></div></div>
                                    @if($prestasi->verifikator->role)
                                        <div class="verifier-item"><i class="fas fa-user-tag"></i><div class="verifier-item-content"><div class="label">Role Verifikator</div><div class="value">{{ ucfirst(str_replace('_', ' ', $prestasi->verifikator->role)) }}</div></div></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div>
                    <div class="student-card">
                        <div class="student-header"><h3><i class="fas fa-user-graduate"></i> Data Siswa</h3></div>
                        <div class="student-body">
                            <div class="student-profile">
                                <div class="student-avatar">
                                    @if($prestasi->siswa && $prestasi->siswa->foto)
                                        <img src="{{ $prestasi->siswa->foto_url }}" alt="{{ $prestasi->siswa->nama_lengkap }}">
                                    @else
                                        <div class="no-photo">{{ substr($prestasi->siswa->nama_lengkap ?? 'S', 0, 1) }}</div>
                                    @endif
                                </div>
                                <div class="student-name"><h4>{{ $prestasi->siswa->nama_lengkap ?? 'Unknown' }}</h4><p>NIS: {{ $prestasi->siswa->nis ?? '-' }}</p></div>
                            </div>
                            <div class="student-detail"><i class="fas fa-school"></i> <span>Kelas: <strong>{{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}</strong></span></div>
                            <div class="student-detail"><i class="fas fa-venus-mars"></i> <span>Jenis Kelamin: <strong>{{ ($prestasi->siswa->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong></span></div>
                            <div class="student-detail"><i class="fas fa-calendar-alt"></i> <span>Tahun Masuk: <strong>{{ $prestasi->siswa->tahun_masuk ?? '-' }}</strong></span></div>
                            @if($prestasi->siswa && ($prestasi->siswa->tempat_lahir ?? false) && ($prestasi->siswa->tanggal_lahir ?? false))
                                <div class="student-detail"><i class="fas fa-birthday-cake"></i> <span>Tempat, Tgl Lahir: <strong>{{ $prestasi->siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($prestasi->siswa->tanggal_lahir)->format('d/m/Y') }}</strong></span></div>
                            @endif
                            @if($prestasi->siswa)
                                <a href="{{ route('siswa.show', $prestasi->siswa) }}" class="student-link"><i class="fas fa-arrow-right"></i> Lihat Profil Lengkap</a>
                            @endif
                        </div>
                    </div>
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
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-camera" style="color: var(--primary); margin-right: 4px;"></i> Foto Profile</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                    <small style="color: var(--secondary); margin-top: 5px; display: block;">Format: JPG, PNG. Maks: 2MB</small>
                    @if(Auth::user() && Auth::user()->avatar)
                        <div class="current-avatar" style="margin-top: 8px; display: flex; align-items: center; gap: 8px; padding: 8px; background: var(--gray-soft); border-radius: 10px;">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                            <span style="font-size: 12px; color: var(--secondary);">Avatar saat ini</span>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user" style="color: var(--primary); margin-right: 4px;"></i> Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-envelope" style="color: var(--primary); margin-right: 4px;"></i> Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock" style="color: var(--primary); margin-right: 4px;"></i> Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock" style="color: var(--primary); margin-right: 4px;"></i> Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeProfileModal()"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Rejection Modal -->
    <div class="rejection-modal" id="rejectModal">
        <div class="modal-content">
            <h3>Tolak Prestasi</h3>
            <p>Berikan alasan mengapa prestasi ini ditolak</p>
            <form id="rejectForm" action="{{ route('prestasi.reject', $prestasi) }}" method="POST">
                @csrf @method('PATCH')
                <div class="form-group">
                    <label class="form-label">Alasan Penolakan</label>
                    <textarea name="alasan_penolakan" class="form-control" required placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn-save btn-save-danger">Tolak Prestasi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>

    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function openProfileModal() { document.getElementById('profileModal').style.display = 'flex'; }
        function closeProfileModal() { document.getElementById('profileModal').style.display = 'none'; }
        function openRejectModal() { document.getElementById('rejectModal').style.display = 'flex'; }
        function closeRejectModal() { document.getElementById('rejectModal').style.display = 'none'; }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('profileImage').src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }
        function confirmLogout() { if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) document.getElementById('logout-form').submit(); }
        window.addEventListener('click', e => {
            if (e.target === document.getElementById('profileModal')) closeProfileModal();
            if (e.target === document.getElementById('rejectModal')) closeRejectModal();
        });
        document.addEventListener('click', event => {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768 && sidebar.classList.contains('active') && !sidebar.contains(event.target) && !mobileBtn.contains(event.target)) {
                sidebar.classList.remove('active');
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
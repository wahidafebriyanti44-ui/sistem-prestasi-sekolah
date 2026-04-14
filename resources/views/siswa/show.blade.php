<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Siswa - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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
            --quran: #2c7a4d;
            --quran-light: #e8f5e9;
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

        .btn-edit {
            background: var(--warning);
            color: var(--dark);
        }

        .btn-edit:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #34CE57);
            color: white;
        }

        .btn-success:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-back {
            background: #F1F4F9;
            color: var(--dark);
            border: 1px solid rgba(42, 92, 138, 0.1);
        }

        .btn-back:hover {
            background: #E5E9F0;
        }

        .btn-quran {
            background: linear-gradient(135deg, #2c7a4d, #3c9e62);
            color: white;
            box-shadow: 0 4px 8px rgba(44, 122, 77, 0.25);
        }

        .btn-quran:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
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
            padding: 15px 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
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

        /* Profile Detail Card */
        .profile-detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.08);
            position: sticky;
            top: 20px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 20px;
            color: white;
        }

        .profile-header h3 {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            font-weight: 600;
        }

        .profile-body {
            padding: 20px;
        }

        .profile-avatar {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            border: 4px solid var(--gray-soft);
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .avatar-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-large .no-photo {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 700;
        }

        .profile-name-large {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .profile-nis {
            color: var(--secondary);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .profile-nisn {
            color: #999;
            font-size: 12px;
        }

        /* Info List */
        .info-list {
            margin-top: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary);
            font-size: 13px;
        }

        .info-label i {
            width: 18px;
            color: var(--primary);
        }

        .info-value {
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
            text-align: right;
        }

        .info-address {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
        }

        .info-address h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--dark);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .info-address p {
            color: var(--secondary);
            font-size: 13px;
            line-height: 1.6;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.yellow {
            background: #FFF4E5;
            color: var(--warning);
        }

        .stat-icon.green {
            background: #E3F2E9;
            color: var(--success);
        }

        .stat-icon.blue {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .stat-info h4 {
            font-size: 12px;
            color: var(--secondary);
            margin-bottom: 4px;
        }

        .stat-info p {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        /* Achievement List */
        .achievement-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .achievement-item {
            border: 1px solid rgba(42, 92, 138, 0.08);
            border-radius: 12px;
            padding: 15px;
            transition: all 0.2s ease;
        }

        .achievement-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .achievement-header {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

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
            color: var(--warning);
        }

        .badge-purple {
            background: #F0E6FF;
            color: #8B5CF6;
        }

        .badge-quran-active {
            background: #E3F2E9;
            color: #28A745;
        }

        .badge-quran-inactive {
            background: #FFE9E9;
            color: #DC3545;
        }

        .achievement-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .achievement-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 8px;
        }

        .meta-item {
            background: var(--gray-soft);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            color: var(--secondary);
        }

        .achievement-description {
            font-size: 12px;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .achievement-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-icon:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-pdf {
            background: var(--danger);
        }

        .btn-verify {
            background: var(--success);
        }

        /* Eskul Grid */
        .eskul-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .eskul-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--gray-soft);
            border-radius: 10px;
            border: 1px solid rgba(42, 92, 138, 0.05);
        }

        .eskul-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .eskul-info h4 {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .eskul-info p {
            font-size: 11px;
            color: var(--secondary);
        }

        /* Minat List */
        .minat-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .minat-item {
            padding: 6px 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Hafalan Quran Info */
        .hafalan-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .hafalan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
        }

        .hafalan-item-full {
            grid-column: span 2;
        }

        .hafalan-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary);
            font-size: 12px;
        }

        .hafalan-label i {
            color: var(--quran);
        }

        .hafalan-value {
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 2000;
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 25px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: var(--secondary);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .modal-close:hover {
            background: var(--gray-soft);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--secondary);
            margin-bottom: 15px;
            font-size: 13px;
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

        /* Layout Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }

        /* KARTU PELAJAR STYLE SEPERTI KTP */
        .kartu-preview {
            margin-bottom: 25px;
        }
        
        .kartu-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .kartu-title h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-print-kartu {
            background: linear-gradient(135deg, #2c3e50, #1a2632);
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            border: none;
        }
        
        .btn-print-kartu:hover {
            transform: translateY(-2px);
            background: #1a2632;
        }
        
        .ktp-container {
            background: #e9ecef;
            padding: 20px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        
        .kartu-ktp {
            width: 100%;
            max-width: 380px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border: 1px solid #dee2e6;
        }
        
        .ktp-header {
            background: linear-gradient(135deg, #0b5e7e, #1a7b9e);
            padding: 12px;
            text-align: center;
            color: white;
        }
        
        .ktp-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 5px;
        }
        
        .ktp-logo-img {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .ktp-logo-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .ktp-logo-img i {
            font-size: 28px;
            color: #0b5e7e;
        }
        
        .ktp-header h2 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }
        
        .ktp-header p {
            font-size: 10px;
            opacity: 0.9;
        }
        
        .ktp-title {
            background: #e9ecef;
            text-align: center;
            padding: 8px;
            border-bottom: 2px solid #0b5e7e;
        }
        
        .ktp-title h4 {
            font-size: 16px;
            font-weight: 700;
            color: #0b5e7e;
            margin: 0;
        }
        
        .ktp-body {
            padding: 15px;
            display: flex;
            gap: 15px;
        }
        
        .ktp-photo {
            width: 100px;
            flex-shrink: 0;
            text-align: center;
        }
        
        .ktp-photo-img {
            width: 90px;
            height: 110px;
            object-fit: cover;
            border: 2px solid #0b5e7e;
            border-radius: 8px;
            background: #f8f9fa;
        }
        
        .ktp-photo-placeholder {
            width: 90px;
            height: 110px;
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            border: 2px solid #0b5e7e;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 700;
            color: #adb5bd;
        }
        
        .ktp-info {
            flex: 1;
        }
        
        .ktp-row {
            display: flex;
            margin-bottom: 8px;
            font-size: 11px;
        }
        
        .ktp-label {
            width: 85px;
            font-weight: 600;
            color: #495057;
        }
        
        .ktp-value {
            flex: 1;
            color: #212529;
            font-weight: 500;
        }
        
        .ktp-footer {
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        
        .ktp-footer p {
            font-size: 9px;
            color: #6c757d;
            margin: 0;
        }
        
        .ktp-footer strong {
            color: #dc3545;
        }
        
        .ktp-back {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border: 1px solid #dee2e6;
        }
        
        .ktp-back-header {
            background: linear-gradient(135deg, #0b5e7e, #1a7b9e);
            padding: 10px;
            text-align: center;
            color: white;
        }
        
        .ktp-back-header h4 {
            font-size: 12px;
            font-weight: 600;
            margin: 0;
        }
        
        .ktp-back-body {
            padding: 15px;
        }
        
        .ktp-back-info {
            margin-bottom: 15px;
        }
        
        .ktp-back-info p {
            font-size: 11px;
            color: #495057;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        
        .ktp-back-info .warning {
            color: #dc3545;
            font-weight: 600;
        }
        
        .ktp-signature {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }
        
        .ktp-signature p {
            font-size: 10px;
            color: #6c757d;
            font-style: italic;
        }
        
        .ktp-signature .signature-line {
            margin-top: 20px;
            border-top: 1px dashed #adb5bd;
            width: 150px;
            margin: 10px auto 0;
        }
        
        .flip-hint {
            text-align: center;
            margin-top: 12px;
            font-size: 10px;
            color: #6c757d;
        }
        
        .flip-hint i {
            font-size: 10px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 12px;
            color: var(--dark);
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
            }

            .profile-detail-card {
                position: static;
            }
            
            .ktp-body {
                flex-direction: column;
                align-items: center;
            }
            
            .ktp-photo {
                margin-bottom: 10px;
            }

            .hafalan-grid {
                grid-template-columns: 1fr;
            }

            .hafalan-item-full {
                grid-column: span 1;
            }
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            
            .ktp-container, .ktp-container * {
                visibility: visible;
            }
            
            .ktp-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background: white;
                padding: 20px;
            }
            
            .kartu-ktp {
                width: 85.6mm !important;
                margin: 0 auto;
                box-shadow: none;
                border: 1px solid #ddd;
                break-inside: avoid;
                page-break-inside: avoid;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .btn-print-kartu, .flip-hint, .kartu-actions, .action-bar, .sidebar, .top-nav, .detail-grid .card:not(.ktp-preview-card), .profile-detail-card, .mobile-menu-btn, .stats-grid, .card:not(.ktp-preview-card) {
                display: none !important;
            }
            
            @page {
                size: 90mm 130mm;
                margin: 5mm;
            }
        }
    </style>
</head>
<body>
    @php
        $currentRoute = request()->route()->getName();
        
        $school = null;
        if (Auth::user() && Auth::user()->school) {
            $school = Auth::user()->school;
        } elseif ($siswa && $siswa->school) {
            $school = $siswa->school;
        }
        
        $schoolName = $school->nama_sekolah ?? 'SMK INFORMATIKA UTAMA';
        $schoolNpsn = $school->npsn ?? '12345678';
        $schoolLogo = $school->logo_url ?? null;
        $kepalaSekolah = $school->kepala_sekolah ?? '___________________';
        $nipKepsek = $school->nip_kepala_sekolah ?? '____________________';
    @endphp
    
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
                    <h1>Profil Siswa</h1>
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

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> 
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <!-- Action Bar -->
            <div class="action-bar">
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('siswa.index') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah', 'guru']))
                    <a href="{{ route('siswa.hafalan.edit', $siswa) }}" class="btn btn-quran">
                        <i class="fas fa-quran"></i> Hafalan Qur'an
                    </a>
                    @endif
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']) || Auth::user()->isWaliKelas())
                    <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit Siswa
                    </a>
                    @endif
                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah', 'guru']))
                    <a href="{{ route('prestasi.create', ['siswa_id' => $siswa->id]) }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Prestasi
                    </a>
                    @endif
                </div>
            </div>

            <!-- Main Grid -->
            <div class="detail-grid">
                <!-- Left Column - Profile Card -->
                <div>
                    <div class="profile-detail-card">
                        <div class="profile-header">
                            <h3>
                                <i class="fas fa-id-card"></i>
                                KARTU IDENTITAS SISWA
                            </h3>
                        </div>
                        <div class="profile-body">
                            <div class="profile-avatar">
                                <div class="avatar-large">
                                    @if($siswa->foto)
                                        <img src="{{ asset('uploads/foto-siswa/' . $siswa->foto) }}" alt="{{ $siswa->nama_lengkap }}">
                                    @else
                                        <div class="no-photo">
                                            {{ substr($siswa->nama_lengkap, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <h2 class="profile-name-large">{{ $siswa->nama_lengkap }}</h2>
                                <p class="profile-nis">NIS: {{ $siswa->nis }}</p>
                                @if($siswa->nisn)
                                    <p class="profile-nisn">NISN: {{ $siswa->nisn }}</p>
                                @endif
                            </div>

                            <div class="info-list">
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-calendar"></i>
                                        Tempat, Tgl Lahir
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d/m/Y') : '-' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-venus-mars"></i>
                                        Jenis Kelamin
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-school"></i>
                                        Kelas
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        Wali Kelas
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->kelas->waliKelas->name ?? '-' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-phone"></i>
                                        No. HP
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->no_hp ?? '-' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-envelope"></i>
                                        Email
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->user->email ?? ($siswa->email ?? '-') }}
                                    </span>
                                </div>
                                <!-- ========== DATA ORANG TUA ========== -->
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-male"></i>
                                        Nama Ayah
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->nama_ayah ?? '-' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-female"></i>
                                        Nama Ibu
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->nama_ibu ?? '-' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">
                                        <i class="fas fa-phone-alt"></i>
                                        No. HP Orang Tua
                                    </span>
                                    <span class="info-value">
                                        {{ $siswa->no_hp_orangtua ?? '-' }}
                                    </span>
                                </div>
                                <!-- ========== END DATA ORANG TUA ========== -->
                            </div>

                            <div class="info-address">
                                <h4>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Alamat
                                </h4>
                                <p>{{ $siswa->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div style="display: flex; flex-direction: column; gap: 25px;">
                    <!-- Kartu Pelajar Style KTP -->
                    <div class="kartu-preview">
                        <div class="kartu-title">
                            <h3>
                                <i class="fas fa-id-card"></i>
                                Kartu Pelajar
                            </h3>
                            <div class="kartu-actions">
                                <button onclick="printKartu()" class="btn-print-kartu">
                                    <i class="fas fa-print"></i> Cetak Kartu
                                </button>
                            </div>
                        </div>
                        
                        <div class="ktp-container" id="ktpContainer">
                            <!-- Sisi Depan -->
                            <div class="kartu-ktp ktp-front">
                                <div class="ktp-header">
                                    <div class="ktp-logo">
                                        <div class="ktp-logo-img">
                                            @if($schoolLogo)
                                                <img src="{{ $schoolLogo }}" alt="Logo Sekolah">
                                            @else
                                                <i class="fas fa-graduation-cap"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h2>{{ $schoolName }}</h2>
                                            <p>NPSN: {{ $schoolNpsn }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ktp-title">
                                    <h4>KARTU TANDA PELAJAR</h4>
                                </div>
                                <div class="ktp-body">
                                    <div class="ktp-photo">
                                        @if($siswa->foto)
                                            <img src="{{ asset('uploads/foto-siswa/' . $siswa->foto) }}" alt="{{ $siswa->nama_lengkap }}" class="ktp-photo-img">
                                        @else
                                            <div class="ktp-photo-placeholder">
                                                {{ substr($siswa->nama_lengkap, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ktp-info">
                                        <div class="ktp-row">
                                            <div class="ktp-label">NIS</div>
                                            <div class="ktp-value">{{ $siswa->nis }}</div>
                                        </div>
                                        <div class="ktp-row">
                                            <div class="ktp-label">NISN</div>
                                            <div class="ktp-value">{{ $siswa->nisn ?? '-' }}</div>
                                        </div>
                                        <div class="ktp-row">
                                            <div class="ktp-label">Nama</div>
                                            <div class="ktp-value">{{ strtoupper($siswa->nama_lengkap) }}</div>
                                        </div>
                                        <div class="ktp-row">
                                            <div class="ktp-label">Tempat/Tgl Lahir</div>
                                            <div class="ktp-value">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}</div>
                                        </div>
                                        <div class="ktp-row">
                                            <div class="ktp-label">Jenis Kelamin</div>
                                            <div class="ktp-value">{{ $siswa->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</div>
                                        </div>
                                        <div class="ktp-row">
                                            <div class="ktp-label">Kelas</div>
                                            <div class="ktp-value">{{ $siswa->kelas->nama_kelas ?? '-' }}</div>
                                        </div>
                                        <div class="ktp-row">
                                            <div class="ktp-label">Alamat</div>
                                            <div class="ktp-value">{{ Str::limit($siswa->alamat ?? '-', 30) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ktp-footer">
                                    <p>Berlaku sampai dengan: <strong>{{ date('Y')+3 }}</strong> | Dikeluarkan oleh: SIPRES</p>
                                </div>
                            </div>
                            
                            <!-- Sisi Belakang -->
                            <div class="kartu-ktp ktp-back">
                                <div class="ktp-back-header">
                                    <h4>PETUNJUK PENGGUNAAN</h4>
                                </div>
                                <div class="ktp-back-body">
                                    <div class="ktp-back-info">
                                        <p><i class="fas fa-check-circle"></i> Kartu ini adalah bukti identitas resmi siswa</p>
                                        <p><i class="fas fa-check-circle"></i> Wajib dibawa saat berada di lingkungan sekolah</p>
                                        <p><i class="fas fa-check-circle"></i> Digunakan untuk keperluan administrasi sekolah</p>
                                        <p><i class="fas fa-check-circle"></i> Berlaku selama siswa terdaftar di sekolah</p>
                                    </div>
                                    <div class="ktp-back-info">
                                        <p class="warning"><i class="fas fa-exclamation-triangle"></i> <strong>PERINGATAN:</strong></p>
                                        <p>✧ Kartu ini milik sekolah, bukan milik pribadi</p>
                                        <p>✧ Jika hilang, segera laporkan ke bagian kesiswaan</p>
                                        <p>✧ Denda penggantian kartu hilang: <strong>Rp 30.000,-</strong></p>
                                        <p>✧ Pemalsuan kartu akan dikenakan sanksi tegas</p>
                                    </div>
                                    <div class="ktp-signature">
                                        <p>Kepala Sekolah</p>
                                        <div class="signature-line"></div>
                                        <p style="margin-top: 5px;">{{ $kepalaSekolah }}</p>
                                        <p style="font-size: 8px;">NIP. {{ $nipKepsek }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flip-hint">
                            <i class="fas fa-info-circle"></i> Kartu ini dapat dicetak sebagai PDF dengan ukuran KTP standar
                        </div>
                    </div>

                    <!-- Statistik Prestasi -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon yellow">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Total Prestasi</h4>
                                <p>{{ $siswa->prestasi->count() }}</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon green">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Terverifikasi</h4>
                                <p>{{ $siswa->prestasi->where('status', 'diverifikasi')->count() }}</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon blue">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <h4>Pending</h4>
                                <p>{{ $siswa->prestasi->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hafalan Qur'an Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <i class="fas fa-quran"></i>
                                Hafalan Qur'an
                            </h2>
                            @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah', 'guru']))
                            <a href="{{ route('siswa.hafalan.edit', $siswa) }}" class="btn btn-quran btn-sm">
                                <i class="fas fa-edit"></i> Edit Hafalan
                            </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @php $hafalan = $siswa->hafalanQuran; @endphp
                            
                            @if($hafalan)
                                <div class="hafalan-grid">
                                    <div class="hafalan-item">
                                        <span class="hafalan-label">
                                            <i class="fas fa-check-circle"></i> Status
                                        </span>
                                        <span class="hafalan-value">
                                            @if($hafalan->is_active)
                                                <span class="badge badge-quran-active">
                                                    <i class="fas fa-check-circle"></i> Aktif
                                                </span>
                                            @else
                                                <span class="badge badge-quran-inactive">
                                                    <i class="fas fa-times-circle"></i> Tidak Aktif
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    
                                    @if($hafalan->is_active)
                                    <div class="hafalan-item">
                                        <span class="hafalan-label">
                                            <i class="fas fa-book"></i> Juz Dihafal
                                        </span>
                                        <span class="hafalan-value">
                                            <span class="badge" style="background: #E8F0FE; color: #2A5C8A;">
                                                <i class="fas fa-book-open"></i> Juz {{ $hafalan->juz }}
                                            </span>
                                        </span>
                                    </div>
                                    @endif
                                    
                                    @if($hafalan->target_juz)
                                    <div class="hafalan-item">
                                        <span class="hafalan-label">
                                            <i class="fas fa-bullseye"></i> Target
                                        </span>
                                        <span class="hafalan-value">{{ $hafalan->target_juz }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($hafalan->start_date)
                                    <div class="hafalan-item">
                                        <span class="hafalan-label">
                                            <i class="fas fa-calendar-alt"></i> Mulai Menghafal
                                        </span>
                                        <span class="hafalan-value">{{ $hafalan->start_date->format('d/m/Y') }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($hafalan->pembimbing)
                                    <div class="hafalan-item">
                                        <span class="hafalan-label">
                                            <i class="fas fa-chalkboard-teacher"></i> Pembimbing
                                        </span>
                                        <span class="hafalan-value">{{ $hafalan->pembimbing }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($hafalan->description)
                                    <div class="hafalan-item hafalan-item-full">
                                        <span class="hafalan-label">
                                            <i class="fas fa-file-alt"></i> Keterangan
                                        </span>
                                        <span class="hafalan-value" style="font-weight: normal;">{{ $hafalan->description }}</span>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-quran"></i>
                                    <p>Belum ada data hafalan Qur'an</p>
                                    <a href="{{ route('siswa.hafalan.edit', $siswa) }}" class="btn btn-quran btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Data Hafalan
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Riwayat Prestasi -->
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <i class="fas fa-trophy"></i>
                                Riwayat Prestasi
                            </h2>
                            @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah', 'guru']))
                            <a href="{{ route('prestasi.create', ['siswa_id' => $siswa->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah Prestasi
                            </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($siswa->prestasi->count() > 0)
                                <div class="achievement-list">
                                    @foreach($siswa->prestasi as $prestasi)
                                    <div class="achievement-item">
                                        <div class="achievement-header">
                                            <span class="badge {{ $prestasi->jenis_prestasi == 'akademik' ? 'badge-blue' : 'badge-purple' }}">
                                                <i class="fas {{ $prestasi->jenis_prestasi == 'akademik' ? 'fa-book' : 'fa-music' }}"></i>
                                                {{ ucfirst($prestasi->jenis_prestasi) }}
                                            </span>
                                            <span class="badge {{ $prestasi->status == 'diverifikasi' ? 'badge-green' : 'badge-yellow' }}">
                                                <i class="fas {{ $prestasi->status == 'diverifikasi' ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                                {{ ucfirst($prestasi->status) }}
                                            </span>
                                        </div>
                                        <h4 class="achievement-title">{{ $prestasi->nama_lomba }}</h4>
                                        <div class="achievement-meta">
                                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> {{ ucfirst($prestasi->tingkat) }}</span>
                                            <span class="meta-item"><i class="fas fa-medal"></i> {{ $prestasi->peringkat }}</span>
                                            <span class="meta-item"><i class="fas fa-calendar"></i> {{ $prestasi->tahun }}</span>
                                        </div>
                                        @if($prestasi->deskripsi)
                                            <p class="achievement-description">{{ $prestasi->deskripsi }}</p>
                                        @endif
                                        <div class="achievement-actions">
                                            @if($prestasi->file_sertifikat)
                                            <a href="{{ $prestasi->sertifikat_url }}" target="_blank" class="btn-icon btn-pdf" title="Lihat Sertifikat">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            @endif
                                            @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah', 'guru']) && $prestasi->status == 'pending')
                                            <form action="{{ route('prestasi.verify', $prestasi) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-icon btn-verify" title="Verifikasi" onclick="return confirm('Verifikasi prestasi ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-trophy"></i>
                                    <p>Belum ada data prestasi</p>
                                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah', 'guru']))
                                    <a href="{{ route('prestasi.create', ['siswa_id' => $siswa->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Prestasi
                                    </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ekstrakurikuler -->
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <i class="fas fa-futbol"></i>
                                Ekstrakurikuler
                            </h2>
                            @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']) || Auth::user()->isWaliKelas())
                            <button onclick="openModal('eskulModal')" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($siswa->eskul->count() > 0)
                                <div class="eskul-grid">
                                    @foreach($siswa->eskul as $eskul)
                                    <div class="eskul-item">
                                        <div class="eskul-icon">
                                            {{ substr($eskul->nama_eskul, 0, 1) }}
                                        </div>
                                        <div class="eskul-info">
                                            <h4>{{ $eskul->nama_eskul }}</h4>
                                            <p>{{ $eskul->pivot->keterangan ?? 'Anggota' }} ({{ $eskul->pivot->tahun_masuk }})</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-futbol"></i>
                                    <p>Belum mengikuti ekstrakurikuler</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Minat Bakat -->
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <i class="fas fa-heart"></i>
                                Minat & Bakat
                            </h2>
                            @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']) || Auth::user()->isWaliKelas())
                            <button onclick="openModal('minatModal')" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($siswa->minatBakat->count() > 0)
                                <div class="minat-list">
                                    @foreach($siswa->minatBakat as $minat)
                                    <span class="minat-item">{{ $minat->nama_minat }}</span>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-heart"></i>
                                    <p>Belum ada data minat & bakat</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Eskul -->
    <div class="modal" id="eskulModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Ekstrakurikuler</h3>
                <button onclick="closeModal('eskulModal')" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('siswa.eskul.add', $siswa) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Eskul</label>
                    <select name="eskul_id" required>
                        <option value="">Pilih Ekstrakurikuler</option>
                        @foreach(\App\Models\Eskul::where('school_id', $siswa->school_id)->get() as $eskul)
                        <option value="{{ $eskul->id }}">{{ $eskul->nama_eskul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tahun Masuk</label>
                    <input type="number" name="tahun_masuk" value="{{ date('Y') }}" required>
                </div>
                <div class="form-group">
                    <label>Jabatan/Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Anggota/Ketua/dll">
                </div>
                <div class="modal-actions" style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                    <button type="button" onclick="closeModal('eskulModal')" class="btn btn-back">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Minat -->
    <div class="modal" id="minatModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Minat & Bakat</h3>
                <button onclick="closeModal('minatModal')" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('siswa.minat.add', $siswa) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Pilih Minat</label>
                    <select name="minat_bakat_id" required>
                        <option value="">Pilih Minat</option>
                        @foreach(\App\Models\MinatBakat::where('school_id', $siswa->school_id)->get() as $minat)
                        <option value="{{ $minat->id }}">{{ $minat->nama_minat }} ({{ $minat->kategori }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-actions" style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                    <button type="button" onclick="closeModal('minatModal')" class="btn btn-back">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Profile</h3>
                <button onclick="closeModal('profileModal')" class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="POST" action="/profile/update" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>
                        <i class="fas fa-camera"></i> Foto Profile
                    </label>
                    <input type="file" name="avatar" accept="image/*" onchange="previewProfileImage(this)">
                    <small style="color: var(--secondary); margin-top: 5px; display: block;">Format: JPG, PNG. Maks: 2MB</small>
                    
                    @if(Auth::user() && Auth::user()->avatar)
                    <div style="margin-top: 8px; display: flex; align-items: center; gap: 8px; padding: 8px; background: var(--gray-soft); border-radius: 10px;">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                        <span style="font-size: 12px; color: var(--secondary);">Avatar saat ini</span>
                    </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
                
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation">
                </div>
                
                <div class="modal-actions" style="display: flex; gap: 12px; margin-top: 20px;">
                    <button type="button" onclick="closeModal('profileModal')" class="btn btn-back" style="flex: 1;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan</button>
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
            openModal('profileModal');
        }

        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function printKartu() {
            const frontCard = document.querySelector('.ktp-front').cloneNode(true);
            const backCard = document.querySelector('.ktp-back').cloneNode(true);
            
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Kartu Pelajar - {{ $siswa->nama_lengkap }}</title>
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
                    <style>
                        * { margin: 0; padding: 0; box-sizing: border-box; }
                        body {
                            font-family: 'Inter', 'Segoe UI', sans-serif;
                            background: #e5e5e5;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            min-height: 100vh;
                            padding: 20px;
                        }
                        .kartu-container {
                            display: flex;
                            flex-direction: column;
                            gap: 15px;
                            align-items: center;
                        }
                        .kartu-ktp {
                            width: 85.6mm;
                            background: white;
                            border-radius: 8px;
                            overflow: hidden;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                            border: 1px solid #dee2e6;
                        }
                        .ktp-header {
                            background: linear-gradient(135deg, #0b5e7e, #1a7b9e);
                            padding: 10px;
                            text-align: center;
                            color: white;
                        }
                        .ktp-logo {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                        }
                        .ktp-logo-img {
                            width: 40px;
                            height: 40px;
                            background: white;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            overflow: hidden;
                        }
                        .ktp-logo-img img { width: 100%; height: 100%; object-fit: cover; }
                        .ktp-logo-img i { font-size: 24px; color: #0b5e7e; }
                        .ktp-header h2 { font-size: 12px; font-weight: 700; margin-bottom: 2px; }
                        .ktp-header p { font-size: 8px; opacity: 0.9; }
                        .ktp-title { background: #e9ecef; text-align: center; padding: 6px; }
                        .ktp-title h4 { font-size: 12px; font-weight: 700; color: #0b5e7e; margin: 0; }
                        .ktp-body { padding: 10px; display: flex; gap: 10px; }
                        .ktp-photo { width: 80px; flex-shrink: 0; text-align: center; }
                        .ktp-photo-img { width: 75px; height: 95px; object-fit: cover; border: 2px solid #0b5e7e; border-radius: 6px; }
                        .ktp-photo-placeholder { width: 75px; height: 95px; background: linear-gradient(135deg, #e9ecef, #dee2e6); border: 2px solid #0b5e7e; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; color: #adb5bd; }
                        .ktp-info { flex: 1; }
                        .ktp-row { display: flex; margin-bottom: 5px; font-size: 9px; }
                        .ktp-label { width: 70px; font-weight: 600; color: #495057; }
                        .ktp-value { flex: 1; color: #212529; font-weight: 500; }
                        .ktp-footer { background: #f8f9fa; padding: 6px; text-align: center; border-top: 1px solid #dee2e6; }
                        .ktp-footer p { font-size: 7px; color: #6c757d; }
                        .ktp-back-header { background: linear-gradient(135deg, #0b5e7e, #1a7b9e); padding: 8px; text-align: center; color: white; }
                        .ktp-back-header h4 { font-size: 10px; font-weight: 600; margin: 0; }
                        .ktp-back-body { padding: 10px; }
                        .ktp-back-info { margin-bottom: 10px; }
                        .ktp-back-info p { font-size: 8px; color: #495057; margin-bottom: 4px; }
                        .ktp-back-info .warning { color: #dc3545; font-weight: 600; }
                        .ktp-signature { margin-top: 10px; padding-top: 8px; border-top: 1px solid #e9ecef; text-align: center; }
                        .ktp-signature p { font-size: 8px; color: #6c757d; }
                        .signature-line { margin-top: 8px; border-top: 1px dashed #adb5bd; width: 120px; margin: 8px auto 0; }
                        @media print {
                            body { background: white; padding: 0; margin: 0; }
                            .kartu-container { gap: 10px; }
                            .kartu-ktp { break-inside: avoid; page-break-inside: avoid; box-shadow: none; border: 1px solid #ddd; }
                            @page { size: 90mm 130mm; margin: 5mm; }
                        }
                    </style>
                </head>
                <body>
                    <div class="kartu-container">
                        <div class="kartu-ktp">${frontCard.outerHTML}</div>
                        <div class="kartu-ktp">${backCard.outerHTML}</div>
                    </div>
                    <script>
                        window.onload = function() {
                            window.print();
                            setTimeout(function() { window.close(); }, 1000);
                        };
                    <\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
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
            const modals = ['profileModal', 'eskulModal', 'minatModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (e.target === modal) {
                    closeModal(modalId);
                }
            });
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
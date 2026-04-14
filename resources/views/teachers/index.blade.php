<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Guru - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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

        .btn-sm {
            padding: 8px 16px;
            font-size: 12px;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid rgba(42, 92, 138, 0.08);
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-label {
            display: block;
            margin-bottom: 6px;
            color: var(--secondary);
            font-size: 12px;
            font-weight: 600;
        }

        .search-wrapper {
            position: relative;
            width: 100%;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            font-size: 14px;
        }

        .search-input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1);
        }

        .filter-select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #E5E9F0;
            border-radius: 10px;
            font-size: 13px;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
            background-color: white;
        }

        .filter-select:focus {
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

        /* School Header untuk Super Admin */
        .school-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0 15px 0;
            padding: 15px 20px;
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(42, 92, 138, 0.08);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .school-header:first-of-type {
            margin-top: 0;
        }

        .school-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .school-title i {
            font-size: 24px;
            color: var(--primary);
        }

        .school-title h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: var(--dark);
        }

        .school-badge {
            background: var(--primary-soft);
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            border: 1px solid rgba(42, 92, 138, 0.08);
            margin-top: 20px;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
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

        /* Table Styles */
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
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 2px solid rgba(42, 92, 138, 0.08);
        }

        table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
            color: var(--dark);
            font-size: 13px;
            vertical-align: middle;
        }

        table tr:hover {
            background-color: var(--gray-soft);
        }

        /* Avatar */
        .avatar-circle {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(42, 92, 138, 0.2);
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success {
            background: #E3F2E9;
            color: var(--success);
        }

        .badge-danger {
            background: #FFE9E9;
            color: var(--danger);
        }

        .badge-warning {
            background: #FFF4E5;
            color: #B76E00;
        }

        .badge-info {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .badge-secondary {
            background: #F1F4F9;
            color: var(--secondary);
        }

        .badge-purple {
            background: #F0E6FF;
            color: #8B5CF6;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
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

        .btn-view {
            background: var(--primary);
        }

        .btn-edit {
            background: var(--warning);
            color: #212529;
        }

        .btn-delete {
            background: var(--danger);
        }

        .btn-reset {
            background: #FF9800;
        }

        .btn-reset:hover {
            background: #F57C00;
        }

        /* Empty State */
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
        }

        .info-banner i {
            font-size: 20px;
            color: var(--primary);
        }

        .info-banner p {
            margin: 0;
            font-size: 13px;
            color: var(--dark);
        }

        /* Pagination */
        .pagination-container {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .pagination-info {
            color: var(--secondary);
            font-size: 13px;
            background: var(--gray-soft);
            padding: 6px 12px;
            border-radius: 20px;
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
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            border: 1px solid rgba(42, 92, 138, 0.1);
            border-radius: 8px;
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

        .pagination .disabled .page-link {
            color: #ccc;
            pointer-events: none;
            background-color: #f8f9fa;
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
            backdrop-filter: blur(5px);
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

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid rgba(42, 92, 138, 0.08);
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid rgba(42, 92, 138, 0.08);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
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

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
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

        .btn-save {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-cancel {
            padding: 10px 20px;
            background: #F1F4F9;
            color: var(--dark);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
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
            table {
                min-width: 1000px;
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
                justify-content: center;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                justify-content: center;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .school-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
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

            <!-- MENU UTAMA -->
            <div class="menu-title">MENU UTAMA</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
            </ul>

            <!-- DATA MASTER -->
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

            <!-- SUPER ADMIN ONLY -->
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
                    <h1>Data Guru</h1>
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
                                {{ substr(Auth::user()->name ?? 'AS', 0, 1) }}
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

            <!-- Info Banner untuk Super Admin -->
            @if(Auth::user()->role == 'super_admin')
            <div class="info-banner">
                <i class="fas fa-info-circle"></i>
                <p>Mode Super Admin - Anda dapat melihat semua guru dari seluruh sekolah, namun <strong>tidak dapat menambah, mengedit, atau menghapus</strong> data guru.</p>
            </div>
            @endif

            <!-- Action Bar -->
            <div class="action-bar">
                <h2>
                    <i class="fas fa-chalkboard-teacher"></i> 
                    @if(Auth::user()->role == 'super_admin')
                        Daftar Guru Semua Sekolah
                    @else
                        Daftar Guru {{ Auth::user()->school->name ?? '' }}
                    @endif
                </h2>
                @if(Auth::user()->role == 'admin_sekolah')
                <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Guru
                </a>
                @endif
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <form method="GET" action="{{ route('teachers.index') }}" class="filter-form">
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-search"></i> Pencarian</label>
                        <div class="search-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" 
                                   name="search" 
                                   class="search-input" 
                                   placeholder="Cari nama, NIP, NUPTK, atau email..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    @if(Auth::user()->role == 'super_admin')
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-building"></i> Filter Sekolah</label>
                        <select name="school_id" class="filter-select">
                            <option value="">Semua Sekolah</option>
                            @foreach($schools ?? [] as $school)
                            <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    <div class="filter-group">
                        <label class="filter-label"><i class="fas fa-chalkboard"></i> Status</label>
                        <select name="status" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('teachers.index') }}" class="btn-filter">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- TAMPILAN UNTUK SUPER ADMIN (GROUP BY SEKOLAH) -->
            @if(Auth::user()->role == 'super_admin')
                @php
                    $groupedTeachers = $teachers->groupBy('school_id');
                    $globalCounter = 0;
                @endphp

                @forelse($groupedTeachers as $schoolId => $teachersSekolah)
                    @php
                        $school = $schools->firstWhere('id', $schoolId);
                    @endphp
                    
                    <div class="school-header">
                        <div class="school-title">
                            <i class="fas fa-building"></i>
                            <h3>{{ $school->name ?? 'Sekolah Tidak Dikenal' }}</h3>
                        </div>
                        <span class="school-badge">
                            <i class="fas fa-chalkboard-teacher"></i> Total: {{ $teachersSekolah->count() }} Guru
                        </span>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="40">No</th>
                                            <th width="60">Foto</th>
                                            <th>Nama / NIP</th>
                                            <th>NUPTK</th>
                                            <th>Email</th>
                                            <th>JK</th>
                                            <th>Status</th>
                                            <th>Wali Kelas</th>
                                            <th width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teachersSekolah as $teacher)
                                            @php $globalCounter++; @endphp
                                            <tr>
                                                <td class="text-center">{{ $globalCounter }}</td>
                                                <td>
                                                    <div class="avatar-circle">
                                                        @if($teacher->photo && file_exists(public_path('uploads/foto-guru/' . $teacher->photo)))
                                                            <img src="{{ asset('uploads/foto-guru/' . $teacher->photo) }}" alt="{{ $teacher->name }}">
                                                        @else
                                                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="font-weight: 700; color: var(--dark); margin-bottom: 4px;">
                                                        {{ $teacher->name }}
                                                    </div>
                                                    @if($teacher->nip)
                                                    <div style="font-size: 11px; color: var(--secondary);">
                                                        <i class="fas fa-id-card"></i> NIP: {{ $teacher->nip }}
                                                    </div>
                                                    @endif
                                                    @if($teacher->phone)
                                                    <div style="font-size: 10px; color: #999; margin-top: 2px;">
                                                        <i class="fas fa-phone"></i> {{ $teacher->phone }}
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($teacher->nuptk)
                                                        <span class="badge badge-info">
                                                            <i class="fas fa-id-badge"></i> {{ $teacher->nuptk }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $teacher->email }}</td>
                                                <td class="text-center">
                                                    @if($teacher->gender == 'L')
                                                        <span class="badge badge-info"><i class="fas fa-mars"></i> L</span>
                                                    @elseif($teacher->gender == 'P')
                                                        <span class="badge badge-purple"><i class="fas fa-venus"></i> P</span>
                                                    @else
                                                        <span class="badge badge-secondary">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($teacher->is_active)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($teacher->is_homeroom)
                                                        <span class="badge badge-warning">Wali Kelas</span>
                                                        @if($teacher->homeroom)
                                                        <div style="font-size: 10px; margin-top: 4px;">
                                                            {{ $teacher->homeroom->nama_kelas ?? '-' }}
                                                        </div>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-secondary">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="{{ route('teachers.show', $teacher->id) }}" class="btn-icon btn-view" title="Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <!-- SUPER ADMIN HANYA BISA LIHAT -->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Belum ada data guru di semua sekolah</p>
                    </div>
                @endforelse

            @else
                <!-- TAMPILAN UNTUK ADMIN SEKOLAH -->
                <div class="card">
                    <div class="card-header">
                        <h2>
                            <i class="fas fa-chalkboard-teacher"></i>
                            Data Guru
                        </h2>
                        <div style="font-size: 12px; color: var(--secondary); background: var(--gray-soft); padding: 5px 12px; border-radius: 20px;">
                            <i class="fas fa-database"></i> Total: {{ $teachers->total() ?? 0 }} guru
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="40">No</th>
                                        <th width="60">Foto</th>
                                        <th>Nama / NIP</th>
                                        <th>NUPTK</th>
                                        <th>Email</th>
                                        <th>JK</th>
                                        <th>Status</th>
                                        <th>Wali Kelas</th>
                                        <th width="160">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($teachers as $index => $teacher)
                                    <tr>
                                        <td class="text-center">{{ $teachers->firstItem() + $index }}</td>
                                        <td>
                                            <div class="avatar-circle">
                                                @if($teacher->photo && file_exists(public_path('uploads/foto-guru/' . $teacher->photo)))
                                                    <img src="{{ asset('uploads/foto-guru/' . $teacher->photo) }}" alt="{{ $teacher->name }}">
                                                @else
                                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: var(--dark); margin-bottom: 4px;">
                                                {{ $teacher->name }}
                                            </div>
                                            @if($teacher->nip)
                                            <div style="font-size: 11px; color: var(--secondary);">
                                                <i class="fas fa-id-card"></i> NIP: {{ $teacher->nip }}
                                            </div>
                                            @endif
                                            @if($teacher->phone)
                                            <div style="font-size: 10px; color: #999; margin-top: 2px;">
                                                <i class="fas fa-phone"></i> {{ $teacher->phone }}
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($teacher->nuptk)
                                                <span class="badge badge-info">
                                                    <i class="fas fa-id-badge"></i> {{ $teacher->nuptk }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $teacher->email }}</td>
                                        <td class="text-center">
                                            @if($teacher->gender == 'L')
                                                <span class="badge badge-info"><i class="fas fa-mars"></i> L</span>
                                            @elseif($teacher->gender == 'P')
                                                <span class="badge badge-purple"><i class="fas fa-venus"></i> P</span>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($teacher->is_active)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($teacher->is_homeroom)
                                                <span class="badge badge-warning">Wali Kelas</span>
                                                @if($teacher->homeroom)
                                                <div style="font-size: 10px; margin-top: 4px;">
                                                    {{ $teacher->homeroom->nama_kelas ?? '-' }}
                                                </div>
                                                @endif
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn-icon btn-view" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn-icon btn-edit" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn-icon btn-reset" onclick="resetPassword({{ $teacher->id }}, '{{ $teacher->name }}')" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data guru {{ $teacher->name }}? Akun user juga akan ikut terhapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9">
                                            <div class="empty-state">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                                <p>Belum ada data guru</p>
                                                @if(Auth::user()->role == 'admin_sekolah')
                                                <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Tambah Guru Sekarang
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if(method_exists($teachers, 'hasPages') && $teachers->hasPages())
                        <div class="pagination-container">
                            <div class="pagination-info">
                                <i class="fas fa-info-circle"></i>
                                Menampilkan {{ $teachers->firstItem() ?? 0 }} - {{ $teachers->lastItem() ?? 0 }} 
                                dari {{ $teachers->total() ?? 0 }} data
                            </div>
                            <div class="pagination">
                                {{ $teachers->withQueryString()->links() }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Profile Edit Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-edit"></i> Edit Profile</h3>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-camera"></i> Foto Profile</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <small style="color: var(--secondary); display: block; margin-top: 5px;">Format: JPG, PNG. Maks: 2MB</small>
                        @if(Auth::user() && Auth::user()->avatar)
                        <div class="current-avatar">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Current Avatar">
                            <span>Avatar saat ini</span>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-lock"></i> Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeProfileModal()"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan</button>
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
                    if (profileImage) profileImage.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmLogout() {
            if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Reset Password Function
        function resetPassword(teacherId, teacherName) {
            if(confirm(`Reset password untuk ${teacherName}?\n\nPassword baru akan dibuat secara otomatis.`)) {
                let btn = event.currentTarget;
                let originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                btn.disabled = true;
                
                fetch(`/teachers/${teacherId}/reset-password`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert(`✅ Password berhasil direset!\n\nNama: ${data.name}\nEmail: ${data.email}\nPassword Baru: ${data.new_password}\n\n⚠️ Simpan password ini dan berikan ke guru yang bersangkutan.`);
                        location.reload();
                    } else {
                        alert('❌ Gagal reset password: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('❌ Terjadi kesalahan saat mereset password');
                })
                .finally(() => {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                });
            }
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('profileModal');
            if (e.target === modal) closeProfileModal();
        });

        // Close sidebar on mobile when clicking outside
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

        // Auto close alerts
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
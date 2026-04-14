<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Daftar Sekolah - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #eef2f6;
            position: relative;
        }

        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --primary-soft: #e0e7ff;
            --secondary: #6b7280;
            --dark: #1f2937;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gradient-start: #2b3a8c;
            --gradient-end: #1e2b6a;
        }

        /* Register Container - Full Width & Height */
        .register-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            overflow: hidden;
        }

        /* Left Side - Hero Section (60%) */
        .hero-section {
            flex: 0 0 60%;
            background: linear-gradient(145deg, var(--gradient-start), var(--gradient-end));
            padding: 60px 80px;
            position: relative;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .hero-section::-webkit-scrollbar {
            width: 6px;
        }

        .hero-section::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .hero-section::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -15%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-30px, 30px) rotate(5deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }

        .badge-platform {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 12px 28px;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 50px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            width: fit-content;
            letter-spacing: 0.5px;
        }

        .badge-platform i {
            margin-right: 10px;
            color: #fbbf24;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 25px;
            letter-spacing: -0.02em;
        }

        .hero-description {
            font-size: 1.1rem;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 60px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Stats Cards */
        .stats-grid {
            display: flex;
            gap: 50px;
            margin-bottom: 70px;
        }

        .stat-card {
            flex: 1;
        }

        .stat-value {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 8px;
            color: white;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.8;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Testimonial Card */
        .testimonial-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 24px;
            margin-top: auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
        }

        .testimonial-stars {
            display: flex;
            gap: 6px;
            margin-bottom: 20px;
        }

        .testimonial-stars i {
            color: #fbbf24;
            font-size: 1.2rem;
        }

        .testimonial-text {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            font-style: italic;
            color: rgba(255, 255, 255, 0.95);
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .author-info {
            font-size: 0.95rem;
        }

        .author-name {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .author-title {
            font-size: 0.85rem;
            opacity: 0.7;
        }

        /* Right Side - Register Section (40%) */
        .register-section-right {
            flex: 0 0 40%;
            padding: 60px 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .register-section-right::-webkit-scrollbar {
            width: 6px;
        }

        .register-section-right::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .register-section-right::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        .register-content {
            max-width: 450px;
            margin: 0 auto;
            width: 100%;
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            text-decoration: none;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }

        .brand-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .brand-text {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Header */
        .register-header {
            margin-bottom: 30px;
        }

        .register-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .register-subtitle {
            color: var(--secondary);
            font-size: 0.95rem;
        }

        /* Step Indicator */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
            position: relative;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            z-index: 0;
        }

        .step-item {
            position: relative;
            z-index: 1;
            text-align: center;
            flex: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            background: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #6b7280;
            margin: 0 auto 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .step-item.active .step-circle {
            background: var(--primary);
            color: white;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.2);
        }

        .step-item.completed .step-circle {
            background: var(--success);
            color: white;
        }

        .step-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
        }

        .step-item.active .step-label {
            color: var(--primary);
            font-weight: 600;
        }

        /* Form Steps */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }

        .form-label i {
            color: var(--primary);
            font-size: 0.95rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #9ca3af;
            font-size: 1rem;
            z-index: 1;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background: #f9fafb;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        textarea.form-control {
            padding: 12px 16px;
            resize: vertical;
        }

        /* OTP Input */
        .otp-input {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin: 20px 0;
        }

        .otp-digit {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 1.6rem;
            font-weight: 700;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            background: #f9fafb;
        }

        .otp-digit:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .timer {
            text-align: center;
            color: var(--secondary);
            font-size: 0.85rem;
            margin: 15px 0;
        }

        .resend-btn {
            text-align: center;
        }

        /* Buttons */
        .btn-primary-custom {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -8px var(--primary);
        }

        .btn-outline-custom {
            width: 100%;
            padding: 12px;
            background: transparent;
            border: 1.5px solid var(--primary);
            color: var(--primary);
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: white;
        }

        .btn-link-custom {
            background: none;
            border: none;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .btn-link-custom:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .button-group .btn-outline-custom,
        .button-group .btn-primary-custom {
            flex: 1;
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
        }

        .alert-info {
            background: #e0e7ff;
            color: #4338ca;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        /* Back to Login */
        .back-to-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            margin-top: 20px;
        }

        .back-to-login:hover {
            color: var(--primary);
            transform: translateX(-3px);
        }

        /* Simple Loading Spinner - Minimal */
        .simple-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Button Loading State */
        .btn-loading {
            opacity: 0.7;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Success Message Popup */
        .success-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            z-index: 10000;
            text-align: center;
            max-width: 400px;
            width: 90%;
            animation: popupSlide 0.3s ease;
        }

        .success-popup i {
            font-size: 4rem;
            color: var(--success);
            margin-bottom: 20px;
        }

        .success-popup h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .success-popup p {
            color: var(--secondary);
            margin-bottom: 20px;
        }

        .btn-ok {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-ok:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        @keyframes popupSlide {
            from {
                opacity: 0;
                transform: translate(-50%, -40%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .overlay-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 10001;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-item {
            background: white;
            border-left: 4px solid;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 280px;
            animation: slideInRight 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .toast-item.success {
            border-left-color: var(--success);
        }

        .toast-item.error {
            border-left-color: var(--danger);
        }

        .toast-item.info {
            border-left-color: var(--primary);
        }

        .toast-item i {
            font-size: 1.2rem;
        }

        .toast-item.success i {
            color: var(--success);
        }

        .toast-item.error i {
            color: var(--danger);
        }

        .toast-item.info i {
            color: var(--primary);
        }

        .toast-item span {
            color: var(--dark);
            font-size: 0.85rem;
            flex: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .register-container {
                position: relative;
                flex-direction: column;
                overflow-y: auto;
            }
            
            .hero-section,
            .register-section-right {
                flex: auto;
                min-height: auto;
            }
            
            .hero-section {
                padding: 40px;
            }
            
            .register-section-right {
                padding: 40px;
            }
            
            body {
                overflow: auto;
            }
            
            .stats-grid {
                gap: 30px;
            }
            
            .stat-value {
                font-size: 2rem;
            }
        }

        @media (max-width: 640px) {
            .hero-section {
                padding: 30px 20px;
            }
            
            .register-section-right {
                padding: 30px 20px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .otp-digit {
                width: 45px;
                height: 50px;
                font-size: 1.3rem;
            }
            
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <div class="badge-platform">
                    <i class="bi bi-trophy-fill"></i>
                    Daftar Sekolah
                </div>
                
                <h1 class="hero-title">
                    Bergabung<br>dengan SIPRES!
                </h1>
                
                <p class="hero-description">
                    Platform digital untuk mencatat, mempublikasi, dan mengapresiasi prestasi siswa di seluruh Indonesia.
                </p>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">125+</div>
                        <div class="stat-label">Sekolah</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">2.5K+</div>
                        <div class="stat-label">Siswa</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">1.2K+</div>
                        <div class="stat-label">Prestasi</div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="testimonial-text">
                        "SIPRES sangat membantu dokumentasi prestasi siswa. Fiturnya lengkap dan mudah digunakan."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="author-info">
                            <div class="author-name">Drs. KH. Komarudin</div>
                            <div class="author-title">MA Al-Hidayah</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Register Section -->
        <div class="register-section-right">
            <div class="register-content">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="brand">
                    <div class="brand-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <span class="brand-text">SIPRES</span>
                </a>
                
                <!-- Header -->
                <div class="register-header">
                    <h2 class="register-title">Daftar Sekolah</h2>
                    <p class="register-subtitle">
                        Isi data sekolah Anda untuk bergabung dengan SIPRES
                    </p>
                </div>
                
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step-item active" id="step1Indicator">
                        <div class="step-circle">1</div>
                        <div class="step-label">Data Sekolah</div>
                    </div>
                    <div class="step-item" id="step2Indicator">
                        <div class="step-circle">2</div>
                        <div class="step-label">Verifikasi</div>
                    </div>
                    <div class="step-item" id="step3Indicator">
                        <div class="step-circle">3</div>
                        <div class="step-label">Akun Admin</div>
                    </div>
                </div>
                
                <form id="registerForm">
                    @csrf
                    
                    <!-- Step 1: Data Sekolah -->
                    <div id="step1" class="form-step active">
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-building"></i> Nama Sekolah *</label>
                            <div class="input-wrapper">
                                <i class="bi bi-building input-icon"></i>
                                <input type="text" class="form-control" id="schoolName" placeholder="Masukkan nama sekolah" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="bi bi-hash"></i> NPSN *</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-hash input-icon"></i>
                                        <input type="text" class="form-control" id="npsn" maxlength="8" placeholder="8 digit angka" required>
                                    </div>
                                    <small class="text-muted">Nomor Pokok Sekolah Nasional</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="bi bi-telephone"></i> Telepon *</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-telephone input-icon"></i>
                                        <input type="tel" class="form-control" id="schoolPhone" placeholder="Nomor telepon" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-envelope"></i> Email Sekolah *</label>
                            <div class="input-wrapper">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" class="form-control" id="schoolEmail" placeholder="email@sekolah.sch.id" required>
                            </div>
                            <small class="text-muted">Email resmi sekolah untuk verifikasi</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-geo-alt"></i> Alamat *</label>
                            <textarea class="form-control" id="address" rows="2" placeholder="Alamat lengkap sekolah" required></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="bi bi-building"></i> Kota/Kabupaten *</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-building input-icon"></i>
                                        <input type="text" class="form-control" id="city" placeholder="Kota" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="bi bi-globe"></i> Provinsi *</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-globe input-icon"></i>
                                        <input type="text" class="form-control" id="province" placeholder="Provinsi" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="bi bi-mailbox"></i> Kode Pos</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-mailbox input-icon"></i>
                                        <input type="text" class="form-control" id="postalCode" maxlength="5" placeholder="Kode pos">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="bi bi-mortarboard"></i> Jenjang *</label>
                                    <div class="input-wrapper">
                                        <i class="bi bi-mortarboard input-icon"></i>
                                        <select class="form-select" id="schoolLevel" required>
                                            <option value="">Pilih Jenjang</option>
                                            <option value="sd">SD / MI</option>
                                            <option value="smp">SMP / MTs</option>
                                            <option value="sma">SMA / MA</option>
                                            <option value="smk">SMK</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <button type="button" class="btn-primary-custom" id="nextStep1Btn" onclick="nextToStep2()">
                                Selanjutnya <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Verifikasi OTP -->
                    <div id="step2" class="form-step">
                        <div class="text-center mb-3">
                            <i class="bi bi-envelope-paper" style="font-size: 2.5rem; color: var(--primary);"></i>
                            <h5 class="mt-2">Verifikasi Email</h5>
                            <p id="verifyEmailText" class="text-muted small"></p>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label text-center d-block"><i class="bi bi-shield-lock"></i> Kode OTP</label>
                            <div class="otp-input">
                                <input type="text" maxlength="1" class="otp-digit" data-index="0">
                                <input type="text" maxlength="1" class="otp-digit" data-index="1">
                                <input type="text" maxlength="1" class="otp-digit" data-index="2">
                                <input type="text" maxlength="1" class="otp-digit" data-index="3">
                                <input type="text" maxlength="1" class="otp-digit" data-index="4">
                                <input type="text" maxlength="1" class="otp-digit" data-index="5">
                            </div>
                            <input type="hidden" id="otpCode">
                        </div>
                        
                        <div class="timer">
                            <i class="bi bi-hourglass-split"></i>
                            Kirim ulang kode dalam <span id="countdown">05:00</span>
                        </div>
                        
                        <div class="resend-btn">
                            <button type="button" class="btn-link-custom" id="resendBtn" onclick="resendOtp()" disabled>
                                <i class="bi bi-arrow-repeat"></i> Kirim Ulang Kode
                            </button>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle-fill"></i>
                            Kode OTP telah dikirim ke email sekolah. Cek folder Spam jika tidak ditemukan.
                        </div>
                        
                        <div class="button-group">
                            <button type="button" class="btn-outline-custom" onclick="prevToStep1()">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn-primary-custom" id="verifyOtpBtn" onclick="verifyOtp()">
                                Verifikasi <i class="bi bi-check-lg"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Buat Akun Admin -->
                    <div id="step3" class="form-step">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-badge" style="font-size: 2.5rem; color: var(--primary);"></i>
                            <h5 class="mt-2">Akun Admin Sekolah</h5>
                            <p class="text-muted small">Akun ini akan menjadi administrator sekolah</p>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-person-circle"></i> Nama Lengkap *</label>
                            <div class="input-wrapper">
                                <i class="bi bi-person-circle input-icon"></i>
                                <input type="text" class="form-control" id="adminName" placeholder="Nama lengkap admin" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-phone"></i> No. Telepon *</label>
                            <div class="input-wrapper">
                                <i class="bi bi-phone input-icon"></i>
                                <input type="tel" class="form-control" id="adminPhone" placeholder="Nomor telepon aktif" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-lock"></i> Password *</label>
                            <div class="input-wrapper">
                                <i class="bi bi-lock input-icon"></i>
                                <input type="password" class="form-control" id="password" placeholder="Minimal 6 karakter" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-lock-fill"></i> Konfirmasi Password *</label>
                            <div class="input-wrapper">
                                <i class="bi bi-lock-fill input-icon"></i>
                                <input type="password" class="form-control" id="passwordConfirmation" placeholder="Ulangi password" required>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning">
                            <i class="bi bi-info-circle-fill"></i>
                            Setelah registrasi berhasil, akun akan diverifikasi oleh admin pusat (1x24 jam).
                        </div>
                        
                        <div class="button-group">
                            <button type="button" class="btn-outline-custom" onclick="prevToStep2()">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn-primary-custom" id="completeRegBtn" onclick="completeRegistration()">
                                Daftar Sekolah <i class="bi bi-check-lg"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Back to Login -->
                <a href="{{ route('login') }}" class="back-to-login">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>
    
    <script>
        let registrationData = {};
        let countdownInterval;
        
        // Toast notification function
        function showToast(message, type = 'success') {
            let toastContainer = document.querySelector('.toast-notification');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.className = 'toast-notification';
                document.body.appendChild(toastContainer);
            }
            
            const toast = document.createElement('div');
            toast.className = `toast-item ${type}`;
            
            let icon = '';
            if (type === 'success') icon = '<i class="bi bi-check-circle-fill"></i>';
            else if (type === 'error') icon = '<i class="bi bi-exclamation-triangle-fill"></i>';
            else icon = '<i class="bi bi-info-circle-fill"></i>';
            
            toast.innerHTML = `${icon}<span>${message}</span>`;
            toastContainer.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
        
        // Button loading state
        function setButtonLoading(buttonId, isLoading, originalText = null) {
            const btn = document.getElementById(buttonId);
            if (!btn) return;
            
            if (isLoading) {
                btn.dataset.originalText = btn.innerHTML;
                btn.innerHTML = '<span class="simple-spinner"></span> Memproses...';
                btn.classList.add('btn-loading');
                btn.disabled = true;
            } else {
                btn.innerHTML = btn.dataset.originalText || originalText;
                btn.classList.remove('btn-loading');
                btn.disabled = false;
            }
        }
        
        // Success popup for registration
        function showSuccessAndRedirect(message, redirectUrl) {
            setButtonLoading('completeRegBtn', false);
            
            const backdrop = document.createElement('div');
            backdrop.className = 'overlay-backdrop';
            document.body.appendChild(backdrop);
            
            const popup = document.createElement('div');
            popup.className = 'success-popup';
            popup.innerHTML = `
                <i class="bi bi-check-circle-fill"></i>
                <h3>Registrasi Berhasil!</h3>
                <p>${message || 'Akun sekolah Anda telah terdaftar. Silakan login menggunakan email dan password yang telah dibuat.'}</p>
                <button class="btn-ok" onclick="window.location.href='${redirectUrl}'">Masuk ke SIPRES</button>
            `;
            
            document.body.appendChild(popup);
            
            backdrop.onclick = () => {
                window.location.href = redirectUrl;
            };
        }
        
        function updateOtpValue() {
            let otp = '';
            document.querySelectorAll('.otp-digit').forEach(input => {
                otp += input.value;
            });
            document.getElementById('otpCode').value = otp;
        }
        
        // OTP Input Handler
        document.querySelectorAll('.otp-digit').forEach((input, index) => {
            input.addEventListener('keyup', function(e) {
                if (this.value.length === 1 && index < 5) {
                    document.querySelector(`.otp-digit[data-index="${index + 1}"]`).focus();
                }
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    document.querySelector(`.otp-digit[data-index="${index - 1}"]`).focus();
                }
                updateOtpValue();
            });
            
            input.addEventListener('input', function() {
                if (this.value.length > 1) {
                    this.value = this.value.charAt(0);
                }
                updateOtpValue();
            });
        });
        
        function nextToStep2() {
            const schoolData = {
                name: document.getElementById('schoolName').value,
                npsn: document.getElementById('npsn').value,
                phone: document.getElementById('schoolPhone').value,
                email: document.getElementById('schoolEmail').value,
                address: document.getElementById('address').value,
                city: document.getElementById('city').value,
                province: document.getElementById('province').value,
                postal_code: document.getElementById('postalCode').value,
                school_level: document.getElementById('schoolLevel').value
            };
            
            if (!schoolData.name) { showToast('Mohon isi nama sekolah', 'error'); return; }
            if (!schoolData.npsn || schoolData.npsn.length !== 8 || isNaN(schoolData.npsn)) {
                showToast('NPSN harus 8 digit angka', 'error');
                return;
            }
            if (!schoolData.email || !schoolData.email.match(/^[^\s@]+@([^\s@]+\.)+[^\s@]+$/)) {
                showToast('Email tidak valid', 'error');
                return;
            }
            if (!schoolData.address) { showToast('Mohon isi alamat', 'error'); return; }
            if (!schoolData.city) { showToast('Mohon isi kota/kabupaten', 'error'); return; }
            if (!schoolData.province) { showToast('Mohon isi provinsi', 'error'); return; }
            if (!schoolData.school_level) { showToast('Pilih jenjang sekolah', 'error'); return; }
            
            registrationData.school = schoolData;
            document.getElementById('verifyEmailText').innerHTML = `Kode verifikasi telah dikirim ke <strong>${schoolData.email}</strong>`;
            
            // Switch step
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            document.getElementById('step1Indicator').classList.remove('active');
            document.getElementById('step1Indicator').classList.add('completed');
            document.getElementById('step2Indicator').classList.add('active');
            
            sendOtp();
        }
        
        function sendOtp() {
            setButtonLoading('nextStep1Btn', true);
            
            fetch('{{ route("register.school.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(registrationData.school)
            })
            .then(response => response.json())
            .then(data => {
                setButtonLoading('nextStep1Btn', false);
                if (data.success) {
                    startCountdown(300);
                    // HAPUS confirm dialog yang menampilkan OTP!
                    // OTP dikirim ke EMAIL, tidak ditampilkan di sini
                    showToast(`Kode OTP telah dikirim ke email ${registrationData.school.email}. Cek inbox atau folder spam.`, 'success');
                } else {
                    showToast(data.message || 'Gagal mengirim OTP', 'error');
                }
            })
            .catch(error => {
                setButtonLoading('nextStep1Btn', false);
                console.error('Error:', error);
                showToast('Terjadi kesalahan, silakan coba lagi', 'error');
            });
        }
        
        function startCountdown(seconds) {
            const timerElement = document.getElementById('countdown');
            const resendBtn = document.getElementById('resendBtn');
            
            if (countdownInterval) clearInterval(countdownInterval);
            
            let remaining = seconds;
            countdownInterval = setInterval(() => {
                const minutes = Math.floor(remaining / 60);
                const secs = remaining % 60;
                timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                
                if (remaining <= 0) {
                    clearInterval(countdownInterval);
                    resendBtn.disabled = false;
                }
                remaining--;
            }, 1000);
        }
        
        function resendOtp() {
            setButtonLoading('resendBtn', true);
            
            fetch('{{ route("register.school.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(registrationData.school)
            })
            .then(response => response.json())
            .then(data => {
                setButtonLoading('resendBtn', false);
                if (data.success) {
                    startCountdown(300);
                    document.getElementById('resendBtn').disabled = true;
                    showToast(`Kode OTP baru telah dikirim ke email ${registrationData.school.email}`, 'success');
                } else {
                    showToast(data.message || 'Gagal mengirim ulang OTP', 'error');
                }
            })
            .catch(error => {
                setButtonLoading('resendBtn', false);
                console.error('Error:', error);
                showToast('Terjadi kesalahan, silakan coba lagi', 'error');
            });
        }
        
        function verifyOtp() {
            const otp = document.getElementById('otpCode').value;
            if (otp.length !== 6) {
                showToast('Masukkan kode OTP 6 digit', 'error');
                return;
            }
            
            registrationData.otp = otp;
            
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step3').classList.add('active');
            document.getElementById('step2Indicator').classList.remove('active');
            document.getElementById('step2Indicator').classList.add('completed');
            document.getElementById('step3Indicator').classList.add('active');
            
            if (countdownInterval) clearInterval(countdownInterval);
        }
        
        function prevToStep1() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step1').classList.add('active');
            document.getElementById('step2Indicator').classList.remove('active', 'completed');
            document.getElementById('step1Indicator').classList.remove('completed');
            document.getElementById('step1Indicator').classList.add('active');
            if (countdownInterval) clearInterval(countdownInterval);
        }
        
        function prevToStep2() {
            document.getElementById('step3').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            document.getElementById('step3Indicator').classList.remove('active');
            document.getElementById('step2Indicator').classList.add('active');
            document.getElementById('step2Indicator').classList.remove('completed');
        }
        
        function completeRegistration() {
            const adminName = document.getElementById('adminName').value;
            const adminPhone = document.getElementById('adminPhone').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('passwordConfirmation').value;
            
            if (!adminName) { showToast('Mohon isi nama lengkap admin', 'error'); return; }
            if (!adminPhone) { showToast('Mohon isi nomor telepon admin', 'error'); return; }
            if (!password) { showToast('Mohon isi password', 'error'); return; }
            if (password !== passwordConfirmation) { showToast('Password dan konfirmasi password tidak cocok', 'error'); return; }
            if (password.length < 6) { showToast('Password minimal 6 karakter', 'error'); return; }
            
            const finalData = {
                ...registrationData.school,
                admin_name: adminName,
                admin_phone: adminPhone,
                password: password,
                password_confirmation: passwordConfirmation,
                otp: registrationData.otp,
                email: registrationData.school.email
            };
            
            setButtonLoading('completeRegBtn', true);
            
            fetch('{{ route("register.school.verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(finalData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessAndRedirect(
                        'Akun sekolah Anda telah terdaftar. Silakan login menggunakan email dan password yang telah dibuat.',
                        '{{ route("login") }}'
                    );
                } else {
                    setButtonLoading('completeRegBtn', false);
                    showToast(data.message || 'Registrasi gagal, silakan coba lagi', 'error');
                }
            })
            .catch(error => {
                setButtonLoading('completeRegBtn', false);
                console.error('Error:', error);
                showToast('Terjadi kesalahan, silakan coba lagi', 'error');
            });
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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

        body {
            font-family: 'Inter', sans-serif;
            background: #eef2f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
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

        /* Login Container - Full Width */
        .login-container {
            width: 100vw;
            min-height: 100vh;
            background: white;
            display: flex;
        }

        /* Left Side - Hero Section (60%) */
        .hero-section {
            flex: 0 0 60%;
            background: linear-gradient(145deg, var(--gradient-start), var(--gradient-end));
            padding: 60px 80px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
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

        /* Right Side - Login Section (40%) */
        .login-section {
            flex: 0 0 40%;
            padding: 60px 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
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

        /* Login Header */
        .login-header {
            margin-bottom: 35px;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .login-subtitle {
            color: var(--secondary);
            font-size: 0.95rem;
        }

        /* Form */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }

        .form-label i {
            color: var(--primary);
            font-size: 1rem;
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
            font-size: 1.1rem;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 1.5px solid #e5e7eb;
            border-radius: 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #f9fafb;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 1.1rem;
            z-index: 1;
            padding: 0;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        /* Form Extras */
        .form-extras {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .remember-me span {
            color: var(--secondary);
            font-weight: 500;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 25px;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -8px var(--primary);
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #9ca3af;
            margin: 20px 0;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .divider span {
            padding: 0 12px;
            font-weight: 500;
        }

        /* Social Login */
        .social-login {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
        }

        .btn-social {
            flex: 1;
            padding: 12px;
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            background: white;
            color: var(--dark);
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-social:hover {
            border-color: var(--primary);
            background: #f9fafb;
            transform: translateY(-1px);
        }

        .btn-social i {
            font-size: 1.2rem;
        }

        .btn-social .bi-google { color: #DB4437; }
        .btn-social .bi-microsoft { color: #00A4EF; }

        /* Register Section */
        .register-section {
            text-align: center;
            color: var(--secondary);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .register-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            margin-left: 5px;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .register-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .register-link i {
            font-size: 0.9rem;
            transition: transform 0.2s ease;
        }

        .register-link:hover i {
            transform: translateX(3px);
        }

        /* Back to Home */
        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            width: fit-content;
        }

        .back-home:hover {
            color: var(--primary);
            transform: translateX(-3px);
        }

        .back-home i {
            font-size: 1rem;
        }

        /* Alert */
        .alert {
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 25px;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .alert i {
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .hero-section {
                padding: 50px;
            }
            
            .login-section {
                padding: 50px;
            }
            
            .hero-title {
                font-size: 3rem;
            }
        }

        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }
            
            .hero-section,
            .login-section {
                flex: auto;
            }
            
            .hero-section {
                padding: 60px 40px;
            }
            
            .login-section {
                padding: 60px 40px;
            }
        }

        @media (max-width: 640px) {
            .hero-section {
                padding: 40px 20px;
            }
            
            .login-section {
                padding: 40px 20px;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .stats-grid {
                gap: 30px;
            }
            
            .stat-value {
                font-size: 2.2rem;
            }
            
            .social-login {
                flex-direction: column;
            }
            
            .form-extras {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <!-- Platform Badge -->
                <div class="badge-platform">
                    <i class="bi bi-trophy-fill"></i>
                    Platform #1
                </div>
                
                <!-- Hero Title -->
                <h1 class="hero-title">
                    Selamat Datang<br>Kembali!
                </h1>
                
                <!-- Hero Description -->
                <p class="hero-description">
                    Kelola data prestasi siswa dengan mudah di SIPRES.
                </p>
                
                <!-- Stats Cards -->
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
                
                <!-- Testimonial -->
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
        
        <!-- Right Side - Login Section -->
        <div class="login-section">
            <div class="login-content">
                <!-- Brand -->
                <a href="/" class="brand">
                    <div class="brand-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <span class="brand-text">SIPRES</span>
                </a>
                
                <!-- Login Header -->
                <div class="login-header">
                    <h2 class="login-title">Masuk ke Akun</h2>
                    <p class="login-subtitle">
                        Masukkan email dan password Anda
                    </p>
                </div>
                
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-envelope-fill"></i>
                            Email
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" 
                                   class="form-control" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   placeholder="email@sekolah.sch.id"
                                   required 
                                   autofocus>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-lock-fill"></i>
                            Password
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-key input-icon"></i>
                            <input type="password" 
                                   class="form-control" 
                                   name="password" 
                                   id="password"
                                   placeholder="••••••••"
                                   required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Remember Me & Forgot Password -->
                    <div class="form-extras">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>
                        
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa Password?
                        </a>
                    </div>
                    
                    <!-- Login Button -->
                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Masuk ke SIPRES</span>
                    </button>
                    
                    <!-- Divider -->
                    <div class="divider">
                        <span>atau</span>
                    </div>
                    
                    <!-- Social Login -->
                    <div class="social-login">
                        <button type="button" class="btn-social">
                            <i class="bi bi-google"></i>
                            Google
                        </button>
                        <button type="button" class="btn-social">
                            <i class="bi bi-microsoft"></i>
                            Microsoft
                        </button>
                    </div>
                    
                    <!-- Register Section - INI YANG DIPERBAIKI -->
                    <div class="register-section">
                        Belum punya akun sekolah?
                            <a href="{{ route('register.school') }}" class="register-link">
                        Daftar Sekolah <i class="bi bi-arrow-right"></i>
                            </a>
                    </div>
                    
                    <!-- Back to Home -->
                    <a href="{{ route('home') }}" class="back-home">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
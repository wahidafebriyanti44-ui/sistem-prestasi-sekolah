
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Reset Password - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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
            overflow-x: hidden;
            margin: 0;
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

        /* Container - Full width */
        .reset-container {
            width: 100%;
            min-height: 100vh;
            background: white;
            display: flex;
            flex-wrap: wrap;
        }

        /* Left Side - Hero Section */
        .hero-section {
            flex: 1;
            background: linear-gradient(145deg, var(--gradient-start), var(--gradient-end));
            padding: 60px 80px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Right Side - Reset Section */
        .reset-section {
            flex: 1;
            padding: 60px 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
            overflow-y: auto;
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
        }

        .info-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 24px;
            margin-top: auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-card i {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .info-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .info-card p {
            opacity: 0.9;
            line-height: 1.5;
        }

        .reset-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

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

        .reset-header {
            margin-bottom: 35px;
        }

        .reset-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .reset-subtitle {
            color: var(--secondary);
            font-size: 0.95rem;
        }

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
        }

        .form-label i {
            color: var(--primary);
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
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 1.5px solid #e5e7eb;
            border-radius: 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #f9fafb;
            -webkit-appearance: none;
            appearance: none;
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
            padding: 0;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        .password-requirements {
            margin-top: 12px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .requirement:last-child {
            margin-bottom: 0;
        }

        .requirement i {
            font-size: 0.8rem;
        }

        .requirement.valid {
            color: #10b981;
        }

        .requirement.invalid {
            color: #ef4444;
        }

        .btn-reset {
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
            margin-top: 10px;
            font-family: 'Inter', sans-serif;
        }

        .btn-reset:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -8px var(--primary);
        }

        .btn-reset:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            margin-top: 25px;
            width: fit-content;
        }

        .back-link:hover {
            color: var(--primary);
            transform: translateX(-3px);
        }

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

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .alert i {
            font-size: 1.2rem;
        }

        /* ========== RESPONSIVE ========== */
        
        @media (max-width: 992px) {
            .reset-container {
                flex-direction: column;
            }
            
            .hero-section {
                min-height: auto;
                padding: 50px 40px;
            }
            
            .reset-section {
                min-height: auto;
                padding: 50px 40px;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-description {
                margin-bottom: 40px;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 30px;
            }
            
            .reset-section {
                padding: 40px 30px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .badge-platform {
                margin-bottom: 30px;
                padding: 8px 20px;
                font-size: 0.9rem;
            }
            
            .reset-title {
                font-size: 1.8rem;
            }
            
            .brand-text {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 30px 20px;
            }
            
            .reset-section {
                padding: 30px 20px;
            }
            
            .hero-title {
                font-size: 1.6rem;
            }
            
            .reset-title {
                font-size: 1.4rem;
            }
            
            .brand-text {
                font-size: 1.3rem;
            }
            
            .brand-icon {
                width: 38px;
                height: 38px;
            }
            
            .brand-icon i {
                font-size: 1.3rem;
            }
            
            .info-card {
                padding: 16px;
            }
            
            .info-card h3 {
                font-size: 1rem;
            }
            
            .info-card p {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <div class="badge-platform">
                    <i class="bi bi-shield-lock-fill"></i>
                    Keamanan Akun
                </div>
                
                <h1 class="hero-title">
                    Buat Password<br>Baru!
                </h1>
                
                <p class="hero-description">
                    Buat password baru untuk akun guru Anda. Password ini hanya Anda yang tahu, admin sekolah tidak akan bisa melihatnya lagi.
                </p>
                
                <div class="info-card">
                    <i class="bi bi-info-circle-fill"></i>
                    <h3>Password Otomatis</h3>
                    <p>Password default dari sistem (seperti kode captcha) sudah tidak berlaku setelah Anda mengganti password ini. Admin sekolah tetap bisa mereset password Anda jika diperlukan.</p>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Reset Password Section -->
        <div class="reset-section">
            <div class="reset-content">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="brand">
                    <div class="brand-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <span class="brand-text">SIPRES</span>
                </a>
                
                <!-- Header -->
                <div class="reset-header">
                    <h2 class="reset-title">Reset Password</h2>
                    <p class="reset-subtitle">
                        Masukkan password baru untuk akun Anda
                    </p>
                </div>
                
                <!-- Error Alert -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                
                <!-- Reset Form -->
                <form method="POST" action="{{ route('password.store') }}" id="resetForm">
                    @csrf
                    
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                    <!-- Email Field -->
                    <input type="hidden" name="email" value="{{ $request->email }}">
                    
                    <!-- New Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-lock-fill"></i>
                            Password Baru
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-key input-icon"></i>
                            <input type="password" 
                                   class="form-control" 
                                   name="password" 
                                   id="password"
                                   placeholder="Minimal 8 karakter"
                                   required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                                <i class="bi bi-eye-slash" id="toggleIcon1"></i>
                            </button>
                        </div>
                        
                        <div class="password-requirements" id="passwordRequirements">
                            <div class="requirement" id="reqLength">
                                <i class="bi bi-circle"></i>
                                <span>Minimal 8 karakter</span>
                            </div>
                            <div class="requirement" id="reqUpper">
                                <i class="bi bi-circle"></i>
                                <span>Huruf besar (A-Z)</span>
                            </div>
                            <div class="requirement" id="reqNumber">
                                <i class="bi bi-circle"></i>
                                <span>Angka (0-9)</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-check-circle-fill"></i>
                            Konfirmasi Password Baru
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-shield-check input-icon"></i>
                            <input type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   placeholder="Ketik ulang password baru"
                                   required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                <i class="bi bi-eye-slash" id="toggleIcon2"></i>
                            </button>
                        </div>
                        <div class="password-requirements" id="confirmRequirement" style="display: none;">
                            <div class="requirement" id="reqMatch">
                                <i class="bi bi-circle"></i>
                                <span>Password sesuai</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reset Button -->
                    <button type="submit" class="btn-reset" id="submitBtn">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Ganti Password Sekarang</span>
                    </button>
                    
                    <!-- Back to Login -->
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Halaman Login
                    </a>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId, iconId) {
            const password = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            
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
        
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const submitBtn = document.getElementById('submitBtn');
        
        const reqLength = document.getElementById('reqLength');
        const reqUpper = document.getElementById('reqUpper');
        const reqNumber = document.getElementById('reqNumber');
        const confirmReq = document.getElementById('confirmRequirement');
        const reqMatch = document.getElementById('reqMatch');
        
        function validatePassword() {
            const val = password.value;
            let isValid = true;
            
            if (val.length >= 8) {
                reqLength.classList.add('valid');
                reqLength.classList.remove('invalid');
                reqLength.querySelector('i').className = 'bi bi-check-circle-fill';
            } else {
                reqLength.classList.add('invalid');
                reqLength.classList.remove('valid');
                reqLength.querySelector('i').className = 'bi bi-x-circle-fill';
                isValid = false;
            }
            
            if (/[A-Z]/.test(val)) {
                reqUpper.classList.add('valid');
                reqUpper.classList.remove('invalid');
                reqUpper.querySelector('i').className = 'bi bi-check-circle-fill';
            } else {
                reqUpper.classList.add('invalid');
                reqUpper.classList.remove('valid');
                reqUpper.querySelector('i').className = 'bi bi-x-circle-fill';
                isValid = false;
            }
            
            if (/[0-9]/.test(val)) {
                reqNumber.classList.add('valid');
                reqNumber.classList.remove('invalid');
                reqNumber.querySelector('i').className = 'bi bi-check-circle-fill';
            } else {
                reqNumber.classList.add('invalid');
                reqNumber.classList.remove('valid');
                reqNumber.querySelector('i').className = 'bi bi-x-circle-fill';
                isValid = false;
            }
            
            if (val.length > 0) {
                confirmReq.style.display = 'block';
                validateConfirm();
            } else {
                confirmReq.style.display = 'none';
            }
            
            return isValid;
        }
        
        function validateConfirm() {
            if (confirm.value === password.value && password.value.length > 0) {
                reqMatch.classList.add('valid');
                reqMatch.classList.remove('invalid');
                reqMatch.querySelector('i').className = 'bi bi-check-circle-fill';
                return true;
            } else {
                reqMatch.classList.add('invalid');
                reqMatch.classList.remove('valid');
                reqMatch.querySelector('i').className = 'bi bi-x-circle-fill';
                return false;
            }
        }
        
        function validateForm() {
            const isPasswordValid = validatePassword();
            const isConfirmValid = validateConfirm();
            
            submitBtn.disabled = !(isPasswordValid && isConfirmValid && password.value.length > 0);
        }
        
        password.addEventListener('input', validateForm);
        confirm.addEventListener('input', function() {
            validateConfirm();
            validateForm();
        });
        
        validateForm();
        
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

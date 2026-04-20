{{-- resources/views/profile/edit.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profile - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        :root {
            --primary: #667eea;
            --primary-dark: #5a67d8;
            --primary-light: #7f9cf5;
            --secondary: #6b7280;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #1f2937;
            --light: #f9fafb;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin-top: 50px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .card-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .card-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .card-body {
            padding: 40px;
        }

        /* Avatar Section */
        .avatar-section {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .avatar-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .avatar-preview {
            width: 100%;
            height: 100%;
            border-radius: 30px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 45px;
            height: 45px;
            background: var(--primary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            border: 3px solid white;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .avatar-upload-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        #avatarInput {
            display: none;
        }

        .avatar-info {
            margin-top: 15px;
            font-size: 13px;
            color: var(--secondary);
        }

        .avatar-info i {
            color: var(--primary);
        }

        /* Form */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
            font-size: 14px;
        }

        .form-label i {
            color: var(--primary);
            margin-right: 8px;
            width: 18px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-control:disabled {
            background: #f3f4f6;
            cursor: not-allowed;
        }

        .input-hint {
            font-size: 12px;
            color: var(--secondary);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .input-hint i {
            color: var(--warning);
            font-size: 12px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 16px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 14px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: #fee2e2;
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .alert i {
            font-size: 18px;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 10px;
        }

        .strength-bar {
            height: 5px;
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-progress {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-text {
            font-size: 12px;
            color: var(--secondary);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn-primary {
            flex: 1;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            flex: 1;
            padding: 16px;
            background: #f3f4f6;
            color: var(--dark);
            border: none;
            border-radius: 16px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .btn-danger {
            padding: 12px 20px;
            background: #fee2e2;
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .card-body {
                padding: 25px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .avatar-wrapper {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Edit Profile</h1>
                <p>Perbarui informasi profile Anda</p>
            </div>
            
            <div class="card-body">
                <!-- Alert Messages -->
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Form Edit Profile -->
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    
                    <!-- Avatar Upload -->
                    <div class="avatar-section">
                        <div class="avatar-wrapper">
                            <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=667eea&color=fff&size=150' }}" 
                                 alt="Avatar" 
                                 class="avatar-preview"
                                 id="avatarPreview">
                            <label for="avatarInput" class="avatar-upload-btn">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" 
                                   id="avatarInput" 
                                   name="avatar" 
                                   accept="image/*"
                                   onchange="previewAvatar(this)">
                        </div>
                        <div class="avatar-info">
                            <i class="fas fa-info-circle"></i>
                            Format: JPG, PNG. Maks: 2MB
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               name="name" 
                               class="form-control" 
                               value="{{ old('name', Auth::user()->name) }}" 
                               required
                               placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </label>
                        <input type="email" 
                               name="email" 
                               class="form-control" 
                               value="{{ old('email', Auth::user()->email) }}" 
                               required
                               placeholder="Masukkan email Anda">
                    </div>

                    <!-- Role (Read-only) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user-tag"></i>
                            Role
                        </label>
                        <input type="text" 
                               class="form-control" 
                               value="{{ strtoupper(str_replace('_', ' ', Auth::user()->role)) }}" 
                               disabled>
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            Password Baru
                        </label>
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               id="password"
                               placeholder="Kosongkan jika tidak ingin mengubah"
                               onkeyup="checkPasswordStrength()">
                        
                        <!-- Password Strength Indicator -->
                        <div class="password-strength" id="passwordStrength" style="display: none;">
                            <div class="strength-bar">
                                <div class="strength-progress" id="strengthProgress"></div>
                            </div>
                            <div class="strength-text" id="strengthText"></div>
                        </div>
                        
                        <div class="input-hint">
                            <i class="fas fa-info-circle"></i>
                            Minimal 8 karakter
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            Konfirmasi Password
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="form-control" 
                               id="passwordConfirmation"
                               placeholder="Konfirmasi password baru Anda"
                               onkeyup="checkPasswordMatch()">
                        <div class="input-hint" id="passwordMatchHint" style="color: var(--danger); display: none;">
                            <i class="fas fa-times-circle"></i>
                            Password tidak cocok
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ url()->previous() }}" class="btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <!-- Delete Account Section (Optional) -->
                @if(Auth::user()->role != 'super_admin')
                <hr style="margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;">
                
                <div style="text-align: center;">
                    <h4 style="color: var(--danger); margin-bottom: 10px;">Zona Berbahaya</h4>
                    <p style="color: var(--secondary); font-size: 14px; margin-bottom: 15px;">
                        Setelah menghapus akun, semua data akan hilang permanen.
                    </p>
                    <form method="POST" action="{{ route('profile.destroy') }}" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            <i class="fas fa-trash-alt"></i>
                            Hapus Akun
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Preview avatar sebelum upload
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Cek kekuatan password
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthDiv = document.getElementById('passwordStrength');
            const progress = document.getElementById('strengthProgress');
            const text = document.getElementById('strengthText');
            
            if (password.length > 0) {
                strengthDiv.style.display = 'block';
                
                // Hitung kekuatan
                let strength = 0;
                
                // Panjang
                if (password.length >= 8) strength += 25;
                if (password.length >= 12) strength += 25;
                
                // Kombinasi karakter
                if (/[a-z]/.test(password)) strength += 15;
                if (/[A-Z]/.test(password)) strength += 15;
                if (/[0-9]/.test(password)) strength += 10;
                if (/[^a-zA-Z0-9]/.test(password)) strength += 10;
                
                // Batasi maksimal 100
                strength = Math.min(strength, 100);
                
                // Update progress bar
                progress.style.width = strength + '%';
                
                // Update warna dan teks
                if (strength < 40) {
                    progress.style.background = '#ef4444';
                    text.innerHTML = 'Lemah';
                    text.style.color = '#ef4444';
                } else if (strength < 70) {
                    progress.style.background = '#f59e0b';
                    text.innerHTML = 'Sedang';
                    text.style.color = '#f59e0b';
                } else {
                    progress.style.background = '#10b981';
                    text.innerHTML = 'Kuat';
                    text.style.color = '#10b981';
                }
            } else {
                strengthDiv.style.display = 'none';
            }
            
            checkPasswordMatch();
        }

        // Cek kecocokan password
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('passwordConfirmation').value;
            const hint = document.getElementById('passwordMatchHint');
            const submitBtn = document.getElementById('submitBtn');
            
            if (confirmation.length > 0) {
                if (password !== confirmation) {
                    hint.style.display = 'flex';
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                } else {
                    hint.style.display = 'none';
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                }
            } else {
                hint.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
            }
        }

        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Validasi form sebelum submit
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('passwordConfirmation').value;
            
            if (password !== confirmation) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
            }
        });
    </script>
</body>
</html>
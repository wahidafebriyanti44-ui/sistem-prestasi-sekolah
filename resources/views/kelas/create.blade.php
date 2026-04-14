<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Kelas - SIPRES | Sistem Informasi Prestasi Siswa</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f5fa; min-height: 100vh; }
        :root {
            --primary: #2A5C8A; --primary-dark: #1E4A73; --primary-light: #4A7BA9;
            --primary-soft: #E8F0FE; --secondary: #5F6B7A; --success: #28A745;
            --danger: #DC3545; --warning: #FFC107; --dark: #2D3E50;
            --gray-soft: #F8FAFC; --sidebar-width: 260px;
        }
        .container { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #FFFFFF 0%, #F5F9FF 100%);
            border-right: 1px solid rgba(42, 92, 138, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.03);
            padding-bottom: 20px;
        }
        .sidebar-header { padding: 15px 15px 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 8px; }
        .brand-icon { width: 35px; height: 35px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(42, 92, 138, 0.2); }
        .brand-icon i { font-size: 18px; color: white; }
        .brand-text { font-size: 18px; font-weight: 800; color: var(--primary); }
        .brand-sub { font-size: 9px; color: var(--secondary); }
        
        .sidebar-profile { padding: 5px 15px 10px; border-bottom: 1px solid rgba(42, 92, 138, 0.08); margin-bottom: 5px; }
        .profile-card { background: var(--gray-soft); border-radius: 12px; padding: 10px; border: 1px solid rgba(42, 92, 138, 0.08); }
        .profile-avatar-wrapper { position: relative; width: 45px; height: 45px; margin-bottom: 8px; cursor: pointer; }
        .profile-avatar { width: 100%; height: 100%; border-radius: 12px; object-fit: cover; border: 2px solid white; }
        .avatar-upload { position: absolute; bottom: -2px; right: -2px; width: 20px; height: 20px; background: var(--primary); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; border: 2px solid white; font-size: 10px; }
        .profile-name { font-size: 13px; font-weight: 700; color: var(--dark); margin-bottom: 3px; }
        .profile-role { display: inline-flex; align-items: center; gap: 4px; background: rgba(42, 92, 138, 0.1); padding: 3px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; color: var(--primary); }
        .profile-email { font-size: 10px; color: var(--secondary); margin-top: 6px; display: flex; align-items: center; gap: 4px; background: white; padding: 5px 8px; border-radius: 8px; }
        .profile-email i { color: var(--primary); }
        
        .menu-title { padding: 10px 15px 3px; font-size: 9px; font-weight: 700; text-transform: uppercase; color: var(--secondary); letter-spacing: 0.5px; }
        .sidebar-menu { list-style: none; padding: 0 10px; }
        .sidebar-menu li { margin-bottom: 2px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 8px; padding: 8px 10px; color: var(--secondary); text-decoration: none; border-radius: 10px; font-weight: 500; font-size: 12px; }
        .sidebar-menu a i { width: 18px; font-size: 14px; }
        .sidebar-menu a:hover { background: var(--primary-soft); color: var(--primary); }
        .sidebar-menu a.active { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; box-shadow: 0 4px 8px rgba(42, 92, 138, 0.25); }
        .sidebar-menu a.active i { color: white; }
        
        .sidebar-footer { position: sticky; bottom: 0; padding: 10px 15px; background: white; border-top: 1px solid rgba(42, 92, 138, 0.08); margin-top: 10px; }
        .logout-btn { display: flex; align-items: center; gap: 8px; padding: 8px 10px; background: #FFF1F0; color: var(--danger); border: none; border-radius: 10px; font-weight: 600; font-size: 12px; cursor: pointer; width: 100%; }
        .logout-btn:hover { background: var(--danger); color: white; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: var(--sidebar-width); padding: 20px; transition: margin-left 0.3s ease; }
        .top-nav { background: white; padding: 15px 20px; border-radius: 16px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(42, 92, 138, 0.08); }
        .page-title h1 { font-size: 20px; font-weight: 700; color: var(--dark); margin-bottom: 3px; }
        .page-title p { color: var(--secondary); font-size: 12px; display: flex; align-items: center; gap: 5px; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .notification { position: relative; width: 38px; height: 38px; background: #F5F8FA; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .badge-count { position: absolute; top: -5px; right: -5px; background: var(--danger); color: white; font-size: 9px; padding: 2px 5px; border-radius: 20px; border: 2px solid white; font-weight: 700; }
        .user-dropdown { display: flex; align-items: center; gap: 8px; background: #F5F8FA; padding: 5px 5px 5px 12px; border-radius: 30px; cursor: pointer; }
        .user-avatar { width: 32px; height: 32px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px; }
        .user-avatar img { width: 100%; height: 100%; border-radius: 8px; object-fit: cover; }
        
        /* Card & Form */
        .card { background: white; border-radius: 16px; border: 1px solid rgba(42, 92, 138, 0.08); overflow: hidden; }
        .card-header { padding: 20px; border-bottom: 1px solid rgba(42, 92, 138, 0.08); }
        .card-header h2 { font-size: 18px; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 8px; }
        .card-header h2 i { color: var(--primary); }
        .card-body { padding: 20px; }
        
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; color: var(--dark); font-weight: 600; font-size: 13px; }
        .form-label i { color: var(--primary); margin-right: 6px; }
        .form-control, .form-select { width: 100%; padding: 12px 16px; border: 2px solid #E5E9F0; border-radius: 12px; font-size: 14px; font-family: 'Inter', sans-serif; }
        .form-control:focus, .form-select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(42, 92, 138, 0.1); }
        .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .form-text { font-size: 12px; color: var(--secondary); margin-top: 4px; }
        .required { color: var(--danger); margin-left: 2px; }
        .is-invalid { border-color: var(--danger) !important; }
        .invalid-feedback { color: var(--danger); font-size: 12px; margin-top: 4px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; font-family: 'Inter', sans-serif; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; box-shadow: 0 4px 8px rgba(42, 92, 138, 0.25); }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-2px); }
        .btn-secondary { background: #F1F4F9; color: var(--dark); border: 1px solid rgba(42, 92, 138, 0.1); }
        .btn-secondary:hover { background: #E5E9F0; }
        .form-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(42, 92, 138, 0.08); }
        
        .alert { padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 500; font-size: 13px; border-left: 4px solid; }
        .alert-danger { background: #FFE9E9; color: var(--danger); border-left-color: var(--danger); }
        .alert-success { background: #E3F2E9; color: #065F46; border-left-color: var(--success); }
        
        .mobile-menu-btn { display: none; position: fixed; top: 15px; left: 15px; z-index: 1001; width: 40px; height: 40px; background: var(--primary); border: none; border-radius: 10px; color: white; font-size: 18px; cursor: pointer; }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); position: fixed; width: 240px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-menu-btn { display: block; }
            .top-nav { flex-direction: column; align-items: flex-start; padding-top: 60px; }
            .user-info { width: 100%; justify-content: space-between; }
            .form-actions { flex-direction: column-reverse; }
            .btn { width: 100%; justify-content: center; }
            .form-row { grid-template-columns: 1fr; }
        }
        
        .profile-modal { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(5px); }
        .profile-modal.active { display: flex; }
        .modal-content { background: white; border-radius: 20px; max-width: 450px; width: 90%; max-height: 90vh; overflow-y: auto; }
        .modal-header { padding: 20px; border-bottom: 1px solid rgba(42, 92, 138, 0.08); }
        .modal-header h3 { font-size: 20px; font-weight: 700; color: var(--dark); }
        .modal-body { padding: 20px; }
        .modal-footer { padding: 15px 20px; border-top: 1px solid rgba(42, 92, 138, 0.08); display: flex; gap: 12px; justify-content: flex-end; }
        .btn-save { padding: 10px 20px; background: var(--primary); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .btn-cancel { padding: 10px 20px; background: #F1F4F9; color: var(--dark); border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .current-avatar { margin-top: 8px; display: flex; align-items: center; gap: 8px; padding: 8px; background: var(--gray-soft); border-radius: 10px; }
        .current-avatar img { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="brand-wrapper">
                    <div class="brand-icon"><i class="fas fa-medal"></i></div>
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
                        <div class="avatar-upload"><i class="fas fa-camera"></i></div>
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
                    <div class="profile-email"><i class="far fa-envelope"></i> {{ Auth::user()->email ?? 'user@sipres.com' }}</div>
                </div>
            </div>
            
            @php
                $currentRoute = request()->route()->getName();
                $user = Auth::user();
            @endphp

            <div class="menu-title">MENU UTAMA</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}" class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
            </ul>

            <div class="menu-title">DATA MASTER</div>
            <ul class="sidebar-menu">
                @if($user->role == 'admin_sekolah')
                <li><a href="{{ route('school.profile') }}" class="{{ $currentRoute == 'school.profile' ? 'active' : '' }}"><i class="fas fa-building"></i> Profil Sekolah</a></li>
                @endif
                <li><a href="{{ route('kelas.index') }}" class="active"><i class="fas fa-school"></i> Kelas</a></li>
                <li><a href="{{ route('siswa.index') }}"><i class="fas fa-users"></i> Siswa</a></li>
                @if(in_array($user->role, ['super_admin', 'admin_sekolah']))
                <li><a href="{{ route('teachers.index') }}"><i class="fas fa-chalkboard-teacher"></i> Guru</a></li>
                @endif
                <li><a href="{{ route('prestasi.index') }}"><i class="fas fa-trophy"></i> Prestasi</a></li>
                <li><a href="{{ route('eskul.index') }}"><i class="fas fa-futbol"></i> Ekstrakurikuler</a></li>
                <li><a href="{{ route('minat-bakat.index') }}"><i class="fas fa-heart"></i> Minat & Bakat</a></li>
            </ul>

            @if($user->role == 'super_admin')
            <div class="menu-title">SUPER ADMIN</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('schools.index') }}"><i class="fas fa-building"></i> Kelola Sekolah</a></li>
                <li><a href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> Kelola User</a></li>
            </ul>
            @endif

            <div class="sidebar-footer">
                <button onclick="confirmLogout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar dari SIPRES</button>
            </div>
        </div>

        <!-- MAIN CONTENT - FORM TAMBAH KELAS -->
        <div class="main-content" id="mainContent">
            <div class="top-nav">
                <div class="page-title">
                    <h1>Tambah Kelas Baru</h1>
                    <p><i class="fas fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="user-info">
                    <div class="notification"><i class="far fa-bell"></i><span class="badge-count">3</span></div>
                    <div class="user-dropdown" onclick="openProfileModal()">
                        <div class="user-avatar">
                            @if(Auth::user() && Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar_url }}">
                            @else
                                {{ substr(Auth::user()->name ?? 'AD', 0, 1) }}
                            @endif
                        </div>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span><i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Terdapat kesalahan pada input data. Silakan periksa kembali.</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-plus-circle"></i> Form Tambah Kelas</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_kelas" class="form-label"><i class="fas fa-school"></i> Nama Kelas <span class="required">*</span></label>
                                <input type="text" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="Contoh: X IPA 1, XII RPL 2" required>
                                @error('nama_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label for="tingkat" class="form-label"><i class="fas fa-layer-group"></i> Tingkat <span class="required">*</span></label>
                                <select id="tingkat" name="tingkat" class="form-select @error('tingkat') is-invalid @enderror" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="10" {{ old('tingkat') == '10' ? 'selected' : '' }}>Kelas 10 (X)</option>
                                    <option value="11" {{ old('tingkat') == '11' ? 'selected' : '' }}>Kelas 11 (XI)</option>
                                    <option value="12" {{ old('tingkat') == '12' ? 'selected' : '' }}>Kelas 12 (XII)</option>
                                </select>
                                @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label for="wali_kelas_id" class="form-label"><i class="fas fa-user-tie"></i> Wali Kelas</label>
                                <select id="wali_kelas_id" name="wali_kelas_id" class="form-select @error('wali_kelas_id') is-invalid @enderror">
                                    <option value="">Pilih Wali Kelas</option>
                                    @foreach($guruList as $g)
                                        <option value="{{ $g->id }}" {{ old('wali_kelas_id') == $g->id ? 'selected' : '' }}>
                                            {{ $g->name }} 
                                        </option>
                                    @endforeach
                                </select>
                                @error('wali_kelas_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="form-text">Kosongkan jika belum ditentukan</div>
                            </div>
                        </div>

                        <div class="form-text" style="margin-top: 10px;"><span class="required">*</span> Wajib diisi</div>

                        <div class="form-actions">
                            <a href="{{ route('kelas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data Kelas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Modal -->
    <div class="profile-modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header"><h3><i class="fas fa-user-edit"></i> Edit Profile</h3></div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-camera"></i> Foto Profile</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <small style="color: var(--secondary); display: block; margin-top: 5px;">Format: JPG, PNG. Maks: 2MB</small>
                        @if(Auth::user() && Auth::user()->avatar)
                        <div class="current-avatar"><img src="{{ Auth::user()->avatar_url }}"><span>Avatar saat ini</span></div>
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

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>

    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function openProfileModal() { document.getElementById('profileModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
        function closeProfileModal() { document.getElementById('profileModal').classList.remove('active'); document.body.style.overflow = ''; }
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) { document.getElementById('profileImage').src = e.target.result; };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function confirmLogout() { if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) document.getElementById('logout-form').submit(); }
        window.addEventListener('click', function(e) { const modal = document.getElementById('profileModal'); if (e.target === modal) closeProfileModal(); });
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar'), mobileBtn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768 && sidebar.classList.contains('active') && !sidebar.contains(event.target) && !mobileBtn.contains(event.target)) sidebar.classList.remove('active');
        });
        setTimeout(() => { document.querySelectorAll('.alert').forEach(alert => { alert.style.transition = 'opacity 0.5s ease'; alert.style.opacity = '0'; setTimeout(() => alert.remove(), 500); }); }, 5000);
    </script>
</body>
</html>
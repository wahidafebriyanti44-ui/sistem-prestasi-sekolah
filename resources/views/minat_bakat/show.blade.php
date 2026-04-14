<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Minat & Bakat - SIPRES</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f5f7fb;
            min-height: 100vh;
        }
        
        :root {
            --primary: #2A5C8A;
            --primary-dark: #1E4A73;
            --primary-light: #4A7BA9;
            --primary-soft: #e8f0fe;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --dark: #2d3748;
            --gray: #f8f9fa;
            --border: #e2e8f0;
            --sidebar-width: 260px;
        }
        
        .app { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid var(--border);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        .sidebar-header { padding: 20px; border-bottom: 1px solid var(--border); }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-icon i { color: white; font-size: 20px; }
        .brand-text { font-size: 20px; font-weight: 800; color: var(--primary); }
        
        .sidebar-profile { padding: 15px; border-bottom: 1px solid var(--border); }
        .profile-card { background: var(--gray); border-radius: 12px; padding: 12px; }
        .profile-avatar { width: 48px; height: 48px; border-radius: 12px; object-fit: cover; margin-bottom: 10px; }
        .profile-name { font-size: 14px; font-weight: 700; color: var(--dark); }
        .profile-role {
            display: inline-block; background: var(--primary-soft); color: var(--primary);
            padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 600;
            margin: 8px 0;
        }
        .profile-email { font-size: 11px; color: var(--secondary); display: flex; align-items: center; gap: 6px; }
        
        .menu-title { padding: 15px 20px 5px; font-size: 10px; font-weight: 700; text-transform: uppercase; color: var(--secondary); }
        .sidebar-menu { list-style: none; padding: 0 12px; }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 10px; padding: 10px 12px;
            color: var(--secondary); text-decoration: none; border-radius: 10px;
            font-size: 13px; font-weight: 500; transition: all 0.2s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: var(--primary-soft); color: var(--primary); }
        .sidebar-menu a i { width: 20px; }
        
        .sidebar-footer { padding: 15px; border-top: 1px solid var(--border); margin-top: 20px; }
        .logout-btn {
            width: 100%; padding: 10px; background: #fee2e2; color: var(--danger);
            border: none; border-radius: 10px; font-weight: 600; font-size: 13px;
            display: flex; align-items: center; gap: 8px; justify-content: center;
            cursor: pointer; transition: all 0.2s;
        }
        .logout-btn:hover { background: var(--danger); color: white; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: var(--sidebar-width); padding: 20px; }
        
        /* Top Nav */
        .top-nav {
            background: white; padding: 15px 20px; border-radius: 16px;
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 24px; border: 1px solid var(--border);
        }
        .page-title h1 { font-size: 20px; font-weight: 700; color: var(--dark); }
        .page-title p { font-size: 12px; color: var(--secondary); margin-top: 4px; }
        
        .user-dropdown {
            display: flex; align-items: center; gap: 10px;
            background: var(--gray); padding: 6px 12px 6px 6px;
            border-radius: 40px; cursor: pointer;
        }
        .user-avatar {
            width: 36px; height: 36px; background: var(--primary); border-radius: 10px;
            display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;
        }
        
        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 10px; font-size: 13px;
            font-weight: 600; text-decoration: none; border: none;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .btn-warning { background: var(--warning); color: var(--dark); }
        .btn-warning:hover { background: #e0a800; transform: translateY(-2px); }
        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { background: #c82333; transform: translateY(-2px); }
        .btn-secondary { background: var(--gray); color: var(--dark); border: 1px solid var(--border); }
        .btn-secondary:hover { background: #e9ecef; }
        .btn-sm { padding: 6px 14px; font-size: 12px; }
        
        /* Action Bar */
        .action-bar {
            display: flex; flex-wrap: wrap; justify-content: space-between;
            align-items: center; gap: 15px; margin-bottom: 24px;
        }
        .action-group { display: flex; gap: 10px; flex-wrap: wrap; }
        
        /* Cards */
        .card {
            background: white; border-radius: 16px; border: 1px solid var(--border);
            overflow: hidden; margin-bottom: 24px;
        }
        .card-header {
            padding: 16px 20px; border-bottom: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;
        }
        .card-header h2, .card-header h3 {
            font-size: 16px; font-weight: 700; color: var(--dark);
            display: flex; align-items: center; gap: 8px;
        }
        .card-header i { color: var(--primary); }
        .card-body { padding: 20px; }
        
        /* Detail Grid */
        .detail-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; }
        
        /* Info Grid */
        .info-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
        .info-item { margin-bottom: 0; padding-bottom: 16px; border-bottom: 1px solid var(--border); }
        .info-item:last-child { border-bottom: none; padding-bottom: 0; }
        .info-label { font-size: 12px; color: var(--secondary); margin-bottom: 6px; font-weight: 500; letter-spacing: 0.5px; text-transform: uppercase; }
        .info-value { font-size: 15px; color: var(--dark); font-weight: 600; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        
        /* Badge Kategori */
        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 30px; font-size: 12px; font-weight: 600;
        }
        .badge-olahraga { background: #d4edda; color: #155724; }
        .badge-seni { background: #f3e5f5; color: #6f42c1; }
        .badge-sains { background: var(--primary-soft); color: var(--primary); }
        .badge-bahasa { background: #fff3cd; color: #856404; }
        .badge-teknologi { background: #cfe2ff; color: #0a58ca; }
        .badge-lainnya { background: #e9ecef; color: #495057; }
        
        /* Stat Number */
        .stat-number {
            font-size: 32px; font-weight: 800; color: var(--primary); line-height: 1;
        }
        .stat-label {
            font-size: 12px; color: var(--secondary); margin-left: 8px;
        }
        
        /* Siswa List */
        .siswa-list { display: flex; flex-direction: column; gap: 12px; }
        .siswa-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 16px; background: var(--gray); border-radius: 12px;
            flex-wrap: wrap; gap: 10px; transition: all 0.2s;
        }
        .siswa-item:hover { background: #e9ecef; }
        .siswa-info { display: flex; align-items: center; gap: 12px; }
        .siswa-avatar {
            width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 18px; overflow: hidden;
        }
        .siswa-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .siswa-name h4 { font-size: 15px; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .siswa-name p { font-size: 12px; color: var(--secondary); }
        .siswa-link {
            padding: 8px 16px; background: white; color: var(--primary);
            border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 600;
            border: 1px solid var(--border); transition: all 0.2s;
        }
        .siswa-link:hover { background: var(--primary); color: white; border-color: var(--primary); }
        
        /* Empty State */
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 64px; color: #cbd5e0; margin-bottom: 16px; }
        .empty-state p { color: var(--secondary); margin-bottom: 20px; font-size: 14px; }
        
        /* Modal */
        .modal {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.5); align-items: center; justify-content: center;
            z-index: 2000; backdrop-filter: blur(4px);
        }
        .modal.active { display: flex; }
        .modal-content {
            background: white; border-radius: 20px; width: 90%; max-width: 450px;
            max-height: 85vh; overflow-y: auto;
        }
        .modal-header { padding: 20px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
        .modal-header h3 { font-size: 18px; font-weight: 700; color: var(--dark); }
        .modal-body { padding: 20px; }
        .modal-footer { padding: 16px 20px; border-top: 1px solid var(--border); display: flex; gap: 12px; justify-content: flex-end; }
        .modal-close { background: none; border: none; font-size: 20px; cursor: pointer; color: var(--secondary); }
        
        /* Form */
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-weight: 600; font-size: 12px; margin-bottom: 6px; color: var(--dark); }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 10px 14px; border: 1px solid var(--border);
            border-radius: 10px; font-size: 14px; font-family: inherit;
        }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--primary); }
        
        /* Alert */
        .alert {
            padding: 12px 16px; border-radius: 12px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px; font-size: 13px;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid var(--success); }
        .alert-danger { background: #f8d7da; color: #721c24; border-left: 4px solid var(--danger); }
        
        /* Mobile Menu */
        .mobile-menu-btn {
            display: none; position: fixed; top: 15px; left: 15px;
            z-index: 1001; width: 42px; height: 42px;
            background: var(--primary); border: none; border-radius: 12px;
            color: white; font-size: 18px; cursor: pointer;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .detail-grid { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); position: fixed; width: 260px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-menu-btn { display: block; }
            .top-nav { flex-direction: column; align-items: flex-start; gap: 12px; padding-top: 60px; }
            .action-bar { flex-direction: column; }
            .action-group { width: 100%; }
            .action-group .btn { flex: 1; justify-content: center; }
            .siswa-item { flex-direction: column; align-items: flex-start; }
            .siswa-link { width: 100%; text-align: center; }
        }
        
        @media (max-width: 480px) {
            .main-content { padding: 12px; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .siswa-info { flex-direction: column; text-align: center; }
            .siswa-avatar { margin: 0 auto; }
        }
    </style>
</head>
<body>
    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="brand">
                    <div class="brand-icon"><i class="fas fa-medal"></i></div>
                    <span class="brand-text">SIPRES</span>
                </a>
            </div>
            
            <div class="sidebar-profile">
                <div class="profile-card">
                    <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'User').'&background=2A5C8A&color=fff' }}" class="profile-avatar">
                    <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
                    <div class="profile-role">
                        @if(Auth::user()->role == 'super_admin') SUPER ADMIN
                        @elseif(Auth::user()->role == 'admin_sekolah') ADMIN SEKOLAH
                        @else GURU @endif
                    </div>
                    <div class="profile-email"><i class="far fa-envelope"></i> {{ Auth::user()->email ?? '-' }}</div>
                </div>
            </div>
            
            @php $user = Auth::user(); $currentRoute = request()->route()->getName(); @endphp
            
            <div class="menu-title">MENU UTAMA</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}" class="{{ $currentRoute == 'dashboard' ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
            </ul>
            
            <div class="menu-title">DATA MASTER</div>
            <ul class="sidebar-menu">
                @if($user->role == 'admin_sekolah')
                <li><a href="{{ route('school.profile') }}"><i class="fas fa-building"></i> Profil Sekolah</a></li>
                @endif
                <li><a href="{{ route('kelas.index') }}"><i class="fas fa-school"></i> Kelas</a></li>
                <li><a href="{{ route('siswa.index') }}"><i class="fas fa-users"></i> Siswa</a></li>
                @if(in_array($user->role, ['super_admin', 'admin_sekolah']))
                <li><a href="{{ route('teachers.index') }}"><i class="fas fa-chalkboard-teacher"></i> Guru</a></li>
                @endif
                <li><a href="{{ route('prestasi.index') }}"><i class="fas fa-trophy"></i> Prestasi</a></li>
                <li><a href="{{ route('eskul.index') }}"><i class="fas fa-futbol"></i> Ekstrakurikuler</a></li>
                <li><a href="{{ route('minat-bakat.index') }}" class="active"><i class="fas fa-heart"></i> Minat & Bakat</a></li>
            </ul>
            
            @if($user->role == 'super_admin')
            <div class="menu-title">SUPER ADMIN</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('schools.index') }}"><i class="fas fa-building"></i> Kelola Sekolah</a></li>
                <li><a href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> Kelola User</a></li>
            </ul>
            @endif
            
            <div class="sidebar-footer">
                <button onclick="confirmLogout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Nav -->
            <div class="top-nav">
                <div class="page-title">
                    <h1>Detail Minat & Bakat</h1>
                    <p><i class="fas fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="user-dropdown" onclick="openProfileModal()">
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            
            <!-- Alerts -->
            @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            
            <!-- Action Bar -->
            <div class="action-bar">
                <div class="action-group">
                    <a href="{{ route('minat-bakat.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="action-group">
                    @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                        <a href="{{ route('minat-bakat.edit', $minatBakat) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('minat-bakat.destroy', $minatBakat) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus minat & bakat ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
            
            <!-- Detail Grid -->
            <div class="detail-grid">
                <!-- Left Column - Minat Bakat Info -->
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white;">
                        <h3 style="color: white;"><i class="fas fa-heart"></i> Informasi Minat & Bakat</h3>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Kategori</div>
                                <div class="info-value">
                                    @php
                                        $kategoriBadge = match($minatBakat->kategori) {
                                            'olahraga' => 'badge-olahraga',
                                            'seni' => 'badge-seni',
                                            'sains' => 'badge-sains',
                                            'bahasa' => 'badge-bahasa',
                                            'teknologi' => 'badge-teknologi',
                                            default => 'badge-lainnya'
                                        };
                                        $kategoriIcon = match($minatBakat->kategori) {
                                            'olahraga' => 'fa-futbol',
                                            'seni' => 'fa-palette',
                                            'sains' => 'fa-flask',
                                            'bahasa' => 'fa-language',
                                            'teknologi' => 'fa-laptop-code',
                                            default => 'fa-heart'
                                        };
                                    @endphp
                                    <span class="badge {{ $kategoriBadge }}">
                                        <i class="fas {{ $kategoriIcon }}"></i> {{ ucfirst(str_replace('_', ' ', $minatBakat->kategori)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Nama Minat & Bakat</div>
                                <div class="info-value"><i class="fas fa-heart"></i> {{ $minatBakat->nama_minat }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Siswa</div>
                                <div class="info-value">
                                    <span class="stat-number">{{ $minatBakat->siswa_count ?? $minatBakat->siswa->count() ?? 0 }}</span>
                                    <span class="stat-label">Siswa</span>
                                </div>
                            </div>
                            @if($minatBakat->deskripsi)
                            <div class="info-item">
                                <div class="info-label">Deskripsi</div>
                                <div class="info-value" style="font-weight: normal; line-height: 1.6;">{{ $minatBakat->deskripsi }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Daftar Siswa -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-users"></i> Daftar Siswa 
                            <span style="font-size: 12px; background: var(--gray); padding: 2px 8px; border-radius: 20px; margin-left: 8px;">
                                {{ $minatBakat->siswa_count ?? $minatBakat->siswa->count() ?? 0 }}
                            </span>
                        </h3>
                        @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                        <button onclick="openAddSiswaModal()" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Siswa</button>
                        @endif
                    </div>
                    <div class="card-body">
                        @php $siswaList = $minatBakat->siswa; @endphp
                        
                        @if($siswaList && $siswaList->count() > 0)
                            <div class="siswa-list">
                                @foreach($siswaList as $siswa)
                                <div class="siswa-item">
                                    <div class="siswa-info">
                                        <div class="siswa-avatar">
                                            @if($siswa->foto)
                                                <img src="{{ asset('uploads/foto-siswa/' . $siswa->foto) }}" alt="{{ $siswa->nama_lengkap }}">
                                            @else
                                                {{ substr($siswa->nama_lengkap, 0, 1) }}
                                            @endif
                                        </div>
                                        <div class="siswa-name">
                                            <h4>{{ $siswa->nama_lengkap }}</h4>
                                            <p><i class="fas fa-id-card"></i> NIS: {{ $siswa->nis }} | <i class="fas fa-school"></i> Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('siswa.show', $siswa) }}" class="siswa-link">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users-slash"></i>
                                <p>Belum ada siswa yang memiliki minat & bakat ini</p>
                                @if(in_array(Auth::user()->role, ['super_admin', 'admin_sekolah']))
                                <button onclick="openAddSiswaModal()" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Siswa Sekarang
                                </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Profile -->
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-edit"></i> Edit Profile</h3>
                <button class="modal-close" onclick="closeProfileModal()"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto Profile</label>
                        <input type="file" name="avatar" accept="image/*" onchange="previewImage(this)">
                        <small style="color: var(--secondary); display: block; margin-top: 5px;">Format: JPG, PNG. Maks: 2MB</small>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeProfileModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modal Tambah Siswa -->
    <div class="modal" id="addSiswaModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-plus"></i> Tambah Siswa</h3>
                <button class="modal-close" onclick="closeAddSiswaModal()"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('minat-bakat.addSiswa', $minatBakat) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Siswa</label>
                        <select name="siswa_id" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswaAvailable as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama_lengkap }} (NIS: {{ $siswa->nis }}) - {{ $siswa->kelas->nama_kelas ?? '-' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeAddSiswaModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Siswa</button>
                </div>
            </form>
        </div>
    </div>
    
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
    
    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        
        function openProfileModal() { document.getElementById('profileModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
        function closeProfileModal() { document.getElementById('profileModal').classList.remove('active'); document.body.style.overflow = ''; }
        
        function openAddSiswaModal() { document.getElementById('addSiswaModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
        function closeAddSiswaModal() { document.getElementById('addSiswaModal').classList.remove('active'); document.body.style.overflow = ''; }
        
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
            if (confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) {
                document.getElementById('logout-form').submit();
            }
        }
        
        // Close modal on outside click
        window.addEventListener('click', function(e) {
            const modals = ['profileModal', 'addSiswaModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (e.target === modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768 && sidebar.classList.contains('active') && 
                !sidebar.contains(event.target) && !mobileBtn.contains(event.target)) {
                sidebar.classList.remove('active');
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
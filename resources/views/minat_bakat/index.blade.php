<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Minat & Bakat - SIPRES</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f5fa; }
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

        .container { display: flex; }
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #fff 0%, #F5F9FF 100%);
            border-right: 1px solid rgba(42,92,138,.1);
            position: fixed; height: 100vh; overflow-y: auto; z-index: 1000;
        }
        .sidebar-header { padding: 15px 15px 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 8px; }
        .brand-icon {
            width: 35px; height: 35px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
        }
        .brand-icon i { font-size: 18px; color: #fff; }
        .brand-text { font-size: 18px; font-weight: 800; color: var(--primary); }
        .brand-sub { font-size: 9px; color: var(--secondary); }

        .sidebar-profile { padding: 5px 15px 10px; border-bottom: 1px solid rgba(42,92,138,.08); }
        .profile-card { background: var(--gray-soft); border-radius: 12px; padding: 10px; }
        .profile-avatar-wrapper { position: relative; width: 45px; height: 45px; margin-bottom: 8px; cursor: pointer; }
        .profile-avatar { width: 100%; height: 100%; border-radius: 12px; object-fit: cover; border: 2px solid #fff; }
        .avatar-upload {
            position: absolute; bottom: -2px; right: -2px; width: 20px; height: 20px;
            background: var(--primary); border-radius: 6px; display: flex;
            align-items: center; justify-content: center; color: #fff; cursor: pointer;
        }
        .profile-name { font-size: 13px; font-weight: 700; color: var(--dark); }
        .profile-role {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(42,92,138,.1); padding: 3px 8px; border-radius: 20px;
            font-size: 10px; font-weight: 600; color: var(--primary);
        }
        .profile-email {
            font-size: 10px; color: var(--secondary); margin-top: 6px;
            display: flex; align-items: center; gap: 4px; background: #fff; padding: 5px 8px; border-radius: 8px;
        }
        .menu-title { padding: 10px 15px 3px; font-size: 9px; font-weight: 700; text-transform: uppercase; color: var(--secondary); }
        .sidebar-menu { list-style: none; padding: 0 10px; }
        .sidebar-menu li { margin-bottom: 2px; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 8px; padding: 8px 10px;
            color: var(--secondary); text-decoration: none; border-radius: 10px;
            font-weight: 500; font-size: 12px;
        }
        .sidebar-menu a i { width: 18px; font-size: 14px; }
        .sidebar-menu a:hover { background: var(--primary-soft); color: var(--primary); }
        .sidebar-menu a.active { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: #fff; }
        .sidebar-footer { padding: 10px 15px; background: #fff; border-top: 1px solid rgba(42,92,138,.08); margin-top: 10px; }
        .logout-btn {
            display: flex; align-items: center; gap: 8px; padding: 8px 10px;
            background: #FFF1F0; color: var(--danger); border: none; border-radius: 10px;
            font-weight: 600; font-size: 12px; cursor: pointer; width: 100%;
        }
        .logout-btn:hover { background: var(--danger); color: #fff; }

        .main-content { flex: 1; margin-left: var(--sidebar-width); padding: 20px; }
        .top-nav {
            background: #fff; padding: 15px 20px; border-radius: 16px; margin-bottom: 20px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .page-title h1 { font-size: 20px; font-weight: 700; color: var(--dark); }
        .page-title p { color: var(--secondary); font-size: 12px; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-dropdown {
            display: flex; align-items: center; gap: 8px; background: #F5F8FA;
            padding: 5px 5px 5px 12px; border-radius: 30px; cursor: pointer;
        }
        .user-avatar {
            width: 32px; height: 32px; background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700;
        }

        .info-banner {
            background: linear-gradient(135deg, #E8F0FE, #D4E4F5);
            border-radius: 12px; padding: 12px 20px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 12px; border-left: 4px solid var(--primary);
        }
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn {
            display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px;
            border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600;
        }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: #fff; }

        .filter-section { background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 25px; }
        .filter-form { display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end; }
        .filter-group { flex: 1; min-width: 200px; }
        .filter-label { display: block; margin-bottom: 6px; color: var(--secondary); font-size: 12px; font-weight: 600; }
        .search-input, .filter-select {
            width: 100%; padding: 10px 12px; border: 2px solid #E5E9F0; border-radius: 10px;
            font-size: 13px; font-family: 'Inter', sans-serif; background: #fff;
        }
        .filter-actions { display: flex; gap: 10px; }
        .btn-filter {
            background: var(--gray-soft); padding: 10px 20px; border: 1px solid rgba(42,92,138,.1);
            border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px; text-decoration: none; color: var(--dark);
        }

        .card { background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid rgba(42,92,138,.08); }
        .card-header { padding: 16px 20px; border-bottom: 1px solid rgba(42,92,138,.08); }
        .card-header h2 { font-size: 16px; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 8px; }
        .card-body { padding: 0; }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px 16px; background: var(--gray-soft); color: var(--secondary); font-weight: 600; font-size: 12px; }
        td { padding: 14px 16px; border-bottom: 1px solid rgba(42,92,138,.05); color: var(--dark); font-size: 13px; vertical-align: middle; }
        tr:hover { background: var(--gray-soft); }

        .badge {
            display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .badge-olahraga { background: #E3F2FD; color: #1565C0; }
        .badge-seni { background: #FCE4EC; color: #C2185B; }
        .badge-sains { background: #E8F5E9; color: #2E7D32; }
        .badge-bahasa { background: #FFF3E0; color: #E65100; }
        .badge-teknologi { background: #E0F7FA; color: #00838F; }
        .badge-lainnya { background: #F3E5F5; color: #7B1FA2; }

        .student-count { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: var(--primary-soft); color: var(--primary); border-radius: 20px; font-size: 12px; font-weight: 600; }
        .action-buttons { display: flex; gap: 8px; }
        .btn-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; text-decoration: none; }
        .btn-view { background: var(--primary); }
        .btn-edit { background: var(--warning); color: #212529; }
        .btn-delete { background: var(--danger); }

        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 48px; color: #ddd; margin-bottom: 12px; display: block; }

        .school-header {
            display: flex; justify-content: space-between; align-items: center;
            margin: 30px 0 15px 0; padding: 15px 20px; background: white;
            border-radius: 16px; border: 1px solid rgba(42,92,138,.08);
        }
        .school-title { display: flex; align-items: center; gap: 12px; }
        .school-title h3 { font-size: 18px; font-weight: 700; color: var(--dark); }
        .school-badge { background: var(--primary-soft); color: var(--primary); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }

        .pag-wrap { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-top: 1px solid rgba(42,92,138,.08); flex-wrap: wrap; gap: 12px; }
        .pag-info { font-size: 12px; color: var(--secondary); background: var(--gray-soft); padding: 6px 14px; border-radius: 30px; }
        .pag-controls { display: flex; gap: 5px; flex-wrap: wrap; }
        .pag-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 5px;
            min-width: 36px; height: 36px; padding: 0 11px; border-radius: 10px;
            background: #fff; border: 1.5px solid #E2E8F0; color: var(--secondary);
            font-size: 13px; font-weight: 600; text-decoration: none;
        }
        .pag-btn.active { background: var(--primary); border-color: var(--primary); color: #fff; }
        .pag-btn.disabled { opacity: 0.5; cursor: not-allowed; }

        .profile-modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 2000; align-items: center; justify-content: center; }
        .modal-content { background: #fff; border-radius: 20px; padding: 30px; width: 90%; max-width: 480px; }
        .form-control { width: 100%; padding: 10px 14px; border: 2px solid #E5E9F0; border-radius: 10px; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .btn-save { padding: 10px 20px; background: var(--primary); color: #fff; border: none; border-radius: 10px; cursor: pointer; }
        .btn-cancel { padding: 10px 20px; background: #F1F4F9; border: none; border-radius: 10px; cursor: pointer; }

        .mobile-menu-btn { display: none; position: fixed; top: 15px; left: 15px; z-index: 1100; width: 40px; height: 40px; background: var(--primary); color: #fff; border: none; border-radius: 10px; cursor: pointer; }

        @media (max-width: 768px) {
            .mobile-menu-btn { display: block; }
            .sidebar { transform: translateX(-100%); width: 240px; }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .top-nav { flex-direction: column; align-items: flex-start; padding-top: 60px; }
            .filter-form { flex-direction: column; }
            .action-bar { flex-direction: column; align-items: stretch; }
            .btn { text-align: center; justify-content: center; }
            .school-header { flex-direction: column; align-items: flex-start; gap: 10px; }
            .pag-wrap { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>

<button class="mobile-menu-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

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
                    <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'User').'&background=2A5C8A&color=fff&size=100' }}" class="profile-avatar" id="profileImage">
                    <div class="avatar-upload"><i class="fas fa-camera"></i></div>
                </div>
                <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
                <div class="profile-role">
                    @if(Auth::user()->role == 'super_admin') <i class="fas fa-crown"></i> SUPER ADMIN
                    @elseif(Auth::user()->role == 'admin_sekolah') <i class="fas fa-school"></i> ADMIN SEKOLAH
                    @else <i class="fas fa-chalkboard-teacher"></i> GURU @endif
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
            <li><a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}"><i class="fas fa-school"></i> Kelas</a></li>
            <li><a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}"><i class="fas fa-users"></i> Siswa</a></li>
            @if(in_array($user->role, ['super_admin', 'admin_sekolah']))
            <li><a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Guru</a></li>
            @endif
            <li><a href="{{ route('prestasi.index') }}" class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}"><i class="fas fa-trophy"></i> Prestasi</a></li>
            <li><a href="{{ route('eskul.index') }}" class="{{ request()->routeIs('eskul.*') ? 'active' : '' }}"><i class="fas fa-futbol"></i> Ekstrakurikuler</a></li>
            <li><a href="{{ route('minat-bakat.index') }}" class="{{ request()->routeIs('minat-bakat.*') ? 'active' : '' }}"><i class="fas fa-heart"></i> Minat & Bakat</a></li>
        </ul>

        @if($user->role == 'super_admin')
        <div class="menu-title">SUPER ADMIN</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('schools.index') }}" class="{{ request()->routeIs('schools.*') ? 'active' : '' }}"><i class="fas fa-building"></i> Kelola Sekolah</a></li>
            <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola User</a></li>
        </ul>
        @endif

        <div class="sidebar-footer">
            <button onclick="confirmLogout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar dari SIPRES</button>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content" id="mainContent">

        <div class="top-nav">
            <div class="page-title">
                <h1>Data Minat &amp; Bakat</h1>
                <p><i class="fas fa-calendar-alt"></i> {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="user-info">
                <div class="user-dropdown" onclick="openProfileModal()">
                    <div class="user-avatar">
                        @if(Auth::user()?->avatar) <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                        @else {{ substr(Auth::user()->name ?? 'U', 0, 1) }} @endif
                    </div>
                    <span>{{ Auth::user()->name ?? 'User' }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success" style="background:#D4EDDA;color:#155724;padding:12px 16px;border-radius:12px;margin-bottom:20px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger" style="background:#F8D7DA;color:#721C24;padding:12px 16px;border-radius:12px;margin-bottom:20px;"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        @if(Auth::user()->role == 'super_admin')
        <div class="info-banner">
            <i class="fas fa-info-circle"></i>
            <p>Mode Super Admin - Anda dapat melihat semua minat &amp; bakat dari seluruh sekolah, namun <strong>tidak dapat menambah, mengedit, atau menghapus</strong> data.</p>
        </div>
        @endif

        <div class="action-bar">
            <h2><i class="fas fa-heart"></i> Daftar Minat &amp; Bakat</h2>
            <!-- PERUBAHAN: HANYA ADMIN SEKOLAH YANG BISA TAMBAH -->
            @if(Auth::user()->role == 'admin_sekolah')
            <a href="{{ route('minat-bakat.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Minat</a>
            @endif
        </div>

        <div class="filter-section">
            <form method="GET" action="{{ route('minat-bakat.index') }}" class="filter-form">
                @if(Auth::user()->role == 'super_admin')
                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-building"></i> Filter Sekolah</label>
                    <select name="school_id" class="filter-select">
                        <option value="">Semua Sekolah</option>
                        @foreach($schools ?? [] as $school)
                        <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-search"></i> Pencarian</label>
                    <input type="text" name="search" class="search-input" placeholder="Cari minat / bakat..." value="{{ request('search') }}">
                </div>

                <div class="filter-group">
                    <label class="filter-label"><i class="fas fa-tag"></i> Kategori</label>
                    <select name="kategori" class="filter-select">
                        <option value="">Semua Kategori</option>
                        <option value="olahraga" {{ request('kategori') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="seni" {{ request('kategori') == 'seni' ? 'selected' : '' }}>Seni</option>
                        <option value="sains" {{ request('kategori') == 'sains' ? 'selected' : '' }}>Sains</option>
                        <option value="bahasa" {{ request('kategori') == 'bahasa' ? 'selected' : '' }}>Bahasa</option>
                        <option value="teknologi" {{ request('kategori') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                        <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter"><i class="fas fa-filter"></i> Filter</button>
                    <a href="{{ route('minat-bakat.index') }}" class="btn-filter"><i class="fas fa-undo"></i> Reset</a>
                </div>
            </form>
        </div>

        <!-- TAMPILAN UNTUK SUPER ADMIN -->
        @if(Auth::user()->role == 'super_admin')
            @php
                $groupedMinat = $minatBakat->groupBy('school_id');
            @endphp

            @forelse($groupedMinat as $schoolId => $minatSekolah)
                @php
                    $school = $schools->firstWhere('id', $schoolId);
                @endphp
                
                <div class="school-header">
                    <div class="school-title">
                        <i class="fas fa-building" style="font-size:24px;color:var(--primary);"></i>
                        <h3>{{ $school->name ?? 'Sekolah Tidak Dikenal' }}</h3>
                    </div>
                    <span class="school-badge"><i class="fas fa-heart"></i> Total: {{ $minatSekolah->count() }} Minat & Bakat</span>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th width="40">No</th>
                                        <th>Nama Minat / Bakat</th>
                                        <th>Kategori</th>
                                        <th>Total Siswa</th>
                                        <th style="text-align:center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($minatSekolah as $index => $m)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <span style="font-weight:600">{{ $m->nama_minat }}</span>
                                            @if($m->deskripsi)
                                                <div style="font-size: 11px; color: var(--secondary); margin-top: 4px;">{{ Str::limit($m->deskripsi, 50) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = 'badge-lainnya';
                                                if($m->kategori == 'olahraga') $badgeClass = 'badge-olahraga';
                                                elseif($m->kategori == 'seni') $badgeClass = 'badge-seni';
                                                elseif($m->kategori == 'sains') $badgeClass = 'badge-sains';
                                                elseif($m->kategori == 'bahasa') $badgeClass = 'badge-bahasa';
                                                elseif($m->kategori == 'teknologi') $badgeClass = 'badge-teknologi';
                                            @endphp
                                            <span class="badge {{ $badgeClass }}"><i class="fas fa-tag"></i> {{ ucfirst($m->kategori ?? 'Lainnya') }}</span>
                                        </td>
                                        <td><span class="student-count"><i class="fas fa-users"></i> {{ $m->siswa_count ?? 0 }} Siswa</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('minat-bakat.show', $m->id) }}" class="btn-icon btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
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
                <div class="card">
                    <div class="empty-state">
                        <i class="fas fa-heart"></i>
                        <p>Belum ada data minat &amp; bakat</p>
                    </div>
                </div>
            @endforelse

            <!-- Pagination untuk Super Admin -->
            @if($minatBakat->total() > 0 && $minatBakat->hasPages())
            <div class="pag-wrap">
                <div class="pag-info">Menampilkan {{ $minatBakat->firstItem() }} - {{ $minatBakat->lastItem() }} dari {{ $minatBakat->total() }} data</div>
                <div class="pag-controls">
                    @if($minatBakat->onFirstPage()) <span class="pag-btn disabled"><i class="fas fa-chevron-left"></i> Prev</span>
                    @else <a href="{{ $minatBakat->previousPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-left"></i> Prev</a> @endif

                    @php
                        $cur = $minatBakat->currentPage();
                        $last = $minatBakat->lastPage();
                        $start = max(1, $cur - 2);
                        $end = min($last, $cur + 2);
                        if ($start > 1) echo '<a href="'.$minatBakat->url(1).'" class="pag-btn">1</a> ... ';
                        for ($i = $start; $i <= $end; $i++) {
                            if ($i == $cur) echo '<span class="pag-btn active">'.$i.'</span>';
                            else echo '<a href="'.$minatBakat->url($i).'" class="pag-btn">'.$i.'</a>';
                        }
                        if ($end < $last) echo ' ... <a href="'.$minatBakat->url($last).'" class="pag-btn">'.$last.'</a>';
                    @endphp

                    @if($minatBakat->hasMorePages()) <a href="{{ $minatBakat->nextPageUrl() }}" class="pag-btn">Next <i class="fas fa-chevron-right"></i></a>
                    @else <span class="pag-btn disabled">Next <i class="fas fa-chevron-right"></i></span> @endif
                </div>
            </div>
            @endif

        @else
            <!-- TAMPILAN UNTUK ADMIN SEKOLAH & GURU -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th width="40">No</th>
                                    <th>Nama Minat / Bakat</th>
                                    <th>Kategori</th>
                                    <th>Total Siswa</th>
                                    <th style="text-align:center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($minatBakat as $index => $m)
                                <tr>
                                    <td class="text-center">{{ $minatBakat->firstItem() + $index }}</td>
                                    <td>
                                        <span style="font-weight:600">{{ $m->nama_minat }}</span>
                                        @if($m->deskripsi)<div style="font-size: 11px; color: var(--secondary); margin-top: 4px;">{{ Str::limit($m->deskripsi, 50) }}</div>@endif
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = 'badge-lainnya';
                                            if($m->kategori == 'olahraga') $badgeClass = 'badge-olahraga';
                                            elseif($m->kategori == 'seni') $badgeClass = 'badge-seni';
                                            elseif($m->kategori == 'sains') $badgeClass = 'badge-sains';
                                            elseif($m->kategori == 'bahasa') $badgeClass = 'badge-bahasa';
                                            elseif($m->kategori == 'teknologi') $badgeClass = 'badge-teknologi';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}"><i class="fas fa-tag"></i> {{ ucfirst($m->kategori ?? 'Lainnya') }}</span>
                                    </td>
                                    <td><span class="student-count"><i class="fas fa-users"></i> {{ $m->siswa_count ?? 0 }} Siswa</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- SEMUA ROLE BISA LIHAT DETAIL -->
                                            <a href="{{ route('minat-bakat.show', $m->id) }}" class="btn-icon btn-view" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                            
                                            <!-- PERUBAHAN: HANYA ADMIN SEKOLAH YANG BISA EDIT & HAPUS -->
                                            @if(Auth::user()->role == 'admin_sekolah')
                                            <a href="{{ route('minat-bakat.edit', $m->id) }}" class="btn-icon btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('minat-bakat.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin hapus minat ini?')" style="display:inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5"><div class="empty-state"><i class="fas fa-heart"></i><p>Belum ada data minat &amp; bakat</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($minatBakat->total() > 0 && $minatBakat->hasPages())
                    <div class="pag-wrap">
                        <div class="pag-info">Menampilkan {{ $minatBakat->firstItem() }} - {{ $minatBakat->lastItem() }} dari {{ $minatBakat->total() }} data</div>
                        <div class="pag-controls">{{ $minatBakat->links() }}</div>
                    </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>

<!-- Profile Modal -->
<div class="profile-modal" id="profileModal">
    <div class="modal-content">
        <h3>Edit Profil</h3>
        <p>Perbarui informasi profil Anda</p>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Foto Profil</label><input type="file" name="avatar" class="form-control" onchange="previewImage(this)"></div>
            <div class="form-group"><label>Nama Lengkap</label><input type="text" name="name" class="form-control" value="{{ Auth::user()->name ?? '' }}" required></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required></div>
            <div class="form-group"><label>Password Baru</label><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah"></div>
            <div class="form-group"><label>Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control"></div>
            <div class="modal-actions"><button type="button" class="btn-cancel" onclick="closeProfileModal()">Batal</button><button type="submit" class="btn-save">Simpan</button></div>
        </form>
    </div>
</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">@csrf</form>

<script>
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
    function openProfileModal() { document.getElementById('profileModal').style.display = 'flex'; }
    function closeProfileModal() { document.getElementById('profileModal').style.display = 'none'; }
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('profileImage').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }
    function confirmLogout() { if(confirm('Apakah Anda yakin ingin keluar dari SIPRES?')) document.getElementById('logout-form').submit(); }
    window.addEventListener('click', e => { const modal = document.getElementById('profileModal'); if (e.target === modal) closeProfileModal(); });
    document.addEventListener('click', e => {
        if (window.innerWidth > 768) return;
        const sidebar = document.getElementById('sidebar');
        const btn = document.querySelector('.mobile-menu-btn');
        if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && !btn.contains(e.target)) sidebar.classList.remove('active');
    });
</script>
</body>
</html>
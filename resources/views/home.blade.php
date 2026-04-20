<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIPRES - Sistem Informasi Prestasi Siswa Indonesia</title>
    <!-- Bootstrap 5 CSS + Icons + Google Fonts + AOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            overflow-x: hidden;
            background-color: #ffffff;
        }
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --primary-soft: #eef2ff;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --soft-gray: #f1f5f9;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            padding: 1rem 0;
            transition: all 0.25s ease;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .navbar.scrolled {
            padding: 0.6rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary), #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-brand i {
            font-size: 2rem;
            background: linear-gradient(135deg, var(--primary), #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .nav-link {
            font-weight: 500;
            color: var(--dark);
            margin: 0 0.7rem;
            text-decoration: none;
            position: relative;
            padding: 0.5rem 0;
            transition: color 0.2s;
        }
        .nav-link:hover { color: var(--primary); }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary), #7209b7);
            transition: width 0.25s;
        }
        .nav-link:hover::after { width: 100%; }
        .btn-login {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.5rem 1.8rem;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
            margin-left: 0.5rem;
            display: inline-block;
        }
        .btn-login:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(67, 97, 238, 0.25);
        }
        .navbar-toggler {
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            display: none;
        }
        .hero-section {
            padding: 150px 0 100px;
            background: linear-gradient(125deg, #fff 0%, var(--primary-soft) 100%);
            position: relative;
            overflow: hidden;
        }
        .badge-soft {
            background: rgba(67, 97, 238, 0.12);
            color: var(--primary);
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }
        .hero-title {
            font-size: 3.6rem;
            font-weight: 800;
            line-height: 1.2;
            margin: 1.5rem 0;
        }
        .gradient-text {
            background: linear-gradient(135deg, var(--primary), #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-description {
            font-size: 1.15rem;
            color: var(--secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            padding: 0.9rem 2.3rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.25s;
            box-shadow: 0 10px 22px rgba(67, 97, 238, 0.2);
        }
        .btn-primary-custom:hover { transform: translateY(-3px); box-shadow: 0 18px 30px rgba(67, 97, 238, 0.3); color: white; }
        .btn-outline-custom {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.9rem 2.3rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.25s;
        }
        .btn-outline-custom:hover { background: var(--primary); color: white; transform: translateY(-3px); }
        .stats-section { padding: 80px 0; background: white; }
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 28px;
            text-align: center;
            box-shadow: 0 12px 28px rgba(0,0,0,0.04);
            transition: all 0.3s;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 24px 48px rgba(67,97,238,0.12); border-color: var(--primary-light); }
        .stat-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--primary-soft);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2.5rem;
            transition: 0.3s;
        }
        .stat-card:hover .stat-icon { background: linear-gradient(135deg, var(--primary), #7209b7); color: white; transform: scale(1.05); }
        .stat-number { font-size: 3rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem; }
        .achievement-section { padding: 80px 0; background: var(--soft-gray); }
        .section-title { font-size: 2.6rem; font-weight: 800; margin-bottom: 1rem; }
        .section-subtitle { font-size: 1.1rem; color: var(--secondary); max-width: 700px; margin: 0 auto 2.5rem; }
        .achievement-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0,0,0,0.05);
            transition: all 0.3s;
            height: 100%;
        }
        .achievement-card:hover { transform: translateY(-10px); box-shadow: 0 30px 48px rgba(67,97,238,0.2); }
        .achievement-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(135deg, var(--primary), #7209b7);
        }
        .achievement-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }
        .achievement-card:hover .achievement-img { transform: scale(1.08); }
        .student-photo-badge {
            position: absolute;
            bottom: -22px;
            right: 20px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 4px solid white;
            background: white;
            overflow: hidden;
            box-shadow: 0 6px 14px rgba(0,0,0,0.15);
            transition: 0.2s;
        }
        .avatar-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), #7209b7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 1.3rem;
        }
        .achievement-content { padding: 1.8rem 1.5rem 1.5rem; margin-top: 8px; }
        .achievement-title { font-weight: 800; margin-bottom: 0.75rem; color: var(--dark); font-size: 1.1rem; }
        .achievement-student { font-size: 0.85rem; color: var(--secondary); margin-bottom: 0.25rem; }
        .achievement-school { font-size: 0.8rem; color: var(--secondary); margin-bottom: 0.5rem; }
        .achievement-location { font-size: 0.7rem; color: #4361ee; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 4px; }
        .achievement-rank {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 1rem;
            background: var(--primary-soft);
            color: var(--primary);
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.75rem;
        }
        .rank-gold { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; }
        .rank-silver { background: linear-gradient(135deg, #94a3b8, #64748b); color: white; }
        .rank-bronze { background: linear-gradient(135deg, #d97706, #b45309); color: white; }
        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding: 0.4rem 1.2rem;
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.8rem;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-detail:hover { background: var(--primary); color: white; transform: translateX(5px); }
        .feature-section { padding: 80px 0; background: white; }
        .feature-card {
            background: white;
            padding: 2.2rem 1.5rem;
            border-radius: 28px;
            text-align: center;
            box-shadow: 0 12px 28px rgba(0,0,0,0.04);
            transition: all 0.3s;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .feature-card:hover { transform: translateY(-8px); border-color: var(--primary-light); box-shadow: 0 24px 40px rgba(67,97,238,0.12); }
        .feature-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 1.5rem;
            background: var(--primary-soft);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2.8rem;
            transition: 0.4s;
        }
        .feature-card:hover .feature-icon { background: linear-gradient(135deg, var(--primary), #7209b7); color: white; border-radius: 50%; transform: rotate(8deg); }
        .how-it-works { padding: 80px 0; background: var(--soft-gray); }
        .step-card {
            background: white;
            padding: 2rem;
            border-radius: 28px;
            text-align: center;
            transition: 0.3s;
        }
        .step-card:hover { transform: translateY(-6px); box-shadow: 0 20px 32px rgba(0,0,0,0.08); }
        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), #7209b7);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.8rem;
            margin: 0 auto 1.2rem;
        }
        .testimonial-section { padding: 80px 0; background: white; }
        .testimonial-card {
            background: white;
            padding: 2rem;
            border-radius: 28px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.04);
            transition: 0.2s;
            height: 100%;
        }
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.2rem;
            padding-left: 1rem;
            border-left: 3px solid var(--primary-light);
        }
        .rating i { color: var(--warning); margin-right: 2px; }
        .cta-section {
            background: linear-gradient(135deg, var(--primary), #7209b7);
            padding: 80px 0;
        }
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }
        .footer-brand { 
            font-size: 2rem; 
            font-weight: 800; 
            background: linear-gradient(135deg, #4361ee, #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 0.5rem; 
            margin-bottom: 1.2rem; 
        }
        .footer-brand i {
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
            color: #4361ee;
        }
        .footer-links a, .footer-contact li span, .footer-contact li a { color: rgba(255,255,255,0.7); text-decoration: none; transition: 0.2s; }
        .footer-links a:hover { color: white; padding-left: 5px; }
        .social-links a {
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: 0.2s;
        }
        .social-links a:hover { background: var(--primary); transform: translateY(-3px); }
        .modal-custom {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.85);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .modal-custom.active { display: flex; }
        .modal-content-custom { max-width: 90%; max-height: 90%; background: transparent; }
        .modal-content-custom img { width: 100%; height: auto; max-height: 85vh; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        @media (max-width: 991px) {
            .navbar-toggler { display: block; }
            .nav-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0; right: 0;
                background: white;
                padding: 1.2rem;
                box-shadow: 0 20px 30px rgba(0,0,0,0.1);
                border-radius: 0 0 20px 20px;
            }
            .nav-menu.active { display: flex; }
            .nav-link { margin: 0.5rem 0; }
            .hero-title { font-size: 2.4rem; }
            .section-title { font-size: 2rem; }
        }
        @media (max-width: 576px) {
            .hero-title { font-size: 2rem; }
            .stat-number { font-size: 2rem; }
            .student-photo-badge { width: 55px; height: 55px; bottom: -18px; right: 15px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand"><i class="bi bi-trophy-fill"></i> SIPRES</a>
        <button class="navbar-toggler d-lg-none" type="button" onclick="toggleMenu()"><i class="bi bi-list"></i></button>
        <div class="nav-menu" id="navMenu">
            <a href="#home" class="nav-link">Beranda</a>
            <a href="#prestasi" class="nav-link">Data Prestasi</a>
            <a href="{{ route('publik.prestasi.semua') }}" class="nav-link">Semua Prestasi</a>
            <a href="#tentang" class="nav-link">Tentang</a>
            <a href="#kontak" class="nav-link">Kontak</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-login"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a>
            @endauth
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge-soft"><i class="bi bi-trophy-fill me-2"></i>Platform Prestasi Siswa #1 di Indonesia</span>
                <h1 class="hero-title">Catat, Kelola, dan<br><span class="gradient-text">Publikasikan Prestasi</span><br>Siswa dengan Mudah</h1>
                <p class="hero-description">SIPRES membantu sekolah mendokumentasikan setiap pencapaian siswa, dari tingkat sekolah hingga internasional. Transparan, terverifikasi, dan terintegrasi.</p>
                <div class="d-flex gap-3 flex-wrap mb-4">
                    <a href="{{ route('publik.prestasi.semua') }}" class="btn-primary-custom"><i class="bi bi-search me-2"></i>Lihat Prestasi</a>
                    <a href="{{ route('register.school') }}" class="btn-outline-custom"><i class="bi bi-building-add me-2"></i>Daftarkan Sekolah</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image-wrapper position-relative text-center">
                    <div class="bg-gradient rounded-4 p-5 text-center" style="background: linear-gradient(135deg, #eef2ff, #e0e7ff); border-radius: 2rem;">
                        <i class="bi bi-trophy-fill" style="font-size: 8rem; color: #4361ee;"></i>
                        <h3 class="mt-3 fw-bold">✨ SIPRES ✨</h3>
                        <p class="text-secondary">Platform Prestasi Siswa Terpercaya</p>
                    </div>
                    <div class="floating-card card-1 position-absolute bg-white rounded-4 shadow p-2 px-3 d-flex align-items-center gap-2" style="top: 5%; left: -5%;">
                        <i class="bi bi-trophy-fill text-warning"></i><span class="fw-bold">+{{ number_format($totalPrestasi ?? 1450) }} Prestasi</span>
                    </div>
                    <div class="floating-card card-2 position-absolute bg-white rounded-4 shadow p-2 px-3 d-flex align-items-center gap-2" style="bottom: 10%; right: -5%;">
                        <i class="bi bi-building text-primary"></i><span class="fw-bold">{{ number_format($totalSekolah ?? 210) }} Sekolah</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-building"></i></div>
                    <div class="stat-number" data-target="{{ $totalSekolah ?? 218 }}">{{ number_format($totalSekolah ?? 218) }}</div>
                    <div class="stat-label">Sekolah Terdaftar</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <div class="stat-number" data-target="{{ $totalSiswa ?? 3850 }}">{{ number_format($totalSiswa ?? 3850) }}</div>
                    <div class="stat-label">Siswa Berprestasi</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-trophy"></i></div>
                    <div class="stat-number" data-target="{{ $totalPrestasi ?? 5120 }}">{{ number_format($totalPrestasi ?? 5120) }}</div>
                    <div class="stat-label">Total Prestasi</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRESTASI TERBARU -->
<section id="prestasi" class="achievement-section">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">Prestasi Terbaru</h2>
            <p class="section-subtitle">Lihat pencapaian terbaru dari siswa-siswi berprestasi di berbagai sekolah</p>
        </div>
        <div class="row g-4" id="prestasiContainer">
            @forelse($prestasiTerbaru ?? [] as $prestasi)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="achievement-card">
                    <div class="achievement-img-wrapper">
                        @if($prestasi->file_sertifikat && file_exists(public_path('uploads/sertifikat/' . $prestasi->file_sertifikat)))
                            @if(in_array(pathinfo($prestasi->file_sertifikat, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                                <img src="{{ asset('uploads/sertifikat/' . $prestasi->file_sertifikat) }}" class="achievement-img" alt="{{ $prestasi->nama_lomba }}">
                            @else
                                <div class="achievement-img d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #4361ee, #7209b7);">
                                    <i class="bi bi-file-earmark-pdf-fill" style="font-size: 3.5rem; color: white;"></i>
                                </div>
                            @endif
                        @else
                            <div class="achievement-img d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #4361ee, #7209b7);">
                                <i class="bi bi-trophy-fill" style="font-size: 3.5rem; color: white;"></i>
                            </div>
                        @endif
                        <div class="student-photo-badge">
                            @if($prestasi->siswa && $prestasi->siswa->foto)
                                <img src="{{ asset('uploads/foto-siswa/' . $prestasi->siswa->foto) }}" alt="Foto Siswa" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="avatar-placeholder">{{ strtoupper(substr($prestasi->siswa->nama_lengkap ?? 'S', 0, 2)) }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="achievement-content">
                        <h5 class="achievement-title">{{ Str::limit($prestasi->nama_lomba ?? 'Prestasi', 55) }}</h5>
                        <div class="achievement-student"><i class="bi bi-person-circle"></i> {{ $prestasi->siswa->nama_lengkap ?? 'Siswa' }}</div>
                        <div class="achievement-school"><i class="bi bi-building"></i> {{ $prestasi->siswa->school->name ?? $prestasi->siswa->sekolah->name ?? 'Sekolah' }}</div>
                        
                        <!-- TAMPILAN WILAYAH (INDOREGION) -->
                        @if($prestasi->provinsi)
                        <div class="achievement-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>{{ $prestasi->provinsi->nama }}</span>
                            @if($prestasi->kabupaten)
                                <span>, {{ $prestasi->kabupaten->nama }}</span>
                            @endif
                        </div>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="achievement-rank 
                                {{ $prestasi->peringkat == 'Emas' || $prestasi->peringkat == 'Gold' ? 'rank-gold' : '' }}
                                {{ $prestasi->peringkat == 'Perak' || $prestasi->peringkat == 'Silver' ? 'rank-silver' : '' }}
                                {{ $prestasi->peringkat == 'Perunggu' || $prestasi->peringkat == 'Bronze' ? 'rank-bronze' : '' }}">
                                <i class="bi bi-trophy-fill me-1"></i>{{ $prestasi->peringkat ?? 'Juara' }}
                            </span>
                            <small class="text-muted">{{ $prestasi->tahun ?? date('Y') }}</small>
                        </div>
                        <a href="{{ route('publik.prestasi.detail', $prestasi->id) }}" class="btn-detail">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox display-1 text-secondary"></i>
                <p class="mt-3 text-secondary">Belum ada prestasi yang ditampilkan</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('publik.prestasi.semua') }}" class="btn-outline-custom">Lihat Semua Prestasi <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="feature-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Mengapa Memilih SIPRES?</h2>
            <p class="section-subtitle">Platform terpercaya yang digunakan oleh ratusan sekolah di Indonesia</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100"><div class="feature-card"><div class="feature-icon"><i class="bi bi-cloud-upload"></i></div><h4 class="feature-title">Mudah Digunakan</h4><p class="feature-description">Antarmuka intuitif untuk guru & admin dalam mengelola prestasi.</p></div></div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200"><div class="feature-card"><div class="feature-icon"><i class="bi bi-shield-check"></i></div><h4 class="feature-title">Data Terverifikasi</h4><p class="feature-description">Setiap prestasi diverifikasi admin sekolah sebelum publikasi.</p></div></div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300"><div class="feature-card"><div class="feature-icon"><i class="bi bi-bar-chart-line"></i></div><h4 class="feature-title">Analitik Lengkap</h4><p class="feature-description">Laporan & statistik komprehensif untuk evaluasi sekolah.</p></div></div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400"><div class="feature-card"><div class="feature-icon"><i class="bi bi-globe"></i></div><h4 class="feature-title">Publik & Transparan</h4><p class="feature-description">Dorong kompetisi sehat dengan prestasi yang dapat diakses publik.</p></div></div>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section class="how-it-works" id="tentang">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-soft mb-3"><i class="bi bi-info-circle me-2"></i>Cara Kerja</span>
            <h2 class="section-title">Bagaimana SIPRES Bekerja?</h2>
            <p class="section-subtitle">Hanya 3 langkah mudah, sekolah Anda dapat mulai mempublikasikan prestasi siswa</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100"><div class="step-card"><div class="step-number">1</div><h4>Daftarkan Sekolah</h4><p>Registrasi sekolah melalui halaman <a href="{{ route('register.school') }}" class="text-primary">Pendaftaran Sekolah</a>, verifikasi singkat oleh admin pusat.</p></div></div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200"><div class="step-card"><div class="step-number">2</div><h4>Input Data Prestasi</h4><p>Guru/admin login ke dashboard, input data lengkap + bukti sertifikat dan foto.</p></div></div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300"><div class="step-card"><div class="step-number">3</div><h4>Publikasi Otomatis</h4><p>Setelah diverifikasi, prestasi siswa langsung tampil di halaman publik.</p></div></div>
        </div>
    </div>
</section>

<!-- TESTIMONI -->
<section class="testimonial-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-soft mb-3"><i class="bi bi-chat-quote me-2"></i>Testimoni</span>
            <h2 class="section-title">Apa Kata Mereka?</h2>
            <p class="section-subtitle">Ribuan guru dan admin sekolah telah mempercayakan SIPRES</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up"><div class="testimonial-card"><p class="testimonial-text">SIPRES memudahkan dokumentasi prestasi siswa, prosesnya cepat dan hasilnya profesional.</p><div class="d-flex gap-3 align-items-center"><div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:48px;height:48px;">BS</div><div><div class="fw-bold">Budi Santoso, S.Pd</div><div class="small text-secondary">Wali Kelas SMAN 1 Jakarta</div><div class="rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div></div></div></div></div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100"><div class="testimonial-card"><p class="testimonial-text">Orang tua siswa sangat antusias karena prestasi anak terpublikasi online. Luar biasa!</p><div class="d-flex gap-3"><div class="bg-success rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:48px;height:48px;">SR</div><div><div class="fw-bold">Siti Rahayu, M.Pd</div><div class="small text-secondary">Kepala SMPN 3 Surabaya</div><div class="rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div></div></div></div></div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200"><div class="testimonial-card"><p class="testimonial-text">Analitik SIPRES membantu memantau perkembangan prestasi siswa secara real-time.</p><div class="d-flex gap-3"><div class="bg-warning rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:48px;height:48px;">AW</div><div><div class="fw-bold">Ahmad Wijaya, S.Kom</div><div class="small text-secondary">Admin SDN Harapan Bandung</div><div class="rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div></div></div></div></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section" id="kontak">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="text-white fw-bold" style="font-size:2.5rem;">Siap Mendaftarkan Sekolah Anda?</h2>
        <p class="text-white opacity-90 mb-4">Bergabung dengan ratusan sekolah yang mempercayakan dokumentasi prestasi siswa kepada SIPRES</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register.school') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold">
                <i class="bi bi-building-add me-2"></i>Daftarkan Sekolah Gratis
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
                </a>
            @endauth
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a href="{{ url('/') }}" class="footer-brand"><i class="bi bi-trophy-fill"></i> SIPRES</a>
                <p class="text-white-50">Sistem Informasi Prestasi Siswa Indonesia. Platform terpercaya untuk mendokumentasikan prestasi siswa.</p>
                <div class="social-links d-flex gap-2">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="fw-semibold">Navigasi</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="#home"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('publik.prestasi.semua') }}"><i class="bi bi-chevron-right"></i> Data Prestasi</a></li>
                    <li><a href="#tentang"><i class="bi bi-chevron-right"></i> Tentang</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}"><i class="bi bi-chevron-right"></i> Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Login</a></li>
                    @endauth
                    <li><a href="{{ route('register.school') }}"><i class="bi bi-chevron-right"></i> Daftar Sekolah</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="fw-semibold">Layanan</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('register.school') }}">Pendaftaran Sekolah</a></li>
                    <li><a href="#">Manajemen Prestasi</a></li>
                    <li><a href="#">Laporan & Analitik</a></li>
                    <li><a href="#">Bantuan & Panduan</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="fw-semibold">Kontak Kami</h5>
                <ul class="list-unstyled footer-contact">
                    <li><i class="bi bi-geo-alt-fill me-2"></i> Jl. Pendidikan No.1, Jakarta Pusat, DKI Jakarta 10110</li>
                    <li><i class="bi bi-telephone-fill me-2"></i> (021) 123-4567</li>
                    <li><i class="bi bi-envelope-fill me-2"></i> <a href="mailto:info@sipres.id">info@sipres.id</a></li>
                    <li><i class="bi bi-clock-fill me-2"></i> Senin – Jumat, 08.00 – 17.00 WIB</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center pt-4 mt-4 border-top border-secondary">
            <p class="mb-0 text-white-50">&copy; {{ date('Y') }} SIPRES – Sistem Informasi Prestasi Siswa Indonesia. All rights reserved.</p>
        </div>
    </div>
</footer>

<div class="modal-custom" id="imageModal" onclick="closeModal()">
    <div class="modal-content-custom" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="Preview">
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 700, once: true, offset: 80 });
    
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 50);
    });
    
    function toggleMenu() { 
        document.getElementById('navMenu').classList.toggle('active'); 
    }
    
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => document.getElementById('navMenu')?.classList.remove('active'));
    });
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
    
    // Counter animation untuk stats
    function animateCounter(el, target) {
        let current = 0;
        let step = Math.ceil(target / 60);
        const timer = setInterval(() => {
            current += step;
            if(current >= target) {
                el.innerText = target.toLocaleString('id-ID');
                clearInterval(timer);
            } else {
                el.innerText = current.toLocaleString('id-ID');
            }
        }, 20);
    }
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.querySelectorAll('.stat-number').forEach(el => {
                    let target = parseInt(el.getAttribute('data-target'));
                    if(target && target > 0) animateCounter(el, target);
                });
                statsObserver.disconnect();
            }
        });
    }, { threshold: 0.3 });
    
    const statsSection = document.querySelector('.stats-section');
    if(statsSection) statsObserver.observe(statsSection);
    
    function openModal(src) { 
        document.getElementById('modalImage').src = src; 
        document.getElementById('imageModal').classList.add('active'); 
        document.body.style.overflow = 'hidden'; 
    }
    
    function closeModal() { 
        document.getElementById('imageModal').classList.remove('active'); 
        document.body.style.overflow = ''; 
    }
    
    window.closeModal = closeModal;
    window.openModal = openModal;
    window.toggleMenu = toggleMenu;
</script>
</body>
</html>
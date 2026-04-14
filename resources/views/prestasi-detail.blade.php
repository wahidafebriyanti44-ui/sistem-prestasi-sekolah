<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Prestasi - {{ $prestasi->nama_lomba }} | SIPRES</title>
    <!-- Bootstrap 5 CSS + Icons + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            color: #1e293b;
            overflow-x: hidden;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #e2e8f0;
        }
        ::-webkit-scrollbar-thumb {
            background: #4361ee;
            border-radius: 10px;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #4361ee, #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
        }
        .navbar-brand i {
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
            color: #4361ee;
        }
        .btn-back {
            background: linear-gradient(135deg, #4361ee, #4895ef);
            color: white;
            padding: 0.5rem 1.8rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            color: white;
        }
        
        /* Header Hero */
        .header-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #2d3e50 100%);
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .header-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(67,97,238,0.1)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            opacity: 0.3;
        }
        
        .hero-badge {
            display: inline-flex;
            gap: 12px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .badge-premium {
            padding: 0.6rem 1.3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .badge-kategori {
            background: rgba(67, 97, 238, 0.9);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .badge-tingkat {
            background: rgba(114, 9, 183, 0.9);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .badge-rank {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1e293b;
            border: none;
        }
        .badge-rank-silver {
            background: linear-gradient(135deg, #94a3b8, #64748b);
            color: white;
        }
        .badge-rank-bronze {
            background: linear-gradient(135deg, #d97706, #b45309);
            color: white;
        }
        .badge-year {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .lomba-title {
            font-weight: 800;
            font-size: 3rem;
            color: white;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            letter-spacing: -0.02em;
        }
        
        /* Main Card */
        .main-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
            margin-top: -60px;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }
        
        /* Student Profile Sidebar */
        .student-sidebar {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 40px 30px;
            height: 100%;
            border-right: 1px solid #e2e8f0;
        }
        
        .student-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 15px 35px rgba(67, 97, 238, 0.2);
            transition: transform 0.3s ease;
        }
        .student-avatar:hover {
            transform: scale(1.05);
        }
        .student-placeholder {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4361ee, #7209b7);
            color: white;
            font-size: 4rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 5px solid white;
            box-shadow: 0 15px 35px rgba(67, 97, 238, 0.2);
            transition: transform 0.3s ease;
            margin: 0 auto;
        }
        .student-placeholder:hover {
            transform: scale(1.05);
        }
        
        .student-name {
            font-weight: 800;
            font-size: 1.5rem;
            color: #0f172a;
            margin-bottom: 8px;
            text-align: center;
        }
        .school-name {
            color: #64748b;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: white;
            padding: 8px 20px;
            border-radius: 50px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            width: 100%;
        }
        
        .student-info-item {
            background: white;
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 12px;
            text-align: center;
        }
        .student-info-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 5px;
        }
        .student-info-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: #0f172a;
        }
        
        /* Section Styles */
        .section-title {
            font-weight: 800;
            font-size: 1.3rem;
            color: #0f172a;
            margin-bottom: 20px;
            position: relative;
            padding-left: 15px;
        }
        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #4361ee, #7209b7);
            border-radius: 4px;
        }
        
        /* Certificate Card */
        .certificate-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            margin-bottom: 30px;
        }
        .certificate-card:hover {
            border-color: #4361ee;
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(67, 97, 238, 0.15);
        }
        .certificate-preview-img {
            max-width: 100%;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            max-height: 300px;
            object-fit: cover;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .certificate-preview-img:hover {
            transform: scale(1.02);
        }
        
        .btn-download {
            background: linear-gradient(135deg, #4361ee, #4895ef);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.9rem;
        }
        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.3);
            color: white;
        }
        
        .narrative-box {
            background: linear-gradient(135deg, #fefce8, #fef3c7);
            border-radius: 20px;
            padding: 30px;
            font-size: 1rem;
            line-height: 1.8;
            color: #334155;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .narrative-box::before {
            content: '"';
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 100px;
            opacity: 0.1;
            font-family: serif;
            color: #d97706;
        }
        
        /* Prestasi Lain Card */
        .prestasi-lain-card {
            background: white;
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }
        .prestasi-lain-card:hover {
            transform: translateX(8px);
            border-color: #4361ee;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
        }
        .prestasi-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #4361ee;
        }
        
        /* Floating Share */
        .floating-share {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 100;
        }
        .share-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4361ee, #7209b7);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.4);
            transition: all 0.3s ease;
        }
        .share-btn:hover {
            transform: scale(1.1);
        }
        
        /* FOOTER STYLES - SAMA SEPERTI HOME */
        .footer {
            background: #0f172a;
            color: white;
            padding: 60px 0 30px;
            margin-top: 60px;
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
        .footer-links a, .footer-contact li span, .footer-contact li a { 
            color: rgba(255,255,255,0.7); 
            text-decoration: none; 
            transition: 0.2s; 
        }
        .footer-links a:hover { 
            color: white; 
            padding-left: 5px; 
        }
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
        .social-links a:hover { 
            background: #4361ee; 
            transform: translateY(-3px); 
        }
        .footer-contact li {
            margin-bottom: 12px;
        }
        .footer-contact li i {
            color: #4361ee;
        }
        
        /* Modal */
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .lomba-title { font-size: 1.8rem; }
            .student-name { font-size: 1.2rem; }
            .student-sidebar { border-right: none; border-bottom: 1px solid #e2e8f0; }
            .student-avatar, .student-placeholder { width: 120px; height: 120px; font-size: 2.5rem; }
            .section-title { font-size: 1.1rem; }
            .narrative-box { padding: 20px; font-size: 0.9rem; }
            .footer-brand { font-size: 1.4rem; }
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .content-section {
            padding: 40px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="navbar-brand">
                <i class="bi bi-trophy-fill"></i> SIPRES
            </a>
            <div>
                <a href="{{ url()->previous() }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Header Hero -->
    <header class="header-hero">
        <div class="container text-center">
            <div class="hero-badge">
                <span class="badge-premium badge-kategori">
                    <i class="bi {{ $prestasi->jenis_prestasi == 'akademik' ? 'bi-book-half' : 'bi-palette-fill' }}"></i>
                    {{ ucfirst($prestasi->jenis_prestasi) }}
                </span>
                <span class="badge-premium badge-tingkat">
                    <i class="bi bi-geo-alt-fill"></i> Tingkat {{ ucfirst($prestasi->tingkat) }}
                </span>
                <span class="badge-premium {{ $prestasi->peringkat == 'Emas' ? 'badge-rank' : ($prestasi->peringkat == 'Perak' ? 'badge-rank-silver' : ($prestasi->peringkat == 'Perunggu' ? 'badge-rank-bronze' : 'badge-rank')) }}">
                    <i class="bi bi-award-fill"></i> {{ $prestasi->peringkat }}
                </span>
                <span class="badge-premium badge-year">
                    <i class="bi bi-calendar3"></i> {{ $prestasi->tahun }}
                </span>
            </div>
            <h1 class="lomba-title animate-fadeInUp">{{ $prestasi->nama_lomba }}</h1>
            <p class="text-white-50 mt-3">
                <i class="bi bi-geo-alt"></i> {{ $prestasi->tempat ?? 'Indonesia' }}
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="main-card" data-aos="fade-up" data-aos-duration="800">
                    <div class="row g-0">
                        <!-- Left Column - Profile Siswa -->
                        <div class="col-lg-4">
                            <div class="student-sidebar text-center">
                                @if($prestasi->siswa && $prestasi->siswa->foto)
                                    <img src="{{ asset('uploads/foto-siswa/' . $prestasi->siswa->foto) }}" 
                                         alt="Foto Siswa" 
                                         class="student-avatar">
                                @else
                                    <div class="student-placeholder">
                                        {{ strtoupper(substr($prestasi->siswa->nama_lengkap ?? 'S', 0, 2)) }}
                                    </div>
                                @endif
                                
                                <h2 class="student-name mt-4">{{ $prestasi->siswa->nama_lengkap ?? 'Nama Siswa' }}</h2>
                                <div class="school-name">
                                    <i class="bi bi-building"></i> {{ $prestasi->siswa->school->nama_sekolah ?? 'Nama Sekolah' }}
                                </div>
                                
                                <div class="mt-4">
                                    <div class="student-info-item">
                                        <div class="student-info-label">Kelas</div>
                                        <div class="student-info-value">{{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Content -->
                        <div class="col-lg-8">
                            <div class="content-section">
                                <!-- Sertifikat & Dokumentasi -->
                                <h3 class="section-title">
                                    <i class="bi bi-image me-2"></i> Sertifikat & Dokumentasi
                                </h3>
                                <div class="certificate-card">
                                    @if($prestasi->file_sertifikat && file_exists(public_path('uploads/sertifikat/' . $prestasi->file_sertifikat)))
                                        @if(in_array(pathinfo($prestasi->file_sertifikat, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                                            <img src="{{ asset('uploads/sertifikat/' . $prestasi->file_sertifikat) }}" 
                                                 alt="Sertifikat" 
                                                 class="certificate-preview-img"
                                                 onclick="openModal('{{ asset('uploads/sertifikat/' . $prestasi->file_sertifikat) }}')">
                                        @else
                                            <i class="bi bi-file-earmark-pdf-fill" style="font-size: 4rem; color: #ef4444;"></i>
                                            <h5 class="mt-3 mb-2">Dokumen Sertifikat (PDF)</h5>
                                        @endif
                                        
                                        <br>
                                        <a href="{{ asset('uploads/sertifikat/' . $prestasi->file_sertifikat) }}" 
                                           target="_blank" 
                                           class="btn-download mt-3">
                                            <i class="bi bi-cloud-arrow-down-fill"></i> Lihat / Unduh Sertifikat
                                        </a>
                                    @else
                                        <i class="bi bi-file-image" style="font-size: 4rem; color: #94a3b8;"></i>
                                        <p class="text-secondary mt-3 mb-0">Belum ada file sertifikat yang dilampirkan</p>
                                    @endif
                                </div>
                                
                                <!-- Narasi & Cerita Prestasi -->
                                <h3 class="section-title">
                                    <i class="bi bi-journal-text me-2"></i> Narasi & Cerita Prestasi
                                </h3>
                                <div class="narrative-box">
                                    {!! nl2br(e($prestasi->deskripsi ?? 'Merupakan suatu kebanggaan telah meraih prestasi pada ajang ini. Pencapaian ini menjadi bukti dedikasi dan kerja keras dalam mengembangkan potensi diri di bidang akademik maupun non-akademik. Semoga prestasi ini dapat menjadi inspirasi bagi siswa-siswa lainnya untuk terus berkarya dan berprestasi.')) !!}
                                </div>
                                
                                <!-- Prestasi Lainnya -->
                                @if(isset($prestasiLainnya) && $prestasiLainnya->count() > 0)
                                <div class="mt-4">
                                    <h3 class="section-title">
                                        <i class="bi bi-trophy me-2"></i> Prestasi Lainnya
                                    </h3>
                                    <div class="prestasi-lain-list">
                                        @foreach($prestasiLainnya as $lain)
                                        <a href="{{ route('publik.prestasi.detail', $lain->id) }}" class="prestasi-lain-card">
                                            <div class="prestasi-icon">
                                                <i class="bi bi-award-fill"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold text-dark">{{ Str::limit($lain->nama_lomba, 40) }}</h6>
                                                <small class="text-secondary">
                                                    <i class="bi bi-calendar3"></i> {{ $lain->tahun }} 
                                                    &bull; <i class="bi bi-star-fill text-warning"></i> {{ $lain->peringkat }}
                                                </small>
                                            </div>
                                            <i class="bi bi-chevron-right text-secondary"></i>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Share Button -->
    <div class="floating-share">
        <a href="#" onclick="sharePrestasi()" class="share-btn" data-bs-toggle="tooltip" title="Bagikan prestasi ini">
            <i class="bi bi-share-fill"></i>
        </a>
    </div>

    <!-- FOOTER - SAMA SEPERTI HOME -->
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
                    <h5 class="fw-semibold text-white">Navigasi</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ url('/') }}#home"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                        <li><a href="{{ route('publik.prestasi.semua') }}"><i class="bi bi-chevron-right"></i> Data Prestasi</a></li>
                        <li><a href="{{ url('/') }}#tentang"><i class="bi bi-chevron-right"></i> Tentang</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}"><i class="bi bi-chevron-right"></i> Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Login</a></li>
                        @endauth
                        <li><a href="{{ route('register.school') }}"><i class="bi bi-chevron-right"></i> Daftar Sekolah</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="fw-semibold text-white">Layanan</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('register.school') }}">Pendaftaran Sekolah</a></li>
                        <li><a href="#">Manajemen Prestasi</a></li>
                        <li><a href="#">Laporan & Analitik</a></li>
                        <li><a href="#">Bantuan & Panduan</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="fw-semibold text-white">Kontak Kami</h5>
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

    <!-- Modal Preview Image -->
    <div class="modal-custom" id="imageModal" onclick="closeModal()">
        <div class="modal-content-custom" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Preview">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true, offset: 80 });
        
        function openModal(src) { 
            document.getElementById('modalImage').src = src; 
            document.getElementById('imageModal').classList.add('active'); 
            document.body.style.overflow = 'hidden'; 
        }
        
        function closeModal() { 
            document.getElementById('imageModal').classList.remove('active'); 
            document.body.style.overflow = ''; 
        }
        
        function sharePrestasi() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $prestasi->nama_lomba }}',
                    text: 'Lihat prestasi {{ $prestasi->siswa->nama_lengkap ?? "siswa" }} di SIPRES',
                    url: window.location.href
                }).catch(() => {});
            } else {
                alert('Bagikan link ini: ' + window.location.href);
            }
        }
        
        window.closeModal = closeModal;
        window.openModal = openModal;
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Prestasi - SIPRES</title>
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
        .header-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #2d3e50 100%);
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .header-bg::before {
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
        
        .page-title {
            font-weight: 800;
            font-size: 3rem;
            color: white;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            letter-spacing: -0.02em;
        }
        .page-subtitle {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.7);
        }
        
        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
            margin-top: -60px;
            position: relative;
            z-index: 10;
            padding: 30px;
            margin-bottom: 40px;
        }
        .filter-card .form-label {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .filter-card .form-control,
        .filter-card .form-select {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        .filter-card .form-control:focus,
        .filter-card .form-select:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        /* Achievement Card */
        .achievement-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
        }
        .achievement-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 25px 45px rgba(67, 97, 238, 0.15);
            border-color: #4361ee;
        }
        .achievement-img-wrapper {
            position: relative;
            height: 200px;
            background: linear-gradient(135deg, #4361ee, #7209b7);
        }
        .achievement-img {
            width: 100%; 
            height: 100%; 
            object-fit: cover;
        }
        .student-photo-badge {
            position: absolute; 
            bottom: -20px; 
            right: 20px;
            width: 65px; 
            height: 65px; 
            border-radius: 50%;
            border: 4px solid white; 
            background: white; 
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        .achievement-card:hover .student-photo-badge {
            transform: scale(1.05);
        }
        .avatar-placeholder {
            width: 100%; 
            height: 100%;
            background: linear-gradient(135deg, #4361ee, #7209b7);
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-weight: 800; 
            color: white; 
            font-size: 1.4rem;
        }
        .achievement-content { 
            padding: 1.8rem 1.5rem 1.5rem; 
            margin-top: 8px; 
        }
        .achievement-title { 
            font-weight: 800; 
            margin-bottom: 0.75rem; 
            color: #0f172a; 
            font-size: 1.05rem; 
            line-height: 1.4; 
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .achievement-rank {
            display: inline-flex; 
            align-items: center; 
            gap: 0.4rem;
            padding: 0.35rem 0.9rem; 
            background: #eef2ff; 
            color: #4361ee;
            border-radius: 40px; 
            font-weight: 700; 
            font-size: 0.75rem;
        }
        .rank-gold { 
            background: linear-gradient(135deg, #fbbf24, #f59e0b); 
            color: white; 
        }
        .rank-silver { 
            background: linear-gradient(135deg, #94a3b8, #64748b); 
            color: white; 
        }
        .rank-bronze { 
            background: linear-gradient(135deg, #d97706, #b45309); 
            color: white; 
        }
        
        .btn-detail {
            display: inline-flex; 
            align-items: center; 
            justify-content: center;
            gap: 0.5rem; 
            margin-top: 1rem; 
            width: 100%;
            padding: 0.6rem 1rem; 
            background: linear-gradient(135deg, #4361ee, #4895ef);
            color: white; 
            border-radius: 50px; 
            font-weight: 600; 
            font-size: 0.85rem;
            text-decoration: none; 
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        .btn-detail:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            color: white;
        }
        
        /* Pagination */
        .pagination {
            margin-top: 40px;
        }
        .pagination .page-link {
            border-radius: 10px;
            margin: 0 4px;
            color: #4361ee;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover {
            background: linear-gradient(135deg, #4361ee, #4895ef);
            color: white;
            border-color: #4361ee;
        }
        .pagination .active .page-link {
            background: linear-gradient(135deg, #4361ee, #7209b7);
            border-color: #4361ee;
            color: white;
        }
        
        /* Footer */
        .footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 60px 0 30px;
            margin-top: 60px;
        }
        .footer-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, #4361ee, #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .footer-brand i {
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
            color: #4361ee;
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: #94a3b8;
            transition: all 0.3s ease;
        }
        .social-links a:hover {
            background: #4361ee;
            color: white;
            transform: translateY(-3px);
        }
        .footer-contact li {
            margin-bottom: 12px;
            color: #94a3b8;
        }
        .footer-contact li i {
            color: #4361ee;
        }
        .footer-contact a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-contact a:hover {
            color: #4361ee;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-title { font-size: 1.8rem; }
            .header-bg { padding: 80px 0 60px; }
            .filter-card { margin-top: -40px; padding: 20px; }
            .filter-card .btn { margin-top: 10px; }
            .achievement-img-wrapper { height: 160px; }
            .student-photo-badge { width: 50px; height: 50px; bottom: -15px; right: 15px; }
            .achievement-content { padding: 1.2rem 1rem 1rem; }
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="navbar-brand">
                <i class="bi bi-trophy-fill"></i> SIPRES
            </a>
            <div>
                <a href="/" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>

    <!-- Header Hero -->
    <header class="header-bg">
        <div class="container text-center">
            <h1 class="page-title animate-fadeInUp">Galeri Prestasi Siswa</h1>
            <p class="page-subtitle mt-3 animate-fadeInUp" style="animation-delay: 0.1s;">
                <i class="bi bi-trophy-fill"></i> Eksplorasi jejak gemilang siswa-siswi berprestasi dari seluruh sekolah yang terdaftar.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mb-5">
        <!-- Filter Form -->
        <div class="filter-card" data-aos="fade-up" data-aos-duration="800">
            <form action="{{ route('publik.prestasi.semua') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-bold"><i class="bi bi-search"></i> Cari Siswa/Lomba</label>
                    <input type="text" name="q" class="form-control" placeholder="Ketik nama siswa/lomba..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold"><i class="bi bi-building"></i> Pilih Sekolah</label>
                    <select name="school_id" class="form-select">
                        <option value="">Semua Sekolah</option>
                        @foreach($sekolahList as $sekolah)
                            <option value="{{ $sekolah->id }}" {{ request('school_id') == $sekolah->id ? 'selected' : '' }}>
                                {{ $sekolah->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold"><i class="bi bi-calendar3"></i> Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $thn)
                            <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold"><i class="bi bi-geo-alt"></i> Tingkat Lomba</label>
                    <select name="tingkat" class="form-select">
                        <option value="">Semua Tingkat</option>
                        <option value="sekolah" {{ request('tingkat') == 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                        <option value="kecamatan" {{ request('tingkat') == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        <option value="kabupaten" {{ request('tingkat') == 'kabupaten' ? 'selected' : '' }}>Kabupaten/Kota</option>
                        <option value="provinsi" {{ request('tingkat') == 'provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="nasional" {{ request('tingkat') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="internasional" {{ request('tingkat') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn w-100 fw-bold" style="background: linear-gradient(135deg, #4361ee, #4895ef); border: none; border-radius: 12px; padding: 10px; color: white;">
                        <i class="bi bi-filter"></i> Terapkan
                    </button>
                </div>
            </form>
        </div>

        <!-- Render Prestasi -->
        <div class="row g-4">
            @forelse($prestasi as $item)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="achievement-card">
                        <div class="achievement-img-wrapper">
                            @if($item->file_sertifikat && file_exists(public_path('uploads/sertifikat/' . $item->file_sertifikat)))
                                @if(in_array(pathinfo($item->file_sertifikat, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                                    <img src="{{ asset('uploads/sertifikat/' . $item->file_sertifikat) }}" class="achievement-img" alt="{{ $item->nama_lomba }}">
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
                                @if($item->siswa && $item->siswa->foto)
                                    <img src="{{ asset('uploads/foto-siswa/' . $item->siswa->foto) }}" alt="Foto Siswa" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div class="avatar-placeholder">{{ strtoupper(substr($item->siswa->nama_lengkap ?? 'S', 0, 2)) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="achievement-content">
                            <h5 class="achievement-title" title="{{ $item->nama_lomba }}">{{ Str::limit($item->nama_lomba ?? 'Prestasi', 45) }}</h5>
                            <div class="text-secondary small mb-1"><i class="bi bi-person-circle"></i> {{ $item->siswa->nama_lengkap ?? 'Siswa' }}</div>
                            <div class="text-secondary small mb-2"><i class="bi bi-building"></i> {{ $item->siswa->school->name ?? $item->siswa->sekolah->name ?? 'Sekolah' }}</div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="achievement-rank 
                                    {{ $item->peringkat == 'Emas' || $item->peringkat == 'Gold' ? 'rank-gold' : '' }}
                                    {{ $item->peringkat == 'Perak' || $item->peringkat == 'Silver' ? 'rank-silver' : '' }}
                                    {{ $item->peringkat == 'Perunggu' || $item->peringkat == 'Bronze' ? 'rank-bronze' : '' }}">
                                    <i class="bi bi-trophy-fill me-1"></i>{{ $item->peringkat ?? 'Juara' }}
                                </span>
                                <small class="text-muted fw-bold"><i class="bi bi-calendar3 me-1"></i>{{ $item->tahun ?? date('Y') }}</small>
                            </div>
                            <a href="{{ route('publik.prestasi.detail', $item->id) }}" class="btn-detail">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center" data-aos="fade-up">
                    <i class="bi bi-search display-1 text-secondary opacity-50 mb-3"></i>
                    <h4 class="text-secondary">Tidak ada prestasi yang ditemukan</h4>
                    <p class="text-muted">Coba sesuaikan filter pencarian Anda.</p>
                    <a href="{{ route('publik.prestasi.semua') }}" class="btn btn-outline-primary rounded-pill mt-2 px-4 py-2" style="border-color: #4361ee; color: #4361ee; border-radius: 50px;">
                        <i class="bi bi-arrow-repeat"></i> Reset Filter
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $prestasi->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Prestasi - SIPRES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fb; }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #4361ee;
            text-decoration: none;
        }
        .btn-back {
            background: transparent;
            border: 2px solid #4361ee;
            color: #4361ee;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-back:hover {
            background: #4361ee;
            color: white;
        }
        
        .page-header {
            background: linear-gradient(135deg, #4361ee, #4895ef);
            padding: 80px 0 50px;
            color: white;
        }
        
        .achievement-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            height: 100%;
        }
        .achievement-card:hover { transform: translateY(-5px); }
        
        .student-avatar {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .student-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-placeholder {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #4361ee, #4895ef);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; font-weight: 700; color: white;
        }
        
        .achievement-profile {
            background: linear-gradient(135deg, #4361ee, #4895ef);
            padding: 20px 0;
            text-align: center;
        }
        .achievement-content { padding: 1.5rem; text-align: center; }
        .student-name { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.25rem; }
        .lomba-name {
            background: #eef2ff;
            padding: 0.5rem;
            border-radius: 10px;
            margin: 0.8rem 0;
            font-weight: 600;
            color: #4361ee;
            font-size: 0.9rem;
        }
        .rank-gold { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; }
        .rank-silver { background: linear-gradient(135deg, #94a3b8, #64748b); color: white; }
        .rank-bronze { background: linear-gradient(135deg, #d97706, #b45309); color: white; }
        .rank-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .btn-detail {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1.2rem;
            background: transparent;
            border: 2px solid #4361ee;
            color: #4361ee;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
        }
        .btn-detail:hover { background: #4361ee; color: white; }
        
        .pagination { justify-content: center; margin-top: 2rem; }
        footer {
            background: #0f172a;
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/" class="navbar-brand"><i class="bi bi-trophy-fill"></i> SIPRES</a>
            <a href="/" class="btn-back"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </nav>

    <section class="page-header">
        <div class="container text-center">
            <h1 class="display-5 fw-bold">Semua Prestasi</h1>
            <p class="lead opacity-90">Kumpulan prestasi siswa dari berbagai sekolah di Indonesia</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row g-4">
            @forelse($prestasi as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="achievement-card">
                    <div class="achievement-profile">
                        <div class="student-avatar">
                            @if($item->siswa->foto)
                                <img src="{{ asset('uploads/foto-siswa/' . $item->siswa->foto) }}" alt="{{ $item->siswa->nama_lengkap }}">
                            @else
                                <div class="avatar-placeholder">
                                    {{ substr($item->siswa->nama_lengkap, 0, 2) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="achievement-content">
                        <h5 class="student-name">{{ $item->siswa->nama_lengkap }}</h5>
                        <div class="lomba-name">
                            <i class="bi bi-trophy-fill me-1"></i>
                            {{ Str::limit($item->nama_lomba, 30) }}
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="rank-badge {{ $item->rank_class }}">
                                {{ $item->peringkat }}
                            </span>
                            <small class="text-muted">{{ $item->tahun }}</small>
                        </div>
                        <a href="{{ route('prestasi.detail', $item->id) }}" class="btn-detail">
                            Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox display-1 text-secondary"></i>
                <p class="mt-3">Belum ada prestasi yang ditampilkan</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5">
            {{ $prestasi->links() }}
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 SIPRES - Sistem Informasi Prestasi Siswa</p>
        </div>
    </footer>
</body>
</html>
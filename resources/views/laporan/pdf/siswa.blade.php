<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2A5C8A;
        }
        
        .header h1 {
            font-size: 24px;
            color: #2A5C8A;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #666;
            font-size: 11px;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2A5C8A;
            border-left: 4px solid #2A5C8A;
            padding-left: 10px;
            margin-bottom: 15px;
            background: #f0f5fa;
            padding: 8px 12px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            padding: 6px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-label {
            width: 130px;
            font-weight: bold;
            color: #555;
        }
        
        .info-value {
            flex: 1;
            color: #333;
        }
        
        .photo-section {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 2px solid #2A5C8A;
            border-radius: 8px;
            margin: 0 auto;
        }
        
        .photo-placeholder {
            width: 120px;
            height: 120px;
            background: #e9ecef;
            border: 2px solid #2A5C8A;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: #adb5bd;
            margin: 0 auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        table th {
            background: #2A5C8A;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-akademik { background: #e3f2fd; color: #1976d2; }
        .badge-nonakademik { background: #f3e5f5; color: #7b1fa2; }
        .badge-verified { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #999;
        }
        
        .eskul-list, .minat-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        
        .eskul-item {
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 11px;
        }
        
        .minat-item {
            background: linear-gradient(135deg, #2A5C8A, #4A7BA9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISTEM INFORMASI PRESTASI SISWA (SIPRES)</h1>
        <p>Laporan Data Siswa - Dicetak pada: {{ $date }}</p>
    </div>

    <div class="photo-section">
        @if($siswa->foto && file_exists(public_path('uploads/foto-siswa/' . $siswa->foto)))
            <img src="{{ public_path('uploads/foto-siswa/' . $siswa->foto) }}" class="photo">
        @else
            <div class="photo-placeholder">{{ substr($siswa->nama_lengkap, 0, 1) }}</div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">DATA PRIBADI SISWA</div>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">NIS</span><span class="info-value">: {{ $siswa->nis }}</span></div>
            <div class="info-item"><span class="info-label">NISN</span><span class="info-value">: {{ $siswa->nisn ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">Nama Lengkap</span><span class="info-value">: {{ $siswa->nama_lengkap }}</span></div>
            <div class="info-item"><span class="info-label">Tempat, Tgl Lahir</span><span class="info-value">: {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d/m/Y') : '-' }}</span></div>
            <div class="info-item"><span class="info-label">Jenis Kelamin</span><span class="info-value">: {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
            <div class="info-item"><span class="info-label">Kelas</span><span class="info-value">: {{ $siswa->kelas->nama_kelas ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">Wali Kelas</span><span class="info-value">: {{ $siswa->kelas->waliKelas->name ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">Alamat</span><span class="info-value">: {{ $siswa->alamat ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">No. HP</span><span class="info-value">: {{ $siswa->no_hp ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">Email</span><span class="info-value">: {{ $siswa->user->email ?? ($siswa->email ?? '-') }}</span></div>
            <div class="info-item"><span class="info-label">Mata Pelajaran Favorit</span><span class="info-value">: {{ $siswa->mata_pelajaran_favorit ?? '-' }}</span></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DATA ORANG TUA</div>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Nama Ayah</span><span class="info-value">: {{ $siswa->nama_ayah ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">Nama Ibu</span><span class="info-value">: {{ $siswa->nama_ibu ?? '-' }}</span></div>
            <div class="info-item"><span class="info-label">No. HP Orang Tua</span><span class="info-value">: {{ $siswa->no_hp_orangtua ?? '-' }}</span></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">STATISTIK PRESTASI</div>
        <div class="info-grid">
            <div class="info-item"><span class="info-label">Total Prestasi</span><span class="info-value">: {{ $totalPrestasi }}</span></div>
            <div class="info-item"><span class="info-label">Terverifikasi</span><span class="info-value">: {{ $prestasiTerverifikasi }}</span></div>
            <div class="info-item"><span class="info-label">Pending</span><span class="info-value">: {{ $prestasiPending }}</span></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">RIWAYAT PRESTASI</div>
        @if($siswa->prestasi->count() > 0)
        <table>
            <thead><tr><th>No</th><th>Nama Lomba</th><th>Jenis</th><th>Tingkat</th><th>Peringkat</th><th>Tahun</th><th>Status</th></tr></thead>
            <tbody>
                @foreach($siswa->prestasi as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->nama_lomba }}</td>
                    <td>{{ ucfirst($p->jenis_prestasi) }}</td>
                    <td>{{ ucfirst($p->tingkat) }}</td>
                    <td>{{ $p->peringkat }}</td>
                    <td>{{ $p->tahun }}</td>
                    <td><span class="badge {{ $p->status == 'diverifikasi' ? 'badge-verified' : 'badge-pending' }}">{{ ucfirst($p->status) }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="text-align: center; color: #999;">Belum ada data prestasi</p>
        @endif
    </div>

    <div class="section">
        <div class="section-title">EKSTRAKURIKULER</div>
        @if($siswa->eskul->count() > 0)
        <div class="eskul-list">
            @foreach($siswa->eskul as $eskul)
            <div class="eskul-item">
                <strong>{{ $eskul->nama_eskul }}</strong><br>
                <small>{{ $eskul->pivot->keterangan ?? 'Anggota' }} ({{ $eskul->pivot->tahun_masuk }})</small>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align: center; color: #999;">Belum mengikuti ekstrakurikuler</p>
        @endif
    </div>

    <div class="section">
    <div class="section-title">MINAT & BAKAT</div>
    
    @if($siswa->minatBakat && $siswa->minatBakat->count() > 0)
        {{-- GANTI DENGAN STYLE YANG LEBIH SEDERHANA --}}
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach($siswa->minatBakat as $minat)
                <li style="display: inline-block; background: #2A5C8A; color: white; padding: 5px 15px; margin: 5px; border-radius: 20px; font-size: 11px;">
                    {{ $minat->nama_minat }}
                </li>
            @endforeach
        </ul>
    @else
        <p style="text-align: center; color: #999;">Belum ada data minat & bakat</p>
    @endif
</div>

    <div class="footer">
        <p>Dokumen ini dicetak dari Sistem Informasi Prestasi Siswa (SIPRES)</p>
        <p>&copy; {{ date('Y') }} SIPRES - All Rights Reserved</p>
    </div>
</body>
</html>
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
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            padding: 15px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2A5C8A;
        }
        
        .header h1 {
            font-size: 20px;
            color: #2A5C8A;
        }
        
        .header p {
            color: #666;
            font-size: 10px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2A5C8A;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 10px;
        }
        
        table th {
            background: #2A5C8A;
            color: white;
            padding: 6px;
            text-align: left;
        }
        
        table td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 9px;
            color: #999;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-aktif { background: #d4edda; color: #155724; }
        .badge-tidak { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>SISTEM INFORMASI PRESTASI SISWA (SIPRES)</h1>
        <p>{{ $school->name }} - NPSN: {{ $school->npsn }}</p>
        <p>Laporan Data Semua Siswa | Dicetak pada: {{ $date }}</p>
    </div>

    <!-- Tabel Siswa -->
    <div class="section-title">DATA SISWA ({{ $totalSiswa }} Siswa)</div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>JK</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Status Akun</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->nis }}</td>
                <td>{{ $s->nama_lengkap }}</td>
                <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $s->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                <td>{{ $s->no_hp ?? '-' }}</td>
                <td>{{ $s->user->email ?? ($s->email ?? '-') }}</td>
                <td>
                    @if($s->user_id)
                        <span class="badge badge-aktif">Aktif</span>
                    @else
                        <span class="badge badge-tidak">Tidak Punya</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini dicetak dari Sistem Informasi Prestasi Siswa (SIPRES)</p>
        <p>&copy; {{ date('Y') }} SIPRES - All Rights Reserved</p>
    </div>
</body>
</html>
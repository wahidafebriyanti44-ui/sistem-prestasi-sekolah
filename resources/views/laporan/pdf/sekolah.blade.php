<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #333;
            background: #fff;
        }

        /* ── PAGE HEADER (dicetak tiap halaman) ── */
        .page-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 38px;
            background: #1a3f6f;
            color: white;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .page-header .sys-name { font-size: 10px; font-weight: bold; }
        .page-header .school-name-top { font-size: 10px; }
        .page-header-accent {
            position: fixed;
            top: 38px; left: 0; right: 0;
            height: 4px;
            background: #e8932b;
        }

        /* ── PAGE FOOTER ── */
        .page-footer {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 28px;
            background: #1a3f6f;
            color: white;
            font-size: 8px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .page-footer-accent {
            position: fixed;
            bottom: 28px; left: 0; right: 0;
            height: 3px;
            background: #e8932b;
        }

        /* ── MAIN CONTENT ── */
        .content {
            margin-top: 52px;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        /* ── SCHOOL HEADER ── */
        .school-header {
            text-align: center;
            padding: 14px 0 10px;
            border-bottom: 3px solid #e8932b;
            margin-bottom: 4px;
        }
        .school-header h1 {
            font-size: 15px;
            font-weight: bold;
            color: #1a3f6f;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .school-header .sub {
            font-size: 9px;
            color: #555;
            margin-top: 4px;
        }
        .school-header .sub-addr {
            font-size: 9px;
            color: #555;
            margin-top: 2px;
        }

        /* ── REPORT TITLE BOX ── */
        .report-title-box {
            background: #1a3f6f;
            color: white;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            padding: 9px 0;
            margin: 10px 0 4px;
            letter-spacing: 0.5px;
        }
        .report-date {
            text-align: right;
            font-size: 8.5px;
            color: #666;
            font-style: italic;
            margin-bottom: 16px;
        }

        /* ── SECTION HEADER ── */
        .section-header {
            background: #2A5C8A;
            color: white;
            font-size: 10.5px;
            font-weight: bold;
            padding: 7px 12px;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        /* ── STAT CARDS ── */
        .stats-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .stats-grid td {
            width: 25%;
            text-align: center;
            padding: 12px 6px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        .stats-grid tr:nth-child(odd) td { background: #f4f6f9; }
        .stats-grid tr:nth-child(even) td { background: #fff; }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #2A5C8A;
            line-height: 1.1;
        }
        .stat-label {
            font-size: 8px;
            color: #555;
            margin-top: 3px;
        }

        /* ── TABLES ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            font-size: 10px;
        }
        .data-table thead tr {
            background: #2A5C8A;
            color: white;
        }
        .data-table thead th {
            padding: 8px 8px;
            text-align: center;
            font-size: 9.5px;
            font-weight: bold;
        }
        .data-table tbody tr:nth-child(odd)  { background: #f4f6f9; }
        .data-table tbody tr:nth-child(even) { background: #fff; }
        .data-table tbody tr.total-row {
            background: #d4e6f1 !important;
            font-weight: bold;
            color: #1a3f6f;
        }
        .data-table td {
            padding: 7px 8px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        .data-table td.center { text-align: center; }
        .data-table td.right  { text-align: right; }
        .data-table td.bold   { font-weight: bold; color: #2A5C8A; }

        /* ── TREND BADGES ── */
        .trend-up   { color: #1b7e3f; font-weight: bold; }
        .trend-down { color: #c0392b; font-weight: bold; }
        .trend-same { color: #666; }

        /* ── LEVEL BADGE ── */
        .level-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8.5px;
            font-weight: bold;
            color: white;
        }
        .level-intl  { background: #1565C0; }
        .level-nas   { background: #1976D2; }
        .level-prov  { background: #42A5F5; }
        .level-kab   { background: #78ADD2; }

        /* ── PROGRESS BAR ── */
        .bar-wrap {
            background: #e0e0e0;
            border-radius: 4px;
            height: 12px;
            overflow: hidden;
            min-width: 80px;
        }
        .bar-fill {
            height: 12px;
            background: #2A5C8A;
            border-radius: 4px;
            text-align: right;
            color: white;
            font-size: 7.5px;
            line-height: 12px;
            padding-right: 4px;
        }

        /* ── SIGNATURE ── */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .signature-table td {
            width: 38%;
            text-align: center;
            vertical-align: top;
            font-size: 9.5px;
            color: #444;
            padding: 0 10px;
        }
        .signature-table td.spacer { width: 24%; }
        .signature-line {
            margin-top: 48px;
            border-top: 1px solid #555;
            padding-top: 4px;
            font-size: 9px;
        }

        /* ── PAGE BREAK ── */
        .page-break { page-break-before: always; }
    </style>
</head>
<body>

    {{-- ── FIXED PAGE HEADER ── --}}
    <div class="page-header">
        <span class="sys-name">SIPRES – Sistem Informasi Prestasi Siswa</span>
        <span class="school-name-top">{{ $school->name }}</span>
    </div>
    <div class="page-header-accent"></div>

    {{-- ── FIXED PAGE FOOTER ── --}}
    <div class="page-footer-accent"></div>
    <div class="page-footer">
        <span>Dicetak: {{ $date }}</span>
        <span>© SIPRES – All Rights Reserved</span>
        <span>Halaman <span class="pagenum"></span></span>
    </div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="content">

        {{-- Kop Sekolah --}}
        <div class="school-header">
            <h1>{{ $school->name }}</h1>
            <div class="sub">
                NPSN: {{ $school->npsn }}&nbsp;&nbsp;|&nbsp;&nbsp;{{ $school->email }}&nbsp;&nbsp;|&nbsp;&nbsp;{{ $school->phone }}
            </div>
            <div class="sub-addr">{{ $school->address }}</div>
        </div>

        {{-- Judul Laporan --}}
        <div class="report-title-box">LAPORAN STATISTIK SEKOLAH</div>
        <div class="report-date">Dicetak pada: {{ $date }}</div>

        {{-- ══════════════════════════════════════════
             STATISTIK UTAMA
             ══════════════════════════════════════════ --}}
        <div class="section-header">STATISTIK SEKOLAH</div>

        <table class="stats-grid">
            <tr>
                <td>
                    <div class="stat-number">{{ $totalSiswa }}</div>
                    <div class="stat-label">Total Siswa</div>
                </td>
                <td>
                    <div class="stat-number">{{ $totalGuru }}</div>
                    <div class="stat-label">Total Guru</div>
                </td>
                <td>
                    <div class="stat-number">{{ $totalKelas }}</div>
                    <div class="stat-label">Total Kelas</div>
                </td>
                <td>
                    <div class="stat-number">{{ $totalPrestasi }}</div>
                    <div class="stat-label">Total Prestasi</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="stat-number">{{ $totalEskul }}</div>
                    <div class="stat-label">Total Eskul</div>
                </td>
                <td>
                    <div class="stat-number">{{ $totalMinat }}</div>
                    <div class="stat-label">Total Minat Bakat</div>
                </td>
                <td>
                    <div class="stat-number">{{ $prestasiTerverifikasi }}</div>
                    <div class="stat-label">Terverifikasi</div>
                </td>
                <td>
                    <div class="stat-number">{{ $prestasiPending }}</div>
                    <div class="stat-label">Pending</div>
                </td>
            </tr>
        </table>

        {{-- ══════════════════════════════════════════
             DISTRIBUSI SISWA PER KELAS
             ══════════════════════════════════════════ --}}
        <div class="section-header">DISTRIBUSI SISWA PER KELAS</div>

        @php
            $maxSiswa   = $siswaPerKelas->max('siswa_count');
            $totalSiswaKelas = $siswaPerKelas->sum('siswa_count');
        @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:30px">No</th>
                    <th style="text-align:left">Nama Kelas</th>
                    <th style="text-align:left">Wali Kelas</th>
                    <th style="width:80px">Jml Siswa</th>
                    <th style="width:140px">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaPerKelas as $index => $kelas)
                @php
                    $pct = $totalSiswaKelas > 0
                        ? round(($kelas->siswa_count / $totalSiswaKelas) * 100, 1)
                        : 0;
                    $barW = $maxSiswa > 0
                        ? round(($kelas->siswa_count / $maxSiswa) * 100)
                        : 0;
                @endphp
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td>{{ $kelas->waliKelas->name ?? '-' }}</td>
                    <td class="center bold">{{ $kelas->siswa_count }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:6px">
                            <div class="bar-wrap" style="flex:1">
                                <div class="bar-fill" style="width:{{ $barW }}%">{{ $pct }}%</div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

                {{-- Baris Total --}}
                <tr class="total-row">
                    <td class="center">—</td>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td class="center">{{ $totalSiswaKelas }}</td>
                    <td class="center">100%</td>
                </tr>
            </tbody>
        </table>

        {{-- ══════════════════════════════════════════
             PRESTASI PER TINGKAT
             ══════════════════════════════════════════ --}}
        <div class="section-header">PRESTASI PER TINGKAT</div>

        @php
            $totalTingkat = $prestasiPerTingkat->sum('total');
            $levelClass = ['intl', 'nas', 'prov', 'kab'];
        @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:30px">No</th>
                    <th style="text-align:left">Tingkat</th>
                    <th style="width:90px">Jml Prestasi</th>
                    <th style="width:70px">Persentase</th>
                    <th>Proporsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestasiPerTingkat as $i => $item)
                @php
                    $pct  = $totalTingkat > 0 ? round(($item->total / $totalTingkat) * 100, 1) : 0;
                    $lc   = $levelClass[$i] ?? 'kab';
                @endphp
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>
                        <span class="level-badge level-{{ $lc }}">
                            {{ ucfirst($item->tingkat) }}
                        </span>
                    </td>
                    <td class="center bold">{{ $item->total }}</td>
                    <td class="center">{{ $pct }}%</td>
                    <td>
                        <div class="bar-wrap">
                            <div class="bar-fill" style="width:{{ $pct }}%">{{ $pct }}%</div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ══════════════════════════════════════════
             PRESTASI PER TAHUN
             ══════════════════════════════════════════ --}}
        <div class="section-header">PRESTASI PER TAHUN</div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:30px">No</th>
                    <th style="width:100px">Tahun</th>
                    <th style="width:120px">Jumlah Prestasi</th>
                    <th>Tren</th>
                    <th>Proporsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $prevTotal    = null;
                    $totalTahun   = $prestasiPerTahun->sum('total');
                @endphp
                @foreach($prestasiPerTahun as $i => $item)
                @php
                    $pct = $totalTahun > 0 ? round(($item->total / $totalTahun) * 100, 1) : 0;

                    if ($prevTotal === null) {
                        $trenLabel = '—';
                        $trenClass = 'trend-same';
                    } elseif ($item->total > $prevTotal) {
                        $trenLabel = '▲ +' . ($item->total - $prevTotal);
                        $trenClass = 'trend-up';
                    } elseif ($item->total < $prevTotal) {
                        $trenLabel = '▼ -' . ($prevTotal - $item->total);
                        $trenClass = 'trend-down';
                    } else {
                        $trenLabel = '— Sama';
                        $trenClass = 'trend-same';
                    }
                    $prevTotal = $item->total;
                @endphp
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td class="center">{{ $item->tahun }}</td>
                    <td class="center bold">{{ $item->total }}</td>
                    <td class="center {{ $trenClass }}">{{ $trenLabel }}</td>
                    <td>
                        <div class="bar-wrap">
                            <div class="bar-fill" style="width:{{ $pct }}%">{{ $pct }}%</div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ══════════════════════════════════════════
             TANDA TANGAN
             ══════════════════════════════════════════ --}}
        <table class="signature-table" style="margin-top:36px">
            <tr>
                <td>
                    Mengetahui,<br>
                    <strong>Kepala Sekolah</strong>
                    <div class="signature-line">
                        (_____________________________)
                    </div>
                </td>
                <td class="spacer"></td>
                <td>
                    Jakarta, {{ $date }}<br>
                    <strong>Operator SIPRES</strong>
                    <div class="signature-line">
                        (_____________________________)
                    </div>
                </td>
            </tr>
        </table>

    </div>{{-- end .content --}}

</body>
</html>
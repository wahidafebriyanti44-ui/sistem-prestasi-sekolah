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

        /* ── PAGE HEADER ── */
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
        .page-header .sys-name  { font-size: 10px; font-weight: bold; }
        .page-header .doc-label { font-size: 10px; opacity: .85; }
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

        /* ── KOP INSTANSI ── */
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

        /* ── JUDUL LAPORAN ── */
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
            margin-bottom: 14px;
        }

        /* ── SECTION HEADER ── */
        .section-header {
            background: #2A5C8A;
            color: white;
            font-size: 10.5px;
            font-weight: bold;
            padding: 6px 12px;
            margin-bottom: 8px;
            margin-top: 18px;
        }

        /* ════════════════════════════════════════
           STAT TABLE — COMPACT (inline rows)
           ════════════════════════════════════════ */
        .stat-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            font-size: 10px;
        }
        .stat-table td {
            border: 1px solid #ddd;
            padding: 5px 10px;
            vertical-align: middle;
        }
        /* label kolom kiri */
        .stat-table td.s-label {
            width: 22%;
            color: #555;
            font-size: 9.5px;
        }
        /* angka */
        .stat-table td.s-num {
            width: 11%;
            font-size: 16px;
            font-weight: bold;
            color: #2A5C8A;
            text-align: center;
        }
        /* separator antar pasangan */
        .stat-table td.s-sep {
            width: 4%;
            border-left: 2px solid #e8932b;
            border-right: 2px solid #e8932b;
            padding: 0;
        }
        .stat-table tr:nth-child(odd)  td { background: #f4f6f9; }
        .stat-table tr:nth-child(even) td { background: #fff; }
        /* highlight row utama */
        .stat-table tr.highlight td { background: #e8f0f8 !important; }
        .stat-table tr.highlight td.s-num { color: #1a3f6f; }

        /* ── DATA TABLE ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            font-size: 10px;
        }
        .data-table thead tr { background: #2A5C8A; color: white; }
        .data-table thead th {
            padding: 7px 8px;
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
            padding: 6px 8px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        .data-table td.center { text-align: center; }
        .data-table td.right  { text-align: right; }
        .data-table td.bold   { font-weight: bold; color: #2A5C8A; }

        /* ── TREND ── */
        .trend-up   { color: #1b7e3f; font-weight: bold; }
        .trend-down { color: #c0392b; font-weight: bold; }
        .trend-same { color: #666; }

        /* ── BADGE ── */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8.5px;
            font-weight: bold;
            color: white;
        }
        .badge-blue   { background: #1565C0; }
        .badge-purple { background: #7b1fa2; }
        .badge-green  { background: #1b7e3f; color: #fff; }
        .badge-red    { background: #c0392b; color: #fff; }
        .badge-gray   { background: #888;    color: #fff; }
        .badge-gold   { background: #e8932b; color: #fff; }

        /* ── LEVEL BADGE ── */
        .level-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8.5px;
            font-weight: bold;
            color: white;
        }
        .level-intl { background: #1565C0; }
        .level-nas  { background: #1976D2; }
        .level-prov { background: #42A5F5; }
        .level-kab  { background: #78ADD2; }

        /* ── BAR ── */
        .bar-wrap {
            background: #e0e0e0;
            border-radius: 3px;
            height: 10px;
            overflow: hidden;
            min-width: 60px;
        }
        .bar-fill {
            height: 10px;
            background: #2A5C8A;
            border-radius: 3px;
            color: white;
            font-size: 7px;
            line-height: 10px;
            text-align: right;
            padding-right: 3px;
        }
        .bar-fill.academic { background: #1565C0; }
        .bar-fill.non      { background: #7b1fa2; }

        /* ── SIGNATURE ── */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
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

    {{-- ── FIXED HEADER ── --}}
    <div class="page-header">
        <span class="sys-name">SIPRES – Sistem Informasi Prestasi Siswa</span>
        <span class="doc-label">Laporan Statistik Nasional</span>
    </div>
    <div class="page-header-accent"></div>

    {{-- ── FIXED FOOTER ── --}}
    <div class="page-footer-accent"></div>
    <div class="page-footer">
        <span>Dicetak: {{ $date }}</span>
        <span>© {{ date('Y') }} SIPRES – Kementerian Pendidikan &amp; Kebudayaan</span>
        <span>Halaman <span class="pagenum"></span></span>
    </div>

    {{-- ── CONTENT ── --}}
    <div class="content">

        {{-- Kop Instansi --}}
        <div class="school-header">
            <h1>Kementerian Pendidikan &amp; Kebudayaan</h1>
            <div class="sub">Sistem Informasi Prestasi Siswa (SIPRES) &nbsp;|&nbsp; Laporan Data Nasional &nbsp;|&nbsp; sipres.kemdikbud.go.id</div>
        </div>

        {{-- Judul Laporan --}}
        <div class="report-title-box">LAPORAN STATISTIK NASIONAL – RINGKASAN DATA &amp; CAPAIAN PRESTASI SISWA</div>
        <div class="report-date">Dicetak pada: {{ $date }} &nbsp;|&nbsp; Status: Resmi / Internal &nbsp;|&nbsp; No. Dok: SIPRES/LAP/{{ date('Y') }}/001</div>

        {{-- ══════════════════════════════════
             1. STATISTIK NASIONAL (kompak)
             ══════════════════════════════════ --}}
        <div class="section-header">1. STATISTIK NASIONAL</div>

        <table class="stat-table">
            {{-- Baris 1 --}}
            <tr class="highlight">
                <td class="s-label">🏫 Total Sekolah</td>
                <td class="s-num">{{ $totalSekolah }}</td>
                <td class="s-sep"></td>
                <td class="s-label">🎓 Total Siswa</td>
                <td class="s-num">{{ $totalSiswa }}</td>
                <td class="s-sep"></td>
                <td class="s-label">👨‍🏫 Total Guru</td>
                <td class="s-num">{{ $totalGuru }}</td>
            </tr>
            {{-- Baris 2 --}}
            <tr>
                <td class="s-label">🗂️ Admin Sekolah</td>
                <td class="s-num">{{ $totalAdmin }}</td>
                <td class="s-sep"></td>
                <td class="s-label">🚪 Total Kelas</td>
                <td class="s-num">{{ $totalKelas }}</td>
                <td class="s-sep"></td>
                <td class="s-label">⚽ Total Eskul</td>
                <td class="s-num">{{ $totalEskul }}</td>
            </tr>
            {{-- Baris 3 --}}
            <tr class="highlight">
                <td class="s-label">🏆 Total Prestasi</td>
                <td class="s-num">{{ $totalPrestasi }}</td>
                <td class="s-sep"></td>
                <td class="s-label">✅ Terverifikasi</td>
                <td class="s-num" style="color:#1b7e3f">{{ $prestasiTerverifikasi }}</td>
                <td class="s-sep"></td>
                <td class="s-label">⏳ Pending Review</td>
                <td class="s-num" style="color:#e8932b">{{ $prestasiPending }}</td>
            </tr>
            {{-- Baris 4 --}}
            <tr>
                <td class="s-label">🌟 Minat Bakat</td>
                <td class="s-num">{{ $totalMinat }}</td>
                <td class="s-sep"></td>
                <td colspan="4" style="font-size:9px;color:#777;padding-left:14px;font-style:italic">
                    Data mencakup seluruh satuan pendidikan yang terdaftar aktif dalam sistem SIPRES pada periode laporan.
                </td>
            </tr>
        </table>

        {{-- ══════════════════════════════════
             2 & 3. PER TINGKAT & PER JENIS
             ══════════════════════════════════ --}}
        <div class="section-header">2. DISTRIBUSI PRESTASI PER TINGKAT &amp; PER JENIS</div>

        {{-- Dua tabel berdampingan pakai outer table --}}
        <table style="width:100%;border-collapse:collapse">
            <tr>
                {{-- Kiri: Per Tingkat --}}
                <td style="width:49%;vertical-align:top;padding-right:6px">
                    @php $tot = $prestasiPerTingkat->sum('total'); @endphp
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="text-align:left">Tingkat</th>
                                <th style="width:60px">Jumlah</th>
                                <th style="width:50px">%</th>
                                <th>Proporsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestasiPerTingkat as $i => $item)
                            @php
                                $pct = $tot > 0 ? round(($item->total / $tot) * 100, 1) : 0;
                                $lc  = ['intl','nas','prov','kab'][$i] ?? 'kab';
                            @endphp
                            <tr>
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
                            <tr class="total-row">
                                <td><strong>TOTAL</strong></td>
                                <td class="center">{{ $tot }}</td>
                                <td class="center">100%</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                {{-- Kanan: Per Jenis --}}
                <td style="width:49%;vertical-align:top;padding-left:6px">
                    @php $totJ = $prestasiPerJenis->sum('total'); @endphp
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="text-align:left">Jenis Prestasi</th>
                                <th style="width:60px">Jumlah</th>
                                <th style="width:50px">%</th>
                                <th>Proporsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestasiPerJenis as $item)
                            @php
                                $pct = $totJ > 0 ? round(($item->total / $totJ) * 100, 1) : 0;
                                $isAkad = $item->jenis_prestasi == 'akademik';
                            @endphp
                            <tr>
                                <td>
                                    <span class="badge {{ $isAkad ? 'badge-blue' : 'badge-purple' }}">
                                        {{ $isAkad ? '📘' : '🎨' }} {{ ucfirst($item->jenis_prestasi) }}
                                    </span>
                                </td>
                                <td class="center bold">{{ $item->total }}</td>
                                <td class="center">{{ $pct }}%</td>
                                <td>
                                    <div class="bar-wrap">
                                        <div class="bar-fill {{ $isAkad ? 'academic' : 'non' }}" style="width:{{ $pct }}%">{{ $pct }}%</div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="total-row">
                                <td><strong>TOTAL</strong></td>
                                <td class="center">{{ $totJ }}</td>
                                <td class="center">100%</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

        {{-- ══════════════════════════════════
             4. TREN PRESTASI PER TAHUN
             ══════════════════════════════════ --}}
        <div class="section-header">3. TREN PRESTASI PER TAHUN</div>

        @php $prevTotal = null; $totalTahun = $prestasiPerTahun->sum('total'); @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:30px">No</th>
                    <th style="width:70px">Tahun</th>
                    <th style="width:110px">Jumlah Prestasi</th>
                    <th style="width:100px">Perubahan</th>
                    <th style="width:80px">Status</th>
                    <th>Proporsi Tahun Ini</th>
                    <th style="width:130px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestasiPerTahun as $i => $item)
                @php
                    $pct = $totalTahun > 0 ? round(($item->total / $totalTahun) * 100, 1) : 0;
                    if ($prevTotal === null) {
                        $delta = null; $deltaPct = null;
                        $trenClass = 'trend-same'; $trenLabel = '—';
                        $statusBadge = 'badge-gold'; $statusText = 'Baseline';
                        $ket = 'Data tahun rujukan awal';
                    } elseif ($item->total > $prevTotal) {
                        $delta = $item->total - $prevTotal;
                        $deltaPct = $prevTotal > 0 ? round(($delta / $prevTotal) * 100, 1) : 0;
                        $trenClass = 'trend-up'; $trenLabel = '▲ +' . $delta . ' (+' . $deltaPct . '%)';
                        $statusBadge = 'badge-green'; $statusText = 'Naik';
                        $ket = 'Pertumbuhan positif';
                    } elseif ($item->total < $prevTotal) {
                        $delta = $prevTotal - $item->total;
                        $deltaPct = $prevTotal > 0 ? round(($delta / $prevTotal) * 100, 1) : 0;
                        $trenClass = 'trend-down'; $trenLabel = '▼ -' . $delta . ' (-' . $deltaPct . '%)';
                        $statusBadge = 'badge-red'; $statusText = 'Turun';
                        $ket = 'Perlu ditindaklanjuti';
                    } else {
                        $trenClass = 'trend-same'; $trenLabel = '— Sama';
                        $statusBadge = 'badge-gray'; $statusText = 'Stabil';
                        $ket = 'Tidak ada perubahan';
                    }
                    $prevTotal = $item->total;
                @endphp
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td class="center bold">{{ $item->tahun }}</td>
                    <td class="center bold">{{ number_format($item->total) }}</td>
                    <td class="center {{ $trenClass }}">{{ $trenLabel }}</td>
                    <td class="center">
                        <span class="badge {{ $statusBadge }}">{{ $statusText }}</span>
                    </td>
                    <td>
                        <div class="bar-wrap">
                            <div class="bar-fill" style="width:{{ $pct }}%">{{ $pct }}%</div>
                        </div>
                    </td>
                    <td style="font-size:9px;color:#555">{{ $ket }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ══════════════════════════════════
             5. 10 SEKOLAH DENGAN SISWA TERBANYAK
             ══════════════════════════════════ --}}
        <div class="section-header">4. 10 SEKOLAH DENGAN SISWA TERBANYAK</div>

        @php $maxS = $sekolahTeraktif->first()->siswa_count ?? 1; @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:30px">No</th>
                    <th style="text-align:left">Nama Sekolah</th>
                    <th style="width:90px">Jml Siswa</th>
                    <th style="width:80px">Prestasi</th>
                    <th>Proporsi Nasional</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sekolahTeraktif as $i => $s)
                @php
                    $pctBar = $maxS > 0 ? round(($s->siswa_count / $maxS) * 100) : 0;
                    $pctNas = $totalSiswa > 0 ? number_format(($s->siswa_count / $totalSiswa) * 100, 2) : 0;
                    $medal  = $i == 0 ? '🥇' : ($i == 1 ? '🥈' : ($i == 2 ? '🥉' : ($i + 1)));
                @endphp
                <tr>
                    <td class="center" style="font-weight:bold">{{ $medal }}</td>
                    <td style="font-weight:600;color:#1a3f6f">{{ $s->name }}</td>
                    <td class="center bold">{{ number_format($s->siswa_count) }}</td>
                    <td class="center">{{ number_format($s->prestasi_count ?? 0) }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:5px">
                            <div class="bar-wrap" style="flex:1">
                                <div class="bar-fill" style="width:{{ $pctBar }}%">{{ $pctNas }}%</div>
                            </div>
                            <span style="font-size:8.5px;color:#555;min-width:32px">{{ $pctNas }}%</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ── TANDA TANGAN ── --}}
        <table class="signature-table">
            <tr>
                <td>
                    Mengetahui,<br>
                    <strong>Kepala Biro Data &amp; Informasi</strong>
                    <div class="signature-line">(________________________________)</div>
                </td>
                <td class="spacer"></td>
                <td>
                    Jakarta, {{ $date }}<br>
                    <strong>Operator SIPRES Nasional</strong>
                    <div class="signature-line">(________________________________)</div>
                </td>
            </tr>
        </table>

    </div>{{-- end .content --}}

</body>
</html>
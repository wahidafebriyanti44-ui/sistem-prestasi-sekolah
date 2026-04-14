<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi SIPRES</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .otp-code {
            background: #f3f4f6;
            padding: 20px;
            border-radius: 12px;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #4f46e5;
            margin: 25px 0;
            font-family: monospace;
        }
        .info {
            color: #6b7280;
            font-size: 14px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SIPRES</h1>
            <p>Sistem Informasi Prestasi Siswa Indonesia</p>
        </div>
        
        <div class="content">
            <h2>Verifikasi Registrasi Sekolah</h2>
            
            @if($schoolName)
                <p>Halo, <strong>{{ $schoolName }}</strong></p>
            @endif
            
            <p>Terima kasih telah mendaftarkan sekolah Anda di SIPRES. Gunakan kode verifikasi berikut untuk melanjutkan registrasi:</p>
            
            <div class="otp-code">
                {{ $otp }}
            </div>
            
            <p>Kode ini berlaku selama <strong>10 menit</strong>. Jangan bagikan kode ini kepada siapa pun.</p>
            
            <p>Jika Anda tidak melakukan pendaftaran ini, abaikan email ini.</p>
            
            <div class="info">
                Email ini dikirim secara otomatis oleh sistem SIPRES.
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} SIPRES - Sistem Informasi Prestasi Siswa Indonesia</p>
            <p>Jl. Pendidikan No. 123, Jakarta</p>
        </div>
    </div>
</body>
</html>
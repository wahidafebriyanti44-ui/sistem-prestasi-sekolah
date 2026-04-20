<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SIPRES</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f0f2f5;
            line-height: 1.5;
        }
        
        .email-wrapper {
            max-width: 560px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
        }
        
        /* Header */
        .email-header {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            padding: 40px 40px 35px;
            text-align: center;
            position: relative;
        }
        
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 24px;
            border-radius: 50px;
            margin-bottom: 25px;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            color: #4f46e5;
        }
        
        .logo-text {
            color: white;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: -0.5px;
        }
        
        .email-header h1 {
            color: white;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
        }
        
        .email-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
        }
        
        /* Body */
        .email-body {
            padding: 40px;
        }
        
        .greeting {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        
        .message {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        /* Info Card - Password Otomatis */
        .info-card {
            background: #e0e7ff;
            border-left: 4px solid #4f46e5;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .info-card-title {
            font-weight: 700;
            color: #3730a3;
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        .info-card-text {
            font-size: 14px;
            color: #4338ca;
            line-height: 1.5;
        }
        
        /* Warning Card */
        .warning-card {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .warning-title {
            font-weight: 700;
            color: #92400e;
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        .warning-text {
            font-size: 14px;
            color: #b45309;
            line-height: 1.5;
        }
        
        /* Button */
        .btn-container {
            text-align: center;
            margin: 35px 0;
        }
        
        .btn-reset {
            display: inline-block;
            background: #4f46e5;
            color: white !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.2s;
        }
        
        /* Fallback Link */
        .fallback-box {
            background: #f9fafb;
            padding: 16px;
            border-radius: 12px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        
        .fallback-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        
        .fallback-url {
            font-size: 12px;
            color: #4f46e5;
            word-break: break-all;
            background: white;
            padding: 10px;
            border-radius: 8px;
            font-family: monospace;
        }
        
        .divider {
            text-align: center;
            margin: 30px 0 20px;
            position: relative;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        
        .divider span {
            background: white;
            padding: 0 15px;
            color: #9ca3af;
            font-size: 13px;
        }
        
        /* Footer */
        .email-footer {
            background: #f9fafb;
            padding: 25px 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-text {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }
        
        .copyright {
            color: #9ca3af;
            font-size: 11px;
        }
        
        @media (max-width: 600px) {
            .email-wrapper {
                margin: 20px;
                border-radius: 20px;
            }
            .email-header, .email-body, .email-footer {
                padding: 30px 20px;
            }
            .greeting {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">
                <div class="logo-icon">🏆</div>
                <span class="logo-text">SIPRES</span>
            </div>
            <h1>Reset Password</h1>
            <p>Sistem Informasi Prestasi Siswa</p>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Halo, {{ $nama_pengguna ?? 'Pengguna' }}!
            </div>
            
            <div class="message">
                Kami menerima permintaan untuk mereset password akun SIPRES Anda. Klik tombol di bawah ini untuk membuat password baru.
            </div>
            
            <!-- Info Penting tentang Password Otomatis -->
            <div class="info-card">
                <div class="info-card-title">📌 Password Otomatis dari Sistem</div>
                <div class="info-card-text">
                    Jika Anda adalah <strong>guru</strong> dan sebelumnya menerima password otomatis (seperti kode captcha), 
                    password tersebut akan <strong>TIDAK BERLAKU LAGI</strong> setelah Anda mengganti password baru.
                </div>
            </div>
            
            <!-- Warning -->
            <div class="warning-card">
                <div class="warning-title">⚠️ Perhatian!</div>
                <div class="warning-text">
                    Link reset password ini hanya berlaku selama <strong>60 menit</strong>. Setelah itu, Anda harus mengirim permintaan baru.
                </div>
            </div>
            
            <!-- Tombol Reset -->
            <div class="btn-container">
                <a href="{{ $actionUrl }}" class="btn-reset" style="color: white;">
                    Reset Password Sekarang
                </a>
            </div>
            
            <!-- Link Cadangan -->
            <div class="fallback-box">
                <div class="fallback-label">
                    Jika tombol di atas tidak berfungsi, copy URL berikut:
                </div>
                <div class="fallback-url">
                    {{ $actionUrl }}
                </div>
            </div>
            
            <div class="divider">
                <span>Tidak meminta reset password?</span>
            </div>
            
            <div class="message" style="font-size: 14px; text-align: center;">
                Jika Anda tidak merasa meminta reset password, abaikan email ini. 
                Password Anda akan tetap aman dan tidak berubah.
            </div>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-text">
                © {{ date('Y') }} SIPRES - Sistem Informasi Prestasi Siswa
            </div>
            <div class="copyright">
                Email dikirim oleh sistem otomatis. Mohon tidak membalas email ini.
            </div>
        </div>
    </div>
</body>
</html>
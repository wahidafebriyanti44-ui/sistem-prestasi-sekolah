<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            max-width: 800px;
            width: 90%;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 32px;
        }
        p {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-top: 20px;
        }
        .card h2 {
            margin: 0 0 15px 0;
            font-size: 24px;
        }
        .card p {
            color: white;
            margin: 10px 0;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background: white;
            color: #667eea;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: transform 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Siswa</h1>
        <p>Selamat datang, {{ Auth::user()->name ?? 'Siswa' }}</p>
        
        <div class="card">
            <h2>Profil Siswa</h2>
            <p>Halaman ini sedang dalam pengembangan</p>
            <p>Fitur untuk siswa akan segera hadir:</p>
            <p>• Lihat profil pribadi</p>
            <p>• Riwayat prestasi</p>
            <p>• Pengajuan prestasi</p>
            <p>• Ekstrakurikuler yang diikuti</p>
            <p>• Minat dan bakat</p>
            
            <a href="{{ route('logout') }}" class="btn" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</body>
</html>
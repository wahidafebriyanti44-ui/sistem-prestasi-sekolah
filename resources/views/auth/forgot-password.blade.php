<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Prestasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 30px;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 40px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1);
        }
        .btn-primary {
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .btn-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3 class="mb-2">Lupa Password?</h3>
            <p class="mb-0">Tenang, kami akan bantu mereset password Anda</p>
        </div>
        <div class="card-body">
            @if(session('status'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('status') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <p class="text-muted mb-4">
                Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" 
                           name="email" 
                           class="form-control" 
                           placeholder="Masukkan email Anda"
                           value="{{ old('email') }}"
                           required>
                </div>

                <button type="submit" class="btn btn-primary mb-3">
                    <i class="bi bi-send me-2"></i>Kirim Link Reset
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn-link">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
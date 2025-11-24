<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin SIPATUH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .split {
            display: flex;
            height: 100vh;
        }

        /* Bagian kiri dengan overlay gradien */
        .left-side {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1350&q=80') 
                        no-repeat center center;
            background-size: cover;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .left-side::after {
            content: "";
            position: absolute;
            top: 0; left: 0; 
            width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.85) 0%, rgba(29, 78, 216, 0.9) 100%);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            padding: 3rem;
            max-width: 600px;
        }

        .logo-section {
            margin-bottom: 2rem;
        }

        .logo-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }

        .welcome-content h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 4px 8px rgba(0,0,0,0.3);
            letter-spacing: -0.5px;
        }

        .welcome-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            opacity: 0.95;
        }

        .welcome-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features-list {
            margin-top: 2rem;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .feature-item i {
            font-size: 1.5rem;
            margin-right: 1rem;
            color: #93c5fd;
        }

        /* Bagian kanan */
        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #bfdbfe 100%);
            overflow: hidden;
        }

        /* Elemen dekoratif animasi */
        .right-side::before, .right-side::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            z-index: 1;
            animation: float 6s ease-in-out infinite;
        }
        .right-side::before {
            width: 300px; height: 300px;
            top: -80px; right: -80px;
        }
        .right-side::after {
            width: 400px; height: 400px;
            bottom: -120px; left: -120px;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Dekorasi tambahan */
        .decoration-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(96, 165, 250, 0.15) 0%, rgba(59, 130, 246, 0.15) 100%);
            z-index: 1;
        }

        .decoration-1 {
            width: 150px; height: 150px;
            top: 20%; right: 10%;
            animation: float 8s ease-in-out infinite;
        }

        .decoration-2 {
            width: 100px; height: 100px;
            bottom: 30%; left: 15%;
            animation: float 7s ease-in-out infinite;
            animation-delay: 2s;
        }

        .login-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.2);
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-icon {
            font-size: 3rem;
            color: #2563eb;
            margin-bottom: 1rem;
            display: inline-block;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .login-card h3 {
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            z-index: 3;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-check {
            padding-left: 1.75rem;
        }

        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            margin-top: 0.15rem;
            border: 2px solid #cbd5e1;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .form-check-label {
            color: #475569;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 0.9rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: #fff;
            padding: 0 1rem;
            color: #94a3b8;
            font-size: 0.85rem;
            position: relative;
            z-index: 2;
        }

        .text-link {
            text-align: center;
        }

        .text-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }

        .text-link a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        /* Responsif */
        @media(max-width: 992px) {
            .split {
                flex-direction: column;
            }
            .left-side {
                height: 35vh;
                min-height: 300px;
            }
            .welcome-content h1 {
                font-size: 2rem;
            }
            .welcome-content h2 {
                font-size: 1.2rem;
            }
            .features-list {
                display: none;
            }
        }

        @media(max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
            .welcome-content {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="split">
        <!-- Bagian kiri -->
        <div class="left-side">
            <div class="welcome-content">
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                <h1>SIPATUH</h1>
                <h2>Sistem Informasi Pelayanan Administrasi Terpadu</h2>
                <p>Platform digital yang memudahkan warga dalam mengakses berbagai layanan administrasi kependudukan secara online, cepat, dan efisien.</p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-clock"></i>
                        <span>Layanan 24/7 Online</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Data Aman & Terenkripsi</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-rocket"></i>
                        <span>Proses Cepat & Mudah</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian kanan -->
        <div class="right-side">
            <div class="decoration-circle decoration-1"></div>
            <div class="decoration-circle decoration-2"></div>
            
            <div class="login-card">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Login Admin Sipatuh</h3>
                    <p class="login-subtitle">Masuk ke akun Anda untuk mengakses layanan</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="input-group-custom">
                        <label for="email" class="form-label">Email</label>
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus
                               placeholder="nama@email.com">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="input-group-custom">
                        <label for="password" class="form-label">Password</label>
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required placeholder="Masukkan password">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Akun
                        </button>
                    </div>

                    {{-- Lupa Password --}}
                    @if (Route::has('password.request'))
                        <div class="divider">
                            <span>atau</span>
                        </div>
                        <div class="text-link">
                            <a href="{{ route('password.request') }}">
                                <i class="fas fa-key me-1"></i>Lupa Kata Sandi?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>
</html>
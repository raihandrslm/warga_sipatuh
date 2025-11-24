<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background Image with Overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                        url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1920&q=80') center/cover no-repeat;
            z-index: -2;
        }

        /* Animated Particles Background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float-particle linear infinite;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) scale(1);
                opacity: 0;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: row;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            padding: 4rem 3rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Gradient Overlay */
        .welcome-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            top: -50%;
            left: -50%;
            animation: rotate 25s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .welcome-section h1 {
            font-weight: 800;
            color: #fff;
            font-size: 2.8rem;
            margin-bottom: 1.2rem;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease-out 0.2s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-section p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            animation: fadeIn 1s ease-out 0.4s both;
        }

        .logo-container {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            padding: 30px;
            margin-top: 1.5rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            }
        }

        .logo-icon {
            font-size: 90px;
            color: white;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
        }

        .community-icons {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .community-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .community-icon:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.3);
        }

        .community-icon i {
            font-size: 28px;
            color: white;
        }

        .form-section {
            flex: 1;
            padding: 4rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
            position: relative;
        }

        /* Decorative Elements */
        .form-decoration {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd20, #0a58ca20);
            filter: blur(40px);
        }

        .decoration-1 {
            top: -50px;
            right: -50px;
        }

        .decoration-2 {
            bottom: -50px;
            left: -50px;
        }

        .form-section h4 {
            text-align: center;
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            font-weight: 800;
            font-size: 2rem;
            position: relative;
        }

        .form-subtitle {
            text-align: center;
            color: #718096;
            margin-bottom: 2.5rem;
            font-size: 1rem;
            position: relative;
        }

        .form-label {
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.8rem;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #0d6efd;
            font-size: 1.2rem;
            z-index: 1;
            transition: all 0.3s ease;
        }

        input.form-control {
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            color: #2d3748;
            padding: 1rem 1.2rem 1rem 3.5rem;
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        input.form-control:focus {
            background-color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 5px rgba(13, 110, 253, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        input.form-control::placeholder {
            color: #cbd5e0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            padding: 1rem;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(13, 110, 253, 0.6);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 15px;
            border: none;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .alert-danger {
            background-color: #fed7d7;
            color: #c53030;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 450px;
            }

            .welcome-section {
                padding: 3rem 2rem;
            }

            .welcome-section h1 {
                font-size: 2.2rem;
            }

            .form-section {
                padding: 3rem 2rem;
            }

            .community-icons {
                gap: 1rem;
            }

            .community-icon {
                width: 50px;
                height: 50px;
            }

            .community-icon i {
                font-size: 22px;
            }
        }

        /* Decorative circles on welcome section */
        .decorative-circles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            animation: float 6s ease-in-out infinite;
        }

        .circle-1 {
            width: 180px;
            height: 180px;
            top: -40px;
            right: -40px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 120px;
            height: 120px;
            bottom: 60px;
            left: -30px;
            animation-delay: 2s;
        }

        .circle-3 {
            width: 80px;
            height: 80px;
            top: 45%;
            right: 8%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }
    </style>
</head>
<body>

<!-- Animated Particles -->
<div class="particles" id="particles"></div>

<div class="login-container">
    <!-- Welcome Section -->
    <div class="welcome-section d-none d-md-flex">
        <div class="decorative-circles">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>
        <div class="welcome-content">
            <h1>🏘️ Selamat Datang!</h1>
            <p>Bergabunglah dengan komunitas warga digital.<br>Silakan login untuk mengakses Dashboard Warga</p>
            <div class="logo-container">
                <i class="fas fa-users logo-icon"></i>
            </div>
            <div class="community-icons">
                <div class="community-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="community-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <div class="community-icon">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Form -->
    <div class="form-section">
        <div class="form-decoration decoration-1"></div>
        <div class="form-decoration decoration-2"></div>
        
        <h4>Login Warga</h4>
        <p class="form-subtitle">Masukkan kredensial Anda untuk melanjutkan</p>

        <!-- Session Error (if exists) -->
        <div class="alert alert-danger text-center" style="display: none;">
            <i class="fas fa-exclamation-circle me-2"></i>Error message here
        </div>

        <form method="POST" action="{{ route('warga.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">
                    <i class="fas fa-id-card me-2"></i>NIK
                </label>
                <div class="input-group-custom">
                    <i class="fas fa-id-card input-icon"></i>
                    <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK Anda" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="nama" class="form-label">
                    <i class="fas fa-user me-2"></i>Nama
                </label>
                <div class="input-group-custom">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary fw-bold">
                    <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Create animated particles
    const particlesContainer = document.getElementById('particles');
    const particleCount = 30;

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 5 + 2;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        particle.style.animationDelay = Math.random() * 5 + 's';
        
        particlesContainer.appendChild(particle);
    }

    // Add input animation
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) {
                icon.style.transform = 'translateY(-50%) scale(1.2)';
                icon.style.color = '#0d6efd';
            }
        });
        
        input.addEventListener('blur', function() {
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) {
                icon.style.transform = 'translateY(-50%) scale(1)';
            }
        });
    });
</script>
</body>
</html>
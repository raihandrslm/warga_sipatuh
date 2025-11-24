<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SIPATUH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Nunito', sans-serif;
        }

        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.55);
        }

        .reset-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(14px);
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            color: #fff;
        }

        .reset-card h3 {
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 10px;
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            color: #fff;
        }

        ::placeholder {
            color: #ddd !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            border: none;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
            width: 100%;
            padding: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
        }

        .invalid-feedback {
            display: block;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="reset-card">
        <h3>🔑 Reset Password</h3>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div class="mb-3">
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ $email ?? old('email') }}" required
                       autocomplete="email" autofocus placeholder="Email Address">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password"
                       placeholder="Password Baru">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-3">
                <input id="password-confirm" type="password"
                       class="form-control"
                       name="password_confirmation" required
                       autocomplete="new-password" placeholder="Konfirmasi Password">
            </div>

            {{-- Tombol --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>
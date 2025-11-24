<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password - SIPATUH</title>
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
      position: absolute; top:0; left:0; width:100%; height:100%;
      background: rgba(0,0,0,0.55);
    }
    .card-glass {
      position: relative; z-index:2;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 2rem;
      max-width: 420px;
      color: #fff;
      box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    }
    .card-glass h3 {
      font-weight: bold; text-align:center; margin-bottom: 1rem;
    }
    .form-control {
      background: rgba(255,255,255,0.2); border: none;
      border-radius: 10px; color: #fff;
    }
    .form-control:focus { background: rgba(255,255,255,0.3); color:#fff; }
    ::placeholder { color:#ddd !important; }
    .btn-primary {
      background: linear-gradient(135deg,#ff9966,#ff5e62);
      border: none; border-radius:12px; font-weight: bold; width:100%;
    }
    .btn-primary:hover { transform:translateY(-2px); }
    .invalid-feedback { display:block; font-size:0.9rem; }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="card-glass">
    <h3>📩 Reset Password</h3>
    <p class="text-center mb-4">Masukkan email Anda, kami akan kirimkan link reset password.</p>

    @if (session('status'))
      <div class="alert alert-success text-center">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <input id="email" type="email"
          class="form-control @error('email') is-invalid @enderror"
          name="email" value="{{ old('email') }}" required
          autocomplete="email" autofocus placeholder="Alamat Email">
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
      </div>
    </form>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Password - SIPATUH</title>
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
      background: linear-gradient(135deg,#00c6ff,#0072ff);
      border: none; border-radius:12px; font-weight: bold; width:100%;
    }
    .btn-primary:hover { transform:translateY(-2px); }
    .btn-link { color:#00c6ff; text-decoration:none; }
    .btn-link:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="card-glass">
    <h3>🔑 Konfirmasi Password</h3>
    <p class="text-center mb-4">Silakan masukkan password Anda sebelum melanjutkan.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
      @csrf
      <div class="mb-3">
        <input id="password" type="password"
          class="form-control @error('password') is-invalid @enderror"
          name="password" required placeholder="Password">
        @error('password')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>
      <div class="d-grid mb-2">
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
      @if (Route::has('password.request'))
        <div class="text-center">
          <a class="btn-link" href="{{ route('password.request') }}">Lupa Password?</a>
        </div>
      @endif
    </form>
  </div>
</body>
</html>

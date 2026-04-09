<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Warga</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --blue-3:#4d8aff;
  --blue-4:#1a5fff;
  --blue-5:#0040cc;
  --blue-6:#002a8a;
  --text-dark:#e4ecff;
  --text-mid:#a0b4d6;
  --text-soft:#5a7299;
  --white:#ffffff;
  --bg:#0c1424;
  --card:#141f38;
  --card-border:rgba(77,138,255,.13);
  --success:#22c55e;
  --success-bg:rgba(34,197,94,.12);
  --danger:#f87171;
  --danger-bg:rgba(248,113,113,.12);
  --warning:#fbbf24;
  --warning-bg:rgba(251,191,36,.12);
  --shadow-sm:0 2px 12px rgba(0,0,0,.4);
  --shadow-md:0 8px 28px rgba(0,0,0,.5);
  --shadow-lg:0 20px 56px rgba(0,0,0,.6);
  --radius-sm:10px;
  --radius-md:16px;
  --radius-lg:24px;
}

body{
  font-family:'Plus Jakarta Sans',sans-serif;
  background:var(--bg);
  color:var(--text-dark);
  min-height:100vh;
  overflow-x:hidden;
}

body::before{
  content:'';
  position:fixed;
  inset:0;
  z-index:0;
  background:
    radial-gradient(ellipse 900px 700px at 5% 15%,rgba(26,95,255,.09) 0%,transparent 60%),
    radial-gradient(ellipse 700px 500px at 95% 85%,rgba(0,64,204,.10) 0%,transparent 60%),
    radial-gradient(ellipse 500px 400px at 55% 5%,rgba(77,138,255,.06) 0%,transparent 50%);
  pointer-events:none;
}

/* ── NAVBAR ── */
.navbar{
  position:sticky;
  top:0;
  z-index:100;
  background:rgba(10,16,36,.85);
  border-bottom:1px solid rgba(77,138,255,.15);
  backdrop-filter:blur(20px);
}
.navbar-inner{
  max-width:1100px;
  margin:0 auto;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:.9rem 1.5rem;
}
.nav-brand{
  display:flex;
  align-items:center;
  gap:.7rem;
  color:var(--white);
  font-size:1.15rem;
  font-weight:800;
  letter-spacing:-.02em;
}
.nav-icon{
  width:36px;
  height:36px;
  background:rgba(26,95,255,.25);
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:1.1rem;
  border:1px solid rgba(77,138,255,.25);
}
.btn-logout{
  background:rgba(26,95,255,.15);
  border:1.5px solid rgba(77,138,255,.3);
  color:var(--text-dark);
  font-size:.78rem;
  font-weight:600;
  padding:.4rem 1rem;
  border-radius:8px;
  cursor:pointer;
  transition:all .2s;
  font-family:inherit;
  letter-spacing:.01em;
}
.btn-logout:hover{background:rgba(26,95,255,.3);color:#fff}

/* ── MAIN ── */
.main{
  max-width:1100px;
  margin:0 auto;
  padding:2rem 1.5rem 3rem;
  position:relative;
  z-index:1;
}

/* ── HERO ── */
.hero{
  background:linear-gradient(135deg,rgba(26,95,255,.25) 0%,rgba(0,42,138,.35) 100%);
  border:1px solid rgba(77,138,255,.2);
  border-radius:var(--radius-lg);
  padding:2.5rem 2.5rem 2rem;
  margin-bottom:2rem;
  box-shadow:var(--shadow-lg);
  position:relative;
  overflow:hidden;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:1.5rem;
  backdrop-filter:blur(10px);
}
.hero::before{
  content:'';
  position:absolute;
  top:-60px;right:-60px;
  width:280px;height:280px;
  border-radius:50%;
  background:rgba(77,138,255,.07);
  pointer-events:none;
}
.hero::after{
  content:'';
  position:absolute;
  bottom:-80px;right:80px;
  width:200px;height:200px;
  border-radius:50%;
  background:rgba(26,95,255,.05);
  pointer-events:none;
}
.hero-text h2{
  color:#fff;
  font-size:1.7rem;
  font-weight:800;
  letter-spacing:-.03em;
  margin-bottom:.4rem;
}
.hero-text p{color:rgba(255,255,255,.5);font-size:.92rem;font-weight:500}
.hero-badge{
  background:rgba(26,95,255,.18);
  border:1px solid rgba(77,138,255,.25);
  border-radius:var(--radius-md);
  padding:1rem 1.4rem;
  text-align:center;
  white-space:nowrap;
  flex-shrink:0;
}
.hero-badge .label{
  color:rgba(255,255,255,.45);
  font-size:.72rem;
  font-weight:600;
  letter-spacing:.05em;
  text-transform:uppercase;
}
.hero-badge .value{
  color:#fff;
  font-size:1rem;
  font-weight:700;
  margin-top:.2rem;
  font-family:'DM Mono',monospace;
}

/* ── SECTION TITLE ── */
.section-title{
  font-size:.72rem;
  font-weight:700;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:var(--blue-3);
  margin-bottom:1rem;
  display:flex;
  align-items:center;
  gap:.5rem;
}
.section-title::after{
  content:'';
  flex:1;
  height:1px;
  background:rgba(77,138,255,.2);
}

/* ── CARD ── */
.card{
  background:var(--card);
  border-radius:var(--radius-md);
  box-shadow:var(--shadow-sm);
  margin-bottom:1.5rem;
  border:1px solid var(--card-border);
  overflow:hidden;
  transition:box-shadow .25s,transform .25s;
}
.card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px)}
.card-head{
  padding:1rem 1.4rem;
  background:rgba(26,95,255,.18);
  border-bottom:1px solid rgba(77,138,255,.15);
  display:flex;
  align-items:center;
  justify-content:space-between;
}
.card-head span{color:#c8d8ff;font-size:.88rem;font-weight:700;letter-spacing:.01em}
.card-body{padding:1.2rem 1.4rem}

/* ── DATA PRIBADI ── */
.pribadi-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.pribadi-item{
  background:rgba(26,95,255,.08);
  border-radius:var(--radius-sm);
  padding:1rem 1.1rem;
  border:1px solid rgba(77,138,255,.12);
}
.pribadi-item .lbl{
  font-size:.7rem;
  font-weight:700;
  letter-spacing:.07em;
  text-transform:uppercase;
  color:var(--text-soft);
  margin-bottom:.3rem;
}
.pribadi-item .val{
  font-size:.95rem;
  font-weight:600;
  color:var(--text-dark);
  font-family:'DM Mono',monospace;
}

/* ── TABLE ── */
.tbl{width:100%;border-collapse:collapse;font-size:.85rem}
.tbl thead tr th{
  background:rgba(26,95,255,.2);
  color:#a0b4d6;
  font-size:.73rem;
  font-weight:700;
  letter-spacing:.05em;
  text-transform:uppercase;
  padding:.75rem 1rem;
  text-align:left;
  border-bottom:1px solid rgba(77,138,255,.2);
}
.tbl thead tr th:last-child{text-align:center}
.tbl tbody tr{border-bottom:1px solid rgba(77,138,255,.08);transition:background .15s}
.tbl tbody tr:last-child{border-bottom:none}
.tbl tbody tr:hover{background:rgba(26,95,255,.08)}
.tbl td{padding:.75rem 1rem;color:var(--text-mid);font-weight:500;vertical-align:middle}
.tbl td:last-child{text-align:center}
.amount-cell{font-family:'DM Mono',monospace;color:var(--blue-3);font-weight:600}
.no-cell{color:var(--text-soft)}
.name-cell{font-weight:600;color:var(--text-dark)}

/* ── BADGES ── */
.badge{
  display:inline-flex;
  align-items:center;
  gap:.3rem;
  padding:.28rem .75rem;
  border-radius:20px;
  font-size:.72rem;
  font-weight:700;
  letter-spacing:.02em;
}
.badge-success{background:var(--success-bg);color:var(--success)}
.badge-danger{background:var(--danger-bg);color:var(--danger)}
.badge-warning{background:var(--warning-bg);color:var(--warning)}
.badge-secondary{background:rgba(100,116,139,.15);color:#94a3b8}

/* ── BUTTONS ── */
.btn{
  font-family:inherit;
  font-size:.78rem;
  font-weight:700;
  border-radius:8px;
  padding:.4rem .95rem;
  cursor:pointer;
  transition:all .2s;
  border:none;
  letter-spacing:.01em;
}
.btn-pay{
  background:linear-gradient(135deg,#16a34a,#15803d);
  color:#fff;
  box-shadow:0 3px 8px rgba(22,163,74,.2);
}
.btn-pay:hover{transform:translateY(-1px);box-shadow:0 5px 14px rgba(22,163,74,.3)}
.btn-paid{background:var(--success-bg);color:var(--success);cursor:default}
.btn-primary-sm{
  background:rgba(26,95,255,.2);
  border:1.5px solid rgba(77,138,255,.35);
  color:#c8d8ff;
  font-size:.75rem;
  padding:.32rem .85rem;
  border-radius:7px;
  cursor:pointer;
  font-family:inherit;
  font-weight:700;
  transition:all .2s;
}
.btn-primary-sm:hover{background:rgba(26,95,255,.35);color:#fff}

/* ── HISTORY SCROLL ── */
.history-scroll{
  display:flex;
  gap:1rem;
  overflow-x:auto;
  padding-bottom:.5rem;
  scrollbar-width:thin;
  scrollbar-color:rgba(77,138,255,.3) transparent;
}
.history-scroll::-webkit-scrollbar{height:4px}
.history-scroll::-webkit-scrollbar-track{background:transparent}
.history-scroll::-webkit-scrollbar-thumb{background:rgba(77,138,255,.3);border-radius:10px}
.h-card{
  min-width:200px;
  flex-shrink:0;
  background:rgba(26,95,255,.08);
  border:1px solid rgba(77,138,255,.14);
  border-radius:var(--radius-md);
  padding:1.1rem 1.2rem;
  transition:all .25s;
}
.h-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-md);border-color:rgba(77,138,255,.3)}
.h-card .h-name{font-size:.82rem;font-weight:700;color:var(--text-dark);margin-bottom:.3rem}
.h-card .h-month{font-size:.72rem;color:var(--text-soft);font-weight:500;margin-bottom:.5rem}
.h-card .h-amount{font-size:1rem;font-weight:700;color:var(--blue-3);font-family:'DM Mono',monospace;margin-bottom:.5rem}

/* ── EMPTY STATE ── */
.empty{text-align:center;padding:2.5rem 1rem;color:var(--text-soft)}
.empty .icon{font-size:2.2rem;margin-bottom:.6rem}
.empty .msg{font-size:.9rem;font-weight:600;color:var(--text-mid);margin-bottom:.25rem}
.empty small{font-size:.77rem;line-height:1.5}

/* ── MODAL OVERRIDE (Bootstrap dark) ── */
.modal-content{
  background:var(--card) !important;
  border:1px solid rgba(77,138,255,.2) !important;
  border-radius:var(--radius-lg) !important;
  color:var(--text-dark);
}
.modal-header{
  border-bottom:1px solid rgba(77,138,255,.15) !important;
  padding:1.4rem 1.6rem 1rem;
}
.modal-title{font-size:1.05rem;font-weight:800;color:var(--text-dark)}
.modal-body{padding:1.2rem 1.6rem}
.modal-footer{
  border-top:1px solid rgba(77,138,255,.15) !important;
  padding:.9rem 1.6rem 1.4rem;
}
.form-label{
  font-size:.78rem;
  font-weight:700;
  color:var(--text-mid);
  margin-bottom:.4rem;
  letter-spacing:.02em;
}
.form-select{
  background-color:rgba(26,95,255,.1) !important;
  border:1.5px solid rgba(77,138,255,.25) !important;
  border-radius:9px !important;
  color:var(--text-dark) !important;
  font-family:inherit;
  font-size:.88rem;
}
.form-select:focus{
  border-color:var(--blue-3) !important;
  box-shadow:0 0 0 3px rgba(26,95,255,.15) !important;
}
.form-select option{background:#1a2540;color:#e4ecff}
.btn-secondary{
  background:rgba(255,255,255,.05) !important;
  color:var(--text-mid) !important;
  border:1.5px solid rgba(77,138,255,.2) !important;
  font-weight:600 !important;
}
.btn-secondary:hover{background:rgba(255,255,255,.1) !important}
.btn-primary{
  background:linear-gradient(135deg,var(--blue-4),var(--blue-5)) !important;
  border:none !important;
  color:#fff !important;
  font-weight:700 !important;
  box-shadow:0 4px 12px rgba(26,95,255,.25) !important;
}
.btn-primary:hover{box-shadow:0 6px 18px rgba(26,95,255,.35) !important;transform:translateY(-1px)}
.btn-close{filter:invert(1) opacity(.5)}

/* ── RESPONSIVE ── */
@media(max-width:640px){
  .hero{flex-direction:column;text-align:center}
  .hero-badge{width:100%}
  .pribadi-grid{grid-template-columns:1fr}
  .hero-text h2{font-size:1.35rem}
}
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
  <div class="navbar-inner">
    <div class="nav-brand">
      <div class="nav-icon">🏘️</div>
      Dashboard Warga
    </div>
    <form action="{{ route('warga.logout') }}" method="GET"
          onsubmit="return confirm('Yakin ingin logout?')">
      <button type="submit" class="btn-logout">⎋ Logout</button>
    </form>
  </div>
</nav>

<div class="main">

  {{-- HERO --}}
  <div class="hero">
    <div class="hero-text">
      <h2>Selamat Datang, {{ $warga->nama }} 👋</h2>
      <p>Kelola dan pantau iuran Anda dengan mudah</p>
    </div>
    <div class="hero-badge">
      <div class="label">Status Warga</div>
      <div class="value">Aktif ✓</div>
    </div>
  </div>

  {{-- DATA PRIBADI --}}
  <div class="section-title">Data Pribadi</div>
  <div class="card">
    <div class="card-body">
      <div class="pribadi-grid">
        <div class="pribadi-item">
          <div class="lbl">NIK</div>
          <div class="val">{{ $warga->nik }}</div>
        </div>
        <div class="pribadi-item">
          <div class="lbl">Alamat</div>
          <div class="val">{{ $warga->alamat ?? '-' }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- DAFTAR IURAN --}}
  <div class="section-title">Daftar Iuran</div>
  <div class="card">
    <div class="card-head">
      <span>📋 Daftar Iuran Anda</span>
    </div>
    <div class="card-body" style="padding:0">
      <div style="overflow-x:auto">
        <table class="tbl">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Iuran</th>
              <th>Jumlah Bayar</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($transaksi as $index => $t)
              <tr>
                <td class="no-cell">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td class="name-cell">{{ $t->iuran?->nama_iuran }}</td>
                <td class="amount-cell">Rp {{ number_format($t->jumlah_bayar,0,',','.') }}</td>
                <td>
                  @if ($t->status_bayar === 'lunas')
                    <span class="badge badge-success">✓ Lunas</span>
                  @else
                    <span class="badge badge-danger">✗ Belum</span>
                  @endif
                </td>
                <td class="no-cell">{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                <td>
                  @if ($t->status_bayar !== 'lunas')
                    <form action="{{ route('warga.transaksi.bayar', $t->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-pay">Bayar</button>
                    </form>
                  @else
                    <button class="btn btn-paid" disabled>Sudah Lunas</button>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                  <div class="empty">
                    <div class="icon">📋</div>
                    <div class="msg">Belum ada data iuran</div>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- HISTORY PEMBAYARAN --}}
  <div class="section-title">History Pembayaran Per Bulan</div>
  <div class="card">
    <div class="card-head">
      <span>🗓️ History Pembayaran Iuran Per Bulan</span>
    </div>
    <div class="card-body">
      <div class="history-scroll">
        @forelse ($historyIuran as $h)
          <div class="h-card">
            <div class="h-name">{{ $h->iuran?->nama_iuran }}</div>
            <div class="h-month">{{ \Carbon\Carbon::parse($h->bulan)->translatedFormat('F Y') }}</div>
            <div class="h-amount">Rp {{ number_format($h->jumlah_bayar,0,',','.') }}</div>
            @if ($h->status_bayar === 'lunas')
              <span class="badge badge-success">✓ Lunas</span>
            @else
              <span class="badge badge-danger">✗ Belum</span>
            @endif
          </div>
        @empty
          <div class="empty" style="width:100%">
            <div class="icon">🗓️</div>
            <div class="msg">Belum ada history pembayaran</div>
          </div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- BANSOS --}}
  <div class="section-title">Bantuan Sosial</div>
  <div class="card">
    <div class="card-head">
      <span>📦 Data Penerima Bansos</span>
    </div>
    <div class="card-body" style="padding:0">
      <div style="overflow-x:auto">
        <table class="tbl">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Bansos</th>
              <th>Tanggal Terima</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($penerimaBansos as $index => $p)
              <tr>
                <td class="no-cell">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td class="name-cell">{{ $p->bansos?->nama_program }}</td>
                <td class="no-cell">{{ \Carbon\Carbon::parse($p->tanggal_terima)->format('d-m-Y') }}</td>
                <td>
                  @if ($p->status === 'diterima')
                    <span class="badge badge-success">✓ Diterima</span>
                  @else
                    <span class="badge badge-danger">✗ Belum</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="empty">
                    <div class="icon">📦</div>
                    <div class="msg">Belum ada data bansos</div>
                    <small>Jika Anda mendapat Bantuan Sosial maka akan muncul di sini.<br>
                    Bantuan Sosial hanya diberikan kepada warga yang Kurang Mampu.</small>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- SURAT WARGA --}}
  <div class="section-title">Pengajuan Surat</div>
  <div class="card">
    <div class="card-head">
      <span>📩 Pengajuan Surat Saya</span>
      <button class="btn-primary-sm" data-bs-toggle="modal" data-bs-target="#modalAjukanSurat">
        + Ajukan Surat
      </button>
    </div>
    <div class="card-body" style="padding:0">
      <div style="overflow-x:auto">
        <table class="tbl">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis Surat</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($suratWarga as $i => $s)
              <tr>
                <td class="no-cell">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td class="name-cell">{{ $s->jenis_surat }}</td>
                <td>
                  @if ($s->status === 'selesai')
                    <span class="badge badge-success">✓ Selesai</span>
                  @elseif ($s->status === 'diproses')
                    <span class="badge badge-warning">⏳ Diproses</span>
                  @elseif ($s->status === 'ditolak')
                    <span class="badge badge-danger">✗ Ditolak</span>
                  @else
                    <span class="badge badge-secondary">📨 Diajukan</span>
                  @endif
                </td>
                <td class="no-cell">{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y H:i') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="empty">
                    <div class="icon">📩</div>
                    <div class="msg">Belum ada data surat</div>
                    <small>Jika Anda membuat permohonan surat, maka akan tampil di sini.</small>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

{{-- MODAL AJUKAN SURAT --}}
<div class="modal fade" id="modalAjukanSurat" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form action="{{ route('warga.surat.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">📩 Ajukan Surat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="warga_id" value="{{ auth('warga')->id() }}">

          <label class="form-label">Jenis Surat</label>
          <select name="jenis_surat" class="form-select" required>
            <option disabled selected>Pilih Jenis Surat</option>
            <option value="Domisili">Surat Keterangan Domisili</option>
            <option value="Pindah">Surat Pindah / Menjadi Warga</option>
            <option value="Usaha">Surat Keterangan Usaha</option>
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Ajukan</button>
        </div>

      </form>
    </div>
  </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
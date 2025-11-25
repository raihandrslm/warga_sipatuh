<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #0a58ca;
            --success-color: #198754;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
        }
        body {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.7)),
                        url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1920&q=80')
                        center/cover fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .welcome-card {
            background: linear-gradient(135deg, rgba(13,110,253,0.95), rgba(10,88,202,0.95));
            color: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: none;
            overflow: hidden;
            transition: 0.3s;
        }
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.1rem 1.4rem;
            font-weight: 600;
        }
        .table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        .history-scroll {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding-bottom: 10px;
        }
        .history-item {
            min-width: 220px;
            background: white;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: 0.3s;
        }
        .history-item:hover {
            transform: translateY(-5px);
        }
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <span class="navbar-brand fw-bold">Dashboard Warga</span>

            <form action="{{ route('warga.logout') }}" method="GET"
                  onsubmit="return confirm('Yakin ingin logout?')">
                <button type="submit" class="btn btn-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container py-5">

        {{-- Welcome --}}
        <center>
            <div class="welcome-card">
                <h2 class="fw-bold">Selamat Datang, {{ $warga->nama }}</h2>
                <p class="mb-0">Kelola dan pantau iuran Anda dengan mudah</p>
            </div>
        </center>

        {{-- Data Pribadi --}}
        <div class="info-card mb-4">
            <div class="card-header-custom">Data Pribadi</div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>NIK :</strong> {{ $warga->nik }}</li>
                    <li class="list-group-item"><strong>Alamat :</strong> {{ $warga->alamat ?? '-' }}</li>
                </ul>
            </div>
        </div>

        {{-- TABEL IURAN --}}
        <div class="info-card mb-4">
            <div class="card-header-custom">Daftar Iuran Anda</div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Iuran</th>
                                <th>Jumlah Bayar</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $index => $t)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $t->iuran?->nama_iuran }}</td>
                                    <td>Rp {{ number_format($t->jumlah_bayar,0,',','.') }}</td>

                                    <td>
                                        @if ($t->status_bayar === 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-danger">Belum</span>
                                        @endif
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>

                                    <td class="text-center">
                                        @if ($t->status_bayar !== 'lunas')
                                            <form action="{{ route('warga.transaksi.bayar', $t->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-success btn-sm">Bayar</button>
                                            </form>
                                        @else
                                            <button class="btn btn-success btn-sm" disabled>Sudah Lunas</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="empty-state">Belum ada data iuran</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- HISTORY PEMBAYARAN --}}
        <div class="info-card mb-4">
            <div class="card-header-custom">History Pembayaran Iuran Per Bulan</div>

            <div class="card-body">
                <div class="history-scroll">
                    @forelse ($historyIuran as $h)
                        <div class="history-item">
                            <h6 class="fw-bold mb-1">{{ $h->iuran?->nama_iuran }}</h6>
                            <div class="text-muted">
                                Bulan: <strong>{{ \Carbon\Carbon::parse($h->bulan)->translatedFormat('F Y') }}</strong>
                            </div>
                            <div class="mt-2">Rp {{ number_format($h->jumlah_bayar,0,',','.') }}</div>
                            <div class="mt-2">
                                @if ($h->status_bayar === 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-muted text-center w-100">Belum ada history pembayaran</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- BANSOS --}}
        <div class="info-card mb-4">
            <div class="card-header-custom">Data Penerima Bansos</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
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
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->bansos?->nama_program }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_terima)->format('d-m-Y') }}</td>

                                    <td>
                                        @if ($p->status === 'diterima')
                                            <span class="badge bg-success">Diterima</span>
                                        @else
                                            <span class="badge bg-danger">Belum</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">
                                        <div>📦</div>
                                        <div class="fw-semibold">Belum ada data bansos</div>
                                        <small>Jika Anda mendapat Bantuan Sosial maka akan muncul di sini.</small><br>
                                        <small>Bantuan Sosial hanya diberikan kepada warga yang Kurang Mampu.</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- SURAT WARGA --}}
        <div class="info-card mb-4">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span>Pengajuan Surat Saya</span>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalAjukanSurat">
                    + Ajukan Surat
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
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
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $s->jenis_surat }}</td>
                                    <td>
                                        @if ($s->status === 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif ($s->status === 'diproses')
                                            <span class="badge bg-warning">Diproses</span>
                                        @elseif ($s->status === 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-secondary">Diajukan</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">
                                        <div>📩</div>
                                        <div class="fw-semibold">Belum ada data surat</div>
                                        <small>Jika Anda membuat permohonan surat, maka akan tampil di sini.</small><br>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                            <h5 class="modal-title">Ajukan Surat</h5>
                        </div>

                        <div class="modal-body">

                            <input type="hidden" name="warga_id" value="{{ auth('warga')->id() }}">

                            <div class="mb-3">
                                <label class="form-label">Jenis Surat</label>
                                <select name="jenis_surat" class="form-select" required>
                                    <option disabled selected>Pilih Jenis Surat</option>
                                    <option value="Domisili">Surat Keterangan Domisili</option>
                                    <option value="Pindah">Surat Pindah / Menjadi Warga</option>
                                    <option value="Usaha">Surat Keterangan Usaha</option>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Transaksi Iuran</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
             + Tambah Data
            </button>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warga</th>
                        <th>Iuran</th>
                        <th>Harga Iuran</th>
                        <th>Status Bayar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $index => $t)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $t->warga?->nama ?? '-' }}</td>
                        <td>{{ $t->iuran?->nama_iuran ?? '-' }}</td>
                        <td>Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>
                            @if ($t->status_bayar === 'lunas')
                                <span class="badge bg-success-subtle text-success">Lunas</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">Belum Bayar</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y H:i') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $t->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.transaksi_iuran.destroy', $t) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $t->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.transaksi_iuran.update', $t) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Transaksi</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Warga</label>
                                            <select class="form-select" name="warga_id" required>
                                                <option disabled>Pilih Warga</option>
                                                @foreach ($warga as $w)
                                                    <option value="{{ $w->id }}" {{ $t->warga_id == $w->id ? 'selected' : '' }}>
                                                        {{ $w->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Iuran</label>
                                            <select class="form-select" name="iuran_id" required>
                                                <option disabled>Pilih Iuran</option>
                                                @foreach ($iuran as $i)
                                                    <option value="{{ $i->id }}" {{ $t->iuran_id == $i->id ? 'selected' : '' }}>
                                                        {{ $i->nama_iuran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Harga Iuran</label>
                                            <input type="number" name="jumlah_bayar" class="form-control" value="{{ $t->jumlah_bayar }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="datetime-local" name="tanggal" class="form-control" 
                                                   value="{{ \Carbon\Carbon::parse($t->tanggal)->format('Y-m-d\TH:i') }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.transaksi_iuran.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Warga</label>
                        <select class="form-select" name="warga_id" required>
                            <option selected disabled>Pilih Warga</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->id }}">{{ $w->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Iuran</label>
                        <select class="form-select" name="iuran_id" required>
                            <option selected disabled>Pilih Iuran</option>
                            @foreach ($iuran as $i)
                                <option value="{{ $i->id }}">{{ $i->nama_iuran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Harga Iuran</label>
                        <input type="number" name="jumlah_bayar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="datetime-local" name="tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new simpleDatatables.DataTable(document.querySelector('#table1'));
    });
</script>
@endpush

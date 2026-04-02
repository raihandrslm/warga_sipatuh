@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Transaksi Iuran</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Data
            </button>
        </div>

        <div class="card-body">

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.transaksi_iuran.index') }}">
                <div class="row g-2 align-items-end mb-4">

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status Pembayaran</label>
                        <select name="status_bayar" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="lunas"
                                {{ request('status_bayar') == 'lunas' ? 'selected' : '' }}>
                                Lunas
                            </option>
                            <option value="belum"
                                {{ request('status_bayar') == 'belum' ? 'selected' : '' }}>
                                Belum Bayar
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            Filter
                        </button>

                        <a href="{{ route('admin.transaksi_iuran.index') }}"
                           class="btn btn-secondary px-4 rounded-pill">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

            {{-- TABLE --}}
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Warga</th>
                        <th>Iuran</th>
                        <th>Harga Iuran</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($transaksi as $index => $t)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $t->warga?->nama }}</td>
                        <td>{{ $t->iuran?->nama_iuran }}</td>
                        <td>Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</td>

                        <td>
                            <span class="{{ $t->status_bayar == 'lunas' ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                {{ $t->status_bayar == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </td>

                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y H:i') }}</td>

                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $t->id }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.transaksi_iuran.destroy', $t) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEdit{{ $t->id }}" tabindex="-1">
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
                                                @foreach ($warga as $w)
                                                    <option value="{{ $w->id }}"
                                                        {{ $t->warga_id == $w->id ? 'selected' : '' }}>
                                                        {{ $w->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Iuran</label>
                                            <select class="form-select iuran-select"
                                                    data-target="hargaEdit{{ $t->id }}"
                                                    name="iuran_id" required>
                                                @foreach ($iuran as $i)
                                                    <option value="{{ $i->id }}"
                                                            data-harga="{{ $i->harga }}"
                                                            {{ $t->iuran_id == $i->id ? 'selected' : '' }}>
                                                        {{ $i->nama_iuran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Harga Iuran</label>
                                            <input type="number"
                                                   id="hargaEdit{{ $t->id }}"
                                                   class="form-control"
                                                   readonly
                                                   value="{{ $t->jumlah_bayar }}">
                                        </div>

                                        <div class="mb-3">
                                            <label>Status Bayar</label>
                                            <select name="status_bayar" class="form-select" required>
                                                <option value="belum" {{ $t->status_bayar == 'belum' ? 'selected' : '' }}>
                                                    Belum Bayar
                                                </option>
                                                <option value="lunas" {{ $t->status_bayar == 'lunas' ? 'selected' : '' }}>
                                                    Lunas
                                                </option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="datetime-local"
                                                   name="tanggal"
                                                   class="form-control"
                                                   value="{{ \Carbon\Carbon::parse($t->tanggal)->format('Y-m-d\TH:i') }}"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary">Simpan</button>
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

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
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
                            @foreach ($warga as $w)
                                <option value="{{ $w->id }}">{{ $w->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Iuran</label>
                        <select class="form-select iuran-select"
                                data-target="hargaTambah"
                                name="iuran_id" required>
                            <option selected disabled>Pilih Iuran</option>
                            @foreach ($iuran as $i)
                                <option value="{{ $i->id }}" data-harga="{{ $i->harga }}">
                                    {{ $i->nama_iuran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Harga Iuran</label>
                        <input type="number" id="hargaTambah" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="datetime-local" name="tanggal" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    new simpleDatatables.DataTable('#table1');

    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('iuran-select')) {
            const harga = e.target.options[e.target.selectedIndex].dataset.harga;
            const target = e.target.dataset.target;
            const input = document.getElementById(target);
            if (input) input.value = harga ?? '';
        }
    });

});
</script>
@endpush

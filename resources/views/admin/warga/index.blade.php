@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Warga</h5>
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

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.warga.index') }}">
                <div class="row mb-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Status Keluarga</label>
                        <select name="status_keluarga" class="form-select">
                            <option value="">Semua</option>
                            @foreach ($status_keluarga as $sk)
                                <option value="{{ $sk->id }}"
                                    {{ request('status_keluarga') == $sk->id ? 'selected' : '' }}>
                                    {{ $sk->klasifikasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Filter
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary w-100">
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
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Status Keluarga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warga as $index => $w)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $w->nik }}</td>
                        <td>{{ $w->nama }}</td>
                        <td>{{ $w->alamat }}</td>
                        <td>{{ $w->status_keluarga?->klasifikasi ?? '-' }}</td>
                        <td>{{ $w->status }}</td>
                        <td>
                            <a href="{{ route('admin.warga.show', $w->id) }}" class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ $w->id }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.warga.destroy', $w) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEdit{{ $w->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.warga.update', $w) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Warga</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>NIK</label>
                                            <input type="text" name="nik" class="form-control" value="{{ $w->nik }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $w->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="{{ $w->alamat }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Status Keluarga</label>
                                            <select class="form-select" name="status_keluarga_id" required>
                                                @foreach ($status_keluarga as $sk)
                                                    <option value="{{ $sk->id }}"
                                                        {{ $w->status_keluarga_id == $sk->id ? 'selected' : '' }}>
                                                        {{ $sk->klasifikasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select class="form-select" name="status" required>
                                                @foreach (['Sudah Menikah','Belum Menikah','Cerai','Duda','Janda','Pelajar'] as $st)
                                                    <option value="{{ $st }}" {{ $w->status == $st ? 'selected' : '' }}>
                                                        {{ $st }}
                                                    </option>
                                                @endforeach
                                            </select>
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
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.warga.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Warga</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status Keluarga</label>
                        <select class="form-select" name="status_keluarga_id" required>
                            @foreach ($status_keluarga as $sk)
                                <option value="{{ $sk->id }}">{{ $sk->klasifikasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-select" name="status" required>
                            @foreach (['Sudah Menikah','Belum Menikah','Cerai','Duda','Janda','Pelajar'] as $st)
                                <option value="{{ $st }}">{{ $st }}</option>
                            @endforeach
                        </select>
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
document.addEventListener('DOMContentLoaded', () => {
    new simpleDatatables.DataTable("#table1");
});
</script>
@endpush

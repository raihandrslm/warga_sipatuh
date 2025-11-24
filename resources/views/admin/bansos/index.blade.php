@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Bansos</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Bansos
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Deskripsi</th>
                        <th>Kriteria</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bansos as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_program }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->kriteria }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.bansos.destroy', $item->id) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
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
            <form action="{{ route('admin.bansos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bansos</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Program</label>
                        <input type="text" name="nama_program" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Kriteria</label>
                        <textarea name="kriteria" class="form-control" rows="3"></textarea>
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

<!-- Modal Edit (loop di luar tabel biar rapi) -->
@foreach ($bansos as $item)
<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.bansos.update', $item->id) }}" method="POST">
                @csrf
                {{-- Pastikan method PUT terkirim --}}
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Bansos</h5>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Program</label>
                        <input type="text" 
                               name="nama_program" 
                               value="{{ old('nama_program', $item->nama_program) }}" 
                               class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <input type="text" 
                               name="deskripsi" 
                               value="{{ old('deskripsi', $item->deskripsi) }}" 
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Kriteria</label>
                        <textarea name="kriteria" 
                                  class="form-control" 
                                  rows="3">{{ old('kriteria', $item->kriteria) }}</textarea>
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

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new simpleDatatables.DataTable(document.querySelector('#table1'));
    });
</script>
@endpush

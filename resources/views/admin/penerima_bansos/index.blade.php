@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Penerima Bansos</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
             + Tambah Penerima
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
                        <th>Nama Warga</th>
                        <th>Program Bansos</th>
                        <th>Tanggal Terima</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penerima_bansos as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->warga->nama ?? '-' }}</td>
                        <td>{{ $p->bansos->nama_program ?? '-' }}</td>
                        <td>{{ $p->tanggal_terima ? \Carbon\Carbon::parse($p->tanggal_terima)->format('d-m-Y') : '-' }}</td>
                        <td>
                            @if ($p->status === 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif ($p->status === 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Diajukan</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $p->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.penerima_bansos.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.penerima_bansos.update', $p) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Penerima Bansos</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama Warga</label>
                                            <select name="warga_id" class="form-control" required>
                                                @foreach($warga as $w)
                                                    <option value="{{ $w->id }}" {{ $p->warga_id == $w->id ? 'selected' : '' }}>
                                                        {{ $w->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Program Bansos</label>
                                            <select name="bansos_id" class="form-control" required>
                                                @foreach($bansos as $b)
                                                    <option value="{{ $b->id }}" {{ $p->bansos_id == $b->id ? 'selected' : '' }}>
                                                        {{ $b->nama_program }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal Terima</label>
                                            <input type="date" name="tanggal_terima" value="{{ $p->tanggal_terima ? \Carbon\Carbon::parse($p->tanggal_terima)->format('Y-m-d') : '' }}" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="diajukan" {{ $p->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                                <option value="diterima" {{ $p->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="ditolak" {{ $p->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
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
            <form action="{{ route('admin.penerima_bansos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penerima Bansos</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Warga</label>
                        <select name="warga_id" class="form-control" required>
                            @foreach($warga as $w)
                                <option value="{{ $w->id }}">{{ $w->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Program Bansos</label>
                        <select name="bansos_id" class="form-control" required>
                            @foreach($bansos as $b)
                                <option value="{{ $b->id }}">{{ $b->nama_program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Terima</label>
                        <input type="date" name="tanggal_terima" class="form-control">
                    </div>
                    {{-- ⚠️ Status dihapus, biar otomatis dari controller --}}
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
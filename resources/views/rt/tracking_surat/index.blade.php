@extends('layouts.rt')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Tracking Surat (RT)</h5>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                + Tambah Tracking
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
                        <th>Jenis Surat</th>
                        <th>Status</th>
                        <th>Tanggal Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tracking_surat as $index => $ts)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ts->surat?->warga?->nama ?? '-' }}</td>
                        <td>{{ $ts->surat?->jenis_surat ?? '-' }}</td>
                        <td>
                            @if ($ts->status === 'diajukan')
                                <span class="badge bg-secondary">Diajukan</span>
                            @elseif ($ts->status === 'diproses')
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @elseif ($ts->status === 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif ($ts->status === 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($ts->tanggal_update)->format('d-m-Y H:i') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEdit{{ $ts->id }}">
                                Edit
                            </button>
                            <form action="{{ route('rt.tracking_surat.destroy', $ts) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin hapus tracking ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $ts->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('rt.tracking_surat.update', $ts) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Tracking</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Surat</label>
                                            <select class="form-select" name="surat_id" required>
                                                <option disabled>Pilih Surat</option>
                                                @foreach ($surat as $s)
                                                    <option value="{{ $s->id }}" {{ $ts->surat_id == $s->id ? 'selected' : '' }}>
                                                        {{ $s->warga?->nama }} - {{ $s->jenis_surat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select class="form-select" name="status" required>
                                                <option value="diajukan" {{ $ts->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                                <option value="diproses" {{ $ts->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="ditolak" {{ $ts->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                <option value="selesai" {{ $ts->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal Update</label>
                                            <input type="datetime-local" name="tanggal_update" class="form-control" 
                                                   value="{{ \Carbon\Carbon::parse($ts->tanggal_update)->format('Y-m-d\TH:i') }}" required>
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
            <form action="{{ route('rt.tracking_surat.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tracking</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Surat</label>
                        <select class="form-select" name="surat_id" required>
                            <option selected disabled>Pilih Surat</option>
                            @foreach ($surat as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->warga?->nama }} - {{ $s->jenis_surat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-select" name="status" required>
                            <option value="diajukan">Diajukan</option>
                            <option value="diproses">Diproses</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Update</label>
                        <input type="datetime-local" name="tanggal_update" class="form-control" 
                               value="{{ now()->format('Y-m-d\TH:i') }}" required>
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

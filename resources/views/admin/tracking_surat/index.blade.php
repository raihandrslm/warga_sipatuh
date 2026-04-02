@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Tracking Surat</h5>
        </div>

        <div class="card-body">

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.tracking_surat.index') }}">
                <div class="row g-2 align-items-end mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status Surat</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button class="btn btn-primary px-4 rounded-pill">Filter</button>
                        <a href="{{ route('admin.tracking_surat.index') }}"
                           class="btn btn-secondary px-4 rounded-pill">Reset</a>
                    </div>
                </div>
            </form>

            {{-- TABLE --}}
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
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $ts->id }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.tracking_surat.destroy', $ts) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus tracking ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEdit{{ $ts->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.tracking_surat.update', $ts) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- WAJIB ADA -->
                                <input type="hidden" name="surat_id" value="{{ $ts->surat_id }}">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Status Surat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select name="status" class="form-select">
                                                <option value="diajukan" {{ $ts->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                                <option value="diproses" {{ $ts->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="ditolak" {{ $ts->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                <option value="selesai" {{ $ts->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Tanggal Update</label>
                                            <input type="datetime-local" name="tanggal_update"
                                                value="{{ \Carbon\Carbon::parse($ts->tanggal_update)->format('Y-m-d\TH:i') }}"
                                                class="form-control">
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new simpleDatatables.DataTable(document.querySelector('#table1'));
});
</script>
@endpush
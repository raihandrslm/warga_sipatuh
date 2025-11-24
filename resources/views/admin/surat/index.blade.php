@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Surat</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
             + Tambah Surat
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
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surat as $index => $s)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $s->warga?->nama ?? '-' }}</td>
                        <td>{{ $s->jenis_surat }}</td>
                        <td>
                            @if ($s->status === 'selesai')
                                <span class="badge bg-success-subtle text-success">Selesai</span>
                            @elseif ($s->status === 'diproses')
                                <span class="badge bg-warning-subtle text-warning">Diproses</span>
                            @elseif ($s->status === 'ditolak')
                                <span class="badge bg-danger-subtle text-danger">Ditolak</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Diajukan</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y H:i') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $s->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.surat.destroy', $s) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin hapus surat ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $s->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.surat.update', $s->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Surat</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Warga</label>
                                            <select class="form-select" name="warga_id" required>
                                                <option disabled>Pilih Warga</option>
                                                @foreach ($warga as $w)
                                                    <option value="{{ $w->id }}" {{ $s->warga_id == $w->id ? 'selected' : '' }}>
                                                        {{ $w->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Jenis Surat</label>
                                            <select name="jenis_surat" class="form-select" required>
                                                <option disabled>Pilih Jenis Surat</option>
                                                <option value="Domisili" {{ $s->jenis_surat == 'Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                                                <option value="Pindah" {{ $s->jenis_surat == 'Pindah' ? 'selected' : '' }}>Surat Pindah / Menjadi Warga</option>
                                                <option value="Usaha" {{ $s->jenis_surat == 'Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
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
            <form action="{{ route('admin.surat.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Surat</h5>
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
                        <label>Jenis Surat</label>
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

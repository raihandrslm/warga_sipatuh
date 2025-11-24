@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Table Survey Status</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Survey
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
                        <th>Pendapatan</th>
                        <th>Pekerjaan</th>
                        <th>Kondisi Rumah</th>
                        <th>Jumlah Anggota</th>
                        <th>Kwh Listrik</th>
                        <th>Foto</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($survey_status as $index => $s)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $s->warga?->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($s->pendapatan, 0, ',', '.') }}</td>
                        <td>{{ $s->pekerjaan }}</td>
                        <td>
                            @if ($s->kondisi_rumah)
                                <img src="{{ asset('storage/' . $s->kondisi_rumah) }}" width="60" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $s->jumlah_anggota }} orang</td>
                        <td>{{ $s->kwh_listrik }}</td>
                        <td>
                            @if ($s->foto)
                                <img src="{{ asset('storage/' . $s->foto) }}" width="60" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y H:i') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $s->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.survey_status.destroy', $s) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin hapus survey ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $s->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('admin.survey_status.update', $s->id) }}" 
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Survey</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
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
                                            <div class="col-md-6 mb-3">
                                                <label>Pendapatan</label>
                                                <input type="number" name="pendapatan" class="form-control" value="{{ $s->pendapatan }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Pekerjaan</label>
                                                <input type="text" name="pekerjaan" class="form-control" value="{{ $s->pekerjaan }}" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Foto Kondisi Rumah</label>
                                                <input type="file" name="kondisi_rumah" class="form-control" required>
                                                @if ($s->kondisi_rumah)
                                                    <small class="d-block mt-1">Foto saat ini:</small>
                                                    <img src="{{ asset('storage/' . $s->kondisi_rumah) }}" width="100" class="img-thumbnail mt-2">
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Jumlah Anggota</label>
                                                <input type="number" name="jumlah_anggota" class="form-control" value="{{ $s->jumlah_anggota }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Kwh Listrik</label>
                                                <input type="text" name="kwh_listrik" class="form-control" value="{{ $s->kwh_listrik }}" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Foto</label>
                                                <input type="file" name="foto" class="form-control">
                                                @if ($s->foto)
                                                    <small class="d-block mt-1">Foto saat ini:</small>
                                                    <img src="{{ asset('storage/' . $s->foto) }}" width="100" class="img-thumbnail mt-2">
                                                @endif
                                            </div>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.survey_status.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Survey</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Warga</label>
                            <select class="form-select" name="warga_id" required>
                                <option selected disabled>Pilih Warga</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->id }}">{{ $w->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pendapatan</label>
                            <input type="number" name="pendapatan" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kondisi Rumah</label>
                            <input type="file" name="kondisi_rumah" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jumlah Anggota</label>
                            <input type="number" name="jumlah_anggota" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kwh Listrik</label>
                            <input type="text" name="kwh_listrik" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" required>
                        </div>
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

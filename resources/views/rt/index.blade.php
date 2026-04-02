@extends('layouts.rt')

@section('content')

{{-- HEADER (TIDAK DIUBAH) --}}
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Selamat Datang di Halaman Petugas</h3>
                <h6 class="font-weight-normal mb-0">
                    All systems Sipatuh running smoothly! You are
                    <span class="text-primary">Petugas!</span>
                </h6>
            </div>
        </div>
    </div>
</div>

{{-- STATISTIK TRACKING SURAT --}}
<div class="container mt-4">
    <div class="row g-3">

        {{-- Surat Diajukan --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card bg-secondary text-white h-100 shadow-sm">
                <div class="card-body p-4">
                    <i class="fa-solid fa-file-circle-plus fs-3"></i>
                    <h3 class="mt-3 mb-0">{{ $suratDiajukan }}</h3>
                    <p class="mb-0">Surat Diajukan</p>
                </div>
            </div>
        </div>

        {{-- Surat Diproses --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card bg-warning text-white h-100 shadow-sm">
                <div class="card-body p-4">
                    <i class="fa-solid fa-spinner fs-3"></i>
                    <h3 class="mt-3 mb-0">{{ $suratDiproses }}</h3>
                    <p class="mb-0">Sedang Diproses</p>
                </div>
            </div>
        </div>

        {{-- Surat Selesai --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card bg-success text-white h-100 shadow-sm">
                <div class="card-body p-4">
                    <i class="fa-solid fa-circle-check fs-3"></i>
                    <h3 class="mt-3 mb-0">{{ $suratSelesai }}</h3>
                    <p class="mb-0">Surat Selesai</p>
                </div>
            </div>
        </div>

        {{-- Surat Ditolak --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card bg-danger text-white h-100 shadow-sm">
                <div class="card-body p-4">
                    <i class="fa-solid fa-circle-xmark fs-3"></i>
                    <h3 class="mt-3 mb-0">{{ $suratDitolak }}</h3>
                    <p class="mb-0">Surat Ditolak</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

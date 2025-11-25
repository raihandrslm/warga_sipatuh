@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Selamat Datang di Halaman Admin</h3>
                <h6 class="font-weight-normal mb-0">
                    All systems Sipatuh running smoothly! You are
                    <span class="text-primary">Admin!</span>
                </h6>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row g-3">

        {{-- Jumlah Warga --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.warga.index') }}" class="text-decoration-none">
                <div class="card bg-primary text-white h-100 shadow-sm">
                    <div class="card-body p-4">
                        <span><i class="fa-solid fa-users fs-3 text-white"></i></span>
                        <h3 class="mt-3 mb-0">{{ number_format($jumlahWarga) }}</h3>
                        <p class="fs-6 mb-0 text-white">Jumlah Warga</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Jumlah Surat --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.surat.index') }}" class="text-decoration-none">
                <div class="card bg-success text-white h-100 shadow-sm">
                    <div class="card-body p-4">
                        <span><i class="fa-solid fa-envelope fs-3 text-white"></i></span>
                        <h3 class="mt-3 mb-0">{{ number_format($jumlahSurat) }}</h3>
                        <p class="fs-6 mb-0 text-white">Jumlah Surat</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Jumlah Iuran --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.iuran.index') }}" class="text-decoration-none">
                <div class="card bg-warning text-white h-100 shadow-sm">
                    <div class="card-body p-4">
                        <span><i class="fa-solid fa-money-bill-wave fs-3 text-white"></i></span>
                        <h3 class="mt-3 mb-0">{{ number_format($jumlahIuran) }}</h3>
                        <p class="fs-6 mb-0 text-white">Jumlah Iuran</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Jumlah Penerima Bansos --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.penerima_bansos.index') }}" class="text-decoration-none">
                <div class="card bg-danger text-white h-100 shadow-sm">
                    <div class="card-body p-4">
                        <span><i class="fa-solid fa-gift fs-3 text-white"></i></span>
                        <h3 class="mt-3 mb-0">{{ number_format($jumlahBansos) }}</h3>
                        <p class="fs-6 mb-0 text-white">Penerima Bansos</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Warga</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
                        url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920&q=80') center/cover fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container-detail {
            max-width: 950px;
            margin: 50px auto;
            padding: 0 20px;
        }
        
        .card {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 25px 30px;
            border-bottom: 3px solid #4a90e2;
        }
        
        .card-header h4 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .card-body {
            padding: 35px 40px;
        }
        
        h5.fw-bold {
            color: #1e3c72;
            border-left: 4px solid #4a90e2;
            padding-left: 15px;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }
        
        .card-body p {
            font-size: 1.05rem;
            margin-bottom: 12px;
            color: #333;
        }
        
        .card-body p strong {
            color: #1e3c72;
            font-weight: 600;
            display: inline-block;
            min-width: 160px;
        }
        
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(to right, #4a90e2, transparent);
            margin: 30px 0;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        
        .table thead {
            background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
            color: white;
        }
        
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background-color: #e3f2fd;
            transform: scale(1.01);
        }
        
        .table td {
            padding: 14px;
            border-color: #e0e0e0;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #5a6c7d 0%, #34495e 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
        }
        
        /* Animasi fade in */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            .container-detail {
                margin: 20px auto;
            }
            
            .card-body {
                padding: 25px 20px;
            }
            
            .card-body p strong {
                min-width: auto;
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="container container-detail">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Keluarga : {{ $warga->nama }}</h4>
        </div>

        <div class="card-body">

            <h5 class="fw-bold">Data Warga</h5>
            <p><strong>NIK : </strong> {{ $warga->nik }}</p>
            <p><strong>Nama : </strong> {{ $warga->nama }}</p>
            <p><strong>Alamat : </strong> {{ $warga->alamat }}</p>
            <p><strong>Status Keluarga : </strong> {{ $warga->status_keluarga?->klasifikasi }}</p>
            <p><strong>Status : </strong> {{ $warga->status }}</p>

            <hr>

            <h5 class="fw-bold">Anggota Keluarga {{ $warga->nama }}</h5>
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keluarga as $k)
                    <tr>
                        <td>{{ $k->nama }}</td>
                        <td>{{ $k->nik }}</td>
                        <td>{{ $k->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary mt-3">
                &larr; Kembali
            </a>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
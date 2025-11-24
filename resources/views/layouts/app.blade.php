<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            background: #0d6efd;
            color: #fff;
            padding-top: 1rem;
            position: fixed;
            width: 240px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: bold;
            padding: 0 20px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand mb-4">
                <i class="bi bi-speedometer2"></i> Admin Panel
            </div>
            <a href="" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            <a href="" class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Data Warga
            </a>
            <a href="" class="{{ request()->routeIs('rt.*') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i> Data RT
            </a>
            <a href="" class="{{ request()->routeIs('iuran.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i> Iuran
            </a>
            <a href="" class="{{ request()->routeIs('surat.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Surat
            </a>
            <a href="" class="{{ request()->routeIs('bansos.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Bansos
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Main Content -->
        <div class="content flex-grow-1">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    
</body>
</html>

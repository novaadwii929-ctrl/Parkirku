<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Petugas - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f1f5fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #123b75;
            color: white;
            padding: 25px 18px;
            overflow-y: auto;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 35px;
            padding-left: 10px;
        }

        .brand i {
            color: #72c5ff;
            margin-right: 8px;
        }

        .menu-title {
            font-size: 11px;
            color: #a9c5e9;
            margin: 22px 10px 10px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            color: #dceaff;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 7px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2874c7;
            color: white;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .logout-form {
            margin-top: 25px;
        }

        .logout-form button {
            width: 100%;
            border: none;
            background: #a83242;
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-align: left;
        }

        .logout-form button:hover {
            background: #872635;
        }

        .main {
            margin-left: 250px;
            padding: 25px;
        }

        .topbar {
            background: white;
            padding: 17px 22px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            margin-bottom: 25px;
        }

        .welcome {
            background: linear-gradient(120deg, #1456a0, #3188df);
            color: white;
            padding: 30px;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .welcome h3 {
            font-weight: bold;
        }

        .stat-card {
            background: white;
            border-radius: 13px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            height: 100%;
            border-left: 4px solid #2874c7;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e3f0ff;
            color: #1767b5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 15px;
        }

        .stat-card h3 {
            font-weight: bold;
            color: #173b69;
        }

        .section-card {
            background: white;
            border-radius: 13px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            height: 100%;
        }

        .quick-menu {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 16px;
            border: 1px solid #e5edf7;
            border-radius: 10px;
            color: #17477f;
            text-decoration: none;
            margin-bottom: 12px;
            transition: .2s;
        }

        .quick-menu:hover {
            background: #edf6ff;
            border-color: #8bbdec;
            transform: translateY(-2px);
        }

        .quick-menu i {
            font-size: 27px;
            color: #2678c9;
        }

        .info-item {
            padding: 12px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .guide-box {
            background: #eaf4ff;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .guide-number {
            background: #2874c7;
            color: white;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

            .topbar {
                gap: 10px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="brand">
        <i class="bi bi-p-square-fill"></i> ParkirKu
    </div>

    <div class="menu-title">Menu Utama</div>

    <a href="{{ url('/petugas/dashboard') }}" class="active">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <a href="{{ url('/petugas/transaksi') }}">
        <i class="bi bi-receipt"></i> Transaksi Parkir
    </a>

    <div class="menu-title">Akun</div>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>

</aside>

<!-- MAIN CONTENT -->
<main class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>
            <h5 class="mb-1 fw-bold">Dashboard Petugas</h5>
            <small class="text-secondary">
                Sistem Informasi Pengelolaan Parkir
            </small>
        </div>

        <div class="text-end">
            <strong>{{ auth()->user()->name }}</strong>
            <br>
            <small class="text-primary">Petugas Parkir</small>
        </div>

    </div>

    <!-- WELCOME -->
    <div class="welcome">

        <h3>
            <i class="bi bi-person-circle me-2"></i>
            Selamat Datang, {{ auth()->user()->name }}!
        </h3>

        <p class="mb-2">
            Selamat bekerja. Kelola seluruh aktivitas kendaraan
            dan transaksi parkir melalui menu Transaksi Parkir.
        </p>

        <small>
            <i class="bi bi-calendar3 me-2"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </small>

    </div>

    <!-- STATISTIK -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-car-front-fill"></i>
                </div>

                <p class="text-secondary mb-1">Transaksi Hari Ini</p>
                <h3>{{ $transaksiHariIni ?? 0 }}</h3>

                <small class="text-secondary">
                    Jumlah kendaraan tercatat
                </small>

            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <p class="text-secondary mb-1">Sedang Parkir</p>
                <h3>{{ $sedangParkir ?? 0 }}</h3>

                <small class="text-secondary">
                    Kendaraan belum keluar
                </small>

            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">

                <div class="stat-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <p class="text-secondary mb-1">Selesai Hari Ini</p>
                <h3>{{ $selesaiHariIni ?? 0 }}</h3>

                <small class="text-secondary">
                    Transaksi telah selesai
                </small>

            </div>
        </div>

    </div>

    <!-- MENU TRANSAKSI DAN INFORMASI PETUGAS -->
    <div class="row g-3 mb-4">

        <!-- MENU TRANSAKSI -->
        <div class="col-lg-6">

            <div class="section-card">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-grid-fill text-primary me-2"></i>
                    Menu Transaksi
                </h5>

                <a href="{{ url('/petugas/transaksi') }}" class="quick-menu">

                    <i class="bi bi-receipt-cutoff"></i>

                    <div>
                        <strong>Transaksi Parkir</strong>

                        <div class="small text-secondary">
                            Kelola kendaraan masuk, kendaraan keluar,
                            dan cetak struk parkir.
                        </div>
                    </div>

                    <i class="bi bi-arrow-right ms-auto"></i>

                </a>

            </div>

        </div>

        <!-- INFORMASI PETUGAS -->
        <div class="col-lg-6">

            <div class="section-card">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-person-badge-fill text-primary me-2"></i>
                    Informasi Petugas
                </h5>

                <div class="info-item">
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    <strong>Nama:</strong>
                    {{ auth()->user()->name }}
                </div>

                <div class="info-item">
                    <i class="bi bi-envelope text-primary me-2"></i>
                    <strong>Email:</strong>
                    {{ auth()->user()->email }}
                </div>

                <div class="info-item">
                    <i class="bi bi-shield-check text-primary me-2"></i>
                    <strong>Hak Akses:</strong>
                    Petugas
                </div>

                <div class="info-item">
                    <i class="bi bi-calendar-check text-primary me-2"></i>
                    <strong>Tanggal:</strong>
                    {{ date('d-m-Y') }}
                </div>

            </div>

        </div>

    </div>

    <!-- PANDUAN KERJA -->
    <div class="section-card">

        <h5 class="fw-bold mb-3">
            <i class="bi bi-info-circle-fill text-primary me-2"></i>
            Panduan Penggunaan Sistem
        </h5>

        <div class="guide-box mb-0">

            <span class="guide-number">1</span>

            <strong>Transaksi Parkir</strong>

            <p class="ms-5 mb-0 text-secondary small">
                Kelola pencatatan kendaraan masuk, proses kendaraan keluar,
                perhitungan biaya parkir, dan cetak struk melalui menu
                Transaksi Parkir.
            </p>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center text-secondary mt-4">

        <small>
            © {{ date('Y') }} ParkirKu - Sistem Informasi Pengelolaan Parkir
        </small>

    </div>

</main>

</body>
</html>
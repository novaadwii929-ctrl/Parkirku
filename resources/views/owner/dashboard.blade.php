<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Owner - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { margin:0; background:#f1f5fb; font-family:Arial,sans-serif; }
        .sidebar {
            width:250px; height:100vh; position:fixed; top:0; left:0;
            background:#123b75; color:white; padding:25px 18px;
        }
        .brand { font-size:23px; font-weight:bold; margin-bottom:35px; padding-left:10px; }
        .brand i { color:#72c5ff; margin-right:8px; }
        .menu-title { font-size:11px; color:#a9c5e9; margin:22px 10px 10px; }
        .sidebar a {
            display:block; color:#dceaff; text-decoration:none;
            padding:12px 14px; border-radius:8px; margin-bottom:7px;
        }
        .sidebar a:hover, .sidebar a.active { background:#2874c7; color:white; }
        .sidebar a i { margin-right:10px; }
        .main { margin-left:250px; padding:25px; }
        .topbar, .stat-card, .section-card {
            background:white; border-radius:13px;
            box-shadow:0 3px 12px rgba(0,0,0,.04);
        }
        .topbar {
            padding:17px 22px; display:flex; justify-content:space-between;
            align-items:center; margin-bottom:25px;
        }
        .welcome {
            background:linear-gradient(120deg,#1456a0,#3188df);
            color:white; padding:28px; border-radius:14px; margin-bottom:25px;
        }
        .stat-card { padding:22px; height:100%; }
        .stat-icon {
            width:48px; height:48px; border-radius:12px;
            background:#e3f0ff; color:#1767b5;
            display:flex; align-items:center; justify-content:center;
            font-size:23px; margin-bottom:15px;
        }
        .stat-card h3 { font-weight:bold; color:#173b69; }
        .section-card { padding:22px; }
        .logout-form { margin-top:25px; }
        .logout-form button {
            width:100%; border:0; background:#a83242; color:white;
            padding:12px; border-radius:8px; text-align:left;
        }
        @media(max-width:768px) {
            .sidebar { width:100%; height:auto; position:relative; }
            .main { margin-left:0; padding:15px; }
            .topbar { flex-wrap:wrap; gap:10px; }
        }
        @media print {
            .sidebar, .topbar .no-print, .filter-form, .print-button { display:none !important; }
            .main { margin:0; padding:0; }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand"><i class="bi bi-p-square-fill"></i> ParkirKu</div>

    <div class="menu-title">Menu Owner</div>
    <a href="{{ url('/owner/dashboard') }}" class="active">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="{{ url('/owner/laporan') }}">
        <i class="bi bi-file-earmark-bar-graph"></i> Laporan Transaksi
    </a>

    <div class="menu-title">Akun</div>
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
    </form>
</aside>

<main class="main">
    <div class="topbar">
        <div>
            <h5 class="mb-1 fw-bold">Dashboard Owner</h5>
            <small class="text-secondary">Ringkasan Pengelolaan Parkir</small>
        </div>
        <div class="text-end">
            <strong>{{ auth()->user()->name }}</strong><br>
            <small class="text-primary">Owner</small>
        </div>
    </div>

    <div class="welcome">
        <h3>Selamat Datang, {{ auth()->user()->name }}!</h3>
        <p class="mb-0">Pantau transaksi dan pendapatan parkir melalui dashboard Owner.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-car-front-fill"></i></div>
                <p class="text-secondary mb-1">Kendaraan Selesai Hari Ini</p>
                <h3>{{ $totalKendaraanHariIni ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                <p class="text-secondary mb-1">Pendapatan Hari Ini</p>
                <h3 class="fs-4">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                <p class="text-secondary mb-1">Kendaraan Sedang Parkir</p>
                <h3>{{ $sedangParkir ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <div>
                <h5 class="fw-bold mb-1">Laporan Transaksi</h5>
                <small class="text-secondary">Lihat laporan sesuai periode yang diinginkan.</small>
            </div>
            <a href="{{ url('/owner/laporan') }}" class="btn btn-primary">
                <i class="bi bi-file-earmark-text me-1"></i> Buka Laporan
            </a>
        </div>

        <hr>

        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="text-secondary mb-0">
                    Gunakan halaman laporan untuk memilih tanggal mulai dan tanggal akhir,
                    melihat jumlah transaksi, total pendapatan, serta mencetak laporan.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <i class="bi bi-bar-chart-line-fill text-primary" style="font-size:55px"></i>
            </div>
        </div>
    </div>

    <div class="text-center text-secondary mt-4">
        <small>© {{ date('Y') }} ParkirKu - Sistem Informasi Parkir</small>
    </div>
</main>
</body>
</html>
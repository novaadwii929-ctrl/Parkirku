<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - ParkirKu</title>

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
        .section-card { padding:22px; height:100%; }
        .quick-menu {
            display:flex; align-items:center; gap:13px; padding:14px;
            border:1px solid #e5edf7; border-radius:10px;
            color:#17477f; text-decoration:none; margin-bottom:11px;
        }
        .quick-menu:hover { background:#edf6ff; border-color:#8bbdec; }
        .quick-menu i { font-size:24px; color:#2678c9; }
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
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand"><i class="bi bi-p-square-fill"></i> ParkirKu</div>

    <div class="menu-title">Menu Utama</div>
    <a href="{{ url('/admin/dashboard') }}" class="active">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="{{ url('/admin/users') }}">
        <i class="bi bi-people"></i> Data User
    </a>
    <a href="{{ url('/admin/tarifs') }}">
        <i class="bi bi-cash-stack"></i> Tarif Parkir
    </a>
    <a href="{{ url('/admin/areas') }}">
        <i class="bi bi-geo-alt"></i> Area Parkir
    </a>
    <a href="{{ url('/admin/kendaraans') }}">
        <i class="bi bi-car-front"></i> Data Kendaraan
    </a>
    <a href="{{ url('/admin/log-aktivitas') }}">
        <i class="bi bi-clock-history"></i> Log Aktivitas
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
            <h5 class="mb-1 fw-bold">Dashboard Admin</h5>
            <small class="text-secondary">Sistem Informasi Pengelolaan Parkir</small>
        </div>
        <div class="text-end">
            <strong>{{ auth()->user()->name }}</strong><br>
            <small class="text-primary">Administrator</small>
        </div>
    </div>

    <div class="welcome">
        <h3>Selamat Datang, {{ auth()->user()->name }}!</h3>
        <p class="mb-0">Kelola data dan pantau aktivitas sistem parkir melalui halaman admin.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <p class="text-secondary mb-1">Total User</p>
                <h3>{{ $totalUser ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                <p class="text-secondary mb-1">Jenis Tarif</p>
                <h3>{{ $totalTarif ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-geo-alt-fill"></i></div>
                <p class="text-secondary mb-1">Area Aktif</p>
                <h3>{{ $totalArea ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-car-front-fill"></i></div>
                <p class="text-secondary mb-1">Kendaraan</p>
                <h3>{{ $totalKendaraan ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="section-card">
                <h5 class="fw-bold mb-3">Pengelolaan Data</h5>

                <a href="{{ url('/admin/users') }}" class="quick-menu">
                    <i class="bi bi-people"></i>
                    <div><strong>Kelola User</strong><div class="small text-secondary">Tambah, ubah, dan hapus pengguna</div></div>
                </a>
                <a href="{{ url('/admin/tarifs') }}" class="quick-menu">
                    <i class="bi bi-cash-stack"></i>
                    <div><strong>Kelola Tarif</strong><div class="small text-secondary">Atur tarif setiap jenis kendaraan</div></div>
                </a>
                <a href="{{ url('/admin/areas') }}" class="quick-menu">
                    <i class="bi bi-geo-alt"></i>
                    <div><strong>Kelola Area Parkir</strong><div class="small text-secondary">Atur area dan kapasitas parkir</div></div>
                </a>
                <a href="{{ url('/admin/kendaraans') }}" class="quick-menu">
                    <i class="bi bi-car-front"></i>
                    <div><strong>Kelola Kendaraan</strong><div class="small text-secondary">Kelola data kendaraan</div></div>
                </a>
                <a href="{{ url('/admin/log-aktivitas') }}" class="quick-menu">
                    <i class="bi bi-clock-history"></i>
                    <div><strong>Log Aktivitas</strong><div class="small text-secondary">Lihat aktivitas pengguna sistem</div></div>
                </a>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="section-card">
                <h5 class="fw-bold mb-3">Informasi Admin</h5>
                <p class="text-secondary"><i class="bi bi-person-circle text-primary me-2"></i>{{ auth()->user()->name }}</p>
                <p class="text-secondary"><i class="bi bi-envelope text-primary me-2"></i>{{ auth()->user()->email }}</p>
                <p class="text-secondary"><i class="bi bi-shield-check text-primary me-2"></i>Hak Akses: Admin</p>
            </div>
        </div>
    </div>

    <div class="text-center text-secondary mt-4">
        <small>© {{ date('Y') }} ParkirKu - Sistem Informasi Parkir</small>
    </div>
</main>
</body>
</html>
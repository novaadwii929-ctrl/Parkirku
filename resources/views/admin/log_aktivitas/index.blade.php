<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Aktivitas - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f5ff;
        }

        .navbar {
            background-color: #0d47a1;
        }

        .page-title {
            color: #0d47a1;
        }

        .card {
            border-radius: 12px;
        }

        .card-header {
            background-color: #1565c0;
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }

        .table thead th {
            background-color: #1976d2;
            color: white;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .btn-back {
            background-color: white;
            color: #0d47a1;
            border: none;
        }

        .btn-back:hover {
            background-color: #e3f2fd;
            color: #0d47a1;
        }

        footer {
            color: #64748b;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            ParkirKu
        </a>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-back btn-sm">
            Kembali ke Dashboard
        </a>
    </div>
</nav>

<!-- KONTEN -->
<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold page-title">Log Aktivitas</h3>
        <p class="text-muted">
            Riwayat aktivitas pengguna dalam sistem ParkirKu.
        </p>
    </div>

    <!-- TABEL LOG AKTIVITAS -->
    <div class="card border-0 shadow-sm">

        <div class="card-header py-3">
            <h5 class="mb-0">Daftar Aktivitas</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Pengguna</th>
                            <th>Aktivitas</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($aktivitas as $index => $log)
                            <tr>
                                <td class="text-center">
                                    {{ $aktivitas->firstItem() + $index }}
                                </td>

                                <td>
                                    {{ $log->user->name ?? 'Tidak diketahui' }}
                                </td>

                                <td>
                                    {{ $log->aktivitas ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $log->waktu
                                        ? \Carbon\Carbon::parse($log->waktu)->format('d-m-Y H:i:s')
                                        : '-' }}
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Belum ada data aktivitas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-end mt-3">
                {{ $aktivitas->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

<!-- FOOTER -->
<footer class="text-center py-4">
    <small>&copy; {{ date('Y') }} ParkirKu. All Rights Reserved.</small>
</footer>

</body>
</html>
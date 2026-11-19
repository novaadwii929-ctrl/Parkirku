<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaksi Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <a href="{{ route('petugas.dashboard') }}" class="navbar-brand">
        PARKIRAN | PETUGAS
    </a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-light btn-sm">Logout</button>
    </form>
</nav>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Transaksi Parkir</h3>
            <p class="text-muted">Daftar kendaraan masuk dan keluar.</p>
        </div>
        <a href="{{ route('petugas.transaksi.create') }}" class="btn btn-primary">
            + Kendaraan Masuk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nomor Plat</th>
                        <th>Area</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksis->firstItem() + $loop->index }}</td>
                            <td>{{ $transaksi->kode_transaksi }}</td>
                            <td>{{ $transaksi->kendaraan->no_plat }}</td>
                            <td>{{ $transaksi->area->nama_area }}</td>
                            <td>{{ $transaksi->waktu_masuk->format('d-m-Y H:i') }}</td>
                            <td>
                                {{ $transaksi->waktu_keluar?->format('d-m-Y H:i') ?? '-' }}
                            </td>
                            <td>
                                Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($transaksi->status === 'parkir')
                                    <span class="badge bg-warning text-dark">Sedang Parkir</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($transaksi->status === 'parkir')
                                    <a href="{{ route('petugas.transaksi.keluar', $transaksi->id) }}"
                                       class="btn btn-danger btn-sm">
                                        Kendaraan Keluar
                                    </a>
                                @else
                                    <a href="{{ route('petugas.transaksi.struk', $transaksi->id) }}"
                                       class="btn btn-success btn-sm">
                                        Cetak Struk
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $transaksis->links() }}
        </div>
    </div>

    <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary mt-3">
        Kembali ke Dashboard
    </a>
</div>

</body>
</html>
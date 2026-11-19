<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Parkir - ParkirKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Laporan Transaksi Parkir</h3>
            <p class="text-muted mb-0">Rekap transaksi dan pendapatan.</p>
        </div>
        <a href="{{ route('owner.dashboard') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('owner.laporan.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai</label>
                        <input
                            type="date"
                            name="tanggal_mulai"
                            class="form-control"
                            value="{{ $tanggalMulai }}"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Akhir</label>
                        <input
                            type="date"
                            name="tanggal_akhir"
                            class="form-control"
                            value="{{ $tanggalAkhir }}"
                            min="{{ $tanggalMulai }}"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            Tampilkan Laporan
                        </button>
                        <a href="{{ route('owner.laporan.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            @if($errors->any())
                <div class="alert alert-danger mt-3 mb-0">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Kendaraan Keluar</p>
                    <h3 class="fw-bold">{{ number_format($totalKendaraan) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Pendapatan</p>
                    <h3 class="fw-bold text-success">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold">Detail Transaksi</h5>
                <span class="text-muted">
                    {{ \Carbon\Carbon::parse($tanggalMulai)->format('d-m-Y') }}
                    sampai
                    {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nomor Plat</th>
                            <th>Jenis</th>
                            <th>Area</th>
                            <th>Waktu Keluar</th>
                            <th>Durasi</th>
                            <th>Biaya</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksis->firstItem() + $loop->index }}</td>
                                <td>{{ $transaksi->kode_transaksi }}</td>
                                <td>{{ $transaksi->kendaraan->no_plat ?? '-' }}</td>
                                <td>{{ $transaksi->kendaraan->jenis_kendaraan ?? '-' }}</td>
                                <td>{{ $transaksi->area->nama_area ?? '-' }}</td>
                                <td>
                                    {{ $transaksi->waktu_keluar?->format('d-m-Y H:i') ?? '-' }}
                                </td>
                                <td>{{ $transaksi->durasi_menit }} menit</td>
                                <td>
                                    Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
                                </td>
                                <td>{{ $transaksi->petugas->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    Tidak ada transaksi pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $transaksis->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

</body>
</html>
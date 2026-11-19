<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Kendaraan Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:650px">
        <div class="card-body p-4">

            <h3>Konfirmasi Kendaraan Keluar</h3>

            <table class="table mt-3">
                <tr>
                    <th>Kode Transaksi</th>
                    <td>{{ $transaksi->kode_transaksi }}</td>
                </tr>
                <tr>
                    <th>Nomor Plat</th>
                    <td>{{ $transaksi->kendaraan->no_plat }}</td>
                </tr>
                <tr>
                    <th>Jenis Kendaraan</th>
                    <td>{{ $transaksi->kendaraan->jenis_kendaraan }}</td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td>{{ $transaksi->area->nama_area }}</td>
                </tr>
                <tr>
                    <th>Waktu Masuk</th>
                    <td>{{ $transaksi->waktu_masuk->format('d-m-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Tarif Per Jam</th>
                    <td>
                        Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}
                    </td>
                </tr>
            </table>

            <div class="alert alert-warning">
                Setelah dikonfirmasi, sistem akan menghitung durasi dan biaya parkir
                berdasarkan waktu keluar.
            </div>

            <form action="{{ route('petugas.transaksi.selesai', $transaksi->id) }}"
                  method="POST"
                  onsubmit="return confirm('Konfirmasi kendaraan keluar?')">
                @csrf

                <button class="btn btn-danger">
                    Konfirmasi Kendaraan Keluar
                </button>

                <a href="{{ route('petugas.transaksi.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>

</body>
</html>
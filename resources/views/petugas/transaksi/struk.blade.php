<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Parkir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eee;
            padding: 20px;
        }

        .struk {
            max-width: 380px;
            margin: auto;
            padding: 25px;
            background: white;
            border: 1px dashed #555;
        }

        h2, .center {
            text-align: center;
        }

        .garis {
            border-top: 1px dashed #555;
            margin: 15px 0;
        }

        table {
            width: 100%;
            font-size: 14px;
        }

        td {
            padding: 5px 0;
            vertical-align: top;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
        }

        .tombol {
            text-align: center;
            margin-top: 20px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk {
                border: none;
            }

            .tombol {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="struk">
    <h2>PARKIRAN</h2>
    <p class="center">Bukti Pembayaran Parkir</p>

    <div class="garis"></div>

    <table>
        <tr>
            <td>Kode</td>
            <td>: {{ $transaksi->kode_transaksi }}</td>
        </tr>
        <tr>
            <td>Nomor Plat</td>
            <td>: {{ $transaksi->kendaraan->no_plat }}</td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>: {{ $transaksi->kendaraan->jenis_kendaraan }}</td>
        </tr>
        <tr>
            <td>Area</td>
            <td>: {{ $transaksi->area->nama_area }}</td>
        </tr>
        <tr>
            <td>Masuk</td>
            <td>: {{ $transaksi->waktu_masuk->format('d-m-Y H:i:s') }}</td>
        </tr>
        <tr>
            <td>Keluar</td>
            <td>: {{ $transaksi->waktu_keluar?->format('d-m-Y H:i:s') ?? '-' }}</td>
        </tr>
        <tr>
            <td>Durasi</td>
            <td>: {{ $transaksi->durasi_menit }} menit</td>
        </tr>
        <tr>
            <td>Tarif/Jam</td>
            <td>: Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="garis"></div>

    <p class="total">
        TOTAL: Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
    </p>

    <div class="garis"></div>

    <p class="center">
        Petugas: {{ $transaksi->petugas->name ?? '-' }}<br>
        Terima kasih telah menggunakan layanan parkir.
    </p>

    <div class="tombol">
        <button onclick="window.print()">Cetak Struk</button>
        <a href="{{ route('petugas.transaksi.index') }}">Kembali</a>
    </div>
</div>

</body>
</html>
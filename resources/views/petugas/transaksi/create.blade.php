<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kendaraan Masuk - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:650px">
        <div class="card-body p-4">

            <h3>Kendaraan Masuk</h3>
            <p class="text-muted">
                Catat kendaraan yang memasuki area parkir.
            </p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('petugas.transaksi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kendaraan</label>

                    <select name="kendaraan_id" class="form-select" required>
                        <option value="">-- Pilih Kendaraan --</option>

                        @foreach($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}"
                                @selected(old('kendaraan_id') == $kendaraan->id)>
                                {{ $kendaraan->no_plat }} -
                                {{ $kendaraan->jenis_kendaraan }}
                                ({{ $kendaraan->merk ?? 'Tanpa merk' }})
                            </option>
                        @endforeach
                    </select>

                    <small class="text-muted">
                        Kendaraan harus didaftarkan Admin terlebih dahulu.
                    </small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Area Parkir</label>

                    <select name="area_id" class="form-select" required>
                        <option value="">-- Pilih Area --</option>

                        @foreach($areas as $area)
                            @if($area->tersedia > 0)
                                <option value="{{ $area->id }}"
                                    @selected(old('area_id') == $area->id)>
                                    {{ $area->nama_area }} -
                                    Terisi {{ $area->terisi }}/{{ $area->kapasitas }} -
                                    Sisa {{ $area->tersedia }} slot
                                </option>
                            @endif
                        @endforeach
                    </select>

                    <small class="text-muted">
                        Area yang sudah penuh tidak dapat dipilih.
                    </small>

                    @if($areas->where('tersedia', '>', 0)->isEmpty())
                        <div class="alert alert-warning mt-2 mb-0">
                            Semua area parkir sedang penuh atau belum tersedia.
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Kendaraan Masuk
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
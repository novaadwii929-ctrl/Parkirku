<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:600px">
        <div class="card-body p-4">

            <h3 class="mb-4">Tambah Kendaraan</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kendaraans.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nomor Plat</label>
                    <input type="text" name="no_plat" class="form-control"
                           value="{{ old('no_plat') }}"
                           placeholder="Contoh: N 1234 AB" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach(['Motor', 'Mobil', 'Truk', 'Bus', 'Lainnya'] as $jenis)
                            <option value="{{ $jenis }}" @selected(old('jenis_kendaraan') == $jenis)>
                                {{ $jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Merk Kendaraan</label>
                    <input type="text" name="merk" class="form-control"
                           value="{{ old('merk') }}"
                           placeholder="Contoh: Honda">
                </div>

                <button class="btn btn-primary">Simpan Kendaraan</button>

                <a href="{{ route('admin.kendaraans.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Area Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:600px">
        <div class="card-body p-4">

            <h3 class="mb-4">Tambah Area Parkir</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.areas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Area</label>
                    <input type="text" name="nama_area" class="form-control"
                           value="{{ old('nama_area') }}"
                           placeholder="Contoh: Area A" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kapasitas Kendaraan</label>
                    <input type="number" name="kapasitas" class="form-control"
                           value="{{ old('kapasitas') }}"
                           min="1" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status Area</label>
                    <select name="aktif" class="form-select" required>
                        <option value="1" @selected(old('aktif', '1') == '1')>Aktif</option>
                        <option value="0" @selected(old('aktif') == '0')>Nonaktif</option>
                    </select>
                </div>

                <button class="btn btn-primary">Simpan Area</button>
                <a href="{{ route('admin.areas.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>

</body>
</html>
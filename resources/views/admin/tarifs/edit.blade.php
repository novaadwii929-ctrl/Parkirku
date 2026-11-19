<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Tarif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:600px">
        <div class="card-body p-4">

            <h3 class="mb-4">Edit Tarif Parkir</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tarifs.update', $tarif->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Jenis Kendaraan</label>
                    <input type="text" name="jenis_kendaraan" class="form-control"
                           value="{{ old('jenis_kendaraan', $tarif->jenis_kendaraan) }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Tarif Per Jam (Rp)</label>
                    <input type="number" name="tarif_per_jam" class="form-control"
                           value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}"
                           min="0" step="0.01" required>
                </div>

                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.tarifs.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>

</body>
</html>
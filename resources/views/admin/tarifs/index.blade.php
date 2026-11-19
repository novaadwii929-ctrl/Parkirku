<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tarif Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary px-4">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
        PARKIRAN | ADMIN
    </a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-light btn-sm">Logout</button>
    </form>
</nav>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Data Tarif Parkir</h3>
            <p class="text-muted">Kelola tarif berdasarkan jenis kendaraan</p>
        </div>
        <a href="{{ route('admin.tarifs.create') }}" class="btn btn-primary">
            + Tambah Tarif
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tarif Per Jam</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tarifs as $tarif)
                        <tr>
                            <td>{{ $tarifs->firstItem() + $loop->index }}</td>
                            <td>{{ $tarif->jenis_kendaraan }}</td>
                            <td>Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.tarifs.edit', $tarif->id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.tarifs.destroy', $tarif->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus tarif ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data tarif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $tarifs->links() }}
        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">
        Kembali ke Dashboard
    </a>

</div>
</body>
</html>
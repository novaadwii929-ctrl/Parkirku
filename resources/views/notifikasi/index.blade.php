<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notifikasi - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef4fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #0d6efd;
        }

        .container-box {
            max-width: 950px;
            margin: 35px auto;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.07);
        }

        .notification {
            border: 1px solid #e5eaf0;
            border-radius: 9px;
            padding: 18px;
            margin-bottom: 12px;
            background: white;
        }

        .notification.unread {
            background: #edf5ff;
            border-left: 5px solid #0d6efd;
        }
    </style>
</head>
<body>

@php
    $rolePrefix = auth()->user()->role === 'owner' ? 'owner' : 'petugas';
@endphp

<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">ParkirKu</span>
        <span class="text-white">
            {{ ucfirst(auth()->user()->role) }}
        </span>
    </div>
</nav>

<div class="container container-box">
    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Notifikasi</h3>
                <p class="text-muted mb-0">Informasi aktivitas parkir</p>
            </div>

            <a href="{{ route($rolePrefix.'.dashboard') }}"
               class="btn btn-outline-primary">
                Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @forelse($notifikasis as $notifikasi)

            <div class="notification {{ !$notifikasi->dibaca ? 'unread' : '' }}">

                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-bold mb-2">
                            {{ $notifikasi->judul }}
                        </h5>

                        <p>{{ $notifikasi->pesan }}</p>

                        <small class="text-muted">
                            {{ $notifikasi->created_at->format('d-m-Y H:i') }}
                        </small>
                    </div>

                    <div>
                        @if($notifikasi->dibaca)
                            <span class="badge bg-secondary">Dibaca</span>
                        @else
                            <span class="badge bg-primary">Baru</span>
                        @endif
                    </div>
                </div>

                @if(!$notifikasi->dibaca)
                    <form method="POST"
                          action="{{ route($rolePrefix.'.notifikasi.baca', $notifikasi->id) }}"
                          class="mt-3">
                        @csrf

                        <button type="submit" class="btn btn-sm btn-primary">
                            Tandai Sudah Dibaca
                        </button>
                    </form>
                @endif

            </div>

        @empty
            <div class="alert alert-info text-center">
                Belum ada notifikasi.
            </div>
        @endforelse

        <div class="mt-3">
            {{ $notifikasis->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

</body>
</html>
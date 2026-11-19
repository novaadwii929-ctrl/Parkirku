@extends('layouts.dashboard')

@section('title', $judul)

@section('content')

<div class="container-fluid">

    <h3 class="fw-bold">{{ $judul }}</h3>

    <p class="text-secondary">
        {{ $deskripsi }}
    </p>

    <div class="dashboard-card mt-4">

        <h5>{{ $judul }}</h5>

        <p>
            Halaman {{ strtolower($judul) }} PARKIRKU berhasil dibuka.
        </p>

        <p class="text-secondary">
            Fitur pengelolaan data pada halaman ini akan dilengkapi
            pada tahap berikutnya.
        </p>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-secondary">
            Kembali ke Dashboard
        </a>

    </div>

</div>

@endsection
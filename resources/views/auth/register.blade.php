<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - ParkirKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 430px;
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0,0,0,.12);
            border: 1px solid #eeeeee;
        }

        .btn-register {
            width: 100%;
            background: #245486;
            border: none;
            color: white;
            padding: 11px;
        }

        .btn-register:hover {
            background: #193F68;
            color: white;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h3 class="text-center fw-bold">Daftar ParkirKu</h3>
    <p class="text-center text-muted">Buat akun baru</p>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="form-control" required>
        </div>

        <button type="submit" class="btn btn-register">
            Daftar
        </button>
    </form>

    <p class="text-center mt-3 mb-0">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
    </p>
</div>

</body>
</html>
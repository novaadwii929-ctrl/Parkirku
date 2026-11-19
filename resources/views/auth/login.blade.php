<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - PARKIRKU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            background: #eef2f7;
        }

        .login-card {
            width: 100%;
            max-width: 410px;
            padding: 38px;
            background: #ffffff;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.08);
        }

        .logo {
            width: 65px;
            height: 65px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #172b4d;
            color: white;
            border-radius: 16px;
            font-size: 30px;
        }

        h3 {
            color: #172b4d;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #8492a6;
            font-size: 14px;
        }

        .form-label {
            color: #344563;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            padding: 12px;
            border: 1px solid #dce3ec;
            border-radius: 8px;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #345995;
            box-shadow: 0 0 0 3px rgba(52, 89, 149, .12);
            background: white;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #172b4d;
            color: white;
            font-weight: 600;
            transition: .2s;
        }

        .btn-login:hover {
            background: #263f68;
            color: white;
        }

        .register-link {
            color: #345995;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .footer {
            color: #98a2b3;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="logo">🚗</div>

    <h3 class="text-center mt-3 fw-bold">PARKIRKU</h3>

    <p class="text-center subtitle mb-4">
        Sistem Informasi Manajemen Parkir
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Masukkan email"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Masukkan password"
                   required>
        </div>

        <button type="submit" class="btn btn-login">
            Masuk
        </button>
    </form>

    <!-- LINK REGISTER -->
    <p class="text-center mt-4 mb-0">
        Belum punya akun?
        <a href="{{ route('register') }}" class="register-link">
            Daftar sekarang
        </a>
    </p>

    <p class="text-center footer mt-4 mb-0">
        © nova dwi
    </p>

</div>

</body>
</html>
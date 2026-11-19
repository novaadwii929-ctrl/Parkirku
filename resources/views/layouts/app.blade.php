<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PARKIRKU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f6f0e5;
            font-family: Arial, sans-serif;
            color: #514637;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .auth-card {
            width: 100%;
            max-width: 440px;
            background: #fffdf8;
            padding: 38px;
            border-radius: 18px;
            border: 1px solid #e9dfcf;
            box-shadow: 0 10px 35px rgba(80, 60, 30, .08);
        }

        .brand {
            font-size: 29px;
            font-weight: 800;
            color: #80613a;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            color: #96866f;
            font-size: 13px;
        }

        .form-control {
            padding: 12px;
            border-radius: 9px;
            border: 1px solid #ded3c2;
            background: #fffefa;
        }

        .form-control:focus {
            border-color: #a8895d;
            box-shadow: 0 0 0 3px rgba(168,137,93,.12);
        }

        .btn-cream {
            background: #8a6b43;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 9px;
            font-weight: 600;
        }

        .btn-cream:hover {
            background: #705332;
            color: white;
        }

        a {
            color: #80613a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Menyembunyikan ikon panah kembali */
        .back-button,
        .btn-back,
        .back-btn,
        .back-link,
        .bi-arrow-left,
        .fa-arrow-left,
        .fa-chevron-left,
        .lucide-arrow-left {
            display: none !important;
        }
    </style>
</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
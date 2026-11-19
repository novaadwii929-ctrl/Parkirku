<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - PARKIRKU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f0e5;
            color: #514637;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #fffdf8;
            border-bottom: 1px solid #e9dfcf;
            padding: 17px 30px;
        }

        .navbar-brand {
            color: #80613a;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .main-content {
            padding: 35px;
        }

        .dashboard-card {
            background: #fffdf8;
            border: 1px solid #e9dfcf;
            border-radius: 14px;
            padding: 25px;
            height: 100%;
        }

        .dashboard-card h5 {
            color: #80613a;
            font-weight: bold;
        }

        .btn-logout {
            background: #8a6b43;
            color: white;
            border: none;
        }

        .btn-logout:hover {
            background: #705332;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar d-flex justify-content-between">
    <a class="navbar-brand" href="#">PARKIRKU</a>

    <div class="d-flex align-items-center gap-3">
        <span>{{ auth()->user()->name }}</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-logout btn-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<main class="main-content">
    @yield('content')
</main>

</body>
</html>
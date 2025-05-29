<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Custom CSS -->
    <style>
        body {
            background-color: #f5f7fa;
        }
        .navbar {
            background-color: #1f2937;
        }
        .navbar-brand, .nav-link, .text-white {
            color: #fff !important;
        }
        .sidebar .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Classico</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <span class="text-white">🔥 Xin chào, <strong>{{ Auth::user()->username }}</strong></span>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.logout') }}">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main layout -->
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('partials.sidebar')
            </div>

            <!-- Nội dung chính -->
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản lý Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f5f7fa;
        }

        .navbar {
            background-color: #1f2937;
            height: 56px;
        }

        .navbar-brand,
        .nav-link,
        .text-white {
            color: #fff !important;
        }

        /* Wrapper bao ngoài sidebar và main-content */
        .page-wrapper {
            display: flex;
            height: calc(100vh - 56px); /* Trừ navbar */
        }

        /* Sidebar bên trái, chiều cao full */
        

        /* Nội dung chính bên phải */
        .main-content {
            flex-grow: 1;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            overflow-y: auto;
            margin: 20px;
        }

        /* Alert bo tròn */
        .alert {
            border-radius: 6px;
        }

        /* Responsive nhỏ */
        @media (max-width: 768px) {
            .page-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                box-shadow: none;
                padding: 15px 10px;
            }
            .main-content {
                margin: 0;
                padding: 15px;
            }
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
                        <span class="text-white">🔥 Xin chào, <strong>{{ Auth::guard('web')->user()->username }}</strong></span>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.logout') }}">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Wrapper chứa sidebar bên trái và nội dung bên phải -->
    <div class="page-wrapper">
            @include('partials.sidebar')

        <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

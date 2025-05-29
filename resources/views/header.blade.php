<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        .home-bg {
            padding: 20px 0;
        }

        .cart .col-md,
        .cart .col-md-3 {
            text-align: center;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 8px;
        }

        .product .col-md,
        .product .col-md-3 {
            margin: auto;
            text-align: center;
        }

        .product .col-md a,
        .product .col-md-3 a {
            color: #212529;
        }

        i.fa.fa-trash {
            font-size: 25px;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-top">
            <div class="container">
                <nav class="navbar navbar-expand-sm navbar-light bg-while">
                    <ul class="navbar-nav d-flex flex-row align-items-center gap-4" style="min-height: 40px;">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('customer.home') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-icon">
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <i class="fa fa-phone me-2 text-primary"></i>
                            <span>
                                <strong>Call us now:</strong>
                                <a href="tel:(+800)123456789" class="text-decoration-none text-dark">(+800)123456789</a>
                            </span>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <i class="fa fa-envelope me-2 text-primary"></i>
                            <span>
                                <strong>Email:</strong>
                                <a href="mailto:has@posthemes.com" class="text-decoration-none text-dark">has@posthemes.com</a>
                            </span>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mt-lg-6">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset(Auth::guard('customer')->user()->avatar ?? 'images/default-avatar.png') }}" alt="Avatar" class="rounded-circle" width="30" height="30">
                                <span class="ms-2">{{ Auth::guard('customer')->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('history.index') }}">Order History</a>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                            </div>
                        </li>
                        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </nav>
            </div>
        </div>

    </header>
    @yield('content')
</body>

</html>
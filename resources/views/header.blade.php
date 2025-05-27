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

    <style>
        .home-bg {
            padding: 20px 0;
        }

        .cart .col-md,
        .cart .col-md-3 {
            text-align: center;
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
                    <ul class="navbar-nav mr-auto mt-lg-6">
                        <li class="nav-item phone">
                            <i class="fa fa-phone "></i>
                            Call us now:
                            <a href="tel:(+800)123456789">(+800)123456789</a>
                        </li>
                        <li class="nav-item email">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Email:
                            <a href="mailto:http://1.envato.market/9LbxW">has@posthemes.com</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mt-lg-6">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.profile') }}">My Information</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </header>
    @yield('content')
</body>

</html>
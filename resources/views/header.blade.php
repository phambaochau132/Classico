<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    </script>
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
                            <a class="nav-link" href="#">MY WISHLIST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">CHECK OUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">LOG IN</a>
                        </li>
                        <li class="nav-item language dropdown">
                            <a class="nav-link" href="#">EN <i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-content">
                                <div class="dropdown-link"><a href="#">French</a></div>
                                <div class="dropdown-link"><a href="#">Spanish</a></div>
                                <div class="dropdown-link"><a href="#">Russian</a></div>
                            </div>
                        </li>
                        <li class="nav-item curency dropdown">
                            <a class="nav-link" href="#">$ <i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-content">
                                <div class="dropdown-link"><a href="#">€ Euro</a></div>
                                <div class="dropdown-link"><a href="#">£ Pound Sterling</a></div>
                                <div class="dropdown-link"><a href="#">$ US Dollar</a></div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="header-mid">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 logo">
                    </div>
                    <div class="col-md-4 search-box">
                        <form action="{{route('product.search')}}" method="get">
                            <input placeholder="Search" type="search" name="key">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-md-4 wishlist-cart">
                        <nav class="navbar navbar-expand-sm">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fa fa-shopping-cart"></i>
                                        <div class="cart-item">CART ITEMS</div>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-sm navbar-light menu">
                    <ul class="navbar-nav mr-auto ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BLOG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">CONTACT US</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </header>
    @yield('content')
</body>

</html>
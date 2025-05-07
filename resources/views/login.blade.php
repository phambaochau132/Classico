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

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <style>
        body {
            background: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background: white;
            width: 400px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        .forgot {
            text-align: right;
            margin-top: -15px;
            margin-bottom: 20px;
        }

        .forgot a {
            color: #007BFF;
            text-decoration: none;
        }

        .forgot a:hover {
            text-decoration: underline;
        }

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
                            <a class="nav-link" href="{{ route('customer.register') }}">Register</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="login-box">
        <h2>Đăng nhập tài khoản</h2>
        <form action="{{ route('customer.login') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>
            <div class="forgot">
                <a href="#">Quên mật khẩu?</a>
            </div>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
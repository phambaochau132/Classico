<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng nhập tài khoản</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .header-top {
            background-color: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            padding: 10px 0;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 9999;
        }

        .header-top .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-top .contact-info {
            display: flex;
            gap: 30px;
            font-size: 14px;
            color: #555;
        }

        .header-top .contact-info i {
            margin-right: 6px;
            color: #2575fc;
        }

        .header-top .register-link a {
            font-weight: 600;
            color: #2575fc;
            text-decoration: none;
        }

        .header-top .register-link a:hover {
            text-decoration: underline;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-box {
            background: #f8fbff;
            border: 1.5px solid #2575fc;
            width: 100%;
            max-width: 420px;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(37, 117, 252, 0.15);
            text-align: center;
            color: #2575fc;
        }

        .login-box h2 {
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 28px;
            color: #2575fc;
            letter-spacing: 1px;
        }

        label {
            font-weight: 600;
            color: #555;
            display: block;
            text-align: left;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1.5px solid #ddd;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.4);
        }

        .forgot {
            text-align: right;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        .forgot a {
            color: #2575fc;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot a:hover {
            text-decoration: underline;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .social-login a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: white;
            user-select: none;
        }

        .social-login a.btn-google {
            background: #db4437;
        }

        .social-login a.btn-google:hover {
            background: #c33c2f;
        }

        .social-login a.btn-facebook {
            background: #4267B2;
        }

        .social-login a.btn-facebook:hover {
            background: #37549a;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px 0;
            background: #2575fc;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background: #1b55d1;
        }

        .alert {
            max-width: 420px;
            margin: 0 auto 20px auto;
            border-radius: 10px;
            padding: 15px 20px;
            font-weight: 600;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="contact-info">
                    <div>
                        <i class="fa fa-phone"></i>
                        Call us now:
                        <a href="tel:(+800)123456789" style="color:#2575fc;">(+800)123456789</a>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        Email:
                        <a href="mailto:has@posthemes.com" style="color:#2575fc;">has@posthemes.com</a>
                    </div>
                </div>
                <div class="register-link">
                    <a href="{{ route('customer.register') }}">Đăng ký</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                text: '{{ $errors->first() }}',
            });
        </script>
        @endif

        <div class="login-box">
            <h2>Đăng nhập tài khoản</h2>
            <form action="{{ route('customer.login') }}" method="POST">
                @csrf
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Nhập email của bạn" required />

                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required />

                <div class="forgot">
                    <a href="#">Quên mật khẩu?</a>
                </div>

                <div class="social-login">
                    <a href="{{ route('auth.google') }}" class="btn-google" title="Đăng nhập bằng Google">
                        <i class="fab fa-google"></i> Google
                    </a>
                    <a href="{{ route('auth.facebook') }}" class="btn-facebook" title="Đăng nhập bằng Facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                </div>

                <button type="submit">Đăng nhập</button>
            </form>
        </div>
    </main>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
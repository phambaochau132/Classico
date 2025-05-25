<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <?php
    use Illuminate\Support\Facades\Hash;

    Hash::check('editor123', '$2y$10$5lo1Zd8cZcZZYB91FjTD9uF0yBnLGoEbyPh3sS7qPL.Fn1jS3XBxK');
    ?>
    <title>Đăng nhập Quản trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/login.admin.css') }}" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="login-box">
        <div class="login-header">
            <i class="bi bi-person-lock"></i>
            <h4>Đăng nhập Admin</h4>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 form-group">
                <i class="bi bi-person-fill"></i>
                <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required autofocus>
            </div>

            <div class="mb-3 form-group">
                <i class="bi bi-lock-fill"></i>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </button>
            </div>
            <div class="forgot-password">
                <a href="{{ route('reset.form') }}">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        }
    </script>
</body>
</html>

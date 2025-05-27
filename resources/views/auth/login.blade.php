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
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h4 class="mb-4 text-center">Đăng nhập quản trị</h4>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.loginForm') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
</body>

</html>
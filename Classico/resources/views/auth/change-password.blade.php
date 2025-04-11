<!DOCTYPE html>
<html>
<head>
    <title>Đổi mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Đổi mật khẩu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="mb-3">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" class="form-control" name="current_password" required>
        </div>

        <div class="mb-3">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" class="form-control" name="new_password" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
</body>
</html>

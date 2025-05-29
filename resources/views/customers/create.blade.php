<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm khách hàng</title>

    <!-- Bootstrap & Icons -->


    
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('customers.index') }}">Quản lý khách hàng</a>
    </div>
</nav>

<!-- Nội dung chính -->\
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/addcustomers.css') }}" rel="stylesheet">
<main class="container py-5">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h2 class="mb-4 text-center">📝 Thêm khách hàng</h2>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <label for="name">Họ tên:</label>

            <input class="form-control" type="text" name="name" id="name" required>
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('name')}}</span>
            @endif

            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" required>
            @if($errors->has('email'))
            <span class="text-danger">{{$errors->first('email')}}</span>
            @endif
            <label for="phone">Số điện thoại (tùy chọn):</label>
            <input class="form-control" type="text" name="phone" id="phone">
            @if($errors->has('phone'))
            <span class="text-danger">{{$errors->first('phone')}}</span>
            @endif
            <label  for="address">Địa chỉ (tùy chọn):</label>
            <textarea class="form-control" name="address" id="address" rows="3"></textarea>
            @if($errors->has('address'))
            <span class="text-danger">{{$errors->first('address')}}</span>
            @endif
            <label for="gender">Giới tính:</label>
            <select class="form-control" name="gender" id="gender">
                <option value="">--Chọn--</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
            @if($errors->has('gender'))
            <span class="text-danger">{{$errors->first('gender')}}</span>
            @endif

            <label for="password">Mật khẩu:</label>
            <input class="form-control" type="password" name="password" id="password" required>
            @if($errors->has('password'))
            <span class="text-danger">{{$errors->first('password')}}</span>
            @endif
            <label for="password_confirmation">Nhập lại mật khẩu:</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
            @if($errors->has('password_confirmation'))
            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
            @endif
            <button class="form-control"  type="submit">Đăng ký</button>
            </div>
        </form>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

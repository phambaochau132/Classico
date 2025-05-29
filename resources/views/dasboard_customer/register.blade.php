<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background: #f8fbff;
            border: 1.5px solid #2575fc;
            width: 100%;
            max-width: 500px;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(37, 117, 252, 0.15);
            text-align: center;
            color: #2575fc;
        }

        h2 {
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1.5px solid #ddd;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #2575fc;
            outline: none;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.4);
        }

        textarea {
            resize: vertical;
        }

        button {
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
            margin-top: 25px;
        }

        button:hover {
            background: #1b55d1;
        }

        .text-danger {
            font-size: 14px;
            color: #dc3545;
            text-align: left;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="register-box">
        <h2>Đăng ký tài khoản</h2>

        <form action="{{ route('customer.register') }}" method="POST">
            @csrf

            <label for="name">Họ tên:</label>
            <input type="text" name="name" id="name" required>
            @if($errors->has('name'))<span class="text-danger">{{$errors->first('name')}}</span>@endif

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            @if($errors->has('email'))<span class="text-danger">{{$errors->first('email')}}</span>@endif

            <label for="phone">Số điện thoại (tùy chọn):</label>
            <input type="text" name="phone" id="phone">
            @if($errors->has('phone'))<span class="text-danger">{{$errors->first('phone')}}</span>@endif

            <label for="address">Địa chỉ (tùy chọn):</label>
            <textarea name="address" id="address" rows="3"></textarea>
            @if($errors->has('address'))<span class="text-danger">{{$errors->first('address')}}</span>@endif

            <label for="gender">Giới tính:</label>
            <select name="gender" id="gender">
                <option value="">--Chọn--</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
            @if($errors->has('gender'))<span class="text-danger">{{$errors->first('gender')}}</span>@endif

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>
            @if($errors->has('password'))<span class="text-danger">{{$errors->first('password')}}</span>@endif

            <label for="password_confirmation">Nhập lại mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            @if($errors->has('password_confirmation'))<span class="text-danger">{{$errors->first('password_confirmation')}}</span>@endif

            <button type="submit">Đăng ký</button>
        </form>
    </div>

</body>

</html>
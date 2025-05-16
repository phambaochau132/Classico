<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <style>
        body {
            background: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .register-box {
            width: 500px;
            margin: 50px auto;
            background: #fff;
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
            margin-bottom: 6px;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2>Đăng ký tài khoản</h2>

        <form action="{{ route('customer.register') }}" method="POST">
            @csrf

            <label for="name">Họ tên:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Số điện thoại (tùy chọn):</label>
            <input type="text" name="phone" id="phone">

            <label for="address">Địa chỉ (tùy chọn):</label>
            <textarea name="address" id="address" rows="3"></textarea>

            <label for="gender">Giới tính:</label>
            <select name="gender" id="gender">
                <option value="">--Chọn--</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Nhập lại mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            
            <button type="submit">Đăng ký</button>
        </form>
    </div>

</body>

</html>
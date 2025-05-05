<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
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
        input[type="email"], input[type="password"] {
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
    </style>
</head>
<body>

<div class="login-box">
    <h2>Đăng nhập tài khoản</h2>

    <form action="{{ route('customer.login') }}" method="POST">
        @csrf

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password" required>

        <div class="forgot">
            <a href="#">Quên mật khẩu?</a> {{-- Có thể gắn route forgot password nếu có --}}
        </div>

        <button type="submit">Đăng nhập</button>
    </form>
</div>

</body>
</html>

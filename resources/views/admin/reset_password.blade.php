<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đặt lại mật khẩu</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body.bg-light {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .reset-password-box {
            max-width: 420px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 0.6s ease forwards;
        }

        .reset-password-box h3 {
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 1.8rem;
            letter-spacing: 0.03em;
            user-select: none;
        }

        label.form-label {
            font-weight: 600;
            color: #333;
        }

        input.form-control {
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            box-shadow: inset 0 2px 6px rgb(0 0 0 / 0.05);
            transition: border-color 0.3s ease;
        }

        input.form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.4);
            outline: none;
        }

        button.btn-primary {
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 14px 0;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        button.btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 6px 20px rgba(11, 94, 215, 0.5);
        }

        .alert {
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="reset-password-box">
            <h3 class="text-center text-primary">🔐 Đặt lại mật khẩu</h3>

            {{-- Hiển thị thông báo thành công --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Hiển thị thông báo lỗi --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Hiển thị lỗi validate --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reset.handle') }}">
                @csrf

                <div class="mb-4">
                    <label for="username" class="form-label">👤 Tên đăng nhập</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        name="username"
                        value="{{ old('username') }}"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="sodienthoai" class="form-label">📱 Số điện thoại</label>
                    <input
                        type="tel"
                        class="form-control form-control-lg"
                        name="sodienthoai"
                        value="{{ old('sodienthoai') }}"
                        placeholder="Ví dụ: 0355924433"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">🔑 Mật khẩu mới</label>
                    <input
                        type="password"
                        class="form-control form-control-lg"
                        name="password"
                        required
                    />
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">✅ Cập nhật mật khẩu</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

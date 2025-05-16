<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>

<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<style>
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

    body {
        background-color: #f8f9fa;
    }

    .form-container {
        max-width: 600px;
        margin: 60px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .avatar-box {
        width: 120px;
        height: 120px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #ddd;
    }

    .avatar-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .modal-header h5 {
        font-weight: bold;
    }
</style>


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
                            <a class="nav-link" href="#">My Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.profile') }}">My Information</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                        </li>
                        <li class="nav-item language dropdown">
                            <a class="nav-link" href="#">Language <i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-content">
                                <div class="dropdown-link"><a href="#">French</a></div>
                                <div class="dropdown-link"><a href="#">Spanish</a></div>
                                <div class="dropdown-link"><a href="#">Russian</a></div>
                            </div>
                        </li>
                        <li class="nav-item curency dropdown">
                            <a class="nav-link" href="#">Currency Type <i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-content">
                                <div class="dropdown-link"><a href="#">€ Euro</a></div>
                                <div class="dropdown-link"><a href="#">£ Pound Sterling</a></div>
                                <div class="dropdown-link"><a href="#">$ US Dollar</a></div>
                            </div>
                        </li>
                    </ul>
                </nav>
    </header>
    <div class="form-container">
        <h4 class="mb-4 text-center">Thông tin cá nhân</h4>
        <div class="text-center mb-3">
            <div class="avatar-box mx-auto">
                <img src="{{ asset('images/' . $customer->avatar) }}" alt="Avatar">
            </div>
        </div>
        <p><strong>Họ tên:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Giới tính:</strong>
            @if ($customer->gender == 'male')
            Nam
            @elseif ($customer->gender == 'female')
            Nữ
            @else
            Khác
            @endif
        </p>
        <p><strong>Số điện thoại:</strong> {{ $customer->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $customer->address }}</p>
        <button class="btn btn-primary btn-block mt-3" data-toggle="modal" data-target="#updateChoiceModal">Cập nhật</button>
    </div>
    <div class="modal fade" id="updateChoiceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn muốn cập nhật gì?</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-center">
                    <button class="btn btn-info m-2" data-dismiss="modal" data-toggle="modal" data-target="#updateInfoModal">Thông tin cá nhân</button>
                    <button class="btn btn-warning m-2" data-dismiss="modal" data-toggle="modal" data-target="#updatePasswordModal">Mật khẩu</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateInfoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('customer.updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action" value="update_info">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật thông tin cá nhân</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Họ tên</label>
                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
                    <label>Giới tính</label>
                    <select name="gender" class="form-control">
                        <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                    </select>
                    <label>Điện thoại</label>
                    <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
                    <label>Ảnh đại diện mới</label>
                    <input type="file" name="avatar" class="form-control-file">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('customer.updateProfile') }}" method="POST">
                @csrf
                <input type="hidden" name="action" value="update_password">

                <div class="modal-header">
                    <h5 class="modal-title">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
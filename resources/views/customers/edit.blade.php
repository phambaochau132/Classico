<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa khách hàng</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/editcustomers.css') }}" rel="stylesheet">

    
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('customers.index') }}">Quản lý khách hàng</a>
    </div>
</nav>

<!-- Nội dung chính -->
<main class="container py-5">
    <div class="card p-4 mx-auto" style="max-width: 600px;">
        <h2 class="mb-4 text-center">✏️ Sửa thông tin khách hàng</h2>

        <form id="updateForm" action="{{route('customers.update', $customer->customer_id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">Tên</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}">
            </div>

            <div class="mb-3">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $customer->phone }}">
            </div>

            <div class="mb-3">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                    <i></i> Hủy
                </a>
                <button type="button" class="btn btn-primary" onclick="confirmUpdate()">
                    <i></i> Cập nhật
                </button>
            </div>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate() {
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: "Bạn có chắc muốn cập nhật thông tin khách hàng?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Cập nhật',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('updateForm').submit();
            }
        });
    }
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

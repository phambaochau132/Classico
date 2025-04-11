<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách khách hàng</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/customers.css') }}" rel="stylesheet">

    
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('customers.index') }}">Quản lý khách hàng</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Nội dung chính -->
<main class="container py-4">
    <div class="card p-4">
        <!-- Tìm kiếm -->
        <form action="{{ route('customers.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-6 search-input">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên, email, SĐT..." value="{{ request('keyword') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- Tiêu đề + Thêm -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0">📋 Danh sách khách hàng</h2>
            <a href="{{ route('customers.create') }}" class="btn btn-success">+ Thêm khách hàng</a>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle bg-white rounded shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>Mã KH</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td class="text-center">
                                <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-sm btn-warning me-1" title="Sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có khách hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

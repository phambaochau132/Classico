<!DOCTYPE html>
<html>
<head>
    <title>Danh sách khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<form action="{{ route('customers.index') }}" method="GET" class="mb-3 row g-2">
    <div class="col-auto">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên, email, SĐT" value="{{ request('keyword') }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

    <h1 class="mb-4">Danh sách khách hàng</h1>

    <a href="{{ route('customers.create') }}" class="btn btn-success mb-3">+ Thêm khách hàng</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã KH</th>
                <th>Tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Hành động</th> <!-- Cột mới -->
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->customer_id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer->customer_id) }}" class="btn btn-warning btn-sm">Sửa</a>

                        <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

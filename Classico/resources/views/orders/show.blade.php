<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng {{ $order['id'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .order-details {
            width: 100%;
            max-width: 800px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .section-title {
            font-weight: bold;
            margin-top: 30px;
        }
        table th, table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="order-details">

        <h3 class="text-center mb-4">Chi tiết đơn hàng {{ $order['id'] }}</h3>

        <div class="mb-2"><strong>Tên khách hàng:</strong> {{ $order['customer_name'] }}</div>
        <div class="mb-2"><strong>Số điện thoại:</strong> {{ $order['phone'] }}</div>
        <div class="mb-2"><strong>Địa chỉ giao hàng:</strong> {{ $order['address'] }}</div>
        <div class="mb-2"><strong>Ngày đặt hàng:</strong> {{ $order['order_date'] }}</div>

        <div class="mb-2">
            <strong>Trạng thái:</strong>
            <select class="form-select d-inline w-auto">
                <option {{ $order['status'] == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                <option {{ $order['status'] == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao hàng</option>
                <option {{ $order['status'] == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
            </select>
        </div>

        <div class="mb-2">
            <strong>Tổng tiền:</strong> {{ number_format((float) $order['total'], 0, ',', '.') }} VND
        </div>

        <div class="mb-2"><strong>Phương thức thanh toán:</strong> {{ $order['payment_method'] }}</div>
        <div class="mb-3"><strong>Ghi chú:</strong> {{ $order['note'] }}</div>

        <h5 class="section-title">Chi tiết các sản phẩm:</h5>

        <table class="table table-bordered table-hover mt-2">
            <thead class="table-light">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order['products'] as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ number_format((float) $product['price'], 0, ',', '.') }} VND</td>
                        <td>{{ number_format((float) $product['price'] * $product['quantity'], 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-primary">Cập nhật trạng thái</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Đóng</a>
        </div>

    </div>
</body>
</html>

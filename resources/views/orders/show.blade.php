<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng {{ $order['id'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            padding: 20px;
            font-size: 18px;
            overflow: auto;
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

        <h3 class="text-center mb-4">@if(isset($order['id']))
    Chi tiết đơn hàng {{ $order['id'] }}
@else
    Không tìm thấy ID đơn hàng
@endif</h3>

        <div class="mb-2"><strong>Tên khách hàng:</strong> {{ $order['customer_name'] }}</div>
        <div class="mb-2"><strong>Số điện thoại:</strong> {{ $order['phone'] }}</div>
        <div class="mb-2"><strong>Địa chỉ giao hàng:</strong> {{ $order['address'] }}</div>
        <div class="mb-2"><strong>Ngày đặt hàng:</strong> {{ $order['order_date'] }}</div>

            <div class="mb-2">
                <strong>Trạng thái:</strong>
                 @if($order['status'] === 0)
                <span class="badge bg-warning">Chờ thanh toán</span>
                 @elseif($order['status'] === 1)
                 <span class="badge bg-warning">Chờ xác nhận</span>
                 @elseif($order['status'] === 2)
                 <span class="badge bg-info">Đang xử lý</span>
                 @elseif($order['status'] === 3)
                <span class="badge bg-success">Hoàn tất</span>
                 @else
                <span class="badge bg-secondary">Đã huỷ</span>
                 @endif
            </div>
        <div class="mb-2">
            <strong>Tổng tiền:</strong> {{ number_format((float) $order['total'], 0, ',', '.') }} VND
        </div>

        <div class="mb-2">
            <strong>Phương thức thanh toán: </strong> 
            @if($order['payment_method'] === 0)
                <span class="badge bg-secondary text-light">Tiền mặt(COD)</span>
            @else($order['payment_method'] === 1)
                <span class="badge bg-secondary text-light">Chuyển khoản(BANK)</span>
            @endif
        </div>

        <div class="mb-2">
            <strong>Tình trạng thanh toán: </strong> 
            @if($order['payment_status'] === 0)
                <span class="badge bg-warning text-dark">Chưa thanh toán</span>
            @else($order['payment_status'] === 1)
                <span class="badge bg-success">Đã thanh toán</span>
            @endif
        </div>
        <h5 class="section-title">Chi tiết các sản phẩm:</h5>

        <table class="table table-bordered table-hover mt-2">
            <thead class="table-light">
                <tr>
                    <th>Hình sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng giá</th>
                    
                </tr>
            </thead>
            <tbody>
           @foreach($order['products'] as $product)
                <tr>
                    <td><img src="{{ asset('images/products/' . $product['product_photo']) }}" alt="{{ $product['product_name'] }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;"></td>
                    <td>{{ $product['product_name'] ?? 'Không rõ' }}</td>
                    <td>{{ $product['quantity'] ?? 'N/A' }}</td>
                    <td>{{ number_format((float) ($product['price'] ?? 0), 0, ',', '.') }} VND</td>
                    <td>{{ number_format((float) $product['price']*$product['quantity'], 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
            </tbody>
        </table>

             <div class="d-flex justify-content-between mt-4">
               <a href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
            </div>
 

    </div>
</body>
</html>

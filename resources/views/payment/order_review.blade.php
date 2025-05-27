@extends('header')
@section('content')
<div class="container" style="max-width:700px; margin:40px auto; padding:24px 32px; background:#fff; border-radius:16px; box-shadow:0 8px 24px rgba(254,188,139,0.3); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#333;">
    <h2 style="color:#febc8b; margin-bottom:16px; font-weight:700; font-size:28px; border-bottom:2px solid #febc8b; padding-bottom:8px;">Chi tiết đơn hàng</h2>

    @foreach ($products as $item)
        <div style="padding:12px 0; border-bottom:1px solid #eee; font-size:16px; display:flex; justify-content:space-between;">
            <span>{{ $item->product_name }} - SL: {{ $quantity[$item->product_id] }}</span>
            <span>{{ number_format($item->price) }} VND</span>
        </div>
    @endforeach

    <p style="font-weight:700; font-size:18px; margin-top:20px; text-align:right; color:#444;">
        Tổng: {{ number_format($totalPrice) }} VND
    </p>

    <h3 style="color:#febc8b; margin-top:32px; margin-bottom:16px; font-weight:700; font-size:22px;">Thông tin giao hàng</h3>
    <div style="margin-bottom:32px; font-size:16px; color:#333;">
        <p><strong>Họ tên:</strong> {{ session('delivery.name') }}</p>
        <p><strong>Số điện thoại:</strong> {{ session('delivery.phone') }}</p>
        <p><strong>Địa chỉ:</strong> {{ session('delivery.address') }}</p>
    </div>

    <form method="POST" action="{{ route('payment.confirm') }}">
        @csrf
        <label for="payment_method" style="display:block; font-weight:600; margin-bottom:8px; color:#555;">Phương thức thanh toán:</label>
        <select name="payment_method" id="payment_method" required style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #ccc; font-size:16px; outline:none; transition:border-color 0.3s ease;">
            <option value="cash">Tiền mặt (COD)</option>
            <option value="bank_transfer">Chuyển khoản (BANK)</option>
        </select>
        <button type="submit" style="margin-top:24px; width:100%; background:linear-gradient(90deg, #febc8b 0%, #f9a825 100%); color:#fff; font-weight:700; font-size:18px; padding:14px 0; border:none; border-radius:12px; cursor:pointer; transition: transform 0.2s ease, box-shadow 0.3s ease;">
            Hoàn tất đơn hàng
        </button>
    </form>
</div>
@endsection

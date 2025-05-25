@extends('header')
@section('content')
<div class="container">
    <h2>Chi tiết đơn hàng</h2>

    @foreach ($products as $item)
        <div>{{ $item->product_name }} - SL: {{ $quantity[$item->product_id] }} - Giá: {{ number_format($item->price) }}</div>
    @endforeach

    <p>Tổng: {{ number_format($totalPrice) }} VND</p>

    <h3>Thông tin giao hàng</h3>
    <p>{{ session('delivery.name') }}</p>
    <p>{{ session('delivery.phone') }}</p>
    <p>{{ session('delivery.address') }}</p>

    <form method="POST" action="{{ route('payment.confirm' ) }}">
        @csrf
        <label>Phương thức thanh toán:</label>
        <select name="payment_method">
            <option value="cash">Tiền mặt(COD)</option>
            <option value="bank_transfer">Chuyển khoản(BANK)</option>
        </select>
        <button type="submit">Hoàn tất đơn hàng</button>
    </form>

    <!-- <form method="POST" action="">
        @csrf
        <button type="submit">Hủy đơn hàng</button>
    </form> -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            text: '{{ $errors->first() }}',
        });
    </script>
@endif
@endsection

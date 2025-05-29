@extends('header')
@section('content')
<div class="container" style="max-width:700px; margin:40px auto; padding:24px 32px; background:#fff; border-radius:16px; box-shadow:0 8px 24px rgba(254,188,139,0.3); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#333;">

    <h3 style="color:#febc8b; margin-bottom:16px; font-weight:700; font-size:22px;">Thông tin giao hàng</h3>
    <div style="margin-bottom:20px; font-size:14px; color:#333; line-height:1.2;">
    <p style="margin: 4px 0;"><strong>Họ tên:</strong> {{ session('delivery.name') }}</p>
    <p style="margin: 4px 0;"><strong>Số điện thoại:</strong> {{ session('delivery.phone') }}</p>
    <p style="margin: 4px 0;"><strong>Địa chỉ:</strong> {{ session('delivery.address') }}</p>
    </div>


    <h2 style="color:#febc8b; margin-bottom:16px; font-weight:700; font-size:28px; border-bottom:2px solid #febc8b; padding-bottom:8px;">Chi tiết đơn hàng</h2>
    <div class="fw-bold">Mã đơn hàng: #{{ $order->order_id }}</div>
    <div class="mb-4 p-3 rounded">
        @foreach ($order->order_details as $item)
        @php $arrImg = explode(",", $item->product->product_photo); @endphp
            <div class="product-item d-flex align-items-center gap-3 mb-2 p-2 border rounded bg-white">
                <a href="{{ route('product.detail', ['id' => $item->product->product_id]) }}">
                    <img src="{{ asset('images/products/' . $arrImg[0]) }}" alt="{{ $item->product->product_name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                </a>
                <div class="flex-grow-1">
                    <a href="{{ route('product.detail', ['id' => $item->product->product_id]) }}" class="text-decoration-none text-dark">
                        <strong>{{ $item->product->product_name }}</strong>
                    </a>
                    <div>Số lượng: {{ $item->quantity }}</div>
                </div>
                <div>{{ number_format($item->price) }} đ</div>
            </div>
        @endforeach
    </div>

    <p style="font-weight:700; font-size:18px; margin-top:20px; text-align:right; color:#444;">
        Tổng: {{ number_format($order->total_price) }} đ
    </p>

    <form method="{{($order->payment && $order->payment->payment_status == 1)|| ($order->status == -1)?'GET':'POST'}}" action="{{(($order->payment && $order->payment->payment_status == 1)|| ($order->status == -1))?route('history.index'): route('payment.confirm') }}">
        @csrf
        <input type='hidden' name="order_id" value="{{ $order->order_id }}">

        <label for="payment_method" style="display:block; font-weight:600; margin-bottom:8px; color:#555;">
            Phương thức thanh toán:
        </label>

        @if(($order->payment && $order->payment->payment_status == 1) || ($order->status == -1))
            <select name="payment_method" id="payment_method" disabled
                    style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #ccc; font-size:16px; background:#eee; color:#666;">
                <option value="{{ $order->payment->payment_method }}" selected>
                    @if($order->payment->payment_method == 0)
                        Tiền mặt (COD)
                    @elseif($order->payment->payment_method ==1)
                        Chuyển khoản (BANK)
                    @else
                        {{ $order->payment->payment_method }}
                    @endif
                </option>
            </select>
            @if($order->payment && $order->payment->payment_status == 1)
            <p style="margin-top:8px; color:green; font-weight:700;">
                Đơn hàng đã được thanh toán.
            </p>
            @endif
        @else
            <select name="payment_method" id="payment_method" required
                    style="width:100%; padding:10px 14px; border-radius:10px; border:1px solid #ccc; font-size:16px; outline:none; transition:border-color 0.3s ease;">
                <option value="0">Tiền mặt (COD)</option>
                <option value="1">Chuyển khoản (BANK)</option>
            </select>
        @endif

        <button type="submit"
            style="margin-top:24px; width:100%; background:linear-gradient(90deg, #febc8b 0%, #f9a825 100%); color:#fff; font-weight:700; font-size:18px; padding:14px 0; border:none; border-radius:12px; cursor:pointer; transition: transform 0.2s ease, box-shadow 0.3s ease;">
            {{ (($order->payment && $order->payment->payment_status == 1)|| ($order->status == -1)) ? 'Trở về' : 'Hoàn tất đơn hàng' }}
        </button>
    </form>

    @if($order->status == 0||$order->status == 1)
        <form id="cancel-form-{{ $order->order_id }}" method="POST" action="{{ route('payment.cancel') }}" onsubmit="return confirmDelete(event, {{ $order->order_id }});">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
            <button class="bg-secondary text-light" type="submit"
                style="margin-top:16px; width:100%; font-weight:700; font-size:16px; padding:12px 0; border:none; border-radius:10px; cursor:pointer;">
                Huỷ đơn hàng
            </button>
        </form>
    @endif

</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, id) {
        event.preventDefault(); // Ngăn form submit ngay
        Swal.fire({
            title: 'Bạn có chắc chắn muốn huỷ đơn?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53935',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Vâng, huỷ!',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-form-' + id).submit(); // Submit form huỷ
            }
        });
        return false;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            timer: 4000,
            showConfirmButton: false,
        });
    @endif
</script>
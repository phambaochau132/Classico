@extends('header')
@section('content')
<div class="header-mid">
    <div class="container">
        <div class="row">
            <div class="col-md-4 logo">

            </div>
            <div class="col-md-4 search-box">
                <form action="{{route('product.search')}}" method="get">
                    <input placeholder="Search" type="search" name="key">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="col-md-4 wishlist-cart">
                <nav class="navbar navbar-expand-sm">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fa fa-shopping-cart fa-lg"></i>
                            <span class="cart-item ms-1">Giỏ hàng</span>
                            @php
                                $cartCount = session('cart') ? count(session('cart')) : 0;
                            @endphp

                            @if ($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                    <span class="visually-hidden">sản phẩm trong giỏ</span>
                                </span>
                            @endif
                        </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h2 class="title-main">Lịch sử mua hàng</h2>

    @forelse ($orderList as $order)
        <div class="section-border mb-4 p-3 rounded shadow-sm" onclick="window.location='{{ route('payment.review', ['order_id' => $order->order_id]) }}'">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="fw-bold">Mã đơn hàng: #{{ $order->order_id }}</div>
                <div>
                    @if($order->status === 0)
                    <span class="badge bg-warning">Chờ thanh toán</span>
                    @elseif($order->status === 1)
                        <span class="badge bg-warning">Chờ xác nhận</span>
                    @elseif($order->status === 2)
                        <span class="badge bg-info">Đang xử lý</span>
                    @elseif($order->status === 3)
                        <span class="badge bg-success">Hoàn tất</span>
                    @else
                        <span class="badge bg-secondary">Đã huỷ</span>
                    @endif
                </div>
            </div>

            <div class="text-muted mb-2">Ngày đặt: {{ $order->order_date->format('d/m/Y H:i') }}</div>
            <div class="text-muted mb-3">
                <strong>Hình thức thanh toán:</strong> 
                @if ($order->payment_method === 'cash')
                    Tiền mặt
                @elseif ($order->payment_method === 'bank_transfer')
                    Chuyển khoản
                @endif
            </div>
            <div class="mb-2"><strong>Sản phẩm</strong></div>
            <div class="product-list" style="max-height: none;">
                @foreach ($order->order_details as $index => $item)
                    @php $arrImg = explode(",", $item->product->product_photo); @endphp
                    <div class="product-item d-flex align-items-center gap-3 mb-2 p-2 border rounded bg-white {{ $index >= 1 ? 'd-none more-products' : '' }}">
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

            @if (count($order->order_details) > 1)
                <div class="text-center">
                    <button class="btn btn-sm btn-outline-secondary toggle-more" onclick="toggleProducts(this)">Xem thêm</button>
                </div>
            @endif

            <div class="text-end fw-bold mt-2">Tổng cộng: {{ number_format($order->total_price) }} đ</div>
        </div>
    @empty
        <p>Bạn chưa có đơn hàng nào.</p>
    @endforelse
</div>

<script>
    function toggleProducts(button) {
        const container = button.closest('.section-border');
        const hiddenItems = container.querySelectorAll('.more-products');

        hiddenItems.forEach(el => el.classList.toggle('d-none'));

        if (button.innerText === 'Xem thêm') {
            button.innerText = 'Thu gọn';
        } else {
            button.innerText = 'Xem thêm';
        }
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
@endsection


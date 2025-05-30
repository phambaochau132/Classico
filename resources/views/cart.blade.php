@extends('header')
@section('content')
<style>
    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

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
<div class="container">
    @if(!empty($products) && count($products) > 0)
    <div class="content home-bg">
        <div class="row cart">
            <div class="col-md">Delete</div>
            <div class="col-md">Image</div>
            <div class="col-md-3">Product</div>
            <div class="col-md">Price</div>
            <div class="col-md">Quantity</div>
            <div class="col-md">Total</div>
        </div>
    </div>
    @foreach($products as $product)
    @php
    $id=$product->product_id;
    $arrImg=explode(",",$product->product_photo);
    @endphp

    <div class="row product" style="margin-top: 30px;">
        <div class="col-md"><a href="#" onclick="confirmDelete({{ $id }})"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
        <div class="col-md">
            <a href="{{route('product.detail',['id'=>$id])}}">
                <img src="{{asset('images/products/'.$arrImg[0])}}" class="img-fluid">
            </a>
        </div>
        <div class="col-md-3"><a href="{{route('product.detail',['id'=>$id])}}">{{ $product->product_name }}</a></div>
        <div class="col-md">{{ $product->price}}</div>
        <div class="col-md">
            <form action="{{route('cart.update',['id'=>$id])}}" method="POST" id="myform_{{ $id}}">
                @csrf
                <button type="button" onclick="changeQuantity({{ $id }}, -1)">-</button>
                <input type="number" step="1" min="0" max="{{ $product->stock_quantity }}" name="num_{{ $id }}" id="input_{{ $id }}" value="{{ $quantity[$id] ?? 0 }}" onchange="inputChanged({{ $id }}, {{ $quantity[$id] ?? 0 }})" onkeydown="if(event.key === 'Enter'){ event.preventDefault(); inputChanged({{ $id }}, {{ $quantity[$id] ?? 0 }}); }">
                <button type="button" onclick="changeQuantity({{ $id }}, 1)">+</button>
            </form>
        </div>
        <div class="col-md">{{ isset($quantity[$id]) ? $product->price * $quantity[$id] : 0 }}</div>
    </div>
    @endforeach
    <a href="{{route('payment.index')}}"><button style="margin-top: 60px; margin-left: 10px;font-size: 12px;font-weight: 700;height: 45px;width: 230px;background: #232323;color: #ffffff;
    outline: none;"> Continute to shopping</button></a>
    @else
    <div style="text-align: center">Shopping Cart no products</div>
    <a href="{{url('/')}}"><button style="margin-top: 60px; margin-left: 10px;font-size: 12px;font-weight: 700;height: 45px;width: 230px;background: #232323;color: #ffffff;
    outline: none;"> Return to home</button></a>
    @endif
</div>
<script type="text/javascript">
    function changeQuantity(id, delta) {
        const input = document.getElementById('input_' + id);
        let newVal = parseInt(input.value) + delta;
        if (newVal < 0) newVal = 0;
        
        if (newVal === 0) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Sản phẩm sẽ bị xóa khỏi giỏ hàng!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Vâng, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    input.value = 0;
                    document.getElementById('myform_' + id).submit();
                } else {
                    input.value = 1;  // Trả về giá trị trước đó hoặc 1
                }
            });
        } else {
            input.value = newVal;
            document.getElementById('myform_' + id).submit();
        }
    }

        function inputChanged(id, oldVal) {
        const input = document.getElementById('input_' + id);
        let newVal = parseInt(input.value);

        if (newVal < 0) {
            input.value = oldVal;
            return;
        }

        if (newVal === 0) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Sản phẩm sẽ bị xóa khỏi giỏ hàng!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Vâng, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myform_' + id).submit();
                } else {
                    input.value = oldVal;
                }
            });
        } else {
            // Giá trị hợp lệ, submit luôn
            document.getElementById('myform_' + id).submit();
        }
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Sản phẩm sẽ bị xóa khỏi giỏ hàng!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Vâng, xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/cart/delete?id=${id}`;
            }
        });
    }
</script>
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
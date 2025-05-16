@extends('header')
@section('content')
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
                        <img src="{{asset('images/'. $arrImg[0])}}" class="img-fluid">   
                    </a>
                </div>
                <div class="col-md-3"><a href="{{route('product.detail',['id'=>$id])}}">{{ $product->product_name }}</a></div>
                <div class="col-md">{{ $product->price}}</div>
                <div class="col-md">
                <form action="{{route('cart.update',['id'=>$id])}}" method="POST" id="myform_{{ $id}}">
                @csrf    
                <input type="number" step="1" min="0" max="100" name="num_{{ $id }}"
                value="{{ $quantity[$id] ?? 0 }}" onclick="submitform({{ $id }})">
                </form>
                </div>
                <div class="col-md">{{ isset($quantity[$id]) ? $product->price * $quantity[$id] : 0 }}</div>
                </div>
            @endforeach
            <a href="{{url('/')}}"><button  style="margin-top: 60px; margin-left: 10px;font-size: 12px;font-weight: 700;height: 45px;width: 230px;background: #232323;color: #ffffff;
    outline: none;"> Continute to shopping</button></a> 
        @else
            <div style="text-align: center">Shopping Cart no products</div>
            <a href="{{url('/')}}"><button  style="margin-top: 60px; margin-left: 10px;font-size: 12px;font-weight: 700;height: 45px;width: 230px;background: #232323;color: #ffffff;
    outline: none;"> Return to home</button></a>
        @endif
    </div>
<script type="text/javascript">
function submitform(id) {   
    document.getElementById('myform_'+id).submit(); }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            text: '{{ $errors->first() }}',
        });
    </script>
@endif
 @endsection
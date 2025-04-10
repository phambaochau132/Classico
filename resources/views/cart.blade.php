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
                $id=$product->id;
                $productPath = strtolower(str_replace(' ', '-', $product->product_name)) . '-' . $product->id;
                $arrImg=explode(",",$product->product_photo);
                @endphp  

                <div class="row product" style="margin-top: 30px;">
                <div class="col-md"><a href="{{url('cart.delete',$id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                <div class="col-md"><a href="{{url('product',$productPath)}}">
                <img src="{{asset('images/'. $arrImg[0])}}" class="img-fluid">                                    </a></div>
                <div class="col-md-3"><a href="{{url('product',$productPath)}}">{{ $product->product_name }}</a></div>
                <div class="col-md">{{ $product->product_price}}</div>
                <div class="col-md">
                <form action="{{url('cart.update',$id)}}" method="POST" id="myform_{{ $id}}">
                    <input type="number" step="1" min="0" max="100" name="num_{{ $id }}"
                value="{{ $quantity[$id] ?? 0 }}" onclick="submitform({{ $id }})">
                </form>
                </div>
                <div class="col-md">{{ isset($quantity[$id]) ? $product->product_price * $quantity[$id] : 0 }}</div>
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
 @endsection
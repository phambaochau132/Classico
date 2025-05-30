@extends('header')
@section('content')


<div class="content home-bg">
    <div class="container">
        @php $key = request()->get('search', '') @endphp
        <h3> Search Result for "
            {{$key}}
        </h3><br>
        <div class="row">

            @foreach ($searchProducts as $item)

            <div class="col-md-3">
                <div class="tab-content">
                    <div class="single-product">
                        <div class="product-img">
                            @php $productPath =$item->product_id; @endphp
                            <a href="{{route('product.detail',['id'=>$productPath]) }}">
                                @php $arrImg = explode(",", $item->product_photo)@endphp
                                <img src="{{asset('images/products/'. $arrImg[0]) }}" class="img-fluid">
                        </div>
                        <div class="content-product">
                            <h4><a href="{{route('product.detail',['id'=>$productPath])}}">
                                    {{$item->product_name}}
                                </a></h4>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="price">
                                <span class="current_price">
                                    ${{$item->price}}
                                </span>
                            </div>
                            <div class="add_to_cart category">
                                <a href="{{route('cart.add',$item->id)}}" title="Add to cart"><i
                                        class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
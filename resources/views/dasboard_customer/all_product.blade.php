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
                            <a class="nav-link" href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <div class="cart-item">CART ITEMS</div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light menu">
            <ul class="navbar-nav mr-auto ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer.home') }}">HOME</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#">CATEGORIES <i class="fa fa-angle-down"></i></a>
                    <div class="dropdown-content">
                        @foreach ($categories as $item)
                        <div class="dropdown-link">
                            <a href="{{ route('product.cate', ['category' => $item->category_id]) }}">
                                {{ $item->category_name }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</div>
<div class="content home-bg">
    <div class="container">
        @if (isset($key) && $key)
        <h3>Search Result for "{{ $key }}"</h3><br>
        @endif

        <div class="row">
            @forelse ($products as $item)
            <div class="col-md-3">
                <div class="tab-content">
                    <div class="single-product">
                        <div class="product-img">
                            @php $productPath = $item->product_id; @endphp
                            <a href="{{ route('product.detail', ['id' => $productPath]) }}">
                                @php $arrImg = explode(',', $item->product_photo); @endphp
                                <img src="{{ asset('images/products/' . $arrImg[0]) }}" class="img-fluid" alt="{{ $item->product_name }}">
                            </a>
                        </div>
                        <div class="content-product">
                            <h4>
                                <a href="{{ route('product.detail', ['id' => $productPath]) }}">
                                    {{ $item->product_name }}
                                </a>
                            </h4>
                            <div class="product-rating">
                                <ul>
                                    @for ($i = 0; $i < 5; $i++)
                                        <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                        @endfor
                                </ul>
                            </div>
                            <div class="price">
                                <span class="current_price">${{ $item->price }}</span>
                            </div>
                            <div class="add_to_cart category">
                                <a href="{{ route('cart.add', $item->id) }}" title="Add to cart">
                                    <i class="fa fa-shopping-cart"></i> Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fa fa-info-circle fa-3x mb-3 text-muted"></i>
                <h4 class="text-muted">Không có sản phẩm nào phù hợp.</h4>
                <p>Vui lòng thử với từ khóa hoặc danh mục khác.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
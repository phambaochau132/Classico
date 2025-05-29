@extends('header')
@section('content')

<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  -->


    <style>
        .home-bg {
            padding: 20px 0;
        }

        .cart .col-md,
        .cart .col-md-3 {
            text-align: center;
        }

        .product .col-md,
        .product .col-md-3 {
            margin: auto;
            text-align: center;
        }

        .product .col-md a,
        .product .col-md-3 a {
            color: #212529;
        }

        i.fa.fa-trash {
            font-size: 25px;
        }
    </style>
</head>
<!--SLIDER-->
<script>
    $(document).ready(function() {
        $('.slider').owlCarousel({
            loop: true,
            animateOut: 'fadeOut',
            items: 1,
            smartSpeed: 450,
            dots: true
        });
    });
</script>
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
<div class="slider owl-carousel owl-theme">
    <div class="carousel-item active" id="slide-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider_content">
                        <h2>Big sale up to 20% off </h2>
                        <h1>SUMMER SALE</h1>
                        <p>Lorem ipsum dolor sit amet elit. Provident, magni quae nisi minima ut doloribus natus
                            eos, dolores aliquam ducimus.</p>
                        <a href="{{route('product.all')}}" class="btn-shop">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item active" id="slide-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider_content">
                        <h2>Big sale up to 20% off </h2>
                        <h1>SUMMER SALE</h1>
                        <p>Lorem ipsum dolor sit amet elit. Provident, magni quae nisi minima ut doloribus natus
                            eos, dolores aliquam ducimus.</p>
                        <a href="all_products.php" class="btn-shop">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--CONTENT-->
<div class="home-bg">
    <!--Banner-->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md banner-style1">
                    <h3>MINIBOOTS</h3>
                    <div class="banner_text_img">
                        <p>new arrival <img src="./public/images/banner_static1.png" alt=""></p>
                    </div>
                </div>
                <div class="col-md banner-style2">
                    <h3>MINIBOOTS</h3>
                    <div class="banner_text_img">
                        <p>new arrival <img src="./public/images/banner_static2.png" alt=""></p>
                    </div>
                </div>
                <div class="col-md banner-style3">
                    <h3>MINIBOOTS</h3>
                    <div class="banner_text_img">
                        <p>new arrival <img src="./public/images/banner_static3.png" alt=""></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Product-->
    <script>
        $(document).ready(function() {
            $('.colum').owlCarousel({
                loop: true,
                margin: 15,
                nav: true,
                items: 3,
                dots: false
            })
        });
        $(document).ready(function() {
            $('.tab-content').owlCarousel({
                loop: true,
                margin: 15,
                nav: true,
                items: 5,
                dots: false
            })
        });
        $(document).ready(function() {
            $('.colum-6').owlCarousel({
                loop: true,
                margin: 15,
                nav: true,
                items: 6,
            })
        });

        function activeNavItem(item) {
            $('.nav-item').removeClass('active');
            $(item).addClass('active');
            console.log('Thanh congcong');

            let productType = $(item).find('.nav-link').text().trim();
            let tabContent = $('#order_by');
            const cartAddUrl = @json(route('cart.add', ['id' => '__ID__']));
            const productDetailUrl = @json(route('product.detail', ['id' => '__ID__']));

            const csrfToken = @json(csrf_token());
            $.ajax({
                url: "{{ route('product.order_by') }}",
                method: 'GET',
                data: {
                    order_by: productType
                },
                success: function(respone) {
                    let html = '';
                    respone.forEach(function(item) {
                        let productPath = item.product_id;
                        let photo = item.product_photo.split(',')[0];

                        html += `<div class="single-product">
                                    <div class="product-img">
                                        <a href="${productDetailUrl.replace('__ID__', productPath)}">
                                            <img src="/images/products/${photo}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="content-product">
                                        <h4>
                                            <a href="${productDetailUrl.replace('__ID__', productPath)}">${item.product_name}</a>
                                        </h4>
                                        <div class="price">
                                            <span class="current_price">$${item.price}</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <form action="${cartAddUrl.replace('__ID__', productPath)}" method="POST">
                                                <input type="hidden" name="_token" value="${csrfToken}">
                                                <button type="submit">
                                                    <i class="fa fa-shopping-cart"></i> Add to cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            `;
                    });
                    tabContent.trigger('destroy.owl.carousel');

                    tabContent.html(html);
                    tabContent.owlCarousel({
                        loop: true,
                        margin: 15,
                        nav: true,
                        items: 5,
                        dots: false
                    })
                },
                error: function(err) {
                    console.error('Lỗi khi tải sản phẩm:', err);
                }
            });
        }
    </script>
    <div class="product-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-sm navbar-light tab-btn">
                        <ul class="navbar-nav mr-auto ml-auto mt-lg-0">
                            <li class="nav-item active" onclick="activeNavItem(this)">
                                <a class="nav-link">NEW PRODUCT</a>
                            </li>
                            <li class="nav-item" onclick="activeNavItem(this)">
                                <a class="nav-link">FEATURED PRODUCTS</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content owl-carousel owl-theme" id="order_by">
                        @foreach ($productBy as $item)
                        @php
                        $productPath = $item->product_id;
                        @endphp
                        <div class="single-product">
                            <div class="product-img">
                                @php $arrImg = explode(",", $item->product_photo) @endphp
                                <a href="{{route('product.detail',['id'=>$productPath])}}">
                                    <img src="{{asset('images/products/'.$arrImg[0])}}" class="img-fluid">
                                </a>
                            </div>
                            <div class="content-product">
                                <h4><a
                                        href="{{route('product.detail',['id'=>$productPath])}}">{{ $item->product_name }}</a>
                                </h4>
                                <div class="price">
                                    <span class="current_price">${{ $item->price }}</span>
                                </div>
                                <div class="add_to_cart">
                                    <form action="{{ route('cart.add', ['id' => $productPath]) }}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <i class="fa fa-shopping-cart"></i> Add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-2">
        <div class="container">
            <div class="row">
                @foreach($categories as $item)
                <div class="col-6">
                    <div class="title">
                        <h2>{{$item->category_name}}</h2>
                    </div>
                    <div class="colum tab-content owl-carousel owl-theme">
                        @foreach ($cateproducts[$item->category_id] as $item)
                        @php
                        $productPath = $item->product_id;
                        @endphp
                        <div class="single-product">
                            <div class="product-img">
                                @php $arrImg = explode(",", $item->product_photo) @endphp
                                <a href="{{route('product.detail',['id'=>$productPath])}}">
                                    <img src="{{asset('images/products/'.$arrImg[0])}}" class="img-fluid">
                                </a>
                            </div>
                            <div class="content-product">
                                <h4><a
                                        href="{{route('product.detail',['id'=>$productPath])}}">{{ $item->product_name }}</a>
                                </h4>
                                <div class=" product-rating">
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
                                    <span class="current_price">${{ $item->price }}</span>
                                </div>
                                <div class="add_to_cart">
                                    <form action="{{ route('cart.add', ['id' => $productPath]) }}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <i class="fa fa-shopping-cart"></i> Add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--Shipping-->
    <div class="shipping">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <img src="{{asset('images/shipping1.png')}}" alt="shipping-1">
                    <div class="content-shipping">
                        <h3>
                            RESPONSIVE LAYOUT
                        </h3>
                        <p>
                            Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper
                            suscipit.
                        </p>
                    </div>
                </div>
                <div class="col-md">
                    <img src="{{asset('images/shipping2.png')}}" alt="shipping-2">
                    <div class="content-shipping">
                        <h3>
                            RETINA READY
                        </h3>
                        <p>
                            Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper
                            suscipit.
                        </p>
                    </div>
                </div>
                <div class="col-md">
                    <img src="{{asset('images/shipping3.png')}}" alt="shipping-3">
                    <div class="content-shipping">
                        <h3>
                            EASY CUSTOMIZE
                        </h3>
                        <p>
                            Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper
                            suscipit.
                        </p>
                    </div>
                </div>
                <div class="col-md">
                    <img src="{{asset('images/shipping4.png')}}" alt="shipping-4">
                    <div class="content-shipping">
                        <h3>
                            SALE & SUPPORT
                        </h3>
                        <p>
                            Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper
                            suscipit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>ALL</h2>

                    </div>
                    <a href=" {{route('product.all')}}">See All</a>
                    <div class="tab-content owl-carousel owl-theme">
                        @foreach ($products as $item)
                        <div class="single-product">
                            <div class="product-img">
                                @php $arrImg = explode(",", $item->product_photo) @endphp
                                <a href="{{route('product.detail',['id'=>$productPath])}}">
                                    <img src="{{asset('images/products/'.$arrImg[0])}}" class="img-fluid" alt="Responsive image">
                                </a>
                            </div>
                            <div class="content-product">
                                <h4><a
                                        href="{{route('product.detail',['id'=>$productPath])}}">{{ $item->product_name }}</a>
                                </h4>
                                <div class=" product-rating">
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
                                    <span class="current_price">${{ $item->price }}</span>
                                </div>
                                <div class="add_to_cart">
                                    <form action="{{ route('cart.add', ['id' => $productPath]) }}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <i class="fa fa-shopping-cart"></i> Add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Shipping End-->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>SAMPLE BANNERS</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-box box1">
                        <img src="./public/images/box1.png" alt="">
                        <div class="banner_box_text">
                            <h2>FAST DELIVERY</h2>
                            <p>24 hour parcel delivery</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="banner-box box2">
                        <img src="./public/images/box2.png" alt="">
                        <div class="banner_box_text">
                            <h2>WORLDWIDE SHIPPING</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="banner-box box3">
                        <img src="./public/images/box3.png" alt="">
                        <div class="banner_box_text">
                            <h2>FREE MONEY BACK</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('header')
@section('content')

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
            $.ajax({
                url: "{{ route('product.order_by') }}",
                method: 'GET',
                data: {
                    order_by: productType
                },
                success: function(respone) {
                    let html = '';
                    respone.forEach(function(item) {
                        let productPath = item.id;
                        let photo = item.product_photo.split(',')[0];

                        html += `
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="/product/${productPath}">
                                        <img src="/images/${photo}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="content-product">
                                    <h4>
                                        <a href="/product/${productPath}">${item.product_name}</a>
                                    </h4>
                                    <div class="price">
                                        <span class="current_price">$${item.price}</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a href="/cart/add/${item.id}" title="Add to cart">
                                            <i class="fa fa-shopping-cart"></i> Add to cart
                                        </a>
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

                                <a href="{{route('product.detail',['id'=>$productPath])}}">
                                    @php $arrImg = explode(",", $item->product_photo); @endphp
                                    <img src="{{asset('images/'.$arrImg[0])}}" class="img-fluid">
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
                                    <a href="{{route('cart.add',$item->id)}}" title="Add to cart"><i
                                            class="fa fa-shopping-cart"></i> Add to cart</a>
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

                                <a href="{{route('product.detail',['id'=>$productPath])}}">
                                    @php $arrImg = explode(",", $item->product_photo); @endphp
                                    <img src="{{asset('images/'.$arrImg[0])}}" class="img-fluid">
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
                                    <a href="{{route('cart.add',$item->id)}}" title="Add to cart"><i
                                            class="fa fa-shopping-cart"></i> Add to cart</a>
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
                                <a href="{{route('product.detail',['id'=>$productPath])}}">
                                    @php $arrImg = explode(",", $item->product_photo); @endphp
                                    <img src="{{asset('images/'.$arrImg[0])}}" class="img-fluid">
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
                                    <a href="{{route('cart.add',$item->id)}}" title="Add to cart"><i
                                            class="fa fa-shopping-cart"></i> Add to cart</a>
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
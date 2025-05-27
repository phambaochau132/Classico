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
<div class="content home-bg">
    <div class="container">
        <div class="row">
            <div class="img col-md-4">
                @php $arrImg = explode(",", $item->product_photo) @endphp
                <img style="width:100%;" name="img-main" src="{{asset('images/products/'.$arrImg[0])}}" class="img-fluid">
                @if(count($arrImg)>=1)
                <div class="row">
                    @if(count($arrImg)>=1)
                    <div class="col-md-4"><img onclick="action(src)" src="{{asset('images/products/'.$arrImg[0])}}"
                            class="img-fluid">
                    </div>
                    @endif
                    @if(count($arrImg)>=2)
                    <div class="col-md-4"><img onclick="action(src)" src="{{asset('images/products/'.$arrImg[1])}}"
                            class="img-fluid">
                    </div>
                    @endif
                    @if(count($arrImg)>=3)
                    <div class="col-md-4"><img onclick="action(src)" src="{{asset('images/products/'.$arrImg[2])}}"
                            class="img-fluid">
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <h1>{{$item->product_name}}</h1>
                <p>${{$item->price}}</p>
                <p>
                    {{$item->product_description}}
                </p>
                <form action="{{route('cart.add',['id'=>$item->product_id])}}" method="POST" class="quantity_cart">
                    @csrf
                    <input type="number" step="1" min="1" max="100" name="order_num" value="1">
                    <button type="submit">ADD TO CART</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!--FOOTER-->
<div class="footer">
    <div class="top-footer">
        <div class="container">
            <div class="content row">
                <div class="col-md">
                    <div class="title">
                        <h2>ABOUT US</h2>
                    </div>
                    <div class="logo">
                        <a href="#"><img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid"></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elitse do eiusmod tempor incididunt ut
                        labore et dolore.</p>
                </div>
                <div class="col-md">
                    <div class="title">
                        <h2>THEME FEATURES</h2>
                    </div>
                    <ul>
                        <li><a href="#">Theme Features</a></li>
                        <li><a href="#">Our Other Projects</a></li>
                        <li><a href="#">Typography</a></li>
                        <li><a href="#">One Click To Join Us</a></li>
                        <li><a href="#">Follow Us On Twitter</a></li>
                    </ul>
                </div>
                <div class="col-md">
                    <div class="title">
                        <h2>KEY FEATURES</h2>
                    </div>
                    <div class="contact">
                        <div class="icon">1</div>
                        <p class="text">Choose your wishlist products then add to cart.</p>
                    </div>
                    <div class="contact">
                        <div class="icon">2</div>
                        <p class="text">Call us for more info about our products.</p>
                    </div>
                    <div class="contact">
                        <div class="icon">3</div>
                        <p class="text">Pay by creadit card.</p>
                    </div>
                    <div class="contact">
                        <div class="icon">4</div>
                        <p class="text">We will send this product in 2 days.</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="title">
                        <h2>CONTACT US</h2>
                    </div>
                    <div class="contact">
                        <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <span class="text">
                            Call Us <a href="tel:+001666951">+001 666 951</a><br>
                            Fax <a href="tel:+001678987"> +001 678 987</a>
                        </span>
                    </div>
                    <div class="contact">
                        <span class="icon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                        <span class="text">
                            <a href="tel:+771231234">+77 123 1234</a><br>
                            <a href="tel:+42989876"> +42 98 9876</a>
                        </span>
                    </div>
                    <div class="contact">
                        <span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <span class="text">
                            <a href="mailto:http://1.envato.market/9LbxW">has@posthemes.com</a><br>
                            <a href="mailto:http://1.envato.market/9LbxW">has@posthemes.com</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <p>Copyright &COPY; 2020 <a href="#">Classico</a>. <a href="#">All Rights Reserved.</a></p>
                </div>
                <div class="col-md pay">
                    <a href="#"><img src="{{asset('images/payment.png')}}" alt="payment"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function action(id) {
        document.images['img-main'].src = id;
    }
</script>
@endsection
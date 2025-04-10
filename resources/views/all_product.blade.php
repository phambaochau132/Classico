<!-- session_start();
if(!isset($_SESSION['cart']))
{
$_SESSION['cart']=0;
}
if(!isset($_SESSION['add']))
{
$_SESSION['add']=[];
}
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($class_name) {
require './app/models/' . $class_name . '.php';
});
$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getCategories();

$productModel = new ProductModel();
$productModel->sortNewProduct();

$totalRow = $productModel->getTotalRow();
$perPage = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$productList = $productModel->getProductsByPage($perPage, $page);
$pageLinks = Pagination::createPageLinks($totalRow, $perPage, $page); -->
@extends('header')
@section('content')
<div class="content home-bg">
    <div class="container">
        <div class="row">

            @foreach ($products as $item)

            <div class="col-md-3">
                <div class="tab-content">
                    <div class="single-product">
                        <div class="product-img">
                            @php $productPath =$item->product_id; @endphp
                            <a href="{{route('product.detail',['id'=>$productPath]) }}">
                                @php $arrImg = explode(",", $item->product_photo)@endphp
                                <img src="{{asset('images/'. $arrImg[0]) }}" class="img-fluid">
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

<!--FOOTER-->

@endsection
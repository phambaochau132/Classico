<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        $cateproducts = Product::all();
        $newProducts = Product::orderBy('create_at', 'desc')->limit(10)->get();
        //Lọc sản phẩm theo tiêu chí(mới nhất hoặc nổi bậtbật)
        $productBy = $newProducts;

        foreach ($categories as $cate) {
            $query = Product::where('category_id', $cate->category_id)->get();
            $cateproducts[$cate->category_id] = $query;
        }
        return view('dashboard', compact('products', 'cateproducts', 'categories', 'productBy'));
    }
    public function all(Request $request)
    {
        $products = Product::all();
        return view('all_product', compact('products'));
    }
    public function detail(Request $request)
    {
        $id = $request->get('id');
        $item = Product::find($id);
        return view('detail', compact('item'));
    }
    public function get_products(Request $request)
    {
        $order_by = $request->get('order_by', '');

        //Lọc sản phẩm theo tiêu chí(mới nhất hoặc nổi bật)
        $featureProducts = Product::orderBy('product_view', 'desc')->limit(10)->get();
        $newProducts = Product::orderBy('create_at', 'desc')->limit(10)->get();
        $productBy = $newProducts;
        if ($order_by == 'FEATURED PRODUCTS') {
            $productBy = $featureProducts;
        }
        return response()->json($productBy);
    }
    public function search(Request $request){
        $key = $request->get('key', '');
        $searchProducts=Product::where('product_name','like','%'.$key.'%')->get();
        return view('search', compact('searchProducts'));
    }

}

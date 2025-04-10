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
        $newproducts = Product::all();
        $cateproducts = Product::all();
        foreach ($categories as $cate) {
            $query = Product::where('category_id', $cate->category_id)->get();
            $cateproducts[$cate->category_id] = $query;
        }
        return view('dashboard', compact('products', 'newproducts', 'cateproducts', 'categories'));
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
    // public function create($id)
    // {
    //     $product = session('product', []);
    //     $quantity = session('quantity', []);

    //     if (!in_array($id, $product)) {
    //         $product[] = $id;
    //         $quantity[$id] = 1;
    //     } else {
    //         $quantity[$id]++;
    //     }

    //     session(['product' => $product, 'quantity' => $quantity]);

    //     return redirect()->route('product.index');
    // }

    // public function update(Request $request, $id)
    // {
    //     $num = $request->input("num_$id");
    //     $quantity = session('quantity', []);
    //     $quantity[$id] = (int) $num;
    //     session(['quantity' => $quantity]);

    //     return redirect()->route('product.index');
    // }

    // public function delete($id)
    // {
    //     $product = session('product', []);
    //     $quantity = session('quantity', []);

    //     if (($key = array_search($id, $product)) !== false) {
    //         unset($product[$key]);
    //         unset($quantity[$id]);
    //     }

    //     session(['product' => $product, 'quantity' => $quantity]);

    //     return redirect()->route('product.index');
    // }
}
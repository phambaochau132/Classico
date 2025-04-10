<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart',[]);
        $quantity = session('quantity',[]);
        $categories = Category::all();

        $products = [];
        $totalItems = 0;

        foreach ($cart as $id) {
            $product = Product::find($id);
            if ($product) {
                $products[] = $product;
                $totalItems += $quantity[$id] ?? 0;
            }
        }

        session(['coppy_cart' => $totalItems]);

        return view('cart', compact('products', 'quantity', 'categories', 'totalItems'));
    }

    public function add(Request $request)
    {
        $id = $request->get('id');
        $cart = session('cart',[]);
        $quantity = session('quantity',[]);
        $order_num=(int)$request->input("order_num",1);
        $product = Product::find($id);

        if($product->stock_quantity<$quantity[$id]){
            return redirect()->route('cart.index')->withErrors('Sản phẩm không đủ số lượng!');
        }

        if (!in_array($id, $cart)) {
            $cart[] = $id;
            $quantity[$id] = $order_num;
        } else {
            $quantity[$id]+=$order_num;
        }

        session(['cart' => $cart, 'quantity' => $quantity]);

        return redirect()->route('cart.index');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $num = $request->input("num_$id");
        $quantity = session('quantity', []);
        $quantity[$id] = (int) $num;

        $product = Product::find($id);

        if($product->stock_quantity<$quantity[$id]){
            return redirect()->route('cart.index')->withErrors('Sản phẩm không đủ số lượng!');
        }

        session(['quantity' => $quantity]);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $cart = session('cart',[]);
        $quantity = session('quantity',[]);

        if (($key = array_search($id, $cart)) !== false) {
            unset($cart[$key]);
            unset($quantity[$id]);
        }

        session(['cart' => $cart, 'quantity' => $quantity]);

        return redirect()->route('cart.index');
    }
}

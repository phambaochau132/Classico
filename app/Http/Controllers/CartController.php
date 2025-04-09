<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', ['1']);
        $quantity = session('quantity', ['1'=>5]);
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

    public function create($id)
    {
        $cart = session('cart', []);
        $quantity = session('quantity', []);

        if (!in_array($id, $cart)) {
            $cart[] = $id;
            $quantity[$id] = 1;
        } else {
            $quantity[$id]++;
        }

        session(['cart' => $cart, 'quantity' => $quantity]);

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $id)
    {
        $num = $request->input("num_$id");
        $quantity = session('quantity', []);
        $quantity[$id] = (int) $num;
        session(['quantity' => $quantity]);

        return redirect()->route('cart.index');
    }

    public function delete($id)
    {
        $cart = session('cart', []);
        $quantity = session('quantity', []);

        if (($key = array_search($id, $cart)) !== false) {
            unset($cart[$key]);
            unset($quantity[$id]);
        }

        session(['cart' => $cart, 'quantity' => $quantity]);

        return redirect()->route('cart.index');
    }
}

?>
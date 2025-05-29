<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class HistoryOrderController extends Controller
{
    public function index(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $pruducts=Product::All();
        $orderList = Order::with('order_details.product')
        ->where('customer_id', $customer->customer_id)
        ->orderByDesc('order_date')
        ->get();
        return view('order_history.index', compact('orderList','pruducts'));
    }
}

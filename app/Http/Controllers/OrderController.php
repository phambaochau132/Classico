<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;




class OrderController extends Controller
{
    public function index()
    {

        $customer_data = Customer::all();
        $order_data = Order::all();
        $orders = [];
        foreach($order_data as $order ) {
            $customer= Customer::find($order->customer_id);
            $orderDetailById= OrderDetail::find($order->order_id);
            $payment = Payment::where('order_id', $order->order_id)->first();
            $Idproducts = OrderDetail::where('order_id', $order->order_id)->get('product_id');
            $productByOrder=[];
            // $ordersDetail=[];
            foreach($Idproducts as $id)
            {
                $product= Product::find($id);
                $productByOrder[]=$product;
            }
            $orders[] = [
                'id' => $customer->customer_id ?? null,
                'customer_name' => $customer->name ?? 'Không rõ',
                'status' => $order->status,
            ];
 
        }

        return view('orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);
    
        // Xóa chi tiết đơn hàng
        OrderDetail::where('order_id', $order->order_id)->delete();
    
        // Xóa thông tin thanh toán nếu có
        Payment::where('order_id', $order->order_id)->delete();
    
        // Cuối cùng là xóa đơn hàng
        $order->delete();
    
        // Trả về trang danh sách đơn hàng với thông báo
        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công!');
    }
    
    public function show(Request $request )
    {
        $id=$request->get('id');
        $customer_data = Customer::all();
        $order_data = Order::all();
        $orders = [];
        foreach($order_data as $order ) {
            $customer= Customer::find($order->customer_id);
            $orderDetailById= OrderDetail::where('order_id', $order->order_id)->get();
            $payment = Payment::where('order_id', $order->order_id)->first();
            $Idproducts = OrderDetail::where('order_id', $order->order_id)->get('product_id');
            $productByOrder=[];
            // $ordersDetail=[];
            foreach($Idproducts as $itemId)
            {
                $product= Product::find($itemId->product_id);
                $productByOrder[] = [
                    'product_name' => $product->product_name ?? 'Không rõ',
                    'price' => $product->price ?? 0,
                    'quantity' => 0,
                ];
                // $product->setAttribute('quantity', );
                // $productByOrder[]=$product;
            }
            $ordersDetail = [
                'id' => $customer->customer_id ?? null,
                'customer_name' => $customer->name ?? 'Không rõ',
                'phone' => $customer->phone ?? '',
                'address' => $customer->address ?? '',
                'order_date' => $order->order_date,
                'status' => $order->status,
                'total' => $orderDetailById->reduce(function ($carry, $item) {
                            $product = Product::find($item->product_id);
                            return $carry + ($product->price * $item->quantity);
                        }, 0),
                'payment_method' => $payment->payment_method ?? 'Chưa thanh toán',
                'products' => $productByOrder
            ];
            $orders [$order->order_id] = $ordersDetail;
 
        }
        $id = (string) $id;

        $order = $orders[$id] ?? null;
        
        if (!$order) {
            abort(404);
        }
        

        return view('orders.show', compact('order', 'productByOrder'));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Delivery;


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
                'id' => $order->order_id,
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
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    
    public function show(Request $request )
    {
        $id=$request->get('id');
        $customer_data = Customer::all();
        $order_data = Order::all();
        $orders = [];
        foreach($order_data as $order ) {
            $customer= Customer::find($order->customer_id);
            $delivery= Delivery::where('order_id', $order->order_id)->first();
            $orderDetailById= OrderDetail::where('order_id', $order->order_id)->get();
            $payment = Payment::where('order_id', $order->order_id)->first();
            $orderDetails = OrderDetail::where('order_id', $order->order_id)->get();

            $productByOrder = [];

            foreach ($orderDetails as $detail) {
                $product = Product::find($detail->product_id);
                $productByOrder[] = [
                    'product_name' => $product->product_name ?? 'Không rõ',
                    'price'        => $product->price ?? 0,
                    'quantity'     => $detail->quantity ?? 0,
                    'total'        => ($product->price ?? 0) * ($detail->quantity ?? 0)
                ];
            }

            $ordersDetail = [
            'id' => $order->order_id, // ✅ Đây mới là ID của đơn hàng
            'customer_name' => $delivery->name,
            'phone' => $delivery->phone ,
            'address' => $delivery->address,
            'order_date' => $order->order_date,
            'status' => $order->status,
            'total' => $orderDetailById->reduce(function ($carry, $item) {
                $product = Product::find($item->product_id);
                return $carry + ($product->price * $item->quantity);
            }, 0),
            'payment_method' => $payment->payment_method,
            'payment_status' => $payment->payment_status,
            'products' => $productByOrder
            ];

            $orders [$order->order_id] = $ordersDetail;
        }
    
        $id = (string) $id;

        $order = $orders[$id] ?? null;
        
        if (!$order) {
            abort(404);
        }
        

                return view('orders.show', [
            'order' => $order
        ]);
    }
}

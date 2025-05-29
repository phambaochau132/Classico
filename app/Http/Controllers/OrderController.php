<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $order_data = Order::when($keyword, function ($query, $keyword) {
            return $query->where('order_id', 'like', "%$keyword%");
        })->paginate(10);
        $customer_data = Customer::all();
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

        return view('orders.index', compact('orders','order_data'));
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
        $status = $request->post('status');
        $order->status =  $status ;
        if($status == 3)
        {
            Payment::where('order_id',$order->order_id)->update(['payment_status' => 1]);
        }
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    
    public function show(Request $request)
{
    $id = $request->get('id');

    // Lấy đơn hàng theo ID
    $order = Order::with(['customer', 'orderDetails.product', 'delivery', 'payment'])
                  ->where('order_id', $id)
                  ->first();

    if (!$order) {
        abort(404, 'Không tìm thấy đơn hàng');
    }

    $products = $order->orderDetails->map(function ($detail) {
        $product = $detail->product;

        return [
            'product_name'   => $product?->product_name ?? 'N/A',
            'product_photo'  => $product?->product_photo ?? null,
            'price'          => $product?->price ?? 0,
            'quantity'       => $detail->quantity,
            'total'          => ($product?->price ?? 0) * $detail->quantity,
        ];
    });

    // Tổng tiền từ order_details (không dùng giá trị cứng từ bảng orders)
    $total = $products->sum('total');

    return view('orders.show', [
        'order' => [
            'id'              => $order->order_id,
            'customer_name'   => $order->delivery?->name ?? 'Không có tên',
            'phone'           => $order->delivery?->phone ?? 'Không có số',
            'address'         => $order->delivery?->address ?? 'Không có địa chỉ',
            'order_date'      => $order->order_date,
            'status'          => $order->status,
            'total'           => $total,
            'payment_method'  => $order->payment?->payment_method,
            'payment_status'  => $order->payment?->payment_status,
            'products'        => $products,
        ]
    ]);
}
    
    //thong ke ndong 
    public function reportRevenue()
    {
    // Tổng doanh thu và số đơn
    $totalRevenue = DB::table('orders')->sum('total_price');
    $totalOrders = DB::table('orders')->count();

    // Đơn hàng theo trạng thái
    $completedOrders = DB::table('orders')->where('status', 'completed')->count();
    $pendingOrders = DB::table('orders')->where('status', 'pending')->count();

    // Doanh thu theo tháng
    $revenueByMonth = DB::table('orders')
        ->select(
            DB::raw('YEAR(order_date) as year'),
            DB::raw('MONTH(order_date) as month'),
            DB::raw('SUM(total_price) as total_revenue'),
            DB::raw('COUNT(order_id) as total_orders')
        )
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    // Doanh thu theo trạng thái đơn hàng
    $revenueByStatus = DB::table('orders')
        ->select('status',
            DB::raw('SUM(total_price) as total_revenue'),
            DB::raw('COUNT(order_id) as total_orders')
        )
        ->groupBy('status')
        ->get();

    return view('orders.report_revenue', compact(
        'totalRevenue', 
        'totalOrders', 
        'completedOrders', 
        'pendingOrders', 
        'revenueByMonth', 
        'revenueByStatus'
    ));
}
public function reportOrders()
{
    $ordersByDay = DB::table('orders')
        ->selectRaw('DATE(order_date) as day, COUNT(*) as total_orders, SUM(total_price) as total_revenue')
        ->groupByRaw('DATE(order_date)')
        ->orderBy('day', 'desc')
        ->get();

    $ordersByMonth = DB::table('orders')
        ->selectRaw('DATE_FORMAT(order_date, "%Y-%m") as month, COUNT(*) as total_orders, SUM(total_price) as total_revenue')
        ->groupByRaw('DATE_FORMAT(order_date, "%Y-%m")')
        ->orderBy('month', 'desc')
        ->get();

    $ordersByStatus = DB::table('orders')
        ->select('status', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_price) as total_revenue'))
        ->groupBy('status')
        ->get();

    return view('orders.report', compact('ordersByDay', 'ordersByMonth', 'ordersByStatus'));
}

}

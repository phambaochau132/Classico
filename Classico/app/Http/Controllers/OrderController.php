<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = [
            ['id' => '001', 'customer_name' => 'Nguyễn Văn A', 'status' => 'Chờ xác nhận'],
            ['id' => '002', 'customer_name' => 'Trần Thị B', 'status' => 'Đang xử lý'],
        ];

        return view('orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công!');
    }
    public function show($id)
    {
        $orders = [
            '001' => [
                'id' => '001',
                'customer_name' => 'Nguyễn Văn A',
                'phone' => '0123456789',
                'address' => '123 Đường ABC, TP.HCM',
                'order_date' => '01/04/2024',
                'status' => 'Chờ xác nhận',
                'total' => 1000000,
                'payment_method' => 'COD',
                'note' => 'Giao hàng trong giờ hành chính',
                'products' => [
                    ['name' => 'Sản phẩm 1', 'quantity' => 2, 'price' => 500000],
                    ['name' => 'Sản phẩm 2', 'quantity' => 1, 'price' => 200000],
                ]
            ],
            '002' => [
                'id' => '002',
                'customer_name' => 'Trần Thị B',
                'phone' => '0987654321',
                'address' => '456 Đường XYZ, Hà Nội',
                'order_date' => '02/04/2024',
                'status' => 'Đang giao hàng',
                'total' => 800000,
                'payment_method' => 'Chuyển khoản',
                'note' => 'Giao sau 5h chiều',
                'products' => [
                    ['name' => 'Sản phẩm 3', 'quantity' => 1, 'price' => 300000],
                    ['name' => 'Sản phẩm 4', 'quantity' => 2, 'price' => 250000],
                ],
            ]
        ];

        $order = $orders[$id] ?? null;

        if (!$order) {
            abort(404);
        }

        return view('orders.show', compact('order'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SystemUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {
            // Lấy tất cả tài khoản (không lọc theo role_id)
            $users = SystemUser::all();

            // Truyền dữ liệu tới view
            return view('admin.index', compact('users'));
        } else {
            // chuyển hướng về trang đăng nhập hoặc báo lỗi
            return redirect()->route('admin.login')->withErrors(['auth' => 'Bạn cần đăng nhập trước.']);
        }
    }
    public function dashboard(Request $request)
    {
        // Lấy từ input 'search' nếu có
        $keyword = $request->input('search');

        if ($keyword) {
            // Tìm sản phẩm theo tên hoặc mã sản phẩm chứa keyword (LIKE %keyword%)
            $products = Product::where('product_name', 'like', '%' . $keyword . '%')
                ->orWhere('product_id', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            // Nếu không có tìm kiếm thì lấy tất cả
            $products = Product::all();
        }

        return view('admin.warehouse', compact('products', 'keyword'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::find($request->product_id);
        $product->stock_quantity += $request->quantity;
        $product->save();

        return redirect()->back()->with('success', 'Cập nhật tồn kho thành công.');
    }
    public function edit(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::find($request->product_id);
        $product->stock_quantity = $request->quantity;
        $product->save();

        return redirect()->back()->with('success', 'Cập nhật tồn kho thành công.');
    }
}

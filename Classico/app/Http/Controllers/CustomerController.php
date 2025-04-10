<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $customers = Customer::when($keyword, function ($query, $keyword) {
        return $query->where('name', 'like', "%$keyword%")
                     ->orWhere('email', 'like', "%$keyword%")
                     ->orWhere('phone', 'like', "%$keyword%");
    })->get();

    return view('customers.index', compact('customers', 'keyword'));
}


    // Hiển thị form thêm mới
    public function create()
    {
        return view('customers.create');
    }

    // Lưu khách hàng mới
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Thêm khách hàng thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email,' . $id . ',customer_id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Cập nhật thành công!');
    }

    // Xoá khách hàng
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Xóa khách hàng thành công!');
    }
}

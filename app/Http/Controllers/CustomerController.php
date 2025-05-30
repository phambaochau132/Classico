<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Customer;


class CustomerController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index(Request $request)
    {

        if (Auth::guard('web')->check()) {
            $keyword = $request->input('keyword');

            $customers = Customer::when($keyword, function ($query, $keyword) {
                return $query->where('name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%");
            })->paginate(5);
            return view('customers.index', compact('customers', 'keyword'));
        } else {
            // chuyển hướng về trang đăng nhập hoặc báo lỗi
            return redirect()->route('admin.login')->withErrors(['auth' => 'Bạn cần đăng nhập trước.']);
        }
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
            'name' => 'required|regex:/^(?!.*\s{2}).*$/',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|numeric|digits:10|unique:customers',
            'gender' => 'nullable|in:male,female',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => '/images/avatar/1.png',
            'gender' => $request->gender,
            'password' => Hash::make($request->password),

        ]);

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

        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Xóa khách hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xoá khách hàng  thất bại. Vui lòng thử lại.');
        }
    }


    public function showProfile()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Bạn cần đăng nhập');
        }

        return view('dasboard_customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        // Lấy customer đang đăng nhập
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->back()->withErrors(['msg' => 'Không tìm thấy người dùng.']);
        }

        $action = $request->input('action');

        if ($action === 'update_info') {

            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:customers,email,' . $customer->customer_id . ',customer_id',
                'phone' => 'required|numeric|digits:10|unique:customers',
                'address' => 'required|string',
                'gender' => 'required|in:male,female',
                'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/avatar'), $filename);
                    $customer->avatar = 'images/avatar/' . $filename;
                } else {
                    return back()->withErrors(['avatar' => 'Ảnh không hợp lệ!']);
                }
            }

            $customer->fill($request->only(['name', 'email', 'phone', 'address', 'gender']));
            $customer->save();

            return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật.');
        } elseif ($action === 'update_password') {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6',
            ]);
            if (!Hash::check($request->current_password, $customer->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Mật khẩu cũ không đúng.'])
                    ->withInput();
            }

            $customer->password = Hash::make($request->password);
            $customer->save();

            return redirect()->back()->with('success', 'Mật khẩu đã được đổi thành công.');
        }

        return redirect()->back()->withErrors(['msg' => 'Yêu cầu không hợp lệ.']);
    }
}

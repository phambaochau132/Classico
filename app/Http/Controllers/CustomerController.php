<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;


class CustomerController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index(Request $request)
{
 
    if (Auth::check()) {
        $keyword = $request->input('keyword');

        $customers = Customer::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%$keyword%")
                        ->orWhere('email', 'like', "%$keyword%")
                        ->orWhere('phone', 'like', "%$keyword%");
        })->get();
        return view('customers.index', compact('customers', 'keyword'));
    } else {
        // chuyển hướng về trang đăng nhập hoặc báo lỗi
        return redirect()->route('login')->withErrors(['auth' => 'Bạn cần đăng nhập trước.']);
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
=======
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'gender' => 'nullable|in:male,female',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => '1.png',
            'gender' => $request->gender,
            'password' => Hash::make($request->password),

        ]);

        Session::put('customer_id', $customer->customer_id);
        return redirect()->route('customer.login')->with('success', 'Đăng nhập thành công');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            Session::put('customer_id', $customer->customer_id);
            return redirect()->route('index')->with('success', 'Đăng nhập thành công');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
    }

    public function logout(Request $request)
    {
        Session::forget('customer_id');
        return redirect()->route('customer.login')->with('success', 'Đã đăng xuất');
    }
    public function showProfile()
    {
        $customer = Customer::find(session('customer_id'));
        return view('profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customerId = Session::get('customer_id');
        $customer = Customer::find($customerId);

        if (!$customer) {
            return redirect()->back()->withErrors(['msg' => 'Không tìm thấy người dùng.']);
        }

        $action = $request->input('action');

        if ($action === 'update_info') {

            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:customers,email,' . $customer->customer_id . ',customer_id',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'gender' => 'nullable|in:male,female',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                // Kiểm tra xem file có hợp lệ không
                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images'), $filename);
                    $customer->avatar = $filename;
                } else {
                    return back()->withErrors(['avatar' => 'Ảnh không hợp lệ!']);
                }
            }


            $customer->fill($request->only(['name', 'email', 'phone', 'address', 'gender']));
            $customer->save();

            return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật.');
        } elseif ($action === 'update_password') {

            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);

            $customer->password = Hash::make($request->password);
            $customer->save();

            return redirect()->back()->with('success', 'Mật khẩu đã được đổi thành công.');
        }

        return redirect()->back()->withErrors(['msg' => 'Yêu cầu không hợp lệ.']);
    }
}

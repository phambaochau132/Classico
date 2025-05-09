<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;


class CustomerController extends Controller
{
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

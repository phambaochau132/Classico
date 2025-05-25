<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->route('customers.index'); // hoặc bất kỳ route nào bạn muốn
        }

        // Đăng nhập thất bại
        return back()->withErrors(['message' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
    }

    public function logout(Request $request)
    {
        if (Auth::logout()) {
            return redirect()->route('login');
        }
        return back()->withErrors(['message' => 'Lỗi! Không thể đăng xuất']);
    }
}

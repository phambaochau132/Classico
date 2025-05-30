<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showLoginAdminForm()
    {
        return view('auth.login');
    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->route('customers.index'); // hoặc bất kỳ route nào bạn muốn
        }

        // Đăng nhập thất bại
        return back()->withErrors(['message' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
    }

    //dang xuat admin
    public function logoutAdmin(Request $request)
    {
        if (Auth::guard('web')->logout()) {
            return redirect()->route('admin.login');
        }
        return back()->withErrors(['message' => 'Lỗi! Không thể đăng xuất']);
    }
    public function showRegister()
    {
        return view('dasboard_customer.register');
    }

    public function register(Request $request)
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

        Session::put('customer_id', $customer->customer_id);
        return redirect()->route('customer.login')->with('success', 'Đăng nhập thành công');
    }

    public function showLogin()
    {
        return view('dasboard_customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.home')->with('success', 'Đăng nhập thành công');
        } else {

            return redirect()->back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $avatarUrl = $googleUser->getAvatar();

        // Tạo tên file ảnh dựa trên tên người dùng, chuyển thành slug, đuôi png
        $slugName = Str::slug($googleUser->getName());
        $avatarName = $slugName . '.png';

        $avatarPath = public_path('images/avatar/' . $avatarName);

        // Tải ảnh về local
        $imageContents = file_get_contents($avatarUrl);
        file_put_contents($avatarPath, $imageContents);

        $user = Customer::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'avatar' => $avatarName,
                'password' => bcrypt('123456'),
            ]
        );

        Auth::guard('customer')->login($user);
        return redirect()->route('customer.home')->with('success', 'Đăng nhập bằng Google thành công');
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $customer = Customer::firstOrCreate(
            ['email' => $facebookUser->getEmail()],
            [
                'name' => $facebookUser->getName(),
                'avatar' => $facebookUser->getAvatar(),
                'password' => bcrypt(uniqid()), // Mật khẩu ngẫu nhiên
            ]
        );

        Auth::guard('customer')->login($customer);
        return redirect()->route('customer.home')->with('success', 'Đăng nhập bằng facebook  thành công');
    }
    public function logout(Request $request)
    {
        try {
            Auth::guard('customer')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Nếu mọi thứ thành công, chuyển hướng đến trang đăng nhập với thông báo thành công
            return redirect()->route('customer.login.form')->with('success', 'Đã đăng xuất thành công!');
        } catch (Exception $e) {
            // Nếu có lỗi trong quá trình đăng xuất
            // Bạn có thể ghi lại lỗi ($e->getMessage()) để debug
            \Log::error('Lỗi đăng xuất: ' . $e->getMessage());

            // Chuyển hướng người dùng trở lại trang trước đó với thông báo lỗi
            return back()->withErrors(['message' => 'Đã có lỗi xảy ra khi đăng xuất. Vui lòng thử lại.']);
        }
    }
}

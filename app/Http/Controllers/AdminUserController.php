<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        if (Auth::guard('web')->check()) {
            // Lấy tất cả tài khoản (không lọc theo role_id)
            $users = SystemUser::paginate(10); // Mỗi trang 10 dòng
            // Truyền dữ liệu tới view
            return view('admin.index', compact('users'));
        } else {
            // chuyển hướng về trang đăng nhập hoặc báo lỗi
            return redirect()->route('admin.login')->withErrors(['auth' => 'Bạn cần đăng nhập trước.']);
        }
    }
    public function edit($id)
    {
        $admin = SystemUser::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
{
    if (auth()->user()->role_id != 1) {
        return redirect()->back()->with('error', 'Bạn không có quyền thực hiện thao tác này.');
    }

    $admin = SystemUser::findOrFail($id);

    $request->validate([
        'email' => 'required|email',
        'sodienthoai' => 'required'
    ]);
    $admin->email = $request->email;
    $admin->sodienthoai = $request->sodienthoai;  // Sửa chỗ này
    $admin->save();

    return redirect()->route('admin.index')->with('success', 'Cập nhật tài khoản thành công.');
}



    public function destroy($id)
{
    if (auth()->user()->role_id != 1) {
        return redirect()->back()->with('error', 'Bạn không có quyền thực hiện thao tác này.');
    }

    try {
        $admin = SystemUser::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Xoá tài khoản thành công.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Xoá tài khoản thất bại. Vui lòng thử lại.');
    }
}

// Phương thức hiển thị form tạo mới admin
    public function create()
    {
        return view('admin.create');
    }
public function store(Request $request)
{
    if (auth()->user()->role_id != 1) {
        return redirect()->back()->with('error', 'Bạn không có quyền thực hiện thao tác này.');
    }
    $request->validate([
        'username' => 'required|unique:system_users',
        'email' => 'required|email|unique:system_users',
        'sodienthoai' => 'required|numeric|digits:10',
    ]);
    
    \Log::info('Creating user with sodienthoai:', ['sodienthoai' => $request->sodienthoai]);

    try {
        $user = SystemUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'sodienthoai' => $request->sodienthoai,
            'password' => bcrypt('123456'),
            'role_id' => 2
        ]);
        return redirect()->route('admin.index');

    } catch (\Exception $e) {
        \Log::error('Error tạo user:', ['message' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Tạo tài khoản thất bại!');
    }
}
public function showResetForm()
{
    return view('admin.reset_password');
}

public function handleReset(Request $request)
{
    $request->validate([
        'username' => 'required',
        'sodienthoai' => 'required',
        //'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Tìm user dựa trên username, số điện thoại và email
    $user = SystemUser::where('username', $request->username)
        ->where('sodienthoai', $request->sodienthoai)
        //->where('email', $request->email)
        ->first();

    if (!$user) {
        return back()->with('error', 'Tên đăng nhập hoặc số điện thoại không chính xác!');

    }

    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('success', 'Mật khẩu đã được cập nhật thành công!');

}




}


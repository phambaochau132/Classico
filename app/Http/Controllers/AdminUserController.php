<?php
namespace App\Http\Controllers;
use App\Models\SystemUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;


class AdminUserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Lấy tất cả tài khoản (không lọc theo role_id)
            $users = SystemUser::all();

            // Truyền dữ liệu tới view
            return view('admin.index', compact('users'));
        } else {
            // chuyển hướng về trang đăng nhập hoặc báo lỗi
            return redirect()->route('login')->withErrors(['auth' => 'Bạn cần đăng nhập trước.']);
        }
        
    }
    public function edit($id)
    {
        $admin = SystemUser::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
{
    // Kiểm tra nếu người dùng hiện tại không phải admin
    if (auth()->user()->role_id != 1) {
        return redirect()->back()->with('error', 'Bạn không có quyền thực hiện thao tác này.');
    }

    $admin = SystemUser::findOrFail($id);

    $request->validate([
        'username' => 'required',
        'email' => 'required|email'
    ]);

    $admin->username = $request->username;
    $admin->email = $request->email;
    $admin->save();

    return redirect()->route('admin.index')->with('success', 'Cập nhật tài khoản thành công.');
}


    public function destroy($id)
    {
        if (auth()->user()->role_id != 1) {
            
        return redirect()->back()->with('error', 'Bạn không có quyền thực hiện thao tác này.');
        }
        $admin = SystemUser::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Xoá tài khoản thành công.');
    }

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
        'username' => 'required',
        'email' => 'required|email'
    ]);
    
    try {
        $user = SystemUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt('123456'),
            'role_id' => 2
        ]);
        return redirect()->route('admin.index')->with('success', 'Tạo tài khoản thành công.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Tạo tài khoản thất bại!');
    }
}

}


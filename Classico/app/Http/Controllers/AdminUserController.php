<?php
namespace App\Http\Controllers;
use App\Models\SystemUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 


class AdminUserController extends Controller
{
    public function index()
    {
        // Lấy tất cả tài khoản (không lọc theo role_id)
        $users = SystemUser::all();

        // Truyền dữ liệu tới view
        return view('admin.index', compact('users'));
    }
    public function edit($id)
    {
        $admin = SystemUser::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
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
    $request->validate([
        'username' => 'required',
        'email' => 'required|email'
    ]);

    SystemUser::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt('123456'), // mặc định hoặc cho chọn
    ]);

    return redirect()->route('admin.index')->with('success', 'Tạo tài khoản thành công.');
}

}


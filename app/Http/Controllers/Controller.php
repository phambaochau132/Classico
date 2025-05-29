<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function __construct()
    {
        $currentUrl = Request::path(); // Lấy đường dẫn hiện tại (không bao gồm domain)

        if (str_starts_with($currentUrl, 'admin')) {
            // Nếu chưa đăng nhập guard admin thì redirect login admin
            if (!Auth::guard('web')->check()) {

               return redirect()->route('admin.login');
            }

        } else {
            // Nếu chưa đăng nhập guard web thì redirect login web
            if (!Auth::guard('customer')->check()) {
                return redirect()->route('customer.login');
            }
        }
    }
}

<?php

namespace App\Http\Controllers; // Namespace không có "Auth"

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Chuyển hướng về /login sau khi đăng xuất
    }
}
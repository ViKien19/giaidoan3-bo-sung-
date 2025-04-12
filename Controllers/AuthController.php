<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Kiểm tra thông tin đăng nhập với mật khẩu đã mã hóa
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) { // Dùng Hash::check để kiểm tra mật khẩu
            Auth::login($user); // Đăng nhập người dùng

            // Debug kiểm tra role (chỉ dùng để kiểm tra, sau đó xóa đi)
            // dd($user->role);

            // Chuyển hướng theo quyền hạn
            if ($user->role_id === 1) { // Kiểm tra role_id thay vì role
                return redirect('/admin/dashboard'); // Admin vào dashboard
            } else {
                return redirect('/chatbot'); // User vào chatbot
            }
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
    }

    // Hiển thị trang đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'fullname' => 'required'
        ]);

        // Tạo mới tài khoản người dùng với mật khẩu đã mã hóa
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'role_id' => 2, // User thường có role_id = 2
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập');
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

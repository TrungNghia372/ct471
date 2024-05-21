<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function __construct() {

    }

    public function login() {

        if (Auth::id() > 0) {
            return redirect()->route('dashboard.index');
        }
        return view('backend.auth.login');
    }

    public function doLogin(AuthRequest $request) {
        $credentials = [
            'email' => $request->input('emailLogin'),
            'password' => $request->input('passwordLogin'),
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->route('auth.login')->with('error', 'Email hoặc mật khẩu không chính xác');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    public function register() {
        return view('backend.auth.register');
    }

    public function doRegister(AuthRequest $request) {
        echo 1; die();
    }
}
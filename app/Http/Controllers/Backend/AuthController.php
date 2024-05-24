<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function __construct() {

    }

    //Đăng nhập
    public function login() {
        // if (Auth::id() > 0) {
        //     return redirect()->route('dashboard.index');
        // }
        return view('backend.auth.login');
    }

    public function doLogin(AuthRequest $request) {
        $credentials = [
            'email' => $request->input('emailLogin'),
            'password' => $request->input('passwordLogin'),
        ];

        if (Auth::attempt($credentials)) {
            session(['admin' => Auth::user()]);
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');
        } else if (Auth::guard('customer')->attempt($credentials)) {
            session(['customer' => Auth::guard('customer')->user()]);
            return redirect()->route('welcome')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->route('auth.login')->with('error', 'Email hoặc mật khẩu không chính xác');
    }

    //Đăng xuất
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->forget('admin');
        // $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    public function logoutCustomer(Request $request) {
        Auth::guard('customer')->logout(); 
        $request->session()->forget('customer');
        // $request->session('customer')->invalidate();
        $request->session('customer')->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Đăng xuất thành công');
    }

    //Đăng ký
    public function register() {
        return view('backend.auth.register');
    }

    public function doRegister(AuthRequest $request) {
        if ($request->input('passwordRegister1') !== $request->input('passwordRegister2')) {
            return redirect()->back()->withInput()->with('error', 'Mật khẩu nhập lại không khớp');
        }

        $userData = [
            'fullname' => $request->input('fullName'),
            'date_of_birth' => $request->input('date'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'national_id' => $request->input('nationalId'),
            'email' => $request->input('email'),
            'address' => $request->input('ward') . ' - ' . $request->input('district') . ' - ' . $request->input('province'),
            'password' => Hash::make($request->input('passwordRegister1')), // Băm mật khẩu trước khi lưu
            
        ];

        $user = Customer::create($userData);

        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công');
    }
}
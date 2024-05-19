<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller {
    public function __construct() {

    }

    public function login() {
        return view('backend.auth.login');
    }
    
    public function doLogin(AuthRequest $request) {
        
    }

    public function register() {
        return view('backend.auth.register');
    }
}
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;


Route::get('/', function () {
    return view('index');
});

Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('doLogin', [AuthController::class, 'doLogin'])->name('auth.doLogin');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');

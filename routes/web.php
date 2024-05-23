<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CustMgmtController;
use App\Http\Middleware\AuthenticateMiddleware;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);

Route::get('management/customer', [CustMgmtController::class, 'index'])->name('management.customer')->middleware(AuthenticateMiddleware::class);
Route::get('management/goEdit/{customer_id}', [CustMgmtController::class, 'goEdit'])->name('management.goEdit')->middleware(AuthenticateMiddleware::class);
Route::post('management/customer/edit/{customer_id}', [CustMgmtController::class, 'edit'])->name('management.editCustomer')->middleware(AuthenticateMiddleware::class);



//Login
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('doLogin', [AuthController::class, 'doLogin'])->name('auth.doLogin');
//Logout
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('logoutCustomer', [AuthController::class, 'logoutCustomer'])->name('auth.logoutCustomer');
//Register
Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('doRegister', [AuthController::class, 'doRegister'])->name('auth.doRegister');

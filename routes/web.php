<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CustMgmtController;
use App\Http\Middleware\AuthenticateMiddleware;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**Admin */
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);
 
/**Go to customer management page */
Route::get('management/customer', [CustMgmtController::class, 'index'])->name('management.customer')->middleware(AuthenticateMiddleware::class);

/**Edit Customer Information */
Route::get('management/goEdit/{customer_id}', [CustMgmtController::class, 'goEdit'])->name('management.goEdit')->middleware(AuthenticateMiddleware::class);
Route::post('management/customer/edit/{customer_id}', [CustMgmtController::class, 'edit'])->name('management.editCustomer')->middleware(AuthenticateMiddleware::class);

/**Delete Customer */
Route::get('management/goDelete/{customer_id}', [CustMgmtController::class, 'goDelete'])->name('management.goDelete')->middleware(AuthenticateMiddleware::class);
Route::delete('management/customer/delete/{customer_id}', [CustMgmtController::class, 'delete'])->name('management.deleteCustomer')->middleware(AuthenticateMiddleware::class);


//Login
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('doLogin', [AuthController::class, 'doLogin'])->name('auth.doLogin');
//Logout
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('logoutCustomer', [AuthController::class, 'logoutCustomer'])->name('auth.logoutCustomer');
//Register
Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('doRegister', [AuthController::class, 'doRegister'])->name('auth.doRegister');

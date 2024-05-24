<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CustMgmtController;
use App\Http\Controllers\Backend\EmpMgmtController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');


//Login
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('doLogin', [AuthController::class, 'doLogin'])->name('auth.doLogin');
//Logout
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('logoutCustomer', [AuthController::class, 'logoutCustomer'])->name('auth.logoutCustomer');
//Register
Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('doRegister', [AuthController::class, 'doRegister'])->name('auth.doRegister');


/**Admin */
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);

/**Customer */
    /**Go to customer management page */
    Route::get('management/customer', [CustMgmtController::class, 'index'])->name('management.customer')->middleware(AuthenticateMiddleware::class);
    /**Insert  Customer */
    Route::get('management/insertCust', [CustMgmtController::class, 'goInsert'])->name('goInsertCustomer')->middleware(AuthenticateMiddleware::class);
    Route::post('management/insertCust', [CustMgmtController::class, 'insert'])->name('management.insertCustomer')->middleware(AuthenticateMiddleware::class);
    /**Edit Customer Information */
    Route::get('management/editCust/{customer_id}', [CustMgmtController::class, 'goEdit'])->name('goEditCustomer')->middleware(AuthenticateMiddleware::class);
    Route::post('management/editCust/{customer_id}', [CustMgmtController::class, 'edit'])->name('management.editCustomer')->middleware(AuthenticateMiddleware::class);
    /**Delete Customer */
    Route::get('management/deleteCust/{customer_id}', [CustMgmtController::class, 'goDelete'])->name('goDeleteCustomer')->middleware(AuthenticateMiddleware::class);
    Route::delete('management/deleteCust/{customer_id}', [CustMgmtController::class, 'delete'])->name('management.deleteCustomer')->middleware(AuthenticateMiddleware::class);

/**Employee */
    /**Go to employee management page */
    Route::get('management/employee', [EmpMgmtController::class, 'index'])->name('management.employee')->middleware(AuthenticateMiddleware::class);
    /**Insert Employee */
    Route::get('management/insertEmp', [EmpMgmtController::class, 'goInsert'])->name('goInsertEmployee')->middleware(AuthenticateMiddleware::class);
    Route::post('management/insertEmp', [EmpMgmtController::class, 'insert'])->name('management.insertEmployee')->middleware(AuthenticateMiddleware::class);
    /**Edit Employee Information */
    Route::get('management/editEmp/{employee_id}', [EmpMgmtController::class, 'goEdit'])->name('goEditEmployee')->middleware(AuthenticateMiddleware::class);
    Route::post('management/editEmp/{employee_id}', [EmpMgmtController::class, 'edit'])->name('management.editEmployee')->middleware(AuthenticateMiddleware::class);
    /**Delete Employee */
    Route::get('management/deleteEmp/{employee_id}', [EmpMgmtController::class, 'goDelete'])->name('goDeleteEmployee')->middleware(AuthenticateMiddleware::class);
    Route::delete('management/deleteEmp/{employee_id}', [EmpMgmtController::class, 'delete'])->name('management.deleteEmployee')->middleware(AuthenticateMiddleware::class);


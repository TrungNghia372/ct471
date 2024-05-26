<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CustMgmtController;
use App\Http\Controllers\Backend\EmpMgmtController;
use App\Http\Controllers\Backend\RoomMgmtController;



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
    Route::get('management/customer', [CustMgmtController::class, 'index'])->name('management.customer');
    /**Insert  Customer */
    Route::get('management/insertCust', [CustMgmtController::class, 'goInsert'])->name('goInsertCustomer');
    Route::post('management/insertCust', [CustMgmtController::class, 'insert'])->name('management.insertCustomer');
    /**Edit Customer Information */
    Route::get('management/editCust/{customer_id}', [CustMgmtController::class, 'goEdit'])->name('goEditCustomer');
    Route::post('management/editCust/{customer_id}', [CustMgmtController::class, 'edit'])->name('management.editCustomer');
    /**Delete Customer */
    Route::get('management/deleteCust/{customer_id}', [CustMgmtController::class, 'goDelete'])->name('goDeleteCustomer');
    Route::delete('management/deleteCust/{customer_id}', [CustMgmtController::class, 'delete'])->name('management.deleteCustomer');

/**Employee */
    /**Go to employee management page */
    Route::get('management/employee', [EmpMgmtController::class, 'index'])->name('management.employee');
    /**Insert Employee */
    Route::get('management/insertEmp', [EmpMgmtController::class, 'goInsert'])->name('goInsertEmployee');
    Route::post('management/insertEmp', [EmpMgmtController::class, 'insert'])->name('management.insertEmployee');
    /**Edit Employee Information */
    Route::get('management/editEmp/{employee_id}', [EmpMgmtController::class, 'goEdit'])->name('goEditEmployee');
    Route::post('management/editEmp/{employee_id}', [EmpMgmtController::class, 'edit'])->name('management.editEmployee');
    /**Delete Employee */
    Route::get('management/deleteEmp/{employee_id}', [EmpMgmtController::class, 'goDelete'])->name('goDeleteEmployee');
    Route::delete('management/deleteEmp/{employee_id}', [EmpMgmtController::class, 'delete'])->name('management.deleteEmployee');

/**Room */
    /**Go to room/room type management page */
    Route::get('management/room', [RoomMgmtController::class, 'room'])->name('management.room');
    Route::get('management/roomType', [RoomMgmtController::class, 'roomType'])->name('management.roomType');
    /**Insert */
        // Room Type
        Route::get('management/insertRoomType', [RoomMgmtController::class, 'goInsertRoomType'])->name('goInsertRoomType');
        Route::post('management/insertRoomType', [RoomMgmtController::class, 'insertRoomType'])->name('management.insertRoomType');
        // Room
        Route::get('management/insertRoom', [RoomMgmtController::class, 'goInsertRoom'])->name('goInsertRoom');
        Route::post('management/insertRoom', [RoomMgmtController::class, 'insertRoom'])->name('management.insertRoom');
    /**Edit Room */
        //RoomType
        Route::get('management/editRoomType/{room_type_id}', [RoomMgmtController::class, 'goEditRoomType'])->name('goEditRoomType');
        Route::post('management/editRoomType/{room_type_id}', [RoomMgmtController::class, 'editRoomType'])->name('management.editRoomType');
        // Room
        Route::get('management/editRoom/{room_id}', [RoomMgmtController::class, 'goEditRoom'])->name('goEditRoom');
        Route::post('management/editRoom/{room_id}', [RoomMgmtController::class, 'editRoom'])->name('management.editRoom');
    /**Delete Room */
        /**RoomType */
        Route::get('management/deleteRoomType/{room_type_id}', [RoomMgmtController::class, 'goDeleteRoomType'])->name('goDeleteRoomType');
        Route::delete('management/deleteRoomType/{room_type_id}', [RoomMgmtController::class, 'deleteRoomType'])->name('management.deleteRoomType');
        // Room
        Route::get('management/deleteRoom/{room_id}', [RoomMgmtController::class, 'goDeleteRoom'])->name('goDeleteRoom');
        Route::delete('management/deleteRoom/{room_id}', [RoomMgmtController::class, 'deleteRoom'])->name('management.deleteRoom');


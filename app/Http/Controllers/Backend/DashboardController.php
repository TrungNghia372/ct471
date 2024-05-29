<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Room;

class DashboardController extends Controller {
    public function __construct() {

    }

    public function index() {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $template = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }
}

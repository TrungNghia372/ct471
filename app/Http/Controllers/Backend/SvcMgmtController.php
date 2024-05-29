<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Room;
use Carbon\Carbon;

class SvcMgmtController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $services = Service::paginate(10);
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $template = 'backend.management.service.service';
        return view('backend.dashboard.layout', compact(
            'template',
            'services',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function goInsertService() {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();
        
        $template = 'backend.management.service.insertService';
        return view('backend.dashboard.layout', compact(
            'template',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function insertService(Request $request) {
        $serviceData = [
            'service_name' => $request->input('service_name'),
            'description' => $request->input('description'),
            'service_price' => $request->input('service_price'),
        ];

        $service = Service::create($serviceData);
        return redirect()->route('management.service')->with('success', 'Thêm dịch vụ thành công');
    }

    public function goEditService($id) {
        $services = Service::findOrFail($id);
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();
        
        $template = 'backend.management.service.editService';
        return view('backend.dashboard.layout', compact(
            'template',
            'services',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function editService(Request $request, $id) {
        $services = Service::findOrFail($id);

        $fields = ['service_name', 'description', 'service_price'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $services->{$field} = $request->input($field);
            }
        }

        $services->save();

        return redirect()->route('management.service')->with('success', 'Cập nhật thông tin thành công');

        $template = 'backend.management.service.editService';
        return view('backend.dashboard.layout', compact(
            'template',
            'services'
        ));
    }

    public function goDeleteService($id) {
        $services = Service::findOrFail($id);
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();
        
        $template = 'backend.management.service.deleteService';
        return view('backend.dashboard.layout',compact(
            'template',
            'services',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function deleteService(Request $request, $id) {
        $services = Service::findOrFail($id);

        $services -> delete();

        return redirect()->route('management.service')->with('success', 'Xóa dịch vụ thành công');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\EmployeeInterfaceRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CustMgmtController extends Controller {
    public function __construct() {

    }

    public function index() {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $customers = Customer::paginate(10);

        if ($customers) {
            foreach ($customers as $customer) {
                $customer->date_of_birth = $this->formatDate($customer->date_of_birth);
            }
        } else {
            $customers = collect();
        }

        $template = 'backend.management.customer.customer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function goInsert() {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $template = 'backend.management.customer.insertCustomer';
        return view('backend.dashboard.layout', compact(
            'template',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function insert(EmployeeInterfaceRequest $request) {
        if ($request->input('password1') !== $request->input('password2')) {
            return redirect()->back()->withInput()->with('error', 'Mật khẩu nhập lại không khớp');
        }

        $customerData = [
            'fullname' => $request->input('fullName'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date'),
            'phone' => $request->input('phone'),
            'national_id' => $request->input('national_id'),
            'email' => $request->input('email'),
            'address' => $request->input('ward') . ' - ' . $request->input('district') . ' - ' . $request->input('province'),
            'password' => Hash::make($request->input('password1')), // Băm mật khẩu trước khi lưu
            
        ];

        $customer = Customer::create($customerData);

        return redirect()->route('management.customer')->with('success', 'Thêm khách hàng thành công');
    }

    public function goEdit($id) {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $customers = Customer::findOrFail($id); /**Tìm khách hàng theo id */
        $address = $customers->address;
        $separator = " - ";
        $addressParts = explode($separator, $address);
        list($ward, $district, $province) = $addressParts;

        $template = 'backend.management.customer.editCustomer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
            'province',
            'district',
            'ward',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function edit(Request $request, $id) {
        $customers = Customer::findOrFail($id); /**Tìm khách hàng theo id */
        $address = $customers->address;
        $separator = " - ";
        $addressParts = explode($separator, $address);
        list($ward, $district, $province) = $addressParts;

        $fields = ['fullName', 'email', 'gender', 'phone', 'national_id'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $customers->{$field} = $request->input($field);
            }
        }

        if ($request->has('date')) {
            $customers->date_of_birth = $request->input('date');
        }

        if ($request->has('ward') && $request->has('district') && $request->has('province')) {
            $customers->address = $request->input('ward') . ' - ' . $request->input('district') . ' - ' . $request->input('province');
        }
        
        $customers->save();

        return redirect()->route('management.customer')->with('success', 'Cập nhật thông tin thành công');

        $template = 'backend.management.customer.editCustomer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
            'province',
            'district',
            'ward',
        ));
    }

    public function goDelete($id) {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $customers = Customer::findOrFail($id);

        $template = 'backend.management.customer.deleteCustomer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
            'countCust',
            'countEmp',
            'countRoom',
        ));
    }

    public function delete(Request $request, $id) {
        $customers = Customer::findOrFail($id);

        $deleted = $customers->delete();

        return redirect()->route('management.customer')->with('success', 'Xoá tài khoản khách hàng thành công');

    }

    private function formatDate($date) {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

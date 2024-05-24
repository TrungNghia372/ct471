<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EmpMgmtController extends Controller {
    public function __construct() {

    }

    public function index() {
        $employees = Employee::paginate(10);

        if($employees) {
            foreach($employees as $employee) {
                $employee->hire_date = $this->formatDate($employee->hire_date);
                $employee->date_of_birth = $this->formatDate($employee->date_of_birth);
            }
        } else {
            $employees = collect();
        }

        $template = 'backend.management.employee.employee';
        return view('backend.dashboard.layout', compact(
            'template',
            'employees',
        ));
    }

    public function goInsert() {
        $template = 'backend.management.employee.insertEmployee';
        return view('backend.dashboard.layout', compact(
            'template',
        ));
    }

    public function insert(Request $request) {
        if ($request->input('password1') !== $request->input('password2')) {
            return redirect()->back()->withInput()->with('error', 'Mật khẩu nhập lại không khớp');
        }

        $employeeData = [
            'fullname' => $request->input('fullName'),
            'gender' => $request->input('gender'),
            'hire_date' => $request->input('hire_date'),
            'date_of_birth' => $request->input('date'),
            'salary' => $request->input('salary'),
            'phone' => $request->input('phone'),
            'national_id' => $request->input('national_id'),
            'email' => $request->input('email'),
            'address' => $request->input('ward') . ' - ' . $request->input('district') . ' - ' . $request->input('province'),
            'password' => Hash::make($request->input('password1')), // Băm mật khẩu trước khi lưu
            
        ];

        $employee = Employee::create($employeeData);

        return redirect()->route('management.employee')->with('success', 'Thêm nhân viên thành công');
    }

    public function goEdit($id) {
        $employees = Employee::findOrFail($id);
        $employees = Employee::findOrFail($id); /**Tìm khách hàng theo id */
        $address = $employees->address;
        $separator = " - ";
        $addressParts = explode($separator, $address);
        list($ward, $district, $province) = $addressParts;

        $template = 'backend.management.employee.editEmployee';
        return view('backend.dashboard.layout', compact(
            'template',
            'employees',
            'province',
            'district',
            'ward',
        ));
    }

    public function edit(Request $request, $id) {
        $employees = Employee::findOrFail($id);
        $address = $employees->address;
        $separator = " - ";
        $addressParts = explode($separator, $address);
        list($ward, $district, $province) = $addressParts;

        $fields = ['fullName', 'email', 'hire_date', 'gender', 'phone', 'national_id'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $employees->{$field} = $request->input($field);
            }
        }

        if ($request->has('date')) {
            $employees->date_of_birth = $request->input('date');
        }
        if ($request->has('password1')) {
            $employees->password = $request->input('password1');
        }
        if ($request->has('salary')) {
            $employees->salary = $request->input('salary');
        }

        if ($request->has('ward') && $request->has('district') && $request->has('province')) {
            $employees->address = $request->input('ward') . ' - ' . $request->input('district') . ' - ' . $request->input('province');
        }
        
        $employees->save();

        return redirect()->route('management.employee')->with('success', 'Cập nhật thông tin thành công');

        $template = 'backend.management.employee.editEmployee';
        return view('backend.dashboard.layout', compact(
            'template',
            'employees',
            'province',
            'district',
            'ward',
        ));
    }

    public function goDelete($id) {
        $employees = Employee::findOrFail($id);

        $template = 'backend.management.employee.deleteEmployee';
        return view('backend.dashboard.layout', compact(
            'template',
            'employees',
        ));
    }

    public function delete(Request $request, $id) {
        $employees = Employee::findOrFail($id);

        $employees->delete();

        return redirect()->route('management.employee')->with('success','Xóa tài khoản nhân viên thành công');
    }

    private function formatDate($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

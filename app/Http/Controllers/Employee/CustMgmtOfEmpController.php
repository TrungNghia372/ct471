<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeInterfaceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Customer;

class CustMgmtOfEmpController extends Controller
{
    public function __construct() {

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
            'national_id' => $request->input('nationalId'),
            'email' => $request->input('email'),
            'address' => $request->input('ward') . ' - ' . $request->input('district') . ' - ' . $request->input('province'),
            'password' => Hash::make($request->input('password1')), // Băm mật khẩu trước khi lưu
            
        ];

        $customer = Customer::create($customerData);

        return redirect()->route('goCustomerList')->with('success', 'Thêm khách hàng thành công');
    }

    public function edit(EmployeeInterfaceRequest $request, $id) {
        $customers = Customer::findOrFail($id);
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

        return redirect()->route('goCustomerList')->with('success', 'Cập nhật thông tin thành công');
    }

    public function delete($id) {
        $customers = Customer::findOrFail($id);

        $deleted = $customers->delete();

        return redirect()->route('goCustomerList')->with('success', 'Xoá tài khoản khách hàng thành công');

    }
}
<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Carbon\Carbon;

class CustMgmtController extends Controller {
    public function __construct() {

    }

    public function index() {
        
        $customers =Customer::paginate(10);

        if ($customers) {
            foreach ($customers as $customer) {
                $customer->date_of_birth = $this->formatDate($customer->date_of_birth);
            }
        } else {
            $customers = collect();
        }

        $template = 'backend.management.customer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
        ));
    }

    public function goEdit($id) {
        $customers = Customer::findOrFail($id); /**Tìm khách hàng theo id */
        $address = $customers->address;
        $separator = " - ";
        $addressParts = explode($separator, $address);
        list($ward, $district, $province) = $addressParts;

        $template = 'backend.management.editCustomer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
            'province',
            'district',
            'ward',
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

        $template = 'backend.management.editCustomer';
        return view('backend.dashboard.layout', compact(
            'template',
            'customers',
            'province',
            'district',
            'ward',
        ));
    }

    private function formatDate($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}

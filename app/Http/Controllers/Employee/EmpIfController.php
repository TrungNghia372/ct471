<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingDetail;

class EmpIfController extends Controller
{
    public function __construct() {

    }

    public function goRoomDiagram() {
        $rooms = Room::all();

        $employeeIf = 'employee.page.roomDiagram';
        return view('employee.indexEmp', compact(
            'employeeIf',
            'rooms',
        ));
    }

    public function goBooking() {
        $unConfirmed = Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage',
        )->whereNull('employee_id')->paginate(10);

        $confirmed= Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage',
        )->whereNotNull('employee_id')->paginate(10);
        
        foreach ($unConfirmed as $booking) {
            $booking->formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');
        }
        foreach ($confirmed as $booking) {
            $booking->formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');
        }
        
        $employeeIf = 'employee.page.booking';
        return view('employee.indexEmp', compact(
            'employeeIf',
            'confirmed',
            'unConfirmed',
        ));
    }

    public function goCustomerList() {
        $customers = Customer::paginate(10);
        foreach ($customers as $customer) {
            $customer->formatted_date_of_birth = Carbon::parse($customer->date_of_birth)->format('d/m/Y');

            $address = $customer->address;
            $separator = " - ";
            $addressParts = explode($separator, $address);
            list($ward, $district, $province) = $addressParts;

            $customer->ward = $ward;
            $customer->district = $district;
            $customer->province = $province;
        }

        $employeeIf = 'employee.page.customerMgmt';
        return view('employee.indexEmp', compact(
            'employeeIf',
            'customers',
        ));
    }
}

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
        $rooms = Room::with([
            'roomType',
            'bookingDetail.booking.customer',
        ])->get();
        $customers = Customer::all();

        $roomsInUseOrReserved = $rooms->filter(function($room) {
            return $room->status === 'Đang sử dụng' || $room->status === 'Đã đặt trước';
        });

        foreach ($roomsInUseOrReserved as $room) {
            foreach ($room->bookingDetail as $bookingDetail) {
                $booking = $bookingDetail->booking;
                $customer = $booking->customer;

                $booking->formatted_date_from = Carbon::parse($bookingDetail->date_from)->format('d/m/Y H:i');
                $booking->formatted_date_to = Carbon::parse($bookingDetail->date_to)->format('d/m/Y H:i');
            }
        }

        $employeeIf = 'employee.page.roomDiagram';
        return view('employee.indexEmp', compact(
            'employeeIf',
            'rooms',
            'customers',
        ));
    }

    public function goBooking() {
        $unConfirmed = Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage',
        )->whereNull('employee_id')->paginate(10);        

        foreach ($unConfirmed as $booking) {
            $booking->formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');
            $booking->formatted_date_of_birth = Carbon::parse($booking->customer->date_of_birth)->format('d/m/Y');

            foreach ($booking->bookingDetail as $bookingDetail) {
                $booking->formatted_date_from = Carbon::parse($bookingDetail->date_from)->format('d/m/Y');
                $booking->formatted_date_to = Carbon::parse($bookingDetail->date_to)->format('d/m/Y');
            }
            
        }

        $confirmed= Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage',
        )->where('status', 'Đã xác nhận')->paginate(10);
        
        foreach ($confirmed as $booking) {
            $booking->formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');
            $booking->formatted_date_of_birth = Carbon::parse($booking->customer->date_of_birth)->format('d/m/Y');

            foreach ($booking->bookingDetail as $bookingDetail) {
                $booking->formatted_date_from = Carbon::parse($bookingDetail->date_from)->format('d/m/Y');
                $booking->formatted_date_to = Carbon::parse($bookingDetail->date_to)->format('d/m/Y');
            }
            
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

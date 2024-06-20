<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomImage;
use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingDetail;


class ConfirmController extends Controller
{
    public function __construct() {

    }

    public function goUnconfimred () {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $bookings = Booking::with(
            'customer',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage'
        )->paginate(10);

        $template = 'backend.management.confirm.unconfimred';
        return view('backend.dashboard.layout', compact(
            'template',
            'countCust',
            'countEmp',
            'countRoom',
            'bookings',
        ));
    }

    public function goConfimred () {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $bookings = Booking::with(
            'customer',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage'
        )->paginate(10);

        $template = 'backend.management.confirm.confimred';
        return view('backend.dashboard.layout', compact(
            'template',
            'countCust',
            'countEmp',
            'countRoom',
            'bookings',
        ));
    }

    public function goDetail($id) {
        $countCust = Customer::count();
        $countEmp = Employee::count();
        $countRoom = Room::count();

        $booking = Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage'
        )->find($id);

        $customer = $booking->customer;
        $employee = $booking->employee;
        $bookingDetails = $booking->bookingDetail;

        foreach ($bookingDetails as $bookingDetail) {
            $bookingDetail->formatted_date_from = Carbon::parse($bookingDetail->date_from)->format('d/m/Y');
            $bookingDetail->formatted_date_to = Carbon::parse($bookingDetail->date_to)->format('d/m/Y');
        }

        $formatted_date_of_birth = Carbon::parse($customer->date_of_birth)->format('d/m/Y');
        $formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');

        $template = 'backend.management.confirm.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'countCust',
            'countEmp',
            'countRoom',
            'booking',
            'bookingDetails',
            'formatted_date_of_birth',
            'formatted_booking_date',
        ));
    }

    public function confirm($id) {
        $employee = Auth::guard('employee')->user();

        $booking = Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage',
        )->find($id);

        if($booking) {
            $booking->employee_id = $employee->employee_id;
            $booking->save();

            foreach ($booking->bookingDetail as $bookingDetail) {
                $room = $bookingDetail->room;
                if ($room) {
                    $room->status = 'Đã đặt trước';
                    $room->save();
                }
            }

            return redirect()->route('goConfimred')->with('success', 'Xác nhận thành công');
        } else {
            return redirect()->back()->with('error', 'Xác nhận thất bại');
        }
    }
}

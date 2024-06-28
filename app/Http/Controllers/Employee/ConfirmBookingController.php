<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomImage;
use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingDetail;
use Carbon\Carbon;

class ConfirmBookingController extends Controller
{
    public function __construct() {

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
            $booking->status = 'Đã xác nhận';
            $booking->save();

            foreach ($booking->bookingDetail as $bookingDetail) {
                $room = $bookingDetail->room;
                if ($room) {
                    $room->status = 'Đã đặt trước';
                    $room->save();
                }
            }

            return redirect()->route('goBookingEmp')->with('success', 'Xác nhận thành công');
        } else {
            return redirect()->route('goBookingEmp')->with('error', 'Xác nhận thất bại');
        }
    }

    public function delete($id) {

        BookingDetail::where('booking_id', $id)->delete();
        Booking::findOrFail($id)->delete();

        return redirect()->route('goBookingEmp')->with('success', 'Xóa đơn thành công');
    }

    public function checkIn($id) {
        $employee = Auth::guard('employee')->user();

        $booking = Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage',
        )->find($id);

        if($booking) {
            $booking->employee_id = $employee->employee_id;
            $booking->status = 'Đã nhận phòng';
            $booking->save();

            foreach ($booking->bookingDetail as $bookingDetail) {
                $room = $bookingDetail->room;
                if ($room) {
                    $room->status = 'Đang sử dụng';
                    $room->save();
                }
            }

            return redirect()->route('goBookingEmp')->with('success', 'Xác nhận nhận phòng thành công');
        } else {
            return redirect()->route('goBookingEmp')->with('error', 'Xác nhận nhận phòng thất bại');
        }
    }
}

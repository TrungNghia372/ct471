<?php

namespace App\Http\Controllers\Customer;

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

class BookingController extends Controller
{
    public function __construct() {

    }

    public function booking(Request $request, $id) {
        $room = Room::with(['roomType', 'roomImage'])->findOrFail($id);
        $room_id = $room->room_id;

        $date_from = $request->input('date_from');
        $time_from = $request->input('time_from');

        $date_to = $request->input('date_to');
        $time_to = $request->input('time_to');

         // Kết hợp ngày và giờ thành đối tượng Carbon lưu vào CSDL
        $dateTimeFrom = Carbon::parse("$date_from $time_from");
        $dateTimeTo = Carbon::parse("$date_to $time_to");

        // Tính số ngày thuê để tính tổng tiền
        $dateFrom = Carbon::parse("$date_from");
        $dateTo = Carbon::parse("$date_to");
        $time_diff = $dateFrom->diffInDays($dateTo);

        if($time_from ==  '21:00' && $time_to == '11:00') {
            $room_price = $room->roomType->overnight_price;
        } else if ($time_from ==  '10:00' && $time_to == '12:00') {
            $room_price = $room->roomType->daily_price;
        } else {
            $room_price = $room->roomType->hourly_price;
        }

        $total_amount = $time_diff * $room_price; /**Tổng tiền */
        
        $booking_date = Carbon::now()->format('Y-m-d');

        $customer = Auth::guard('customer')->user();
        $customer_id = $customer->customer_id;

        $bookingData = [
            'booking_date' => $booking_date,
            'total_amount' => $total_amount,
            'request' => $request->input('request'),
            'customer_id' => $customer_id,
            'employee_id' => null,
        ];
        $booking = Booking::create($bookingData);
        $bookingDetailData = [
            'date_from' => $dateTimeFrom,
            'date_to' => $dateTimeTo,
            'room_id' => $room_id,
            'booking_id' => $booking->booking_id,
        ];
        BookingDetail::create($bookingDetailData);

        return redirect()->route('goBooking')->with('success', 'Đặt phòng thành công');
    }

    public function goBooking() {
        $customer = Auth::guard('customer')->user();
        $customer_id = $customer->customer_id;

        $booking = Customer::with(
            'booking.bookingDetail.room.roomType', // Lấy loại phòng của từng phòng trong chi tiết đặt phòng của từng đơn đặt phòng của khách hàng
            'booking.bookingDetail.room.roomImage' // Lấy các hình ảnh của từng phòng trong chi tiết đặt phòng của từng đơn đặt phòng của khách hàng
        )->find($customer_id);

        $bookings = $booking->booking;
        
        $formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');

        $userIf = 'customer.page.booking';
        return view('welcome', compact(
            'userIf',
            'bookings',
            'formatted_booking_date'
        ));
    }

    public function goBookingDetail($id) {
        $customer = Auth::guard('customer')->user();
        // $customer_id = $customer->customer_id;

        $booking = Booking::with(
            'customer',
            'employee',
            'bookingDetail.room.roomType',
            'bookingDetail.room.roomImage'
        )->find($id);

        $customer = $booking->customer;
        $bookingDetails = $booking->bookingDetail;
        foreach ($bookingDetails as $bookingDetail) {
            $bookingDetail->formatted_date_from = Carbon::parse($bookingDetail->date_from)->format('d/m/Y H:i');
            $bookingDetail->formatted_date_to = Carbon::parse($bookingDetail->date_to)->format('d/m/Y H:i');
        }

        $formatted_booking_date = Carbon::parse($booking->booking_date)->format('d/m/Y');
        $formatted_date_of_birth = Carbon::parse($customer->date_of_birth)->format('d/m/Y');

        $userIf = 'customer.page.bookingDetail';
        return view('welcome', compact(
            'userIf',
            'booking',
            'customer',
            'bookingDetails',
            'formatted_date_of_birth',
            'formatted_booking_date',
        ));
    }

    public function deleteBooking ($id) {
        BookingDetail::where('booking_id', $id)->delete();
        Booking::findOrFail($id)->delete();

        return redirect()->route('goBooking')->with('success', 'Hủy đơn thành công');
    }
}

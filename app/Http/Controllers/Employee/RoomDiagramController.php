<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingDetail;

class RoomDiagramController extends Controller
{
    public function __construct() {

    }

    public function maintenanceCompleted($id) {
        $room = Room::findOrFail($id);
        $room->status = 'Đang trống';
        $room->save();

        return redirect()->route('goRoomDiagram')->with('success', 'Bảo trì hoàn tất');
    }

    public function clearUp(Request $request, $id) {
        $room = Room::findOrFail($id);
        $room->status = $request->input('status');
        $room->save();

        return redirect()->route('goRoomDiagram')->with('success', 'Cập nhật hoàn tất');
    }

    public function check_in($id) { /**nhận phòng từ đơn đặt online */
        $room = Room::with([
            'roomType',
            'bookingDetail.booking.customer',
        ])->findOrFail($id);
        $room->status = 'Đang sử dụng';
        
        foreach ($room->bookingDetail as $bookingDetail) {
            $bookingDetail->booking->status = 'Đã nhận phòng';
            $bookingDetail->booking->save();
        }

        $room->save();
        return redirect()->route('goRoomDiagram')->with('success', 'Nhận phòng thành công');
    }

    public function handle(Request $request, $id) {
        $action = $request->input('action');

        switch ($action) {
            case 'maintenance':
                $room = Room::findOrFail($id);
                $room->status = 'Bảo trì';
                $room->save();
                return redirect()->route('goRoomDiagram')->with('success', 'Phòng bắt đầu bảo trì');
            case 'booking':
                $room = Room::with(['bookingDetail.booking.customer'])->findOrFail($id);
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

                if ($time_from ==  '21:00' && $time_to == '10:00' && $time_diff > 1) {
                    $total_amount = $room->roomType->overnight_price + (($time_diff-1) * $room->roomType->daily_price);
                } else if ($time_from ==  '21:00' && $time_to == '10:00' && $time_diff == 1) {
                    $total_amount = $room->roomType->overnight_price;
                } else if ($time_from ==  '12:00' && $time_to == '10:00') {
                    $total_amount = $time_diff * $room->roomType->daily_price;
                } else {
                    $total_amount = $room->roomType->hourly_price;
                }
                
                $booking_date = Carbon::now()->format('Y-m-d');

                $employee = Auth::guard('employee')->user();
                $employee_id = $employee->employee_id;

                $bookingData = [
                    'booking_date' => $booking_date,
                    'total_amount' => $total_amount,
                    'request' => $request->input('request'),
                    'pay' => $request->input('pay'),
                    'status' => 'Đã xác nhận',
                    'employee_id' => $employee_id,
                    'customer_id' => $request->input('customer'),
                ];
                $booking = Booking::create($bookingData);
                
                $bookingDetailData = [
                    'date_from' => $dateTimeFrom,
                    'date_to' => $dateTimeTo,
                    'room_id' => $room_id,
                    'booking_id' => $booking->booking_id,
                ];
                BookingDetail::create($bookingDetailData);

                $room->status = 'Đã đặt trước';
                $room->save();

                return redirect()->route('goRoomDiagram')->with('success', 'Đặt phòng thành công');
            case 'checkIn': /**Khách hàng lại đặt phòng và sử dụng liền */
                $room = Room::with(['bookingDetail.booking.customer'])->findOrFail($id);
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

                if ($time_from ==  '21:00' && $time_to == '10:00' && $time_diff > 1) {
                    $total_amount = $room->roomType->overnight_price + (($time_diff-1) * $room->roomType->daily_price);
                } else if ($time_from ==  '21:00' && $time_to == '10:00' && $time_diff == 1) {
                    $total_amount = $room->roomType->overnight_price;
                } else if ($time_from ==  '12:00' && $time_to == '10:00') {
                    $total_amount = $time_diff * $room->roomType->daily_price;
                } else {
                    $total_amount = $room->roomType->hourly_price;
                }
                
                $booking_date = Carbon::now()->format('Y-m-d');

                $employee = Auth::guard('employee')->user();
                $employee_id = $employee->employee_id;

                $bookingData = [
                    'booking_date' => $booking_date,
                    'total_amount' => $total_amount,
                    'request' => $request->input('request'),
                    'pay' => $request->input('pay'),
                    'status' => 'Đã nhận phòng',
                    'employee_id' => $employee_id,
                    'customer_id' => $request->input('customer'),
                ];
                $booking = Booking::create($bookingData);
                
                $bookingDetailData = [
                    'date_from' => $dateTimeFrom,
                    'date_to' => $dateTimeTo,
                    'room_id' => $room_id,
                    'booking_id' => $booking->booking_id,
                ];
                BookingDetail::create($bookingDetailData);

                $room->status = 'Đang sử dụng';
                $room->save();

                return redirect()->route('goRoomDiagram')->with('success', 'Nhận phòng thành công');
        }
    }
}
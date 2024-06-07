<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomImage;
use App\Models\Service;


class WelcomeController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $rooms = Room::with(['roomType', 'roomImage'])->paginate(4);
        $customer = Auth::guard('customer')->user();

        $userIf = 'customer.page.index';
        return view('welcome', compact(
            'userIf',
            'rooms',
            'customer',
        ));
    }

    public function goRoomList() {
        $rooms = Room::with(['roomType', 'roomImage'])->paginate(9);
        $customer = Auth::guard('customer')->user();

        $userIf = 'customer.page.roomList';
        return view('welcome', compact(
            'userIf',
            'rooms',
            'customer'
        ));
    }

    public function goRoomDetail($id) {
        $room = Room::with(['roomType', 'roomImage'])->findOrFail($id);
        $images = RoomImage::where('room_id', $id)->get();
        $customer = Auth::guard('customer')->user();
        $services = Service::all();

        $userIf = 'customer.page.roomDetail';
        return view('welcome', compact(
            'userIf',
            'room',
            'images',
            'customer',
            'services',
        ));
    }
}

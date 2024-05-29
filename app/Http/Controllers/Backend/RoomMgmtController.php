<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RoomMgmtController extends Controller
{
    public function __construct() {

    }

/**Room Type */
    public function roomType() {
        $roomTypes = RoomType::paginate(10);

        $template = 'backend.management.room.roomType';
        return view('backend.dashboard.layout', compact(
            'template',
            'roomTypes',
        ));
    }

    public function goInsertRoomType() {
        $template = 'backend.management.room.insertRoomType';
        return view('backend.dashboard.layout', compact(
            'template',
        ));
    }

    public function insertRoomType(Request $request) {
        $roomTypeData = [
            'room_type_name' => $request->input('room_type_name'),
            'description' => $request->input('description'),
            'hourly_price' => $request->input('hourly_price'),
            'overnight_price' => $request->input('overnight_price'),
            'daily_price' => $request->input('daily_price'),
        ];
        $roomType = RoomType::create($roomTypeData);
        return redirect()->route('management.roomType')->with('success', 'Thêm loại phòng thành công');
    }

    public function goEditRoomType($id) {
        $roomTypes = RoomType::findOrFail($id);
        $template = 'backend.management.room.editRoomType';
        return view('backend.dashboard.layout', compact(
            'template',
            'roomTypes'
        ));
    }

    public function editRoomType(Request $request, $id) {
        $roomTypes = RoomType::findOrFail($id);

        $fields = ['room_type_name', 'description', 'hourly_price', 'overnight_price', 'daily_price'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $roomTypes->{$field} = $request->input($field);
            }
        }

        $roomTypes->save();

        return redirect()->route('management.roomType')->with('success', 'Cập nhật thông tin thành công');

        $template = 'backend.management.room.editRoomType';
        return view('backend.dashboard.layout', compact(
            'template',
            'roomTypes'
        ));
    }

    public function goDeleteRoomType($id) {
        $roomTypes = RoomType::findOrFail($id);

        $template = 'backend.management.room.deleteRoomType';
        return view('backend.dashboard.layout', compact(
            'template',
            'roomTypes',
        ));
    }

    public function deleteRoomType(Request $request, $id) {
        $roomTypes = RoomType::findOrFail($id);

        $roomTypes->delete();

        return redirect()->route('management.roomType')->with('success','Xóa loại phòng thành công');
    }

/**Room */
    public function room() {
        $rooms = Room::with('roomType')->paginate(10);

        $template = 'backend.management.room.room';
        return view('backend.dashboard.layout', compact(
            'template',
            'rooms',
        ));
    }
    
    public function goInsertRoom() {
        $roomTypeData = RoomType::all();
        $ids = $roomTypeData->pluck('room_type_id');
        $names = $roomTypeData->pluck('room_type_name');

        $template = 'backend.management.room.insertRoom';
        return view('backend.dashboard.layout', compact(
            'template',
            'ids',
            'names',
        ));
    }

    public function insertRoom(Request $request) {
        $roomData = [
            'room_number' => $request->input('room_number'),
            'room_name' => $request->input('room_name'),
            'capacity' => $request->input('capacity'),
            'convenient' => $request->input('convenient'),
            'status' => $request->input('status'),
            'room_type_id' => $request->input('room_type_id'),
        ];
        $room = Room::create($roomData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $image->storeAs('public/roomImage', $originalName);

                RoomImage::create([
                    'image' => 'img/'.$originalName,
                    'room_id' => $room->room_id,
                ]);
            }
        }

        return redirect()->route('management.room')->with('success', 'Thêm phòng thành công');
    }

    public function goEditRoom($id) {
        $rooms = Room::findOrFail($id);
        $images = RoomImage::where('room_id', $id)->get();


        $roomTypeData = RoomType::all();
        $ids = $roomTypeData->pluck('room_type_id');
        $names = $roomTypeData->pluck('room_type_name');

        $template = 'backend.management.room.editRoom';
        return view('backend.dashboard.layout', compact(
            'template',
            'rooms',
            'ids',
            'names',
            'images',
        ));
    }

    public function editRoom(Request $request, $id) {
        $rooms = Room::findOrFail($id);

        $fields = ['room_number', 'room_name', 'capacity', 'convenient', 'status'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $rooms->{$field} = $request->input($field);
            }
        }

        if ($request->has('room_type_id')) {
            $rooms->room_type_id = $request->input('room_type_id');
        }

        $rooms->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $existingImages = RoomImage::where('room_id', $id)->get();

            foreach ($images as $key => $image) {
                $originalName = $image->getClientOriginalName();
                $image->storeAs('public/roomImage', $originalName);

                if (isset($existingImages[$key])) {
                    // Cập nhật bản ghi hiện có
                    $existingImage = $existingImages[$key];
                    $existingImage->image = 'img/'.$originalName;
                    $existingImage->save();
                } else {
                    // Tạo bản ghi mới nếu số lượng hình ảnh mới vượt quá số lượng hình ảnh cũ
                    RoomImage::create([
                        'image' => 'img/'.$originalName,
                        'room_id' => $rooms->room_id,
                    ]);
                }
            }

            // Xóa bản ghi nếu số lượng ảnh ít hơn ảnh cũ
            if (count($existingImages) > count($images)) {
                $deleteImages = $existingImages->splice(count($images));
                foreach ($deleteImages as $deleteImage) {
                    $deleteImage->delete();
                }
            }
        }
        
        return redirect()->route('management.room')->with('success', 'Cập nhật thông tin thành công');
    }

    public function goDeleteRoom($id) {
        $rooms = Room::findOrFail($id);

        $template = 'backend.management.room.deleteRoom';
        return view('backend.dashboard.layout',compact(
            'template',
            'rooms',
        ));
    }

    public function deleteRoom(Request $request, $id) {

        RoomImage::where('room_id', $id)->delete();
        Room::findOrFail($id)->delete();

        return redirect()->route('management.room')->with('success','Xóa phòng thành công');
    }

/**Room Image */
    public function roomImage($id) {
        $rooms = Room::with('roomType')->findOrFail($id);
        $images = RoomImage::where('room_id', $id)->get();

        $template = 'backend.management.room.roomImage';
        return view('backend.dashboard.layout', compact(
            'template',
            'rooms',
            'images',
        ));
    }

}

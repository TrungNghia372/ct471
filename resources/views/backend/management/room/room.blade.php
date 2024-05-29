<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý phòng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Quản lý phòng</strong>
            </li>
        </ol>
    </div>
</div>
{{-- <img src="img/login.jpg" alt=""> --}}
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="margin-top: 10px">Danh sách phòng</h5>
                
                <div class="row">
                    <div class="d-flex me-4">
                        <a href="{{ route('management.room') }}" class="btn btn-info btn-outline">Phòng</a>
                        <a href="{{ route('management.roomType') }}" class="btn btn-info btn-outline ms-2 me-2">Loại phòng</a>
    
                        <div class="input-group me-2">
                            <input type="text" class="form-control" name="" value="" placeholder="Nhập nội dung tìm kiếm">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary">Tìm kiếm</button>
                            </span>
                        </div>
    
                        <a href="{{ route('goInsertRoom') }}" class="btn btn-primary ms-1">Thêm phòng</a>
                    </div>
                </div>
                {{-- <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div> --}}
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Số phòng</th>
                            <th class="text-center">Tên phòng</th>
                            <th class="text-center">Loại phòng</th>
                            <th class="text-center">Sức chứa</th>
                            <th class="text-center col-lg-4">Tiện nghi</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($rooms) && is_object($rooms))
                            @php $stt = 1; @endphp
                            @foreach($rooms as $room)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">P.{{ $room->room_number }}</td>
                                <td class="text-center">{{ $room->room_name }}</td>
                                <td class="text-center">{{ $room->roomType->room_type_name }}</td>
                                <td class="text-center">{{ $room->capacity }}</td>
                                <td class="text-center col-lg-4">{{ $room->convenient }}</td>
                                <td class="text-center"><a href="{{ route('management.roomImage', $room->room_id) }}" class="btn btn-warning btn-outline btn-sm"><i class="fa fa-image"></i></a></td>
                                <td class="text-center">{{ $room->status }}</td>
                                <td class="text-center">
                                    <a href="{{ route('goEditRoom', $room->room_id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('goDeleteRoom', $room->room_id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $rooms->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
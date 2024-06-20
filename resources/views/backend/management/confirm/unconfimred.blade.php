<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Xác nhân đơn đặt phòng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Xác nhận</strong>
            </li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="margin-top: 10px">Danh sách đơn đặt phòng</h5>
                <div class="row">
                    <div class="d-flex me-4">
                        <a href="{{ route('goConfimred') }}" class="btn btn-info btn-outline">Đã xác nhận</a>
                        <a href="{{ route('goUnconfimred') }}" class="btn btn-info btn-outline ms-2 me-2">Chưa xác nhận</a>

                        <div class="input-group me-2">
                            <input type="text" class="form-control" name="" value="" placeholder="Nhập nội dung tìm kiếm">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary">Tìm kiếm</button>
                            </span>
                        </div>
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
                            <th class="text-center">Khách hàng</th>
                            <th class="text-center">Tên phòng</th>
                            <th class="text-center">Ngày đặt</th>
                            <th class="text-center">Yêu cầu</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Chi tiết</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($bookings) && is_object($bookings))
                            @php $stt = 1; @endphp
                            @foreach($bookings as $booking)
                                @if ($booking->employee_id == null)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td class="text-center">{{ $booking->customer->fullname }}</td>
                                    <td class="text-center">
                                        @foreach ($booking->bookingDetail as $room)
                                            {{$room->room->room_name}}
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $booking->booking_date }}</td>
                                    <td class="text-center">{{ $booking->request }}</td>
                                    <td class="text-center">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                                    <td class="text-center">
                                        <a href="{{ route('goDetail', $booking->booking_id) }}" class="btn btn-warning btn-outline btn-sm"><i class="fa fa-list"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('confirm', $booking->booking_id) }}" class="btn btn-success btn-outline btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-danger btn-outline btn-sm"><i class="fa fa-ban"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $bookings->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
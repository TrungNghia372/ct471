<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Xác nhân đơn đặt phòng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Chi tiết</strong>
            </li>
        </ol>
    </div>
</div>

<form action="{{ route('confirm', ['booking_id' => $booking]) }}" class="box" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin khách hàng</h3>
                    {{-- <div class="panel-description">Nhập thông tin của phòng</div> --}}
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ và tên:</label>
                                    <div class="form-control">{{ $booking->customer->fullname }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giới tính:</label>
                                    <div class="form-control">{{ $booking->customer->gender }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày sinh:</label>
                                    <div class="form-control">{{ $formatted_date_of_birth }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số điện thoại:</label>
                                    <div class="form-control">{{ $booking->customer->phone }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email: </label>
                                    <div class="form-control">{{ $booking->customer->email }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số CCCD</label>
                                    <div class="form-control">{{ $booking->customer->national_id }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Địa chỉ:</label>
                                    <div class="form-control">{{ $booking->customer->address }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin đơn đặt phòng</h3>
                    {{-- <div class="panel-description">Nhập thông tin của phòng</div> --}}
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày đặt:</label>
                                    <div class="form-control">{{ $formatted_booking_date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tổng tiền:</label>
                                    <div class="form-control">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày đến:</label>
                                    <div class="form-control">
                                        @foreach ($bookingDetails as $bookingDetail)
                                            {{ $bookingDetail->formatted_date_from }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày đi: </label>
                                    <div class="form-control">
                                        @foreach ($bookingDetails as $bookingDetail)
                                            {{ $bookingDetail->formatted_date_to }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Trạng thái đơn:</label>
                                    <div class="form-control">
                                        @if ($booking->employee_id == null)
                                            Chưa xác nhận
                                        @else
                                            Đã xác nhận
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Người xác nhận: </label>
                                    <div class="form-control">
                                        @if ($booking->employee_id == null)
                                            Trống
                                        @else
                                            {{ $booking->employee->fullname }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Yêu cầu:</label>
                                    <div class="form-control">{{ $booking->request }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin phòng</h3>
                    {{-- <div class="panel-description">Nhập thông tin của phòng</div> --}}
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên phòng:</label>
                                    <div class="form-control">{{ $bookingDetail->room->room_name }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Loại phòng:</label>
                                    <div class="form-control">{{ $bookingDetail->room->roomType->room_type_name }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Mô tả: </label>
                                    <div class="form-control">{{ $bookingDetail->room->roomType->description }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số phòng</label>
                                    <div class="form-control">P.{{ $bookingDetail->room->room_number }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Sức chứa: </label>
                                    <div class="form-control">{{ $bookingDetail->room->capacity }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Trạng thái: </label>
                                    <div class="form-control">{{ $bookingDetail->room->status }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giá: </label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-control">{{ number_format($bookingDetail->room->roomType->hourly_price ,0 ,',', '.') }}đ/Giờ</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control">{{ number_format($bookingDetail->room->roomType->overnight_price ,0 ,',', '.') }}đ/Đêm</div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-control">{{ number_format($bookingDetail->room->roomType->daily_price ,0 ,',', '.') }}đ/Ngày</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tiện nghi:</label>
                                    <div class="form-control">{{ $bookingDetail->room->convenient}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Hình ảnh phòng</h3>
                    {{-- <div class="panel-description">Nhập thông tin của phòng</div> --}}
                </div>
            </div>
            <div class="col-lg-9">
                <div class="carousel slide" id="carousel2">
                    <ol class="carousel-indicators">
                        @foreach($bookingDetail->room->roomImage as $index => $image)
                            <li data-slide-to="{{ $index }}" data-target="#carousel2" class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($bookingDetail->room->roomImage as $index => $image)
                            <div class="item {{ $index == 0 ? 'active' : '' }}">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset($image->image) }}" alt="Room Image" class="img-responsive"  style="max-height: 500px">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a data-slide="prev" href="#carousel2" class="left carousel-control black">
                        <span class="icon-prev"></span>
                    </a>
                    <a data-slide="next" href="#carousel2" class="right carousel-control black">
                        <span class="icon-next"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row me-1 mt-3">
            <div class="d-flex">
                <button class="btn btn-success">Xác nhận</button>
                <button class="btn btn-danger ms-2">Hủy</button>
            </div>
        </div>
    </div>
</form>
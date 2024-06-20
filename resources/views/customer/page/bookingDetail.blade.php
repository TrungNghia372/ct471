<main class="container">
    <h1 class="text-center"><hr>Chi tiết đơn đặt phòng<hr></h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="border border-2 border-black rounded-top bg-color">
                <h4 class="text-center pt-1">Thông tin khách hàng</h4>
            </div>
            <div class="border border-2 border-black border-top-0 rounded-bottom">
                <div class="row pt-2">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <p><strong>Họ và tên:</strong> {{ $customer->fullname }}</p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <p><strong>Giới tính:</strong> {{ $customer->gender }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <p><strong>Ngày sinh:</strong> {{ $formatted_date_of_birth }}</p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <p><strong>Số CCCD:</strong> {{ $customer->national_id }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <p><strong>Số điện thoại:</strong> {{ $customer->phone }}</p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5">
                        <p><strong>Email:</strong> {{ $customer->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <p><strong>Địa chỉ:</strong> {{ $customer->address }}</p>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="border border-2 border-black rounded-top bg-color">
                <h4 class="text-center pt-1">Thông tin đơn đặt phòng</h4>
            </div>
            <div class="border border-2 border-black border-top-0 rounded-bottom">
                <div class="row pt-2">
                    <div class="col-lg-6">
                        <p class="ms-5"><strong>Ngày đặt:</strong> {{ $formatted_booking_date }}</p>
                        @foreach ($bookingDetails as $bookingDetail)
                            <p class="ms-5"><strong>Ngày đến:</strong> {{ $bookingDetail->formatted_date_from }}</p>
                            <p class="ms-5"><strong>Ngày đi:</strong> {{ $bookingDetail->formatted_date_to }}</p>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <p class=""><strong>Trạng thái đơn:</strong>
                            @if ($booking->employee_id == null)
                                Chờ xác nhận
                            @else
                                Đã xác nhận
                            @endif
                        </p>
                        <p class=""><strong>Người xác nhận:</strong>
                            @if ($booking->employee_id == null)
                                Trống
                            @else
                                {{ $booking->employee->fullname }}
                            @endif
                        </p>
                        <p class=""><strong>Tổng tiền:</strong> {{ number_format($booking->total_amount, 0, ',', '.') }}đ</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="ms-5 me-5"><strong>Yêu cầu:</strong> {{ $booking->request }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="border border-2 border-black rounded-top bg-color">
                <h4 class="text-center pt-1">Thông tin phòng được đặt</h4>
            </div>
            <div class="border border-2 border-black border-top-0 rounded-bottom">
                <div class="row pt-2">
                    <div class="col-lg-12">
                        <p class="ms-5 me-5"><strong>Tên phòng:</strong> {{ $bookingDetail->room->room_name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <p class="ms-5"><strong>Số phòng:</strong> P.{{ $bookingDetail->room->room_number }}</p>
                    </div>
                    <div class="col-lg-5">
                        <p class=""><strong>Sức chứa:</strong> {{ $bookingDetail->room->capacity }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <p class="ms-5"><strong>Loại phòng:</strong> {{ $bookingDetail->room->roomType->room_type_name }}</p>
                    </div>
                    <div class="col-lg-5">
                        <p class=""><strong>Trạng thái:</strong> {{ $bookingDetail->room->status }} </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="ms-5">
                            <strong>Giá:</strong> 
                                {{ number_format($bookingDetail->room->roomType->hourly_price, 0, ',', '.') }}đ/Giờ - 
                                {{ number_format($bookingDetail->room->roomType->overnight_price, 0, ',', '.') }}đ/Đêm - 
                                {{ number_format($bookingDetail->room->roomType->daily_price, 0, ',', '.') }}đ/Ngày
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="ms-5 me-5"><strong>Mô tả:</strong> {{ $bookingDetail->room->roomType->description }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="ms-5 me-5"><strong>Tiện nghi:</strong> {{ $bookingDetail->room->convenient }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($bookingDetails as $bookingDetail)
                        @foreach ($bookingDetail->room->roomImage as $image)
                            <div class="carousel-item {{ $loop->parent->first && $loop->first ? 'active' : '' }}">
                                <img src="{{ asset($image->image) }}" class="d-block w-100 rounded" alt="Room Image"  style="max-height: 350px">
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <hr>
</main>
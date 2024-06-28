<div class="modal fade" id="unConfirmedBooking_{{$booking->booking_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('confirmEmp', ['booking_id' => $booking]) }}" method="post">
                @csrf
                <div class="modal-header green-bg">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Chi tiết đặt phòng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <strong class="fs-5 bg-success text-white bg-opacity-75 rounded-top border px-3 pt-2">Thông tin khách hàng</strong>
                    </div>
                    <div class="bg-gray p-2 mb-3 rounded">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Họ và tên:</label>
                                    <div class="form-control">{{ $booking->customer->fullname }}</div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Giới tính:</label>
                                    <div class="form-control">{{ $booking->customer->gender }}</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Ngày sinh:</label>
                                    <div class="form-control">{{$booking->formatted_date_of_birth}}</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Số CCCD:</label>
                                    <div class="form-control">{{ $booking->customer->national_id }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Địa chỉ:</label>
                                    <div class="form-control">{{ $booking->customer->address }}</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Số điện thoại:</label>
                                    <div class="form-control">{{ $booking->customer->phone }}</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Email:</label>
                                    <div class="form-control">{{ $booking->customer->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <strong class="fs-5 bg-success text-white bg-opacity-75 rounded-top border px-3 pt-2">Thông tin đặt phòng</strong>
                    </div>
                    <div class="bg-gray p-2 mb-3 rounded">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Ngày đặt:</label>
                                    <div class="form-control">{{ $booking->formatted_booking_date }}</div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Tổng tiền:</label>
                                    <div class="form-control">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Ngày đến:</label>
                                    <div class="form-control">{{ $booking->formatted_date_from }}</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Ngày đi</label>
                                    <div class="form-control">{{ $booking->formatted_date_to }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Yêu cầu:</label>
                                    <div class="form-control">
                                        @if ($booking->request != null)
                                            {{ $booking->request }}
                                        @else 
                                            <div class="fst-italic fw-light">Không có yêu cầu</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Trạng thái đơn</label>
                                    <div class="form-control">
                                        @if ($booking->employee_id == null)
                                            Chưa xác nhận
                                        @else 
                                            Đã xác nhận
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-row">
                                    <label for="" class="control-label fw-bold ms-2">Xác nhận bởi:</label>
                                    <div class="form-control">
                                        @if ($booking->employee_id != null)
                                            {{ $booking->employee->fullname }}
                                        @else 
                                            <div class="fst-italic fw-light">Trống</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <strong class="fs-5 bg-success text-white bg-opacity-75 rounded-top border px-3 pt-2">Thông tin phòng</strong>
                    </div>
                    <div class="bg-gray p-2 rounded">
                        <div class="row mb-3">
                            @foreach ($booking->bookingDetail as $bookingDetail)
                                <div class="col-lg-4">
                                    <div class="form-row">
                                        <label for="" class="control-label fw-bold ms-2">Loại phòng:</label>
                                        <div class="form-control">{{ $bookingDetail->room->roomType->room_type_name }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-row">
                                        <label for="" class="control-label fw-bold ms-2">Số phòng:</label>
                                        <div class="form-control">P.{{ $bookingDetail->room->room_number }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-row">
                                        <label for="" class="control-label fw-bold ms-2">Tên phòng:</label>
                                        <div class="form-control">{{ $bookingDetail->room->room_name }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-row">
                                        <label for="" class="control-label fw-bold ms-2">Sức chứa</label>
                                        <div class="form-control">{{ $bookingDetail->room->capacity }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>
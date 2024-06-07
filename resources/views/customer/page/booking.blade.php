<main class="container">
    <h1 class="text-center"><hr>Đơn đặt phòng<hr></h1>

    <div class="row">
        @foreach ($bookings as $booking)
            @foreach ($booking->bookingDetail as $bookingDetail)
            <div class="col-lg-6">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($bookingDetail->room->roomImage->isNotEmpty())
                                <img src="{{ $bookingDetail->room->roomImage->first()->image }}" class="img-fluid rounded-start" alt="..." style="height: 100%">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row border-bottom">
                                    <h5 class="card-title text-capitalize">{{ $bookingDetail->room->room_name }}</h5>
                                    <div class="col-lg-6">
                                        <div class="card-text"><small>
                                            <strong>Ngày đặt:</strong> {{ $booking->booking_date }}<br>
                                            <strong>Tổng tiền:</strong> {{ number_format($booking->total_amount, 0, ',', '.') }}đ<br>
                                            <strong>Trạng thái: </strong>
                                                @if ($booking->employee_id == null)
                                                    Chờ xác nhận
                                                @else 
                                                    Đã xác nhận
                                                @endif
                                        </small></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-text"><small>
                                            <strong>Ngày đến:</strong> {{ $bookingDetail->date_from }}<br>
                                            <strong>Ngày đi: </strong>{{ $bookingDetail->date_to }}
                                        </small></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-end mt-3">
                                        @if ($booking->employee_id == null)
                                            <a href="" type="button" class="btn btn-outline-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#modal_{{$booking->booking_id}}">Hủy đặt phòng</a>
                                        @else
                                            <button type="button" class="btn btn-outline-danger btn-sm ms-1" disabled>Hủy đặt phòng</button>
                                        @endif
                                        <a href="{{ route('goBookingDetail', $booking->booking_id) }}" class="btn btn-outline-primary btn-sm ms-1">Xem chi tiết</a>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal_{{$booking->booking_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-color">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hủy đặt phòng</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('deleteBooking', ['booking_id' => $booking->booking_id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div>Bạn đang muốn hủy đơn đặt phòng của phòng <strong>{{ $bookingDetail->room->room_name }}</strong> đã đặt ngày <strong>{{ $formatted_booking_date }}</strong>.</div>
                                                    <small class="text-body-secondary"><strong class="text-danger">Lưu ý:</strong> Không thể khôi phục lại đơn đặt phòng khi đã xóa.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-outline-danger">Xác nhận</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</main>
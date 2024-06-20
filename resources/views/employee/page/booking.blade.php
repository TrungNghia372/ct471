<main style="padding-top: 110px">
    <h5 class="text-center"><hr>Đơn đặt phòng<hr></h5>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <strong class="fs-5 bg-success text-white bg-opacity-75 text-light rounded-top border px-3 pt-2">Chưa xác nhận</strong>
            <table class="table table-hover">
                <thead>
                    <tr class="text-center table-success">
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>Phòng</th>
                        <th>Ngày đặt</th>
                        <th>Yêu cầu</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @if (isset($unConfirmed) && is_object($unConfirmed))
                    @php $stt = 1; @endphp
                    @foreach ($unConfirmed as $booking)
                        <tbody>
                            <tr class="table-secondary">
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">{{ $booking->customer->fullname }}</td>
                                @foreach ($booking->bookingDetail as $bookingDetail)
                                    <td class="text-center">{{ $bookingDetail->room->room_name }}</td>
                                @endforeach
                                <td class="text-center">{{ $booking->formatted_booking_date }}</td>
                                <td class="text-center">{{ $booking->request }}</td>
                                <td class="text-center">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-list"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-outline-success btn-sm"><i class="fa-regular fa-circle-check"></i></a>
                                    <a href="" class="btn btn-outline-danger btn-sm"><i class="fa-regular fa-circle-xmark"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
            <div class="text-center">{{ $unConfirmed->links('pagination::bootstrap-5') }}</div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <strong class="fs-5 bg-success text-white bg-opacity-75 text-light rounded-top border px-3 pt-2">Đã xác nhận</strong>
            <table class="table table-hover">
                <thead>
                    <tr class="text-center table-success">
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>Phòng</th>
                        <th>Ngày đặt</th>
                        <th>Yêu cầu</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @if (isset($confirmed) && is_object($confirmed))
                    @php $stt = 1; @endphp
                    @foreach ($confirmed as $booking)
                        <tbody>
                            <tr class="table-secondary">
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">{{ $booking->customer->fullname }}</td>
                                @foreach ($booking->bookingDetail as $bookingDetail)
                                    <td class="text-center">{{ $bookingDetail->room->room_name }}</td>
                                @endforeach
                                <td class="text-center">{{ $booking->formatted_booking_date }}</td>
                                <td class="text-center">{{ $booking->request }}</td>
                                <td class="text-center">{{ number_format($booking->total_amount, 0, ',', '.') }}đ</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-list"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-outline-success btn-sm"><i class="fa-regular fa-circle-check"></i></a>
                                    <a href="" class="btn btn-outline-danger btn-sm"><i class="fa-regular fa-circle-xmark"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
            <div class="text-center">{{ $confirmed->links('pagination::bootstrap-5') }}</div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</main>
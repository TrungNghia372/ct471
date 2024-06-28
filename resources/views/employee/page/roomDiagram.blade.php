<main style="padding-top: 110px">
    <h5 class="text-center"><hr>Lịch đặt phòng<hr></h5>
    <div class="row pt-3 mx-5">
        <p class="ms-2 fs-4"><strong>Dãy 1</strong></p>
        @foreach ($rooms->sortBy('room_number') as $room)
            <div class="col-lg-2">
                <a style="width: 18rem; height: 12rem" data-bs-toggle="modal" data-bs-target="#room_{{$room->room_id}}" 
                    class="card mb-3 m-auto btn text-start
                        @if ($room->status == 'Đang trống') empty
                        @elseif ($room->status == 'Đã đặt trước') order
                        @elseif ($room->status == 'Đang sử dụng') use
                        @elseif ($room->status == 'Bảo trì') maintenance
                        @elseif ($room->status == 'Đang dọn dẹp') clearUp
                        @endif">
                    <div class="card-body mt-4">
                        <h2 class="card-title">P.{{$room->room_number}}</h2>
                        <small>
                            <strong><p class="card-text">{{$room->room_name}}</p></strong>
                            <p class="mt-3">{{$room->status}}</p>
                        </small>
                    </div>
                </a>
            </div>
  
            <div class="modal fade" id="room_{{$room->room_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @if (($room->status == 'Đang trống'))
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <form id="bookingForm_{{$room->room_id}}" action="{{ route('handle', ['room_id' => $room]) }}" method="post">
                                @csrf
                                <div class="modal-header green-bg">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{$room->room_id}}" style="color: white"><div><strong>Tên:</strong> {{ $room->room_name }} - <strong>Phòng: </strong> {{ $room->room_number }}</div> </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-center table-success">
                                                    <th>Hình thức</th>
                                                    <th colspan="2">Nhận</th>
                                                    <th colspan="2">Trả</th>
                                                    <th class="col-lg-2">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-secondary text-center">
                                                    <td>    
                                                        <select class="form-select" id="bookingType_{{$room->room_id}}" onchange="updateTimeInput({{$room->room_id}}, {{ $room->roomType->hourly_price }}, {{ $room->roomType->overnight_price }}, {{ $room->roomType->daily_price }})">
                                                            <option value="">---</option>
                                                            <option value="hourly">Giờ</option>
                                                            <option value="overnight">Đêm</option>
                                                            <option value="daily">Ngày</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <input type="date" id="inputDateFrom_{{$room->room_id}}" name="date_from" class="form-control" style="width: 200px" onchange="calculateTotalAmount({{$room->room_id}}, {{ $room->roomType->hourly_price }}, {{ $room->roomType->overnight_price }}, {{ $room->roomType->daily_price }})">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <input type="time" id="inputTimeFrom_{{$room->room_id}}" name="time_from" class="form-control" style="width: 150px">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <input type="date" id="inputDateTo_{{$room->room_id}}" name="date_to" class="form-control" style="width: 200px" onchange="calculateTotalAmount({{$room->room_id}}, {{ $room->roomType->hourly_price }}, {{ $room->roomType->overnight_price }}, {{ $room->roomType->daily_price }})">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <input type="time" id="inputTimeTo_{{$room->room_id}}" name="time_to" class="form-control" style="width: 150px">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-control" id="totalPrice_{{$room->room_id}}" value="" >0đ</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-lg-6 bg-gray rounded px-3 py-2">
                                            <div class="row mt-1">
                                                <div class="col-lg-3">
                                                    <label for="" class="form-label mt-2"><strong>Khách hàng:</strong></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="customer" id="" class="form-select">
                                                        <option value="">Chọn khách hàng <hr></option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{$customer->customer_id}}">{{$customer->fullname}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 mt-1">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('goCustomerList') }}">Thêm K.Hàng</a>
                                                </div>
                                            </div>

                                            <div class="row mt-1">
                                                <div class="col-lg-3">
                                                    <label for="" class="form-label mt-2"><strong>Yêu cầu:</strong></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" name="request" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="d-flex">
                                                <div class="justify-content-end bg-gray rounded px-4 py-3 pay">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <strong>Khách cần trả:</strong>
                                                        </div>
                                                        <div class="col-lg-5 text-end">
                                                            <strong class="fw-normal" id="price_{{$room->room_id}}">0đ</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-lg-7 mt-1">
                                                            <label for="">Khách thanh toán</label>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="text" name="pay" class="form-control text-end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="action" value="maintenance" class="btn btn-secondary">Bảo trì</button>
                                    <button type="submit" name="action" value="booking" class="btn btn-order">Đặt phòng</button>
                                    <button type="submit" name="action" value="checkIn" class="btn btn-success">Nhận phòng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif ($room->status == 'Đang sử dụng')
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="" method="get">
                                <div class="modal-header green-bg">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Đang sử dụng</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mx-2">
                                    <h4 class="">{{ $room->room_name }}</h4>
                                    @foreach ($room->bookingDetail as $bookingDetail)
                                        @php
                                            $booking = $bookingDetail->booking;
                                            $customer = $booking->customer;
                                        @endphp
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-clock me-3"></i> {{ $booking->formatted_date_from }} - {{ $booking->formatted_date_to }}</label>
                                        </div>
                                            <div class="row mb-1">
                                                <label for="" class="col-form-label"><i class="fa-solid fa-user me-3"></i> {{ $customer->fullname }}</label>
                                            </div>
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-eye me-3"></i> P.{{ $room->room_number }}</label>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-pen-nib me-3"></i> {{ $booking->request }}</label>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-receipt me-3"></i> {{ number_format($booking->total_amount, 0, ',', '.') }}đ</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Chỉnh sửa</button>
                                    <button type="submit" class="btn btn-success">Trả phòng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif ($room->status == 'Đã đặt trước')
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('check_in', ['room_id' => $room]) }}" method="post">
                                @csrf
                                <div class="modal-header green-bg">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Đã đặt trước</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mx-2">
                                    <h4 class="">{{ $room->room_name }}</h4>
                                    @foreach ($room->bookingDetail as $bookingDetail)
                                        @php
                                            $booking = $bookingDetail->booking;
                                            $customer = $booking->customer;
                                        @endphp
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-clock me-3"></i> {{ $booking->formatted_date_from }} - {{ $booking->formatted_date_to }}</label>
                                        </div>
                                            <div class="row mb-1">
                                                <label for="" class="col-form-label"><i class="fa-solid fa-user me-3"></i> {{ $customer->fullname }}</label>
                                            </div>
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-eye me-3"></i> P.{{ $room->room_number }}</label>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-pen-nib me-3"></i> {{ $booking->request }}</label>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="" class="col-form-label"><i class="fa-solid fa-receipt me-3"></i> {{ number_format($booking->total_amount, 0, ',', '.') }}đ</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Chỉnh sửa</button>
                                    <button type="submit" class="btn btn-success">Nhận phòng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif ($room->status == 'Bảo trì') 
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('maintenanceCompleted', ['room_id' => $room]) }}" method="post">
                                @csrf
                                <div class="modal-header green-bg">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Đang bảo trì</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center">{{$room->room_name}}</h4>
                                    <div class="row">
                                        <div class="col-lg-3 mt-1 text-end">
                                            <label for="" class="control-label text-right"><strong>Tình trạng:</strong> </label>
                                        </div>
                                        <div class="col-lg-8 text-center">
                                            <p class="form-control">{{$room->status}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn btn-success">Bảo trì hoàn tất</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif ($room->status == 'Đang dọn dẹp') 
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('clearUp', ['room_id' => $room]) }}" method="post">
                                @csrf
                                <div class="modal-header green-bg">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Đang dọn dẹp</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center">{{$room->room_name}}</h4>
                                    <div class="row">
                                        <div class="col-lg-3 mt-1 text-end">
                                            <label for="" class="control-label text-right">Tình trạng: </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="status" id="" class="form-select">
                                                <option value="Đang trống">Phòng trống</option>
                                                <option value="Bảo trì">Bảo trì</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</main>

<script>
    function updateTimeInput(room_id, hourlyPrice, overnightPrice, dailyPrice) {
        let selectedValue = document.getElementById("bookingType_" + room_id).value;
        let priceElement = document.getElementById('totalPrice_' + room_id);

        var dateFromInput = document.getElementById('inputDateFrom_' + room_id);
        var dateToInput = document.getElementById('inputDateTo_' + room_id);
        var today = new Date().toISOString().split('T')[0];

        dateFromInput.setAttribute('min', today);
        dateToInput.setAttribute('min', today);

        dateFromInput.addEventListener('change', function() {
            var selectedDateFrom = dateFromInput.value;
            dateToInput.setAttribute('min', selectedDateFrom);

            // Nếu ngày đi hiện tại trước ngày đến, xóa giá trị của ngày đi
            if (dateToInput.value < selectedDateFrom) {
                dateToInput.value = '';
            }
        });

        const timeFrom = document.getElementById('inputTimeFrom_' + room_id);
        const timeTo = document.getElementById('inputTimeTo_' + room_id);
        
        if (selectedValue === "hourly") {
            priceElement.setAttribute('value', hourlyPrice);

            timeFrom.value = '';
            timeTo.value = '';
            timeFrom.readOnly = false;
            timeTo.readOnly = false;
        } else if (selectedValue === "overnight") {
            priceElement.setAttribute('value', overnightPrice);

            timeFrom.value = '21:00';
            timeTo.value = '10:00';
            timeFrom.readOnly = true;
            timeTo.readOnly = true;
        } else if (selectedValue === "daily") {
            priceElement.setAttribute('value', dailyPrice);

            timeFrom.value = '12:00';
            timeTo.value = '10:00';
            timeFrom.readOnly = true;
            timeTo.readOnly = true;
        }
        
        // Reset date inputs
        document.getElementById('inputDateFrom_' + room_id).value = '';
        document.getElementById('inputDateTo_' + room_id).value = '';

        // Reset total price
        document.getElementById('totalPrice_' + room_id).innerText = '0đ';
        document.getElementById('price_' + room_id).innerText = '0đ';
    }

    function calculateTotalAmount(room_id, hourlyPrice, overnightPrice, dailyPrice) {
        var inputDateFrom = document.getElementById('inputDateFrom_' + room_id).value;
        var inputDateTo = document.getElementById('inputDateTo_' + room_id).value;

        var inputTimeFrom = document.getElementById('inputTimeFrom_' + room_id).value;
        var inputTimeTo = document.getElementById('inputTimeTo_' + room_id).value;

        // Tính toán tổng số ngày đặt phòng
        var dateFrom = new Date(inputDateFrom);
        var dateTo = new Date(inputDateTo);
        var timeDiff = dateTo.getTime() - dateFrom.getTime();
        var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if (inputTimeFrom == '21:00' && inputTimeTo == '10:00') {
            if (daysDiff > 1) {
                totalPrice = overnightPrice + (daysDiff-1) * dailyPrice;
            } else if (daysDiff == 1) {
                totalPrice = overnightPrice;
            }
        } else if (inputTimeFrom == '12:00' && inputTimeTo == '10:00') {
            totalPrice = daysDiff * dailyPrice;
        }

        // Hiển thị tổng tiền lên giao diện
        document.getElementById('totalPrice_' + room_id).textContent = totalPrice.toLocaleString('vi-VN') + 'đ';
        document.getElementById('price_' + room_id).textContent = totalPrice.toLocaleString('vi-VN') + 'đ';
    }

    window.onload = updateTimeInput;
    window.onload = calculateTotalAmount;
</script>

{{-- 2 thiếu 150k --}}
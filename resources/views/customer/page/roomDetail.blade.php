<main>
    <div class="container">
        <h1 class="text-center"><hr>Chi tiết phòng<hr></h1>
        <div class="row mt-3">
            <div class="col-lg-8">
                <div class="row">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            @foreach($images as $index => $image)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide 1"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image->image) }}" class="d-block w-100 rounded" alt="" style="max-height: 500px">
                                </div>
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

            <div class="col-lg-4 bg-color rounded">
                <div class="row mt-1">
                    <div class="col-lg-12">
                        <label for="" class="control-label text-right fw-bold ms-1">Tên phòng: </label>
                        <p class="form-control">{{ $room->room_name }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="" class="control-label text-right fw-bold ms-1">Số phòng: </label>
                        <p class="form-control">{{ $room->room_number }}</p>
                    </div>

                    <div class="col-lg-6">
                        <label for="" class="control-label text-right fw-bold ms-1">Sức chứa: </label>
                        <p class="form-control">{{ $room->capacity }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <label for="" class="control-label text-right fw-bold ms-1">Tình trạng: </label>
                        <p class="form-control">{{ $room->status }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-row">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label for="" class="control-label text-right fw-bold ms-1">Giá:</label>
                                </div>
                                <div class="col-lg-10">
                                    <p class="form-control text-center" style="font-size: 15px">{{ number_format($room->roomType->hourly_price, 0, ',', '.') }}đ/giờ</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <p class="form-control text-center" style="font-size: 15px">{{ number_format($room->roomType->overnight_price, 0, ',', '.') }}đ/đêm</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <p class="form-control text-center" style="font-size: 15px">{{ number_format($room->roomType->daily_price, 0, ',', '.') }}đ/ngày</p>
                                </div>
                            </div>
                    </div>
                </div>

                <hr class="mt-4">
                <div class="row mt-3">
                    <div class="d-flex justify-content-center">
                        <a href="" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Đặt phòng</a>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-color">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin đặt phòng</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('booking', $room->room_id) }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    {{-- ==================================== --}}
                                    <div class="row">
                                        <div class="col-lg-6 border-end">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Tên phòng: </label>
                                                    <p class="form-control">{{ $room->room_name }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Loại phòng: </label>
                                                    <p class="form-control">{{ $room->roomType->room_type_name }}</p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Số phòng: </label>
                                                    <p class="form-control">P.{{ $room->room_number }}</p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Sức chứa: </label>
                                                    <p class="form-control">{{ $room->capacity }}</p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label class="control-label text-right fw-bold ms-1">Họ và tên:</label>
                                                    <input type="text" name="fullname" class="form-control" value="{{ $customer->fullname ?? '' }}" placeholder="Nhập họ tên đầy đủ của bạn.">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="control-label text-right fw-bold ms-1">Giới tính:</label>
                                                    <input type="text" name="gender" class="form-control" value="{{ $customer->gender ?? '' }}" placeholder="Nhập giới của bạn.">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label class="control-label text-right fw-bold ms-1">Số điện thoại:</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ $customer->phone ?? '' }}" placeholder="Nhập số điện thoại của bạn.">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="control-label text-right fw-bold ms-1">Email:</label>
                                                    <input type="text" name="email" class="form-control" value="{{ $customer->email ?? '' }}" placeholder="Nhập email của bạn">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Yêu cầu: </label>
                                                    <textarea name="request" class="form-control mb-3" id="" cols="30" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 border-start">
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label fw-bold ms-1" for="inlineRadio1">Hình thức đặt phòng:</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="hourly" onchange="updateTimeInputs()">
                                                        <label class="form-check-label me-4" for="inlineRadio1">Giờ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="overnight" onchange="updateTimeInputs()" checked>
                                                        <label class="form-check-label me-4" for="inlineRadio2">Đêm</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="daily" onchange="updateTimeInputs()">
                                                        <label class="form-check-label me-4" for="inlineRadio3">Ngày</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="inputDateFrom" class="control-label text-right fw-bold ms-1">Ngày đến</label>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input type="date" name="date_from" class="form-control" id="inputDateFrom" onchange="calculateTotal()">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="time" name="time_from" class="form-control" id="inputTimeFrom" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="inputDateTo" class="control-label text-right fw-bold ms-1">Ngày đi</label>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input type="date" name="date_to" class="form-control" id="inputDateTo" onchange="calculateTotal()">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="time" name="time_to" class="form-control" id="inputTimeTo" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Tổng tiền: </label>
                                                    <p class="form-control" id="totalPrice" value=""></p>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label fw-bold ms-1" for="inlineRadio1">Phương thức thanh toán:</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">Thanh toán khi nhận phòng</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">Thanh toán online</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="noticeRow">
                                                <div class="col-lg-12">
                                                    <small>
                                                        <p>
                                                            <strong class="text-danger">Lưu ý: </strong>
                                                            Thời gian nhận phòng 
                                                            <strong id="date_from" class="text-success"></strong> 
                                                            và thời gian trả phòng  
                                                            <strong id="date_to" class="text-success"></strong>
                                                        </p>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ==================================== --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 bg-color rounded">
            <div class="col-lg-12 mt-2">
                <label for="" class="control-label text-right fw-bold ms-1">Tiện nghi: </label>
                <p class="form-control">{{ $room->convenient }}</p>
            </div>
        </div>
        <hr>
    </div>
</main>

<script>
    function updateTimeInputs() {
        const hourlyPrice = {{ $room->roomType->hourly_price }};
        const overnightPrice = {{ $room->roomType->overnight_price }};
        const dailyPrice = {{ $room->roomType->daily_price }};
        
        let selectedValue = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
        let priceElement = document.getElementById('totalPrice');

        const timeFrom = document.getElementById('inputTimeFrom');
        const timeTo = document.getElementById('inputTimeTo');
        
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
        document.getElementById('inputDateFrom').value = '';
        document.getElementById('inputDateTo').value = '';

        // Reset total price
        document.getElementById('totalPrice').innerText = '0đ';

        //Reset notice
        document.getElementById('noticeRow').style.display = 'none';
    }

    window.onload = updateTimeInputs;
</script>
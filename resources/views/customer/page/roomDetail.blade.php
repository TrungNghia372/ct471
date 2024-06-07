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
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label for="inputDateFrom" class="control-label text-right fw-bold ms-1">Ngày đến</label>
                                                    <input type="date" name="date_from" class="form-control" id="inputDateFrom" onchange="calculateTotal()">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="inputDateTo" class="control-label text-right fw-bold ms-1">Ngày đi</label>
                                                    <input type="date" name="date_to" class="form-control" id="inputDateTo" onchange="calculateTotal()">
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
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="control-label text-right fw-bold ms-1">Tổng tiền: </label>
                                                    <p class="form-control" id="totalPrice" value="{{ $room->roomType->overnight_price}}">0đ</p>
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
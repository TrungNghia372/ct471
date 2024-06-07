<main>
    <img src="img/cust/roomlist1.jpg" alt="" class="">

    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-3 bg-color border-end border-light rounded">
                <h3 class="text-center"><hr>Danh mục<hr></h3>
            </div>

            <div class="col-lg-9 bg-color border-start border-light rounded">
                <h3 class="text-center"><hr>Danh sách phòng<hr></h3>
                <div class="row">
                    @foreach ($rooms as $room)
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="card max-h border border-light" style="width: 18rem;">
                                <img src="{{ $room->roomImage->first()->image }}" class="card-img-top img-room" alt="Room Image">
                                <div class="card-body">
                                    <h5 class="card-title text-sm title-room ">{{ $room->room_name }}</h5>
                                    <div class="" style="height: 105px">
                                        <p class="card-text text-sm max-h ellipsis"><strong>Tiện nghi:</strong> {{$room->convenient}} </p>
                                        <div class="row">
                                            <div class="text-sm">
                                                <label for="" class=""><strong>Giá:</strong></label>
                                                <p class="text-center">{{number_format($room->roomType->hourly_price, 0, ',', '.')}}đ/giờ - {{number_format($room->roomType->overnight_price, 0, ',', '.')}}đ/đêm - {{number_format($room->roomType->daily_price, 0, ',', '.')}}đ/ngày</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('goRoomDetail', $room->room_id) }}" class="btn btn-outline-primary btn-sm mt-1">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    <div class="">{{ $rooms->links('pagination::bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
</main>
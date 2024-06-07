<main>
    @include('customer.componentCust.carousel')
    
    @include('customer.componentCust.introduction')

    <div class="container">
        <div class="row">
            <h1 class="text-center"><hr>Danh Sách Phòng<hr></h1>
            <div class="row ms-1">
                @foreach ($rooms as $room)
                <div class="col-lg-3 mb-3">
                    <div class="d-flex justify-content-center">
                        <div class="card max-h" style="width: 18rem;">
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
            <div class="row mt-2">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="d-flex justify-content-center">
                        <div class="">{{ $rooms->links('pagination::bootstrap-4') }}</div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="d-flex justufy-content-end">
                        <a href="{{ route('goRoomList') }}" class="btn btn-outline-primary">Xem thêm phòng</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</main>

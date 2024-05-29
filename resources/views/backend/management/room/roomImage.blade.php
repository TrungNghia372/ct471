<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý phòng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Quản lý phòng</strong>
            </li>
        </ol>
    </div>
</div>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5 style="margin-top: 10px">Chi tiết phòng</h5>

        <div class="row">
            <div class="d-flex me-4">
                <a href="{{ route('management.room') }}" class="btn btn-info btn-outline">Phòng</a>
                <a href="{{ route('management.roomType') }}" class="btn btn-info btn-outline ms-2 me-2">Loại phòng</a>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-5">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="form-row">
                            <label for="" class="control-label text-right">Số phòng:</label>
                            <p class="form-control">{{ $rooms->room_number }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-row">
                            <label for="" class="control-label text-right">Loại phòng:</label>
                            <p class="form-control">{{ $rooms->roomType->room_type_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <label for="" class="control-label text-right">Tên phòng:</label>
                            <p class="form-control">{{ $rooms->room_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="form-row">
                            <label for="" class="control-label text-right">Sức chứa:</label>
                            <p class="form-control">{{ $rooms->capacity }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-row">
                            <label for="" class="control-label text-right">Trạng thái:</label>
                            <p class="form-control">{{ $rooms->status }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <label for="" class="control-label text-right">Tiện nghi:</label>
                            <p class="form-control" style="padding-bottom: 45px">{{ $rooms->convenient }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="carousel slide" id="carousel2">
                    <ol class="carousel-indicators">
                        @foreach($images as $index => $image)
                            <li data-slide-to="{{ $index }}" data-target="#carousel2" class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($images as $index => $image)
                            <div class="item {{ $index == 0 ? 'active' : '' }}">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset($image->image) }}" alt="Room Image" class="img-responsive" style="width:80%; height:auto; margin:10px;">
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
    </div>
</div>
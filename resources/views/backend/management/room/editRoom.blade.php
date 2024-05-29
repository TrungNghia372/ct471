<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý phòng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Cập nhật</strong>
            </li>
        </ol>
    </div>
</div>

<form action="{{ route('management.editRoom', ['room_id' => $rooms]) }}" class="box" method="post" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin phòng</h3>
                    <div class="panel-description">Nhập thông tin của phòng</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Loại phòng: <span class="text-danger">(*)</span></label>
                                    <select name="room_type_id" id="" class="form-control">
                                        <option value="">{{ $rooms->roomType->room_type_name }}</option>
                                        <hr>
                                        @foreach($ids as $index => $id)
                                            <option value="{{ $id }}">{{ $names[$index] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="status" class="control-label text-right">Tình trạng: <span class="text-danger">(*)</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">{{ $rooms->status }}</option><hr>
                                        <option value="Đang trống">Đang trống</option>
                                        <option value="Đang sử dụng">Đang sử dụng</option>
                                        <option value="Đã đặt trước">Đã đặt trước</option>
                                        <option value="Bảo trì">Bảo trì</option>
                                        <option value="Đang dọn dẹp">Đang dọn dẹp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số phòng: <span class="text-danger">(*)</span></label>
                                    <input type="number" name="room_number" value="{{ $rooms->room_number }}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên phòng: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="room_name" value="{{ $rooms->room_name }}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Sức chứa: <span class="text-danger">(*)</span></label>
                                    <input type="number" name="capacity" value="{{ $rooms->capacity }}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Hình ảnh phòng: <span class="text-danger">(*)</span></label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tiện nghi: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="convenient" value="{{ $rooms->convenient }}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row me-1">
            <div class="d-flex">
                <button class="btn btn-info">Lưu</button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Hình ảnh phòng</h3>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 bg-white">
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
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
</form>
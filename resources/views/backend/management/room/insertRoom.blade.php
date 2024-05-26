<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý phòng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Thêm</strong>
            </li>
        </ol>
    </div>
</div>

<form action="{{ route('management.insertRoom') }}" class="box" method="post">
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
                                    <label for="" class="control-label text-right">Số phòng: <span class="text-danger">(*)</span></label>
                                    <input type="number" name="room_number" value="" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Loại phòng: <span class="text-danger">(*)</span></label>
                                    <select name="room_type_id" id="" class="form-control">
                                        <option value="">Chọn loại phòng</option>
                                        <hr>
                                        @foreach($ids as $index => $id)
                                            <option value="{{ $id }}">{{ $names[$index] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên phòng: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="room_name" value="" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Sức chứa: <span class="text-danger">(*)</span></label>
                                    <input type="number" name="capacity" value="" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="status" class="control-label text-right">Tình trạng: <span class="text-danger">(*)</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Chọn tình trạng</option><hr>
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
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tiện nghi: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="convenient" value="" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row me-1">
            <div class="d-flex">
                <button class="btn btn-info">Thêm phòng</button>
            </div>
        </div>
    </div>
</form>
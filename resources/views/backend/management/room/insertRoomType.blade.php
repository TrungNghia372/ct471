<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý loại phòng</h2>
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

<form action="{{ route('management.insertRoomType') }}" class="box" method="post">
    @csrf
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin loại phòng</h3>
                    <div class="panel-description">Nhập thông tin của loại phòng</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <div class="form-row">
                                        <label for="" class="control-label text-right">Tên loại: <span class="text-danger">(*)</span></label>
                                        <input type="text" name="room_type_name" value="" class="form-control" placeholder="">
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">Giá theo giờ: <span class="text-danger">(*)</span></label>
                                            <input type="number" name="hourly_price" value="" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">Giá qua đêm: <span class="text-danger">(*)</span></label>
                                            <input type="number" name="overnight_price" value="" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">Giá theo ngày: <span class="text-danger">(*)</span></label>
                                            <input type="number" name="daily_price" value="" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Mô tả: <span class="text-danger">(*)</span></label>
                                    <textarea name="description" id="" class="form-control" cols="1" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row me-1">
            <div class="d-flex">
                <button class="btn btn-info">Thêm loại phòng</button>
            </div>
        </div>
    </div>
</form>
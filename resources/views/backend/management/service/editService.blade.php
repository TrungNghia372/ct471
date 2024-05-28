<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý dịch vụ</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Chỉnh sửa</strong>
            </li>
        </ol>
    </div>
</div>

<form action="{{ route('management.editService', ['service_id' => $services]) }}" class="box" method="post">
    @csrf
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin chung</h3>
                    <div class="panel-description">Nhập thông tin chung của dịch vụ</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tên dịch vụ: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="service_name" value="{{ $services->service_name }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giá: <span class="text-danger">(*)</span></label>
                                    <input type="number" name="service_price" value="{{ $services->service_price }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Mô tả: <span class="text-danger">(*)</span></label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="5">{{ $services->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row me-1">
            <div class="d-flex">
                <button class="btn btn-info">Thêm dịch vụ</button>
            </div>
        </div>
    </div>
</form>
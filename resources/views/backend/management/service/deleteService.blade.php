<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý nhân viên</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Xóa</strong>
            </li>
        </ol>
    </div>
</div>

<form action="" class="box" method="post">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <div class="panel-title">Bạn đang muốn xóa dịch vụ: {{ $services->service_name }}</div>
                    <div class="panel-description mt-3"><strong>Lưu ý:</strong> Không thể khôi phục sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này.</div>
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
                                    <label for="" class="control-label text-right">Mô tả: <span class="text-danger">(*)</span></label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ $services->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex me-4">
                <button class="btn btn-danger">Xác nhận</button>
            </div>
        </div>
    </div>
</form>
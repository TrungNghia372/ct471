<form action="{{ route('management.editCustomer', ['customer_id' => $customers]) }}" class="box" method="post">
    @csrf
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">Nhập thông tin chung của khách hàng</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ và tên: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="fullName" value="{{ old('fullname', ($customers->fullname)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="email" value="{{ old('email', ($customers->email)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày sinh (mm/dd/yyyy): <span class="text-danger">(*)</span></label>
                                    <input type="date" name="date" value="{{ old('date_of_birth', ($customers->date_of_birth)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giới tính: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="gender" value="{{ old('gender', ($customers->gender)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số điện thoại: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="phone" value="{{ old('phone', ($customers->phone)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số CCCD: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="national_id" value="{{ old('national_id', ($customers->national_id)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Tỉnh/Thành phố: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="province" value="{{ $province }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Quận/Huyện: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="district" value="{{ $district }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Xã/Phường: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="ward" value="{{ $ward }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <div class="panel-title">Bảo mật</div>
                    <div class="panel-description">Thay đổi mật khẩu</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">

                    </div>
                </div>
            </div>
        </div>
        <div class="row me-1">
            <div class="d-flex">
                <button class="btn btn-info">Lưu</button>
            </div>
        </div>
    </div>
</form>
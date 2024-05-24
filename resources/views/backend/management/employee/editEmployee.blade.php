<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý nhân viên</h2>
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

<form action="{{ route('management.editEmployee', ['employee_id' => $employees]) }}" class="box" method="post">
    @csrf
    <div class="wrapper wrapper-content animated fadeRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h3>Thông tin chung</h3>
                    <div class="panel-description">Nhập thông tin chung của nhân viên</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ và tên: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="fullName" value="{{ old('fullname', ($employees->fullname)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Giới tính: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="gender" value="{{ old('gender', ($employees->gender)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số CCCD: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="national_id" value="{{ old('national_id', ($employees->national_id)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày sinh (mm/dd/yyyy): <span class="text-danger">(*)</span></label>
                                    <input type="date" name="date" value="{{ old('date_of_birth', ($employees->date_of_birth)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Ngày bắt đầu làm việc (mm/dd/yyyy): <span class="text-danger">(*)</span></label>
                                    <input type="date" name="hire_date" value="{{ old('hire_date', ($employees->hire_date)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Mức lương: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="salary" value="{{ $employees->salary }}" class="form-control" placeholder="" autocomplete="off">
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
                    <h3>Thông tin liên hệ</h3>
                    <div class="panel-description">Nhập thông tin liên hệ của nhân viên</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Số điện thoại: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="phone" value="{{ old('phone', ($employees->phone)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="email" value="{{ old('email', ($employees->email)) }}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Xã/Phường: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="ward" value="{{ $ward }}" class="form-control" placeholder="" autocomplete="off">
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
                                    <label for="" class="control-label text-right">Tỉnh/Thành phố: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="province" value="{{ $province }}" class="form-control" placeholder="" autocomplete="off">
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
                    <h3>Bảo mật</h3>
                    <div class="panel-description">Nhập mật khẩu để tạo tài khoản cho nhân viên</div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Nhập mật khẩu: <span class="text-danger">(*)</span></label>
                                    <input type="password" name="password1" value="" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Nhập lại mật khẩu: <span class="text-danger">(*)</span></label>
                                    <input type="password" name="password2" value="" class="form-control" autocomplete="off">
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
    </div>
</form>
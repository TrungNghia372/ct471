<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý nhân viên</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Quản lý nhân viên</strong>
            </li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="margin-top: 10px">Danh sách nhân viên</h5>
                <div class="row">
                    <div class="d-flex me-4">
                        <div class="input-group me-2">
                            <input type="text" class="form-control" name="" value="" placeholder="Nhập nội dung tìm kiếm">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary">Tìm kiếm</button>
                            </span>
                        </div>
                        <a href="{{ route('goInsertEmployee') }}" class="btn btn-primary ms-1">Thêm nhân viên</a>
                    </div>
                </div>
                {{-- <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div> --}}
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Họ và tên</th>
                            <th class="text-center">Giới tính</th>
                            <th class="text-center">Thời gian</th>
                            <th class="text-center">Lương</th>
                            <th class="col-lg-3 text-center">Liên hệ</th>
                            <th class="text-center">Số CCCD</th>
                            <th class="col-lg-3 text-center">Địa chỉ</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($employees) && is_object($employees))
                            @php $stt = 1; @endphp
                            @foreach($employees as $employee)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td  class="text-center">{{ $employee->fullname }}</td>
                                <td class="text-center">{{ $employee->gender }}</td>
                                <td>
                                    <div><strong>Ngày sinh:</strong> {{ $employee->date_of_birth }}</div>
                                    <div><strong>Ngày vào làm:</strong> {{ $employee->hire_date }}</div>
                                </td>
                                <td class="text-center">{{ number_format($employee->salary, 0, ',', '.') }}đ</td>
                                <td class="">
                                    <div><strong>Số điện thoại:</strong> {{ $employee->phone }}</div>
                                    <div><strong>Email:</strong> {{ $employee->email }}</div>
                                </td>
                                <td class="text-center">{{ $employee->national_id }}</td>
                                <td>{{ $employee->address }}</td>
                                <td class="text-center">
                                    <a href="{{ route('goEditEmployee', $employee->employee_id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('goDeleteEmployee', $employee->employee_id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $employees->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý khách hàng</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Quản lý khách hàng</strong>
            </li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="margin-top: 10px">Danh sách khách hàng</h5>
                <div class="row">
                    <div class="d-flex me-4">
                        <div class="input-group me-2">
                            <input type="text" class="form-control" name="" value="" placeholder="Nhập nội dung tìm kiếm">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary">Tìm kiếm</button>
                            </span>
                        </div>
                        <a href="{{ route('goInsertCustomer') }}" class="btn btn-primary ms-5">Thêm khách hàng</a>
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
                            <th class="text-center">Ngày sinh</th>
                            <th class="text-center">Giới tính</th>
                            <th class="col-lg-2 text-center">Email</th>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Số CCCD</th>
                            <th class="col-lg-3 text-center">Địa chỉ</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($customers) && is_object($customers))
                            @php $stt = 1; @endphp
                            @foreach($customers as $customer)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">{{ $customer->fullname }}</td>
                                <td class="text-center">{{ $customer->date_of_birth }}</td>
                                <td class="text-center">{{ $customer->gender }}</td>
                                <td >{{ $customer->email }}</td>
                                <td class="text-center">{{ $customer->phone }}</td>
                                <td class="text-center">{{ $customer->national_id }}</td>
                                <td>{{ $customer->address }}</td>
                                <td class="text-center">
                                    <a href="{{ route('goEditCustomer', $customer->customer_id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('goDeleteCustomer', $customer->customer_id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $customers->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>

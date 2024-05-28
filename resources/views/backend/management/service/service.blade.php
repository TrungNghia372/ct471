<div class="row border-bottom white-bg" style="margin: 1px">
    <div class="col-lg-8">
        <h2>Quản lý dịch vụ</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index')}}">Trang chủ</a>
            </li>
            <li class="active">
                <strong>Quản lý dịch vụ</strong>
            </li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="margin-top: 10px">Danh sách dịch vụ</h5>
                <div class="row">
                    <div class="d-flex me-4">
                        <div class="input-group me-2">
                            <input type="text" class="form-control" name="" value="" placeholder="Nhập nội dung tìm kiếm">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary">Tìm kiếm</button>
                            </span>
                        </div>
                        <a href="{{ route('goInsertService') }}" class="btn btn-primary ms-1">Thêm dịch vụ</a>
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
                            <th class="text-center col-lg-1">STT</th>
                            <th class="text-center col-lg-3">Dịch vụ</th>
                            <th class="text-center col-lg-4">Mô tả</th>
                            <th class="text-center col-lg-3">Giá</th>
                            <th class="text-center col-lg-1">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($services) && is_object($services))
                            @php $stt = 1; @endphp
                            @foreach($services as $service)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">{{ $service->service_name }}</td>
                                <td class="text-center">{{ $service->description }}</td>
                                <td class="text-center">{{ number_format($service->service_price, 0, ',', '.') }} VNĐ</td>
                                <td class="text-center">
                                    <a href="{{ route('goEditService', $service->service_id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('goDeleteService', $service->service_id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="text-center">{{ $services->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
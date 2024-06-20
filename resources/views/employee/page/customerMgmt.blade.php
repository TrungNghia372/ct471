<main style="padding-top: 110px">
    <h5 class="text-center"><hr>Danh sách khách hàng<hr></h5>

    <div class="row mb-3">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#insertCusModal"><i class="fa-solid fa-user-plus"></i> Thêm khách hàng</a>
                
                @include('employee.componentEmp.modal.insertCustModal')
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="text-center table-success">
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Số điên thoại</th>
                        <th>Số CCCD</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                @if (isset($customers) && is_object($customers))
                    @php $stt = 1; @endphp
                    @foreach ($customers as $customer)
                        <tbody>
                            <tr class="table-secondary">
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">{{ $customer->fullname }}</td>
                                <td class="text-center">{{ $customer->formatted_date_of_birth}}</td>
                                <td class="text-center">{{ $customer->gender }}</td>
                                <td class="text-center">{{ $customer->email }}</td>
                                <td class="text-center">{{ $customer->phone }}</td>
                                <td class="text-center">{{ $customer->national_id }}</td>
                                <td class="text-center">{{ $customer->address }}</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCustModal_{{$customer->customer_id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCustModal_{{$customer->customer_id}}"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>

                        @include('employee.componentEmp.modal.editCustModal')
                        @include('employee.componentEmp.modal.deleteCustModal')

                    @endforeach
                @endif
            </table>
            <div class="text-center">{{ $customers->links('pagination::bootstrap-5') }}</div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</main>

{{-- 
@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const insertCusModal = new bootstrap.Modal(document.getElementById('insertCusModal'));
            insertCusModal.show();
        });
    </script>
@endif

@if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const insertCusModal = new bootstrap.Modal(document.getElementById('insertCusModal'));
        
        // Nếu không có thông báo lỗi, xóa trạng thái modal khỏi Local Storage
        if (!@json($errors->any())) {
            localStorage.removeItem('insertCusModalOpen');
        }
        
        // Kiểm tra Local Storage để mở modal nếu cần thiết
        if (localStorage.getItem('insertCusModalOpen') === 'true') {
            insertCusModal.show();
        }

        // Lưu trạng thái modal vào Local Storage khi modal được mở
        document.getElementById('insertCusModal').addEventListener('shown.bs.modal', function () {
            localStorage.setItem('insertCusModalOpen', 'true');
        });

        // Xóa trạng thái modal khỏi Local Storage khi modal được đóng
        document.getElementById('insertCusModal').addEventListener('hidden.bs.modal', function () {
            localStorage.removeItem('insertCusModalOpen');
        });
    });
</script> --}}
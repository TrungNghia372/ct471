<div class="modal fade" id="deleteCustModal_{{$customer->customer_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" role="form" action="{{ route('deleteCust', ['customer_id'=> $customer]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-header green-bg">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Xóa tài khoản khách hàng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn đang muốn xóa tài khoản của người dùng <strong>{{ $customer->fullname }}</strong> có email là <strong>{{ $customer->email }}</strong>!</p>
                    <p><strong class="text-danger">Lưu ý: </strong> bạn sẽ không thể khôi phục tài khoản khi đã xóa.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-danger">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>
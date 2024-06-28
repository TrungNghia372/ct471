<div class="modal fade" id="deleteBooking_{{$booking->booking_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('deleteBookingEmp', ['booking_id' => $booking]) }}" method="post">
            @csrf
            @method('DELETE')
                <div class="modal-header green-bg">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Xóa đơn đặt phòng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Xác nhận xóa đơn đặt phòng của khách hàng <strong>{{$booking->customer->fullname}}</strong>. <br>
                    <strong class="text-danger">Lưu ý: </strong> không thể khôi phục đơn khi đã xóa.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>
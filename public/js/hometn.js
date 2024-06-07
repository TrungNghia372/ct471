document.addEventListener("DOMContentLoaded", function() {
    var dateFromInput = document.getElementById('inputDateFrom');
    var dateToInput = document.getElementById('inputDateTo');
    var today = new Date().toISOString().split('T')[0];

    // Đặt giá trị tối thiểu cho cả hai input là ngày hôm nay
    dateFromInput.setAttribute('min', today);
    dateToInput.setAttribute('min', today);

    // Khi giá trị ngày đến thay đổi, cập nhật giá trị min cho ngày đi
    dateFromInput.addEventListener('change', function() {
        var selectedDateFrom = dateFromInput.value;
        dateToInput.setAttribute('min', selectedDateFrom);

        // Nếu ngày đi hiện tại trước ngày đến, xóa giá trị của ngày đi
        if (dateToInput.value < selectedDateFrom) {
            dateToInput.value = '';
        }
    });
});

function calculateTotal() {
    var inputDateFrom = document.getElementById('inputDateFrom').value;
    var inputDateTo = document.getElementById('inputDateTo').value;

    // Tính toán tổng số ngày đặt phòng
    var dateFrom = new Date(inputDateFrom);
    var dateTo = new Date(inputDateTo);
    var timeDiff = dateTo.getTime() - dateFrom.getTime();
    var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

    // Lấy giá phòng từ thuộc tính value của phần tử HTML
    var roomPrice = parseFloat(document.getElementById('totalPrice').getAttribute('value'));

    // Tính tổng tiền
    var totalPrice = daysDiff * roomPrice;

    // Hiển thị tổng tiền lên giao diện
    document.getElementById('totalPrice').textContent = totalPrice.toLocaleString('vi-VN') + 'đ';
}
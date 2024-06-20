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

// function updateTimeInputs() {
//     const hourlyPrice = '{{ $room->roomType->hourly_price }}';
//     const overnightPrice = '{{ $room->roomType->overnight_price }}';
//     const dailyPrice = '{{ $room->roomType->daily_price }}';

//     let selectedValue = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
//     let priceElement = document.getElementById('totalPrice');

//     const timeFrom = document.getElementById('inputTimeFrom');
//     const timeTo = document.getElementById('inputTimeTo');

//     if (selectedValue === "hourly") {
//         // priceElement.setAttribute('value', hourlyPrice);

//         timeFrom.value = '';
//         timeTo.value = '';
//         timeFrom.readOnly = false;
//         timeTo.readOnly = false;
//     } else if (selectedValue === "overnight") {
//         // priceElement.setAttribute('value', overnightPrice);

//         timeFrom.value = '21:00';
//         timeTo.value = '10:00';
//         timeFrom.readOnly = true;
//         timeTo.readOnly = true;
//     } else if (selectedValue === "daily") {
//         // priceElement.setAttribute('value', dailyPrice);

//         timeFrom.value = '10:00';
//         timeTo.value = '12:00';
//         timeFrom.readOnly = true;
//         timeTo.readOnly = true;
//     }

//     // Reset date inputs
//     document.getElementById('inputDateFrom').value = '';
//     document.getElementById('inputDateTo').value = '';
// }

// window.onload = function() {
//     updateTimeInputs();
// }

function calculateTotal() {
    var inputDateFrom = document.getElementById('inputDateFrom').value;
    var inputDateTo = document.getElementById('inputDateTo').value;

    var inputTimeFrom = document.getElementById('inputTimeFrom').value;
    var inputTimeTo = document.getElementById('inputTimeTo').value;

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

    if (inputDateFrom && inputDateTo) {
        document.getElementById('date_from').textContent = inputTimeFrom + " " + formatDate(inputDateFrom);
        document.getElementById('date_to').textContent = inputTimeTo + " " + formatDate(inputDateTo);
        document.getElementById('noticeRow').style.display = 'block';
    } else {
        document.getElementById('noticeRow').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('noticeRow').style.display = 'none';
});

function formatDate(date) {
    const d = new Date(date);
    const day = ('0' + d.getDate()).slice(-2);
    const month = ('0' + (d.getMonth() + 1)).slice(-2);
    const year = d.getFullYear();
    return `${day}/${month}/${year}`;
}
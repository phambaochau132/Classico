@extends('header')

@section('content')
<div class="form-container">
    <h2 class="form-title">Xác Nhận Thanh Toán</h2>

    <div class="section section-border">
        <h4 class="section-title">Thông tin đơn hàng</h4>
        <p><strong>Mã đơn hàng:</strong> <span class="highlight-yellow">#{{ $order->order_id }}</span></p>
        <p><strong>Tổng tiền thanh toán:</strong> <span class="highlight-green">{{ number_format($order->total_price, 0, ',', '.') }} VND</span></p>
    </div>

    <div id="qr-section" class="qr-section">
        <h3 class="section-title">Mã QR thanh toán</h3>
        <img src="https://img.vietqr.io/image/MB-0587558698-compact.png?amount={{ $order->total_price }}" alt="Mã QR thanh toán">
        <p class="small-text">Thời gian thanh toán còn lại:</p>
        <span id="countdown" class="countdown">05:00</span>
    </div>

    <div class="bank-info">
        <h4 class="section-title">Thông tin ngân hàng</h4>
        <p><strong>Tên ngân hàng:</strong> <span class="highlight-yellow">{{ $bankInfo->bank_name }}</span></p>
        <p><strong>Số tài khoản:</strong> <span class="highlight-green">{{ $bankInfo->account_number }}</span></p>
        <p><strong>Chủ tài khoản:</strong> <span class="highlight-yellow">{{ $bankInfo->account_name }}</span></p>
        <p><strong>Nội dung chuyển khoản:</strong> <span class="highlight-red">classico.{{ $order->order_id }}</span></p>
    </div>
</div>


<script>
    let timeLeft = 300;
    const countdownEl = document.getElementById('countdown');
    const qrSection = document.getElementById('qr-section');

    const timer = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timer);

            qrSection.innerHTML = `
                <p class="text-red-600 font-semibold text-lg">Thời gian thanh toán đã hết. Vui lòng đặt lại đơn hàng hoặc thử lại sau.</p>
            `;

            // fetch("{{ route('payment.cancel', $order->order_id) }}", {
            //     method: "POST",
            //     headers: {
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}',
            //         'Content-Type': 'application/json'
            //     }
            // });

        } else {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            timeLeft--;
            getOrderPay();
        }
    }, 1000);

    function getOrderPay() {
        const orderId = '{{ $order->order_id }}';
        const url = `{{ route('payment.order_transfer', 'order_id') }}`.replace('order_id', `classico${orderId}`);

        fetch(url, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.paid === true) {
                alert("Đơn hàng thanh toán thành công!");
                clearInterval(timer);
            }
        })
        .catch(error => {
            console.error("Lỗi kiểm tra thanh toán:", error);
        });
    }
</script>
@endsection

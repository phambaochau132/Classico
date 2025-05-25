@extends('header')

@section('content')
<div class="max-w-xl mx-auto p-8 bg-white rounded-lg shadow-md mt-10">
    <h2 class="text-xl font-extrabold text-gray-800 mb-8 text-center">Xác Nhận Thanh Toán</h1>

    <div class="mb-8 border-b border-gray-200 pb-6">
        <h4 class="font-semibold text-xl text-gray-700 mb-2">Thông tin đơn hàng</h2>
        <p class="mb-2"><strong>Mã đơn hàng:</strong> <span class="text-indigo-600">#{{ $order->order_id }}</span></p>
        <p class="mb-2"><strong>Tổng tiền thanh toán:</strong> <span class="font-mono text-lg text-green-600">{{ number_format($order->total_price, 0, ',', '.') }} VND</span></p>
    </div>

    <div id="qr-section" class="mb-8 p-6 bg-gray-50 rounded-lg text-center shadow-inner">
        <h3 class="font-semibold text-xl mb-4">Mã QR thanh toán</h2>
        <img src="https://img.vietqr.io/image/MB-0587558698-compact.png?amount={{$order->total_price}}" alt="Mã QR thanh toán" style="width: 300px;">
        <p class="text-sm text-gray-500 mb-2">Thời gian thanh toán còn lại:</p>
        <span id="countdown" class="font-bold text-3xl text-red-600">05:00</span>
    </div>

    <div class="p-6 bg-gray-50 rounded-lg shadow-inner text-sm">
        <h4 class="font-semibold text-lg mb-2">Thông tin ngân hàng</h2>
        <p class="mb-2"><strong>Tên ngân hàng:</strong> <span class="text-indigo-600">{{ $bankInfo->bank_name }}</span></p>
        <p class="mb-2"><strong>Số tài khoản:</strong> <span class="font-mono">{{ $bankInfo->account_number }}</span></p>
        <p class="mb-2"><strong>Chủ tài khoản:</strong> <span class="text-indigo-600">{{ $bankInfo->account_name }}</span></p>
        <p class="mt-2 font-semibold"><strong>Nội dung chuyển khoản:</strong> <span class="text-red-600">classico.{{ $order->order_id }}</span></p>
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

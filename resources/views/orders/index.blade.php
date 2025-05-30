@extends('layouts.app')
@section('content')

    <div class="container">
        <h2 class="mb-4">Danh sách đơn hàng</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('orders.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-6 search-input">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo mã đơn hàng" value="{{ request('keyword') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['customer_name'] }}</td>
                            <td>
                            @if($order['status'] === 0)
                            <span class="badge bg-warning">Chờ thanh toán</span>
                            @elseif($order['status'] === 1)
                                <span class="badge bg-warning">Chờ xác nhận</span>
                            @elseif($order['status'] === 2)
                                <span class="badge bg-info">Đang xử lý</span>
                            @elseif($order['status'] === 3)
                                <span class="badge bg-success">Hoàn tất</span>
                            @else
                                <span class="badge bg-secondary">Đã huỷ</span>
                            @endif
                            </td>
                            <td>
                            <form action="{{ route('orders.updateStatus', ['id' => $order['id']]) }}" method="POST">
                            @csrf
                            @if($order['status'] === 1)
                            <button name="status" value="2" type="submit" class="btn btn-sm btn-outline-warning">Xác nhận </button>
                            @elseif($order['status'] === 2)
                            <button name="status" value="3" type="submit" class="btn btn-sm btn-outline-warning">Hoàn tất</button>
                            @endif
                            </form>
                                <a href="{{ route('orders.show', ['id' => $order['id']]) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ $order['id'] }}')">Xóa</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Không có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $order_data->links('pagination::bootstrap-4') }}
        </div>
        </div>
    </div>

    <!-- Modal xác nhận xóa -->
    <div id="deleteModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa đơn hàng <span id="orderId"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa đơn hàng này?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                         
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function confirmDelete(orderId) {
            document.getElementById('orderId').textContent = orderId;
            const form = document.getElementById('deleteForm');
           form.action = "{{ url('/admin/orders') }}/" + orderId;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
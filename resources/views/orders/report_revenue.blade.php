@extends('layouts.app')
@section('content')
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/customers.css') }}" rel="stylesheet">
<div class="container py-4">

    <h2 class="mb-4">📊 Báo cáo doanh thu</h2>

    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary p-3 h-100">
                <h5>Tổng doanh thu</h5>
                <h3>{{ number_format($totalRevenue, 0, ',', '.') }} VND</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success p-3 h-100">
                <h5>Tổng đơn hàng</h5>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning p-3 h-100">
                <h5>Đơn hàng hoàn thành</h5>
                <h3>{{ $completedOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info p-3 h-100">
                <h5>Đơn hàng đang xử lý</h5>
                <h3>{{ $pendingOrders }}</h3>
            </div>
        </div>
    </div>

    <h4 class="mt-5">Doanh thu theo tháng</h4>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Năm</th>
                    <th>Tháng</th>
                    <th>Doanh thu (VND)</th>
                    <th>Số đơn</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($revenueByMonth as $item)
                <tr>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->month }}</td>
                    <td>{{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    <td>{{ $item->total_orders }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Chưa có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h4>Doanh thu theo trạng thái đơn hàng</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Trạng thái</th>
                    <th>Doanh thu (VND)</th>
                    <th>Số đơn</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($revenueByStatus as $item)
                <tr>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    <td>{{ $item->total_orders }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Chưa có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@extends('layouts.app')
@section('content')
<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('css/customers.css') }}" rel="stylesheet">
<div class="container py-4">
    <h2 class="mb-4 fw-bold"><i class="bi bi-bar-chart-line"></i> Thống kê đơn hàng</h2>

    {{-- Theo ngày và tháng --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-semibold">
                    📅 Thống kê theo ngày
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm m-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ngày</th>
                                    <th>Số đơn</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordersByDay as $row)
                                <tr>
                                    <td>{{ $row->day }}</td>
                                    <td>{{ $row->total_orders }}</td>
                                    <td>{{ number_format($row->total_revenue, 0, ',', '.') }} VND</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-semibold">
                    🗓️ Thống kê theo tháng
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm m-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tháng</th>
                                    <th>Số đơn</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordersByMonth as $row)
                                <tr>
                                    <td>{{ $row->month }}</td>
                                    <td>{{ $row->total_orders }}</td>
                                    <td>{{ number_format($row->total_revenue, 0, ',', '.') }} VND</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Theo trạng thái --}}
    <div class="mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark fw-semibold">
                📌 Thống kê theo trạng thái đơn hàng
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm m-0">
                        <thead class="table-light">
                            <tr>
                                <th>Trạng thái</th>
                                <th>Số đơn</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordersByStatus as $row)
                            <tr>
                                <td>
                                    @if($row->status === 0)
                                    <span >Chờ thanh toán</span>
                                    @elseif($row->status === 1)
                                    <span >Chờ xác nhận</span>
                                    @elseif($row->status === 2)
                                    <span >Đang xử lý</span>
                                    @elseif($row->status === 3)
                                    <span >Hoàn tất</span>
                                    @else
                                    <span >Đã huỷ</span>
                                    @endif
                                </td>
                                <td>{{ $row->total_orders }}</td>
                                <td>{{ number_format($row->total_revenue, 0, ',', '.') }} VND</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
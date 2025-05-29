@extends('layouts.app')

@section('content')
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
                                    <td>{{ $row->status }}</td>
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

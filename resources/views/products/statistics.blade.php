@extends('layouts.app')
@section('content')
<link href="{{ asset('css/statistics.css') }}" rel="stylesheet">
<div class="container py-4">

    <h2 class="mb-4">📊 Thống kê sản phẩm</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 p-3">
                <h5>Tổng sản phẩm</h5>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 p-3">
                <h5>Tổng lượt xem</h5>
                <h3>{{ $totalViews }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 p-3">
                <h5>Tổng tồn kho</h5>
                <h3>{{ $totalStock }}</h3>
            </div>
        </div>
        <br>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3 p-3">
                <h5>Giá trung bình</h5>
                <h5>{{ number_format($avgPrice, 2) }} VND</h5>
            </div>
        </div>
        <!-- Thêm phần tổng giá trị kho -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 p-3">
                <h5>Tổng giá trị kho</h5>
                <h4>{{ number_format($totalStockValue, 0, ',', '.') }} VND</h4>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Danh mục</th>
                    <th>Lượt xem</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>
                        @if($product->product_photo)
                        <img src="{{ asset('storage/' . $product->product_photo) }}" alt="{{ $product->product_name }}" style="width: 60px; height: auto;">
                        @else
                        <span>Chưa có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ Str::limit($product->product_description, 50) }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->product_view }}</td>
                    <td>{{ optional($product->created_at)->format('d/m/Y') ?? 'Chưa có ngày tạo' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

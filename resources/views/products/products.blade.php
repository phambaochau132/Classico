@extends('layouts.app')
@section('content')

<div class="container py-4">
    <h1 class="mb-4">Quản lý sản phẩm</h1>
    <!-- Tìm kiếm -->
        <form action="{{ route('products.allProduct') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-6 search-input">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên sản phẩm" value="{{ request('keyword') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                <a href="{{ route('products.allProduct') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-warning">
            + Tạo sản phẩm mới
        </a>
    </div>

    <div class="list-group">
        @foreach($products as $product)
            <a href="{{ route('products.edit', $product->product_id) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3 p-3 shadow-sm rounded mb-3">
                @if ($product->product_photo)
                    <img src="{{ asset('images/products/' . $product->product_photo) }}" 
                         alt="{{ $product->product_name }}" 
                         class="rounded" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/100" alt="No Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                @endif

                <div class="flex-grow-1">
                    <h5 class="mb-1">{{ $product->product_name }}</h5>
                    <p class="mb-0 text-dark fw-semibold">{{ $product->product_description }}</p>
                    <p class="mb-0 text-primary fw-semibold">${{ number_format($product->price, 2) }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection

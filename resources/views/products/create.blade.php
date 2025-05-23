@extends('layouts.app')
@section('content')

<div class="container" style="max-width: 600px; margin: 40px auto;">
    <h2 class="mb-4 text-center fw-bold" style="font-size: 32px;">CREATE A PRODUCT</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Product Form --}}
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Product Name --}}
        <div class="mb-3">
            <label for="product_name" class="form-label">Product name</label>
            <input id="product_name" name="product_name" maxlength="255" class="form-control" placeholder="Không chứa nhiều khoảng trắng" value="{{ old('product_name') }}" required>
            @error('product_name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Description --}}
        <div class="mb-3">
            <label for="product_description" class="form-label">Product description</label>
            <textarea id="product_description" name="product_description" maxlength="1000" class="form-control" placeholder="Không chứa số" rows="4" required>{{ old('product_description') }}</textarea>
            @error('product_description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Price --}}
        <div class="mb-3">
            <label for="price" class="form-label">Product price</label>
            <input id="price" name="price" type="number" max="9999999999" step="0.01" class="form-control" placeholder="Tối đa 10 chữ số" value="{{ old('price') }}" required>
            @error('price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Stock Quantity --}}
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock quantity</label>
            <input id="stock_quantity" type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', 0) }}" required>
            @error('stock_quantity')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select id="category_id" name="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" >
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Image --}}
        <div class="mb-3">
            <label for="product_photo" class="form-label">Product photo</label>
            <input id="product_photo" type="file" name="product_photo" class="form-control" required>
            @error('product_photo')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Created At --}}
        <div class="mb-4">
            <label for="created_at" class="form-label">Created at</label>
            <input id="created_at" type="date" name="created_at" class="form-control" value="{{ old('created_at', date('Y-m-d')) }}">
            @error('created_at')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Buttons: Create + Back --}}
        <div class="row">
            <div class="col-md-6 mb-2 mb-md-0">
                <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="bi bi-check-circle"></i> Create
                </button>
            </div>
            <div class="col-md-6">
                <a href="{{ route('products.allProduct') }}" class="btn btn-outline-secondary w-100 py-2">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </form>
</div>

@endsection

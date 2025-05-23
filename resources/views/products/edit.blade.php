@extends('layouts.app')
@section('content')

<div class="container" style="max-width: 600px; margin: auto;">
    <h2 style="font-size: 30px; font-weight: bold; margin-bottom: 30px;">EDIT PRODUCT</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div class="mb-3">
            <label class="form-label" for="product_name">Product name</label>
            <input type="text" id="product_name" name="product_name" maxlength="255" class="form-control" 
                   value="{{ old('product_name', $product->product_name) }}" required placeholder="Không chứa nhiều khoảng trắng">
            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Description --}}
        <div class="mb-3">
            <label class="form-label" for="product_description">Product description</label>
            <textarea id="product_description" name="product_description" maxlength="1000" class="form-control" rows="4" placeholder="Không chứa số">{{ old('product_description', $product->product_description) }}</textarea>
            @error('product_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Price --}}
        <div class="mb-3">
            <label class="form-label" for="price">Product price</label>
            <input type="number" id="price" name="price" step="0.01" max="9999999999" class="form-control" 
                   value="{{ old('price', $product->price) }}" required placeholder="Tối đa 10 chữ số">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Stock Quantity --}}
        <div class="mb-3">
            <label class="form-label" for="stock_quantity">Stock quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" 
                   value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" required>
            @error('stock_quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label" for="category_id">Danh mục</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Photo --}}
        <div class="mb-3">
            <label class="form-label" for="product_photo">Product photo</label><br>
            @if ($product->product_photo)
                <img src="{{ asset('images/products/' . $product->product_photo) }}" alt="Ảnh sản phẩm" style="max-width: 150px; margin-bottom: 10px;">
            @endif
            <input type="file" id="product_photo" name="product_photo" class="form-control">
            @error('product_photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Created At --}}
        <div class="mb-3">
            <label class="form-label" for="created_at">Created at</label>
            <input type="date" id="created_at" name="created_at" class="form-control" 
                   value="{{ old('created_at', $product->created_at ? $product->created_at->format('Y-m-d') : '') }}">
            @error('created_at')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary" style="flex: 1;">UPDATE</button>
    </form>

    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')" style="flex: 1;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" style="width: 100%;">DELETE</button>
    </form>
    <form action="{{ route('products.allProduct') }}">
        {{-- Back Button outside form --}}
                <button type="submit" class="btn btn-outline-primary  rounded" style="width: 100%;">quay lại</button>
    </form>
    </div>
</div>
@endsection

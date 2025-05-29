@extends('layouts.app')
@section('content')

<div class="container" style="max-width: 600px; margin: auto;">
    <h2 style="font-size: 30px; font-weight: bold; margin-bottom: 30px;">EDIT PRODUCT</h2>

    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Hiển thị lỗi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form update --}}
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

        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label fw-bold" for="category_id">Danh mục sản phẩm</label>
         <select id="category_id" name="category_id" class="form-select" >
        <option value="$product->category_id" disabled>
            -- Chọn danh mục --
        </option>
        @foreach($categories as $category)
            <option value="{{ $category->category_id }}"
                {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
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

        {{-- Buttons row --}}
        <div class="d-flex justify-content-between gap-2 mt-4">
            {{-- Update button --}}
            <button type="submit" class="btn btn-primary w-100">UPDATE</button>

            {{-- Delete button (trigger modal) --}}
            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->product_id }}">
                XÓA
            </button>

            {{-- Back button --}}
            <a href="{{ route('products.allProduct') }}" class="btn btn-outline-primary w-100">QUAY LẠI</a>
        </div>
    </form>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal{{ $product->product_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->product_id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa sản phẩm {{ $product->product_id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sản phẩm <strong>{{ $product->product_name }}</strong> không?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">XÓA</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">HỦY</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

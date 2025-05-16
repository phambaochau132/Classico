@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: 0 auto;">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Edit Product</h1>

    <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="product_name">Product name</label>
            <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" 
                   style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="product_description">Product description</label>
            <textarea id="product_description" name="product_description" rows="4"
                      style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">{{ old('product_description', $product->product_description) }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="price">Product price</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                   style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
    <label class="form-label">Danh mục</label>
    <select name="category_id" class="form-control" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', isset($product) ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
</div>


        <div style="margin-bottom: 15px;">
            <label for="product_photo">Product photo</label><br>
           @if ($product->product_photo)
                <img src="{{ asset('images/products/' . $product->product_photo) }}" alt="Ảnh sản phẩm" style="max-width: 150px;">
            @endif
            <input type="file" id="product_photo" name="product_photo"
                   style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="create_at">Created at</label>
            <input type="date" id="create_at" name="created_at" value="{{ old('create_at', $product->create_at ? $product->create_at->format('Y-m-d') : '') }}"
                   style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; border: none;">
                UPDATE
            </button>
    </form>

    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background-color: #dc3545; color: white; padding: 10px 20px; border-radius: 5px; border: none;">
            DELETE
        </button>
    </form>
</div>
@endsection

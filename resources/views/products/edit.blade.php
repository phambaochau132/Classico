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
            <label for="description">Product description</label>
            <textarea id="description" name="description" rows="4"
                      style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="price">Product price</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                   style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-control">
    @foreach($categories as $category)
        <option value="{{ $category->id }}" 
            {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>

        </div>

        <div style="margin-bottom: 15px;">
            <label for="photo">Product photo</label><br>
            @if ($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" 
                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
            @endif
            <input type="file" id="photo" name="photo"
                   style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="created_at">Created at</label>
            <input type="date" id="created_at" name="created_at" value="{{ old('created_at', $product->created_at ? $product->created_at->format('Y-m-d') : '') }}"
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

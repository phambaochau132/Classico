@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: auto;">
    <h2 style="font-size: 30px; font-weight: bold; margin-bottom: 30px;">CREATE A PRODUCT</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Product Name --}}
        <div class="mb-3">
            <label class="form-label">Product name</label>
            <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
        </div>

        {{-- Product Description --}}
        <div class="mb-3">
            <label class="form-label">Product description</label>
            <textarea name="product_description" class="form-control" placeholder="Product Description" rows="3"></textarea>
        </div>

        {{-- Product Price --}}
        <div class="mb-3">
            <label class="form-label">Product price</label>
            <input type="number" step="0.01" name="price" class="form-control" placeholder="Product Price" required>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-control">
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Product Image --}}
        <div class="mb-3">
            <label class="form-label">Product photo</label>
            <input type="file" name="product_photo" class="form-control">
        </div>

        {{-- Created At --}}
        <div class="mb-3">
            <label class="form-label">Create at</label>
            <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d') }}">
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Create</button>
    </form>
</div>
@endsection

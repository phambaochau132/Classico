@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Manage</h1>
    <div style="display: flex;">
        <div style="width: 200px;">
            <p style="color: orange;">Quản lý sản phẩm</p>
            <p>Quản lý Account</p>
        </div>
        <div style="flex-grow: 1;">
            <a href="{{ route('products.create') }}" style="background: peachpuff; padding: 8px 16px; border-radius: 5px;">+ Create</a>
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
                @foreach($products as $product)
                <div style="width: 150px; text-align: center;">
                    <a href="{{ route('products.edit', $product->product_id) }}">
                        @if ($product->product_photo)
                            <img src="{{ asset('images/products/' . $product->product_photo) }}" alt="{{ $product->product_name }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                        @else
                            <img src="https://via.placeholder.com/150" alt="No Image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                        @endif
                        <p>{{ $product->product_name }}</p>
                        <p>${{ number_format($product->price, 2) }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

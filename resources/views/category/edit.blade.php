@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cập Nhật Danh Mục</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->category_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_name" class="form-label">Tên Danh Mục</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}" required>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection

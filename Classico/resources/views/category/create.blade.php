@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm Danh Mục</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="category_id" class="form-label">Mã Danh Mục</label>
            <input type="text" name="category_id" id="category_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category_name" class="form-label">Tên Danh Mục</label>
            <input type="text" name="category_name" id="category_name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection

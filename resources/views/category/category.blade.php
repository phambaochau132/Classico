@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Thêm Danh Mục</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Danh Mục</th>
                <th>Tên Danh Mục</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->category_id }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-sm btn-warning">Sửa</a>

                    <!-- Nút mở modal -->
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->category_id }}">
                        Xóa
                    </button>

                    <!-- Modal xác nhận xóa -->
                    <div class="modal fade" id="deleteModal{{ $category->category_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $category->category_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $category->category_id }}">Xác nhận xóa danh mục {{ $category->category_id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa danh mục <strong>{{ $category->category_name }}</strong> không?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach  
        </tbody> 
    </table>
     {{ $categories->links('pagination::bootstrap-4') }}
</div>
@endsection

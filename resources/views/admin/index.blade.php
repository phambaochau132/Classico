@extends('layouts.app')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="{{ asset('css/adminindex.css') }}" rel="stylesheet">
    <main class="container">
        <h1>📋 Danh sách tài khoản Admin</h1>

        <div class="top-actions">
            <a href="{{ route('admin.create') }}" class="btn btn-add">➕ Thêm tài khoản</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $admin)
                    <tr>
                        <td>{{ $admin->user_id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.edit', $admin->user_id) }}" class="btn btn-edit">✏️</a>
                                <form id="deleteForm-{{ $admin->user_id }}" action="{{ route('admin.destroy', $admin->user_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá tài khoản này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-delete" onclick="confirmDelete({{ $admin->user_id }})">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main >
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Xác nhận xoá',
            text: "Bạn có chắc muốn xoá khách hàng này?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Vâng, xoá',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm-' + userId).submit();
            }
        });
    }
</script>
@endsection

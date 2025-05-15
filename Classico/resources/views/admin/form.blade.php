<div class="container mt-5">
    <h2>{{ isset($admin) ? 'Chỉnh sửa' : 'Thêm mới' }} tài khoản admin</h2>

    <form action="{{ isset($admin) ? route('admin.update', $admin->user_id) : route('admin.store') }}" method="POST">
        @csrf
        @if(isset($admin))
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ $admin->username ?? '' }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $admin->email ?? '' }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Lưu</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </form>
</div>

<div class="container mt-5">
    <h2>{{ isset($admin) ? 'Chỉnh sửa' : 'Thêm mới' }} tài khoản admin</h2>

    <form id="formInfo" action="{{ isset($admin) ? route('admin.update', $admin->user_id) : route('admin.store') }}" method="POST">
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

        <button type="button" class="btn btn-primary mt-3" onclick="{{ isset($admin) ? 'confirmUpdate()' : 'confirmCreate()' }}">Lưu</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate() {
        Swal.fire({
            title: 'Xác nhận cập nhật',
            text: "Bạn có chắc muốn cập nhật thông tin quản trị viên?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Cập nhật',
            cancelButtonText: 'Hủy',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formInfo').submit();
            }
        });
    }
    function confirmCreate() {
        document.getElementById('formInfo').submit();
    }
</script>
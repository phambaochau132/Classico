@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('forgot-password.reset') }}" method="POST">
    @csrf
    <input type="password" name="password" placeholder="Mật khẩu mới" required>
    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
    <button type="submit">Đặt lại mật khẩu</button>
</form>

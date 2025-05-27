@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('forgot-password.send-otp') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Nhập email của bạn" required>
    <button type="submit">Gửi mã OTP</button>
</form>

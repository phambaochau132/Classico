@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('forgot-password.verify-otp') }}" method="POST">
    @csrf
    <input type="text" name="otp" placeholder="Nhập mã OTP" required maxlength="6" minlength="6">
    <button type="submit">Xác thực OTP</button>
</form>

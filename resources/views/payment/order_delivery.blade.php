@extends('header')

@section('content')
<div class="container-delivery">
    <h1 class="title-main">Thông tin giao hàng</h1>

    <form action="{{ route('payment.delivery') }}" method="POST" class="delivery-form" autocomplete="off">
        @csrf
        <div class="form-group">
            <input id="name" name="name" type="text" required placeholder=" " value="{{ old('name') }}" />
            <label for="name">Họ tên</label>
        </div>

        <div class="form-group">
            <input id="phone" name="phone" type="tel" required placeholder=" " value="{{ old('phone') }}" />
            <label for="phone">Số điện thoại</label>
        </div>

        <div class="form-group">
            <textarea id="address" name="address" rows="3" required placeholder=" ">{{ old('address') }}</textarea>
            <label for="address">Địa chỉ</label>
        </div>

        <button type="submit" class="submit-btn">Tiếp tục</button>
    </form>
</div>
@endsection

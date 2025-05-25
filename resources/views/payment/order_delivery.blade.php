@extends('header')
@section('content')
<div class="container max-w-md mx-auto p-6 bg-white rounded-md shadow-md mt-10">
    <h1 class="text-center font-bold text-3xl mb-8">Thông tin giao hàng</h1>
    <form action="{{ route('payment.delivery') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block mb-2 font-semibold text-gray-700" for="name">Họ tên:</label>
            <input id="name" name="name" type="text" required
                value="{{ old('name') }}"
                placeholder="Nhập họ tên của bạn"
                class="w-full border border-gray-300 rounded-md px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
        </div>
        <div>
            <label class="block mb-2 font-semibold text-gray-700" for="phone">SĐT:</label>
            <input id="phone" name="phone" type="tel" required
                value="{{ old('phone') }}"
                placeholder="Nhập số điện thoại"
                class="w-full border border-gray-300 rounded-md px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
        </div>
        <div>
            <label class="block mb-2 font-semibold text-gray-700" for="address">Địa chỉ:</label>
            <textarea id="address" name="address" rows="3" required
                placeholder="Nhập địa chỉ nhận hàng"
                class="w-full border border-gray-300 rounded-md px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-none">{{ old('address') }}</textarea>
        </div>
        <button type="submit" 
            class="w-full bg-indigo-600 text-white font-semibold py-3.5 rounded-md hover:bg-indigo-700 transition-transform hover:scale-105">
            Tiếp tục
        </button>
    </form>
</div>
@endsection

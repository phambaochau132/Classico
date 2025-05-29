@extends('layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <h2 class="text-center font-weight-bold mb-4">Quản Lý Kho Hàng</h2>

    <form method="GET" action="{{ route('warehouse') }}" class="mb-4">
        <label for="search" class="form-label font-weight-bold">Tìm kiếm sản phẩm:</label>
        <input
            type="text"
            class="form-control"
            id="search"
            name="search" {{-- đặt name để gửi lên server --}}
            placeholder="Nhập tên hoặc mã sản phẩm"
            value="{{ request('search') }}" {{-- giữ lại từ khóa tìm kiếm --}}>
    </form>

    {{-- Form cập nhật tồn kho --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white font-weight-bold">
            Cập Nhật Tồn Kho
        </div>
        <div class="card-body">
            <form id="update-stock-form" action="{{ route('warehouse.update') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-5">
                    <label for="product_id" class="form-label">Chọn sản phẩm:</label>
                    <select name="product_id" id="product_id" class="form-select">
                        @foreach ($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Số lượng:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required min="0" placeholder="Nhập số lượng">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Cập Nhật Tồn Kho</button>
                </div>
            </form>
            <script src="{{ asset('js/warehouse.js') }}" defer></script>

        </div>
    </div>

    {{-- Danh sách sản phẩm --}}
    <h4 class="mb-3 font-weight-bold">Danh Sách Sản Phẩm</h4>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>Tên Sản Phẩm</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Số Lượng Tồn Kho</th>
                    <th>Cảnh Báo</th>
                    <th>Cập Nhật</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td class="text-center">{{ $product->product_id }}</td>
                    <td class="text-center">{{ $product->stock_quantity }}</td>
                    <td class="text-center">
                        @if ($product->stock_quantity <= 5)
                            <span class="badge bg-danger">Sắp hết hàng!</span>
                            @else
                            <span class="badge bg-success">Đủ hàng</span>
                            @endif
                    </td>
                    <td class="text-center">
                        <button
                            class="btn btn-sm btn-secondary btn-edit-stock"
                            data-bs-toggle="modal"
                            data-bs-target="#editStockModal"
                            data-product-id="{{ $product->product_id }}"
                            data-product-name="{{ $product->product_name }}"
                            data-stock="{{ $product->stock_quantity }}">
                            Cập Nhật
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('warehouse.edit') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editStockModalLabel">Cập Nhật Tồn Kho</h5>
                                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="product_id" id="modal_product_id">
                                    <div class="mb-3">
                                        <label class="form-label">Tên sản phẩm</label>
                                        <input type="text" id="modal_product_name" class="form-control" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="modal_quantity" class="form-label">Số lượng tồn kho</label>
                                        <input type="number" name="quantity" id="modal_quantity" class="form-control" required min="0">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
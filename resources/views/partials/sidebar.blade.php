
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">📁 Menu</h5>
    </div>
    <div class="list-group list-group-flush">

        <a href="{{ route('customers.index') }}" 
           class="list-group-item list-group-item-action {{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Quản lý khách hàng
        </a>

        <a href="{{ route('admin.index') }}" 
           class="list-group-item list-group-item-action {{ request()->routeIs('admin.*') ? 'active' : '' }}">
            <i class="bi bi-person-gear me-2"></i> Quản lý tài khoản admin
        </a>

        {{-- Menu Thống kê dạng dropdown --}}
        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
        {{ request()->routeIs('products.statistics') ? 'active' : '' }}" 
        data-bs-toggle="collapse" href="#collapseThongKe" role="button" aria-expanded="{{ request()->routeIs('products.statistics') ? 'true' : 'false' }}" aria-controls="collapseThongKe">
        <span><i class="bi bi-bar-chart-line me-2"></i> Thống kê</span>
        <i class="bi bi-caret-down-fill"></i>
    </a>

    <div class="collapse {{ request()->routeIs('products.statistics') ? 'show' : '' }}" id="collapseThongKe">
        <a href="{{ route('products.statistics') }}" 
        class="list-group-item list-group-item-action ps-5 {{ request()->routeIs('products.statistics') ? 'active' : '' }}">
            Thống kê sản phẩm
        </a>
            <a href="{{ route('orders.reportRevenue') }}" 
            class="list-group-item list-group-item-action ps-5 {{ request()->routeIs('orders.reportRevenue') ? 'active' : '' }}">
                Thống kê doanh thu
            </a>

           <a href="{{ route('orders.report') }}" 
            class="list-group-item list-group-item-action ps-5 {{ request()->routeIs('orders.report') ? 'active' : '' }}">
                Thống kê đơn hàng
            </a>
        </div>

    </div>
</div>

<style>
body, html {
  margin: 0; padding: 0; height: 100%;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.navbar {
  background-color: #1f2937;
  height: 56px;
  line-height: 56px;
  color: white;
  padding: 0 20px;
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1030;
}

.custom-sidebar {
  width: 280px;
  background-color: #1f2937;
  color: #ffffff;
  overflow-y: auto;
  padding-top: 20px;
  border-radius: 0; /* bỏ border radius */
  box-shadow: 2px 0 5px rgba(0,0,0,0.1);
  flex-shrink: 0;
}

.custom-sidebar ul {
  list-style: none;
  padding: 0 10px;
  margin: 0;
}

.custom-sidebar .nav-small-cap {
  padding: 12px 10px;
  font-size: 13px;
  color: #9ca3af;
  text-transform: uppercase;
  user-select: none;
}

.custom-sidebar .sidebar-link {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  color: #d1d5db;
  text-decoration: none;
  border-radius: 6px;
  transition: background-color 0.3s, color 0.3s;
  font-weight: 500;
}

.custom-sidebar .sidebar-link.active {
  background-color: #3b82f6;
  color: #ffffff;
  font-weight: 700;
}

.custom-sidebar .sidebar-link:hover {
  background-color: #374151;
  color: #ffffff;
}

.content-area {
  flex-grow: 1;
  padding: 30px;
  background-color: #f5f7fa;
  overflow-y: auto;
  min-height: 100vh;
}

</style>
<aside class="left-sidebar custom-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="in">

                {{-- Tiêu đề Menu --}}
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">📁 Menu</span>
                </li>

                {{-- Quản lý khách hàng --}}
                <li class="sidebar-item">
                    <a href="{{ route('customers.index') }}"
                       class="sidebar-link waves-effect waves-dark {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>
                        <span class="hide-menu">Quản lý khách hàng</span>
                    </a>
                </li>

                {{-- Quản lý tài khoản admin --}}
                <li class="sidebar-item">
                    <a href="{{ route('admin.index') }}"
                       class="sidebar-link waves-effect waves-dark {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                        <i class="bi bi-person-gear me-2"></i>
                        <span class="hide-menu">Quản lý admin</span>
                    </a>
                </li>

            {{-- Quản lý khách hàng --}}
                <li class="sidebar-item">
                    <a href="{{ route('products.allProduct') }}"
                       class="sidebar-link waves-effect waves-dark {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>
                        <span class="hide-menu">Quản lý sản phẩm</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('orders.index') }}"
                       class="sidebar-link waves-effect waves-dark {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>
                        <span class="hide-menu">Đơn hàng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('categories.index') }}"
                       class="sidebar-link waves-effect waves-dark {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>
                        <span class="hide-menu">Quản lý danh mục</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('warehouse') }}"
                       class="sidebar-link waves-effect waves-dark {{ request()->routeIs('warehouse.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>
                        <span class="hide-menu">Quản lý kho hàng</span>
                    </a>
                </li>
                {{-- Menu Thống kê --}}
                @php
          $isStatisticsActive = request()->routeIs('products.statistics') || request()->routeIs('orders.report*');
        @endphp
        <li class="sidebar-item">
          <a class="sidebar-link" 
             data-bs-toggle="collapse" 
             href="#submenuStats" 
             role="button" 
             aria-expanded="{{ $isStatisticsActive ? 'true' : 'false' }}" 
             aria-controls="submenuStats">
            <i class="bi bi-bar-chart-line"></i> Thống kê
            <span class="ms-auto">&#9662;</span>
          </a>
          <ul class="collapse {{ $isStatisticsActive ? 'show' : '' }}" id="submenuStats">
            <li>
              <a href="{{ route('products.statistics') }}" 
                 class="sidebar-link {{ request()->routeIs('products.statistics') ? 'active' : '' }}">
                Thống kê sản phẩm
              </a>
            </li>
            <li>
              <a href="{{ route('orders.reportRevenue') }}" 
                 class="sidebar-link {{ request()->routeIs('orders.reportRevenue') ? 'active' : '' }}">
                Thống kê doanh thu
              </a>
            </li>
            <li>
              <a href="{{ route('orders.report') }}" 
                 class="sidebar-link {{ request()->routeIs('orders.report') ? 'active' : '' }}">
                Thống kê đơn hàng
              </a>
            </li>
            </ul>
        </nav>
    </div>
</aside>

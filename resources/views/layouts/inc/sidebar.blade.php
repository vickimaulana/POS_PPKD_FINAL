<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar bg-white shadow-sm border-end">

    <ul class="sidebar-nav pt-3" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center {{ request()->is('/') ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-speedometer2 me-2"></i>
                <span class="fw-semibold">Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Pimpinan (Role 2) -->
        @if (auth()->user()->role_id == 2)
            <li class="nav-heading text-muted text-uppercase small mt-3">📊 Stock & Reports</li>
            <li class="nav-item">
                <a class="nav-link collapsed d-flex align-items-center" data-bs-target="#stock-reports-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-archive me-2"></i><span>Stock & Reports</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="stock-reports-nav" class="nav-content collapse ps-4" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/stock" class="d-flex align-items-center">
                            <i class="bi bi-box-seam me-2"></i><span>Stock Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="/report" class="d-flex align-items-center">
                            <i class="bi bi-receipt me-2"></i><span>Report Orders</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <!-- Kasir (Role 3) -->
        @if (auth()->user()->role_id == 3)
            <li class="nav-heading text-muted text-uppercase small mt-3">💰 Stock & Casheer</li>
            <li class="nav-item">
                <a class="nav-link collapsed d-flex align-items-center" href="/kasir">
                    <i class="bi bi-cash-coin me-2"></i><span>Casheer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed d-flex align-items-center" href="/stock">
                    <i class="bi bi-box-seam me-2"></i><span>Stock Product</span>
                </a>
            </li>
        @endif

        <!-- Administrator (Role 1) -->
        @if (auth()->user()->role_id == 1)
            <li class="nav-heading text-muted text-uppercase small mt-3">⚙ Master Data</li>
            <li class="nav-item">
                <a class="nav-link collapsed d-flex align-items-center" data-bs-target="#master-data-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-database me-2"></i><span>Master Data</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="master-data-nav" class="nav-content collapse ps-4" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/product" class="d-flex align-items-center">
                            <i class="bi bi-box-seam me-2"></i><span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="/users" class="d-flex align-items-center">
                            <i class="bi bi-people me-2"></i><span>User</span>
                        </a>
                    </li>
                    <li>
                        <a href="/category" class="d-flex align-items-center">
                            <i class="bi bi-tags me-2"></i><span>Category</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-heading text-muted text-uppercase small mt-3">🛒 Order</li>
            <li class="nav-item">
                <a class="nav-link collapsed d-flex align-items-center" href="/report">
                    <i class="bi bi-cart-check me-2"></i><span>Order List</span>
                </a>
            </li>
        @endif

    </ul>

</aside><!-- End Sidebar -->

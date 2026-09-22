<!-- Mobile Drawer Overlay Backdrop -->
<div class="sidebar-backdrop" id="sidebar-backdrop"></div>

<!-- Admin Sidebar Navigation -->
<aside class="admin-sidebar" id="admin-sidebar">
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom border-secondary border-opacity-10 d-lg-none">
        <span class="text-white fw-bold small"><i class="bi bi-cpu text-primary me-2"></i>Navigation Menu</span>
        <button type="button" class="btn btn-sm btn-outline-light" id="sidebar-close-btn" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-cpu"></i></div>
        <div class="sidebar-brand-title">
            HARI OM COMPUTER
            <span>Admin ERP Portal</span>
        </div>
    </a>

    <div class="sidebar-nav-section">Core Modules</div>
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ ($currentPage ?? '') === 'dashboard' ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.quotations') }}" class="sidebar-link {{ ($currentPage ?? '') === 'quotations' ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> <span>Quotations</span>
                <span class="badge-counter" id="badge-pending-quotes" style="display: none;">0</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.quotations.create') }}" class="sidebar-link {{ ($currentPage ?? '') === 'quotation-create' ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> <span>Create Quotation</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.pc.builder') }}" class="sidebar-link {{ ($currentPage ?? '') === 'pc-builder' ? 'active' : '' }}">
                <i class="bi bi-motherboard"></i> <span>Custom PC Builder</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.sales') }}" class="sidebar-link {{ ($currentPage ?? '') === 'sales' ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> <span>Sales & Invoices</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-nav-section">Catalog & Inventory</div>
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('admin.products') }}" class="sidebar-link {{ ($currentPage ?? '') === 'products' ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> <span>Products</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.laptops') }}" class="sidebar-link {{ ($currentPage ?? '') === 'laptops' ? 'active' : '' }}">
                <i class="bi bi-laptop"></i> <span>Laptops</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.computers') }}" class="sidebar-link {{ ($currentPage ?? '') === 'computers' ? 'active' : '' }}">
                <i class="bi bi-pc-display"></i> <span>Desktop PCs</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.categories') }}" class="sidebar-link {{ ($currentPage ?? '') === 'categories' ? 'active' : '' }}">
                <i class="bi bi-tags"></i> <span>Categories</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.brands') }}" class="sidebar-link {{ ($currentPage ?? '') === 'brands' ? 'active' : '' }}">
                <i class="bi bi-award"></i> <span>Brands</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.inventory') }}" class="sidebar-link {{ ($currentPage ?? '') === 'inventory' ? 'active' : '' }}">
                <i class="bi bi-boxes"></i> <span>Inventory Stock</span>
                @php
                    $sidebarLowStock = \App\Models\Product::lowStock()->count();
                @endphp
                @if($sidebarLowStock > 0)
                    <span class="badge-counter bg-warning text-dark">{{ $sidebarLowStock }}</span>
                @endif
            </a>
        </li>
    </ul>

    <div class="sidebar-nav-section">Business Operations</div>
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('admin.customers') }}" class="sidebar-link {{ ($currentPage ?? '') === 'customers' ? 'active' : '' }}">
                <i class="bi bi-people"></i> <span>Customers</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.purchases') }}" class="sidebar-link {{ ($currentPage ?? '') === 'purchases' ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i> <span>Purchases</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.suppliers') }}" class="sidebar-link {{ ($currentPage ?? '') === 'suppliers' ? 'active' : '' }}">
                <i class="bi bi-truck"></i> <span>Suppliers</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.payments') }}" class="sidebar-link {{ ($currentPage ?? '') === 'payments' ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i> <span>Payments</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.reports') }}" class="sidebar-link {{ ($currentPage ?? '') === 'reports' ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i> <span>Reports & GST</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.website.mgmt') }}" class="sidebar-link {{ ($currentPage ?? '') === 'website-mgmt' ? 'active' : '' }}">
                <i class="bi bi-globe"></i> <span>Website CMS</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.settings') }}" class="sidebar-link {{ ($currentPage ?? '') === 'settings' ? 'active' : '' }}">
                <i class="bi bi-gear"></i> <span>Settings</span>
            </a>
        </li>
    </ul>
</aside>

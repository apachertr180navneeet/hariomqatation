<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Admin ERP | Hari Om Computer' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Admin ERP CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    @stack('styles')

    <script>
        window.HOC_ADMIN_ROUTES = {
            dashboard: "{{ route('admin.dashboard') }}",
            quotations: "{{ route('admin.quotations') }}",
            quotationCreate: "{{ route('admin.quotations.create') }}",
            quotationView: (id) => "{{ route('admin.quotations.view') }}?id=" + encodeURIComponent(id),
            quotationPrint: (id) => "{{ route('admin.quotations.print') }}?id=" + encodeURIComponent(id),
            pcBuilder: "{{ route('admin.pc.builder') }}",
            sales: "{{ route('admin.sales') }}",
            invoiceView: (id) => "{{ route('admin.invoices.view') }}?id=" + encodeURIComponent(id),
            products: "{{ route('admin.products') }}",
            productAdd: "{{ route('admin.products.add') }}",
            productView: (id) => "{{ route('admin.products.view') }}?id=" + encodeURIComponent(id),
            laptops: "{{ route('admin.laptops') }}",
            computers: "{{ route('admin.computers') }}",
            categories: "{{ route('admin.categories') }}",
            brands: "{{ route('admin.brands') }}",
            inventory: "{{ route('admin.inventory') }}",
            customers: "{{ route('admin.customers') }}",
            purchases: "{{ route('admin.purchases') }}",
            suppliers: "{{ route('admin.suppliers') }}",
            payments: "{{ route('admin.payments') }}",
            reports: "{{ route('admin.reports') }}",
            websiteMgmt: "{{ route('admin.website.mgmt') }}",
            settings: "{{ route('admin.settings') }}",
            login: "{{ route('admin.login') }}",
            shop: "{{ route('home') }}"
        };

        window.HOC_ROUTES = {
            home: "{{ route('home') }}",
            computers: "{{ route('computers') }}",
            laptops: "{{ route('laptops') }}",
            components: "{{ route('components') }}",
            products: "{{ route('products') }}",
            productDetails: "{{ route('product.details') }}",
            pcBuilder: "{{ route('pc.builder') }}",
            enquiry: "{{ route('enquiry') }}",
            quotationSuccess: "{{ route('quotation.success') }}",
            about: "{{ route('about') }}",
            contact: "{{ route('contact') }}"
        };
    </script>
</head>
<body class="admin-body">

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
                    <span class="badge-counter bg-warning text-dark" id="badge-low-stock" style="display: none;">0</span>
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

    <!-- Admin Main Wrapper -->
    <div class="admin-wrapper">
        
        <!-- Top Header Navigation -->
        <header class="admin-navbar">
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-light d-lg-none" id="sidebar-toggle-btn" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="admin-search-wrapper d-none d-sm-block">
                    <i class="bi bi-search"></i>
                    <input type="text" class="admin-search-input" id="admin-global-search" placeholder="Search quotations, products, clients...">
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary fw-semibold">
                    <i class="bi bi-shop me-1"></i> <span class="d-none d-md-inline">View</span> Storefront
                </a>

                <div class="dropdown">
                    <a href="#" class="admin-user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="admin-user-avatar">HO</div>
                        <div class="d-none d-md-block text-start">
                            <div class="fw-bold small text-slate-800">Hari Om Admin</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Super Administrator</div>
                        </div>
                        <i class="bi bi-chevron-down text-muted small ms-1"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="bi bi-person me-2"></i>Profile & Store Details</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="bi bi-gear me-2"></i>GST & Bank Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('admin.login') }}"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    <!-- Standard Admin Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/store-data.js') }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    
    @stack('scripts')
</body>
</html>

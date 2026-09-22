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
                <div class="admin-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'HO', 0, 2)) }}
                </div>
                <div class="d-none d-md-block text-start">
                    <div class="fw-bold small text-slate-800">{{ Auth::user()->name ?? 'Hari Om Admin' }}</div>
                    <div class="text-muted" style="font-size: 0.72rem;">{{ Auth::user()->email ?? 'admin@hariomcomputer.com' }}</div>
                </div>
                <i class="bi bi-chevron-down text-muted small ms-1"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="bi bi-person me-2"></i>Profile & Store Details</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="bi bi-gear me-2"></i>GST & Bank Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Main Navbar Menu -->
<nav class="navbar navbar-expand-xl navbar-hoc sticky-top">
    <div class="container-fluid px-lg-4">
        <a class="navbar-brand-logo d-flex align-items-center gap-3 text-decoration-none" href="{{ route('home') }}">
            <div class="brand-icon-box">
                <i class="bi bi-cpu"></i>
            </div>
            <div>
                <div class="brand-text-main">HARI OM COMPUTER</div>
                <div class="brand-tagline">Your Trusted Technology Partner</div>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2 d-xl-none">
            <a href="{{ route('enquiry') }}" class="btn btn-sm btn-outline-primary position-relative d-flex align-items-center gap-1 fw-semibold text-nowrap px-2 py-1" title="Enquiry Cart">
                <i class="bi bi-cart4 fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none;">
                    0
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storeNavbar" aria-controls="storeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="storeNavbar">
            <div class="d-xl-none mb-2 mt-3">
                <form class="position-relative w-100" action="{{ route('products') }}" method="GET">
                    <i class="bi bi-search text-muted position-absolute" style="left: 14px; top: 11px;"></i>
                    <input type="text" name="search" class="form-control rounded-pill ps-5" placeholder="Search RTX 4060, i7, Dell..." value="{{ request('search') }}">
                </form>
            </div>

            <ul class="navbar-nav mx-auto mb-2 mb-xl-0">
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('computers') ? 'active' : '' }}" href="{{ route('computers') }}">Desktop PCs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('laptops') ? 'active' : '' }}" href="{{ route('laptops') }}">Laptops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('components') ? 'active' : '' }}" href="{{ route('components') }}">Components</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">All Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom btn-pc-builder-nav ms-xl-2 {{ request()->routeIs('pc.builder') ? 'active' : '' }}" href="{{ route('pc.builder') }}">
                        <i class="bi bi-motherboard me-1"></i> Custom PC Builder
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>

            <div class="d-none d-xl-flex align-items-center gap-3">
                <form class="header-search" id="header-search-form" action="{{ route('products') }}" method="GET">
                    <i class="bi bi-search search-icon text-muted" style="position: absolute; left: 16px; top: 12px;"></i>
                    <input type="text" name="search" class="form-control" id="header-search-input" placeholder="Search RTX 4060, i7, Dell..." value="{{ request('search') }}">
                </form>

                <a href="{{ route('enquiry') }}" class="btn btn-outline-primary position-relative d-flex align-items-center gap-2 fw-semibold text-nowrap">
                    <i class="bi bi-cart4 fs-5"></i>
                    <span class="d-none d-sm-inline">Enquiry Cart</span>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none;">
                        0
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>

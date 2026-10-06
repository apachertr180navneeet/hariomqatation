<!-- Top Announcement Micro-Bar (Unimart Style) -->
<div class="unimart-top-bar d-none d-md-block">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2 py-1">
        <div class="d-flex align-items-center gap-3 top-bar-left small">
            <span><i class="bi bi-geo-alt-fill text-primary me-1"></i> Station Road, Near Sojati Gate, Jodhpur</span>
            <span class="text-muted opacity-50">|</span>
            <span><i class="bi bi-clock-fill text-primary me-1"></i> 10:00 AM - 8:30 PM (Mon - Sat)</span>
        </div>
        <div class="d-flex align-items-center gap-3 top-bar-right small">
            <a href="tel:+919829012345" class="top-bar-link">
                <i class="bi bi-telephone-fill text-primary me-1"></i> +91 98290 12345
            </a>
            <span class="text-muted opacity-50">|</span>
            <span class="badge bg-primary-subtle text-primary fw-bold px-2 py-1">
                <i class="bi bi-patch-check-fill me-1"></i> Authorized Store
            </span>
            <span class="text-muted opacity-50">|</span>
            <a href="{{ route('enquiry') }}" class="top-bar-link">
                <i class="bi bi-file-earmark-text text-primary me-1"></i> Track Quotation
            </a>
            <span class="text-muted opacity-50">|</span>
            <a href="{{ route('admin.login') }}" class="top-bar-link">
                <i class="bi bi-shield-lock-fill text-warning me-1"></i> Staff ERP
            </a>
        </div>
    </div>
</div>

<!-- Middle Header (Unimart Search Bar & Mobile Nav Header) -->
<header class="unimart-middle-header py-2 py-md-3 bg-white">
    <div class="container">
        <!-- Desktop Header Row (Screens >= 992px) -->
        <div class="row align-items-center gy-3 d-none d-lg-flex">
            <!-- Brand Logo -->
            <div class="col-auto">
                <a class="navbar-brand-logo d-flex align-items-center gap-3 text-decoration-none" href="{{ route('home') }}">
                    <div class="brand-icon-box">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <div>
                        <div class="brand-text-main">HARI OM COMPUTER</div>
                        <div class="brand-tagline">Electronics & Hardware Megastore</div>
                    </div>
                </a>
            </div>

            <!-- Centered Electronics Search Bar with Category Dropdown -->
            <div class="col">
                <form class="unimart-search-bar" id="header-search-form" action="{{ route('products') }}" method="GET">
                    <div class="search-category-dropdown">
                        <select name="cat" id="header-search-category" class="search-cat-select">
                            <option value="ALL">All Categories</option>
                            <option value="Desktop Computers" {{ request('cat') == 'Desktop Computers' ? 'selected' : '' }}>Desktop PCs</option>
                            <option value="Laptops" {{ request('cat') == 'Laptops' ? 'selected' : '' }}>Laptops</option>
                            <option value="Components" {{ request('cat') == 'Components' ? 'selected' : '' }}>Components</option>
                            <option value="Display & Monitors" {{ request('cat') == 'Display' || request('cat') == 'Display & Monitors' ? 'selected' : '' }}>Monitors</option>
                            <option value="Accessories" {{ request('cat') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="Networking" {{ request('cat') == 'Networking' ? 'selected' : '' }}>Networking</option>
                        </select>
                    </div>
                    <div class="search-input-field flex-grow-1 position-relative">
                        <input type="text" name="search" id="header-search-input" class="search-kw-input" placeholder="Search laptops, gaming PCs, GPUs, processors..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="search-action-btn">
                        <i class="bi bi-search me-1"></i>
                        <span>Search</span>
                    </button>
                </form>
            </div>

            <!-- Right Header Actions (Hotline, PC Builder, Cart) -->
            <div class="col-auto d-flex align-items-center gap-3 ms-auto">
                <!-- Hotline Call Pill -->
                <a href="tel:+919829012345" class="header-action-pill text-decoration-none">
                    <div class="action-icon-circle bg-light text-primary">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div class="action-text-box">
                        <span class="action-micro-label">Customer Support</span>
                        <strong class="action-main-val">+91 98290 12345</strong>
                    </div>
                </a>

                <!-- PC Configurator Button -->
                <a href="{{ route('pc.builder') }}" class="btn btn-outline-primary d-flex align-items-center gap-2 px-3 py-2 rounded-pill fw-semibold shadow-sm">
                    <i class="bi bi-motherboard text-primary"></i>
                    <span>PC Builder</span>
                </a>

                <!-- Cart / Quotation Pill -->
                <a href="{{ route('enquiry') }}" class="header-action-pill header-cart-pill text-decoration-none">
                    <div class="action-icon-circle bg-primary text-white position-relative shadow-sm">
                        <i class="bi bi-cart3"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none;">0</span>
                    </div>
                    <div class="action-text-box">
                        <span class="action-micro-label">Quotation Cart</span>
                        <strong class="action-main-val text-primary">Enquiry List</strong>
                    </div>
                </a>
            </div>
        </div>

        <!-- Mobile Header Bar (Screens < 992px) -->
        <div class="d-lg-none">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <!-- Mobile Drawer Toggle Button -->
                <button class="btn btn-light border-0 p-2 d-flex align-items-center justify-content-center rounded-3 mobile-nav-trigger" type="button" data-bs-toggle="offcanvas" data-bs-target="#storeMobileDrawer" aria-controls="storeMobileDrawer" aria-label="Open Navigation">
                    <i class="bi bi-list fs-2 text-dark"></i>
                </button>

                <!-- Mobile Logo -->
                <a class="d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
                    <div class="brand-icon-box" style="width: 36px; height: 36px; min-width: 36px; font-size: 1.1rem;">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <div class="text-start">
                        <div class="brand-text-main" style="font-size: 1.05rem;">HARI OM COMPUTER</div>
                        <div class="brand-tagline" style="font-size: 0.58rem;">Electronics Megastore</div>
                    </div>
                </a>

                <!-- Mobile Action Icons -->
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('pc.builder') }}" class="btn btn-sm btn-outline-warning text-dark position-relative p-2 rounded-circle shadow-sm" title="Custom PC Builder">
                        <i class="bi bi-motherboard fs-5 text-primary"></i>
                    </a>
                    <a href="{{ route('enquiry') }}" class="btn btn-sm btn-primary position-relative p-2 rounded-circle shadow-sm" title="Quotation Cart">
                        <i class="bi bi-cart3 fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none; font-size: 0.65rem;">0</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Search Bar Strip -->
            <form class="unimart-search-bar unimart-search-bar-mobile" id="mobile-header-search-form" action="{{ route('products') }}" method="GET">
                <div class="search-category-dropdown">
                    <select name="cat" class="search-cat-select" style="font-size: 0.76rem; max-width: 105px; padding-left: 8px;">
                        <option value="ALL">All</option>
                        <option value="Desktop Computers">Desktop</option>
                        <option value="Laptops">Laptops</option>
                        <option value="Components">Parts</option>
                        <option value="Display & Monitors">Monitors</option>
                    </select>
                </div>
                <div class="search-input-field flex-grow-1 position-relative">
                    <input type="text" name="search" class="search-kw-input" placeholder="Search PCs, laptops, GPUs..." value="{{ request('search') }}" style="font-size: 0.82rem; padding: 7px 10px;">
                </div>
                <button type="submit" class="search-action-btn" style="padding: 7px 14px;">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

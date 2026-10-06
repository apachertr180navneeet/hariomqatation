<!-- =========================================================================
     Mobile Offcanvas Navigation Drawer (App-like Mobile Experience)
     ========================================================================= -->
<div class="offcanvas offcanvas-start store-mobile-offcanvas" tabindex="-1" id="storeMobileDrawer" aria-labelledby="storeMobileDrawerLabel">
    <div class="offcanvas-header bg-dark text-white border-bottom border-secondary border-opacity-25 py-3">
        <div class="d-flex align-items-center gap-2" id="storeMobileDrawerLabel">
            <div class="brand-icon-box" style="width: 36px; height: 36px; min-width: 36px; font-size: 1.1rem;">
                <i class="bi bi-cpu"></i>
            </div>
            <div>
                <div class="fw-bold text-white small" style="font-family: var(--hoc-font-heading); letter-spacing: -0.02em;">HARI OM COMPUTER</div>
                <div class="text-info text-uppercase" style="font-size: 0.6rem; letter-spacing: 0.06em; font-weight: 700;">Hardware Megastore</div>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Quick Action Banner inside Mobile Drawer -->
    <div class="p-3 bg-light border-bottom">
        <div class="row g-2">
            <div class="col-6">
                <a href="{{ route('pc.builder') }}" class="btn btn-warning btn-sm w-100 fw-bold d-flex align-items-center justify-content-center gap-1 shadow-sm text-dark">
                    <i class="bi bi-motherboard"></i>
                    <span>PC Builder</span>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('enquiry') }}" class="btn btn-primary btn-sm w-100 fw-bold d-flex align-items-center justify-content-center gap-1 shadow-sm">
                    <i class="bi bi-cart3"></i>
                    <span>Quote Cart</span>
                </a>
            </div>
        </div>
    </div>

    <div class="offcanvas-body p-0">
        <!-- Section: Store Departments -->
        <div class="px-3 pt-3 pb-1">
            <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                <i class="bi bi-grid-fill text-primary me-1"></i> Hardware Departments
            </span>
        </div>
        <div class="list-group list-group-flush border-bottom">
            <a href="{{ route('laptops') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-primary-subtle text-primary"><i class="bi bi-laptop"></i></span>
                    <span class="fw-semibold small">Laptops & Ultrabooks</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('computers') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-info-subtle text-info"><i class="bi bi-pc-display"></i></span>
                    <span class="fw-semibold small">Desktop & All-in-One PCs</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('pc.builder') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-danger-subtle text-danger"><i class="bi bi-motherboard"></i></span>
                    <span class="fw-semibold small">Custom Gaming Rigs</span>
                </span>
                <span class="badge bg-danger micro-badge">HOT</span>
            </a>
            <a href="{{ route('components') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-success-subtle text-success"><i class="bi bi-cpu"></i></span>
                    <span class="fw-semibold small">Processors (Intel & AMD)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-warning-subtle text-warning"><i class="bi bi-gpu-card"></i></span>
                    <span class="fw-semibold small">Graphics Cards (RTX)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-primary-subtle text-primary"><i class="bi bi-memory"></i></span>
                    <span class="fw-semibold small">Motherboards & DDR5 RAM</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-secondary-subtle text-secondary"><i class="bi bi-device-ssd"></i></span>
                    <span class="fw-semibold small">Gen4 NVMe SSDs & Storage</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('products', ['cat' => 'Display']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-info-subtle text-info"><i class="bi bi-display"></i></span>
                    <span class="fw-semibold small">Gaming & 4K Monitors</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('products', ['cat' => 'Accessories']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-dark-subtle text-dark"><i class="bi bi-keyboard"></i></span>
                    <span class="fw-semibold small">Keyboards, Mice & Audio</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('products', ['cat' => 'Networking']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-primary-subtle text-primary"><i class="bi bi-router"></i></span>
                    <span class="fw-semibold small">WiFi Routers & Switches</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
        </div>

        <!-- Section: Store Pages -->
        <div class="px-3 pt-3 pb-1">
            <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                <i class="bi bi-compass-fill text-primary me-1"></i> Quick Navigation
            </span>
        </div>
        <div class="list-group list-group-flush border-bottom">
            <a href="{{ route('home') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-house-door me-2 text-primary"></i> Home
            </a>
            <a href="{{ route('products') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-grid me-2 text-primary"></i> Complete Hardware Catalog (500+ Items)
            </a>
            <a href="{{ route('products', ['search' => 'RTX']) }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-fire me-2 text-danger"></i> Special Hardware Deals
            </a>
            <a href="{{ route('about') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-info-circle me-2 text-primary"></i> About Our Jodhpur Showroom
            </a>
            <a href="{{ route('contact') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-geo-alt me-2 text-primary"></i> Store Location & Direction
            </a>
            <a href="{{ route('admin.login') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-shield-lock me-2 text-warning"></i> Staff ERP Portal
            </a>
        </div>

        <!-- Contact & Help Box in Drawer -->
        <div class="p-3 bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-headset text-primary fs-5"></i>
                <div>
                    <div class="small fw-bold">Customer Helpline</div>
                    <a href="tel:+919829012345" class="small text-decoration-none fw-bold text-primary">+91 98290 12345</a>
                </div>
            </div>
            <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer" target="_blank" class="btn btn-sm btn-success w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                <i class="bi bi-whatsapp"></i>
                <span>Chat on WhatsApp</span>
            </a>
            <div class="text-center text-muted small mt-2" style="font-size: 0.72rem;">
                Station Road, Near Sojati Gate, Jodhpur<br>10:00 AM - 8:30 PM (Mon - Sat)
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     Desktop Unimart Navigation Bar (Screens >= 992px)
     ========================================================================= -->
<nav class="navbar navbar-expand-lg navbar-unimart sticky-top d-none d-lg-block">
    <div class="container">
        <!-- All Departments / Categories Dropdown Button (Unimart Signature Feature) -->
        <div class="dropdown department-dropdown-wrapper">
            <button class="btn btn-department-trigger dropdown-toggle" type="button" id="departmentDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-grid-fill me-2"></i>
                <span class="fw-bold text-uppercase">All Departments</span>
            </button>
            <ul class="dropdown-menu department-dropdown-menu shadow-lg border-0 py-2" aria-labelledby="departmentDropdownBtn">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('laptops') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-laptop text-primary"></i> Laptops & Ultrabooks</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('computers') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-pc-display text-info"></i> Desktop & All-in-One PCs</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('pc.builder') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-motherboard text-danger"></i> Custom Gaming Rigs</span>
                        <span class="badge bg-danger-subtle text-danger small">HOT</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-cpu text-success"></i> Processors (Intel / AMD)</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-gpu-card text-warning"></i> Graphic Cards (RTX / RX)</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-memory text-primary"></i> Motherboards & DDR5 RAM</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components') }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-device-ssd text-secondary"></i> NVMe Gen4 SSDs & Storage</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('products', ['cat' => 'Display']) }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-display text-info"></i> Gaming & 4K Monitors</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('products', ['cat' => 'Accessories']) }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-keyboard text-dark"></i> Peripherals & Accessories</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('products', ['cat' => 'Networking']) }}">
                        <span class="d-flex align-items-center gap-2"><i class="bi bi-router text-primary"></i> WiFi Routers & Networking</span>
                        <i class="bi bi-chevron-right text-muted small"></i>
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <a class="dropdown-item text-center fw-bold text-primary py-2 small" href="{{ route('products') }}">
                        <i class="bi bi-grid me-1"></i> View Entire Catalog (500+ Items)
                    </a>
                </li>
            </ul>
        </div>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse show" id="storeNavbar">
            <ul class="navbar-nav ms-3 mb-0">
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('computers') ? 'active' : '' }}" href="{{ route('computers') }}">Desktop PCs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('laptops') ? 'active' : '' }}" href="{{ route('laptops') }}">Laptops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('components') ? 'active' : '' }}" href="{{ route('components') }}">Components</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">All Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart nav-badge-item {{ request()->routeIs('pc.builder') ? 'active' : '' }}" href="{{ route('pc.builder') }}">
                        <i class="bi bi-motherboard text-warning me-1"></i> PC Builder
                        <span class="badge-nav-hot">HOT</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart" href="{{ route('products', ['search' => 'RTX']) }}">
                        <i class="bi bi-fire text-warning me-1"></i> Special Deals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-unimart {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

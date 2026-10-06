<!-- =========================================================================
     Mobile Offcanvas Navigation Drawer (App-like Mobile Experience)
     ========================================================================= -->
<div class="offcanvas offcanvas-start store-mobile-offcanvas" tabindex="-1" id="storeMobileDrawer" aria-labelledby="storeMobileDrawerLabel">
    <div class="offcanvas-header bg-dark text-white border-bottom border-secondary border-opacity-25 py-3">
        <div class="d-flex align-items-center gap-2" id="storeMobileDrawerLabel">
            <div class="brand-pc-box" style="width: 36px; height: 36px; min-width: 36px; font-size: 1.15rem;">
                <i class="bi bi-display-fill"></i>
            </div>
            <div>
                <div class="fw-bold text-white small" style="font-family: var(--hoc-font-heading);">HARI OM <span class="text-primary">PCMart</span></div>
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
                <i class="bi bi-grid-fill text-primary me-1"></i> All Departments
            </span>
        </div>
        <div class="list-group list-group-flush border-bottom">
            <a href="{{ route('components', ['sub' => 'Processor']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-primary-subtle text-primary"><i class="bi bi-cpu"></i></span>
                    <span class="fw-semibold small">Processors (CPUs)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components', ['sub' => 'Graphics Card']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-warning-subtle text-warning"><i class="bi bi-gpu-card"></i></span>
                    <span class="fw-semibold small">Graphics Cards (GPUs)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components', ['sub' => 'Motherboard']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-info-subtle text-info"><i class="bi bi-motherboard"></i></span>
                    <span class="fw-semibold small">Motherboards</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components', ['sub' => 'RAM']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-success-subtle text-success"><i class="bi bi-memory"></i></span>
                    <span class="fw-semibold small">RAM Memory (DDR4 / DDR5)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components', ['sub' => 'SSD']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-secondary-subtle text-secondary"><i class="bi bi-device-ssd"></i></span>
                    <span class="fw-semibold small">Storage (NVMe SSD / HDD)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('components', ['sub' => 'SMPS/PSU']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-danger-subtle text-danger"><i class="bi bi-plug"></i></span>
                    <span class="fw-semibold small">Power Supply (PSU)</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('computers') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-primary-subtle text-primary"><i class="bi bi-pc-display"></i></span>
                    <span class="fw-semibold small">Pre-Built & Gaming PCs</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('laptops') }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-info-subtle text-info"><i class="bi bi-laptop"></i></span>
                    <span class="fw-semibold small">Laptops & Ultrabooks</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('products', ['cat' => 'Display']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-warning-subtle text-warning"><i class="bi bi-display"></i></span>
                    <span class="fw-semibold small">Monitors</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
            <a href="{{ route('products', ['cat' => 'Accessories']) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2 px-3">
                <span class="d-flex align-items-center gap-3">
                    <span class="mobile-drawer-icon bg-dark-subtle text-dark"><i class="bi bi-headphones"></i></span>
                    <span class="fw-semibold small">Accessories</span>
                </span>
                <i class="bi bi-chevron-right text-muted small"></i>
            </a>
        </div>

        <!-- Section: Store Pages -->
        <div class="px-3 pt-3 pb-1">
            <span class="text-uppercase fw-bold text-muted small" style="font-size: 0.7rem; letter-spacing: 0.08em;">
                <i class="bi bi-compass-fill text-primary me-1"></i> Quick Links
            </span>
        </div>
        <div class="list-group list-group-flush border-bottom">
            <a href="{{ route('home') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-house-door me-2 text-primary"></i> Home
            </a>
            <a href="{{ route('computers') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-pc-display me-2 text-primary"></i> Desktop PCs
            </a>
            <a href="{{ route('laptops') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-laptop me-2 text-primary"></i> Laptops
            </a>
            <a href="{{ route('components') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-cpu me-2 text-primary"></i> Components
            </a>
            <a href="{{ route('products') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-grid me-2 text-primary"></i> All Catalog
            </a>
            <a href="{{ route('pc.builder') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-motherboard me-2 text-warning"></i> PC Builder <span class="badge bg-danger micro-badge ms-1">HOT</span>
            </a>
            <a href="{{ route('products', ['search' => 'RTX']) }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-fire me-2 text-warning"></i> Special Deals
            </a>
            <a href="{{ route('about') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-info-circle me-2 text-primary"></i> About Us
            </a>
            <a href="{{ route('contact') }}" class="list-group-item list-group-item-action py-2 px-3 small fw-semibold">
                <i class="bi bi-geo-alt me-2 text-primary"></i> Contact
            </a>
        </div>

        <!-- Contact Box -->
        <div class="p-3 bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-headset text-primary fs-5"></i>
                <div>
                    <div class="small fw-bold">Customer Helpline</div>
                    <a href="tel:+919829012345" class="small text-decoration-none fw-bold text-primary">+91 98290 12345</a>
                </div>
            </div>
            <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20PCMart" target="_blank" class="btn btn-sm btn-success w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                <i class="bi bi-whatsapp"></i>
                <span>Chat on WhatsApp</span>
            </a>
        </div>
    </div>
</div>

<!-- =========================================================================
     PCMart Navigation Bar (Reference Design - Deep Tech Navy Blue)
     ========================================================================= -->
<nav class="navbar navbar-expand-lg navbar-pcmart sticky-top d-none d-lg-block">
    <div class="container d-flex align-items-center">
        <!-- ALL DEPARTMENTS Dropdown Trigger (Dark Navy Accent Box) -->
        <div class="dropdown department-dropdown-wrapper">
            <button class="btn btn-dept-trigger dropdown-toggle" type="button" id="departmentDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-grid-fill me-2 text-info"></i>
                <span class="dept-trigger-text">ALL DEPARTMENTS</span>
            </button>
            <ul class="dropdown-menu department-dropdown-menu shadow-lg border-0 py-2" aria-labelledby="departmentDropdownBtn">
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components', ['sub' => 'Processor']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-primary-subtle text-primary"><i class="bi bi-cpu"></i></span>
                            <span class="dept-item-name">Processors (CPUs)</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components', ['sub' => 'Graphics Card']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-warning-subtle text-warning"><i class="bi bi-gpu-card"></i></span>
                            <span class="dept-item-name">Graphics Cards (GPUs)</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components', ['sub' => 'Motherboard']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-info-subtle text-info"><i class="bi bi-motherboard"></i></span>
                            <span class="dept-item-name">Motherboards</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components', ['sub' => 'RAM']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-success-subtle text-success"><i class="bi bi-memory"></i></span>
                            <span class="dept-item-name">RAM Memory (DDR4 / DDR5)</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components', ['sub' => 'SSD']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-secondary-subtle text-secondary"><i class="bi bi-device-ssd"></i></span>
                            <span class="dept-item-name">Storage (NVMe / SSD / HDD)</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('components', ['sub' => 'SMPS/PSU']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-danger-subtle text-danger"><i class="bi bi-plug"></i></span>
                            <span class="dept-item-name">Power Supplies (PSU)</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('computers') }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-primary-subtle text-primary"><i class="bi bi-pc-display"></i></span>
                            <span class="dept-item-name">Pre-Built & Gaming PCs</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('laptops') }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-info-subtle text-info"><i class="bi bi-laptop"></i></span>
                            <span class="dept-item-name">Laptops & Ultrabooks</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('products', ['cat' => 'Display']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-warning-subtle text-warning"><i class="bi bi-display"></i></span>
                            <span class="dept-item-name">Gaming & 4K Monitors</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('products', ['cat' => 'Accessories']) }}">
                        <span class="d-flex align-items-center gap-2">
                            <span class="dept-menu-icon bg-secondary-subtle text-dark"><i class="bi bi-headphones"></i></span>
                            <span class="dept-item-name">Peripherals & Accessories</span>
                        </span>
                        <i class="bi bi-chevron-right text-muted small dept-arrow"></i>
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <a class="dropdown-item text-center fw-bold text-primary py-2 small" href="{{ route('products') }}">
                        <i class="bi bi-grid me-1"></i> View Entire Catalog (500+ Items) &rarr;
                    </a>
                </li>
            </ul>
        </div>

        <!-- Horizontal Nav Links -->
        <div class="collapse navbar-collapse show" id="storeNavbar">
            <ul class="navbar-nav ms-lg-3 mb-0 align-items-center flex-nowrap">
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('computers') ? 'active' : '' }}" href="{{ route('computers') }}">
                        Desktop PCs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('laptops') ? 'active' : '' }}" href="{{ route('laptops') }}">
                        Laptops
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('components') ? 'active' : '' }}" href="{{ route('components') }}">
                        Components
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">
                        All Catalog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link nav-item-builder {{ request()->routeIs('pc.builder') ? 'active' : '' }}" href="{{ route('pc.builder') }}">
                        <i class="bi bi-motherboard text-warning me-1"></i> PC Builder
                        <span class="badge-hot-tag">HOT</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link" href="{{ route('products', ['search' => 'RTX']) }}">
                        <i class="bi bi-lightning-charge-fill text-warning me-1"></i> Special Deals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pcmart-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

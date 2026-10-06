<!-- Unimart Home Electronics Main Navigation Bar -->
<nav class="navbar navbar-expand-xl navbar-unimart sticky-top">
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

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 py-2 ms-auto d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#storeNavbar" aria-controls="storeNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="storeNavbar">
            <ul class="navbar-nav ms-xl-3 mb-2 mb-xl-0">
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

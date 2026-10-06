<!-- Top Announcement Micro-Bar (PCMart Reference Style) -->
<div class="pcmart-top-bar border-bottom py-2 bg-light text-muted small d-none d-md-block">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-4 top-bar-left">
            <span><i class="bi bi-truck text-primary me-1"></i> Free Shipping on orders above ₹999</span>
            <span class="text-muted opacity-50">|</span>
            <span><i class="bi bi-shield-check text-primary me-1"></i> 100% Genuine Products</span>
            <span class="text-muted opacity-50">|</span>
            <span><i class="bi bi-headset text-primary me-1"></i> Expert Support: +91 98290 12345</span>
        </div>
        <div class="d-flex align-items-center gap-3 top-bar-right">
            <a href="{{ route('enquiry') }}" class="text-decoration-none text-muted hover-primary">
                <i class="bi bi-geo-alt me-1"></i> Track Order
            </a>
            <span class="text-muted opacity-50">|</span>
            <a href="{{ route('contact') }}" class="text-decoration-none text-muted hover-primary">
                <i class="bi bi-question-circle me-1"></i> Help & Support
            </a>
            <span class="text-muted opacity-50">|</span>
            <a href="{{ route('admin.login') }}" class="text-decoration-none text-warning fw-semibold">
                <i class="bi bi-shield-lock-fill me-1"></i> Staff ERP
            </a>
        </div>
    </div>
</div>

<!-- Middle Header (Logo, Centered Search Bar, Account / Wishlist / Cart Actions) -->
<header class="pcmart-middle-header py-3 bg-white border-bottom">
    <div class="container">
        <!-- Desktop Header Row (Screens >= 992px) -->
        <div class="row align-items-center gy-3 d-none d-lg-flex">
            <!-- Brand Logo -->
            <div class="col-auto">
                <a class="pcmart-brand-logo d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
                    <div class="brand-pc-box">
                        <i class="bi bi-display-fill"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="brand-pc-title">HARI OM <span class="text-primary">PCMart</span></div>
                        <div class="brand-pc-sub">Custom PC & Hardware Megastore</div>
                    </div>
                </a>
            </div>

            <!-- Centered Electronics Search Bar -->
            <div class="col px-xl-5">
                <form class="pcmart-search-bar position-relative" id="header-search-form" action="{{ route('products') }}" method="GET">
                    <input type="text" name="search" id="header-search-input" class="form-control pcmart-search-input" placeholder="Search for CPUs, GPUs, motherboards and more..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary pcmart-search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <!-- Right Header Actions (Login / Account, Wishlist, Cart) -->
            <div class="col-auto d-flex align-items-center gap-4 ms-auto">
                <!-- Login / Account -->
                <a href="{{ route('admin.login') }}" class="pcmart-action-item text-decoration-none text-dark d-flex align-items-center gap-2">
                    <div class="action-icon-circle bg-light">
                        <i class="bi bi-person fs-5"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="action-label-small">Login</span>
                        <strong class="action-label-bold">Account</strong>
                    </div>
                </a>

                <!-- Wishlist / PC Builder -->
                <a href="{{ route('pc.builder') }}" class="pcmart-action-item text-decoration-none text-dark d-flex align-items-center gap-2">
                    <div class="action-icon-circle bg-light position-relative">
                        <i class="bi bi-heart fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.65rem;">0</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="action-label-small">Saved</span>
                        <strong class="action-label-bold">Wishlist</strong>
                    </div>
                </a>

                <!-- Shopping Cart Pill -->
                <a href="{{ route('enquiry') }}" class="pcmart-action-item text-decoration-none text-dark d-flex align-items-center gap-2">
                    <div class="action-icon-circle bg-light text-primary position-relative">
                        <i class="bi bi-cart3 fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary enquiry-count-badge" style="font-size: 0.65rem;">0</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="action-label-small">Quotation</span>
                        <strong class="action-label-bold text-primary">Cart</strong>
                    </div>
                </a>
            </div>
        </div>

        <!-- Mobile Header Bar (Screens < 992px) -->
        <div class="d-lg-none">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <!-- Mobile Drawer Toggle Button -->
                <button class="btn btn-light border p-2 d-flex align-items-center justify-content-center rounded-3 mobile-nav-trigger" type="button" data-bs-toggle="offcanvas" data-bs-target="#storeMobileDrawer" aria-controls="storeMobileDrawer" aria-label="Open Navigation">
                    <i class="bi bi-list fs-3 text-dark"></i>
                </button>

                <!-- Mobile Logo -->
                <a class="d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
                    <div class="brand-pc-box" style="width: 36px; height: 36px; min-width: 36px; font-size: 1.15rem;">
                        <i class="bi bi-display-fill"></i>
                    </div>
                    <div class="text-start">
                        <div class="brand-pc-title" style="font-size: 1.1rem;">HARI OM <span class="text-primary">PCMart</span></div>
                    </div>
                </a>

                <!-- Mobile Actions (Builder & Cart) -->
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('pc.builder') }}" class="btn btn-sm btn-outline-primary position-relative p-2 rounded-circle" title="PC Builder">
                        <i class="bi bi-motherboard fs-5"></i>
                    </a>
                    <a href="{{ route('enquiry') }}" class="btn btn-sm btn-primary position-relative p-2 rounded-circle" title="Cart">
                        <i class="bi bi-cart3 fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="font-size: 0.65rem;">0</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Search Bar Strip -->
            <form class="pcmart-search-bar position-relative" id="mobile-header-search-form" action="{{ route('products') }}" method="GET">
                <input type="text" name="search" class="form-control pcmart-search-input" placeholder="Search CPUs, GPUs, motherboards..." value="{{ request('search') }}" style="font-size: 0.84rem; padding-right: 48px;">
                <button type="submit" class="btn btn-primary pcmart-search-btn" style="width: 42px; height: 100%;">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

@extends('shop.includes.app')

@section('content')
<!-- =========================================================================
     Mobile Horizontal Category Scroll Strip (App-Style 1-Tap Browsing for Mobile)
     ========================================================================= -->
<div class="mobile-cat-scroll-strip d-lg-none py-2 bg-white border-bottom">
    <div class="container">
        <div class="cat-chips-scroll-container">
            <a href="{{ route('products') }}" class="cat-chip-pill active">
                <i class="bi bi-grid-fill text-primary"></i> All Items
            </a>
            <a href="{{ route('laptops') }}" class="cat-chip-pill">
                <i class="bi bi-laptop text-primary"></i> Laptops
            </a>
            <a href="{{ route('computers') }}" class="cat-chip-pill">
                <i class="bi bi-pc-display text-info"></i> Desktops
            </a>
            <a href="{{ route('pc.builder') }}" class="cat-chip-pill chip-pill-hot">
                <i class="bi bi-motherboard text-danger"></i> PC Builder <span class="badge bg-danger text-white ms-1" style="font-size: 0.6rem;">HOT</span>
            </a>
            <a href="{{ route('components') }}" class="cat-chip-pill">
                <i class="bi bi-gpu-card text-warning"></i> RTX GPUs
            </a>
            <a href="{{ route('components') }}" class="cat-chip-pill">
                <i class="bi bi-cpu text-success"></i> CPUs
            </a>
            <a href="{{ route('components') }}" class="cat-chip-pill">
                <i class="bi bi-memory text-primary"></i> DDR5 RAM
            </a>
            <a href="{{ route('products', ['cat' => 'Display']) }}" class="cat-chip-pill">
                <i class="bi bi-display text-info"></i> Monitors
            </a>
            <a href="{{ route('products', ['cat' => 'Accessories']) }}" class="cat-chip-pill">
                <i class="bi bi-keyboard text-dark"></i> Accessories
            </a>
        </div>
    </div>
</div>

<!-- =========================================================================
     Unimart Home Electronics - Hero Showcase Section (3-Column Layout)
     ========================================================================= -->
<section class="unimart-hero-section py-3 py-md-4">
    <div class="container">
        <div class="row g-3 align-items-stretch">
            <!-- Left Column: Vertical Category Menu (Desktop only) -->
            <div class="col-lg-3 d-none d-lg-block">
                <div class="unimart-category-sidebar">
                    <div class="category-sidebar-header">
                        <i class="bi bi-list-ul me-2"></i>
                        <span>All Categories</span>
                    </div>
                    <ul class="category-sidebar-list">
                        <li>
                            <a href="{{ route('laptops') }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-laptop text-primary"></i>
                                    <span>Laptops & Ultrabooks</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('computers') }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-pc-display text-info"></i>
                                    <span>Desktop Computers</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pc.builder') }}" class="sidebar-cat-link active-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-motherboard text-danger"></i>
                                    <span>Custom Gaming Rigs</span>
                                </span>
                                <span class="badge bg-danger text-white micro-badge">HOT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('components') }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-cpu text-success"></i>
                                    <span>Processors & CPUs</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('components') }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-gpu-card text-warning"></i>
                                    <span>Graphics Cards (RTX)</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('components') }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-memory text-primary"></i>
                                    <span>Motherboards & RAM</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('components') }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-device-ssd text-secondary"></i>
                                    <span>NVMe SSDs & Storage</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products', ['cat' => 'Display']) }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-display text-info"></i>
                                    <span>Gaming & 4K Monitors</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products', ['cat' => 'Accessories']) }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-keyboard text-dark"></i>
                                    <span>Keyboards & Mice</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products', ['cat' => 'Networking']) }}" class="sidebar-cat-link">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="bi bi-router text-primary"></i>
                                    <span>WiFi Routers & Switches</span>
                                </span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="category-sidebar-footer">
                        <a href="{{ route('products') }}" class="d-flex align-items-center justify-content-between text-decoration-none">
                            <span class="fw-bold small text-primary"><i class="bi bi-grid me-1"></i> View All 500+ Items</span>
                            <i class="bi bi-arrow-right text-primary small"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Center Column: Main Hero Electronics Showcase Banner -->
            <div class="col-lg-6 col-12">
                <div class="unimart-hero-banner position-relative">
                    <div class="row align-items-center h-100 position-relative" style="z-index: 2;">
                        <!-- Text Content -->
                        <div class="col-12 col-md-7 pe-md-1">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-warning text-dark fw-bold px-2 py-1 text-uppercase" style="font-size: 0.72rem;">
                                    <i class="bi bi-lightning-charge-fill me-1"></i> 2024 Tech Lineup
                                </span>
                                <span class="badge bg-info-subtle text-info fw-semibold px-2 py-1" style="font-size: 0.72rem;">
                                    <i class="bi bi-patch-check-fill me-1"></i> Authorized Store
                                </span>
                            </div>

                            <h1 class="hero-banner-title mb-2">
                                Custom Gaming & <br>
                                <span class="glow-cyan-text">Workstation PCs</span>
                            </h1>

                            <p class="hero-banner-desc mb-3 small">
                                Assembled with 14th Gen Intel Core & NVIDIA RTX 40-Series. Stress-tested with Arctic MX paste & clean routing in Jodhpur.
                            </p>

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="hero-spec-pill"><i class="bi bi-cpu text-info"></i> Intel 14th Gen</span>
                                <span class="hero-spec-pill"><i class="bi bi-gpu-card text-success"></i> RTX 4060/4070</span>
                                <span class="hero-spec-pill"><i class="bi bi-memory text-warning"></i> 32GB DDR5</span>
                            </div>

                            <div class="d-flex align-items-baseline gap-2 mb-3">
                                <span class="text-light text-opacity-75 small">Custom builds from</span>
                                <strong class="fs-4 text-cyan fw-bold">₹28,990</strong>
                                <span class="badge bg-danger-subtle text-danger small">18% GST Inc.</span>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <a href="{{ route('pc.builder') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                                    <i class="bi bi-motherboard"></i>
                                    <span>Build Custom PC</span>
                                </a>
                                <a href="{{ route('computers') }}" class="btn btn-outline-light btn-sm fw-bold px-3 py-2 rounded-pill">
                                    Ready Rigs <i class="bi bi-chevron-right ms-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Product Showcase Image -->
                        <div class="col-12 col-md-5 text-center mt-3 mt-md-0">
                            <div class="hero-visual-img-wrapper position-relative">
                                <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="Custom Gaming PC Rig" class="img-fluid rounded-4 shadow-lg hero-hardware-img">
                                <div class="hero-img-badge mt-2">
                                    <span class="badge bg-dark bg-opacity-75 text-cyan border border-info border-opacity-25 rounded-pill px-3 py-1 shadow small">
                                        <i class="bi bi-water me-1"></i> Liquid Cooling Loop
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ambient Glow Effect -->
                    <div class="hero-ambient-circle"></div>
                </div>
            </div>

            <!-- Right Column: Dual Promotional Cards (Responsive Grid) -->
            <div class="col-lg-3 col-12">
                <div class="row g-3 h-100">
                    <!-- Promo Card 1: Laptops -->
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="unimart-promo-card promo-card-laptops h-100 position-relative overflow-hidden">
                            <div class="row align-items-center g-2 h-100">
                                <div class="col-7">
                                    <span class="badge bg-danger text-white mb-2 font-monospace" style="font-size: 0.68rem;">SAVE UP TO 30%</span>
                                    <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Gaming & Business Laptops</h5>
                                    <p class="text-light text-opacity-75 small mb-2" style="font-size: 0.74rem;">ASUS, Dell & HP from ₹38,990.</p>
                                    <a href="{{ route('laptops') }}" class="btn btn-sm btn-light fw-bold rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                        Shop Laptops <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('assets/images/promo_laptop.jpg') }}" alt="Laptops" class="img-fluid rounded-3 promo-img-thumb shadow">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Card 2: PC Configurator -->
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="unimart-promo-card promo-card-builder h-100 position-relative overflow-hidden">
                            <div class="row align-items-center g-2 h-100">
                                <div class="col-7">
                                    <span class="badge bg-primary text-white mb-2 font-monospace border border-white border-opacity-25" style="font-size: 0.68rem;">INSTANT GST QUOTE</span>
                                    <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">Custom PC Configurator</h5>
                                    <p class="text-light text-opacity-75 small mb-2" style="font-size: 0.74rem;">Real-time socket verification.</p>
                                    <a href="{{ route('pc.builder') }}" class="btn btn-sm btn-primary fw-bold rounded-pill px-3 py-1 border border-white border-opacity-25" style="font-size: 0.78rem;">
                                        Launch Builder <i class="bi bi-sliders ms-1"></i>
                                    </a>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('assets/images/promo_builder.jpg') }}" alt="PC Builder" class="img-fluid rounded-3 promo-img-thumb shadow">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Unimart 4-Column Trust & Service Badges Strip
     ========================================================================= -->
<section class="py-3 bg-white border-top border-bottom">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-lg-3">
                <div class="service-feature-card">
                    <div class="service-icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div>
                        <div class="service-title">Showroom Pickup & Courier</div>
                        <div class="service-desc">Same-day pickup in Jodhpur or express dispatch</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="service-feature-card">
                    <div class="service-icon-box bg-success-subtle text-success">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <div>
                        <div class="service-title">100% Genuine Hardware</div>
                        <div class="service-desc">Official warranty from authorized distributors</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="service-feature-card">
                    <div class="service-icon-box bg-warning-subtle text-warning">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <div>
                        <div class="service-title">18% GST Input Credit</div>
                        <div class="service-desc">Verified B2B tax invoice for companies & labs</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="service-feature-card">
                    <div class="service-icon-box bg-info-subtle text-info">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div>
                        <div class="service-title">In-House Tech Engineers</div>
                        <div class="service-desc">Free bench testing, assembly & lifetime support</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Shop by Categories (Visual Grid)
     ========================================================================= -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="text-primary text-uppercase fw-bold small">Explore Hardware</span>
                <h2 class="fw-bold mb-0">Popular Electronics Categories</h2>
            </div>
            <a href="{{ route('products') }}" class="text-primary fw-bold text-decoration-none">
                View All Categories <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-3 g-md-4">
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('laptops') }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #0284c7;">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <div class="category-card-title">Laptops & Ultrabooks</div>
                    <div class="category-card-count">Gaming, Student & Business</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('computers') }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%); color: #6366f1;">
                        <i class="bi bi-pc-display"></i>
                    </div>
                    <div class="category-card-title">Desktop Computers</div>
                    <div class="category-card-count">Office, Workstation & Gaming</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('components') }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); color: #059669;">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <div class="category-card-title">Processors & CPUs</div>
                    <div class="category-card-count">Intel 14th Gen & AMD Ryzen</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('components') }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); color: #d97706;">
                        <i class="bi bi-gpu-card"></i>
                    </div>
                    <div class="category-card-title">Graphics Cards</div>
                    <div class="category-card-count">NVIDIA RTX 4000 Series</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('components') }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); color: #9333ea;">
                        <i class="bi bi-device-ssd"></i>
                    </div>
                    <div class="category-card-title">RAM & Storage</div>
                    <div class="category-card-count">NVMe Gen4 SSDs & DDR5</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('products', ['cat' => 'Display']) }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%); color: #0891b2;">
                        <i class="bi bi-display"></i>
                    </div>
                    <div class="category-card-title">Monitors & LED</div>
                    <div class="category-card-count">Gaming & 4K IPS Panels</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('products', ['cat' => 'Accessories']) }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); color: #334155;">
                        <i class="bi bi-keyboard"></i>
                    </div>
                    <div class="category-card-title">Accessories</div>
                    <div class="category-card-count">Keyboards, Mouse & UPS</div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('products', ['cat' => 'Networking']) }}" class="category-card">
                    <div class="category-icon-wrapper" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #2563eb;">
                        <i class="bi bi-router"></i>
                    </div>
                    <div class="category-card-title">Networking</div>
                    <div class="category-card-count">Routers, Switches & WiFi</div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Unimart Featured Electronics & Hardware Showcase (Filterable Tabs)
     ========================================================================= -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
            <div>
                <span class="text-primary text-uppercase fw-bold small">Direct Distributor Inventory</span>
                <h2 class="fw-bold mb-0">Featured Electronics & Systems</h2>
            </div>
            
            <!-- Unimart Category Filter Tabs -->
            <div class="unimart-filter-tabs-wrapper" id="home-featured-filter-tabs">
                <button class="unimart-tab-btn active" data-filter="ALL">All Products</button>
                <button class="unimart-tab-btn" data-filter="Desktop Computers">Desktop PCs</button>
                <button class="unimart-tab-btn" data-filter="Laptops">Laptops</button>
                <button class="unimart-tab-btn" data-filter="Components">Components</button>
                <button class="unimart-tab-btn" data-filter="Display & Monitors">Monitors</button>
            </div>
        </div>

        <div class="row g-3 g-md-4" id="home-featured-products-grid">
            @forelse($featuredProducts as $p)
                @php
                    $catName = $p->category->name ?? '';
                    $subName = $p->subcategory->name ?? '';
                    $artClass = 'art-default';
                    $artIcon = 'bi-cpu-fill';
                    if ($catName === 'Laptops') { $artClass = 'art-laptop'; $artIcon = 'bi-laptop'; }
                    elseif ($catName === 'Desktop Computers') { $artClass = 'art-desktop'; $artIcon = 'bi-pc-display'; }
                    elseif (str_contains($catName, 'Display') || str_contains($catName, 'Monitor')) { $artClass = 'art-monitor'; $artIcon = 'bi-display'; }
                    elseif (str_contains($subName, 'Graphics') || str_contains($subName, 'GPU')) { $artClass = 'art-gpu'; $artIcon = 'bi-gpu-card'; }
                    elseif (str_contains($subName, 'Processor') || str_contains($subName, 'CPU')) { $artClass = 'art-cpu'; $artIcon = 'bi-cpu'; }
                    elseif (str_contains($subName, 'RAM') || str_contains($subName, 'SSD')) { $artClass = 'art-ram'; $artIcon = 'bi-device-ssd'; }

                    $discountPct = ($p->mrp && $p->mrp > $p->selling_price) ? round((($p->mrp - $p->selling_price) / $p->mrp) * 100) : 0;
                    $savings = ($p->mrp && $p->mrp > $p->selling_price) ? ($p->mrp - $p->selling_price) : 0;
                    $specParts = array_slice(array_filter(array_map('trim', explode('|', $p->specs))), 0, 3);
                    $detailUrl = route('product.details', ['id' => $p->id]);
                @endphp
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="unimart-product-card">
                        <div class="unimart-card-media {{ $artClass }}">
                            <div class="card-badge-top-left">
                                @if($discountPct > 0)
                                    <span class="badge-discount">-{{ $discountPct }}%</span>
                                @endif
                                <span class="badge-brand">{{ $p->brand->name ?? 'Branded' }}</span>
                            </div>
                            <div class="card-badge-top-right">
                                <span class="badge-stock"><span class="pulse-dot-green"></span> In Stock</span>
                            </div>
                            <div class="card-media-center">
                                <i class="bi {{ $artIcon }} product-art-icon"></i>
                            </div>
                            <div class="card-hover-actions">
                                <a href="{{ $detailUrl }}" class="card-quick-action-btn" title="View Specifications">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="card-quick-action-btn btn-add-enquiry" data-id="{{ $p->id }}" title="Add to Enquiry">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="unimart-card-body">
                            <div class="card-cat-label">{{ $p->subcategory->name ?? ($p->category->name ?? 'Hardware') }}</div>
                            <a href="{{ $detailUrl }}" class="unimart-product-title" title="{{ $p->name }}">{{ $p->name }}</a>
                            
                            <div class="card-rating-strip mb-2">
                                <span class="text-warning small">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <span class="rating-num ms-1">4.9</span>
                                <span class="rating-count text-muted">(24)</span>
                            </div>

                            <div class="unimart-specs-row mb-3">
                                @foreach($specParts as $spec)
                                    <span class="unimart-spec-tag">{{ $spec }}</span>
                                @endforeach
                            </div>

                            <div class="card-footer-pricing pt-2 border-top">
                                <div class="d-flex align-items-baseline justify-content-between mb-2">
                                    <div>
                                        <div class="unimart-price-current">₹{{ number_format($p->selling_price, 2) }}</div>
                                        @if($p->mrp && $p->mrp > $p->selling_price)
                                            <div class="unimart-price-mrp">MRP: ₹{{ number_format($p->mrp, 2) }}</div>
                                        @endif
                                    </div>
                                    @if($savings > 0)
                                        <span class="badge-savings">Save ₹{{ number_format($savings, 0) }}</span>
                                    @endif
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-sm btn-add-enquiry py-2 fw-semibold" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->selling_price }}">
                                        <i class="bi bi-cart-plus me-1"></i> Add to Quote
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback in case DB is being seeded -->
            @endforelse
        </div>
    </div>
</section>

<!-- =========================================================================
     Unimart Electronics Promo Banner Strip (Custom PC Builder Callout)
     ========================================================================= -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="unimart-banner-strip">
            <div class="row align-items-center gy-3">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark fw-bold mb-2 font-monospace">CUSTOM PC CONFIGURATOR</span>
                    <h3 class="fw-bold text-white mb-2">Assemble Your Dream Computer with Real-Time Compatibility</h3>
                    <p class="text-light text-opacity-80 small mb-0">
                        Select CPU, GPU, Motherboard, RAM & Cabinets with automatic socket verification and download an official B2B quotation PDF instantly.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('pc.builder') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-sliders me-1 text-primary"></i> Launch PC Configurator
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Interactive 1-Minute PC Budget Estimator Wizard
     ========================================================================= -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="estimator-card">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <span class="badge bg-primary px-3 py-1 fw-bold mb-2">PC FINDER WIZARD</span>
                    <h3 class="fw-bold text-white mb-2">Find Your Ideal Computer in 1 Click</h3>
                    <p class="text-light text-opacity-75 small mb-4">
                        Select your primary usage and budget bracket to see the recommended hardware setup.
                    </p>

                    <!-- Step 1: Use Case -->
                    <div class="mb-4">
                        <label class="form-label text-light small fw-bold text-uppercase">1. Select Your Use Case:</label>
                        <div class="d-flex flex-wrap gap-2" id="wizard-usecase-group">
                            <button type="button" class="estimator-pill-btn active" data-use="gaming"><i class="bi bi-controller"></i> AAA Gaming / Streaming</button>
                            <button type="button" class="estimator-pill-btn" data-use="editing"><i class="bi bi-film"></i> 4K Video Editing / 3D</button>
                            <button type="button" class="estimator-pill-btn" data-use="office"><i class="bi bi-briefcase"></i> Office & Business</button>
                            <button type="button" class="estimator-pill-btn" data-use="student"><i class="bi bi-mortarboard"></i> Student / Coding</button>
                        </div>
                    </div>

                    <!-- Step 2: Budget Range -->
                    <div class="mb-3">
                        <label class="form-label text-light small fw-bold text-uppercase">2. Select Your Budget Bracket:</label>
                        <div class="d-flex flex-wrap gap-2" id="wizard-budget-group">
                            <button type="button" class="estimator-pill-btn" data-budget="budget">₹20,000 - ₹40,000</button>
                            <button type="button" class="estimator-pill-btn active" data-budget="mid">₹40,000 - ₹75,000</button>
                            <button type="button" class="estimator-pill-btn" data-budget="high">₹75,000 - ₹1,50,000</button>
                            <button type="button" class="estimator-pill-btn" data-budget="extreme">₹1,50,000+</button>
                        </div>
                    </div>
                </div>

                <!-- Result Preview Box -->
                <div class="col-lg-6">
                    <div class="recommendation-result-box" id="wizard-result-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success-subtle text-success fw-bold px-3 py-1">RECOMMENDED CONFIGURATION</span>
                            <span class="text-cyan fw-bold fs-5" id="rec-price">₹72,990</span>
                        </div>
                        <h4 class="text-white fw-bold mb-2" id="rec-title">Hari Om Beast 14th Gen Gaming PC</h4>
                        <p class="text-light text-opacity-75 small mb-3" id="rec-specs">
                            Intel Core i5 14400F | B760 WiFi | 16GB DDR5 5600MHz | 1TB Gen4 NVMe | 8GB RTX 4060 | 650W Bronze PSU | RGB Gaming Case
                        </p>
                        <div class="d-flex flex-wrap gap-2 pt-3 border-top border-white border-opacity-10">
                            <button class="btn btn-primary btn-sm px-3 fw-bold flex-grow-1" id="rec-add-btn">
                                <i class="bi bi-cart-plus me-1"></i> Add This Setup to Enquiry
                            </button>
                            <a href="{{ route('pc.builder') }}" class="btn btn-outline-light btn-sm px-3" id="rec-customize-btn">
                                <i class="bi bi-motherboard me-1"></i> Open in PC Builder
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Authorized Brands Strip
     ========================================================================= -->
<section class="brands-strip py-4 bg-light border-top border-bottom">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <span class="text-muted small fw-bold text-uppercase"><i class="bi bi-patch-check-fill text-primary me-1"></i> Authorized Showroom Partners:</span>
            <div class="d-flex flex-wrap gap-2">
                <span class="brand-pill-badge" style="border-left: 3px solid #0284c7;"><i class="bi bi-cpu text-primary"></i> Intel</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #ef4444;"><i class="bi bi-cpu-fill text-danger"></i> AMD</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #10b981;"><i class="bi bi-gpu-card text-success"></i> NVIDIA</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #06b6d4;"><i class="bi bi-laptop text-info"></i> ASUS</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #0284c7;"><i class="bi bi-laptop text-primary"></i> Dell</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #0f172a;"><i class="bi bi-laptop text-dark"></i> HP</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #e11d48;"><i class="bi bi-laptop text-danger"></i> Lenovo</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #f59e0b;"><i class="bi bi-memory text-warning"></i> Corsair</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #dc2626;"><i class="bi bi-device-ssd text-danger"></i> Kingston</span>
                <span class="brand-pill-badge" style="border-left: 3px solid #2563eb;"><i class="bi bi-device-ssd text-primary"></i> Samsung</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     The Hari Om Computer Advantage
     ========================================================================= -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center max-w-xl mx-auto mb-5">
            <span class="text-primary text-uppercase fw-bold small">Why Jodhpur Trusts Us</span>
            <h2 class="fw-bold">The Hari Om Computer Advantage</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon-circle"><i class="bi bi-patch-check-fill"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">100% Genuine Parts</h6>
                        <p class="text-muted small mb-0">Sourced directly from Rashi, CompAge & Supertron with direct brand warranty.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon-circle"><i class="bi bi-tools"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Free Professional Assembly</h6>
                        <p class="text-muted small mb-0">Clean cable routing, Arctic MX thermal paste & 24-hr stress testing.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon-circle"><i class="bi bi-receipt-cutoff"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">18% GST Input Credit</h6>
                        <p class="text-muted small mb-0">Official B2B invoices for businesses, schools, and corporate firms.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon-circle"><i class="bi bi-headset"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Local Showroom Support</h6>
                        <p class="text-muted small mb-0">In-house service engineers for instant diagnosis, upgrades, and support.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     Customer Social Proof / Testimonials
     ========================================================================= -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center max-w-xl mx-auto mb-5">
            <span class="text-primary text-uppercase fw-bold small">Customer Stories</span>
            <h2 class="fw-bold">What Our Customers in Jodhpur Say</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="review-card">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="small text-muted mb-3">
                        "Assembled an RTX 4070 editing workstation for our design studio. Sunil ji gave the best rates in Jodhpur and delivered the system stress-tested with clean wiring. 100% recommended!"
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">RS</div>
                        <div>
                            <div class="fw-bold small">Rajesh Sharma</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Jodhpur Tech Labs, Shastri Nagar</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="review-card">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="small text-muted mb-3">
                        "Best computer store in Western Rajasthan. Built my gaming PC with Intel Core i5 14th Gen. Got original invoice with GST input tax credit for my business within minutes."
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">VS</div>
                        <div>
                            <div class="fw-bold small">Vikram Singh Rathore</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Gaming Enthusiast, Ratanada</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="review-card">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="small text-muted mb-3">
                        "Bought 3 Dell laptops for our audit office. Genuine warranty, verified serial numbers, and best quotation price compared to any online portals."
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">PG</div>
                        <div>
                            <div class="fw-bold small">Pooja Gehlot</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Chartered Accountant, Paota</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const grid = document.getElementById("home-featured-products-grid");
        if (!grid) return;

        // Load Server Products or DataStore fallback
        const serverProducts = @json($allProductsJson ? json_decode($allProductsJson) : []);
        const products = (serverProducts && serverProducts.length > 0) ? serverProducts : (typeof DataStore !== 'undefined' ? DataStore.getProducts() : []);

        function getArtClass(cat, sub) {
            cat = cat || "";
            sub = sub || "";
            if (cat === 'Laptops') return { cls: 'art-laptop', icon: 'bi-laptop' };
            if (cat === 'Desktop Computers') return { cls: 'art-desktop', icon: 'bi-pc-display' };
            if (cat.includes('Display') || cat.includes('Monitor')) return { cls: 'art-monitor', icon: 'bi-display' };
            if (sub.includes('Graphics') || sub.includes('GPU')) return { cls: 'art-gpu', icon: 'bi-gpu-card' };
            if (sub.includes('Processor') || sub.includes('CPU')) return { cls: 'art-cpu', icon: 'bi-cpu' };
            if (sub.includes('RAM') || sub.includes('SSD')) return { cls: 'art-ram', icon: 'bi-device-ssd' };
            return { cls: 'art-default', icon: 'bi-cpu-fill' };
        }

        function renderFeatured(category = "ALL") {
            let list = products.filter(p => p.is_featured || p.isFeatured || p.stock > 0);
            if (category !== "ALL") {
                list = list.filter(p => {
                    const cName = (p.category && p.category.name) ? p.category.name : (p.category || "");
                    return cName.toLowerCase().includes(category.toLowerCase());
                });
            }
            
            let html = "";
            const displayList = list.slice(0, 8);

            if (displayList.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-box-seam fs-1 text-muted d-block mb-2"></i>
                        <h6 class="fw-bold text-muted">No items found in this department</h6>
                        <a href="{{ route('products') }}" class="btn btn-sm btn-primary mt-2">Explore Full Catalog</a>
                    </div>
                `;
                return;
            }

            displayList.forEach(p => {
                const sPrice = Number(p.selling_price || p.sellingPrice || 0);
                const mPrice = Number(p.mrp || 0);
                const discountPct = (mPrice && mPrice > sPrice) ? Math.round(((mPrice - sPrice) / mPrice) * 100) : 0;
                const savings = (mPrice && mPrice > sPrice) ? (mPrice - sPrice) : 0;

                const catName = (p.category && p.category.name) ? p.category.name : (p.category || "");
                const subName = (p.subcategory && p.subcategory.name) ? p.subcategory.name : (p.subcategory || "");
                const brandName = (p.brand && p.brand.name) ? p.brand.name : (p.brand || "Branded");

                const art = getArtClass(catName, subName);
                const specParts = (p.specs || "").split("|").map(s => s.trim()).filter(s => s.length > 0).slice(0, 3);
                const pillsHtml = specParts.map(s => `<span class="unimart-spec-tag">${s}</span>`).join("");
                const detailUrl = `/product-details?id=${p.id}`;

                html += `
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="unimart-product-card">
                            <div class="unimart-card-media ${art.cls}">
                                <div class="card-badge-top-left">
                                    ${discountPct > 0 ? `<span class="badge-discount">-${discountPct}%</span>` : ''}
                                    <span class="badge-brand">${brandName}</span>
                                </div>
                                <div class="card-badge-top-right">
                                    <span class="badge-stock"><span class="pulse-dot-green"></span> In Stock</span>
                                </div>
                                <div class="card-media-center">
                                    <i class="bi ${art.icon} product-art-icon"></i>
                                </div>
                                <div class="card-hover-actions">
                                    <a href="${detailUrl}" class="card-quick-action-btn" title="View Specifications">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button type="button" class="card-quick-action-btn btn-add-enquiry" data-id="${p.id}" data-name="${p.name}" data-price="${sPrice}" title="Add to Enquiry">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="unimart-card-body">
                                <div class="card-cat-label">${subName || catName || 'Hardware'}</div>
                                <a href="${detailUrl}" class="unimart-product-title" title="${p.name}">${p.name}</a>
                                
                                <div class="card-rating-strip mb-2">
                                    <span class="text-warning small">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                    <span class="rating-num ms-1">4.9</span>
                                    <span class="rating-count text-muted">(24)</span>
                                </div>

                                <div class="unimart-specs-row mb-3">
                                    ${pillsHtml}
                                </div>

                                <div class="card-footer-pricing pt-2 border-top">
                                    <div class="d-flex align-items-baseline justify-content-between mb-2">
                                        <div>
                                            <div class="unimart-price-current">₹${sPrice.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</div>
                                            ${mPrice > sPrice ? `<div class="unimart-price-mrp">MRP: ₹${mPrice.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</div>` : ''}
                                        </div>
                                        ${savings > 0 ? `<span class="badge-savings">Save ₹${savings.toLocaleString('en-IN')}</span>` : ''}
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-sm btn-add-enquiry py-2 fw-semibold" data-id="${p.id}" data-name="${p.name}" data-price="${sPrice}">
                                            <i class="bi bi-cart-plus me-1"></i> Add to Quote
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            grid.innerHTML = html;
        }

        // Tabs click listener
        document.querySelectorAll("#home-featured-filter-tabs button").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll("#home-featured-filter-tabs button").forEach(b => {
                    b.classList.remove("active");
                });
                btn.classList.add("active");
                renderFeatured(btn.getAttribute("data-filter"));
            });
        });

        // 2. PC Finder Budget Wizard Interaction
        const presetConfigs = {
            "gaming-budget": { id: "PROD-2001", title: "Hari Om Entry Gaming PC", price: "₹34,990", specs: "Intel Core i3 12th Gen | 16GB RAM | 512GB NVMe SSD | GTX 1650 4GB | 450W PSU" },
            "gaming-mid": { id: "PROD-2003", title: "Hari Om Beast 14th Gen Gaming PC", price: "₹72,990", specs: "Intel Core i5 14400F | B760 WiFi | 16GB DDR5 5600MHz | 1TB Gen4 NVMe | 8GB RTX 4060 | 650W PSU" },
            "gaming-high": { id: "PROD-2004", title: "Hari Om Ultra RTX 4070 Super Rig", price: "₹1,24,990", specs: "Intel Core i7 14700F | 32GB DDR5 | 1TB Samsung 990 Pro | 12GB RTX 4070 Super | 750W Gold PSU" },
            "gaming-extreme": { id: "PROD-2004", title: "Hari Om Titan 4K RTX 4080 Rig", price: "₹1,95,000", specs: "AMD Ryzen 7 7800X3D | 32GB DDR5 6000MHz | 2TB Gen4 SSD | 16GB RTX 4080 Super | 360mm AIO" },

            "editing-budget": { id: "PROD-2002", title: "Hari Om Creator Start 1080p PC", price: "₹39,990", specs: "Intel Core i5 13400 | 16GB DDR4 | 1TB NVMe Gen4 | UHD 730 Graphics | 500W PSU" },
            "editing-mid": { id: "PROD-2003", title: "Hari Om Studio DaVinci Edition", price: "₹78,490", specs: "Intel Core i5 14500 | 32GB DDR5 | 1TB Gen4 SSD | 8GB RTX 4060 | 650W PSU" },
            "editing-high": { id: "PROD-2004", title: "Hari Om Creator 4K Video Workstation", price: "₹1,49,990", specs: "Intel Core i7 14700K | Z790 DDR5 | 32GB DDR5 | 2TB Samsung 990 Pro | 12GB RTX 4070 | 850W Gold PSU" },
            "editing-extreme": { id: "PROD-2004", title: "Hari Om Master 8K Production Rig", price: "₹2,45,000", specs: "Intel Core i9 14900K | 64GB DDR5 | 4TB NVMe SSD | 16GB RTX 4080 Super | Custom Liquid Loop" },

            "office-budget": { id: "PROD-2001", title: "Hari Om Pro Office PC i3", price: "₹21,990", specs: "Intel Core i3 12100 | H610M | 8GB DDR4 | 512GB NVMe SSD | 450W SMPS | Slim Office Case" },
            "office-mid": { id: "PROD-2002", title: "Hari Om Business Tower i5", price: "₹39,990", specs: "Intel Core i5 13400 | B760M | 16GB DDR5 | 1TB NVMe | 550W PSU | Antec Case" },
            "office-high": { id: "PROD-2004", title: "Hari Om Executive Workstation", price: "₹65,000", specs: "Intel Core i7 13700 | 32GB DDR5 | 1TB NVMe SSD | 550W Gold PSU | Dual Monitor Ready" },
            "office-extreme": { id: "PROD-2004", title: "Hari Om Enterprise Dual-Server", price: "₹1,20,000", specs: "Intel Xeon / Core i9 | 64GB ECC RAM | RAID 1 4TB Storage | Redundant PSU" },

            "student-budget": { id: "PROD-1005", title: "Acer Aspire 5 Slim Student Laptop", price: "₹40,990", specs: "Intel Core i5 1335U | 8GB DDR5 | 512GB SSD | 15.6 FHD IPS | WiFi 6E" },
            "student-mid": { id: "PROD-1001", title: "Dell Inspiron 15 Coding Edition", price: "₹47,990", specs: "Intel Core i5 12th Gen | 16GB RAM | 512GB SSD | 15.6 120Hz FHD | Win 11 + MS Office" },
            "student-high": { id: "PROD-1004", title: "ASUS TUF Gaming F15 Student Powerhouse", price: "₹54,990", specs: "Intel Core i5 11400H | 16GB DDR4 | 512GB SSD | 4GB RTX 3050 | 144Hz FHD" },
            "student-extreme": { id: "PROD-1006", title: "ASUS ROG Strix G16 High-End Laptop", price: "₹1,08,990", specs: "Intel Core i7 13650HX | 16GB DDR5 | 1TB Gen4 SSD | 6GB RTX 4050 | 165Hz FHD+" }
        };

        let selectedUse = "gaming";
        let selectedBudget = "mid";

        function updateWizard() {
            const key = `${selectedUse}-${selectedBudget}`;
            const config = presetConfigs[key] || presetConfigs["gaming-mid"];

            document.getElementById("rec-title").innerText = config.title;
            document.getElementById("rec-price").innerText = config.price;
            document.getElementById("rec-specs").innerText = config.specs;

            const addBtn = document.getElementById("rec-add-btn");
            addBtn.onclick = () => {
                if (typeof DataStore !== 'undefined' && DataStore.addToEnquiryCart) {
                    DataStore.addToEnquiryCart(config.id, 1, {
                        name: config.title,
                        price: Number(config.price.replace(/[^0-9]/g, '')),
                        specs: config.specs
                    });
                }
                if (typeof HOC_UTILS !== 'undefined' && HOC_UTILS.showToast) {
                    HOC_UTILS.showToast(`${config.title} added to your Enquiry Cart!`);
                } else if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Quote!',
                        text: `${config.title} has been added to your Enquiry Cart.`,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            };
        }

        document.querySelectorAll("#wizard-usecase-group button").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll("#wizard-usecase-group button").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                selectedUse = btn.getAttribute("data-use");
                updateWizard();
            });
        });

        document.querySelectorAll("#wizard-budget-group button").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll("#wizard-budget-group button").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                selectedBudget = btn.getAttribute("data-budget");
                updateWizard();
            });
        });

        updateWizard();
    });
</script>
@endpush

@extends('shop.includes.app')

@section('content')
<!-- =========================================================================
     1. HERO SHOWCASE SECTION ("BUILD YOUR DREAM PC")
     ========================================================================= -->
<section class="pcmart-hero-section py-4 py-lg-5">
    <div class="container">
        <div class="pcmart-hero-card position-relative overflow-hidden rounded-4">
            <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
                <!-- Left Column: Title, Subtitle, CTA Buttons & 4 Feature Badges -->
                <div class="col-lg-5 col-12 text-white ps-lg-5 py-4">
                    <span class="hero-tech-tag mb-2 d-inline-block text-uppercase fw-bold">CUSTOM PC BUILDER &mdash;</span>
                    
                    <h1 class="hero-main-title display-4 fw-black text-white mb-3">
                        BUILD YOUR <br>
                        <span class="hero-highlight-cyan">DREAM PC</span>
                    </h1>

                    <p class="hero-subtitle text-light text-opacity-80 mb-4 lead">
                        Choose components. Check compatibility. Get the best performance for your budget.
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <a href="{{ route('pc.builder') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-3 fw-bold d-flex align-items-center gap-2 shadow-lg">
                            <span>Start Building</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#popular-pc-builds" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold">
                            View Popular Builds
                        </a>
                    </div>

                    <!-- 4 Trust / Spec Metrics below buttons -->
                    <div class="row g-3 pt-3 border-top border-white border-opacity-15 small">
                        <div class="col-6 d-flex align-items-center gap-2">
                            <i class="bi bi-patch-check-fill text-info fs-5"></i>
                            <span class="text-light text-opacity-90">100% Compatible Parts</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-2">
                            <i class="bi bi-calculator-fill text-info fs-5"></i>
                            <span class="text-light text-opacity-90">Real-time Price Calculation</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-2">
                            <i class="bi bi-lightning-charge-fill text-info fs-5"></i>
                            <span class="text-light text-opacity-90">Power Consumption Estimation</span>
                        </div>
                        <div class="col-6 d-flex align-items-center gap-2">
                            <i class="bi bi-share-fill text-info fs-5"></i>
                            <span class="text-light text-opacity-90">Save & Share Your Build</span>
                        </div>
                    </div>
                </div>

                <!-- Center Column: Photorealistic Liquid-Cooled RGB Rig -->
                <div class="col-lg-4 col-12 text-center py-3">
                    <div class="hero-rig-wrapper position-relative">
                        <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="Custom Gaming PC Rig" class="img-fluid rounded-4 shadow-2xl hero-chassis-image">
                    </div>
                </div>

                <!-- Right Column: Interactive Hardware Checklist Stack (Reference Design) -->
                <div class="col-lg-3 col-12 pe-lg-5 py-3">
                    <div class="hardware-stack-card p-3 rounded-4 bg-dark bg-opacity-75 border border-white border-opacity-15">
                        <div class="hardware-stack-list d-flex flex-column gap-2">
                            <!-- CPU -->
                            <a href="{{ route('components', ['sub' => 'Processor']) }}" class="stack-item d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none">
                                <div class="stack-icon-box"><i class="bi bi-cpu text-info fs-5"></i></div>
                                <div>
                                    <div class="stack-item-title text-white fw-bold">CPU</div>
                                    <div class="stack-item-sub text-muted small">Intel / AMD</div>
                                </div>
                            </a>
                            <!-- GPU -->
                            <a href="{{ route('components', ['sub' => 'Graphics Card']) }}" class="stack-item d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none">
                                <div class="stack-icon-box"><i class="bi bi-gpu-card text-warning fs-5"></i></div>
                                <div>
                                    <div class="stack-item-title text-white fw-bold">GPU</div>
                                    <div class="stack-item-sub text-muted small">NVIDIA / AMD</div>
                                </div>
                            </a>
                            <!-- RAM -->
                            <a href="{{ route('components', ['sub' => 'RAM']) }}" class="stack-item d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none">
                                <div class="stack-icon-box"><i class="bi bi-memory text-primary fs-5"></i></div>
                                <div>
                                    <div class="stack-item-title text-white fw-bold">RAM</div>
                                    <div class="stack-item-sub text-muted small">DDR4 / DDR5</div>
                                </div>
                            </a>
                            <!-- Storage -->
                            <a href="{{ route('components', ['sub' => 'SSD']) }}" class="stack-item d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none">
                                <div class="stack-icon-box"><i class="bi bi-device-ssd text-secondary fs-5"></i></div>
                                <div>
                                    <div class="stack-item-title text-white fw-bold">Storage</div>
                                    <div class="stack-item-sub text-muted small">NVMe / SSD / HDD</div>
                                </div>
                            </a>
                            <!-- Power Supply -->
                            <a href="{{ route('components', ['sub' => 'SMPS/PSU']) }}" class="stack-item d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none">
                                <div class="stack-icon-box"><i class="bi bi-plug text-danger fs-5"></i></div>
                                <div>
                                    <div class="stack-item-title text-white fw-bold">Power Supply</div>
                                    <div class="stack-item-sub text-muted small">ATX / SFX</div>
                                </div>
                            </a>
                            <!-- Cabinet -->
                            <a href="{{ route('computers') }}" class="stack-item d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none">
                                <div class="stack-icon-box"><i class="bi bi-pc fs-5 text-info"></i></div>
                                <div>
                                    <div class="stack-item-title text-white fw-bold">Cabinet</div>
                                    <div class="stack-item-sub text-muted small">ATX / mATX / ITX</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Background Ambient Glow Circles -->
            <div class="hero-glow-blob blob-1"></div>
            <div class="hero-glow-blob blob-2"></div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. HARDWARE CATEGORY ICON STRIP (10 DEPARTMENTS - REFERENCE DESIGN)
     ========================================================================= -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 row-cols-lg-10 g-3 text-center">
            <!-- 1. Processors -->
            <div class="col">
                <a href="{{ route('components', ['sub' => 'Processor']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-cpu fs-2 text-primary"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Processors</span>
                </a>
            </div>
            <!-- 2. Graphics Cards -->
            <div class="col">
                <a href="{{ route('components', ['sub' => 'Graphics Card']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-gpu-card fs-2 text-warning"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Graphics Cards</span>
                </a>
            </div>
            <!-- 3. Motherboards -->
            <div class="col">
                <a href="{{ route('components', ['sub' => 'Motherboard']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-motherboard fs-2 text-info"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Motherboards</span>
                </a>
            </div>
            <!-- 4. RAM Memory -->
            <div class="col">
                <a href="{{ route('components', ['sub' => 'RAM']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-memory fs-2 text-success"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">RAM Memory</span>
                </a>
            </div>
            <!-- 5. Storage -->
            <div class="col">
                <a href="{{ route('components', ['sub' => 'SSD']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-device-ssd fs-2 text-secondary"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Storage (SSD/HDD)</span>
                </a>
            </div>
            <!-- 6. Power Supply -->
            <div class="col">
                <a href="{{ route('components', ['sub' => 'SMPS/PSU']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-plug fs-2 text-danger"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Power Supply</span>
                </a>
            </div>
            <!-- 7. PC Cabinets -->
            <div class="col">
                <a href="{{ route('computers') }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-pc fs-2 text-dark"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">PC Cabinets</span>
                </a>
            </div>
            <!-- 8. CPU Coolers -->
            <div class="col">
                <a href="{{ route('components') }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-fan fs-2 text-info"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">CPU Coolers</span>
                </a>
            </div>
            <!-- 9. Monitors -->
            <div class="col">
                <a href="{{ route('products', ['cat' => 'Display']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-display fs-2 text-primary"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Monitors</span>
                </a>
            </div>
            <!-- 10. Accessories -->
            <div class="col">
                <a href="{{ route('products', ['cat' => 'Accessories']) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                    <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                        <i class="bi bi-headphones fs-2 text-dark"></i>
                    </div>
                    <span class="category-pill-label text-dark fw-semibold small">Accessories</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. THREE FEATURED PROMO CARDS (ROW OF 3 - REFERENCE DESIGN)
     ========================================================================= -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Promo 1: Latest Intel Processors -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="pcmart-promo-banner promo-banner-intel rounded-4 p-4 text-white position-relative overflow-hidden h-100">
                    <div class="row align-items-center g-2 h-100 position-relative" style="z-index: 2;">
                        <div class="col-7">
                            <span class="badge-promo-tag text-uppercase fw-bold font-monospace mb-2 d-inline-block">POWER YOUR PERFORMANCE</span>
                            <h4 class="fw-bold mb-1">Latest Intel Processors</h4>
                            <p class="small text-light text-opacity-80 mb-3">13th & 14th Gen Processors for Gaming & Productivity</p>
                            <a href="{{ route('components', ['sub' => 'Processor']) }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2 fw-semibold">
                                Shop Now <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/promo_builder.jpg') }}" alt="Intel Processors" class="img-fluid rounded-3 shadow-sm promo-box-img">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promo 2: GeForce RTX 40 Series -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="pcmart-promo-banner promo-banner-nvidia rounded-4 p-4 text-white position-relative overflow-hidden h-100">
                    <div class="row align-items-center g-2 h-100 position-relative" style="z-index: 2;">
                        <div class="col-7">
                            <span class="badge-promo-tag text-uppercase fw-bold font-monospace mb-2 d-inline-block text-warning">ULTIMATE GAMING POWER</span>
                            <h4 class="fw-bold mb-1">GeForce RTX 40 Series</h4>
                            <p class="small text-light text-opacity-80 mb-3">Experience next-gen gaming with AI performance</p>
                            <a href="{{ route('components', ['sub' => 'Graphics Card']) }}" class="btn btn-warning btn-sm rounded-pill px-3 py-2 fw-semibold text-dark">
                                Shop Now <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/promo_builder.jpg') }}" alt="GeForce RTX 40 Series" class="img-fluid rounded-3 shadow-sm promo-box-img">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promo 3: Pre-Built Gaming PCs -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="pcmart-promo-banner promo-banner-prebuilt rounded-4 p-4 text-white position-relative overflow-hidden h-100">
                    <div class="row align-items-center g-2 h-100 position-relative" style="z-index: 2;">
                        <div class="col-7">
                            <span class="badge-promo-tag text-uppercase fw-bold font-monospace mb-2 d-inline-block text-info">READY TO BUY?</span>
                            <h4 class="fw-bold mb-1">Pre-Built Gaming PCs</h4>
                            <p class="small text-light text-opacity-80 mb-3">High performance systems for every budget</p>
                            <a href="{{ route('computers') }}" class="btn btn-light btn-sm rounded-pill px-3 py-2 fw-semibold text-primary">
                                View PCs <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="Pre-Built Gaming PCs" class="img-fluid rounded-3 shadow-sm promo-box-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. BEST SELLING COMPONENTS (6-COLUMN GRID WITH TABS - REFERENCE DESIGN)
     ========================================================================= -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold mb-0 text-dark">Best Selling Components</h3>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Filter Tabs -->
                <div class="pcmart-filter-tabs d-flex flex-wrap gap-1" id="components-filter-tabs">
                    <button class="tab-btn active" data-filter="ALL">All</button>
                    <button class="tab-btn" data-filter="Processor">Processors</button>
                    <button class="tab-btn" data-filter="Graphics Card">Graphics Cards</button>
                    <button class="tab-btn" data-filter="Motherboard">Motherboards</button>
                    <button class="tab-btn" data-filter="RAM">RAM</button>
                    <button class="tab-btn" data-filter="SSD">Storage</button>
                    <button class="tab-btn" data-filter="SMPS/PSU">Power Supply</button>
                </div>
                <a href="{{ route('components') }}" class="text-primary fw-bold text-decoration-none small d-none d-md-inline">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- 6 Component Cards Grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3" id="home-components-grid">
            <!-- 1. Intel Core i5-13600K -->
            <div class="col">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-12%</span>
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        <div class="hw-box-render hw-box-intel text-center">
                            <div class="hw-box-badge-tag bg-white text-primary mb-1">INTEL CORE</div>
                            <i class="bi bi-cpu-fill fs-2 mb-1"></i>
                            <div class="fw-bold small" style="font-size: 0.65rem;">i5-13600K</div>
                        </div>
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <a href="{{ route('components', ['sub' => 'Processor']) }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="Intel Core i5-13600K">
                            Intel Core i5-13600K
                        </a>
                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.6</span>
                            <span class="text-muted">(1.2k)</span>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹22,999</strong>
                                <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹25,999</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="101" data-name="Intel Core i5-13600K" data-price="22999">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. AMD Ryzen 7 7800X3D -->
            <div class="col">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-18%</span>
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        <div class="hw-box-render hw-box-amd text-center">
                            <div class="hw-box-badge-tag bg-warning text-dark mb-1">RYZEN 7</div>
                            <i class="bi bi-cpu-fill fs-2 text-warning mb-1"></i>
                            <div class="fw-bold small" style="font-size: 0.65rem;">7800X3D</div>
                        </div>
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <a href="{{ route('components', ['sub' => 'Processor']) }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="AMD Ryzen 7 7800X3D">
                            AMD Ryzen 7 7800X3D
                        </a>
                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.8</span>
                            <span class="text-muted">(890)</span>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹34,999</strong>
                                <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹42,999</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="102" data-name="AMD Ryzen 7 7800X3D" data-price="34999">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. ASUS GeForce RTX 4070 SUPER 12GB -->
            <div class="col">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-10%</span>
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        <div class="hw-box-render hw-box-gpu text-center">
                            <div class="hw-box-badge-tag bg-success text-white mb-1">GEFORCE RTX</div>
                            <i class="bi bi-gpu-card fs-2 text-warning mb-1"></i>
                            <div class="fw-bold small" style="font-size: 0.65rem;">4070 SUPER</div>
                        </div>
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <a href="{{ route('components', ['sub' => 'Graphics Card']) }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="ASUS GeForce RTX 4070 SUPER 12GB">
                            ASUS GeForce RTX 4070 SUPER 12GB
                        </a>
                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.7</span>
                            <span class="text-muted">(650)</span>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹59,999</strong>
                                <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹66,999</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="103" data-name="ASUS GeForce RTX 4070 SUPER 12GB" data-price="59999">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. MSI B760M Mortar WiFi -->
            <div class="col">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-15%</span>
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        <div class="hw-box-render hw-box-mb text-center">
                            <div class="hw-box-badge-tag bg-info text-dark mb-1">MOTHERBOARD</div>
                            <i class="bi bi-motherboard fs-2 text-info mb-1"></i>
                            <div class="fw-bold small" style="font-size: 0.65rem;">B760M WiFi</div>
                        </div>
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <a href="{{ route('components', ['sub' => 'Motherboard']) }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="MSI B760M Mortar WiFi">
                            MSI B760M Mortar WiFi
                        </a>
                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.5</span>
                            <span class="text-muted">(430)</span>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹16,999</strong>
                                <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹19,999</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="104" data-name="MSI B760M Mortar WiFi" data-price="16999">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Corsair Vengeance 32GB DDR5 6000MHz -->
            <div class="col">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-20%</span>
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        <div class="hw-box-render hw-box-ram text-center">
                            <div class="hw-box-ram-lightbar"></div>
                            <div class="hw-box-badge-tag bg-secondary text-white mb-1 mt-1">DDR5 RGB</div>
                            <i class="bi bi-memory fs-2 text-success mb-1"></i>
                            <div class="fw-bold small" style="font-size: 0.65rem;">32GB 6000MHz</div>
                        </div>
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <a href="{{ route('components', ['sub' => 'RAM']) }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="Corsair Vengeance 32GB DDR5 6000MHz">
                            Corsair Vengeance 32GB DDR5 6000MHz
                        </a>
                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.8</span>
                            <span class="text-muted">(920)</span>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹8,499</strong>
                                <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹10,999</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="105" data-name="Corsair Vengeance 32GB DDR5 6000MHz" data-price="8499">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Samsung 1TB 990 PRO NVMe SSD -->
            <div class="col">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-17%</span>
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        <div class="hw-box-render hw-box-ssd text-center">
                            <div class="hw-box-badge-tag bg-danger text-white mb-1">NVMe PCIe 4.0</div>
                            <i class="bi bi-device-ssd fs-2 text-danger mb-1"></i>
                            <div class="fw-bold small" style="font-size: 0.65rem;">990 PRO 1TB</div>
                        </div>
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <a href="{{ route('components', ['sub' => 'SSD']) }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="Samsung 1TB 990 PRO NVMe SSD">
                            Samsung 1TB 990 PRO NVMe SSD
                        </a>
                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.9</span>
                            <span class="text-muted">(1.1k)</span>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹7,999</strong>
                                <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹9,699</span>
                            </div>
                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="106" data-name="Samsung 1TB 990 PRO NVMe SSD" data-price="7999">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. POPULAR PC BUILDS (4 TIERED CARDS - REFERENCE DESIGN)
     ========================================================================= -->
<section class="py-5 bg-light" id="popular-pc-builds">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0 text-dark">Popular PC Builds</h3>
            </div>
            <a href="{{ route('computers') }}" class="text-primary fw-bold text-decoration-none small">
                View All Builds <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            <!-- 1. Budget Gaming PC -->
            <div class="col-lg-3 col-md-6 col-12">
                <div class="pcmart-build-card card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Budget Gaming PC</h5>
                            <span class="text-muted small">Great performance under budget</span>
                        </div>
                    </div>
                    <div class="build-price-tag mb-3">
                        <strong class="fs-4 text-primary fw-black">₹50,000</strong>
                    </div>

                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-7">
                            <ul class="list-unstyled d-flex flex-column gap-1 small text-secondary mb-0" style="font-size: 0.78rem;">
                                <li><i class="bi bi-cpu text-primary me-1"></i> Ryzen 5 5600</li>
                                <li><i class="bi bi-gpu-card text-warning me-1"></i> RTX 3050 8GB</li>
                                <li><i class="bi bi-memory text-info me-1"></i> 16GB DDR4</li>
                                <li><i class="bi bi-device-ssd text-success me-1"></i> 1TB NVMe SSD</li>
                                <li><i class="bi bi-plug text-danger me-1"></i> 550W PSU</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="Budget Rig" class="img-fluid rounded-3 shadow-sm build-thumb-img">
                        </div>
                    </div>

                    <a href="{{ route('computers') }}" class="btn btn-primary btn-sm w-100 rounded-pill fw-bold mt-auto">
                        View Build &rarr;
                    </a>
                </div>
            </div>

            <!-- 2. Mid-Range Gaming PC -->
            <div class="col-lg-3 col-md-6 col-12">
                <div class="pcmart-build-card card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Mid-Range Gaming PC</h5>
                            <span class="text-muted small">Most popular build</span>
                        </div>
                    </div>
                    <div class="build-price-tag mb-3">
                        <strong class="fs-4 text-primary fw-black">₹75,000</strong>
                    </div>

                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-7">
                            <ul class="list-unstyled d-flex flex-column gap-1 small text-secondary mb-0" style="font-size: 0.78rem;">
                                <li><i class="bi bi-cpu text-primary me-1"></i> Ryzen 7 7700</li>
                                <li><i class="bi bi-gpu-card text-warning me-1"></i> RTX 4060 8GB</li>
                                <li><i class="bi bi-memory text-info me-1"></i> 32GB DDR5</li>
                                <li><i class="bi bi-device-ssd text-success me-1"></i> 1TB NVMe SSD</li>
                                <li><i class="bi bi-plug text-danger me-1"></i> 650W PSU</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="Mid-Range Rig" class="img-fluid rounded-3 shadow-sm build-thumb-img">
                        </div>
                    </div>

                    <a href="{{ route('computers') }}" class="btn btn-primary btn-sm w-100 rounded-pill fw-bold mt-auto">
                        View Build &rarr;
                    </a>
                </div>
            </div>

            <!-- 3. High-End Gaming PC -->
            <div class="col-lg-3 col-md-6 col-12">
                <div class="pcmart-build-card card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">High-End Gaming PC</h5>
                            <span class="text-muted small">Ultimate gaming performance</span>
                        </div>
                    </div>
                    <div class="build-price-tag mb-3">
                        <strong class="fs-4 text-success fw-black">₹1,50,000</strong>
                    </div>

                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-7">
                            <ul class="list-unstyled d-flex flex-column gap-1 small text-secondary mb-0" style="font-size: 0.78rem;">
                                <li><i class="bi bi-cpu text-primary me-1"></i> Ryzen 7 7800X3D</li>
                                <li><i class="bi bi-gpu-card text-warning me-1"></i> RTX 4070 Ti 12GB</li>
                                <li><i class="bi bi-memory text-info me-1"></i> 32GB DDR5</li>
                                <li><i class="bi bi-device-ssd text-success me-1"></i> 2TB NVMe SSD</li>
                                <li><i class="bi bi-plug text-danger me-1"></i> 750W PSU</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="High-End Rig" class="img-fluid rounded-3 shadow-sm build-thumb-img">
                        </div>
                    </div>

                    <a href="{{ route('computers') }}" class="btn btn-primary btn-sm w-100 rounded-pill fw-bold mt-auto">
                        View Build &rarr;
                    </a>
                </div>
            </div>

            <!-- 4. Creator Workstation -->
            <div class="col-lg-3 col-md-6 col-12">
                <div class="pcmart-build-card card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Creator Workstation</h5>
                            <span class="text-muted small">For professionals</span>
                        </div>
                    </div>
                    <div class="build-price-tag mb-3">
                        <strong class="fs-4 text-primary fw-black">₹1,20,000</strong>
                    </div>

                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-7">
                            <ul class="list-unstyled d-flex flex-column gap-1 small text-secondary mb-0" style="font-size: 0.78rem;">
                                <li><i class="bi bi-cpu text-primary me-1"></i> Ryzen 9 7900</li>
                                <li><i class="bi bi-gpu-card text-warning me-1"></i> RTX 4070 12GB</li>
                                <li><i class="bi bi-memory text-info me-1"></i> 64GB DDR5</li>
                                <li><i class="bi bi-device-ssd text-success me-1"></i> 2TB NVMe SSD</li>
                                <li><i class="bi bi-plug text-danger me-1"></i> 750W PSU</li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('assets/images/hero_gaming_pc.jpg') }}" alt="Creator Workstation" class="img-fluid rounded-3 shadow-sm build-thumb-img">
                        </div>
                    </div>

                    <a href="{{ route('computers') }}" class="btn btn-primary btn-sm w-100 rounded-pill fw-bold mt-auto">
                        View Build &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. TOP BRANDS STRIP (10 BRAND LOGOS - REFERENCE DESIGN)
     ========================================================================= -->
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0 text-dark">Top Brands</h4>
            <a href="{{ route('products') }}" class="text-primary fw-bold text-decoration-none small">
                View All Brands &rarr;
            </a>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 row-cols-lg-10 g-3 align-items-center text-center">
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-primary fs-5 font-monospace">intel</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-danger fs-5 font-monospace">AMD</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-success fs-5 font-monospace">NVIDIA</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-info fs-5 font-monospace">ASUS</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-danger fs-5 font-monospace">msi</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-primary fs-5 font-monospace">GIGABYTE</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-dark fs-5 font-monospace">ASRock</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-warning fs-5 font-monospace">CORSAIR</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-primary fs-5 font-monospace">SAMSUNG</strong>
                </div>
            </div>
            <div class="col">
                <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                    <strong class="text-dark fs-5 font-monospace">WD</strong>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Tab filtering logic for Best Selling Components
        const tabs = document.querySelectorAll("#components-filter-tabs button");
        const cardsGrid = document.getElementById("home-components-grid");

        const sampleComponents = [
            { id: "PROD-101", name: "Intel Core i5-13600K", sub: "Processor", price: 22999, mrp: 25999, discount: 12, rating: 4.6, reviews: "1.2k" },
            { id: "PROD-102", name: "AMD Ryzen 7 7800X3D", sub: "Processor", price: 34999, mrp: 42999, discount: 18, rating: 4.8, reviews: "890" },
            { id: "PROD-103", name: "ASUS GeForce RTX 4070 SUPER 12GB", sub: "Graphics Card", price: 59999, mrp: 66999, discount: 10, rating: 4.7, reviews: "650" },
            { id: "PROD-104", name: "MSI B760M Mortar WiFi", sub: "Motherboard", price: 16999, mrp: 19999, discount: 15, rating: 4.5, reviews: "430" },
            { id: "PROD-105", name: "Corsair Vengeance 32GB DDR5 6000MHz", sub: "RAM", price: 8499, mrp: 10999, discount: 20, rating: 4.8, reviews: "920" },
            { id: "PROD-106", name: "Samsung 1TB 990 PRO NVMe SSD", sub: "SSD", price: 7999, mrp: 9699, discount: 17, rating: 4.9, reviews: "1.1k" },
            { id: "PROD-107", name: "DeepCool 750W Gold Modular SMPS", sub: "SMPS/PSU", price: 6999, mrp: 8499, discount: 15, rating: 4.7, reviews: "380" },
            { id: "PROD-108", name: "Antec C8 Curve Panoramic Cabinet", sub: "Cabinet", price: 8999, mrp: 11499, discount: 22, rating: 4.9, reviews: "520" }
        ];

        function getBoxRenderHtml(item) {
            if (item.sub === "Processor" && item.name.includes("Intel")) {
                return `
                    <div class="hw-box-render hw-box-intel text-center">
                        <div class="hw-box-badge-tag bg-white text-primary mb-1">INTEL CORE</div>
                        <i class="bi bi-cpu-fill fs-2 mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${item.name.replace('Intel Core ', '')}</div>
                    </div>`;
            } else if (item.sub === "Processor") {
                return `
                    <div class="hw-box-render hw-box-amd text-center">
                        <div class="hw-box-badge-tag bg-warning text-dark mb-1">RYZEN</div>
                        <i class="bi bi-cpu-fill fs-2 text-warning mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${item.name.replace('AMD ', '')}</div>
                    </div>`;
            } else if (item.sub === "Graphics Card") {
                return `
                    <div class="hw-box-render hw-box-gpu text-center">
                        <div class="hw-box-badge-tag bg-success text-white mb-1">GEFORCE RTX</div>
                        <i class="bi bi-gpu-card fs-2 text-warning mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">RTX 40-SERIES</div>
                    </div>`;
            } else if (item.sub === "Motherboard") {
                return `
                    <div class="hw-box-render hw-box-mb text-center">
                        <div class="hw-box-badge-tag bg-info text-dark mb-1">MOTHERBOARD</div>
                        <i class="bi bi-motherboard fs-2 text-info mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">CHIPSET PRO</div>
                    </div>`;
            } else if (item.sub === "RAM") {
                return `
                    <div class="hw-box-render hw-box-ram text-center">
                        <div class="hw-box-ram-lightbar"></div>
                        <div class="hw-box-badge-tag bg-secondary text-white mb-1 mt-1">DDR5 RGB</div>
                        <i class="bi bi-memory fs-2 text-success mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">HIGH SPEED</div>
                    </div>`;
            } else if (item.sub === "SSD") {
                return `
                    <div class="hw-box-render hw-box-ssd text-center">
                        <div class="hw-box-badge-tag bg-danger text-white mb-1">NVMe PCIe 4.0</div>
                        <i class="bi bi-device-ssd fs-2 text-danger mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">GEN4 SSD</div>
                    </div>`;
            } else if (item.sub === "SMPS/PSU") {
                return `
                    <div class="hw-box-render bg-dark text-white border text-center">
                        <div class="hw-box-badge-tag bg-warning text-dark mb-1">80+ GOLD PSU</div>
                        <i class="bi bi-plug fs-2 text-danger mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">MODULAR POWER</div>
                    </div>`;
            } else {
                return `
                    <div class="hw-box-render bg-light text-dark border text-center">
                        <i class="bi bi-pc fs-2 text-primary mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${item.sub}</div>
                    </div>`;
            }
        }

        function renderComponents(filter = "ALL") {
            let filtered = filter === "ALL" ? sampleComponents.slice(0, 6) : sampleComponents.filter(c => c.sub === filter);
            if (filtered.length === 0) filtered = sampleComponents.slice(0, 6);

            let html = "";
            filtered.forEach(c => {
                html += `
                    <div class="col">
                        <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white">
                            <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                                <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-${c.discount}%</span>
                                <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                                    <i class="bi bi-heart fs-6"></i>
                                </button>
                            </div>

                            <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                                ${getBoxRenderHtml(c)}
                            </div>

                            <div class="card-body p-2 d-flex flex-column">
                                <a href="/product-details?id=${c.id}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="${c.name}">
                                    ${c.name}
                                </a>

                                <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                                    <i class="bi bi-star-fill"></i>
                                    <span class="text-dark fw-bold ms-1">${c.rating}</span>
                                    <span class="text-muted">(${c.reviews})</span>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex align-items-baseline gap-1 mb-2">
                                        <strong class="fs-6 text-dark fw-black">₹${c.price.toLocaleString('en-IN')}</strong>
                                        <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹${c.mrp.toLocaleString('en-IN')}</span>
                                    </div>

                                    <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="${c.id}" data-name="${c.name}" data-price="${c.price}">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            cardsGrid.innerHTML = html;
        }

        tabs.forEach(btn => {
            btn.addEventListener("click", () => {
                tabs.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                renderComponents(btn.getAttribute("data-filter"));
            });
        });
    });
</script>
@endpush

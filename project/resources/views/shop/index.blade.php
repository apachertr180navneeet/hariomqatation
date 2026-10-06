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
                        <span class="visually-hidden">HARI OM COMPUTER - Build Your Dream Computer</span>
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
     2. HARDWARE CATEGORY ICON STRIP (DYNAMIC FROM DATABASE)
     ========================================================================= -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 row-cols-lg-{{ min(10, count($categories) ?: 5) }} g-3 text-center justify-content-center">
            @forelse($categories as $cat)
                <div class="col">
                    <a href="{{ route('products', ['cat' => $cat->name]) }}" class="pcmart-category-pill text-decoration-none d-flex flex-column align-items-center">
                        <div class="category-pill-box bg-light border rounded-3 p-3 mb-2">
                            <i class="bi {{ $cat->icon ?: 'bi-pc' }} fs-2 text-primary"></i>
                        </div>
                        <span class="category-pill-label text-dark fw-semibold small">{{ $cat->name }}</span>
                        @if(isset($cat->products_count) && $cat->products_count > 0)
                            <span class="text-muted" style="font-size: 0.68rem;">{{ $cat->products_count }} Items</span>
                        @endif
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted small">No categories available.</div>
            @endforelse
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
     4. BEST SELLING COMPONENTS (DYNAMIC FROM DATABASE)
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
                    <button class="tab-btn" data-filter="Graphics">Graphics Cards</button>
                    <button class="tab-btn" data-filter="Motherboard">Motherboards</button>
                    <button class="tab-btn" data-filter="RAM">RAM</button>
                    <button class="tab-btn" data-filter="SSD">Storage</button>
                    <button class="tab-btn" data-filter="SMPS">Power Supply</button>
                </div>
                <a href="{{ route('components') }}" class="text-primary fw-bold text-decoration-none small d-none d-md-inline">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Dynamic Component Cards Grid from MySQL -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3" id="home-components-grid">
            @forelse($componentProducts as $product)
                @php
                    $discountPct = ($product->mrp && $product->mrp > $product->selling_price) ? round((($product->mrp - $product->selling_price) / $product->mrp) * 100) : 0;
                    $subName = $product->subcategory->name ?? $product->category->name ?? 'Hardware';
                    $nameLower = strtolower($product->name);
                    $detailUrl = route('product.details', ['id' => $product->id]);
                @endphp
                <div class="col home-component-card" data-sub="{{ $subName }}">
                    <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white shadow-xs">
                        <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                            @if($discountPct > 0)
                                <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-{{ $discountPct }}%</span>
                            @else
                                <span class="badge bg-light text-muted border" style="font-size: 0.65rem;">GENUINE</span>
                            @endif
                            <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist" type="button">
                                <i class="bi bi-heart fs-6"></i>
                            </button>
                        </div>
                        <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                            @if(str_contains(strtolower($subName), 'processor') && str_contains($nameLower, 'intel'))
                                <div class="hw-box-render hw-box-intel text-center">
                                    <div class="hw-box-badge-tag bg-white text-primary mb-1">INTEL CORE</div>
                                    <i class="bi bi-cpu-fill fs-2 mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'Intel' }}</div>
                                </div>
                            @elseif(str_contains(strtolower($subName), 'processor'))
                                <div class="hw-box-render hw-box-amd text-center">
                                    <div class="hw-box-badge-tag bg-warning text-dark mb-1">RYZEN</div>
                                    <i class="bi bi-cpu-fill fs-2 text-warning mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'AMD' }}</div>
                                </div>
                            @elseif(str_contains(strtolower($subName), 'graphics') || str_contains(strtolower($subName), 'gpu'))
                                <div class="hw-box-render hw-box-gpu text-center">
                                    <div class="hw-box-badge-tag bg-success text-white mb-1">GEFORCE RTX</div>
                                    <i class="bi bi-gpu-card fs-2 text-warning mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'GPU' }}</div>
                                </div>
                            @elseif(str_contains(strtolower($subName), 'motherboard'))
                                <div class="hw-box-render hw-box-mb text-center">
                                    <div class="hw-box-badge-tag bg-info text-dark mb-1">MOTHERBOARD</div>
                                    <i class="bi bi-motherboard fs-2 text-info mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'CHIPSET' }}</div>
                                </div>
                            @elseif(str_contains(strtolower($subName), 'ram') || str_contains(strtolower($subName), 'memory'))
                                <div class="hw-box-render hw-box-ram text-center">
                                    <div class="hw-box-ram-lightbar"></div>
                                    <div class="hw-box-badge-tag bg-secondary text-white mb-1 mt-1">DDR4 / DDR5</div>
                                    <i class="bi bi-memory fs-2 text-success mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'RAM' }}</div>
                                </div>
                            @elseif(str_contains(strtolower($subName), 'ssd') || str_contains(strtolower($subName), 'storage'))
                                <div class="hw-box-render hw-box-ssd text-center">
                                    <div class="hw-box-badge-tag bg-danger text-white mb-1">NVMe SSD</div>
                                    <i class="bi bi-device-ssd fs-2 text-danger mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'STORAGE' }}</div>
                                </div>
                            @elseif(str_contains(strtolower($subName), 'smps') || str_contains(strtolower($subName), 'psu') || str_contains(strtolower($subName), 'power'))
                                <div class="hw-box-render bg-dark text-white border text-center">
                                    <div class="hw-box-badge-tag bg-warning text-dark mb-1">80+ GOLD PSU</div>
                                    <i class="bi bi-plug fs-2 text-danger mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'POWER' }}</div>
                                </div>
                            @else
                                <div class="hw-box-render bg-light text-dark border text-center">
                                    <i class="bi bi-cpu fs-2 text-primary mb-1"></i>
                                    <div class="fw-bold small" style="font-size: 0.65rem;">{{ $subName }}</div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-2 d-flex flex-column">
                            <a href="{{ $detailUrl }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="{{ $product->name }}">
                                {{ $product->name }}
                            </a>
                            <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                                <i class="bi bi-star-fill"></i>
                                <span class="text-dark fw-bold ms-1">4.8</span>
                                <span class="text-muted">(1.2k)</span>
                            </div>
                            <div class="mt-auto">
                                <div class="d-flex align-items-baseline gap-1 mb-2">
                                    <strong class="fs-6 text-dark fw-black">₹{{ number_format($product->selling_price, 2) }}</strong>
                                    @if($product->mrp > $product->selling_price)
                                        <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹{{ number_format($product->mrp, 2) }}</span>
                                    @endif
                                </div>
                                <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" 
                                        data-id="{{ $product->id }}" 
                                        data-name="{{ $product->name }}" 
                                        data-sku="{{ $product->sku }}" 
                                        data-price="{{ $product->selling_price }}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">No components currently featured.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- =========================================================================
     5. POPULAR PC BUILDS (DYNAMIC FROM DATABASE)
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
            @forelse($popularBuilds as $pc)
                @php
                    $specParts = array_filter(array_map('trim', explode('|', $pc->specs)));
                    $specParts = array_slice($specParts, 0, 5);
                    $detailUrl = route('product.details', ['id' => $pc->id]);
                @endphp
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="pcmart-build-card card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">{{ $pc->name }}</h5>
                                <span class="text-muted small">{{ $pc->subcategory->name ?? 'Custom Rig' }}</span>
                            </div>
                        </div>
                        <div class="build-price-tag mb-3">
                            <strong class="fs-4 text-primary fw-black">₹{{ number_format($pc->selling_price, 2) }}</strong>
                        </div>

                        <div class="row g-2 align-items-center mb-3">
                            <div class="col-7">
                                <ul class="list-unstyled d-flex flex-column gap-1 small text-secondary mb-0" style="font-size: 0.78rem;">
                                    @foreach($specParts as $spec)
                                        <li><i class="bi bi-check2-circle text-primary me-1"></i> {{ $spec }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <div class="hw-box-render hw-box-desktop p-2 rounded-3 text-center shadow-xs" style="height: 100px;">
                                    <i class="bi bi-pc-display text-white fs-2 mb-1"></i>
                                    <span class="badge bg-info text-dark" style="font-size: 0.6rem;">PRO RIG</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ $detailUrl }}" class="btn btn-primary btn-sm w-100 rounded-pill fw-bold mt-auto">
                            View Build &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">No desktop builds available.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- =========================================================================
     6. TOP BRANDS STRIP (DYNAMIC FROM DATABASE)
     ========================================================================= -->
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0 text-dark">Top Brands</h4>
            <a href="{{ route('products') }}" class="text-primary fw-bold text-decoration-none small">
                View All Brands &rarr;
            </a>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3 align-items-center text-center">
            @forelse($brands as $brand)
                <div class="col">
                    <a href="{{ route('products', ['brand' => $brand->name]) }}" class="text-decoration-none">
                        <div class="pcmart-brand-box border rounded-3 p-3 bg-light">
                            <strong class="text-primary fs-5 font-monospace">{{ $brand->name }}</strong>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted small">No brands available.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    window.__SERVER_PRODUCTS__ = @json($allProductsJson ?? []);
    document.addEventListener("DOMContentLoaded", () => {
        // Tab filtering logic for Best Selling Components
        const tabs = document.querySelectorAll("#components-filter-tabs button");
        const cards = document.querySelectorAll(".home-component-card");

        tabs.forEach(btn => {
            btn.addEventListener("click", () => {
                tabs.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const filter = btn.getAttribute("data-filter") || "ALL";

                cards.forEach(card => {
                    const sub = card.getAttribute("data-sub") || "";
                    if (filter === "ALL" || sub.toLowerCase().includes(filter.toLowerCase())) {
                        card.style.display = "";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    });
</script>
@endpush

@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-4 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">CATALOG &amp; HARDWARE INVENTORY &mdash;</span>
            <h2 class="fw-black mb-0 text-white" style="font-family: var(--hoc-font-heading);">All Hardware &amp; <span class="hero-highlight-cyan">Products</span></h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-light text-opacity-75 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-info" aria-current="page">Catalog</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Catalog Main -->
<main class="container my-4">
    <!-- Mobile Filter Toggle Button -->
    <div class="d-lg-none mb-3">
        <button class="btn btn-outline-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#catalogFilterCollapse" aria-expanded="false" aria-controls="catalogFilterCollapse">
            <i class="bi bi-funnel-fill"></i>
            <span>Tap to Filter & Search Hardware</span>
        </button>
    </div>

    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 collapse d-lg-block" id="catalogFilterCollapse">
            <div class="card border rounded-4 p-3 mb-4 bg-white shadow-sm">
                <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span><i class="bi bi-funnel-fill text-primary me-1"></i> Filter Products</span>
                    <button class="btn btn-link btn-sm text-decoration-none p-0 text-muted" id="btn-reset-filters">Reset</button>
                </h6>

                <!-- Search Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-search-kw">Search Keywords</label>
                    <div class="position-relative">
                        <input type="text" id="filter-search-kw" class="form-control form-control-sm rounded-3" placeholder="e.g. RTX 4060, i5, Dell..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-category">Category</label>
                    <select id="filter-category" class="form-select form-select-sm rounded-3">
                        <option value="ALL">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}" {{ (request('cat') == $category->name || request('cat') == $category->slug) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-brand">Brand</label>
                    <select id="filter-brand" class="form-select form-select-sm rounded-3">
                        <option value="ALL">All Brands</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->name }}" {{ (request('brand') == $brand->name || request('brand') == $brand->slug) ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-price-range">Price Bracket</label>
                    <select id="filter-price-range" class="form-select form-select-sm rounded-3">
                        <option value="ALL">All Prices</option>
                        <option value="0-5000">Under ₹5,000</option>
                        <option value="5000-25000">₹5,000 - ₹25,000</option>
                        <option value="25000-50000">₹25,000 - ₹50,000</option>
                        <option value="50000-100000">₹50,000 - ₹1,00,000</option>
                        <option value="100000-999999">Above ₹1,00,000</option>
                    </select>
                </div>

                <!-- Availability -->
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="filter-in-stock-only" checked>
                    <label class="form-check-label small" for="filter-in-stock-only">In Stock Only</label>
                </div>
            </div>

            <!-- Custom PC Builder CTA box -->
            <div class="p-3 rounded-4 text-white shadow-sm" style="background: linear-gradient(135deg, #020817 0%, #061936 60%, #0b284e 100%); border: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-motherboard text-info fs-4"></i>
                    <h6 class="fw-bold mb-0 text-white">Custom PC Builder</h6>
                </div>
                <p class="small text-light text-opacity-75 mb-3">Want a tailor-made desktop rig? Use our interactive compatibility builder tool.</p>
                <a href="{{ route('pc.builder') }}" class="btn btn-sm btn-primary rounded-pill w-100 fw-bold">Build Your PC Now &rarr;</a>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-3 rounded-3 border shadow-sm">
                <div class="small fw-semibold text-dark" id="catalog-count-label">Showing all products</div>
                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted mb-0 d-none d-sm-inline" for="sort-products-select">Sort by:</label>
                    <select id="sort-products-select" class="form-select form-select-sm rounded-2" style="width: 170px;">
                        <option value="featured">Featured First</option>
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="name-asc">Name: A to Z</option>
                    </select>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 g-3" id="products-catalog-grid">
                @forelse($products as $product)
                    @php
                        $discountPct = ($product->mrp && $product->mrp > $product->selling_price) ? round((($product->mrp - $product->selling_price) / $product->mrp) * 100) : 0;
                        $detailUrl = route('product.details', ['id' => $product->id]);
                        $subLower = strtolower($product->subcategory->name ?? $product->category->name ?? '');
                        $nameLower = strtolower($product->name);
                    @endphp
                    <div class="col product-grid-item">
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
                                @if(str_contains($subLower, 'processor') && str_contains($nameLower, 'intel'))
                                    <div class="hw-box-render hw-box-intel text-center">
                                        <div class="hw-box-badge-tag bg-white text-primary mb-1">INTEL CORE</div>
                                        <i class="bi bi-cpu-fill fs-2 mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'Intel' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'processor'))
                                    <div class="hw-box-render hw-box-amd text-center">
                                        <div class="hw-box-badge-tag bg-warning text-dark mb-1">RYZEN</div>
                                        <i class="bi bi-cpu-fill fs-2 text-warning mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'AMD' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'graphics') || str_contains($subLower, 'gpu'))
                                    <div class="hw-box-render hw-box-gpu text-center">
                                        <div class="hw-box-badge-tag bg-success text-white mb-1">GRAPHICS</div>
                                        <i class="bi bi-gpu-card fs-2 text-warning mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'NVIDIA' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'motherboard'))
                                    <div class="hw-box-render hw-box-mb text-center">
                                        <div class="hw-box-badge-tag bg-info text-dark mb-1">MOTHERBOARD</div>
                                        <i class="bi bi-motherboard fs-2 text-info mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'CHIPSET' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'ram') || str_contains($subLower, 'memory'))
                                    <div class="hw-box-render hw-box-ram text-center">
                                        <div class="hw-box-ram-lightbar"></div>
                                        <div class="hw-box-badge-tag bg-secondary text-white mb-1 mt-1">DDR4 / DDR5</div>
                                        <i class="bi bi-memory fs-2 text-success mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'MEMORY' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'ssd') || str_contains($subLower, 'storage'))
                                    <div class="hw-box-render hw-box-ssd text-center">
                                        <div class="hw-box-badge-tag bg-danger text-white mb-1">NVMe SSD</div>
                                        <i class="bi bi-device-ssd fs-2 text-danger mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'FAST STORAGE' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'laptop'))
                                    <div class="hw-box-render bg-light text-primary border text-center">
                                        <i class="bi bi-laptop display-6 mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'LAPTOP' }}</div>
                                    </div>
                                @elseif(str_contains($subLower, 'desktop') || str_contains($subLower, 'computer'))
                                    <div class="hw-box-render bg-light text-primary border text-center">
                                        <i class="bi bi-pc-display display-6 mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'DESKTOP PC' }}</div>
                                    </div>
                                @else
                                    <div class="hw-box-render bg-light text-dark border text-center">
                                        <i class="bi bi-cpu-fill fs-2 text-primary mb-1"></i>
                                        <div class="fw-bold small" style="font-size: 0.65rem;">{{ $product->brand->name ?? 'HARDWARE' }}</div>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body p-2.5 d-flex flex-column">
                                <span class="text-muted small mb-1" style="font-size: 0.7rem; font-weight: 600;">{{ $product->subcategory->name ?? $product->category->name }}</span>
                                <a href="{{ $detailUrl }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </a>

                                <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                                    <i class="bi bi-star-fill"></i>
                                    <span class="text-dark fw-bold ms-1">4.8</span>
                                    <span class="text-muted">({{ $product->stock > 0 ? $product->stock . ' ready' : 'Verified' }})</span>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex align-items-baseline gap-1 mb-2">
                                        <strong class="fs-6 text-dark fw-black">₹{{ number_format($product->selling_price, 2) }}</strong>
                                        @if($product->mrp > $product->selling_price)
                                            <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹{{ number_format($product->mrp, 2) }}</span>
                                        @endif
                                    </div>

                                    <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->selling_price }}" data-sku="{{ $product->sku }}">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search text-muted fs-1 mb-3 d-block"></i>
                        <h5>No products found in catalog</h5>
                        <p class="text-muted small">Try selecting another filter or clearing keywords.</p>
                    </div>
                @endforelse
            </div>

            <!-- Server-Side Pagination Links -->
            <div class="d-flex justify-content-center mt-4" id="server-pagination-links">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const grid = document.getElementById("products-catalog-grid");
        const countLabel = document.getElementById("catalog-count-label");
        if (!grid || typeof DataStore === 'undefined') return;

        const dbProducts = @json($productsJson ?? []);
        const allProducts = (dbProducts && dbProducts.length > 0) ? dbProducts : (typeof DataStore !== 'undefined' ? DataStore.getProducts() : []);

        // Read URL Query params
        const urlParams = new URLSearchParams(window.location.search);
        const initialCat = urlParams.get("cat");
        const initialSearch = urlParams.get("search");

        if (initialCat) {
            const catSelect = document.getElementById("filter-category");
            if (initialCat.toLowerCase().includes('display')) {
                catSelect.value = "Display & Monitors";
            } else if (initialCat.toLowerCase().includes('accessories')) {
                catSelect.value = "Accessories";
            } else if (initialCat.toLowerCase().includes('networking')) {
                catSelect.value = "Networking";
            }
        }
        if (initialSearch) {
            document.getElementById("filter-search-kw").value = initialSearch;
        }

        function getBoxRenderHtml(p) {
            const sub = p.subcategory || p.category || "";
            const name = p.name || "";
            if (sub.includes("Processor") && name.includes("Intel")) {
                return `
                    <div class="hw-box-render hw-box-intel text-center">
                        <div class="hw-box-badge-tag bg-white text-primary mb-1">INTEL CORE</div>
                        <i class="bi bi-cpu-fill fs-2 mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'Intel'}</div>
                    </div>`;
            } else if (sub.includes("Processor")) {
                return `
                    <div class="hw-box-render hw-box-amd text-center">
                        <div class="hw-box-badge-tag bg-warning text-dark mb-1">RYZEN</div>
                        <i class="bi bi-cpu-fill fs-2 text-warning mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'AMD'}</div>
                    </div>`;
            } else if (sub.includes("Graphics") || sub.includes("GPU")) {
                return `
                    <div class="hw-box-render hw-box-gpu text-center">
                        <div class="hw-box-badge-tag bg-success text-white mb-1">GRAPHICS</div>
                        <i class="bi bi-gpu-card fs-2 text-warning mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'NVIDIA'}</div>
                    </div>`;
            } else if (sub.includes("Motherboard")) {
                return `
                    <div class="hw-box-render hw-box-mb text-center">
                        <div class="hw-box-badge-tag bg-info text-dark mb-1">MOTHERBOARD</div>
                        <i class="bi bi-motherboard fs-2 text-info mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'CHIPSET'}</div>
                    </div>`;
            } else if (sub.includes("RAM") || sub.includes("Memory")) {
                return `
                    <div class="hw-box-render hw-box-ram text-center">
                        <div class="hw-box-ram-lightbar"></div>
                        <div class="hw-box-badge-tag bg-secondary text-white mb-1 mt-1">DDR4 / DDR5</div>
                        <i class="bi bi-memory fs-2 text-success mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'MEMORY'}</div>
                    </div>`;
            } else if (sub.includes("SSD") || sub.includes("Storage") || sub.includes("HDD")) {
                return `
                    <div class="hw-box-render hw-box-ssd text-center">
                        <div class="hw-box-badge-tag bg-danger text-white mb-1">NVMe SSD</div>
                        <i class="bi bi-device-ssd fs-2 text-danger mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'FAST STORAGE'}</div>
                    </div>`;
            } else if (p.category === "Laptops") {
                return `
                    <div class="hw-box-render bg-light text-primary border text-center">
                        <i class="bi bi-laptop display-6 mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'LAPTOP'}</div>
                    </div>`;
            } else if (p.category === "Desktop Computers") {
                return `
                    <div class="hw-box-render bg-light text-primary border text-center">
                        <i class="bi bi-pc-display display-6 mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'DESKTOP PC'}</div>
                    </div>`;
            } else {
                return `
                    <div class="hw-box-render bg-light text-dark border text-center">
                        <i class="bi bi-cpu-fill fs-2 text-primary mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'HARDWARE'}</div>
                    </div>`;
            }
        }

        function renderList() {
            const kw = (document.getElementById("filter-search-kw").value || "").toLowerCase();
            const cat = document.getElementById("filter-category").value;
            const brand = document.getElementById("filter-brand").value;
            const priceRange = document.getElementById("filter-price-range").value;
            const inStockOnly = document.getElementById("filter-in-stock-only").checked;
            const sortVal = document.getElementById("sort-products-select").value;

            let filtered = allProducts.filter(p => {
                const matchesKw = p.name.toLowerCase().includes(kw) || (p.specs || "").toLowerCase().includes(kw) || p.brand.toLowerCase().includes(kw);
                const matchesCat = cat === "ALL" || (p.category && p.category.toLowerCase().includes(cat.toLowerCase()));
                const matchesBrand = brand === "ALL" || p.brand === brand;
                const matchesStock = !inStockOnly || p.stock > 0;

                let matchesPrice = true;
                if (priceRange !== "ALL") {
                    const [min, max] = priceRange.split("-").map(Number);
                    matchesPrice = p.sellingPrice >= min && p.sellingPrice <= max;
                }

                return matchesKw && matchesCat && matchesBrand && matchesStock && matchesPrice;
            });

            // Sorting
            if (sortVal === "price-asc") {
                filtered.sort((a, b) => a.sellingPrice - b.sellingPrice);
            } else if (sortVal === "price-desc") {
                filtered.sort((a, b) => b.sellingPrice - a.sellingPrice);
            } else if (sortVal === "name-asc") {
                filtered.sort((a, b) => a.name.localeCompare(b.name));
            }

            const paginationEl = document.getElementById("server-pagination-links");
            const isFiltered = (kw !== "" || cat !== "ALL" || brand !== "ALL" || priceRange !== "ALL" || sortVal !== "featured");
            if (paginationEl) {
                paginationEl.style.display = isFiltered ? "none" : "";
            }

            if (filtered.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search text-muted fs-1 mb-3 d-block"></i>
                        <h5>No products match your filter criteria</h5>
                        <p class="text-muted small">Try adjusting your keywords or clearing selected filters.</p>
                    </div>
                `;
                return;
            }

            let html = "";
            filtered.forEach(p => {
                const discountPct = p.mrp ? Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100) : 10;
                const detailUrl = `/product-details?id=${p.id}`;

                html += `
                    <div class="col">
                        <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white shadow-xs">
                            <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                                <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-${discountPct}%</span>
                                <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist">
                                    <i class="bi bi-heart fs-6"></i>
                                </button>
                            </div>

                            <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                                ${getBoxRenderHtml(p)}
                            </div>

                            <div class="card-body p-2.5 d-flex flex-column">
                                <span class="text-muted small mb-1" style="font-size: 0.7rem; font-weight: 600;">${p.subcategory || p.category}</span>
                                <a href="${detailUrl}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="${p.name}">
                                    ${p.name}
                                </a>

                                <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                                    <i class="bi bi-star-fill"></i>
                                    <span class="text-dark fw-bold ms-1">4.8</span>
                                    <span class="text-muted">(500+)</span>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex align-items-baseline gap-1 mb-2">
                                        <strong class="fs-6 text-dark fw-black">₹${p.sellingPrice.toLocaleString('en-IN')}</strong>
                                        ${p.mrp ? `<span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹${p.mrp.toLocaleString('en-IN')}</span>` : ''}
                                    </div>

                                    <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="${p.id}" data-name="${p.name}" data-price="${p.sellingPrice}" data-sku="${p.sku}">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            grid.innerHTML = html;
        }

        renderList();

        document.getElementById("filter-search-kw").addEventListener("input", renderList);
        document.getElementById("filter-category").addEventListener("change", renderList);
        document.getElementById("filter-brand").addEventListener("change", renderList);
        document.getElementById("filter-price-range").addEventListener("change", renderList);
        document.getElementById("filter-in-stock-only").addEventListener("change", renderList);
        document.getElementById("sort-products-select").addEventListener("change", renderList);

        document.getElementById("btn-reset-filters").addEventListener("click", () => {
            document.getElementById("filter-search-kw").value = "";
            document.getElementById("filter-category").value = "ALL";
            document.getElementById("filter-brand").value = "ALL";
            document.getElementById("filter-price-range").value = "ALL";
            document.getElementById("filter-in-stock-only").checked = false;
            document.getElementById("sort-products-select").value = "featured";
            renderList();
        });
    });
</script>
@endpush

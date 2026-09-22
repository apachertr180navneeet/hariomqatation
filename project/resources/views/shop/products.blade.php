@extends('layouts.shop')

@section('content')
<!-- Page Header Breadcrumbs -->
<div class="bg-white border-bottom py-3">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h4 class="fw-bold mb-0" id="catalog-page-title">Products Catalog</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Catalog Main -->
<main class="container my-4">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm p-3 mb-4 rounded-3 bg-white">
                <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-funnel text-primary me-1"></i> Filter Products</span>
                    <button class="btn btn-link btn-sm text-decoration-none p-0 text-muted" id="btn-reset-filters">Reset</button>
                </h6>

                <!-- Search Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-search-kw">Search Keywords</label>
                    <div class="position-relative">
                        <input type="text" id="filter-search-kw" class="form-control form-control-sm" placeholder="e.g. RTX 4060, i5, Dell..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-category">Category</label>
                    <select id="filter-category" class="form-select form-select-sm">
                        <option value="ALL">All Categories</option>
                        <option value="Laptops" {{ request('cat') == 'Laptops' ? 'selected' : '' }}>Laptops</option>
                        <option value="Desktop Computers" {{ request('cat') == 'Desktop Computers' ? 'selected' : '' }}>Desktop Computers</option>
                        <option value="Components" {{ request('cat') == 'Components' ? 'selected' : '' }}>Components (CPU/GPU/RAM)</option>
                        <option value="Display & Monitors" {{ request('cat') == 'Display' ? 'selected' : '' }}>Monitors & Displays</option>
                        <option value="Accessories" {{ request('cat') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="Networking" {{ request('cat') == 'Networking' ? 'selected' : '' }}>Networking</option>
                    </select>
                </div>

                <!-- Brand Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-brand">Brand</label>
                    <select id="filter-brand" class="form-select form-select-sm">
                        <option value="ALL">All Brands</option>
                        <option value="Dell">Dell</option>
                        <option value="HP">HP</option>
                        <option value="Lenovo">Lenovo</option>
                        <option value="ASUS">ASUS</option>
                        <option value="Acer">Acer</option>
                        <option value="Intel">Intel</option>
                        <option value="AMD">AMD</option>
                        <option value="NVIDIA">NVIDIA</option>
                        <option value="Kingston">Kingston</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Corsair">Corsair</option>
                        <option value="Logitech">Logitech</option>
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-3">
                    <label class="form-label small fw-bold" for="filter-price-range">Price Bracket</label>
                    <select id="filter-price-range" class="form-select form-select-sm">
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
            <div class="p-3 rounded-3 text-white" style="background: linear-gradient(135deg, #0284c7 0%, #0f172a 100%);">
                <h6 class="fw-bold mb-1"><i class="bi bi-cpu-fill me-1"></i> Custom PC Assembly</h6>
                <p class="small text-light text-opacity-75 mb-3">Want a tailor-made desktop rig? Use our interactive compatibility builder tool.</p>
                <a href="{{ route('pc.builder') }}" class="btn btn-sm btn-light w-100 fw-bold">Build Your PC Now</a>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-3 rounded-3 shadow-sm">
                <div class="small text-muted" id="catalog-count-label">Showing all products</div>
                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted mb-0 d-none d-sm-inline" for="sort-products-select">Sort by:</label>
                    <select id="sort-products-select" class="form-select form-select-sm" style="width: 170px;">
                        <option value="featured">Featured First</option>
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="name-asc">Name: A to Z</option>
                    </select>
                </div>
            </div>

            <div class="row g-3" id="products-catalog-grid">
                <!-- Injected dynamically by JavaScript -->
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

        const allProducts = DataStore.getProducts();

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

            countLabel.innerText = `Showing ${filtered.length} products`;

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
            function getArtClass(cat, sub) {
                if (cat === 'Laptops') return { cls: 'art-laptop', icon: 'bi-laptop' };
                if (cat === 'Desktop Computers') return { cls: 'art-desktop', icon: 'bi-pc-display' };
                if (cat === 'Display & Monitors') return { cls: 'art-monitor', icon: 'bi-display' };
                if (sub === 'Graphics Card') return { cls: 'art-gpu', icon: 'bi-gpu-card' };
                if (sub === 'Processor') return { cls: 'art-cpu', icon: 'bi-cpu' };
                if (sub === 'RAM' || sub === 'SSD') return { cls: 'art-ram', icon: 'bi-device-ssd' };
                return { cls: 'art-default', icon: 'bi-cpu-fill' };
            }

            filtered.forEach(p => {
                const discountPct = p.mrp ? Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100) : 0;
                const art = getArtClass(p.category, p.subcategory);
                const specParts = (p.specs || "").split("|").map(s => s.trim()).filter(s => s.length > 0).slice(0, 3);
                const pillsHtml = specParts.map(s => `<span class="spec-micro-pill">${s}</span>`).join("");
                const detailUrl = `${window.HOC_ROUTES.productDetails}?id=${p.id}`;

                html += `
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card-v3">
                            <div class="product-visual-art ${art.cls}">
                                ${discountPct > 0 ? `<span class="product-badge-discount">${discountPct}% OFF</span>` : ''}
                                <span class="product-badge-brand">${p.brand}</span>
                                <i class="bi ${art.icon} product-art-icon"></i>
                            </div>
                            <div class="product-body-v3">
                                <div class="product-category-sub">${p.subcategory || p.category}</div>
                                <a href="${detailUrl}" class="product-title" title="${p.name}">${p.name}</a>
                                
                                <div class="product-specs-pill-row">
                                    ${pillsHtml}
                                </div>

                                <div class="product-pricing">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div>
                                            <span class="price-current">${HOC_UTILS.formatINR(p.sellingPrice)}</span>
                                            ${p.mrp ? `<span class="price-mrp">${HOC_UTILS.formatINR(p.mrp)}</span>` : ''}
                                        </div>
                                        <span class="stock-pill ${p.stock > 0 ? 'stock-in' : 'stock-out'}">
                                            ${p.stock > 0 ? `<span class="pulse-dot me-1"></span> In Stock` : `<i class="bi bi-x-circle-fill"></i> Out of Stock`}
                                        </span>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-sm btn-add-enquiry" data-id="${p.id}">
                                            <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                                        </button>
                                        <a href="${detailUrl}" class="btn btn-outline-secondary btn-sm">View Full Specs</a>
                                    </div>
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
            renderList();
        });
    });
</script>
@endpush

@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-4 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">AUTHORIZED BRAND SHOWROOM &mdash;</span>
            <h2 class="fw-black mb-1 text-white" style="font-family: var(--hoc-font-heading);">Genuine Brand <span class="hero-highlight-cyan">Laptops</span></h2>
            <p class="text-light text-opacity-75 small mb-0">Authorized Dell, HP, Lenovo, ASUS &amp; Acer laptops with genuine manufacturer onsite warranty and 18% GST tax invoice.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('enquiry') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2 fw-bold d-flex align-items-center gap-2 shadow-sm">
                <i class="bi bi-file-earmark-text"></i>
                <span>Get Corporate Quote &rarr;</span>
            </a>
            <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20am%20looking%20for%20laptop%20availability" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2 fw-semibold" rel="noopener noreferrer">
                <i class="bi bi-whatsapp me-1 text-success"></i> WhatsApp Expert
            </a>
        </div>
    </div>
</div>

<!-- Laptop Brand & Type Filter Tabs -->
<div class="bg-white py-3 border-bottom shadow-xs">
    <div class="container">
        <div class="pcmart-filter-tabs d-flex gap-2 overflow-auto py-1" id="laptop-filter-tabs">
            <button class="tab-btn active" data-filter="all">All Laptops</button>
            <button class="tab-btn" data-filter="hp">HP</button>
            <button class="tab-btn" data-filter="dell">Dell</button>
            <button class="tab-btn" data-filter="lenovo">Lenovo</button>
            <button class="tab-btn" data-filter="asus">ASUS ROG / Vivobook</button>
            <button class="tab-btn" data-filter="gaming">Gaming Rigs</button>
        </div>
    </div>
</div>

<!-- Laptops Catalog Grid -->
<main class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3" id="laptops-grid">
        @forelse($laptops as $laptop)
            @php
                $discountPct = ($laptop->mrp && $laptop->mrp > $laptop->selling_price) ? round((($laptop->mrp - $laptop->selling_price) / $laptop->mrp) * 100) : 0;
                $specParts = array_filter(array_map('trim', explode('|', $laptop->specs)));
                $specParts = array_slice($specParts, 0, 3);
                $detailUrl = route('product.details', ['id' => $laptop->id]);
                $brandName = strtolower($laptop->brand->name ?? 'branded');
                $specsLower = strtolower($laptop->name . ' ' . $laptop->specs);
                $isGaming = (str_contains($specsLower, 'rtx') || str_contains($specsLower, 'gaming') || str_contains($specsLower, 'rog') || str_contains($specsLower, 'tuf'));
            @endphp
            <div class="col laptop-card-item" data-brand="{{ $brandName }}" data-gaming="{{ $isGaming ? '1' : '0' }}">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white shadow-xs">
                    <!-- Top Badges -->
                    <div class="d-flex justify-content-between align-items-center p-2 pb-0">
                        @if($discountPct > 0)
                            <span class="badge bg-danger rounded-pill px-2 py-1 fw-bold" style="font-size: 0.7rem;">-{{ $discountPct }}% OFF</span>
                        @else
                            <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.7rem;">GENUINE</span>
                        @endif

                        <button class="btn btn-link text-muted p-0 border-0 fs-6" title="Add to Wishlist" type="button">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <!-- Laptop Hardware Box Render Media -->
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 155px;">
                        <div class="hw-box-render hw-box-laptop w-100 h-100 text-center shadow-xs">
                            <div class="hw-box-badge-tag bg-white text-dark mb-1">
                                {{ strtoupper($laptop->brand->name ?? 'NOTEBOOK') }}
                            </div>
                            <i class="bi bi-laptop text-light fs-1 my-1"></i>
                            <span class="small text-white-50" style="font-size: 0.65rem;">OFFICIAL WARRANTY</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.68rem; letter-spacing: 0.5px;">
                            {{ $laptop->brand->name ?? 'Laptop' }} &bull; {{ $laptop->subcategory->name ?? 'Notebook' }}
                        </div>

                        <h6 class="fw-bold mb-2">
                            <a href="{{ $detailUrl }}" class="text-decoration-none text-dark hover-primary line-clamp-2" title="{{ $laptop->name }}" style="font-size: 0.88rem; line-height: 1.35;">
                                {{ $laptop->name }}
                            </a>
                        </h6>

                        <!-- Star Rating -->
                        <div class="d-flex align-items-center gap-1 mb-2" style="font-size: 0.75rem;">
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="fw-bold text-slate-800">4.8</span>
                            <span class="text-muted">(12+ reviews)</span>
                        </div>

                        <!-- Specs Mini-Pills -->
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            @foreach($specParts as $spec)
                                <span class="pcmart-spec-chip" style="font-size: 0.68rem; padding: 2px 6px;">
                                    {{ $spec }}
                                </span>
                            @endforeach
                        </div>

                        <!-- Price & Stock -->
                        <div class="mt-auto pt-2 border-top">
                            <div class="d-flex align-items-baseline gap-2 mb-2">
                                <span class="fs-5 fw-bold text-slate-900">₹{{ number_format($laptop->selling_price, 2) }}</span>
                                @if($laptop->mrp > $laptop->selling_price)
                                    <span class="text-muted text-decoration-line-through small" style="font-size: 0.75rem;">₹{{ number_format($laptop->mrp, 2) }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-2 small text-muted" style="font-size: 0.75rem;">
                                <span class="text-success"><i class="bi bi-shield-check me-1"></i> 100% Genuine</span>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Ready</span>
                            </div>

                            <!-- Add to Enquiry Button -->
                            <button class="btn btn-primary btn-sm w-100 fw-bold py-2 btn-add-enquiry" 
                                    data-id="{{ $laptop->id }}" 
                                    data-name="{{ $laptop->name }}" 
                                    data-sku="{{ $laptop->sku }}" 
                                    data-price="{{ $laptop->selling_price }}">
                                <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 border shadow-sm mx-auto" style="max-width: 500px;">
                    <i class="bi bi-laptop display-3 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold">No Laptops in Catalog</h5>
                    <p class="text-muted small">Check back soon or explore our full product catalog.</p>
                    <a href="{{ route('products') }}" class="btn btn-primary fw-bold rounded-pill px-4">
                        View All Products
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const filterButtons = document.querySelectorAll("#laptop-filter-tabs .tab-btn");
        const cards = document.querySelectorAll(".laptop-card-item");

        filterButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                filterButtons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const filter = btn.getAttribute("data-filter");

                cards.forEach(card => {
                    const brand = card.getAttribute("data-brand") || "";
                    const isGaming = card.getAttribute("data-gaming") === "1";

                    if (filter === "all") {
                        card.style.display = "";
                    } else if (filter === "gaming") {
                        card.style.display = isGaming ? "" : "none";
                    } else if (brand.includes(filter)) {
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

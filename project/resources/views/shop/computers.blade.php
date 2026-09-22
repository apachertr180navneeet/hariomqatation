@extends('layouts.shop')

@section('content')
<!-- Hero Banner -->
<div class="bg-dark text-white py-5" style="background: linear-gradient(135deg, #090e1a 0%, #1e293b 100%);">
    <div class="container">
        <div class="row align-items-center gy-3">
            <div class="col-lg-8">
                <span class="badge bg-primary px-3 py-1 mb-2">PRE-CONFIGURED DESKTOP TOWERS</span>
                <h2 class="fw-bold display-6 mb-2">Office PCs, Gaming Rigs & 4K Workstations</h2>
                <p class="text-light text-opacity-75 lead mb-0">Pre-built desktop computers assembled by expert engineers with 3 years hardware warranty, clean cable routing, and thermal validation.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('pc.builder') }}" class="btn btn-primary btn-lg fw-bold"><i class="bi bi-motherboard me-1"></i> Build Custom PC</a>
            </div>
        </div>
    </div>
</div>

<!-- Computers Grid -->
<main class="container my-5">
    <div class="row g-4" id="computers-grid">
        <!-- Populated via JS -->
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const grid = document.getElementById("computers-grid");
        if (!grid || typeof DataStore === 'undefined') return;

        const pcs = DataStore.getProducts().filter(p => p.category === "Desktop Computers");

        let html = "";
        pcs.forEach(p => {
            const discountPct = p.mrp ? Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100) : 0;
            const specParts = (p.specs || "").split("|").map(s => s.trim()).filter(s => s.length > 0).slice(0, 3);
            const pillsHtml = specParts.map(s => `<span class="spec-micro-pill">${s}</span>`).join("");
            const detailUrl = `${window.HOC_ROUTES.productDetails}?id=${p.id}`;

            html += `
                <div class="col-md-6 col-lg-6">
                    <div class="product-card-v3">
                        <div class="row g-0 h-100">
                            <div class="col-md-5 product-visual-art art-desktop h-100" style="min-height: 220px;">
                                ${discountPct > 0 ? `<span class="product-badge-discount">${discountPct}% OFF</span>` : ''}
                                <span class="product-badge-brand">${p.brand}</span>
                                <i class="bi bi-pc-display product-art-icon" style="font-size: 5rem;"></i>
                            </div>
                            <div class="col-md-7 d-flex flex-column">
                                <div class="product-body-v3">
                                    <div class="product-category-sub">${p.subcategory}</div>
                                    <a href="${detailUrl}" class="product-title fs-5">${p.name}</a>
                                    
                                    <div class="product-specs-pill-row mb-3">
                                        ${pillsHtml}
                                    </div>

                                    <div class="product-pricing">
                                        <div class="d-flex align-items-baseline justify-content-between mb-3">
                                            <div>
                                                <span class="price-current">${HOC_UTILS.formatINR(p.sellingPrice)}</span>
                                                ${p.mrp ? `<span class="price-mrp">${HOC_UTILS.formatINR(p.mrp)}</span>` : ''}
                                            </div>
                                            <span class="stock-pill stock-in"><span class="pulse-dot me-1"></span> Ready in Showroom</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-primary btn-sm flex-grow-1 btn-add-enquiry" data-id="${p.id}">
                                                <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                                            </button>
                                            <a href="${detailUrl}" class="btn btn-outline-secondary btn-sm">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        grid.innerHTML = html;
    });
</script>
@endpush

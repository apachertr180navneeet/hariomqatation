@extends('layouts.shop')

@section('content')
<!-- Page Breadcrumbs -->
<div class="bg-white border-bottom py-3">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h4 class="fw-bold mb-0">Genuine Computer Components</h4>
        <a href="{{ route('pc.builder') }}" class="btn btn-sm btn-primary fw-bold"><i class="bi bi-motherboard me-1"></i> Open PC Builder Tool</a>
    </div>
</div>

<!-- Subcategory Filter Pills -->
<div class="bg-light py-2 border-bottom">
    <div class="container d-flex gap-2 overflow-auto py-1" id="subcat-pills">
        <button class="btn btn-sm btn-dark active" data-sub="ALL">All Components</button>
        <button class="btn btn-sm btn-outline-secondary" data-sub="Processor">Processors (CPUs)</button>
        <button class="btn btn-sm btn-outline-secondary" data-sub="Motherboard">Motherboards</button>
        <button class="btn btn-sm btn-outline-secondary" data-sub="Graphics Card">Graphics Cards (GPUs)</button>
        <button class="btn btn-sm btn-outline-secondary" data-sub="RAM">RAM Memory</button>
        <button class="btn btn-sm btn-outline-secondary" data-sub="SSD">NVMe SSDs</button>
        <button class="btn btn-sm btn-outline-secondary" data-sub="SMPS/PSU">Power Supplies</button>
    </div>
</div>

<!-- Components Grid -->
<main class="container my-5">
    <div class="row g-4" id="components-grid">
        <!-- Populated via JS -->
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const grid = document.getElementById("components-grid");
        if (!grid || typeof DataStore === 'undefined') return;

        const allComponents = DataStore.getProducts().filter(p => p.category === "Components");

        function render(subcat = "ALL") {
            const filtered = subcat === "ALL" ? allComponents : allComponents.filter(p => p.subcategory === subcat);

            function getArtClass(sub) {
                if (sub === 'Graphics Card') return { cls: 'art-gpu', icon: 'bi-gpu-card' };
                if (sub === 'Processor') return { cls: 'art-cpu', icon: 'bi-cpu' };
                if (sub === 'RAM' || sub === 'SSD' || sub === 'HDD') return { cls: 'art-ram', icon: 'bi-device-ssd' };
                if (sub === 'Motherboard') return { cls: 'art-desktop', icon: 'bi-motherboard' };
                return { cls: 'art-default', icon: 'bi-cpu-fill' };
            }

            let html = "";
            filtered.forEach(p => {
                const discountPct = p.mrp ? Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100) : 0;
                const art = getArtClass(p.subcategory);
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
                                <div class="product-category-sub">${p.subcategory}</div>
                                <a href="${detailUrl}" class="product-title">${p.name}</a>
                                
                                <div class="product-specs-pill-row">
                                    ${pillsHtml}
                                </div>

                                <div class="product-pricing">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div>
                                            <span class="price-current">${HOC_UTILS.formatINR(p.sellingPrice)}</span>
                                            ${p.mrp ? `<span class="price-mrp">${HOC_UTILS.formatINR(p.mrp)}</span>` : ''}
                                        </div>
                                        <span class="stock-pill stock-in"><span class="pulse-dot me-1"></span> In Stock (${p.stock})</span>
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

        render();

        document.querySelectorAll("#subcat-pills button").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll("#subcat-pills button").forEach(b => {
                    b.className = "btn btn-sm btn-outline-secondary";
                });
                btn.className = "btn btn-sm btn-dark active";
                render(btn.getAttribute("data-sub"));
            });
        });
    });
</script>
@endpush

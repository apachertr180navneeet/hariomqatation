@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-4 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">ORIGINAL BRAND WARRANTY &mdash;</span>
            <h2 class="fw-black mb-0 text-white" style="font-family: var(--hoc-font-heading);">Genuine Computer <span class="hero-highlight-cyan">Components</span></h2>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('pc.builder') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2 fw-bold d-flex align-items-center gap-2 shadow-sm">
                <i class="bi bi-motherboard"></i>
                <span>Open PC Builder Tool &rarr;</span>
            </a>
        </div>
    </div>
</div>

<!-- Subcategory Filter Pills (PCMart Tabs Style) -->
<div class="bg-white py-3 border-bottom shadow-xs sticky-top" style="top: 50px; z-index: 1010;">
    <div class="container">
        <div class="pcmart-filter-tabs d-flex gap-2 overflow-auto py-1" id="subcat-pills">
            <button class="tab-btn active" data-sub="ALL">All Components</button>
            <button class="tab-btn" data-sub="Processor">Processors (CPUs)</button>
            <button class="tab-btn" data-sub="Motherboard">Motherboards</button>
            <button class="tab-btn" data-sub="Graphics Card">Graphics Cards (GPUs)</button>
            <button class="tab-btn" data-sub="RAM">RAM Memory</button>
            <button class="tab-btn" data-sub="SSD">Storage (NVMe SSD)</button>
            <button class="tab-btn" data-sub="SMPS/PSU">Power Supplies</button>
        </div>
    </div>
</div>

<!-- Components Grid -->
<main class="container my-4">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3" id="components-grid">
        <!-- Populated via JS -->
    </div>
</main>
@endsection

@push('scripts')
<script>
    window.__SERVER_PRODUCTS__ = @json($componentsJson ?? []);
    document.addEventListener("DOMContentLoaded", () => {
        const grid = document.getElementById("components-grid");
        if (!grid || typeof DataStore === 'undefined') return;

        const serverComponents = (window.__SERVER_PRODUCTS__ && window.__SERVER_PRODUCTS__.length > 0) ? window.__SERVER_PRODUCTS__ : [];
        const allComponents = (serverComponents.length > 0) ? serverComponents : DataStore.getProducts().filter(p => p.category === "Components");

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
            } else if (sub.includes("Power") || sub.includes("PSU") || sub.includes("SMPS")) {
                return `
                    <div class="hw-box-render bg-dark text-white border text-center">
                        <div class="hw-box-badge-tag bg-warning text-dark mb-1">80+ GOLD PSU</div>
                        <i class="bi bi-plug fs-2 text-danger mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'POWER'}</div>
                    </div>`;
            } else {
                return `
                    <div class="hw-box-render bg-light text-dark border text-center">
                        <i class="bi bi-cpu-fill fs-2 text-primary mb-1"></i>
                        <div class="fw-bold small" style="font-size: 0.65rem;">${p.brand || 'HARDWARE'}</div>
                    </div>`;
            }
        }

        function render(subcat = "ALL") {
            const filtered = subcat === "ALL" ? allComponents : allComponents.filter(p => (p.subcategory === subcat || (p.subcategory && p.subcategory.name === subcat)));

            let html = "";
            filtered.forEach(p => {
                const price = p.sellingPrice || p.selling_price || 0;
                const mrp = p.mrp || 0;
                const discountPct = mrp ? Math.round(((mrp - price) / mrp) * 100) : 12;
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
                                <span class="text-muted small mb-1" style="font-size: 0.7rem; font-weight: 600;">${p.subcategory || (p.subcategory ? p.subcategory.name : 'Hardware')}</span>
                                <a href="${detailUrl}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="${p.name}">
                                    ${p.name}
                                </a>

                                <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                                    <i class="bi bi-star-fill"></i>
                                    <span class="text-dark fw-bold ms-1">4.8</span>
                                    <span class="text-muted">(1.2k)</span>
                                </div>

                                <div class="mt-auto">
                                    <div class="d-flex align-items-baseline gap-1 mb-2">
                                        <strong class="fs-6 text-dark fw-black">₹${price.toLocaleString('en-IN')}</strong>
                                        ${mrp ? `<span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹${mrp.toLocaleString('en-IN')}</span>` : ''}
                                    </div>

                                    <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" data-id="${p.id}" data-name="${p.name}" data-price="${price}">
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

        render();

        document.querySelectorAll("#subcat-pills button").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll("#subcat-pills button").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                render(btn.getAttribute("data-sub"));
            });
        });
    });
</script>
@endpush


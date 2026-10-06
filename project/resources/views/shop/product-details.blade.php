@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero / Breadcrumb Banner -->
<div class="pcmart-page-banner py-3 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small" id="prod-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none"><i class="bi bi-house-door me-1"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-info text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page" id="prod-crumb-name">Product Name</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('products') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-1 fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Back to Catalog
            </a>
            <a href="{{ route('enquiry') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-1 fw-bold">
                <i class="bi bi-cart3 me-1"></i> View Cart
            </a>
        </div>
    </div>
</div>

<!-- Product Details Content -->
<main class="container my-5" id="product-detail-container">
    <div class="row g-4 g-lg-5">
        <!-- Product Showcase Side -->
        <div class="col-lg-5">
            <div class="card border rounded-4 p-4 text-center bg-white shadow-xs">
                <!-- Large Visual Box Render -->
                <div class="d-flex align-items-center justify-content-center rounded-3 p-4 mb-3 position-relative overflow-hidden" 
                     id="prod-main-icon-container" 
                     style="min-height: 320px; background: linear-gradient(145deg, #020b18 0%, #081d3a 60%, #0f305c 100%);">
                    <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 fw-bold" id="prod-discount-badge" style="font-size: 0.8rem; z-index: 2;">
                        15% OFF
                    </span>
                    <i id="prod-main-icon" class="bi bi-laptop text-white" style="font-size: 7.5rem;"></i>
                </div>

                <!-- Hardware Thumbnail Indicators -->
                <div class="row g-2 justify-content-center">
                    <div class="col-3">
                        <div class="border rounded-3 p-2 bg-light text-center cursor-pointer border-primary shadow-xs">
                            <i class="bi bi-image text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="border rounded-3 p-2 bg-light text-center cursor-pointer shadow-xs">
                            <i class="bi bi-cpu text-muted fs-4"></i>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="border rounded-3 p-2 bg-light text-center cursor-pointer shadow-xs">
                            <i class="bi bi-hdd-network text-muted fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assurance & Trust Badges -->
            <div class="card border rounded-3 p-3 mt-4 bg-white shadow-xs">
                <div class="row g-3">
                    <div class="col-6 d-flex align-items-start gap-2">
                        <i class="bi bi-patch-check-fill text-success fs-4"></i>
                        <div>
                            <div class="fw-bold small">100% Genuine</div>
                            <small class="text-muted" style="font-size: 0.72rem;">Authorized brand retail box</small>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-start gap-2">
                        <i class="bi bi-receipt text-primary fs-4"></i>
                        <div>
                            <div class="fw-bold small">18% GST Invoice</div>
                            <small class="text-muted" style="font-size: 0.72rem;">Input tax credit claimable</small>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-start gap-2">
                        <i class="bi bi-shield-lock-fill text-info fs-4"></i>
                        <div>
                            <div class="fw-bold small">Brand Warranty</div>
                            <small class="text-muted" style="font-size: 0.72rem;">Pan-India service centers</small>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-danger fs-4"></i>
                        <div>
                            <div class="fw-bold small">Showroom Pickup</div>
                            <small class="text-muted" style="font-size: 0.72rem;">Ready in Jodhpur store</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info Side -->
        <div class="col-lg-7">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-primary px-3 py-1" id="prod-brand">Brand</span>
                <span class="badge bg-light text-dark border px-3 py-1" id="prod-category">Category</span>
                <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 px-2 py-1 ms-auto" id="prod-stock-status">
                    <i class="bi bi-check-circle-fill me-1"></i> In Stock Ready
                </span>
            </div>

            <h2 class="fw-bold text-slate-900 mb-2" id="prod-name" style="font-family: var(--hoc-font-heading);">Product Name</h2>
            
            <div class="d-flex align-items-center gap-3 small text-muted mb-3">
                <span>Model / SKU: <strong id="prod-sku" class="text-dark">SKU</strong></span>
                <span>&bull;</span>
                <div class="d-flex align-items-center gap-1 text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <span class="fw-bold text-slate-800 ms-1">4.8</span>
                </div>
                <span>&bull;</span>
                <span class="text-success"><i class="bi bi-patch-check"></i> Verified Model</span>
            </div>

            <!-- Price Highlight Card -->
            <div class="p-3 bg-light rounded-3 mb-4 d-flex align-items-baseline gap-3 border">
                <div>
                    <span class="text-muted small d-block mb-1">Our Price (18% GST Included):</span>
                    <div class="display-6 fw-extrabold text-primary" id="prod-selling-price">₹0</div>
                </div>
                <div class="ms-3">
                    <span class="text-muted small d-block mb-1">MRP:</span>
                    <div class="fs-5 text-muted text-decoration-line-through" id="prod-mrp-price">₹0</div>
                </div>
                <div class="ms-auto text-end">
                    <span class="badge bg-info text-dark fw-bold px-2 py-1 mb-1">BEST PRICE</span>
                    <div class="small text-muted" style="font-size: 0.72rem;">Official Wholesale Rate</div>
                </div>
            </div>

            <!-- Key Specifications -->
            <div class="mb-4">
                <h6 class="fw-bold mb-2 text-slate-900">Key Specifications:</h6>
                <p class="text-muted" id="prod-specs-text">Full specification summary details.</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <div class="border rounded-3 p-3 bg-white shadow-xs">
                        <div class="text-muted small">Manufacturer Warranty</div>
                        <div class="fw-bold text-slate-900" id="prod-warranty">1 Year Brand Warranty</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="border rounded-3 p-3 bg-white shadow-xs">
                        <div class="text-muted small">Showroom Availability</div>
                        <div class="fw-bold text-success">Ready for Instant Pickup (Jodhpur)</div>
                    </div>
                </div>
            </div>

            <!-- Action CTAs -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <button class="btn btn-primary btn-lg px-4 py-3 fw-bold rounded-pill shadow-sm" id="btn-details-add-enquiry">
                    <i class="bi bi-cart-plus me-2"></i> Add to Enquiry Cart
                </button>
                <button class="btn btn-outline-primary btn-lg px-4 py-3 fw-bold rounded-pill" id="btn-details-get-quote">
                    <i class="bi bi-file-earmark-text me-2"></i> Request Official Quote
                </button>
                <a href="#" target="_blank" class="btn btn-success btn-lg px-4 py-3 fw-bold rounded-pill" id="btn-details-whatsapp" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp me-2"></i> Inquire on WhatsApp
                </a>
            </div>

            <!-- Detailed Specifications Table -->
            <div class="card border rounded-3 overflow-hidden shadow-xs">
                <div class="card-header bg-light py-3 border-bottom">
                    <h6 class="fw-bold mb-0 text-slate-900"><i class="bi bi-cpu me-2 text-primary"></i> Hardware Breakdown &amp; Technical Details</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 small">
                        <tbody id="prod-tech-specs-table">
                            <tr><th class="bg-light text-slate-700" style="width: 35%;">Category</th><td id="spec-cat-val">-</td></tr>
                            <tr><th class="bg-light text-slate-700">Brand &amp; Model</th><td id="spec-brand-val">-</td></tr>
                            <tr><th class="bg-light text-slate-700">Primary Specs</th><td id="spec-specs-val">-</td></tr>
                            <tr><th class="bg-light text-slate-700">Warranty Type</th><td id="spec-warranty-val">-</td></tr>
                            <tr><th class="bg-light text-slate-700">Tax Details</th><td>18% GST Included (Input Credit Eligible)</td></tr>
                            <tr><th class="bg-light text-slate-700">Store Location</th><td>Hari Om Computer, Near Sojati Gate, Jodhpur</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof DataStore === 'undefined') return;

        const urlParams = new URLSearchParams(window.location.search);
        const prodId = urlParams.get("id") || "{{ $productId ?? 'PROD-1002' }}";
        const p = DataStore.getProductById(prodId) || DataStore.getProducts()[0];

        if (!p) return;

        document.title = `${p.name} | Hari Om Computer`;
        document.getElementById("prod-crumb-name").innerText = p.name;
        document.getElementById("prod-name").innerText = p.name;
        document.getElementById("prod-brand").innerText = p.brand;
        document.getElementById("prod-category").innerText = p.category;
        document.getElementById("prod-sku").innerText = p.sku;
        document.getElementById("prod-selling-price").innerText = HOC_UTILS.formatINR(p.sellingPrice);
        document.getElementById("prod-mrp-price").innerText = p.mrp ? HOC_UTILS.formatINR(p.mrp) : '';
        document.getElementById("prod-specs-text").innerText = p.specs;
        document.getElementById("prod-warranty").innerText = p.warranty || "1 Year Onsite Brand Warranty";

        // Tech specs table
        document.getElementById("spec-cat-val").innerText = `${p.category} (${p.subcategory || ''})`;
        document.getElementById("spec-brand-val").innerText = `${p.brand} - ${p.model || p.name}`;
        document.getElementById("spec-specs-val").innerText = p.specs;
        document.getElementById("spec-warranty-val").innerText = p.warranty || "1 Year";

        // Discount badge
        const discBadge = document.getElementById("prod-discount-badge");
        if (p.mrp && p.mrp > p.sellingPrice) {
            const pct = Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100);
            discBadge.innerText = `${pct}% OFF`;
            discBadge.style.display = "inline-block";
        } else {
            discBadge.style.display = "none";
        }

        // High-end category art presentation
        const mainIcon = document.getElementById("prod-main-icon");
        const iconBox = document.getElementById("prod-main-icon-container");
        if (iconBox && mainIcon) {
            let artIcon = "bi-cpu";
            if (p.category === 'Laptops') { artIcon = "bi-laptop"; }
            else if (p.category === 'Desktop Computers') { artIcon = "bi-pc-display"; }
            else if (p.category === 'Display & Monitors') { artIcon = "bi-display"; }
            else if ((p.specs || "").toLowerCase().includes('rtx') || (p.specs || "").toLowerCase().includes('graphics')) { artIcon = "bi-gpu-card"; }
            else if ((p.specs || "").toLowerCase().includes('ram') || (p.specs || "").toLowerCase().includes('ssd')) { artIcon = "bi-device-ssd"; }

            mainIcon.className = `bi ${artIcon} text-white`;
        }

        // Buttons
        document.getElementById("btn-details-add-enquiry").onclick = () => {
            DataStore.addToEnquiryCart(p.id, 1);
            HOC_UTILS.showToast(`${p.name} added to your Enquiry Cart!`);
        };

        document.getElementById("btn-details-get-quote").onclick = () => {
            DataStore.addToEnquiryCart(p.id, 1);
            window.location.href = "{{ route('enquiry') }}";
        };

        const waMsg = `Hello Hari Om Computer, I would like to enquire about the price and availability of: *${p.name}* (SKU: ${p.sku}) listed at ${HOC_UTILS.formatINR(p.sellingPrice)}.`;
        document.getElementById("btn-details-whatsapp").href = `https://wa.me/919829012345?text=${encodeURIComponent(waMsg)}`;
    });
</script>
@endpush

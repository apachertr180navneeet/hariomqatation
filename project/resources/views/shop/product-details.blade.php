@extends('shop.includes.app')

@section('content')
@php
    $discountPct = ($product->mrp && $product->mrp > $product->selling_price) 
        ? round((($product->mrp - $product->selling_price) / $product->mrp) * 100) 
        : 0;
    $categoryName = $product->category->name ?? 'Components';
    $subName = $product->subcategory->name ?? '';
    $brandName = $product->brand->name ?? 'Branded';
    $specsLower = strtolower($product->name . ' ' . $product->specs);
    $waMsg = "Hello Hari Om Computer, I would like to enquire about the price and availability of: *" . $product->name . "* (SKU: " . $product->sku . ") listed at ₹" . number_format($product->selling_price, 2);
@endphp

<!-- PCMart Inner Page Hero / Breadcrumb Banner -->
<div class="pcmart-page-banner py-3 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small" id="prod-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info text-decoration-none"><i class="bi bi-house-door me-1"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-info text-decoration-none">Products</a></li>
                @if($categoryName)
                    <li class="breadcrumb-item"><a href="{{ route('products', ['cat' => $categoryName]) }}" class="text-info text-decoration-none">{{ $categoryName }}</a></li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page" id="prod-crumb-name">{{ $product->name }}</li>
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
                    @if($discountPct > 0)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 fw-bold" id="prod-discount-badge" style="font-size: 0.8rem; z-index: 2;">
                            -{{ $discountPct }}% OFF
                        </span>
                    @endif

                    @if(str_contains(strtolower($categoryName), 'laptop') || str_contains($specsLower, 'laptop'))
                        <div class="hw-box-render hw-box-laptop p-4 text-center" style="width: 200px; height: 200px;">
                            <span class="hw-box-badge-tag bg-white text-dark mb-2">{{ strtoupper($brandName) }}</span>
                            <i class="bi bi-laptop text-white display-1 my-2"></i>
                            <span class="small text-white-50">GENUINE LAPTOP</span>
                        </div>
                    @elseif(str_contains(strtolower($categoryName), 'desktop') || str_contains(strtolower($categoryName), 'computer'))
                        <div class="hw-box-render hw-box-desktop p-4 text-center" style="width: 200px; height: 200px;">
                            <span class="hw-box-badge-tag bg-info text-dark mb-2">CUSTOM RIG</span>
                            <i class="bi bi-pc-display text-white display-1 my-2"></i>
                            <span class="small text-info fw-bold">DESKTOP TOWER</span>
                        </div>
                    @elseif(str_contains($specsLower, 'rtx') || str_contains($specsLower, 'graphics') || str_contains($specsLower, 'gpu'))
                        <div class="hw-box-render hw-box-gpu p-4 text-center" style="width: 200px; height: 200px;">
                            <span class="hw-box-badge-tag bg-success text-white mb-2">GRAPHICS CARD</span>
                            <i class="bi bi-gpu-card text-warning display-1 my-2"></i>
                            <span class="small text-success fw-bold">HIGH FPS</span>
                        </div>
                    @elseif(str_contains($specsLower, 'intel'))
                        <div class="hw-box-render hw-box-intel p-4 text-center" style="width: 200px; height: 200px;">
                            <span class="hw-box-badge-tag bg-white text-primary mb-2">INTEL CORE</span>
                            <i class="bi bi-cpu-fill text-white display-1 my-2"></i>
                            <span class="small text-white-50">{{ $brandName }}</span>
                        </div>
                    @elseif(str_contains($specsLower, 'ryzen') || str_contains($specsLower, 'amd'))
                        <div class="hw-box-render hw-box-amd p-4 text-center" style="width: 200px; height: 200px;">
                            <span class="hw-box-badge-tag bg-warning text-dark mb-2">AMD RYZEN</span>
                            <i class="bi bi-cpu-fill text-warning display-1 my-2"></i>
                            <span class="small text-white-50">{{ $brandName }}</span>
                        </div>
                    @elseif(str_contains($specsLower, 'ram') || str_contains($specsLower, 'ddr'))
                        <div class="hw-box-render hw-box-ram p-4 text-center" style="width: 200px; height: 200px;">
                            <div class="hw-box-ram-lightbar"></div>
                            <span class="hw-box-badge-tag bg-secondary text-white mb-2 mt-2">DDR MEMORY</span>
                            <i class="bi bi-memory text-success display-1 my-2"></i>
                            <span class="small text-white-50">RGB SYNC</span>
                        </div>
                    @elseif(str_contains($specsLower, 'ssd') || str_contains($specsLower, 'nvme'))
                        <div class="hw-box-render hw-box-ssd p-4 text-center" style="width: 200px; height: 200px;">
                            <span class="hw-box-badge-tag bg-danger text-white mb-2">NVMe PCIe</span>
                            <i class="bi bi-device-ssd text-danger display-1 my-2"></i>
                            <span class="small text-white-50">FAST STORAGE</span>
                        </div>
                    @else
                        <div class="hw-box-render bg-light text-dark p-4 text-center border" style="width: 200px; height: 200px;">
                            <i class="bi bi-cpu display-1 text-primary my-2"></i>
                            <span class="small text-dark fw-bold">{{ $categoryName }}</span>
                        </div>
                    @endif
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
                            <small class="text-muted" style="font-size: 0.72rem;">{{ $product->warranty ?: '1 Year Brand Warranty' }}</small>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-danger fs-4"></i>
                        <div>
                            <div class="fw-bold small">Showroom Pickup</div>
                            <small class="text-muted" style="font-size: 0.72rem;">Sojati Gate, Jodhpur store</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info Side -->
        <div class="col-lg-7">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-primary px-3 py-1" id="prod-brand">{{ $brandName }}</span>
                <span class="badge bg-light text-dark border px-3 py-1" id="prod-category">{{ $categoryName }}</span>
                @if($subName)
                    <span class="badge bg-light text-secondary border px-2 py-1">{{ $subName }}</span>
                @endif
                <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 px-2 py-1 ms-auto" id="prod-stock-status">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ $product->stock > 0 ? $product->stock . ' Units Ready' : 'Showroom Ready' }}
                </span>
            </div>

            <h2 class="fw-bold text-slate-900 mb-2" id="prod-name" style="font-family: var(--hoc-font-heading);">{{ $product->name }}</h2>
            
            <div class="d-flex align-items-center gap-3 small text-muted mb-3 flex-wrap">
                <span>Model / SKU: <strong id="prod-sku" class="text-dark">{{ $product->sku }}</strong></span>
                <span>&bull;</span>
                <div class="d-flex align-items-center gap-1 text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <span class="fw-bold text-slate-800 ms-1">{{ number_format((float) ($product->rating ?: 4.8), 1) }}</span>
                </div>
                <span>&bull;</span>
                <span class="text-success"><i class="bi bi-patch-check"></i> Verified Model</span>
            </div>

            <!-- Price Highlight Card -->
            <div class="p-3 bg-light rounded-3 mb-4 d-flex align-items-baseline gap-3 border flex-wrap">
                <div>
                    <span class="text-muted small d-block mb-1">Our Price (18% GST Included):</span>
                    <div class="display-6 fw-extrabold text-primary" id="prod-selling-price">₹{{ number_format($product->selling_price, 2) }}</div>
                </div>
                @if($product->mrp && $product->mrp > $product->selling_price)
                    <div class="ms-3">
                        <span class="text-muted small d-block mb-1">MRP:</span>
                        <div class="fs-5 text-muted text-decoration-line-through" id="prod-mrp-price">₹{{ number_format($product->mrp, 2) }}</div>
                    </div>
                @endif
                <div class="ms-auto text-end">
                    <span class="badge bg-info text-dark fw-bold px-2 py-1 mb-1">BEST PRICE</span>
                    <div class="small text-muted" style="font-size: 0.72rem;">Official Wholesale Rate</div>
                </div>
            </div>

            <!-- Key Specifications -->
            <div class="mb-4">
                <h6 class="fw-bold mb-2 text-slate-900">Key Specifications:</h6>
                <p class="text-muted" id="prod-specs-text">{{ $product->specs ?: 'High performance computer hardware component engineered for reliability and long-term durability.' }}</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <div class="border rounded-3 p-3 bg-white shadow-xs">
                        <div class="text-muted small">Manufacturer Warranty</div>
                        <div class="fw-bold text-slate-900" id="prod-warranty">{{ $product->warranty ?: '1 Year Brand Warranty' }}</div>
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
                <button class="btn btn-primary btn-lg px-4 py-3 fw-bold rounded-pill shadow-sm btn-add-enquiry" 
                        id="btn-details-add-enquiry"
                        data-id="{{ $product->id }}" 
                        data-name="{{ $product->name }}" 
                        data-sku="{{ $product->sku }}" 
                        data-price="{{ $product->selling_price }}">
                    <i class="bi bi-cart-plus me-2"></i> Add to Enquiry Cart
                </button>
                <a href="{{ route('enquiry') }}" class="btn btn-outline-primary btn-lg px-4 py-3 fw-bold rounded-pill" id="btn-details-get-quote">
                    <i class="bi bi-file-earmark-text me-2"></i> Request Official Quote
                </a>
                <a href="https://wa.me/919829012345?text={{ urlencode($waMsg) }}" target="_blank" class="btn btn-success btn-lg px-4 py-3 fw-bold rounded-pill" id="btn-details-whatsapp" rel="noopener noreferrer">
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
                            <tr><th class="bg-light text-slate-700" style="width: 35%;">Category</th><td id="spec-cat-val">{{ $categoryName }} {{ $subName ? "({$subName})" : '' }}</td></tr>
                            <tr><th class="bg-light text-slate-700">Brand &amp; Model</th><td id="spec-brand-val">{{ $brandName }} - {{ $product->model ?: $product->name }}</td></tr>
                            <tr><th class="bg-light text-slate-700">Primary Specs</th><td id="spec-specs-val">{{ $product->specs }}</td></tr>
                            <tr><th class="bg-light text-slate-700">Warranty Type</th><td id="spec-warranty-val">{{ $product->warranty ?: '1 Year Pan-India Warranty' }}</td></tr>
                            <tr><th class="bg-light text-slate-700">Tax Details</th><td>18% GST Included (Input Credit Eligible)</td></tr>
                            <tr><th class="bg-light text-slate-700">Store Location</th><td>Hari Om Computer, Station Road Near Sojati Gate, Jodhpur</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Hardware Recommendations -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-5 pt-4 border-top">
            <h4 class="fw-bold text-slate-900 mb-4" style="font-family: var(--hoc-font-heading);">
                Related Hardware &amp; Similar Products
            </h4>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach($relatedProducts as $rel)
                    <div class="col">
                        <div class="pcmart-product-card card h-100 border rounded-3 bg-white shadow-xs">
                            <div class="card-body p-3 d-flex flex-column">
                                <span class="text-muted small mb-1" style="font-size: 0.7rem;">{{ $rel->brand->name ?? 'Hardware' }}</span>
                                <h6 class="fw-bold mb-2">
                                    <a href="{{ route('product.details', ['id' => $rel->id]) }}" class="text-decoration-none text-dark hover-primary line-clamp-2" style="font-size: 0.88rem;">
                                        {{ $rel->name }}
                                    </a>
                                </h6>
                                <div class="mt-auto pt-2 border-top">
                                    <strong class="fs-6 text-dark fw-black">₹{{ number_format($rel->selling_price, 2) }}</strong>
                                    <a href="{{ route('product.details', ['id' => $rel->id]) }}" class="btn btn-outline-primary btn-sm w-100 mt-2 fw-semibold rounded-2">
                                        View Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const addBtn = document.getElementById("btn-details-add-enquiry");
        if (addBtn && typeof DataStore !== 'undefined') {
            addBtn.addEventListener("click", () => {
                const prodId = addBtn.getAttribute("data-id");
                DataStore.addToEnquiryCart(prodId, 1);
                if (typeof HOC_UTILS !== 'undefined') {
                    HOC_UTILS.showToast("Added to Enquiry Cart!");
                }
            });
        }
    });
</script>
@endpush

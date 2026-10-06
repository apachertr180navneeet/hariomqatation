@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-4 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">PRE-CONFIGURED RIGS & TOWERS &mdash;</span>
            <h2 class="fw-black mb-1 text-white" style="font-family: var(--hoc-font-heading);">Desktop Computers &amp; <span class="hero-highlight-cyan">Gaming PCs</span></h2>
            <p class="text-light text-opacity-75 small mb-0">Pre-built desktop computers assembled by expert engineers with 3 years hardware warranty &amp; stress-tested thermals.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('pc.builder') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2 fw-bold d-flex align-items-center gap-2 shadow-sm">
                <i class="bi bi-motherboard"></i>
                <span>Build Custom PC &rarr;</span>
            </a>
            <a href="{{ route('enquiry') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2 fw-semibold">
                <i class="bi bi-file-earmark-text me-1"></i> Bulk Quote
            </a>
        </div>
    </div>
</div>

<!-- Category Filter Pills -->
<div class="bg-white py-3 border-bottom shadow-xs">
    <div class="container">
        <div class="pcmart-filter-tabs d-flex gap-2 overflow-auto py-1" id="pc-filter-tabs">
            <button class="tab-btn active" data-filter="all">All Desktops</button>
            <button class="tab-btn" data-filter="gaming">Gaming Rigs</button>
            <button class="tab-btn" data-filter="workstation">Workstations</button>
            <button class="tab-btn" data-filter="office">Office &amp; Home</button>
        </div>
    </div>
</div>

<!-- Computers Grid -->
<main class="container my-5">
    <div class="row g-4" id="computers-grid">
        @forelse($computers as $pc)
            @php
                $discountPct = ($pc->mrp && $pc->mrp > $pc->selling_price) ? round((($pc->mrp - $pc->selling_price) / $pc->mrp) * 100) : 0;
                $specParts = array_filter(array_map('trim', explode('|', $pc->specs)));
                $specParts = array_slice($specParts, 0, 4);
                $detailUrl = route('product.details', ['id' => $pc->id]);
                $lowerName = strtolower($pc->name . ' ' . $pc->specs . ' ' . ($pc->subcategory->name ?? ''));
                $tagType = 'office';
                if (str_contains($lowerName, 'gaming') || str_contains($lowerName, 'rtx') || str_contains($lowerName, 'gtx')) {
                    $tagType = 'gaming';
                } elseif (str_contains($lowerName, 'workstation') || str_contains($lowerName, 'ryzen 9') || str_contains($lowerName, 'i9')) {
                    $tagType = 'workstation';
                }
            @endphp
            <div class="col-md-6 col-lg-6 pc-card-item" data-tag="{{ $tagType }}">
                <div class="pcmart-desktop-card card h-100 rounded-3 overflow-hidden bg-white shadow-xs">
                    <div class="row g-0 h-100">
                        <!-- Left Media / Box Render Box -->
                        <div class="col-sm-5 p-3 d-flex flex-column justify-content-between position-relative" style="background: linear-gradient(145deg, #020914 0%, #08172e 60%, #0d274c 100%);">
                            @if($discountPct > 0)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-2 py-1 fw-bold" style="font-size: 0.72rem; z-index: 2;">
                                    -{{ $discountPct }}% OFF
                                </span>
                            @endif

                            <div class="text-end mb-2">
                                <span class="badge bg-white bg-opacity-15 text-light px-2 py-1 small text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">
                                    {{ $pc->brand->name ?? 'Custom Build' }}
                                </span>
                            </div>

                            <div class="text-center my-auto py-3">
                                <div class="hw-box-render hw-box-desktop mx-auto shadow-sm" style="width: 110px; height: 130px;">
                                    <span class="hw-box-badge-tag bg-info text-dark mb-1">PRO RIG</span>
                                    <i class="bi bi-pc-display text-white fs-1 my-1"></i>
                                    <span class="small text-info fw-bold" style="font-size: 0.65rem;">ASSEMBLED</span>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 px-2 py-1" style="font-size: 0.7rem;">
                                    <span class="pulse-dot me-1"></span> {{ $pc->stock > 0 ? $pc->stock . ' Units Ready' : 'Showroom Ready' }}
                                </span>
                            </div>
                        </div>

                        <!-- Right Details Box -->
                        <div class="col-sm-7 d-flex flex-column p-3 p-md-4">
                            <div class="mb-1">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                    {{ $pc->subcategory->name ?? 'Desktop Tower' }}
                                </span>
                            </div>

                            <h5 class="fw-bold text-slate-900 mb-2">
                                <a href="{{ $detailUrl }}" class="text-decoration-none text-dark hover-primary line-clamp-2" style="font-size: 1.05rem;">
                                    {{ $pc->name }}
                                </a>
                            </h5>

                            <!-- Star Rating -->
                            <div class="d-flex align-items-center gap-1 mb-3" style="font-size: 0.78rem;">
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="fw-bold text-slate-800">4.8</span>
                                <span class="text-muted">(18+ Builds Delivered)</span>
                            </div>

                            <!-- Hardware Specs Tags -->
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                @foreach($specParts as $spec)
                                    <span class="pcmart-spec-chip">
                                        <i class="bi bi-check2-circle"></i> {{ $spec }}
                                    </span>
                                @endforeach
                            </div>

                            <!-- Pricing & Action Buttons -->
                            <div class="mt-auto pt-3 border-top">
                                <div class="d-flex align-items-baseline gap-2 mb-3">
                                    <span class="fs-4 fw-extrabold text-primary">₹{{ number_format($pc->selling_price, 2) }}</span>
                                    @if($pc->mrp > $pc->selling_price)
                                        <span class="text-muted text-decoration-line-through small">₹{{ number_format($pc->mrp, 2) }}</span>
                                    @endif
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary btn-sm flex-grow-1 fw-bold py-2 btn-add-enquiry" 
                                            data-id="{{ $pc->id }}" 
                                            data-name="{{ $pc->name }}" 
                                            data-sku="{{ $pc->sku }}" 
                                            data-price="{{ $pc->selling_price }}">
                                        <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                                    </button>
                                    <a href="{{ $detailUrl }}" class="btn btn-outline-secondary btn-sm px-3 fw-semibold d-flex align-items-center">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 border shadow-sm mx-auto" style="max-width: 500px;">
                    <i class="bi bi-pc-display display-3 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold">No Pre-Configured Computers in Catalog</h5>
                    <p class="text-muted small">Configure your custom rig using our interactive builder.</p>
                    <a href="{{ route('pc.builder') }}" class="btn btn-primary fw-bold rounded-pill px-4">
                        <i class="bi bi-motherboard me-1"></i> Open PC Builder
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
        const filterButtons = document.querySelectorAll("#pc-filter-tabs .tab-btn");
        const cards = document.querySelectorAll(".pc-card-item");

        filterButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                filterButtons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const filter = btn.getAttribute("data-filter");

                cards.forEach(card => {
                    const tag = card.getAttribute("data-tag");
                    if (filter === "all" || tag === filter) {
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

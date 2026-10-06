@extends('shop.includes.app')

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
        @forelse($computers as $pc)
            @php
                $discountPct = ($pc->mrp && $pc->mrp > $pc->selling_price) ? round((($pc->mrp - $pc->selling_price) / $pc->mrp) * 100) : 0;
                $specParts = array_filter(array_map('trim', explode('|', $pc->specs)));
                $specParts = array_slice($specParts, 0, 4);
                $detailUrl = route('product.details', ['id' => $pc->id]);
            @endphp
            <div class="col-md-6 col-lg-6">
                <div class="product-card-v3">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 product-visual-art art-desktop h-100" style="min-height: 220px;">
                            @if($discountPct > 0)
                                <span class="product-badge-discount">{{ $discountPct }}% OFF</span>
                            @endif
                            <span class="product-badge-brand">{{ $pc->brand->name ?? 'Custom Build' }}</span>
                            <i class="bi bi-pc-display product-art-icon" style="font-size: 5rem;"></i>
                        </div>
                        <div class="col-md-7 d-flex flex-column">
                            <div class="product-body-v3">
                                <div class="product-category-sub">{{ $pc->subcategory->name ?? 'Desktop Tower' }}</div>
                                <a href="{{ $detailUrl }}" class="product-title fs-5">{{ $pc->name }}</a>
                                
                                <div class="product-specs-pill-row mb-3">
                                    @foreach($specParts as $spec)
                                        <span class="spec-micro-pill">{{ $spec }}</span>
                                    @endforeach
                                </div>

                                <div class="product-pricing mt-auto">
                                    <div class="d-flex align-items-baseline justify-content-between mb-3">
                                        <div>
                                            <span class="price-current">₹{{ number_format($pc->selling_price, 2) }}</span>
                                            @if($pc->mrp > $pc->selling_price)
                                                <span class="price-mrp">₹{{ number_format($pc->mrp, 2) }}</span>
                                            @endif
                                        </div>
                                        <span class="stock-pill stock-in">
                                            <span class="pulse-dot me-1"></span> 
                                            {{ $pc->stock > 0 ? $pc->stock . ' Units Ready' : 'Showroom Ready' }}
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary btn-sm flex-grow-1 btn-add-enquiry" 
                                                data-id="{{ $pc->id }}" 
                                                data-name="{{ $pc->name }}" 
                                                data-sku="{{ $pc->sku }}" 
                                                data-price="{{ $pc->selling_price }}">
                                            <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                                        </button>
                                        <a href="{{ $detailUrl }}" class="btn btn-outline-secondary btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-pc-display display-3 text-muted mb-3 d-block"></i>
                <h5>No Pre-Configured Computers in Catalog</h5>
                <p class="text-muted small">Configure your custom rig using our interactive builder.</p>
                <a href="{{ route('pc.builder') }}" class="btn btn-primary fw-bold">Open PC Builder</a>
            </div>
        @endforelse
    </div>
</main>
@endsection

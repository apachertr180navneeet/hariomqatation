@extends('shop.includes.app')

@section('content')
<!-- Laptop Showcase Hero Banner -->
<div class="bg-dark text-white py-5" style="background: linear-gradient(135deg, #0b1329 0%, #1e293b 100%);">
    <div class="container">
        <div class="row align-items-center gy-3">
            <div class="col-lg-8">
                <span class="badge bg-primary px-3 py-1 mb-2">OFFICIAL LAPTOP SHOWROOM</span>
                <h2 class="fw-bold display-6 mb-2">Brand New Genuine Laptops in Jodhpur</h2>
                <p class="text-light text-opacity-75 lead mb-0">Authorized Dell, HP, Lenovo, ASUS & Acer laptops with genuine manufacturer onsite warranty and 18% GST invoice.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('enquiry') }}" class="btn btn-primary btn-lg fw-bold"><i class="bi bi-file-earmark-text me-1"></i> Get Bulk Quote</a>
            </div>
        </div>
    </div>
</div>

<!-- Laptops Grid -->
<main class="container my-5">
    <div class="row g-4" id="laptops-grid">
        @forelse($laptops as $laptop)
            @php
                $discountPct = ($laptop->mrp && $laptop->mrp > $laptop->selling_price) ? round((($laptop->mrp - $laptop->selling_price) / $laptop->mrp) * 100) : 0;
                $specParts = array_filter(array_map('trim', explode('|', $laptop->specs)));
                $specParts = array_slice($specParts, 0, 4);
                $detailUrl = route('product.details', ['id' => $laptop->id]);
            @endphp
            <div class="col-6 col-md-6 col-lg-4">
                <div class="product-card-v3">
                    <div class="product-visual-art art-laptop" style="min-height: 200px;">
                        @if($discountPct > 0)
                            <span class="product-badge-discount">{{ $discountPct }}% OFF</span>
                        @endif
                        <span class="product-badge-brand">{{ $laptop->brand->name ?? 'Branded' }}</span>
                        <i class="bi bi-laptop product-art-icon" style="font-size: 4.5rem;"></i>
                    </div>
                    <div class="product-body-v3">
                        <div class="product-category-sub">{{ $laptop->subcategory->name ?? 'Laptop' }}</div>
                        <a href="{{ $detailUrl }}" class="product-title fs-5">{{ $laptop->name }}</a>
                        
                        <div class="product-specs-pill-row mb-3">
                            @foreach($specParts as $spec)
                                <span class="spec-micro-pill">{{ $spec }}</span>
                            @endforeach
                        </div>

                        <div class="product-pricing mt-auto">
                            <div class="d-flex align-items-baseline justify-content-between mb-3">
                                <div>
                                    <span class="price-current">₹{{ number_format($laptop->selling_price, 2) }}</span>
                                    @if($laptop->mrp > $laptop->selling_price)
                                        <span class="price-mrp">₹{{ number_format($laptop->mrp, 2) }}</span>
                                    @endif
                                </div>
                                <span class="stock-pill stock-in">
                                    <span class="pulse-dot me-1"></span> 
                                    {{ $laptop->stock > 0 ? $laptop->stock . ' In Stock' : 'Showroom Ready' }}
                                </span>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm flex-grow-1 btn-add-enquiry" 
                                        data-id="{{ $laptop->id }}" 
                                        data-name="{{ $laptop->name }}" 
                                        data-sku="{{ $laptop->sku }}" 
                                        data-price="{{ $laptop->selling_price }}">
                                    <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                                </button>
                                <a href="{{ $detailUrl }}" class="btn btn-outline-secondary btn-sm">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-laptop display-3 text-muted mb-3 d-block"></i>
                <h5>No Laptops in Catalog</h5>
                <p class="text-muted small">Check back soon or explore our full product catalog.</p>
                <a href="{{ route('products') }}" class="btn btn-primary fw-bold">View All Products</a>
            </div>
        @endforelse
    </div>
</main>
@endsection

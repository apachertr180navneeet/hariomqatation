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

<!-- Subcategory Filter Pills (Dynamic from Database) -->
<div class="bg-white py-3 border-bottom shadow-xs sticky-top" style="top: 50px; z-index: 1010;">
    <div class="container">
        <div class="pcmart-filter-tabs d-flex gap-2 overflow-auto py-1" id="subcat-pills">
            <button class="tab-btn active" data-sub="ALL">All Components</button>
            @if(isset($subcategories) && $subcategories->count() > 0)
                @foreach($subcategories as $sub)
                    <button class="tab-btn" data-sub="{{ $sub->name }}">{{ $sub->name }}</button>
                @endforeach
            @else
                <button class="tab-btn" data-sub="Processor">Processor</button>
                <button class="tab-btn" data-sub="Motherboard">Motherboard</button>
                <button class="tab-btn" data-sub="Graphics Card">Graphics Card</button>
                <button class="tab-btn" data-sub="RAM">RAM</button>
                <button class="tab-btn" data-sub="SSD">SSD</button>
                <button class="tab-btn" data-sub="SMPS/PSU">SMPS/PSU</button>
                <button class="tab-btn" data-sub="Cabinet">Cabinet</button>
            @endif
        </div>
    </div>
</div>

<!-- Dynamic Components Grid from Database -->
<main class="container my-4">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3" id="components-grid">
        @forelse($components as $item)
            @php
                $discountPct = ($item->mrp && $item->mrp > $item->selling_price) ? round((($item->mrp - $item->selling_price) / $item->mrp) * 100) : 0;
                $subName = $item->subcategory->name ?? $item->category->name ?? 'Hardware';
                $nameLower = strtolower($item->name);
                $detailUrl = route('product.details', ['id' => $item->id]);
            @endphp
            <div class="col component-item" data-subcat="{{ $subName }}">
                <div class="pcmart-product-card card h-100 border rounded-3 position-relative bg-white shadow-xs">
                    <!-- Top Badges -->
                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute top-0 start-0 end-0" style="z-index: 2;">
                        @if($discountPct > 0)
                            <span class="badge bg-danger fw-bold rounded-1" style="font-size: 0.65rem;">-{{ $discountPct }}%</span>
                        @else
                            <span class="badge bg-light text-muted border" style="font-size: 0.65rem;">GENUINE</span>
                        @endif
                        <button class="btn btn-sm btn-link text-muted p-0" title="Add to Wishlist" type="button">
                            <i class="bi bi-heart fs-6"></i>
                        </button>
                    </div>

                    <!-- Hardware Box Render Media -->
                    <div class="product-media-box p-3 text-center d-flex align-items-center justify-content-center" style="height: 145px;">
                        @if(str_contains(strtolower($subName), 'processor') && str_contains($nameLower, 'intel'))
                            <div class="hw-box-render hw-box-intel text-center">
                                <div class="hw-box-badge-tag bg-white text-primary mb-1">INTEL CORE</div>
                                <i class="bi bi-cpu-fill fs-2 mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'Intel' }}</div>
                            </div>
                        @elseif(str_contains(strtolower($subName), 'processor'))
                            <div class="hw-box-render hw-box-amd text-center">
                                <div class="hw-box-badge-tag bg-warning text-dark mb-1">RYZEN</div>
                                <i class="bi bi-cpu-fill fs-2 text-warning mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'AMD' }}</div>
                            </div>
                        @elseif(str_contains(strtolower($subName), 'graphics') || str_contains(strtolower($subName), 'gpu'))
                            <div class="hw-box-render hw-box-gpu text-center">
                                <div class="hw-box-badge-tag bg-success text-white mb-1">GRAPHICS</div>
                                <i class="bi bi-gpu-card fs-2 text-warning mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'NVIDIA' }}</div>
                            </div>
                        @elseif(str_contains(strtolower($subName), 'motherboard'))
                            <div class="hw-box-render hw-box-mb text-center">
                                <div class="hw-box-badge-tag bg-info text-dark mb-1">MOTHERBOARD</div>
                                <i class="bi bi-motherboard fs-2 text-info mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'CHIPSET' }}</div>
                            </div>
                        @elseif(str_contains(strtolower($subName), 'ram') || str_contains(strtolower($subName), 'memory'))
                            <div class="hw-box-render hw-box-ram text-center">
                                <div class="hw-box-ram-lightbar"></div>
                                <div class="hw-box-badge-tag bg-secondary text-white mb-1 mt-1">DDR4 / DDR5</div>
                                <i class="bi bi-memory fs-2 text-success mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'MEMORY' }}</div>
                            </div>
                        @elseif(str_contains(strtolower($subName), 'ssd') || str_contains(strtolower($subName), 'storage'))
                            <div class="hw-box-render hw-box-ssd text-center">
                                <div class="hw-box-badge-tag bg-danger text-white mb-1">NVMe SSD</div>
                                <i class="bi bi-device-ssd fs-2 text-danger mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'STORAGE' }}</div>
                            </div>
                        @elseif(str_contains(strtolower($subName), 'smps') || str_contains(strtolower($subName), 'psu') || str_contains(strtolower($subName), 'power'))
                            <div class="hw-box-render bg-dark text-white border text-center">
                                <div class="hw-box-badge-tag bg-warning text-dark mb-1">80+ GOLD PSU</div>
                                <i class="bi bi-plug fs-2 text-danger mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $item->brand->name ?? 'POWER' }}</div>
                            </div>
                        @else
                            <div class="hw-box-render bg-light text-dark border text-center">
                                <i class="bi bi-cpu-fill fs-2 text-primary mb-1"></i>
                                <div class="fw-bold small" style="font-size: 0.65rem;">{{ $subName }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-2.5 d-flex flex-column">
                        <span class="text-muted small mb-1" style="font-size: 0.7rem; font-weight: 600;">{{ $subName }}</span>
                        
                        <a href="{{ $detailUrl }}" class="product-card-title text-decoration-none text-dark fw-bold mb-1" title="{{ $item->name }}">
                            {{ $item->name }}
                        </a>

                        <div class="d-flex align-items-center gap-1 mb-2 small text-warning" style="font-size: 0.72rem;">
                            <i class="bi bi-star-fill"></i>
                            <span class="text-dark fw-bold ms-1">4.8</span>
                            <span class="text-muted">(1.2k)</span>
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex align-items-baseline gap-1 mb-2">
                                <strong class="fs-6 text-dark fw-black">₹{{ number_format($item->selling_price, 2) }}</strong>
                                @if($item->mrp > $item->selling_price)
                                    <span class="text-muted text-decoration-line-through small" style="font-size: 0.72rem;">₹{{ number_format($item->mrp, 2) }}</span>
                                @endif
                            </div>

                            <button class="btn btn-primary btn-sm w-100 rounded-2 fw-semibold btn-add-enquiry" 
                                    data-id="{{ $item->id }}" 
                                    data-name="{{ $item->name }}" 
                                    data-sku="{{ $item->sku }}" 
                                    data-price="{{ $item->selling_price }}">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-cpu display-3 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold">No Components Found</h5>
                <p class="text-muted small">Please check back soon or browse other hardware categories.</p>
                <a href="{{ route('products') }}" class="btn btn-primary rounded-pill px-4">Browse Catalog</a>
            </div>
        @endforelse
    </div>
</main>
@endsection

@push('scripts')
<script>
    window.__SERVER_PRODUCTS__ = @json($componentsJson ?? []);
    document.addEventListener("DOMContentLoaded", () => {
        const pills = document.querySelectorAll("#subcat-pills button");
        const items = document.querySelectorAll(".component-item");

        pills.forEach(btn => {
            btn.addEventListener("click", () => {
                pills.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const sub = btn.getAttribute("data-sub");

                items.forEach(item => {
                    const itemSub = item.getAttribute("data-subcat") || "";
                    if (sub === "ALL" || itemSub.toLowerCase().includes(sub.toLowerCase())) {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    });
</script>
@endpush

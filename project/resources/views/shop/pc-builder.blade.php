@extends('shop.includes.app')

@section('content')
<!-- PCMart Hero Header for PC Builder -->
<div class="pcmart-page-banner py-4 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">CUSTOM PC CONFIGURATOR &mdash;</span>
            <h2 class="fw-black mb-1 text-white" style="font-family: var(--hoc-font-heading);"><span class="visually-hidden">Build Your Dream PC</span>Build Your <span class="hero-highlight-cyan">Dream PC</span></h2>
            <p class="text-light text-opacity-75 small mb-0">Step-by-step component selection with real-time socket compatibility, power estimation, and instant GST quotation.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-light btn-sm rounded-pill px-3 py-2 fw-semibold" onclick="window.location.reload()">
                <i class="bi bi-arrow-clockwise me-1"></i> Reset Configurator
            </button>
            <a href="{{ route('computers') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2 fw-bold">
                <i class="bi bi-pc-display me-1"></i> View Pre-Built PCs &rarr;
            </a>
        </div>
    </div>
</div>

<!-- Main Builder Interface -->
<main class="container my-5">
    <div class="row g-4">
        <!-- Left: Component Selection Step Cards -->
        <div class="col-lg-8">
            <div id="pc-builder-app">
                <!-- Populated by pc-builder.js -->
            </div>
        </div>

        <!-- Right: Sticky Live Summary & Pricing Box -->
        <div class="col-lg-4">
            <div class="pcb-summary-sticky" style="position: sticky; top: 75px; z-index: 100;">
                <div class="card border rounded-4 p-4 bg-white shadow-xs">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-slate-900" style="font-family: var(--hoc-font-heading);">
                            <i class="bi bi-receipt me-1 text-primary"></i> Custom PC Summary
                        </h5>
                        <span class="badge bg-primary text-white fw-bold px-2 py-1" id="pcb-item-count">0 / 10</span>
                    </div>

                    <!-- Estimated Wattage Info -->
                    <div class="p-2 bg-light rounded-3 text-center small mb-3 border">
                        <i class="bi bi-lightning-charge-fill text-warning"></i> 
                        <span id="pcb-psu-rec" class="fw-bold text-slate-800">Recommended PSU: 150W+</span>
                    </div>

                    <!-- List of selected components -->
                    <div id="pcb-summary-list" class="mb-3" style="max-height: 280px; overflow-y: auto;">
                        <!-- Populated dynamically -->
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-top pt-3 mb-3">
                        <div class="d-flex justify-content-between text-muted small mb-1">
                            <span>Base Subtotal:</span>
                            <span id="pcb-subtotal" class="fw-semibold text-slate-800">₹0</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>GST (18% Included):</span>
                            <span id="pcb-gst" class="fw-semibold text-slate-800">₹0</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-baseline border-top pt-2">
                            <span class="fw-bold text-slate-900">Estimated Total:</span>
                            <span class="fs-4 fw-extrabold text-primary" id="pcb-grand-total">₹0</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary fw-bold py-2 rounded-pill shadow-sm" id="btn-request-pc-quote">
                            <i class="bi bi-file-earmark-text me-1"></i> Request Official Quotation
                        </button>
                        <button class="btn btn-outline-secondary btn-sm py-2 rounded-pill fw-semibold" id="btn-save-build">
                            <i class="bi bi-bookmark-check me-1"></i> Save Custom Build
                        </button>
                    </div>

                    <div class="text-center mt-3 pt-2 border-top">
                        <small class="text-muted" style="font-size: 0.72rem;">
                            <i class="bi bi-shield-check text-success me-1"></i> Zero assembly fees &bull; 100% Genuine brand parts
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    window.__SERVER_PRODUCTS__ = @json($productsJson ?? []);
</script>
<script src="{{ asset('assets/js/pc-builder.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof PCBuilder !== 'undefined') {
            PCBuilder.init("pc-builder-app");
        }
    });
</script>
@endpush

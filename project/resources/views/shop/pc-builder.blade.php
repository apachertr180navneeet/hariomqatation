@extends('layouts.shop')

@section('content')
<!-- Hero Header for PC Builder -->
<div class="bg-dark text-white py-4" style="background: linear-gradient(135deg, #090e1a 0%, #1e293b 100%);">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <span class="badge bg-primary px-3 py-1 mb-2">CUSTOM PC SPECIALIST</span>
                <h2 class="fw-bold mb-1">Build Your Dream PC</h2>
                <p class="text-light text-opacity-75 small mb-0">Select components step-by-step. Real-time compatibility checking ensures your CPU, socket, RAM, and PSU wattage match perfectly.</p>
            </div>
            <div>
                <button class="btn btn-outline-light btn-sm" onclick="window.location.reload()"><i class="bi bi-arrow-clockwise me-1"></i> Reset Configurator</button>
            </div>
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
            <div class="pcb-summary-sticky">
                <div class="pcb-summary-box">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-slate-900"><i class="bi bi-receipt me-1 text-primary"></i> Custom PC Summary</h5>
                        <span class="badge bg-primary-subtle text-primary fw-bold" id="pcb-item-count">0 / 10</span>
                    </div>

                    <!-- Estimated Wattage Info -->
                    <div class="p-2 bg-light rounded text-center small mb-3 border">
                        <i class="bi bi-lightning-charge text-warning"></i> <span id="pcb-psu-rec" class="fw-bold">Recommended PSU: 150W+</span>
                    </div>

                    <!-- List of selected components -->
                    <div id="pcb-summary-list" class="mb-3" style="max-height: 280px; overflow-y: auto;">
                        <!-- Populated dynamically -->
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-top pt-3 mb-3">
                        <div class="d-flex justify-content-between text-muted small mb-1">
                            <span>Base Subtotal:</span>
                            <span id="pcb-subtotal">₹0</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>GST (18% Included):</span>
                            <span id="pcb-gst">₹0</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-baseline border-top pt-2">
                            <span class="fw-bold text-slate-800">Estimated Total:</span>
                            <span class="fs-4 fw-extrabold text-primary" id="pcb-grand-total">₹0</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary fw-bold py-2 shadow-sm" id="btn-request-pc-quote">
                            <i class="bi bi-file-earmark-text me-1"></i> Request Official Quotation
                        </button>
                        <button class="btn btn-outline-secondary btn-sm py-2" id="btn-save-build">
                            <i class="bi bi-bookmark-check me-1"></i> Save Custom Build
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/pc-builder.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof PCBuilder !== 'undefined') {
            PCBuilder.init("pc-builder-app");
        }
    });
</script>
@endpush

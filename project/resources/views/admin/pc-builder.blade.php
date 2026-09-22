@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/store.css') }}">
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Custom Rig Configurator</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Live Socket & Power Validation</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Builder Components -->
    <div class="col-lg-8">
        <div id="admin-pc-builder-app">
            <!-- Populated via pc-builder.js -->
        </div>
    </div>

    <!-- Sticky Summary -->
    <div class="col-lg-4">
        <div class="pcb-summary-sticky">
            <div class="pcb-summary-box">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                    <h5 class="fw-bold mb-0 text-slate-900"><i class="bi bi-receipt text-primary me-1"></i> PC Build Breakdown</h5>
                    <span class="badge bg-primary-subtle text-primary" id="pcb-item-count">0 / 10</span>
                </div>

                <div class="p-2 bg-light rounded text-center small mb-3 border">
                    <i class="bi bi-lightning-charge text-warning"></i> <span id="pcb-psu-rec" class="fw-bold">Recommended PSU: 150W+</span>
                </div>

                <div id="pcb-summary-list" class="mb-3" style="max-height: 250px; overflow-y: auto;">
                    <!-- Populated dynamically -->
                </div>

                <div class="border-top pt-3 mb-3">
                    <div class="d-flex justify-content-between text-muted small mb-1">
                        <span>Taxable Subtotal:</span>
                        <span id="pcb-subtotal">₹0</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>GST (18% Included):</span>
                        <span id="pcb-gst">₹0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-baseline border-top pt-2">
                        <span class="fw-bold">Build Total:</span>
                        <span class="fs-4 fw-extrabold text-primary" id="pcb-grand-total">₹0</span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary fw-bold py-2 shadow-sm" id="btn-request-pc-quote">
                        <i class="bi bi-plus-circle me-1"></i> Create Direct Quotation
                    </button>
                    <button class="btn btn-outline-secondary btn-sm py-2" id="btn-save-build">
                        <i class="bi bi-bookmark-check me-1"></i> Save As Preset Build
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/pc-builder.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        PCBuilder.init("admin-pc-builder-app");

        // Hook up direct quotation creation
        const quoteBtn = document.getElementById("btn-request-pc-quote");
        if (quoteBtn) {
            quoteBtn.addEventListener("click", () => {
                const quoteCreateUrl = window.HOC_ADMIN_ROUTES?.quotationCreate || "{{ route('admin.quotations.create') }}";
                window.location.href = quoteCreateUrl;
            });
        }
    });
</script>
@endpush

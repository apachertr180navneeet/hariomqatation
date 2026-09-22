@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Desktop Systems & Workstations</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Pre-Configured Computer Towers</span>
        </div>
    </div>
</div>

<div class="row g-4" id="admin-computers-cards">
    <!-- Populated via JS -->
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById("admin-computers-cards");
        const pcs = DataStore.getProducts().filter(p => p.category === "Desktop Computers");

        let html = "";
        pcs.forEach(p => {
            const pViewUrl = `/admin/products/view?id=${encodeURIComponent(p.id)}`;
            const quoteCreateUrl = "{{ route('admin.quotations.create') }}";

            html += `
                <div class="col-md-6">
                    <div class="admin-card h-100 p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary">${p.subcategory || 'Workstation'}</span>
                            <span class="badge bg-success">${p.stock} Units Ready</span>
                        </div>
                        <h5 class="fw-bold text-slate-900 mb-1">${p.name}</h5>
                        <small class="text-muted d-block mb-3">SKU: ${p.sku} | Model: ${p.model || 'Tower Rig'}</small>
                        <p class="small text-muted mb-3 bg-light p-2 rounded border">${p.specs}</p>
                        <div class="d-flex justify-content-between align-items-baseline pt-2 border-top mt-auto">
                            <div>
                                <span class="text-muted small">Selling Price:</span>
                                <div class="fs-5 fw-bold text-primary">${HOC_UTILS.formatINR(p.sellingPrice)}</div>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <a href="${pViewUrl}" class="btn btn-outline-secondary"><i class="bi bi-eye me-1"></i> View</a>
                                <a href="${quoteCreateUrl}" class="btn btn-outline-primary"><i class="bi bi-plus-lg me-1"></i> Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;
    });
</script>
@endpush

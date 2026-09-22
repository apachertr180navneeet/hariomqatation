@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Categories & Taxonomy</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Catalog Taxonomy</span>
        </div>
    </div>
</div>

<div class="row g-4" id="categories-container">
    <!-- Populated via JS -->
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById("categories-container");
        const cats = DataStore.get().categories || [];

        let html = "";
        cats.forEach(cat => {
            html += `
                <div class="col-md-6 col-lg-4">
                    <div class="admin-card h-100 p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-primary-subtle text-primary p-3 fs-3">
                                <i class="bi ${cat.icon}"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-slate-900">${cat.name}</h5>
                                <small class="text-muted">${cat.subcategories.length} Subcategories</small>
                            </div>
                        </div>
                        <h6 class="small fw-bold text-muted text-uppercase mb-2">Subcategories:</h6>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            ${cat.subcategories.map(sub => `<span class="badge bg-light text-dark border">${sub}</span>`).join('')}
                        </div>
                        <div class="d-flex justify-content-between pt-3 border-top mt-auto">
                            <button class="btn btn-sm btn-outline-primary" onclick="alert('Edit category: ${cat.name}')"><i class="bi bi-pencil me-1"></i> Edit</button>
                            <button class="btn btn-sm btn-outline-secondary" onclick="alert('Add subcategory to ${cat.name}')"><i class="bi bi-plus"></i> Add Sub</button>
                        </div>
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;
    });
</script>
@endpush

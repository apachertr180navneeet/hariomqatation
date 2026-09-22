@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Desktop Systems & Workstations</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Pre-Configured Computer Towers ({{ $computers->count() }} builds)</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.pc.builder') }}" class="btn btn-outline-primary">
            <i class="bi bi-motherboard me-1"></i> Open PC Builder
        </a>
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Add Desktop PC
        </a>
    </div>
</div>

<div class="row g-4" id="admin-computers-cards">
    @forelse($computers as $pc)
        <div class="col-md-6">
            <div class="admin-card h-100 p-4 shadow-sm d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge bg-primary">{{ $pc->subcategory->name ?? 'Desktop Computer' }}</span>
                    <span class="badge {{ $pc->stock > $pc->min_stock ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ $pc->stock }} Units Ready
                    </span>
                </div>
                <h5 class="fw-bold text-slate-900 mb-1">
                    <a href="{{ route('admin.products.view', ['id' => $pc->id]) }}" class="text-decoration-none text-dark">
                        {{ $pc->name }}
                    </a>
                </h5>
                <small class="text-muted d-block mb-3">
                    SKU: <code>{{ $pc->sku }}</code> &bull; Model: <strong>{{ $pc->model ?: 'Custom Build' }}</strong>
                </small>

                <p class="small text-slate-700 mb-3 bg-light p-3 rounded border">
                    <i class="bi bi-cpu text-primary me-1"></i> {{ $pc->specs }}
                </p>

                <div class="d-flex justify-content-between align-items-baseline pt-3 border-top mt-auto">
                    <div>
                        <span class="text-muted small d-block">Selling Price (Incl GST):</span>
                        <div class="fs-5 fw-bold text-primary">₹{{ number_format($pc->selling_price, 2) }}</div>
                    </div>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('admin.products.view', ['id' => $pc->id]) }}" class="btn btn-outline-secondary" title="View Details">
                            <i class="bi bi-eye me-1"></i> View
                        </a>
                        <a href="{{ route('admin.products.edit', $pc->id) }}" class="btn btn-outline-primary" title="Edit Rig Specs">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.quotations.create') }}" class="btn btn-outline-success" title="Add to Commercial Quote">
                            <i class="bi bi-file-earmark-plus me-1"></i> Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="admin-card p-5 text-center">
                <i class="bi bi-pc-display display-4 text-muted mb-3"></i>
                <h5>No Pre-Built Desktop Computers Found</h5>
                <p class="text-muted">Create pre-built PC configurations or office towers for quick quoting.</p>
                <a href="{{ route('admin.products.add') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Desktop PC
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection

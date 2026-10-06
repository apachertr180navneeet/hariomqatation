@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Stock Ledger History</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $movements->total() }} Transactions
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <a href="{{ route('admin.inventory') }}" class="text-decoration-none text-muted">Inventory Ledger</a>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">{{ $product->name }}</span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.products.view', ['id' => $product->id]) }}" class="btn btn-outline-primary fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-eye me-1"></i> Product Inspection
        </a>
        <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Inventory
        </a>
    </div>
</div>

<!-- Product Profile Banner Card -->
<div class="catalog-card p-4 mb-4 shadow-sm">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="catalog-avatar-box" style="width: 56px; height: 56px; font-size: 1.6rem;">
                <i class="bi {{ $product->category->icon ?? 'bi-box-seam' }}"></i>
            </div>
            <div>
                <h4 class="fw-bold text-slate-900 mb-1">{{ $product->name }}</h4>
                <div class="d-flex flex-wrap align-items-center gap-2 small">
                    <span class="catalog-sku-code">{{ $product->sku }}</span>
                    <span class="badge bg-light text-slate-700 border">Brand: <strong>{{ $product->brand->name ?? 'Generic' }}</strong></span>
                    <span class="badge bg-light text-slate-700 border">Category: <strong>{{ $product->category->name ?? '-' }}</strong></span>
                    <span class="badge bg-light text-slate-700 border">Selling Price: <strong>₹{{ number_format($product->selling_price, 2) }}</strong></span>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="text-end">
                <span class="text-muted small fw-bold text-uppercase d-block">Current Stock On Hand</span>
                <span class="fs-3 fw-extrabold {{ $product->stock > $product->min_stock ? 'text-success' : ($product->stock > 0 ? 'text-warning' : 'text-danger') }}">
                    {{ $product->stock }} <span class="fs-6 fw-normal text-muted">Units</span>
                </span>
            </div>
            <span class="stock-status-pill {{ $product->stock > $product->min_stock ? 'healthy' : ($product->stock > 0 ? 'low' : 'out') }} p-2 px-3">
                <span class="stock-dot"></span>
                <span>{{ $product->stock > $product->min_stock ? 'In Stock' : ($product->stock > 0 ? 'Low Stock' : 'Out of Stock') }}</span>
            </span>
        </div>
    </div>
</div>

<!-- Movement Transactions Table -->
<div class="catalog-card shadow-sm">
    <div class="catalog-card-header">
        <h5 class="fw-bold text-slate-900 mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-clock-history text-primary"></i>
            <span>Audit Trail & Movement Records</span>
        </h5>
        <span class="badge bg-light text-slate-700 border rounded-pill px-3 py-1.5 fw-semibold">
            Showing {{ $movements->firstItem() ?? 0 }}-{{ $movements->lastItem() ?? 0 }} of {{ $movements->total() }} entries
        </span>
    </div>

    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Transaction Type</th>
                    <th>Reference / Invoice</th>
                    <th class="text-center">Quantity Change</th>
                    <th class="text-center">Balance After</th>
                    <th class="text-end">Unit Cost (₹)</th>
                    <th>Audit Remarks / Notes</th>
                    <th>Recorded By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $m)
                    @php
                        $isPositive = $m->quantity > 0;
                        $typeConfig = match($m->type) {
                            'inward' => ['badge' => 'bg-success-subtle text-success border border-success-subtle', 'icon' => 'bi-box-arrow-in-down', 'label' => 'Stock Inward'],
                            'initial' => ['badge' => 'bg-primary-subtle text-primary border border-primary-subtle', 'icon' => 'bi-stars', 'label' => 'Initial Stock'],
                            'adjustment' => ['badge' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle', 'icon' => 'bi-sliders', 'label' => 'Audit Adjust'],
                            'sale' => ['badge' => 'bg-info-subtle text-info-emphasis border border-info-subtle', 'icon' => 'bi-receipt', 'label' => 'Customer Sale'],
                            'return' => ['badge' => 'bg-purple-subtle text-purple border', 'icon' => 'bi-arrow-return-left', 'label' => 'Stock Return'],
                            default => ['badge' => 'bg-secondary-subtle text-secondary border', 'icon' => 'bi-arrow-left-right', 'label' => ucfirst($m->type)],
                        };
                    @endphp
                    <tr>
                        <td>
                            <div class="fw-semibold text-slate-900">{{ $m->created_at->format('d M Y') }}</div>
                            <small class="text-muted font-monospace">{{ $m->created_at->format('h:i A') }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $typeConfig['badge'] }} rounded-pill px-2.5 py-1 fw-bold d-inline-flex align-items-center gap-1.5">
                                <i class="bi {{ $typeConfig['icon'] }}"></i>
                                <span>{{ $typeConfig['label'] }}</span>
                            </span>
                        </td>
                        <td>
                            @if($m->reference_no)
                                <span class="catalog-sku-code">{{ $m->reference_no }}</span>
                            @else
                                <span class="text-muted small">&mdash;</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="fs-6 fw-extrabold {{ $isPositive ? 'text-success' : 'text-danger' }}">
                                {{ $isPositive ? '+' . $m->quantity : $m->quantity }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-slate-900 border font-monospace px-2.5 py-1.5 fw-bold fs-7">
                                {{ $m->balance_after }}
                            </span>
                        </td>
                        <td class="text-end">
                            <span class="fw-semibold text-slate-800">
                                {{ $m->unit_cost ? '₹' . number_format($m->unit_cost, 2) : '&mdash;' }}
                            </span>
                        </td>
                        <td>
                            <span class="text-slate-700 small">{{ $m->notes ?: 'Regular stock movement' }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1.5 small text-muted">
                                <i class="bi bi-person-circle text-slate-400"></i>
                                <span>{{ $m->user->name ?? 'Admin System' }}</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-clock-history display-5 text-muted mb-3 d-block opacity-50"></i>
                                <h5 class="fw-bold text-slate-900 mb-1">No Movement History Yet</h5>
                                <p class="text-muted small mb-0">No stock receipts, sales deductions, or audits recorded for this SKU.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($movements->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $movements->firstItem() }}</strong> to <strong>{{ $movements->lastItem() }}</strong> of <strong>{{ $movements->total() }}</strong> total ledger transactions
            </div>
            <div>
                {{ $movements->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

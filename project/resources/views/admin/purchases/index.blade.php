@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Inward Purchase Bills</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $totalPurchasesCount }} Total Inwards
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Procurement & Inventory</span> 
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Distributor Inwards & Input Tax Credit (ITC)</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.suppliers') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-truck"></i>
            <span>Distributors</span>
        </a>
        <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Record Inward Bill</span>
        </a>
    </div>
</div>

<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm mb-4 border-0" role="alert">
        <i class="bi bi-check-circle-fill fs-5 text-success"></i>
        <div class="fw-medium">{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm mb-4 border-0" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
        <div class="fw-medium">{{ session('error') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Gross Purchasing</div>
                    <div class="catalog-kpi-val">₹{{ number_format($totalPurchased, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-boxes text-primary"></i> Total stock procurement</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-box-arrow-in-down"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Settled / Paid</div>
                    <div class="catalog-kpi-val text-success">₹{{ number_format($totalPaid, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-check2-circle text-success"></i> Paid to distributors</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $totalOutstanding > 0 ? 'kpi-rose' : 'kpi-emerald' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Outstanding Payables</div>
                    <div class="catalog-kpi-val {{ $totalOutstanding > 0 ? 'text-danger' : 'text-success' }}">
                        ₹{{ number_format($totalOutstanding, 0) }}
                    </div>
                    <div class="catalog-kpi-sub">
                        @if($totalOutstanding > 0)
                            <span class="text-danger fw-bold"><i class="bi bi-hourglass-split"></i> Pending vendor settlement</span>
                        @else
                            <span class="text-success fw-bold"><i class="bi bi-shield-check"></i> Zero pending payables</span>
                        @endif
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $totalOutstanding > 0 ? 'icon-rose' : 'icon-emerald' }}">
                    <i class="bi {{ $totalOutstanding > 0 ? 'bi-exclamation-octagon' : 'bi-shield-check' }}"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Input Tax Credit (ITC)</div>
                    <div class="catalog-kpi-val text-indigo">₹{{ number_format($totalInputGst, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-receipt-cutoff text-indigo"></i> Claimable GST (GSTR-2B)</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-percent"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Status Filter Toolbar -->
<div class="catalog-filter-card mb-4">
    <form method="GET" action="{{ route('admin.purchases') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 m-0">
        <!-- Search Box -->
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 420px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="catalog-search-input" 
                   value="{{ request('search') }}"
                   placeholder="Search purchase #, vendor bill #, distributor...">
        </div>

        <!-- Filter Pill Tabs -->
        <div class="filter-pills-bar">
            <a href="{{ route('admin.purchases', array_merge(request()->except('status'), ['status' => 'ALL'])) }}" 
               class="filter-pill {{ ($currentStatus === 'ALL' || !$currentStatus) ? 'active' : '' }}">
                All Inwards ({{ $totalPurchasesCount }})
            </a>
            <a href="{{ route('admin.purchases', array_merge(request()->except('status'), ['status' => 'Paid'])) }}" 
               class="filter-pill {{ $currentStatus === 'Paid' ? 'active' : '' }}">
                Paid
            </a>
            <a href="{{ route('admin.purchases', array_merge(request()->except('status'), ['status' => 'Partial'])) }}" 
               class="filter-pill {{ $currentStatus === 'Partial' ? 'active' : '' }}">
                Partial
            </a>
            <a href="{{ route('admin.purchases', array_merge(request()->except('status'), ['status' => 'Unpaid'])) }}" 
               class="filter-pill {{ $currentStatus === 'Unpaid' ? 'active' : '' }}">
                Unpaid
            </a>
        </div>
    </form>
</div>

<!-- Purchases Inward Table -->
<div class="catalog-card shadow-sm p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table catalog-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Purchase ID</th>
                    <th>Distributor / Supplier</th>
                    <th>Vendor Bill No</th>
                    <th>Date / Due Date</th>
                    <th>Inward Items</th>
                    <th class="text-end">Taxable (₹)</th>
                    <th class="text-end">GST (ITC)</th>
                    <th class="text-end">Grand Total (₹)</th>
                    <th class="text-center">Payment</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td class="ps-4">
                            <a href="{{ route('admin.purchases.show', $purchase->id) }}" class="fw-bold text-primary text-decoration-none font-monospace">
                                {{ $purchase->purchase_no }}
                            </a>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $purchase->supplier->company }}</div>
                            <small class="text-muted">{{ $purchase->supplier->name }}</small>
                            @if($purchase->supplier->gstin)
                                <small class="text-muted d-block font-monospace fs-8">GST: {{ $purchase->supplier->gstin }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border font-monospace px-2.5 py-1">
                                {{ $purchase->supplier_invoice_no }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-semibold text-slate-800">{{ $purchase->purchase_date->format('d M, Y') }}</div>
                            @if($purchase->due_date)
                                <small class="text-muted">Due: {{ $purchase->due_date->format('d M, Y') }}</small>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1.5 flex-wrap" style="max-width: 200px;">
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-0.5 fw-bold">
                                    {{ $purchase->items->count() }} Items
                                </span>
                                <small class="text-muted text-truncate d-inline-block" style="max-width: 130px;">
                                    {{ $purchase->items->first()?->item_name }}
                                </small>
                            </div>
                        </td>
                        <td class="text-end font-monospace text-slate-700">
                            ₹{{ number_format($purchase->taxable_amount, 2) }}
                        </td>
                        <td class="text-end font-monospace text-indigo fw-semibold">
                            ₹{{ number_format($purchase->gst_total, 2) }}
                        </td>
                        <td class="text-end font-monospace fw-bold text-dark fs-6">
                            ₹{{ number_format($purchase->grand_total, 2) }}
                        </td>
                        <td class="text-center">
                            @if($purchase->payment_status === 'Paid')
                                <span class="badge badge-soft-success">Paid</span>
                            @elseif($purchase->payment_status === 'Partial')
                                <span class="badge badge-soft-warning">Partial</span>
                            @else
                                <span class="badge badge-soft-danger">Unpaid</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.purchases.show', $purchase->id) }}" 
                                   class="catalog-action-btn btn-view" title="View Inward Bill Receipt">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.purchases.show', $purchase->id) }}" target="_blank"
                                   class="catalog-action-btn btn-print" title="Print Goods Receipt">
                                    <i class="bi bi-printer"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <div class="py-4">
                                <i class="bi bi-box-arrow-in-down display-5 text-muted mb-3 d-block"></i>
                                <h5>No Inward Purchase Bills Found</h5>
                                <p class="text-muted small">No vendor inward invoices match your filter criteria.</p>
                                <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle me-1"></i> Record New Inward Purchase
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($purchases->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $purchases->firstItem() ?? 0 }}-{{ $purchases->lastItem() ?? 0 }}</strong> of <strong>{{ $purchases->total() }}</strong> bills
            </div>
            <div>
                {{ $purchases->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

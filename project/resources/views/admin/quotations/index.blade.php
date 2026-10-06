@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Quotations Directory</h1>
        <div class="page-breadcrumb text-muted small mt-1">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Commercial Proposals</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">GST Quotations</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary fw-bold shadow-sm rounded-3 px-3 py-2">
            <i class="bi bi-plus-circle-fill me-1"></i> New Quotation
        </a>
    </div>
</div>

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 d-flex align-items-center gap-3">
            <div class="rounded-3 bg-primary-subtle text-primary p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <small class="text-muted fw-semibold text-uppercase">Total Proposals</small>
                <div class="fs-4 fw-extrabold text-slate-900">{{ $metrics['total'] }}</div>
                <small class="text-muted">Issued to date</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 d-flex align-items-center gap-3">
            <div class="rounded-3 bg-warning-subtle text-warning-emphasis p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <small class="text-muted fw-semibold text-uppercase">Pending / Draft</small>
                <div class="fs-4 fw-extrabold text-slate-900">{{ $metrics['pending'] }}</div>
                <small class="text-muted">Awaiting decision</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 d-flex align-items-center gap-3">
            <div class="rounded-3 bg-success-subtle text-success p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <small class="text-muted fw-semibold text-uppercase">Approved</small>
                <div class="fs-4 fw-extrabold text-slate-900">{{ $metrics['approved'] }}</div>
                <small class="text-muted">Ready for sale</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 d-flex align-items-center gap-3">
            <div class="rounded-3 bg-info-subtle text-info-emphasis p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                <i class="bi bi-currency-rupee"></i>
            </div>
            <div>
                <small class="text-muted fw-semibold text-uppercase">Pipeline Value</small>
                <div class="fs-4 fw-extrabold text-slate-900">₹{{ number_format($metrics['total_value']) }}</div>
                <small class="text-muted">Total quotation value</small>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search Bar -->
<div class="catalog-filter-card mb-4">
    <form method="GET" action="{{ route('admin.quotations') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 m-0">
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 440px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="catalog-search-input" 
                   placeholder="Search Quotation No, Customer, Phone, Firm..." 
                   value="{{ $search }}">
        </div>

        <div class="filter-pills-bar">
            <a href="{{ route('admin.quotations', array_merge(request()->except('status'), ['status' => 'ALL'])) }}" 
               class="filter-pill {{ ($currentStatus === 'ALL' || !$currentStatus) ? 'active' : '' }}">
                All ({{ $metrics['total'] }})
            </a>
            <a href="{{ route('admin.quotations', array_merge(request()->except('status'), ['status' => 'Approved'])) }}" 
               class="filter-pill {{ $currentStatus === 'Approved' ? 'active' : '' }}">
                Approved ({{ $metrics['approved'] }})
            </a>
            <a href="{{ route('admin.quotations', array_merge(request()->except('status'), ['status' => 'Pending'])) }}" 
               class="filter-pill {{ $currentStatus === 'Pending' ? 'active' : '' }}">
                Pending ({{ $metrics['pending'] }})
            </a>
            <a href="{{ route('admin.quotations', array_merge(request()->except('status'), ['status' => 'Draft'])) }}" 
               class="filter-pill {{ $currentStatus === 'Draft' ? 'active' : '' }}">
                Draft
            </a>
        </div>
    </form>
</div>

<!-- Quotations Directory Table Card -->
<div class="catalog-card shadow-sm p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Quotation No</th>
                    <th>Customer & Firm</th>
                    <th>Issue Date</th>
                    <th>Valid Until</th>
                    <th class="text-center">Items</th>
                    <th class="text-end">Grand Total</th>
                    <th class="text-center">Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotations as $quote)
                    @php
                        $statusPill = match($quote->status) {
                            'Approved', 'Converted' => 'healthy',
                            'Sent', 'Pending' => 'low',
                            'Rejected' => 'out',
                            default => 'low',
                        };
                    @endphp
                    <tr>
                        <td class="ps-4">
                            <a href="{{ route('admin.quotations.view', ['id' => $quote->id]) }}" class="fw-bold text-primary font-monospace text-decoration-none">
                                {{ $quote->quotation_no }}
                            </a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2.5">
                                <div class="catalog-avatar-box" style="width: 36px; height: 36px; font-size: 0.9rem;">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div>
                                    <strong class="d-block text-slate-900">{{ $quote->customer_name }}</strong>
                                    <small class="text-muted">
                                        @if($quote->customer_company)
                                            <span class="text-slate-700 fw-medium">{{ $quote->customer_company }}</span> &bull;
                                        @endif
                                        <i class="bi bi-telephone text-slate-400"></i> {{ $quote->customer_phone }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-slate-700 small">{{ $quote->quotation_date ? $quote->quotation_date->format('d M, Y') : 'N/A' }}</span>
                        </td>
                        <td>
                            @if($quote->valid_until && $quote->valid_until->isPast() && !in_array($quote->status, ['Approved', 'Converted']))
                                <span class="text-danger fw-semibold small" title="Expired proposal">
                                    {{ $quote->valid_until->format('d M, Y') }} <i class="bi bi-exclamation-circle-fill"></i>
                                </span>
                            @else
                                <span class="text-muted small">{{ $quote->valid_until ? $quote->valid_until->format('d M, Y') : 'N/A' }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-slate-700 border rounded-pill px-2.5 py-1 fw-semibold">
                                {{ $quote->items_count }} {{ Str::plural('item', $quote->items_count) }}
                            </span>
                        </td>
                        <td class="text-end fw-bold fs-6 text-slate-900">
                            ₹{{ number_format($quote->grand_total, 2) }}
                        </td>
                        <td class="text-center">
                            <div class="dropdown d-inline-block">
                                <button class="stock-status-pill {{ $statusPill }} dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="stock-dot"></span>
                                    <span>{{ $quote->status }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li><h6 class="dropdown-header">Change Status</h6></li>
                                    @foreach(['Draft', 'Sent', 'Pending', 'Approved', 'Rejected'] as $st)
                                        @if($quote->status !== $st)
                                            <li>
                                                <form method="POST" action="{{ route('admin.quotations.status', $quote->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $st }}">
                                                    <button type="submit" class="dropdown-item small">Mark as {{ $st }}</button>
                                                </form>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.quotations.view', ['id' => $quote->id]) }}" class="catalog-action-btn btn-view" title="Inspect Quotation">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.quotations.print', ['id' => $quote->id]) }}" target="_blank" class="catalog-action-btn btn-print" title="Print Executive Letterhead">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.quotations.destroy', $quote->id) }}" class="d-inline delete-form m-0" 
                                      data-confirm-title="Delete Quotation?" 
                                      data-confirm="Are you sure you want to delete quotation &quot;{{ $quote->quotation_no }}&quot;? This cannot be undone.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="catalog-action-btn btn-danger" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-file-earmark-x display-5 text-muted mb-3 d-block opacity-50"></i>
                                <h5 class="fw-bold text-slate-900 mb-1">No Quotations Found</h5>
                                <p class="text-muted small mb-3">No commercial quotations match the active filter criteria.</p>
                                <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3">
                                    <i class="bi bi-plus-lg me-1"></i> Create First Quotation
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($quotations->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $quotations->firstItem() ?? 0 }}-{{ $quotations->lastItem() ?? 0 }}</strong> of <strong>{{ $quotations->total() }}</strong> proposals
            </div>
            <div>
                {{ $quotations->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

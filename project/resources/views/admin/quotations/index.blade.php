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
<div class="admin-card mb-4">
    <div class="p-3 border-bottom bg-light bg-opacity-50">
        <form method="GET" action="{{ route('admin.quotations') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-white" 
                           placeholder="Search Quotation No, Customer, Phone, Firm..." 
                           value="{{ $search }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select form-select-sm bg-white" onchange="this.form.submit()">
                    <option value="ALL" {{ $currentStatus === 'ALL' ? 'selected' : '' }}>All Statuses (Draft, Sent, Pending, Approved)</option>
                    <option value="Draft" {{ $currentStatus === 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Sent" {{ $currentStatus === 'Sent' ? 'selected' : '' }}>Sent</option>
                    <option value="Pending" {{ $currentStatus === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $currentStatus === 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Converted" {{ $currentStatus === 'Converted' ? 'selected' : '' }}>Converted to Sale</option>
                    <option value="Rejected" {{ $currentStatus === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-md-3 text-md-end">
                <button type="submit" class="btn btn-sm btn-primary fw-semibold px-3">Filter</button>
                @if($search || $currentStatus !== 'ALL')
                    <a href="{{ route('admin.quotations') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Quotation No</th>
                    <th>Customer & Firm</th>
                    <th>Issue Date</th>
                    <th>Valid Until</th>
                    <th class="text-center">Items</th>
                    <th class="text-end">Grand Total</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotations as $quote)
                    @php
                        $statusBadge = match($quote->status) {
                            'Approved' => 'badge-soft-success',
                            'Converted' => 'badge-soft-primary',
                            'Sent', 'Pending' => 'badge-soft-warning',
                            'Rejected' => 'badge-soft-danger',
                            default => 'badge-soft-secondary',
                        };
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('admin.quotations.view', ['id' => $quote->id]) }}" class="fw-bold text-primary text-decoration-none">
                                {{ $quote->quotation_no }}
                            </a>
                        </td>
                        <td>
                            <strong class="d-block text-slate-900">{{ $quote->customer_name }}</strong>
                            <small class="text-muted">
                                @if($quote->customer_company)
                                    {{ $quote->customer_company }} &bull;
                                @endif
                                <i class="bi bi-telephone text-slate-400"></i> {{ $quote->customer_phone }}
                            </small>
                        </td>
                        <td class="text-muted small">
                            {{ $quote->quotation_date ? $quote->quotation_date->format('d M, Y') : 'N/A' }}
                        </td>
                        <td class="small">
                            @if($quote->valid_until && $quote->valid_until->isPast() && !in_array($quote->status, ['Approved', 'Converted']))
                                <span class="text-danger fw-semibold" title="Expired proposal">
                                    {{ $quote->valid_until->format('d M, Y') }} <i class="bi bi-exclamation-circle-fill"></i>
                                </span>
                            @else
                                <span class="text-muted">{{ $quote->valid_until ? $quote->valid_until->format('d M, Y') : 'N/A' }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1">
                                {{ $quote->items_count }} {{ Str::plural('item', $quote->items_count) }}
                            </span>
                        </td>
                        <td class="text-end fw-bold fs-6 text-slate-900">
                            ₹{{ number_format($quote->grand_total, 2) }}
                        </td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <button class="badge {{ $statusBadge }} dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $quote->status }}
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
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.quotations.view', ['id' => $quote->id]) }}" class="btn btn-outline-secondary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.quotations.print', ['id' => $quote->id]) }}" target="_blank" class="btn btn-outline-primary" title="Print Letterhead">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.quotations.destroy', $quote->id) }}" class="d-inline delete-form" 
                                      data-confirm-title="Delete Quotation?" 
                                      data-confirm="Are you sure you want to delete quotation &quot;{{ $quote->quotation_no }}&quot;? This cannot be undone.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="mb-3"><i class="bi bi-file-earmark-x display-4 text-muted"></i></div>
                            <h5 class="fw-bold text-dark">No Quotations Found</h5>
                            <p class="text-muted small">No quotations match the active search or status criteria.</p>
                            <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="bi bi-plus-lg me-1"></i> Create First Quotation
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($quotations->hasPages())
        <div class="p-3 border-top d-flex justify-content-end">
            {{ $quotations->links() }}
        </div>
    @endif
</div>
@endsection

@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Sales Orders & Tax Invoices</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $totalInvoicesCount }} GST Tax Invoices
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Commercial Billing</span> 
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Official GST Invoices (HOC/INV/YYYY/XXXX)</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.quotations') }}" class="btn btn-outline-primary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-file-earmark-check"></i>
            <span>Convert from Quotation</span>
        </a>
    </div>
</div>

<!-- Financial KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Gross Billed Sales</div>
                    <div class="catalog-kpi-val text-success">₹{{ number_format($totalInvoiced, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-receipt text-success"></i> Across {{ $totalInvoicesCount }} tax invoices</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Collected Payments</div>
                    <div class="catalog-kpi-val text-primary">₹{{ number_format($totalCollected, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-wallet2 text-primary"></i> Bank & UPI cleared</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-credit-card-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $totalOutstanding > 0 ? 'kpi-rose' : 'kpi-indigo' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Outstanding Receivables</div>
                    <div class="catalog-kpi-val {{ $totalOutstanding > 0 ? 'text-danger' : 'text-indigo' }}">
                        ₹{{ number_format($totalOutstanding, 0) }}
                    </div>
                    <div class="catalog-kpi-sub">
                        @if($totalOutstanding > 0)
                            <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill"></i> Due from clients</span>
                        @else
                            <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> Zero pending dues</span>
                        @endif
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $totalOutstanding > 0 ? 'icon-rose' : 'icon-indigo' }}">
                    <i class="bi {{ $totalOutstanding > 0 ? 'bi-hourglass-split' : 'bi-shield-check' }}"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Settlement Rate</div>
                    <div class="catalog-kpi-val text-indigo">
                        {{ $totalInvoicesCount > 0 ? round(($paidInvoicesCount / $totalInvoicesCount) * 100) : 100 }}%
                    </div>
                    <div class="catalog-kpi-sub"><i class="bi bi-check2-all text-indigo"></i> {{ $paidInvoicesCount }} / {{ $totalInvoicesCount }} Fully Paid</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Status Toolbar -->
<div class="catalog-filter-card mb-4">
    <form method="GET" action="{{ route('admin.sales') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 m-0">
        <!-- Live Search -->
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 420px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="catalog-search-input" 
                   value="{{ request('search') }}"
                   placeholder="Search invoice number, client, phone, GSTIN...">
        </div>

        <!-- Filter Pill Tabs -->
        <div class="filter-pills-bar">
            <a href="{{ route('admin.sales', array_merge(request()->except('status'), ['status' => 'ALL'])) }}" 
               class="filter-pill {{ ($currentStatus === 'ALL' || !$currentStatus) ? 'active' : '' }}">
                All ({{ $totalInvoicesCount }})
            </a>
            <a href="{{ route('admin.sales', array_merge(request()->except('status'), ['status' => 'Paid'])) }}" 
               class="filter-pill {{ $currentStatus === 'Paid' ? 'active' : '' }}">
                Paid ({{ $paidInvoicesCount }})
            </a>
            <a href="{{ route('admin.sales', array_merge(request()->except('status'), ['status' => 'Partial'])) }}" 
               class="filter-pill {{ $currentStatus === 'Partial' ? 'active' : '' }}">
                Partial
            </a>
            <a href="{{ route('admin.sales', array_merge(request()->except('status'), ['status' => 'Unpaid'])) }}" 
               class="filter-pill {{ $currentStatus === 'Unpaid' ? 'active' : '' }}">
                Unpaid
            </a>
        </div>
    </form>
</div>

<!-- Invoices Ledger Table -->
<div class="catalog-card shadow-sm p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 170px;">Tax Invoice No</th>
                    <th>Linked Quotation</th>
                    <th>Customer & Firm</th>
                    <th>Date</th>
                    <th class="text-end">Invoice Amount</th>
                    <th class="text-center">Payment Mode</th>
                    <th class="text-center">Status</th>
                    <th class="text-end" style="min-width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    @php
                        $payPillClass = match($invoice->payment_status) {
                            'Paid' => 'healthy',
                            'Partial' => 'low',
                            'Unpaid' => 'out',
                            default => 'healthy'
                        };
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('admin.invoices.view', ['id' => $invoice->id]) }}" class="fw-bold text-primary font-monospace text-decoration-none fs-6">
                                {{ $invoice->invoice_no }}
                            </a>
                        </td>
                        <td>
                            @if($invoice->quotation)
                                <a href="{{ route('admin.quotations.view', ['id' => $invoice->quotation->id]) }}" class="text-decoration-none">
                                    <span class="badge bg-light text-slate-700 border font-monospace px-2 py-1">
                                        <i class="bi bi-file-earmark-text me-1"></i>{{ $invoice->quotation->quotation_no }}
                                    </span>
                                </a>
                            @else
                                <span class="badge bg-light text-muted border font-monospace px-2 py-1">Direct POS</span>
                            @endif
                        </td>
                        <td>
                            <strong class="d-block text-slate-900 fs-6">{{ $invoice->customer_name }}</strong>
                            <small class="text-muted">{{ $invoice->customer_company ?: 'Retail Client' }}</small>
                        </td>
                        <td>
                            <span class="text-slate-700 small">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}</span>
                        </td>
                        <td class="text-end fw-bold text-slate-900 fs-6">
                            ₹{{ number_format($invoice->grand_total, 2) }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-slate-700 border font-monospace px-2.5 py-1">
                                {{ $invoice->payment_mode }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="stock-status-pill {{ $payPillClass }}">
                                <span class="stock-dot"></span>
                                <span>{{ $invoice->payment_status }}</span>
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.invoices.view', ['id' => $invoice->id]) }}" class="catalog-action-btn btn-view" title="View & Print Tax Invoice">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <a href="{{ route('admin.invoices.view', ['id' => $invoice->id]) }}" class="catalog-action-btn btn-edit" title="Inspect Invoice">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt display-5 d-block mb-2 opacity-50"></i>
                            <h5>No Tax Invoices Issued Yet</h5>
                            <p class="small text-muted mb-3">Convert approved quotations or generate counter sales invoices to start billing.</p>
                            <a href="{{ route('admin.quotations') }}" class="btn btn-primary fw-bold">
                                <i class="bi bi-file-earmark-check me-1"></i> View Quotations
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($invoices->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $invoices->firstItem() ?? 0 }}-{{ $invoices->lastItem() ?? 0 }}</strong> of <strong>{{ $invoices->total() }}</strong> invoices
            </div>
            <div>
                {{ $invoices->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

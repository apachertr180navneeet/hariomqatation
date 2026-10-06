@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Executive Dashboard</h1>
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                <span class="stock-dot d-inline-block bg-success rounded-circle me-1" style="width: 6px; height: 6px;"></span> Live ERP Data
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <span>Hari Om Computer ERP</span> &bull; <span>Jodhpur Showroom Operations</span> &bull; <span>Live Performance Cockpit</span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Create Quotation</span>
        </a>
        <a href="{{ route('admin.pc.builder') }}" class="btn btn-outline-primary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-motherboard"></i>
            <span>PC Builder Studio</span>
        </a>
    </div>
</div>

<!-- Live KPI Metrics Row -->
<div class="row g-3 mb-4">
    <!-- KPI 1: Commercial Quotations Total -->
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Commercial Pipeline</div>
                    <div class="catalog-kpi-val">₹{{ number_format($monthlySales, 0) }}</div>
                    <div class="catalog-kpi-sub">
                        <i class="bi bi-file-earmark-text text-primary"></i> Current month quotes
                    </div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI 2: Active Quotations Status -->
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-amber">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Active Quotes</div>
                    <div class="catalog-kpi-val text-amber">{{ $pendingQuotes }} <span class="fs-6 fw-normal text-muted">Pending</span></div>
                    <div class="catalog-kpi-sub">
                        <span class="text-success fw-bold">{{ $approvedQuotes }} Approved</span> &bull; {{ $totalQuotes }} Total
                    </div>
                </div>
                <div class="catalog-kpi-icon icon-amber">
                    <i class="bi bi-file-earmark-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI 3: Inventory Stock Health -->
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Warehouse Inventory</div>
                    <div class="catalog-kpi-val text-success">{{ $totalStockUnits }} <span class="fs-6 fw-normal text-muted">Units</span></div>
                    <div class="catalog-kpi-sub">
                        <i class="bi bi-boxes text-success"></i> Across {{ $totalProducts }} Catalog SKUs
                    </div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI 4: Low Stock Alert -->
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $lowStockCount > 0 ? 'kpi-rose' : 'kpi-indigo' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Stock Replenishment</div>
                    <div class="catalog-kpi-val {{ $lowStockCount > 0 ? 'text-danger' : 'text-indigo' }}">
                        {{ $lowStockCount }} <span class="fs-6 fw-normal text-muted">{{ $lowStockCount === 1 ? 'Item' : 'Items' }}</span>
                    </div>
                    <div class="catalog-kpi-sub">
                        @if($lowStockCount > 0)
                            <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill"></i> Below reorder level</span>
                        @else
                            <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> All stock healthy</span>
                        @endif
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $lowStockCount > 0 ? 'icon-rose' : 'icon-indigo' }}">
                    <i class="bi {{ $lowStockCount > 0 ? 'bi-exclamation-octagon-fill' : 'bi-shield-check' }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Financial & Procurement Quick Ribbon -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.sales') }}" class="text-decoration-none">
            <div class="catalog-card shadow-sm p-3 border-0 bg-white hover-shadow transition-all d-flex align-items-center gap-3">
                <div class="rounded-3 bg-primary-subtle text-primary p-2.5">
                    <i class="bi bi-receipt fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Billed Invoices</div>
                    <div class="fw-bold text-dark fs-6">₹{{ number_format($totalInvoiced, 0) }}</div>
                    <small class="text-primary fw-medium">{{ $totalInvoicesCount }} Invoices &bull; View</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.sales') }}" class="text-decoration-none">
            <div class="catalog-card shadow-sm p-3 border-0 bg-white hover-shadow transition-all d-flex align-items-center gap-3">
                <div class="rounded-3 bg-success-subtle text-success p-2.5">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Collected Cash/UPI</div>
                    <div class="fw-bold text-success fs-6">₹{{ number_format($totalCollected, 0) }}</div>
                    <small class="text-muted">Realized sales</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.customers') }}" class="text-decoration-none">
            <div class="catalog-card shadow-sm p-3 border-0 bg-white hover-shadow transition-all d-flex align-items-center gap-3">
                <div class="rounded-3 bg-info-subtle text-info-emphasis p-2.5">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Customer Accounts</div>
                    <div class="fw-bold text-dark fs-6">{{ $totalCustomers }} Clients</div>
                    <small class="text-info fw-medium">Retail & Corporate &bull; View</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-md-3">
        <a href="{{ route('admin.purchases') }}" class="text-decoration-none">
            <div class="catalog-card shadow-sm p-3 border-0 bg-white hover-shadow transition-all d-flex align-items-center gap-3">
                <div class="rounded-3 bg-secondary-subtle text-secondary p-2.5">
                    <i class="bi bi-truck fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Stock Inward Value</div>
                    <div class="fw-bold text-dark fs-6">₹{{ number_format($totalPurchasesValue, 0) }}</div>
                    <small class="text-secondary fw-medium">{{ $totalSuppliers }} Distributors &bull; View</small>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <!-- Monthly Sales Overview Chart -->
    <div class="col-lg-8">
        <div class="catalog-card h-100 p-4 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold text-slate-900 mb-0">
                        <i class="bi bi-graph-up-arrow text-primary me-2"></i>Quotation Revenue & Demand Trend
                    </h5>
                    <small class="text-muted">Trailing 6-month commercial quote generation</small>
                </div>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 fw-bold rounded-pill" style="font-size: 0.75rem;">
                    Past 6 Months
                </span>
            </div>
            <div style="height: 280px; position: relative;">
                <canvas id="salesOverviewChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Category Distribution Pie Chart -->
    <div class="col-lg-4">
        <div class="catalog-card h-100 p-4 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold text-slate-900 mb-0">
                        <i class="bi bi-pie-chart-fill text-primary me-2"></i>Product Mix
                    </h5>
                    <small class="text-muted">Active SKUs by Category</small>
                </div>
                <span class="badge bg-light text-slate-700 border font-monospace px-2 py-0.5" style="font-size: 0.72rem;">
                    {{ count($catLabels) }} Categories
                </span>
            </div>
            <div style="height: 280px; position: relative;" class="d-flex align-items-center justify-content-center">
                <canvas id="categorySalesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Quotations & Low Stock Row -->
<div class="row g-4">
    <!-- Live Recent Quotations Table from Database -->
    <div class="col-lg-8">
        <div class="catalog-card shadow-sm p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold text-slate-900 mb-0">
                        <i class="bi bi-clock-history text-primary me-2"></i>Recent Quotations
                    </h5>
                    <small class="text-muted">Real-time database activity ledger</small>
                </div>
                <a href="{{ route('admin.quotations') }}" class="btn btn-sm btn-outline-secondary fw-semibold rounded-3 px-3">
                    View All ({{ $totalQuotes }})
                </a>
            </div>

            <div class="table-responsive">
                <table class="table-catalog align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Quote ID</th>
                            <th>Customer & Firm</th>
                            <th>Date</th>
                            <th class="text-end">Grand Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentQuotations as $quote)
                            @php
                                $statusClass = match($quote->status) {
                                    'Approved', 'Converted' => 'healthy',
                                    'Pending' => 'low',
                                    'Draft' => 'low',
                                    'Rejected' => 'out',
                                    default => 'low'
                                };
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ route('admin.quotations.view', ['id' => $quote->quotation_no]) }}" class="fw-bold text-primary font-monospace text-decoration-none">
                                        {{ $quote->quotation_no }}
                                    </a>
                                </td>
                                <td>
                                    <strong class="d-block text-slate-900">{{ $quote->customer_name }}</strong>
                                    <small class="text-muted">{{ $quote->customer_company ?: 'Individual Client' }}</small>
                                </td>
                                <td>
                                    <span class="text-slate-700 small">{{ \Carbon\Carbon::parse($quote->created_at)->format('d M, Y') }}</span>
                                </td>
                                <td class="text-end fw-bold text-slate-900">
                                    ₹{{ number_format($quote->grand_total, 2) }}
                                </td>
                                <td class="text-center">
                                    <span class="stock-status-pill {{ $statusClass }}">
                                        <span class="stock-dot"></span>
                                        <span>{{ $quote->status }}</span>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <a href="{{ route('admin.quotations.view', ['id' => $quote->quotation_no]) }}" class="catalog-action-btn btn-view" title="View Quotation">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.quotations.print', ['id' => $quote->quotation_no]) }}" target="_blank" class="catalog-action-btn btn-edit" title="Print Quotation">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-file-earmark-x display-6 d-block mb-2 opacity-50"></i>
                                    No quotations generated yet. Click "Create Quotation" to begin.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts Table from Database -->
    <div class="col-lg-4">
        <div class="catalog-card shadow-sm p-0 overflow-hidden">
            <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold text-slate-900 mb-0">
                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Stock Alerts
                    </h5>
                    <small class="text-muted">Items requiring reorder</small>
                </div>
                <a href="{{ route('admin.inventory') }}" class="btn btn-sm btn-outline-secondary fw-semibold rounded-3 px-2.5">
                    Inventory
                </a>
            </div>

            <div class="table-responsive">
                <table class="table-catalog align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product SKU</th>
                            <th class="text-center">Units</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockItems as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.products.view', ['id' => $item->id]) }}" class="text-decoration-none text-slate-900 fw-bold d-block text-truncate" style="max-width: 170px;">
                                        {{ $item->name }}
                                    </a>
                                    <small class="catalog-sku-code" style="font-size: 0.68rem;">{{ $item->sku }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="stock-status-pill {{ $item->stock <= 0 ? 'out' : 'low' }}">
                                        <span class="stock-dot"></span>
                                        <span>{{ $item->stock }} Left</span>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.inventory') }}" class="btn btn-xs btn-primary fw-bold px-2 py-1 rounded-2 shadow-xs" style="font-size: 0.72rem;" title="Record Inward Stock">
                                        <i class="bi bi-plus-lg me-0.5"></i> Inward
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-success">
                                    <i class="bi bi-check-circle-fill fs-2 d-block mb-1"></i>
                                    All stock levels healthy!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Real Data from Controller
        const months = @json($chartMonths);
        const revenue = @json($chartRevenue);
        const catLabels = @json($catLabels);
        const catCounts = @json($catCounts);

        // Sales Overview Bar & Line Chart
        const salesCanvas = document.getElementById('salesOverviewChart');
        if (salesCanvas) {
            new Chart(salesCanvas, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Quotation Volume (₹)',
                        data: revenue,
                        backgroundColor: 'rgba(2, 132, 199, 0.25)',
                        borderColor: '#0284c7',
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: '#0284c7'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: (ctx) => ' ' + new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 0 }).format(ctx.raw)
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9' },
                            ticks: {
                                callback: (val) => '₹' + (val >= 1000 ? (val/1000) + 'k' : val)
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // Category Product Mix Doughnut Chart
        const catCanvas = document.getElementById('categorySalesChart');
        if (catCanvas && catLabels.length > 0) {
            new Chart(catCanvas, {
                type: 'doughnut',
                data: {
                    labels: catLabels,
                    datasets: [{
                        data: catCounts,
                        backgroundColor: [
                            '#0284c7', '#38bdf8', '#7c3aed', '#c084fc', 
                            '#059669', '#34d399', '#f59e0b', '#fbbf24'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 12,
                                font: { size: 11, weight: '600' }
                            }
                        }
                    },
                    cutout: '68%'
                }
            });
        }
    });
</script>
@endpush

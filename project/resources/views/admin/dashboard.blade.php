@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div>
        <h1 class="page-title">Executive Dashboard</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Hari Om Computer</a> &bull; <span>Live Sales & Quotation Overview</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary fw-semibold shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Create Quotation
        </a>
        <a href="{{ route('admin.pc.builder') }}" class="btn btn-outline-primary fw-semibold">
            <i class="bi bi-motherboard me-1"></i> PC Builder
        </a>
    </div>
</div>

<!-- KPI Metrics Row -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="kpi-label">Today's Sales</div>
                    <div class="kpi-value" id="kpi-today-sales">₹1,52,980</div>
                    <small class="text-success fw-semibold"><i class="bi bi-arrow-up-short"></i> +14.2% from yesterday</small>
                </div>
                <div class="kpi-icon kpi-blue"><i class="bi bi-cash-coin"></i></div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="kpi-label">Monthly Sales (Aug)</div>
                    <div class="kpi-value" id="kpi-month-sales">₹8,45,000</div>
                    <small class="text-muted">Target: ₹12,00,000 (70%)</small>
                </div>
                <div class="kpi-icon kpi-green"><i class="bi bi-graph-up-arrow"></i></div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="kpi-label">Active Quotations</div>
                    <div class="kpi-value" id="kpi-pending-quotes">3 Pending</div>
                    <small class="text-primary fw-semibold"><span id="kpi-approved-quotes">2</span> Approved</small>
                </div>
                <div class="kpi-icon kpi-amber"><i class="bi bi-file-earmark-text"></i></div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="kpi-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="kpi-label">Stock Status</div>
                    <div class="kpi-value" id="kpi-total-products">24 Items</div>
                    <small class="text-danger fw-semibold"><span id="kpi-low-stock">2</span> Low Stock Alerts</small>
                </div>
                <div class="kpi-icon kpi-purple"><i class="bi bi-boxes"></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-activity text-primary me-2"></i> 2026 Sales & Quotations Overview</h5>
                <span class="badge bg-light text-dark border">Jan - Aug 2026</span>
            </div>
            <div class="p-4" style="height: 320px;">
                <canvas id="salesOverviewChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-pie-chart text-primary me-2"></i> Category Revenue</h5>
            </div>
            <div class="p-4 d-flex align-items-center justify-content-center" style="height: 320px;">
                <canvas id="categorySalesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Quotations & Low Stock Row -->
<div class="row g-4">
    <!-- Recent Quotations Table -->
    <div class="col-lg-8">
        <div class="admin-card mb-0">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-clock-history text-primary me-2"></i> Recent Quotations</h5>
                <a href="{{ route('admin.quotations') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hoc align-middle">
                    <thead>
                        <tr>
                            <th>Quotation No</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard-recent-quotes">
                        <!-- Populated dynamically via admin.js -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts Table -->
    <div class="col-lg-4">
        <div class="admin-card mb-0">
            <div class="admin-card-header">
                <h5 class="admin-card-title text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i> Low Stock Alerts</h5>
                <a href="{{ route('admin.inventory') }}" class="btn btn-sm btn-outline-secondary">Inventory</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hoc align-middle small">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Cat</th>
                            <th>Stock</th>
                            <th>Min</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard-low-stock-table">
                        <!-- Populated dynamically via admin.js -->
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
        AdminApp.loadDashboard();
    });
</script>
@endpush

@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Desktop PCs & Workstations</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $computers->count() }} Pre-Configured Rigs
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Catalog & Inventory</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Custom Built Towers & Workstations</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.pc.builder') }}" class="btn btn-outline-primary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-motherboard"></i>
            <span>PC Builder Studio</span>
        </a>
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Add Desktop PC</span>
        </a>
    </div>
</div>

<!-- KPI Metrics Summary Cards -->
@php
    $totalComputers = $computers->count();
    $totalRigStock = $computers->sum('stock');
    $avgRigPrice = $totalComputers > 0 ? ($computers->sum('selling_price') / $totalComputers) : 0;
    $availableRigs = $computers->where('stock', '>', 0)->count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Pre-Built Builds</div>
                    <div class="catalog-kpi-val">{{ $totalComputers }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-pc-display text-primary"></i> Gaming & Office rigs</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-pc-display-horizontal"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Assembled Units</div>
                    <div class="catalog-kpi-val text-success">{{ $totalRigStock }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-check-circle-fill text-success"></i> Ready for instant delivery</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-boxes"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Average Rig Price</div>
                    <div class="catalog-kpi-val text-indigo fs-4 mt-2">₹{{ number_format($avgRigPrice, 2) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-currency-rupee text-indigo"></i> Per complete setup</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-currency-rupee"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-amber">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Stock Availability</div>
                    <div class="catalog-kpi-val text-warning">{{ $availableRigs }} / {{ $totalComputers }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-speedometer2 text-warning"></i> Models in stock</div>
                </div>
                <div class="catalog-kpi-icon icon-amber">
                    <i class="bi bi-motherboard-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Search & Filter Toolbar -->
<div class="catalog-filter-card">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Live Instant Search -->
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 380px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="computerSearchInput" class="catalog-search-input" 
                   placeholder="Search desktop towers, specs, SKU, processor...">
        </div>

        <!-- Filter Pill Chips -->
        <div class="filter-pills-bar">
            <button type="button" class="filter-pill active" data-filter="all">All Rigs ({{ $totalComputers }})</button>
            <button type="button" class="filter-pill" data-filter="in-stock">In Stock ({{ $availableRigs }})</button>
        </div>

        <!-- View Switcher Toggle -->
        <div class="d-flex align-items-center gap-1 bg-light p-1 rounded-3 border">
            <button type="button" class="btn btn-sm btn-white shadow-xs fw-bold px-2.5 py-1 active" id="btn-pc-grid" title="Grid Cards View">
                <i class="bi bi-grid-fill me-1"></i> Grid
            </button>
            <button type="button" class="btn btn-sm text-muted fw-bold px-2.5 py-1" id="btn-pc-table" title="Table View">
                <i class="bi bi-list-ul me-1"></i> Table
            </button>
        </div>
    </div>
</div>

<!-- Desktop Computers Grid View -->
<div class="row g-4" id="computers-grid-view">
    @forelse($computers as $pc)
        @php
            $isLow = $pc->stock <= $pc->min_stock;
            $isOut = $pc->stock <= 0;
        @endphp
        <div class="col-md-6 col-xl-6 computer-item-wrapper" 
             data-name="{{ strtolower($pc->name) }}"
             data-sku="{{ strtolower($pc->sku) }}"
             data-model="{{ strtolower($pc->model ?: '') }}"
             data-specs="{{ strtolower($pc->specs) }}"
             data-stock="{{ $pc->stock }}">
            <div class="rig-card p-4">
                <!-- Top Row: Rig Avatar Graphic + Titles + Stock Status Pill -->
                <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rig-avatar-box">
                            <i class="bi bi-pc-display"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-0.5 fw-bold rounded-pill" style="font-size: 0.72rem;">
                                    {{ $pc->subcategory->name ?? 'Custom Rig' }}
                                </span>
                                @if($pc->brand)
                                    <span class="badge bg-light text-slate-700 border font-monospace px-2 py-0.5" style="font-size: 0.72rem;">
                                        {{ $pc->brand->name }}
                                    </span>
                                @endif
                            </div>
                            <h5 class="fw-bold text-slate-900 mb-1">
                                <a href="{{ route('admin.products.view', ['id' => $pc->id]) }}" class="text-decoration-none text-slate-900 catalog-item-name fs-5">
                                    {{ $pc->name }}
                                </a>
                            </h5>
                            <div class="d-flex align-items-center gap-2 small">
                                <span class="catalog-sku-code">{{ $pc->sku }}</span>
                                <span class="text-muted">&bull;</span>
                                <span class="text-muted">Model: <strong>{{ $pc->model ?: 'Custom Build' }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if($isOut)
                            <span class="stock-status-pill out">
                                <span class="stock-dot"></span>
                                <span>Out of Stock</span>
                            </span>
                        @elseif($isLow)
                            <span class="stock-status-pill low">
                                <span class="stock-dot"></span>
                                <span>{{ $pc->stock }} Left (Low)</span>
                            </span>
                        @else
                            <span class="stock-status-pill healthy">
                                <span class="stock-dot"></span>
                                <span>{{ $pc->stock }} Units Ready</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Structured Hardware Component Chips Grid -->
                @php
                    $rawSpecs = $pc->specs;
                    $specsArray = str_contains($rawSpecs, '|') ? explode('|', $rawSpecs) : explode(',', $rawSpecs);
                    $specsArray = array_filter(array_map('trim', $specsArray));
                @endphp
                <div class="rig-specs-box mb-3 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold text-uppercase small" style="font-size: 0.7rem; letter-spacing: 0.06em;">
                            <i class="bi bi-cpu-fill text-primary me-1"></i>Hardware Architecture
                        </span>
                        <span class="text-muted small" style="font-size: 0.7rem;">
                            {{ count($specsArray) }} Components
                        </span>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach($specsArray as $spec)
                            @php
                                $sLower = strtolower($spec);
                                $specIcon = 'bi-cpu';
                                $specClass = 'chip-default';

                                if (preg_match('/(core|ryzen|intel|amd|i3|i5|i7|i9|cpu|processor)/', $sLower)) {
                                    $specIcon = 'bi-cpu';
                                    $specClass = 'chip-cpu';
                                } elseif (preg_match('/(rtx|gtx|radeon|gpu|graphics|geforce|arc)/', $sLower)) {
                                    $specIcon = 'bi-gpu-card';
                                    $specClass = 'chip-gpu';
                                } elseif (preg_match('/(ram|ddr4|ddr5|mhz|memory)/', $sLower)) {
                                    $specIcon = 'bi-memory';
                                    $specClass = 'chip-ram';
                                } elseif (preg_match('/(ssd|nvme|hdd|gen4|gen3|tb|gb)/', $sLower)) {
                                    $specIcon = 'bi-device-hdd';
                                    $specClass = 'chip-storage';
                                } elseif (preg_match('/(cooler|aio|liquid|fan)/', $sLower)) {
                                    $specIcon = 'bi-fan';
                                    $specClass = 'chip-cooler';
                                } elseif (preg_match('/(psu|power|gold|bronze|watt|watts|smps)/', $sLower)) {
                                    $specIcon = 'bi-lightning-charge';
                                    $specClass = 'chip-psu';
                                } elseif (preg_match('/(case|cabinet|glass|tower|chassis)/', $sLower)) {
                                    $specIcon = 'bi-pc';
                                    $specClass = 'chip-case';
                                }
                            @endphp
                            <span class="rig-spec-chip {{ $specClass }}">
                                <i class="bi {{ $specIcon }}"></i>
                                <span>{{ $spec }}</span>
                            </span>
                        @endforeach

                        @if($pc->socket)
                            <span class="rig-spec-chip chip-cpu"><i class="bi bi-cpu"></i>Socket {{ $pc->socket }}</span>
                        @endif
                        @if($pc->wattage)
                            <span class="rig-spec-chip chip-psu"><i class="bi bi-lightning-charge"></i>{{ $pc->wattage }}W Req</span>
                        @endif
                    </div>
                </div>

                <!-- Footer: Pricing + Sleek Cohesive Action Buttons -->
                <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase d-block" style="font-size: 0.68rem; letter-spacing: 0.05em;">Commercial Selling Price</span>
                        <div class="fs-4 fw-extrabold text-primary leading-tight">
                            ₹{{ number_format($pc->selling_price, 2) }}
                        </div>
                        @if($pc->purchase_price > 0)
                            @php
                                $margin = round((($pc->selling_price - $pc->purchase_price) / $pc->purchase_price) * 100, 1);
                            @endphp
                            <div class="d-flex align-items-center gap-1.5 mt-0.5" style="font-size: 0.72rem;">
                                <span class="text-muted">Cost: ₹{{ number_format($pc->purchase_price, 2) }}</span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-1.5 py-0.5 fw-bold" style="font-size: 0.68rem;">
                                    +{{ $margin }}% Margin
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('admin.products.view', ['id' => $pc->id]) }}" class="catalog-action-btn btn-view" title="Inspect Specifications" style="width: 36px; height: 36px; font-size: 0.95rem;">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.products.edit', $pc->id) }}" class="catalog-action-btn btn-edit" title="Edit Rig Configuration" style="width: 36px; height: 36px; font-size: 0.95rem;">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary btn-sm fw-bold px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-1.5" title="Add Rig to Quotation">
                            <i class="bi bi-file-earmark-plus"></i>
                            <span>Quote</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="catalog-card p-5 text-center">
                <i class="bi bi-pc-display display-4 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-slate-900">No Desktop Towers Configured</h5>
                <p class="text-muted small mb-3">Add pre-configured desktop PCs or custom gaming towers to quote customers faster.</p>
                <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Configure First Desktop PC
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Desktop Computers Table View (Toggleable) -->
<div class="catalog-card d-none shadow-sm" id="computers-table-view">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 280px;">Desktop System & SKU</th>
                    <th>Build Specifications</th>
                    <th class="text-end">Cost (₹)</th>
                    <th class="text-end">Selling Price (₹)</th>
                    <th class="text-center">Stock</th>
                    <th>Warranty</th>
                    <th class="text-end" style="min-width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($computers as $pc)
                    @php
                        $isLow = $pc->stock <= $pc->min_stock;
                        $isOut = $pc->stock <= 0;
                    @endphp
                    <tr class="computer-table-row" 
                        data-name="{{ strtolower($pc->name) }}"
                        data-sku="{{ strtolower($pc->sku) }}"
                        data-model="{{ strtolower($pc->model ?: '') }}"
                        data-specs="{{ strtolower($pc->specs) }}"
                        data-stock="{{ $pc->stock }}">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="catalog-avatar-box">
                                    <i class="bi bi-pc-display"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $pc->id]) }}" class="catalog-item-name">
                                        {{ $pc->name }}
                                    </a>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="catalog-sku-code">{{ $pc->sku }}</span>
                                        <span class="badge bg-light text-secondary border font-monospace px-1.5 py-0.5" style="font-size: 0.7rem;">
                                            {{ $pc->model ?: 'Custom Rig' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small text-slate-700" style="max-width: 320px;">{{ $pc->specs }}</div>
                        </td>
                        <td class="text-end text-slate-700 fw-semibold">
                            ₹{{ number_format($pc->purchase_price, 2) }}
                        </td>
                        <td class="text-end fw-bold text-primary fs-6">
                            ₹{{ number_format($pc->selling_price, 2) }}
                        </td>
                        <td class="text-center">
                            @if($isOut)
                                <span class="stock-status-pill out"><span class="stock-dot"></span>0 Out</span>
                            @elseif($isLow)
                                <span class="stock-status-pill low"><span class="stock-dot"></span>{{ $pc->stock }} Left</span>
                            @else
                                <span class="stock-status-pill healthy"><span class="stock-dot"></span>{{ $pc->stock }} Ready</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $pc->warranty ?: '1 Year' }}</small></td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.products.view', ['id' => $pc->id]) }}" class="catalog-action-btn btn-view" title="Inspect">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $pc->id) }}" class="catalog-action-btn btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('admin.quotations.create') }}" class="catalog-action-btn btn-stock" title="Quote">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gridView = document.getElementById('computers-grid-view');
        const tableView = document.getElementById('computers-table-view');
        const btnGrid = document.getElementById('btn-pc-grid');
        const btnTable = document.getElementById('btn-pc-table');

        const savedView = localStorage.getItem('hoc_computers_view') || 'grid';
        if (savedView === 'table') {
            switchToTable();
        }

        function switchToGrid() {
            if (gridView && tableView) {
                gridView.classList.remove('d-none');
                tableView.classList.add('d-none');
                btnGrid.classList.add('active', 'btn-white', 'shadow-xs');
                btnGrid.classList.remove('text-muted');
                btnTable.classList.remove('active', 'btn-white', 'shadow-xs');
                btnTable.classList.add('text-muted');
                localStorage.setItem('hoc_computers_view', 'grid');
            }
        }

        function switchToTable() {
            if (gridView && tableView) {
                gridView.classList.add('d-none');
                tableView.classList.remove('d-none');
                btnTable.classList.add('active', 'btn-white', 'shadow-xs');
                btnTable.classList.remove('text-muted');
                btnGrid.classList.remove('active', 'btn-white', 'shadow-xs');
                btnGrid.classList.add('text-muted');
                localStorage.setItem('hoc_computers_view', 'table');
            }
        }

        if (btnGrid) btnGrid.addEventListener('click', switchToGrid);
        if (btnTable) btnTable.addEventListener('click', switchToTable);

        // Search & Filter
        const searchInput = document.getElementById('computerSearchInput');
        const filterBtns = document.querySelectorAll('.filter-pills-bar .filter-pill');
        let currentFilter = 'all';

        function applyComputerFilter() {
            const query = (searchInput.value || '').trim().toLowerCase();

            // Filter Grid Items
            document.querySelectorAll('.computer-item-wrapper').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const sku = item.getAttribute('data-sku') || '';
                const model = item.getAttribute('data-model') || '';
                const specs = item.getAttribute('data-specs') || '';
                const stock = parseInt(item.getAttribute('data-stock') || '0', 10);

                const matchesQuery = !query || name.includes(query) || sku.includes(query) || model.includes(query) || specs.includes(query);
                let matchesFilter = true;
                if (currentFilter === 'in-stock') matchesFilter = stock > 0;

                item.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });

            // Filter Table Rows
            document.querySelectorAll('.computer-table-row').forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const sku = row.getAttribute('data-sku') || '';
                const model = row.getAttribute('data-model') || '';
                const specs = row.getAttribute('data-specs') || '';
                const stock = parseInt(row.getAttribute('data-stock') || '0', 10);

                const matchesQuery = !query || name.includes(query) || sku.includes(query) || model.includes(query) || specs.includes(query);
                let matchesFilter = true;
                if (currentFilter === 'in-stock') matchesFilter = stock > 0;

                row.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyComputerFilter);

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.getAttribute('data-filter');
                applyComputerFilter();
            });
        });
    });
</script>
@endpush

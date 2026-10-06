@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Laptops Catalog</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $laptops->count() }} Laptop Models
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Catalog & Inventory</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Notebooks, Gaming & Ultrabooks</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('laptops') }}" target="_blank" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-box-arrow-up-right me-1"></i> Storefront
        </a>
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Add Laptop</span>
        </a>
    </div>
</div>

<!-- KPI Metrics Summary Cards -->
@php
    $totalLaptops = $laptops->count();
    $totalLaptopStock = $laptops->sum('stock');
    $laptopBrandsCount = $laptops->pluck('brand_id')->filter()->unique()->count();
    $lowStockLaptops = $laptops->filter(fn($l) => $l->stock <= $l->min_stock)->count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Laptop Models</div>
                    <div class="catalog-kpi-val">{{ $totalLaptops }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-laptop text-primary"></i> Distinct SKUs in catalog</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-laptop-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Inventory Units</div>
                    <div class="catalog-kpi-val text-success">{{ $totalLaptopStock }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-boxes text-success"></i> Units ready for dispatch</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Partner Brands</div>
                    <div class="catalog-kpi-val text-indigo">{{ $laptopBrandsCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-award text-indigo"></i> Dell, HP, Lenovo, ASUS</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-award-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $lowStockLaptops > 0 ? 'kpi-amber' : 'kpi-emerald' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Reorder Attention</div>
                    <div class="catalog-kpi-val {{ $lowStockLaptops > 0 ? 'text-warning' : 'text-success' }}">{{ $lowStockLaptops }}</div>
                    <div class="catalog-kpi-sub text-muted">
                        <i class="bi bi-exclamation-triangle me-1"></i>Models below minimum threshold
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $lowStockLaptops > 0 ? 'icon-amber' : 'icon-emerald' }}">
                    <i class="bi bi-exclamation-diamond-fill"></i>
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
            <input type="text" id="laptopSearchInput" class="catalog-search-input" 
                   placeholder="Search model, brand, processor, specs...">
        </div>

        <!-- Filter Pill Chips -->
        <div class="filter-pills-bar">
            <button type="button" class="filter-pill active" data-filter="all">All ({{ $totalLaptops }})</button>
            <button type="button" class="filter-pill" data-filter="in-stock">In Stock</button>
            <button type="button" class="filter-pill" data-filter="low-stock">Low Stock ({{ $lowStockLaptops }})</button>
        </div>

        <!-- View Switcher Toggle -->
        <div class="d-flex align-items-center gap-1 bg-light p-1 rounded-3 border">
            <button type="button" class="btn btn-sm btn-white shadow-xs fw-bold px-2.5 py-1 active" id="btn-laptop-grid" title="Grid Cards View">
                <i class="bi bi-grid-fill me-1"></i> Grid
            </button>
            <button type="button" class="btn btn-sm text-muted fw-bold px-2.5 py-1" id="btn-laptop-table" title="Table View">
                <i class="bi bi-list-ul me-1"></i> Table
            </button>
        </div>
    </div>
</div>

<!-- Laptops Grid Cards View -->
<div class="row g-4" id="laptops-grid-view">
    @forelse($laptops as $laptop)
        @php
            $isLow = $laptop->stock <= $laptop->min_stock;
            $isOut = $laptop->stock <= 0;
            $discount = ($laptop->mrp && $laptop->mrp > $laptop->selling_price)
                ? round((($laptop->mrp - $laptop->selling_price) / $laptop->mrp) * 100)
                : 0;
        @endphp
        <div class="col-md-6 col-xl-4 laptop-item-wrapper" 
             data-name="{{ strtolower($laptop->name) }}"
             data-sku="{{ strtolower($laptop->sku) }}"
             data-brand="{{ strtolower($laptop->brand->name ?? '') }}"
             data-specs="{{ strtolower($laptop->specs) }}"
             data-stock="{{ $laptop->stock }}"
             data-is-low="{{ $isLow ? '1' : '0' }}">
            <div class="catalog-card h-100 p-4 d-flex flex-column" style="border-radius: 20px;">
                <!-- Header: Icon + Category Badge + Stock Pill -->
                <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="catalog-avatar-box" style="width: 48px; height: 48px; background: linear-gradient(135deg, #e0f2fe, #bae6fd); color: #0284c7; font-size: 1.35rem;">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div>
                            <span class="badge bg-light text-slate-700 border font-monospace px-2 py-0.5" style="font-size: 0.72rem;">
                                {{ $laptop->brand->name ?? 'Generic' }}
                            </span>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-0.5 ms-1" style="font-size: 0.72rem;">
                                {{ $laptop->subcategory->name ?? 'Laptop' }}
                            </span>
                        </div>
                    </div>

                    @if($isOut)
                        <span class="stock-status-pill out">
                            <span class="stock-dot"></span>
                            <span>Out of Stock</span>
                        </span>
                    @elseif($isLow)
                        <span class="stock-status-pill low">
                            <span class="stock-dot"></span>
                            <span>{{ $laptop->stock }} Left</span>
                        </span>
                    @else
                        <span class="stock-status-pill healthy">
                            <span class="stock-dot"></span>
                            <span>{{ $laptop->stock }} In Stock</span>
                        </span>
                    @endif
                </div>

                <!-- Product Title & SKU -->
                <h5 class="fw-bold text-slate-900 mb-1">
                    <a href="{{ route('admin.products.view', ['id' => $laptop->id]) }}" class="text-decoration-none text-slate-900 catalog-item-name">
                        {{ $laptop->name }}
                    </a>
                </h5>
                <small class="text-muted font-monospace d-block mb-3">
                    SKU: <code>{{ $laptop->sku }}</code> &bull; Model: <strong>{{ $laptop->model ?: 'N/A' }}</strong>
                </small>

                <!-- Structured Hardware Specs Chips -->
                @php
                    $rawLaptopSpecs = $laptop->specs;
                    $laptopSpecsArray = str_contains($rawLaptopSpecs, '|') ? explode('|', $rawLaptopSpecs) : explode(',', $rawLaptopSpecs);
                    $laptopSpecsArray = array_filter(array_map('trim', $laptopSpecsArray));
                @endphp
                <div class="rig-specs-box mb-3 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold text-uppercase small" style="font-size: 0.7rem; letter-spacing: 0.06em;">
                            <i class="bi bi-laptop text-primary me-1"></i>Hardware Specifications
                        </span>
                        @if($laptop->warranty)
                            <span class="text-success small fw-semibold" style="font-size: 0.7rem;">
                                <i class="bi bi-shield-check me-0.5"></i>{{ $laptop->warranty }}
                            </span>
                        @endif
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach($laptopSpecsArray as $spec)
                            @php
                                $sLower = strtolower($spec);
                                $specIcon = 'bi-cpu';
                                $specClass = 'chip-default';

                                if (preg_match('/(core|ryzen|intel|amd|i3|i5|i7|i9|cpu|processor|m1|m2|m3)/', $sLower)) {
                                    $specIcon = 'bi-cpu';
                                    $specClass = 'chip-cpu';
                                } elseif (preg_match('/(rtx|gtx|radeon|gpu|graphics|geforce|iris|uhd)/', $sLower)) {
                                    $specIcon = 'bi-gpu-card';
                                    $specClass = 'chip-gpu';
                                } elseif (preg_match('/(ram|ddr4|ddr5|lpddr|memory)/', $sLower)) {
                                    $specIcon = 'bi-memory';
                                    $specClass = 'chip-ram';
                                } elseif (preg_match('/(ssd|nvme|hdd|tb|gb)/', $sLower)) {
                                    $specIcon = 'bi-device-hdd';
                                    $specClass = 'chip-storage';
                                } elseif (preg_match('/(fhd|qhd|oled|ips|hz|display|screen|inch|15\.|14\.|16\.|13\.)/', $sLower)) {
                                    $specIcon = 'bi-display';
                                    $specClass = 'chip-display';
                                }
                            @endphp
                            <span class="rig-spec-chip {{ $specClass }}">
                                <i class="bi {{ $specIcon }}"></i>
                                <span>{{ $spec }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Price & Actions Footer -->
                <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                    <div>
                        @if($discount > 0)
                            <div class="d-flex align-items-center gap-2 mb-0.5">
                                <small class="text-muted text-decoration-line-through" style="font-size: 0.72rem;">
                                    ₹{{ number_format($laptop->mrp, 2) }}
                                </small>
                                <span class="badge bg-danger-subtle text-danger px-1.5 py-0.5 fw-bold" style="font-size: 0.68rem;">
                                    {{ $discount }}% OFF
                                </span>
                            </div>
                        @endif
                        <div class="fs-5 fw-extrabold text-primary leading-tight">
                            ₹{{ number_format($laptop->selling_price, 2) }}
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1.5">
                        <a href="{{ route('admin.products.view', ['id' => $laptop->id]) }}" class="catalog-action-btn btn-view" title="Inspect Specs" style="width: 34px; height: 34px; font-size: 0.95rem;">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.products.edit', $laptop->id) }}" class="catalog-action-btn btn-edit" title="Edit Laptop" style="width: 34px; height: 34px; font-size: 0.95rem;">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary btn-sm fw-bold px-3 py-1.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-1.5" title="Add to Quotation">
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
                <i class="bi bi-laptop display-4 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-slate-900">No Laptops Found</h5>
                <p class="text-muted small mb-3">Add laptop SKUs to display portable machines in the catalog.</p>
                <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Add First Laptop
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Laptops Table View (Toggleable) -->
<div class="catalog-card d-none shadow-sm" id="laptops-table-view">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 280px;">Laptop Model & Brand</th>
                    <th>Specifications Summary</th>
                    <th class="text-end">MRP (₹)</th>
                    <th class="text-end">Selling Price (₹)</th>
                    <th class="text-center">Stock</th>
                    <th>Warranty</th>
                    <th class="text-end" style="min-width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laptops as $laptop)
                    @php
                        $isLow = $laptop->stock <= $laptop->min_stock;
                        $isOut = $laptop->stock <= 0;
                    @endphp
                    <tr class="laptop-table-row" 
                        data-name="{{ strtolower($laptop->name) }}"
                        data-sku="{{ strtolower($laptop->sku) }}"
                        data-brand="{{ strtolower($laptop->brand->name ?? '') }}"
                        data-specs="{{ strtolower($laptop->specs) }}"
                        data-stock="{{ $laptop->stock }}"
                        data-is-low="{{ $isLow ? '1' : '0' }}">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="catalog-avatar-box">
                                    <i class="bi bi-laptop"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $laptop->id]) }}" class="catalog-item-name">
                                        {{ $laptop->name }}
                                    </a>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="catalog-sku-code">{{ $laptop->sku }}</span>
                                        <span class="badge bg-light text-secondary border font-monospace px-1.5 py-0.5" style="font-size: 0.7rem;">
                                            {{ $laptop->brand->name ?? 'Generic' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <small class="text-slate-700 d-block mb-1" style="max-width: 320px;">{{ $laptop->specs }}</small>
                            <span class="badge bg-light text-dark border">{{ $laptop->subcategory->name ?? 'Laptop' }}</span>
                        </td>
                        <td class="text-end text-muted text-decoration-line-through">
                            {{ $laptop->mrp ? '₹' . number_format($laptop->mrp, 2) : '&mdash;' }}
                        </td>
                        <td class="text-end fw-bold text-primary fs-6">
                            ₹{{ number_format($laptop->selling_price, 2) }}
                        </td>
                        <td class="text-center">
                            @if($isOut)
                                <span class="stock-status-pill out">
                                    <span class="stock-dot"></span>
                                    <span>0 Out</span>
                                </span>
                            @elseif($isLow)
                                <span class="stock-status-pill low">
                                    <span class="stock-dot"></span>
                                    <span>{{ $laptop->stock }} Low</span>
                                </span>
                            @else
                                <span class="stock-status-pill healthy">
                                    <span class="stock-dot"></span>
                                    <span>{{ $laptop->stock }} Units</span>
                                </span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $laptop->warranty }}</small></td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.products.view', ['id' => $laptop->id]) }}" class="catalog-action-btn btn-view" title="Inspect">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $laptop->id) }}" class="catalog-action-btn btn-edit" title="Edit">
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
        const gridView = document.getElementById('laptops-grid-view');
        const tableView = document.getElementById('laptops-table-view');
        const btnGrid = document.getElementById('btn-laptop-grid');
        const btnTable = document.getElementById('btn-laptop-table');

        const savedView = localStorage.getItem('hoc_laptops_view') || 'grid';
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
                localStorage.setItem('hoc_laptops_view', 'grid');
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
                localStorage.setItem('hoc_laptops_view', 'table');
            }
        }

        if (btnGrid) btnGrid.addEventListener('click', switchToGrid);
        if (btnTable) btnTable.addEventListener('click', switchToTable);

        // Search and Filter
        const searchInput = document.getElementById('laptopSearchInput');
        const filterBtns = document.querySelectorAll('.filter-pills-bar .filter-pill');
        let currentFilter = 'all';

        function applyLaptopFilter() {
            const query = (searchInput.value || '').trim().toLowerCase();

            // Filter Grid Items
            document.querySelectorAll('.laptop-item-wrapper').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const sku = item.getAttribute('data-sku') || '';
                const brand = item.getAttribute('data-brand') || '';
                const specs = item.getAttribute('data-specs') || '';
                const stock = parseInt(item.getAttribute('data-stock') || '0', 10);
                const isLow = item.getAttribute('data-is-low') === '1';

                const matchesQuery = !query || name.includes(query) || sku.includes(query) || brand.includes(query) || specs.includes(query);
                let matchesFilter = true;
                if (currentFilter === 'in-stock') matchesFilter = stock > 0;
                else if (currentFilter === 'low-stock') matchesFilter = isLow;

                item.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });

            // Filter Table Rows
            document.querySelectorAll('.laptop-table-row').forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const sku = row.getAttribute('data-sku') || '';
                const brand = row.getAttribute('data-brand') || '';
                const specs = row.getAttribute('data-specs') || '';
                const stock = parseInt(row.getAttribute('data-stock') || '0', 10);
                const isLow = row.getAttribute('data-is-low') === '1';

                const matchesQuery = !query || name.includes(query) || sku.includes(query) || brand.includes(query) || specs.includes(query);
                let matchesFilter = true;
                if (currentFilter === 'in-stock') matchesFilter = stock > 0;
                else if (currentFilter === 'low-stock') matchesFilter = isLow;

                row.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyLaptopFilter);

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.getAttribute('data-filter');
                applyLaptopFilter();
            });
        });
    });
</script>
@endpush

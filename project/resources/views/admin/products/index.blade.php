@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Products Catalog</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $products->total() }} Hardware Items
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Catalog & Inventory</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Products Master Directory</span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.inventory') }}" class="btn btn-outline-primary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-boxes"></i>
            <span>Stock Ledger</span>
        </a>
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Add Product</span>
        </a>
    </div>
</div>

<!-- KPI Metrics Summary Bar -->
@php
    $totalProductCount = \App\Models\Product::count();
    $lowStockItemsCount = \App\Models\Product::lowStock()->count();
    $outOfStockItemsCount = \App\Models\Product::where('stock', '<=', 0)->count();
    $activeProductCount = \App\Models\Product::where('status', 'active')->count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Master Catalog</div>
                    <div class="catalog-kpi-val">{{ $totalProductCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-box-seam text-primary"></i> Total hardware SKUs</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Active For Sale</div>
                    <div class="catalog-kpi-val text-success">{{ $activeProductCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-check-circle-fill text-success"></i> Storefront available</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-amber">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Low Stock Alerts</div>
                    <div class="catalog-kpi-val text-warning">{{ $lowStockItemsCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-exclamation-triangle-fill text-warning"></i> Reorder threshold</div>
                </div>
                <div class="catalog-kpi-icon icon-amber">
                    <i class="bi bi-exclamation-diamond-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-rose">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Out of Stock</div>
                    <div class="catalog-kpi-val text-danger">{{ $outOfStockItemsCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-x-circle-fill text-danger"></i> Requires replenishment</div>
                </div>
                <div class="catalog-kpi-icon icon-rose">
                    <i class="bi bi-slash-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Filters Toolbar -->
<div class="catalog-filter-card">
    <form method="GET" action="{{ route('admin.products') }}">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-5">
                <div class="catalog-search-wrap">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" value="{{ $currentSearch }}" class="catalog-search-input" 
                           placeholder="Search by Product Name, SKU, Model, Specs, Brand...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select catalog-select" onchange="this.form.submit()">
                    <option value="ALL">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string)$currentCategory === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="brand_id" class="form-select catalog-select" onchange="this.form.submit()">
                    <option value="">All Brands</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}" {{ request('brand_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold flex-grow-1 rounded-3">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary rounded-3" title="Clear All Filters">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </div>

        <!-- Quick Stock Status Filter Pills -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-2 border-top">
            <div class="filter-pills-bar">
                <span class="text-muted small fw-bold me-1 text-uppercase">Stock Filter:</span>
                <a href="{{ route('admin.products', array_merge(request()->except('filter', 'page'), [])) }}" 
                   class="filter-pill {{ !request('filter') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap"></i> All Items
                </a>
                <a href="{{ route('admin.products', array_merge(request()->except('page'), ['filter' => 'low_stock'])) }}" 
                   class="filter-pill {{ request('filter') === 'low_stock' ? 'active-warning' : '' }}">
                    <i class="bi bi-exclamation-triangle-fill text-warning"></i> Low Stock ({{ $lowStockItemsCount }})
                </a>
                <a href="{{ route('admin.products', array_merge(request()->except('page'), ['filter' => 'out_of_stock'])) }}" 
                   class="filter-pill {{ request('filter') === 'out_of_stock' ? 'active-danger' : '' }}">
                    <i class="bi bi-x-circle-fill text-danger"></i> Out of Stock ({{ $outOfStockItemsCount }})
                </a>
            </div>

            <div class="text-muted small">
                Showing <strong>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> products
            </div>
        </div>
    </form>
</div>

<!-- Modern Products Data Table -->
<div class="catalog-card shadow-sm">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 280px;">Product & SKU Code</th>
                    <th>Category</th>
                    <th class="text-end">Cost Price (₹)</th>
                    <th class="text-end">Selling Price (₹)</th>
                    <th class="text-center">Stock Level</th>
                    <th>Warranty</th>
                    <th>Status</th>
                    <th class="text-end" style="min-width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    @php
                        $isLow = $p->stock <= $p->min_stock;
                        $isOut = $p->stock <= 0;
                        $profitMargin = $p->purchase_price > 0 
                            ? round((($p->selling_price - $p->purchase_price) / $p->purchase_price) * 100, 1) 
                            : 0;
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="catalog-avatar-box">
                                    <i class="bi {{ $p->category->icon ?? 'bi-box-seam' }}"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="catalog-item-name">
                                        {{ $p->name }}
                                    </a>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="catalog-sku-code">{{ $p->sku }}</span>
                                        <span class="badge bg-light text-secondary border font-monospace px-1.5 py-0.5" style="font-size: 0.7rem;">
                                            {{ $p->brand->name ?? 'Generic' }}
                                        </span>
                                        @if($p->is_featured)
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-1.5 py-0.5" style="font-size: 0.68rem;">
                                                <i class="bi bi-star-fill me-1"></i>Featured
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-slate-800 border px-2.5 py-1 fw-semibold">
                                {{ $p->category->name ?? 'Uncategorized' }}
                            </span>
                            @if($p->subcategory)
                                <div class="small text-muted mt-1 ps-1">
                                    <i class="bi bi-arrow-return-right me-1 text-slate-400"></i>{{ $p->subcategory->name }}
                                </div>
                            @endif
                        </td>
                        <td class="text-end">
                            <span class="text-slate-700 fw-semibold">₹{{ number_format($p->purchase_price, 2) }}</span>
                        </td>
                        <td class="text-end">
                            <div class="fw-bold text-primary fs-6">₹{{ number_format($p->selling_price, 2) }}</div>
                            @if($profitMargin > 0)
                                <small class="text-success fw-semibold" style="font-size: 0.72rem;">+{{ $profitMargin }}% margin</small>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($isOut)
                                <span class="stock-status-pill out">
                                    <span class="stock-dot"></span>
                                    <span>Out of Stock (0)</span>
                                </span>
                            @elseif($isLow)
                                <span class="stock-status-pill low" title="Minimum alert threshold: {{ $p->min_stock }}">
                                    <span class="stock-dot"></span>
                                    <span>{{ $p->stock }} Units (Low)</span>
                                </span>
                            @else
                                <span class="stock-status-pill healthy">
                                    <span class="stock-dot"></span>
                                    <span>{{ $p->stock }} Units</span>
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="small text-muted">{{ $p->warranty ?: 'Standard' }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $p->status === 'active' ? 'badge-soft-success' : 'badge-soft-secondary' }} rounded-pill px-2.5 py-1">
                                {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="catalog-action-btn btn-view" title="Inspect Product">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $p->id) }}" class="catalog-action-btn btn-edit" title="Edit Product">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}" class="d-inline delete-form m-0" data-confirm-title="Delete Product SKU?" data-confirm="Are you sure you want to delete product &quot;{{ $p->name }}&quot;? This cannot be undone.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="catalog-action-btn btn-danger" title="Delete Product">
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
                                <i class="bi bi-search display-5 text-muted mb-3 d-block opacity-50"></i>
                                <h5 class="fw-bold text-slate-900 mb-1">No Products Match Your Search</h5>
                                <p class="text-muted small mb-3">Try adjusting your filters or search keywords, or add a new hardware product.</p>
                                <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3">
                                    <i class="bi bi-plus-lg me-1"></i> Add Product SKU
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $products->firstItem() }}</strong> to <strong>{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> total products
            </div>
            <div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

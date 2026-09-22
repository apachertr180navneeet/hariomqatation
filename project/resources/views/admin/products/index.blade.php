@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Products Inventory</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Catalog & Pricing ({{ $products->total() }} items)</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.inventory') }}" class="btn btn-outline-primary fw-semibold">
            <i class="bi bi-boxes me-1"></i> Stock Ledger
        </a>
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Add Product
        </a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card mb-4">
    <div class="p-3 border-bottom bg-light bg-opacity-25">
        <form method="GET" action="{{ route('admin.products') }}" class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ $currentSearch }}" class="form-control" placeholder="Search by Product Name, SKU, Brand, Specs...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="ALL">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string)$currentCategory === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="brand_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Brands</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}" {{ request('brand_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary flex-grow-1">Filter</button>
                <a href="{{ route('admin.products') }}" class="btn btn-sm btn-outline-secondary" title="Clear Filters"><i class="bi bi-arrow-clockwise"></i></a>
            </div>
        </form>
    </div>

    <!-- Quick Stock Filter Tabs -->
    <div class="px-3 py-2 border-bottom d-flex gap-2 align-items-center small">
        <span class="text-muted fw-bold me-1">Quick View:</span>
        <a href="{{ route('admin.products') }}" class="badge {{ !request('filter') ? 'bg-primary text-white' : 'bg-light text-dark border' }} text-decoration-none">
            All Products
        </a>
        <a href="{{ route('admin.products', ['filter' => 'low_stock']) }}" class="badge {{ request('filter') === 'low_stock' ? 'bg-warning text-dark' : 'bg-light text-dark border' }} text-decoration-none">
            <i class="bi bi-exclamation-triangle me-1"></i> Low Stock Alerts
        </a>
        <a href="{{ route('admin.products', ['filter' => 'out_of_stock']) }}" class="badge {{ request('filter') === 'out_of_stock' ? 'bg-danger text-white' : 'bg-light text-dark border' }} text-decoration-none">
            <i class="bi bi-x-circle me-1"></i> Out of Stock
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Product & SKU</th>
                    <th>Category</th>
                    <th>Purchase (₹)</th>
                    <th>Selling (₹)</th>
                    <th class="text-center">Stock</th>
                    <th>Warranty</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    @php
                        $isLow = $p->stock <= $p->min_stock;
                        $isOut = $p->stock <= 0;
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded p-2 text-center" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi {{ $p->category->icon ?? 'bi-box-seam' }} fs-5"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="text-decoration-none fw-bold text-slate-900 d-block">
                                        {{ $p->name }}
                                    </a>
                                    <small class="text-muted">
                                        SKU: <code class="text-primary">{{ $p->sku }}</code> &bull; Brand: <strong>{{ $p->brand->name ?? 'Generic' }}</strong>
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $p->category->name ?? '-' }}</span>
                            @if($p->subcategory)
                                <span class="d-block small text-muted mt-1">{{ $p->subcategory->name }}</span>
                            @endif
                        </td>
                        <td class="text-dark fw-semibold">₹{{ number_format($p->purchase_price, 2) }}</td>
                        <td class="text-primary fw-bold">₹{{ number_format($p->selling_price, 2) }}</td>
                        <td class="text-center">
                            @if($isOut)
                                <span class="badge bg-danger">0 (Out of Stock)</span>
                            @elseif($isLow)
                                <span class="badge bg-warning text-dark" title="Min Stock Threshold: {{ $p->min_stock }}">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $p->stock }} Units
                                </span>
                            @else
                                <span class="badge bg-success">
                                    {{ $p->stock }} Units
                                </span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $p->warranty }}</small></td>
                        <td>
                            <span class="badge {{ $p->status === 'active' ? 'badge-soft-success' : 'badge-soft-secondary' }}">
                                {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="btn btn-outline-secondary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-outline-primary" title="Edit Product">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}" class="d-inline" onsubmit="return confirm('Delete product {{ $p->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete Product">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No products match the selected criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products</small>
            <div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

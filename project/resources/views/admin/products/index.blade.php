@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Products Inventory</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Catalog & Pricing</span>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Add Product
        </a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card mb-4">
    <div class="p-3 border-bottom">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" id="search-product-input" class="form-control" placeholder="Search by Product Name, SKU, Brand...">
                </div>
            </div>
            <div class="col-md-4">
                <select id="filter-category-select" class="form-select form-select-sm">
                    <option value="ALL">All Categories</option>
                    <option value="Laptops">Laptops</option>
                    <option value="Desktop Computers">Desktop Computers</option>
                    <option value="Components">Components (CPU/GPU/RAM/SSD)</option>
                    <option value="Display & Monitors">Monitors & Displays</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Networking">Networking</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hoc align-middle">
            <thead>
                <tr>
                    <th>Product & SKU</th>
                    <th>Category</th>
                    <th>Purchase (₹)</th>
                    <th>Selling (₹)</th>
                    <th>Current Stock</th>
                    <th>Warranty</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody id="products-table-body">
                <!-- Injected dynamically via admin.js loadProductsPage() -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        AdminApp.loadProductsPage();
    });
</script>
@endpush

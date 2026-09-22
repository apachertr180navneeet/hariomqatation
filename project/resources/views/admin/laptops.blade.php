@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Laptops Catalog</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Dedicated Laptop Specifications</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Model & Brand</th>
                    <th>Processor & Specs</th>
                    <th>RAM / Storage</th>
                    <th>MRP (₹)</th>
                    <th>Selling (₹)</th>
                    <th>Stock</th>
                    <th>Warranty</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody id="admin-laptops-table">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("admin-laptops-table");
        const laptops = DataStore.getProducts().filter(p => p.category === "Laptops");

        let html = "";
        laptops.forEach(p => {
            const pViewUrl = window.HOC_ADMIN_ROUTES?.productView 
                ? window.HOC_ADMIN_ROUTES.productView(p.id) 
                : `product-view.php?id=${p.id}`;

            html += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-laptop text-primary fs-4"></i>
                            <div>
                                <strong class="d-block text-dark">${p.name}</strong>
                                <small class="text-muted">SKU: ${p.sku} | Brand: <strong>${p.brand}</strong></small>
                            </div>
                        </div>
                    </td>
                    <td><small class="text-muted">${p.specs}</small></td>
                    <td><span class="badge bg-light text-dark border">16GB / 512GB SSD</span></td>
                    <td class="text-muted text-decoration-line-through">${HOC_UTILS.formatINR(p.mrp || p.sellingPrice * 1.15)}</td>
                    <td class="fw-bold text-primary">${HOC_UTILS.formatINR(p.sellingPrice)}</td>
                    <td><span class="badge ${p.stock > 3 ? 'bg-success' : 'bg-warning text-dark'}">${p.stock} Units</span></td>
                    <td><small>${p.warranty}</small></td>
                    <td class="text-end">
                        <a href="${pViewUrl}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush

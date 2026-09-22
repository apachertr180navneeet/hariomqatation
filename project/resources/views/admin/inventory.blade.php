@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Stock Ledger & Alerts</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Physical Stock vs Reorder Level</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Product & SKU</th>
                    <th>Category</th>
                    <th class="text-center">Opening Stock</th>
                    <th class="text-center">Stock In</th>
                    <th class="text-center">Sold</th>
                    <th class="text-center">Current Stock</th>
                    <th class="text-center">Min Stock Alert</th>
                    <th>Status</th>
                    <th class="text-end">Quick Action</th>
                </tr>
            </thead>
            <tbody id="inventory-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("inventory-table-body");
        const products = DataStore.getProducts();

        let html = "";
        products.forEach(p => {
            const isLow = p.stock <= p.minStock;
            html += `
                <tr>
                    <td>
                        <strong>${p.name}</strong><br>
                        <small class="text-muted">SKU: ${p.sku} | Brand: ${p.brand}</small>
                    </td>
                    <td><span class="badge bg-light text-dark border">${p.category}</span></td>
                    <td class="text-center">${p.stock + 5}</td>
                    <td class="text-center text-success">+10</td>
                    <td class="text-center text-danger">-15</td>
                    <td class="text-center fw-bold ${isLow ? 'text-danger' : 'text-success'} fs-6">${p.stock}</td>
                    <td class="text-center text-muted">${p.minStock}</td>
                    <td>
                        <span class="badge ${isLow ? 'bg-danger' : 'bg-success'}">
                            ${isLow ? 'Low Stock' : 'In Stock'}
                        </span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary" onclick="addStock('${p.id}')">
                            <i class="bi bi-plus-lg"></i> Inward
                        </button>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });

    function addStock(prodId) {
        const qtyStr = prompt("Enter inward stock quantity to add:", "5");
        const qty = parseInt(qtyStr);
        if (qty > 0) {
            const data = DataStore.get();
            const p = data.products.find(item => item.id === prodId);
            if (p) {
                p.stock += qty;
                DataStore.save(data);
                HOC_UTILS.showToast(`Added ${qty} units to ${p.name}`);
                setTimeout(() => window.location.reload(), 500);
            }
        }
    }
</script>
@endpush

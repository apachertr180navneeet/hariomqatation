@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Purchase Invoices</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Distributor Inwards</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>Supplier Distributor</th>
                    <th>Supplier Invoice No</th>
                    <th>Date</th>
                    <th>Products Inward</th>
                    <th>Qty</th>
                    <th>GST (₹)</th>
                    <th>Total (₹)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="purchases-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("purchases-table-body");
        const purchases = DataStore.get().purchases || [];

        let html = "";
        purchases.forEach(p => {
            html += `
                <tr>
                    <td class="fw-bold text-primary">${p.id}</td>
                    <td><strong>${p.supplier}</strong></td>
                    <td><span class="badge bg-light text-dark border">${p.invoiceNo}</span></td>
                    <td>${p.date}</td>
                    <td>${p.product}</td>
                    <td class="text-center fw-bold">${p.qty}</td>
                    <td>${HOC_UTILS.formatINR(p.gst)}</td>
                    <td class="fw-bold text-dark">${HOC_UTILS.formatINR(p.total)}</td>
                    <td><span class="badge badge-soft-success">${p.status}</span></td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush

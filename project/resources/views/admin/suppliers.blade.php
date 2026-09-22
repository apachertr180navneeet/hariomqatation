@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Hardware Suppliers & Distributors</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>National Distributors & Billing Terms</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Supplier Company</th>
                    <th>Contact Details</th>
                    <th>GSTIN</th>
                    <th>Hub / Warehouse</th>
                    <th>Payment Terms</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="suppliers-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("suppliers-table-body");
        const suppliers = DataStore.get().suppliers || [];

        let html = "";
        suppliers.forEach(s => {
            html += `
                <tr>
                    <td>
                        <strong>${s.name}</strong><br>
                        <small class="text-muted">${s.company}</small>
                    </td>
                    <td>
                        <div>${s.mobile}</div>
                        <small class="text-muted">${s.email}</small>
                    </td>
                    <td><span class="badge bg-light text-dark border font-monospace">${s.gstin}</span></td>
                    <td>${s.address}</td>
                    <td><span class="badge bg-info-subtle text-info-emphasis">${s.paymentTerms}</span></td>
                    <td><span class="badge badge-soft-success">${s.status}</span></td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush

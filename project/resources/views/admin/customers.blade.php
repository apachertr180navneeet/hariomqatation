@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Customer Accounts</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Corporate, Retail & Institutional Clients</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Customer Name & Firm</th>
                    <th>Contact</th>
                    <th>Type</th>
                    <th>GSTIN</th>
                    <th>Total Purchases</th>
                    <th>Total Quotes</th>
                    <th>Pending Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="customers-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("customers-table-body");
        const customers = DataStore.get().customers || [];

        let html = "";
        customers.forEach(c => {
            html += `
                <tr>
                    <td>
                        <strong>${c.name}</strong><br>
                        <small class="text-muted">${c.company || 'Individual Retail'}</small>
                    </td>
                    <td>
                        <div>${c.mobile}</div>
                        <small class="text-muted">${c.email}</small>
                    </td>
                    <td><span class="badge bg-light text-dark border">${c.type}</span></td>
                    <td><span class="badge font-monospace ${c.gstin ? 'bg-primary-subtle text-primary' : 'bg-light text-muted'}">${c.gstin || 'None'}</span></td>
                    <td class="fw-bold text-dark">${HOC_UTILS.formatINR(c.totalPurchases)}</td>
                    <td class="text-center"><span class="badge bg-light text-dark border">${c.totalQuotes}</span></td>
                    <td class="fw-bold ${c.pendingPayment > 0 ? 'text-danger' : 'text-success'}">${HOC_UTILS.formatINR(c.pendingPayment)}</td>
                    <td><span class="badge badge-soft-success">${c.status}</span></td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush

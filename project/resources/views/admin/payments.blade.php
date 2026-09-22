@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Received Payments</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Cash, UPI, NEFT & Cheques</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Invoice Number</th>
                    <th>Customer Name</th>
                    <th>Amount (₹)</th>
                    <th>Payment Mode</th>
                    <th>Transaction Ref</th>
                    <th>Receipt Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="payments-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("payments-table-body");
        const payments = DataStore.get().payments || [];

        let html = "";
        payments.forEach(p => {
            const invUrl = window.HOC_ADMIN_ROUTES?.invoiceView 
                ? window.HOC_ADMIN_ROUTES.invoiceView(p.invoiceNo) 
                : `invoice-view.php?id=${encodeURIComponent(p.invoiceNo)}`;

            html += `
                <tr>
                    <td class="fw-bold text-primary">${p.id}</td>
                    <td><a href="${invUrl}" class="text-dark fw-semibold">${p.invoiceNo}</a></td>
                    <td><strong>${p.customer}</strong></td>
                    <td class="fw-bold text-success fs-6">${HOC_UTILS.formatINR(p.amount)}</td>
                    <td><span class="badge bg-light text-dark border">${p.method}</span></td>
                    <td><code class="text-muted">${p.reference}</code></td>
                    <td>${p.date}</td>
                    <td><span class="badge badge-soft-success">${p.status}</span></td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush

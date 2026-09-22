@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Sales Orders & Tax Invoices</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>GST Invoices (HOC/INV/2026/XXXX)</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Linked Quotation</th>
                    <th>Customer & Firm</th>
                    <th>Billing Date</th>
                    <th>Invoice Amount</th>
                    <th>Payment Mode</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody id="sales-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("sales-table-body");
        const sales = DataStore.get().sales || [];

        let html = "";
        sales.forEach(s => {
            const invUrl = `/admin/invoices/view?id=${encodeURIComponent(s.invoiceNo)}`;
            const quoteUrl = s.quotationNo ? `/admin/quotations/view?id=${encodeURIComponent(s.quotationNo)}` : null;

            html += `
                <tr>
                    <td>
                        <a href="${invUrl}" class="fw-bold text-primary text-decoration-none">
                            ${s.invoiceNo}
                        </a>
                    </td>
                    <td>
                        ${s.quotationNo ? `<a href="${quoteUrl}" class="text-muted small">${s.quotationNo}</a>` : '<span class="text-muted small">Direct POS</span>'}
                    </td>
                    <td>
                        <strong class="d-block text-dark">${s.customerName}</strong>
                        <small class="text-muted">${s.company || 'Retail'}</small>
                    </td>
                    <td>${s.date}</td>
                    <td class="fw-bold text-dark">${HOC_UTILS.formatINR(s.amount)}</td>
                    <td><span class="badge bg-light text-dark border">${s.paymentMethod}</span></td>
                    <td><span class="badge badge-soft-success">${s.paymentStatus}</span></td>
                    <td class="text-end">
                        <a href="${invUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-printer me-1"></i> View / Print</a>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush

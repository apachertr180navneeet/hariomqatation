@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Received Payments</h1>
        <div class="page-breadcrumb text-muted small mt-1">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Cash, UPI, NEFT & Cheques</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Collections Ledger</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.sales') }}" class="btn btn-outline-primary fw-bold rounded-3 px-3 py-2">
            <i class="bi bi-receipt me-1"></i> View Invoices Ledger
        </a>
    </div>
</div>

<!-- Modern KPI Summary Cards -->
<div class="row g-3 mb-4" id="payments-kpi-row">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Total Realized Inflow</div>
                    <div class="catalog-kpi-val text-success" id="kpi-total-amount">₹0</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-shield-check text-success"></i> Verified ledger inflows</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-sky">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Total Transactions</div>
                    <div class="catalog-kpi-val text-primary" id="kpi-total-count">0</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-receipt text-primary"></i> Payment receipts issued</div>
                </div>
                <div class="catalog-kpi-icon icon-sky">
                    <i class="bi bi-credit-card-2-front"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">UPI & Digital Receipts</div>
                    <div class="catalog-kpi-val text-indigo" id="kpi-upi-count">0</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-qr-code text-indigo"></i> QR & Instant UPI</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-amber">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Bank & Cash Inflows</div>
                    <div class="catalog-kpi-val text-amber" id="kpi-bank-count">0</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-bank text-amber"></i> NEFT / RTGS / Counter</div>
                </div>
                <div class="catalog-kpi-icon icon-amber">
                    <i class="bi bi-building"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Filter Toolbar -->
<div class="catalog-filter-card mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 m-0">
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 440px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="payments-search-input" class="catalog-search-input" 
                   placeholder="Search receipt ID, invoice number, customer name, reference...">
        </div>

        <div class="filter-pills-bar" id="payments-filter-pills">
            <button type="button" class="filter-pill active" data-mode="ALL">All Modes</button>
            <button type="button" class="filter-pill" data-mode="UPI">UPI</button>
            <button type="button" class="filter-pill" data-mode="Cash">Cash</button>
            <button type="button" class="filter-pill" data-mode="Bank">NEFT / Bank</button>
        </div>
    </div>
</div>

<!-- Modern Payments Ledger Table Card -->
<div class="catalog-card shadow-sm p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Receipt ID</th>
                    <th>Invoice Reference</th>
                    <th>Customer Name</th>
                    <th class="text-end">Amount Paid (₹)</th>
                    <th class="text-center">Mode</th>
                    <th>Transaction Reference</th>
                    <th>Receipt Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-end pe-4">Action</th>
                </tr>
            </thead>
            <tbody id="payments-table-body">
                <!-- Injected via JavaScript -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("payments-table-body");
        const searchInput = document.getElementById("payments-search-input");
        const filterPills = document.querySelectorAll("#payments-filter-pills .filter-pill");

        // Seed data if DataStore is empty
        let store = typeof DataStore !== 'undefined' ? DataStore.get() : {};
        let payments = store.payments || [];

        if (!payments.length) {
            payments = [
                { id: "PAY-2026-001", invoiceNo: "HOC/INV/2026/0001", customer: "Vikram Rathore", amount: 152980, method: "UPI", reference: "UPI/392019482103", date: "14-Aug-2026", status: "Completed" },
                { id: "PAY-2026-002", invoiceNo: "HOC/INV/2026/0002", customer: "Mehta Diagnostic & Imaging", amount: 185000, method: "NEFT", reference: "HDFC-N92019481", date: "13-Aug-2026", status: "Completed" },
                { id: "PAY-2026-003", invoiceNo: "HOC/INV/2026/0003", customer: "Aditya Sharma", amount: 112400, method: "Cash", reference: "CTR-REC-0083", date: "12-Aug-2026", status: "Completed" },
                { id: "PAY-2026-004", invoiceNo: "HOC/INV/2026/0004", customer: "Apex Tech Labs", amount: 245000, method: "RTGS", reference: "SBIN-R91029381", date: "11-Aug-2026", status: "Completed" }
            ];
            if (typeof DataStore !== 'undefined') {
                store.payments = payments;
                DataStore.save(store);
            }
        }

        // Compute KPIs
        let totalVal = 0;
        let upiCount = 0;
        let bankCount = 0;
        payments.forEach(p => {
            totalVal += (p.amount || 0);
            const m = (p.method || '').toUpperCase();
            if (m.includes('UPI')) upiCount++;
            if (m.includes('NEFT') || m.includes('RTGS') || m.includes('BANK')) bankCount++;
        });

        document.getElementById("kpi-total-amount").innerText = typeof HOC_UTILS !== 'undefined' ? HOC_UTILS.formatINR(totalVal) : '₹' + totalVal.toLocaleString('en-IN');
        document.getElementById("kpi-total-count").innerText = payments.length;
        document.getElementById("kpi-upi-count").innerText = upiCount;
        document.getElementById("kpi-bank-count").innerText = bankCount;

        let activeFilter = 'ALL';
        let searchQuery = '';

        function renderRows() {
            let filtered = payments.filter(p => {
                const matchesMode = (activeFilter === 'ALL') || 
                    (activeFilter === 'UPI' && (p.method || '').toUpperCase().includes('UPI')) ||
                    (activeFilter === 'Cash' && (p.method || '').toUpperCase().includes('CASH')) ||
                    (activeFilter === 'Bank' && (['NEFT', 'RTGS', 'BANK', 'CHEQUE'].some(b => (p.method || '').toUpperCase().includes(b))));

                const text = `${p.id} ${p.invoiceNo} ${p.customer} ${p.reference} ${p.method}`.toLowerCase();
                const matchesSearch = !searchQuery || text.includes(searchQuery);

                return matchesMode && matchesSearch;
            });

            if (!filtered.length) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-wallet2 display-5 text-muted mb-3 d-block opacity-50"></i>
                                <h5 class="fw-bold text-slate-900 mb-1">No Payments Found</h5>
                                <p class="text-muted small mb-0">No settlement records match your search or filter criteria.</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = "";
            filtered.forEach(p => {
                const invUrl = `/admin/invoices/view?id=${encodeURIComponent(p.invoiceNo)}`;
                const formattedAmt = typeof HOC_UTILS !== 'undefined' ? HOC_UTILS.formatINR(p.amount) : '₹' + Number(p.amount).toLocaleString('en-IN');

                html += `
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-primary font-monospace">${p.id}</span>
                        </td>
                        <td>
                            <a href="${invUrl}" class="fw-bold text-slate-900 font-monospace text-decoration-none">
                                <span class="badge bg-light text-slate-800 border px-2 py-1">${p.invoiceNo}</span>
                            </a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="catalog-avatar-box" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                    <i class="bi bi-person"></i>
                                </div>
                                <strong class="text-slate-900">${p.customer}</strong>
                            </div>
                        </td>
                        <td class="text-end fw-bold text-success fs-6">
                            ${formattedAmt}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 font-monospace">
                                ${p.method}
                            </span>
                        </td>
                        <td>
                            <code class="text-muted small">${p.reference || '&mdash;'}</code>
                        </td>
                        <td>
                            <span class="text-slate-700 small">${p.date}</span>
                        </td>
                        <td class="text-center">
                            <span class="stock-status-pill healthy">
                                <span class="stock-dot"></span>
                                <span>${p.status || 'Settled'}</span>
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="${invUrl}" class="catalog-action-btn btn-view" title="Inspect Invoice Receipt">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="${invUrl}" target="_blank" class="catalog-action-btn btn-print" title="Print Receipt">
                                    <i class="bi bi-printer"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
        }

        renderRows();

        if (searchInput) {
            searchInput.addEventListener("input", (e) => {
                searchQuery = e.target.value.toLowerCase().trim();
                renderRows();
            });
        }

        filterPills.forEach(pill => {
            pill.addEventListener("click", () => {
                filterPills.forEach(p => p.classList.remove("active"));
                pill.classList.add("active");
                activeFilter = pill.getAttribute("data-mode");
                renderRows();
            });
        });
    });
</script>
@endpush

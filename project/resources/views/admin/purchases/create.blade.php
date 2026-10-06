@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Record Inward Purchase Bill</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $nextPurchaseNo }}
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <a href="{{ route('admin.purchases') }}" class="text-decoration-none text-muted">Inward Bills</a>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">New Distributor Inward</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.purchases') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Inward Bills</span>
        </a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4 border-0" role="alert">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-exclamation-circle-fill fs-5 text-danger"></i>
            <strong>Please resolve the following errors:</strong>
        </div>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('admin.purchases.store') }}" method="POST" id="purchaseInwardForm">
    @csrf

    <div class="row g-4 mb-4">
        <!-- Left: Supplier & Inward Metadata -->
        <div class="col-lg-12">
            <div class="catalog-card shadow-sm p-4">
                <h5 class="fw-bold text-slate-900 mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-spreadsheet text-primary"></i>
                    <span>Distributor Bill & Logistics Details</span>
                </h5>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-slate-800">Distributor / Supplier <span class="text-danger">*</span></label>
                        <select name="supplier_id" id="supplierSelect" class="form-select form-select-lg rounded-3" required>
                            <option value="">-- Select Distributor Firm --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" 
                                        data-gstin="{{ $supplier->gstin }}"
                                        data-terms="{{ $supplier->payment_terms }}"
                                        {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->company }} ({{ $supplier->city ?: 'HQ' }})
                                </option>
                            @endforeach
                        </select>
                        <div id="supplierGstBadge" class="mt-1 small text-muted"></div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-slate-800">Vendor Bill / Invoice No <span class="text-danger">*</span></label>
                        <input type="text" name="supplier_invoice_no" class="form-control form-control-lg rounded-3 font-monospace" 
                               value="{{ old('supplier_invoice_no') }}" placeholder="e.g. SVX/26/8940" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-slate-800">Inward Date <span class="text-danger">*</span></label>
                        <input type="date" name="purchase_date" class="form-control form-control-lg rounded-3" 
                               value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold text-slate-800">Payment Due Date</label>
                        <input type="date" name="due_date" class="form-control form-control-lg rounded-3" 
                               value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="col-lg-12">
            <div class="catalog-card shadow-sm p-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                    <div>
                        <h5 class="fw-bold text-slate-900 m-0 d-flex align-items-center gap-2">
                            <i class="bi bi-boxes text-primary"></i>
                            <span>Stock Inward Line Items</span>
                        </h5>
                        <small class="text-muted">Selecting existing catalog items will automatically increment warehouse inventory levels.</small>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm fw-bold rounded-3 px-3 py-2" id="addItemBtn">
                        <i class="bi bi-plus-circle me-1"></i> Add Another Item
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table catalog-table align-middle mb-0" id="itemsTable">
                        <thead>
                            <tr>
                                <th style="width: 32%;">Item / Product Catalog Match</th>
                                <th style="width: 14%;">SKU Code</th>
                                <th style="width: 10%;">HSN Code</th>
                                <th style="width: 10%;" class="text-center">Inward Qty</th>
                                <th style="width: 14%;" class="text-end">Unit Cost (₹)</th>
                                <th style="width: 8%;" class="text-center">GST %</th>
                                <th style="width: 12%;" class="text-end">Line Total (₹)</th>
                                <th style="width: 5%;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="itemsTbody">
                            <!-- Rows injected dynamically via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bottom: Financial Breakdown & Payment Status -->
        <div class="col-lg-7">
            <div class="catalog-card shadow-sm p-4 h-100">
                <h5 class="fw-bold text-slate-900 mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-credit-card-2-front text-primary"></i>
                    <span>Settlement & Payment Details</span>
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-slate-800">Payment Status <span class="text-danger">*</span></label>
                        <select name="payment_status" id="paymentStatusSelect" class="form-select rounded-3" required>
                            <option value="Unpaid" selected>Unpaid (Credit Term)</option>
                            <option value="Paid">Paid in Full</option>
                            <option value="Partial">Partially Paid</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-slate-800">Amount Paid (₹)</label>
                        <input type="number" step="0.01" name="paid_amount" id="paidAmountInput" 
                               class="form-control rounded-3" value="0.00" min="0">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold text-slate-800">Notes / Inward Gate Pass Remarks</label>
                        <textarea name="notes" class="form-control rounded-3" rows="3" 
                                  placeholder="e.g. Received intact via SafeXpress logistics, Docket #9821039"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Totals Calculation Summary -->
        <div class="col-lg-5">
            <div class="catalog-card shadow-sm p-4 bg-light-subtle h-100">
                <h5 class="fw-bold text-slate-900 mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-calculator text-primary"></i>
                    <span>Tax & Grand Total Summary</span>
                </h5>

                <div class="d-flex flex-column gap-2.5 pb-3 border-bottom">
                    <div class="d-flex justify-content-between text-slate-700">
                        <span>Taxable Value (Subtotal):</span>
                        <span class="font-monospace fw-semibold" id="sumTaxable">₹0.00</span>
                    </div>
                    <div class="d-flex justify-content-between text-slate-700">
                        <span>CGST (Central Tax):</span>
                        <span class="font-monospace fw-semibold" id="sumCgst">₹0.00</span>
                    </div>
                    <div class="d-flex justify-content-between text-slate-700">
                        <span>SGST (State Tax):</span>
                        <span class="font-monospace fw-semibold" id="sumSgst">₹0.00</span>
                    </div>
                    <div class="d-flex justify-content-between text-indigo fw-semibold">
                        <span>Input Tax Credit (Total GST):</span>
                        <span class="font-monospace" id="sumGst">₹0.00</span>
                    </div>
                </div>

                <div class="py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fs-5 fw-bold text-dark">Grand Total:</span>
                        <span class="fs-4 fw-bolder text-primary font-monospace" id="sumGrandTotal">₹0.00</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 small">
                        <span class="text-muted">Balance Due to Vendor:</span>
                        <span class="fw-bold text-danger font-monospace" id="sumBalance">₹0.00</span>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-check2-circle fs-5"></i>
                        <span>Save Inward Bill & Update Inventory</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
const productsCatalog = @json($products);

let itemIndex = 0;

function createItemRow(prefill = null) {
    const tbody = document.getElementById('itemsTbody');
    const idx = itemIndex++;

    const row = document.createElement('tr');
    row.id = `item-row-${idx}`;
    row.innerHTML = `
        <td>
            <div class="mb-1">
                <select class="form-select form-select-sm product-select" data-index="${idx}">
                    <option value="">-- Match Catalog Product (Optional) --</option>
                    ${productsCatalog.map(p => `
                        <option value="${p.id}" 
                                data-name="${p.name}" 
                                data-sku="${p.sku || ''}" 
                                data-cost="${p.purchase_price || (p.selling_price * 0.82).toFixed(2)}"
                                ${prefill && prefill.product_id == p.id ? 'selected' : ''}>
                            ${p.name} (Stock: ${p.stock})
                        </option>
                    `).join('')}
                </select>
            </div>
            <input type="text" name="items[${idx}][item_name]" class="form-control form-control-sm item-name-input" 
                   placeholder="Item Name / Model Description" 
                   value="${prefill ? prefill.name : ''}" required>
            <input type="hidden" name="items[${idx}][product_id]" class="product-id-hidden" value="${prefill ? (prefill.product_id || '') : ''}">
        </td>
        <td>
            <input type="text" name="items[${idx}][sku]" class="form-control form-control-sm font-monospace sku-input" 
                   placeholder="SKU" value="${prefill ? (prefill.sku || '') : ''}">
        </td>
        <td>
            <input type="text" name="items[${idx}][hsn_code]" class="form-control form-control-sm font-monospace" 
                   value="8471" placeholder="HSN">
        </td>
        <td>
            <input type="number" name="items[${idx}][quantity]" class="form-control form-control-sm text-center qty-input" 
                   value="${prefill ? prefill.qty : 1}" min="1" required>
        </td>
        <td>
            <input type="number" step="0.01" name="items[${idx}][unit_cost]" class="form-control form-control-sm text-end cost-input font-monospace" 
                   value="${prefill ? prefill.cost : 0}" min="0" required>
        </td>
        <td>
            <select name="items[${idx}][gst_rate]" class="form-select form-select-sm text-center gst-select">
                <option value="18" selected>18%</option>
                <option value="28">28%</option>
                <option value="12">12%</option>
                <option value="5">5%</option>
                <option value="0">0%</option>
            </select>
        </td>
        <td class="text-end font-monospace fw-bold text-dark line-total-display">
            ₹0.00
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-light text-danger remove-item-btn" title="Remove Item">
                <i class="bi bi-x-circle fs-6"></i>
            </button>
        </td>
    `;

    tbody.appendChild(row);

    // Bind event listeners for this row
    const prodSelect = row.querySelector('.product-select');
    const nameInput = row.querySelector('.item-name-input');
    const idHidden = row.querySelector('.product-id-hidden');
    const skuInput = row.querySelector('.sku-input');
    const costInput = row.querySelector('.cost-input');
    const qtyInput = row.querySelector('.qty-input');
    const gstSelect = row.querySelector('.gst-select');
    const removeBtn = row.querySelector('.remove-item-btn');

    prodSelect.addEventListener('change', function () {
        const selectedOpt = this.options[this.selectedIndex];
        if (this.value) {
            idHidden.value = this.value;
            nameInput.value = selectedOpt.getAttribute('data-name');
            skuInput.value = selectedOpt.getAttribute('data-sku');
            costInput.value = selectedOpt.getAttribute('data-cost');
        } else {
            idHidden.value = '';
        }
        recalculateTotals();
    });

    [qtyInput, costInput, gstSelect].forEach(el => {
        el.addEventListener('input', recalculateTotals);
        el.addEventListener('change', recalculateTotals);
    });

    removeBtn.addEventListener('click', function () {
        const rows = document.querySelectorAll('#itemsTbody tr');
        if (rows.length > 1) {
            row.remove();
            recalculateTotals();
        } else {
            alert('A purchase bill must contain at least one line item.');
        }
    });

    recalculateTotals();
}

function recalculateTotals() {
    let grandTaxable = 0;
    let grandGst = 0;

    const rows = document.querySelectorAll('#itemsTbody tr');
    rows.forEach(row => {
        const qty = parseFloat(row.querySelector('.qty-input')?.value || 0);
        const cost = parseFloat(row.querySelector('.cost-input')?.value || 0);
        const gstRate = parseFloat(row.querySelector('.gst-select')?.value || 18);

        const lineTaxable = qty * cost;
        const lineGst = lineTaxable * (gstRate / 100);
        const lineTotal = lineTaxable + lineGst;

        const display = row.querySelector('.line-total-display');
        if (display) {
            display.innerText = '₹' + lineTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        grandTaxable += lineTaxable;
        grandGst += lineGst;
    });

    const grandTotal = grandTaxable + grandGst;
    const cgst = grandGst / 2;
    const sgst = grandGst / 2;

    document.getElementById('sumTaxable').innerText = '₹' + grandTaxable.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('sumCgst').innerText = '₹' + cgst.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('sumSgst').innerText = '₹' + sgst.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('sumGst').innerText = '₹' + grandGst.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('sumGrandTotal').innerText = '₹' + grandTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    // Handle payment status sync
    const paymentStatus = document.getElementById('paymentStatusSelect').value;
    const paidInput = document.getElementById('paidAmountInput');

    if (paymentStatus === 'Paid') {
        paidInput.value = grandTotal.toFixed(2);
        paidInput.readOnly = true;
    } else if (paymentStatus === 'Unpaid') {
        paidInput.value = '0.00';
        paidInput.readOnly = true;
    } else {
        paidInput.readOnly = false;
    }

    const paidVal = parseFloat(paidInput.value || 0);
    const balance = Math.max(0, grandTotal - paidVal);
    document.getElementById('sumBalance').innerText = '₹' + balance.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

document.addEventListener("DOMContentLoaded", function () {
    // Initialize with 1 default item row
    createItemRow();

    document.getElementById('addItemBtn').addEventListener('click', function () {
        createItemRow();
    });

    document.getElementById('paymentStatusSelect').addEventListener('change', recalculateTotals);
    document.getElementById('paidAmountInput').addEventListener('input', recalculateTotals);

    document.getElementById('supplierSelect').addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        const gstin = opt.getAttribute('data-gstin');
        const badge = document.getElementById('supplierGstBadge');
        if (gstin) {
            badge.innerHTML = `<span class="badge bg-light text-dark border font-monospace">GSTIN: ${gstin}</span>`;
        } else {
            badge.innerHTML = '';
        }
    });
});
</script>
@endpush

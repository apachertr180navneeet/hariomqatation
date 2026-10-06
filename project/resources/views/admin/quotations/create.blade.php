@extends('admin.includes.app')

@section('content')
<form id="quotation-create-form" method="POST" action="{{ route('admin.quotations.store') }}">
    @csrf

    <!-- Page Header -->
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Generate Commercial Quotation</h1>
            <div class="page-breadcrumb text-muted small mt-1">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a> &bull;
                <a href="{{ route('admin.quotations') }}" class="text-decoration-none text-muted">Quotations</a> &bull;
                <span class="text-dark fw-semibold">New Quotation</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.quotations') }}" class="btn btn-outline-secondary px-3 py-2 fw-semibold rounded-3">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary fw-bold shadow-sm px-3 py-2 rounded-3" id="btn-save-quotation">
                <i class="bi bi-save me-1"></i> Save & Generate Quotation
            </button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Customer & Quotation Meta Details Card -->
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header p-3 border-bottom bg-light bg-opacity-50">
                    <h5 class="admin-card-title m-0 fs-6 fw-bold text-slate-900">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i> Customer & Quotation Details
                    </h5>
                </div>

                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Customer Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" id="cust-name" class="form-control" 
                                   required value="{{ old('customer_name') }}" placeholder="e.g. Vikram Rathore">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Company / Firm Name</label>
                            <input type="text" name="customer_company" id="cust-company" class="form-control" 
                                   value="{{ old('customer_company') }}" placeholder="e.g. Rathore Infotech Pvt Ltd">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Mobile Number <span class="text-danger">*</span></label>
                            <input type="tel" name="customer_phone" id="cust-mobile" class="form-control" 
                                   required value="{{ old('customer_phone') }}" placeholder="e.g. 9829012345">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="customer_email" id="cust-email" class="form-control" 
                                   value="{{ old('customer_email') }}" placeholder="e.g. vikram@example.com">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">GSTIN (For 18% ITC)</label>
                            <input type="text" name="customer_gstin" id="cust-gstin" class="form-control text-uppercase" 
                                   value="{{ old('customer_gstin') }}" placeholder="e.g. 08AABCR1234F1Z3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Billing / Delivery Address</label>
                            <input type="text" name="customer_address" id="cust-address" class="form-control" 
                                   value="{{ old('customer_address') }}" placeholder="e.g. Station Road, Jodhpur">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Quotation Number <span class="text-danger">*</span></label>
                            <input type="text" name="quotation_no" id="quote-number" class="form-control bg-light fw-bold text-primary" 
                                   readonly value="{{ old('quotation_no', $nextQuotationNo) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Quotation Date <span class="text-danger">*</span></label>
                            <input type="date" name="quotation_date" id="quote-date" class="form-control" 
                                   required value="{{ old('quotation_date', date('Y-m-d')) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Valid Until Date <span class="text-danger">*</span></label>
                            <input type="date" name="valid_until" id="quote-validity" class="form-control" 
                                   required value="{{ old('valid_until', date('Y-m-d', strtotime('+15 days'))) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Initial Status</label>
                            <select name="status" id="quote-status" class="form-select">
                                <option value="Draft" {{ old('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Sent" {{ old('status') === 'Sent' ? 'selected' : '' }}>Sent</option>
                                <option value="Pending" {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ old('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Line Items Card -->
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header p-3 border-bottom bg-light bg-opacity-50 d-flex justify-content-between align-items-center">
                    <h5 class="admin-card-title m-0 fs-6 fw-bold text-slate-900">
                        <i class="bi bi-box-seam text-primary me-2"></i> Hardware Line Items & GST Calculations
                    </h5>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold">
                        Auto-Calculates Base Rate + 18% GST
                    </span>
                </div>

                <!-- Quick Add From Database Catalog -->
                <div class="p-3 border-bottom bg-white">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-7">
                            <select id="quote-product-picker" class="form-select">
                                <option value="">-- Choose Hardware Product from Database --</option>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" 
                                            data-name="{{ $prod->name }}" 
                                            data-sku="{{ $prod->sku }}" 
                                            data-price="{{ $prod->selling_price }}" 
                                            data-gst="{{ $prod->gst_rate }}">
                                        {{ $prod->name }} ({{ $prod->sku }}) - ₹{{ number_format($prod->selling_price, 2) }} [Stock: {{ $prod->stock }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" id="quote-add-qty" min="1" value="1" class="form-control" placeholder="Qty">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary w-100 fw-bold" id="btn-add-product-line">
                                <i class="bi bi-plus-circle me-1"></i> Add to Table
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Line Items Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hoc align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Product Description</th>
                                <th class="text-center" style="width: 110px;">Qty</th>
                                <th class="text-end" style="width: 150px;">Base Rate (Excl GST)</th>
                                <th class="text-end" style="width: 130px;">Discount (₹)</th>
                                <th class="text-center" style="width: 100px;">GST %</th>
                                <th class="text-end" style="width: 150px;">Total (₹)</th>
                                <th class="text-center" style="width: 60px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="quote-items-tbody">
                            <!-- Populated dynamically via JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Summary & Totals Calculation Box -->
                <div class="p-4 bg-light bg-opacity-50 border-top">
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-5">
                            <div class="bg-white p-3 rounded-3 border shadow-sm">
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span>Taxable Subtotal:</span>
                                    <strong id="quote-subtotal" class="text-dark">₹0.00</strong>
                                </div>
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span>Total Discounts Applied:</span>
                                    <strong id="quote-discount-total" class="text-danger">₹0.00</strong>
                                </div>
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span>Total GST (18% SGST + CGST):</span>
                                    <strong id="quote-gst-total" class="text-dark">₹0.00</strong>
                                </div>
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span>Round Off:</span>
                                    <span id="quote-roundoff">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-baseline border-top pt-2 mt-2">
                                    <span class="fw-bold fs-6 text-slate-900">Grand Total:</span>
                                    <span class="fs-4 fw-extrabold text-primary" id="quote-grand-total">₹0.00</span>
                                </div>
                                <div class="mt-2 pt-2 border-top small text-muted">
                                    <strong>Amount in Words:</strong><br>
                                    <span id="quote-amount-words" class="fst-italic text-dark">Zero Rupees Only</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quotation Terms and Remarks -->
                <div class="p-4 border-top">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Internal Notes / Customer Specifications</label>
                            <textarea name="notes" id="quote-notes" class="form-control" rows="3" 
                                      placeholder="e.g. Free onsite assembly included, payment against delivery.">{{ old('notes') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Standard Terms & Conditions</label>
                            <div class="p-3 bg-light rounded-3 small text-muted border" style="max-height: 95px; overflow-y: auto;">
                                1. Quotation validity: 15 days from issue date.<br>
                                2. Prices include GST under valid HSN codes.<br>
                                3. Standard brand warranty applies directly from authorized service centers in Jodhpur.<br>
                                4. Goods once sold will not be returned.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("quote-items-tbody");
    const productPicker = document.getElementById("quote-product-picker");
    const addQtyInput = document.getElementById("quote-add-qty");
    const addBtn = document.getElementById("btn-add-product-line");

    let items = [];

    function renderRows() {
        if (items.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="8" class="text-center text-muted py-4"><i class="bi bi-cart-x fs-3 d-block mb-1"></i>No items added to quotation yet. Select a product above to add.</td></tr>`;
            calculateTotals();
            return;
        }

        let html = "";
        items.forEach((item, index) => {
            html += `
                <tr>
                    <td class="text-center fw-bold text-muted">${index + 1}</td>
                    <td>
                        <input type="hidden" name="items[${index}][product_id]" value="${item.productId || ''}">
                        <input type="hidden" name="items[${index}][item_name]" value="${item.name.replace(/"/g, '&quot;')}">
                        <input type="hidden" name="items[${index}][sku]" value="${(item.sku || '').replace(/"/g, '&quot;')}">
                        <strong class="text-slate-900">${item.name}</strong><br>
                        <small class="text-muted">SKU: <code>${item.sku || 'N/A'}</code></small>
                    </td>
                    <td style="width: 110px;">
                        <input type="number" name="items[${index}][quantity]" min="1" class="form-control form-control-sm text-center item-qty" data-index="${index}" value="${item.qty}">
                    </td>
                    <td style="width: 150px;">
                        <input type="number" step="0.01" name="items[${index}][unit_rate]" class="form-control form-control-sm text-end item-rate" data-index="${index}" value="${item.rate}">
                    </td>
                    <td style="width: 130px;">
                        <input type="number" step="0.01" name="items[${index}][discount]" class="form-control form-control-sm text-end item-discount" data-index="${index}" value="${item.discount}">
                    </td>
                    <td style="width: 100px;" class="text-center">
                        <input type="hidden" name="items[${index}][gst_rate]" value="${item.gstRate}">
                        <span class="badge bg-light text-dark border px-2 py-1">${item.gstRate}%</span>
                    </td>
                    <td class="text-end fw-bold text-slate-800" style="width: 150px;">
                        ₹${item.amount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                    </td>
                    <td class="text-center" style="width: 60px;">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" data-index="${index}" title="Remove Item">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        tableBody.innerHTML = html;
        calculateTotals();
    }

    function calculateTotals() {
        let subtotal = 0;
        let discountTotal = 0;
        let gstTotal = 0;
        let grandTotal = 0;

        items.forEach(item => {
            const lineSubtotal = item.rate * item.qty;
            const lineTaxable = Math.max(0, lineSubtotal - item.discount);
            const lineGst = lineTaxable * (item.gstRate / 100);
            const lineTotal = lineTaxable + lineGst;

            item.amount = Math.round(lineTotal * 100) / 100;
            subtotal += lineSubtotal;
            discountTotal += item.discount;
            gstTotal += lineGst;
            grandTotal += lineTotal;
        });

        const roundedGrandTotal = Math.round(grandTotal);
        const roundOff = Math.round((roundedGrandTotal - grandTotal) * 100) / 100;

        document.getElementById("quote-subtotal").innerText = "₹" + subtotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById("quote-discount-total").innerText = "₹" + discountTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById("quote-gst-total").innerText = "₹" + gstTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById("quote-roundoff").innerText = "₹" + roundOff.toFixed(2);
        document.getElementById("quote-grand-total").innerText = "₹" + roundedGrandTotal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        if (typeof HOC_UTILS !== 'undefined' && HOC_UTILS.numberToWordsINR) {
            document.getElementById("quote-amount-words").innerText = HOC_UTILS.numberToWordsINR(roundedGrandTotal);
        }
    }

    function addItemFromPicker() {
        const selected = productPicker.options[productPicker.selectedIndex];
        if (!selected || !selected.value) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Select a Product',
                    text: 'Please select a hardware product from the dropdown list.',
                    timer: 2500
                });
            } else {
                alert('Please select a product');
            }
            return;
        }

        const id = selected.value;
        const name = selected.getAttribute('data-name');
        const sku = selected.getAttribute('data-sku');
        const price = parseFloat(selected.getAttribute('data-price')) || 0;
        const gstRate = parseFloat(selected.getAttribute('data-gst')) || 18;
        const qty = parseInt(addQtyInput.value) || 1;

        // Base rate = selling price / 1.18
        const baseRate = Math.round((price / (1 + (gstRate / 100))) * 100) / 100;

        items.push({
            productId: id,
            name: name,
            sku: sku,
            qty: qty,
            rate: baseRate,
            discount: 0,
            gstRate: gstRate,
            amount: Math.round(price * qty * 100) / 100
        });

        productPicker.value = "";
        addQtyInput.value = 1;
        renderRows();
    }

    if (addBtn) addBtn.addEventListener("click", addItemFromPicker);

    tableBody.addEventListener("input", function (e) {
        const index = e.target.getAttribute("data-index");
        if (index === null) return;

        if (e.target.classList.contains("item-qty")) {
            items[index].qty = Math.max(1, parseInt(e.target.value) || 1);
        } else if (e.target.classList.contains("item-rate")) {
            items[index].rate = Math.max(0, parseFloat(e.target.value) || 0);
        } else if (e.target.classList.contains("item-discount")) {
            items[index].discount = Math.max(0, parseFloat(e.target.value) || 0);
        }

        const lineSubtotal = items[index].rate * items[index].qty;
        const lineTaxable = Math.max(0, lineSubtotal - items[index].discount);
        const lineGst = lineTaxable * (items[index].gstRate / 100);
        items[index].amount = Math.round((lineTaxable + lineGst) * 100) / 100;

        // Update row total without full re-render to keep focus
        const row = e.target.closest("tr");
        if (row) {
            const totalTd = row.children[6];
            if (totalTd) {
                totalTd.innerText = "₹" + items[index].amount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
        }

        calculateTotals();
    });

    tableBody.addEventListener("click", function (e) {
        const removeBtn = e.target.closest(".btn-remove-item");
        if (removeBtn) {
            const index = parseInt(removeBtn.getAttribute("data-index"));
            items.splice(index, 1);
            renderRows();
        }
    });

    // Form submit validation: ensure at least 1 item exists
    document.getElementById("quotation-create-form").addEventListener("submit", function (e) {
        if (items.length === 0) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Empty Quotation',
                    text: 'Please add at least one product item to generate a quotation.',
                });
            } else {
                alert('Please add at least one product item.');
            }
        }
    });

    // Initial render
    renderRows();
});
</script>
@endpush

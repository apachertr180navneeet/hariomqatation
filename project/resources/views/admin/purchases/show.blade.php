@extends('admin.includes.app')

@section('content')
<div class="d-print-none mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <div class="page-breadcrumb text-muted small mb-1">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
                <span class="mx-1">&bull;</span>
                <a href="{{ route('admin.purchases') }}" class="text-decoration-none text-muted">Inward Purchase Bills</a>
                <span class="mx-1">&bull;</span>
                <span class="text-dark fw-semibold">{{ $purchase->purchase_no }}</span>
            </div>
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Inward Goods Receipt Voucher</h1>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.purchases') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>All Inwards</span>
            </a>
            <button type="button" class="btn btn-primary fw-bold px-3 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2" onclick="window.print()">
                <i class="bi bi-printer-fill fs-6"></i>
                <span>Print Inward Receipt</span>
            </button>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-print-none rounded-3 shadow-sm mb-4 border-0" role="alert">
        <i class="bi bi-check-circle-fill me-2 text-success"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Printable Voucher Sheet -->
<div class="catalog-card shadow-sm p-4 p-md-5 bg-white border rounded-4 printable-voucher">
    <!-- Voucher Top Banner -->
    <div class="d-flex flex-wrap justify-content-between align-items-start pb-4 border-bottom gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <div class="bg-primary text-white rounded-3 p-2 fw-bold fs-5">HOC</div>
                <h3 class="fw-bolder text-slate-900 m-0">HARI OM COMPUTER</h3>
            </div>
            <p class="text-muted small mb-1">IT Hardware, Custom Rigs & Enterprise Workstations</p>
            <div class="small text-slate-700">
                <span>Near Bus Stand, Station Road, Palanpur - 385001</span><br>
                <span>Phone: +91 98790 12345 &bull; GSTIN: 24AAAFH1234F1Z5</span>
            </div>
        </div>

        <div class="text-md-end">
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1.5 fw-bold fs-6 mb-2 d-inline-block">
                GOODS INWARD VOUCHER
            </span>
            <div class="fs-4 fw-bolder font-monospace text-slate-900">{{ $purchase->purchase_no }}</div>
            <div class="text-muted small">Inward Date: <strong class="text-dark">{{ $purchase->purchase_date->format('d M, Y') }}</strong></div>
            <div class="text-muted small">Vendor Bill: <strong class="text-dark font-monospace">{{ $purchase->supplier_invoice_no }}</strong></div>
        </div>
    </div>

    <!-- Vendor and Settlement Details -->
    <div class="row g-4 py-4 border-bottom">
        <div class="col-sm-6">
            <h6 class="text-uppercase text-muted fw-bold small mb-2">Vendor / Distributor Details</h6>
            <div class="fs-5 fw-bold text-dark">{{ $purchase->supplier->company }}</div>
            <div class="text-slate-800 fw-medium">{{ $purchase->supplier->name }}</div>
            <div class="text-muted small"><i class="bi bi-telephone me-1"></i>{{ $purchase->supplier->phone }}</div>
            @if($purchase->supplier->email)
                <div class="text-muted small"><i class="bi bi-envelope me-1"></i>{{ $purchase->supplier->email }}</div>
            @endif
            @if($purchase->supplier->gstin)
                <div class="mt-1"><span class="badge bg-light text-dark border font-monospace">GSTIN: {{ $purchase->supplier->gstin }}</span></div>
            @endif
            @if($purchase->supplier->address)
                <div class="text-muted small mt-1">{{ $purchase->supplier->address }}, {{ $purchase->supplier->city }}</div>
            @endif
        </div>

        <div class="col-sm-6 text-sm-end">
            <h6 class="text-uppercase text-muted fw-bold small mb-2">Billing & Payment Status</h6>
            <div class="mb-2">
                @if($purchase->payment_status === 'Paid')
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 fw-bold fs-6">PAID IN FULL</span>
                @elseif($purchase->payment_status === 'Partial')
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1.5 fw-bold fs-6">PARTIALLY SETTLED</span>
                @else
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 fw-bold fs-6">PAYMENT UNPAID</span>
                @endif
            </div>
            <div class="small text-slate-700">Payment Terms: <strong>{{ $purchase->supplier->payment_terms }}</strong></div>
            @if($purchase->due_date)
                <div class="small text-slate-700">Due Date: <strong>{{ $purchase->due_date->format('d M, Y') }}</strong></div>
            @endif
            <div class="small text-slate-700">Recorded By: <strong>{{ $purchase->creator?->name ?? 'Inventory Administrator' }}</strong></div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-responsive my-4">
        <table class="table table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 5%;" class="text-center ps-3">#</th>
                    <th style="width: 38%;">Item Description / Product</th>
                    <th style="width: 15%;">SKU</th>
                    <th style="width: 10%;" class="text-center">HSN</th>
                    <th style="width: 10%;" class="text-center">Qty Recd</th>
                    <th style="width: 11%;" class="text-end">Unit Cost (₹)</th>
                    <th style="width: 11%;" class="text-end pe-3">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchase->items as $idx => $item)
                    <tr>
                        <td class="text-center fw-semibold text-muted">{{ $idx + 1 }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->item_name }}</div>
                            @if($item->product_id)
                                <small class="text-success"><i class="bi bi-check-circle me-1"></i>Stock updated in live catalog</small>
                            @endif
                        </td>
                        <td class="font-monospace small text-muted">{{ $item->sku ?: '—' }}</td>
                        <td class="text-center font-monospace small">{{ $item->hsn_code ?: '8471' }}</td>
                        <td class="text-center fw-bold text-primary">{{ $item->quantity }}</td>
                        <td class="text-end font-monospace">₹{{ number_format($item->unit_cost, 2) }}</td>
                        <td class="text-end font-monospace fw-bold text-dark">₹{{ number_format($item->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Financial Totals -->
    <div class="row g-4 pt-2 pb-4 border-bottom">
        <div class="col-md-7">
            <div class="p-3 bg-light rounded-3">
                <div class="small fw-bold text-slate-800 mb-1"><i class="bi bi-info-circle me-1 text-primary"></i> Goods Inward Acknowledgment:</div>
                <p class="text-muted small mb-0">
                    All hardware inventory listed above has been physically verified against vendor delivery challan and logged directly into Hari Om Computer warehouse ledger.
                </p>
                @if($purchase->notes)
                    <div class="mt-2 pt-2 border-top small text-slate-700">
                        <strong>Remarks:</strong> {{ $purchase->notes }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="d-flex flex-column gap-2 text-slate-800">
                <div class="d-flex justify-content-between">
                    <span>Taxable Subtotal:</span>
                    <span class="font-monospace fw-semibold">₹{{ number_format($purchase->taxable_amount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between text-muted small">
                    <span>CGST (Central Tax):</span>
                    <span class="font-monospace">₹{{ number_format($purchase->cgst_amount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between text-muted small">
                    <span>SGST (State Tax):</span>
                    <span class="font-monospace">₹{{ number_format($purchase->sgst_amount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between text-indigo fw-semibold pb-2 border-bottom">
                    <span>Total GST (ITC Eligible):</span>
                    <span class="font-monospace">₹{{ number_format($purchase->gst_total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center fs-5 fw-bold text-dark pt-1">
                    <span>Grand Total:</span>
                    <span class="font-monospace text-primary">₹{{ number_format($purchase->grand_total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>Amount Settled:</span>
                    <span class="font-monospace text-success fw-semibold">₹{{ number_format($purchase->paid_amount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between small">
                    <span class="text-danger fw-semibold">Balance Due:</span>
                    <span class="font-monospace text-danger fw-bold">₹{{ number_format($purchase->balance_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Signatures -->
    <div class="d-flex justify-content-between align-items-end pt-5 text-muted small">
        <div class="text-center" style="min-width: 180px;">
            <div class="border-top pt-2">Store Keeper / Receiver Signature</div>
        </div>
        <div class="text-center" style="min-width: 180px;">
            <div class="border-top pt-2">Authorised Signatory</div>
        </div>
    </div>
</div>
@endsection

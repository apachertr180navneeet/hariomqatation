@extends('admin.includes.app')

@section('content')
<!-- Page Actions Bar -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">{{ $quotation->quotation_no }}</h1>
            @php
                $statusBadge = match($quotation->status) {
                    'Approved' => 'badge-soft-success',
                    'Converted' => 'badge-soft-primary',
                    'Sent', 'Pending' => 'badge-soft-warning',
                    'Rejected' => 'badge-soft-danger',
                    default => 'badge-soft-secondary',
                };
            @endphp
            <span class="badge {{ $statusBadge }} fs-7 px-2.5 py-1">{{ $quotation->status }}</span>
        </div>
        <div class="page-breadcrumb text-muted small mt-1">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a> &bull;
            <a href="{{ route('admin.quotations') }}" class="text-decoration-none text-muted">Quotations</a> &bull;
            Generated on <strong>{{ $quotation->quotation_date ? $quotation->quotation_date->format('d M, Y') : 'N/A' }}</strong> &bull;
            Valid until <strong>{{ $quotation->valid_until ? $quotation->valid_until->format('d M, Y') : 'N/A' }}</strong>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.quotations.print', ['id' => $quotation->id]) }}" target="_blank" class="btn btn-outline-primary fw-semibold rounded-3">
            <i class="bi bi-printer me-1"></i> Print / Generate PDF
        </a>
        <button type="button" class="btn btn-outline-success fw-semibold rounded-3" id="btn-send-quote-wa">
            <i class="bi bi-whatsapp me-1"></i> Send on WhatsApp
        </button>
        <a href="{{ route('admin.quotations') }}" class="btn btn-outline-secondary fw-semibold rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left: Quotation Document Preview -->
    <div class="col-lg-8">
        <div class="admin-card p-4">
            
            <!-- Company & Customer Header Grid -->
            <div class="row border-bottom pb-4 mb-4 g-3">
                <div class="col-sm-6">
                    <div class="fw-bold text-primary text-uppercase small mb-1">Issued By:</div>
                    <h5 class="fw-bold mb-1 text-slate-900">HARI OM COMPUTER</h5>
                    <p class="text-muted small mb-0 lh-base">
                        Plot No. 42, Near Sojati Gate, Station Road, Jodhpur - 342001 (Raj.)<br>
                        GSTIN: <strong>08AABCH1234F1Z9</strong><br>
                        Phone: +91 98290 12345 / 0291-2654321<br>
                        Email: sales@hariomcomputer.com
                    </p>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <div class="fw-bold text-primary text-uppercase small mb-1">Quotation For:</div>
                    <h5 class="fw-bold mb-1 text-slate-900">{{ $quotation->customer_name }}</h5>
                    <p class="text-muted small mb-0 lh-base">
                        @if($quotation->customer_company)
                            <strong>{{ $quotation->customer_company }}</strong><br>
                        @endif
                        @if($quotation->customer_address)
                            {{ $quotation->customer_address }}<br>
                        @endif
                        Mobile: <strong>{{ $quotation->customer_phone }}</strong><br>
                        @if($quotation->customer_email)
                            Email: {{ $quotation->customer_email }}<br>
                        @endif
                        @if($quotation->customer_gstin)
                            GSTIN: <strong>{{ $quotation->customer_gstin }}</strong>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="text-center" style="width: 40px;">#</th>
                            <th>Product Description</th>
                            <th class="text-center" style="width: 70px;">Qty</th>
                            <th class="text-end" style="width: 130px;">Rate (₹)</th>
                            <th class="text-end" style="width: 110px;">Disc (₹)</th>
                            <th class="text-center" style="width: 80px;">GST %</th>
                            <th class="text-end" style="width: 140px;">Amount (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotation->items as $idx => $item)
                            <tr>
                                <td class="text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                                <td>
                                    <strong class="text-slate-900">{{ $item->item_name }}</strong>
                                    @if($item->sku)
                                        <br><small class="text-muted">SKU: <code>{{ $item->sku }}</code></small>
                                    @endif
                                </td>
                                <td class="text-center fw-semibold">{{ $item->quantity }}</td>
                                <td class="text-end text-muted">₹{{ number_format($item->unit_rate, 2) }}</td>
                                <td class="text-end text-danger">
                                    {{ $item->discount > 0 ? '₹' . number_format($item->discount, 2) : '-' }}
                                </td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $item->gst_rate }}%</span></td>
                                <td class="text-end fw-bold text-slate-800">₹{{ number_format($item->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Calculation Breakup -->
            <div class="row justify-content-end mb-4">
                <div class="col-md-7 col-lg-6">
                    <div class="bg-light bg-opacity-50 p-3 rounded-3 border">
                        <div class="d-flex justify-content-between small text-muted mb-2">
                            <span>Taxable Subtotal:</span>
                            <strong class="text-dark">₹{{ number_format($quotation->taxable_amount, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-2">
                            <span>Discounts:</span>
                            <strong class="text-danger">- ₹{{ number_format($quotation->discount_total, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-2">
                            <span>GST (18% CGST + SGST):</span>
                            <strong class="text-dark">₹{{ number_format($quotation->gst_total, 2) }}</strong>
                        </div>
                        @if($quotation->round_off != 0)
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>Round Off:</span>
                                <span>₹{{ number_format($quotation->round_off, 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-baseline border-top pt-2 mt-2">
                            <span class="fw-bold text-slate-900">Grand Total (INR):</span>
                            <span class="fs-4 fw-extrabold text-primary">₹{{ number_format($quotation->grand_total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terms & Notes -->
            <div class="border-top pt-3">
                <div class="row g-3">
                    @if($quotation->notes)
                        <div class="col-md-6">
                            <div class="small fw-bold text-uppercase text-muted mb-1">Customer / Internal Notes:</div>
                            <div class="p-2 bg-light rounded small border">{{ $quotation->notes }}</div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="small fw-bold text-uppercase text-muted mb-1">Standard Terms:</div>
                        <div class="small text-muted">
                            1. Valid until {{ $quotation->valid_until ? $quotation->valid_until->format('d M, Y') : '15 days' }}.<br>
                            2. 18% GST invoice provided upon order confirmation.<br>
                            3. Authorized brand warranty on all hardware components.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Right: Operational Controls Sidebar -->
    <div class="col-lg-4">
        
        <!-- Workflow Status Card -->
        <div class="admin-card mb-4 p-4">
            <h6 class="fw-bold mb-3 text-slate-900"><i class="bi bi-toggles text-primary me-2"></i> Quotation Lifecycle</h6>
            
            <form method="POST" action="{{ route('admin.quotations.status', $quotation->id) }}" class="mb-3">
                @csrf
                @method('PATCH')
                <label class="form-label small text-muted fw-semibold">Current Lifecycle Status:</label>
                <div class="input-group">
                    <select name="status" class="form-select form-select-sm">
                        @foreach(['Draft', 'Sent', 'Pending', 'Approved', 'Converted', 'Rejected'] as $st)
                            <option value="{{ $st }}" {{ $quotation->status === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>

            <div class="d-grid gap-2">
                <form method="POST" action="{{ route('admin.quotations.destroy', $quotation->id) }}" class="delete-form"
                      data-confirm-title="Delete Quotation?"
                      data-confirm="Are you sure you want to permanently delete quotation {{ $quotation->quotation_no }}?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="bi bi-trash3 me-1"></i> Delete Quotation
                    </button>
                </form>
            </div>
        </div>

        <!-- Meta Information Card -->
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-3 text-slate-900"><i class="bi bi-info-circle text-primary me-2"></i> Metadata</h6>
            <div class="small mb-2 d-flex justify-content-between">
                <span class="text-muted">Quotation ID:</span>
                <span class="fw-bold">{{ $quotation->quotation_no }}</span>
            </div>
            <div class="small mb-2 d-flex justify-content-between">
                <span class="text-muted">Created Date:</span>
                <span>{{ $quotation->created_at->format('d M, Y h:i A') }}</span>
            </div>
            <div class="small mb-2 d-flex justify-content-between">
                <span class="text-muted">Created By:</span>
                <span>{{ $quotation->creator->name ?? 'Admin Staff' }}</span>
            </div>
            <div class="small d-flex justify-content-between">
                <span class="text-muted">Total Line Items:</span>
                <span>{{ $quotation->items->count() }} Items</span>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // WhatsApp sharing button
    const waBtn = document.getElementById("btn-send-quote-wa");
    if (waBtn) {
        waBtn.addEventListener("click", function () {
            const quoteNo = @json($quotation->quotation_no);
            const custName = @json($quotation->customer_name);
            const total = "₹" + parseFloat(@json($quotation->grand_total)).toLocaleString('en-IN');
            const valid = @json($quotation->valid_until ? $quotation->valid_until->format('d M, Y') : '15 days');

            const text = `*HARI OM COMPUTER - COMMERCIAL QUOTATION*\nQuotation No: *${quoteNo}*\nCustomer: ${custName}\nGrand Total: *${total}* (Incl. 18% GST)\nValidity: Until ${valid}\n\nThank you for choosing Hari Om Computer, Jodhpur!`;
            
            const mobile = @json($quotation->customer_phone);
            const cleanPhone = mobile.replace(/[^0-9]/g, '');
            const targetPhone = cleanPhone.length === 10 ? '91' + cleanPhone : cleanPhone;

            const url = `https://wa.me/${targetPhone}?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
        });
    }
});
</script>
@endpush

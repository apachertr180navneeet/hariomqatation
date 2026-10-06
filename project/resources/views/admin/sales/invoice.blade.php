<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GST Tax Invoice {{ $invoice->invoice_no }} | Hari Om Computer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
</head>
<body class="bg-secondary bg-opacity-10 py-4">

    <!-- Control Bar (Hidden on Print) -->
    <div class="container mb-3 no-print" style="max-width: 210mm;">
        <div class="card border-0 shadow-sm p-3 d-flex flex-row justify-content-between align-items-center rounded-3 bg-white">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success px-3 py-2 fs-6">
                    <i class="bi bi-receipt me-1"></i> GST Tax Invoice &bull; {{ $invoice->invoice_no }}
                </span>
                <span class="badge bg-light text-dark border px-2.5 py-1.5 font-monospace">
                    Status: {{ $invoice->payment_status }}
                </span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary fw-bold px-4" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print / Save PDF
                </button>
                <a href="{{ route('admin.sales') }}" class="btn btn-outline-secondary fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Back to Invoices
                </a>
            </div>
        </div>
    </div>

    <!-- Printable A4 Sheet -->
    <div class="print-page-container">
        <!-- Header -->
        <div class="quotation-header d-flex justify-content-between align-items-start border-bottom pb-3 mb-3">
            <div>
                <div class="quotation-logo-text fs-3 fw-extrabold text-slate-900 leading-tight">HARI OM COMPUTER</div>
                <div class="quotation-logo-sub text-primary fw-semibold small">Western Rajasthan's Premier Computer Showroom & Service Center</div>
                <div class="small text-muted mt-1" style="font-size: 8.5pt; line-height: 1.5;">
                    Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001<br>
                    Phone: +91 98290 12345 / 0291-2654321 &bull; Email: sales@hariomcomputer.com<br>
                    GSTIN: <strong>08AABCH1234F1Z9</strong> &bull; PAN: <strong>AABCH1234F</strong>
                </div>
            </div>
            <div class="text-end">
                <div class="quotation-title-badge bg-success px-3 py-1.5 fw-bold text-white rounded-2 d-inline-block">
                    TAX INVOICE
                </div>
                <div class="mt-2 text-dark font-monospace fw-extrabold fs-6">{{ $invoice->invoice_no }}</div>
                <div class="small text-muted" style="font-size: 8.5pt;">
                    Date: <strong>{{ $invoice->invoice_date->format('d M, Y') }}</strong><br>
                    @if($invoice->quotation)
                        Ref Quote: <strong>{{ $invoice->quotation->quotation_no }}</strong>
                    @endif
                </div>
            </div>
        </div>

        <!-- Billed To & Invoice Metadata -->
        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="info-box h-100 p-3 rounded-2 border bg-light bg-opacity-50">
                    <div class="info-title small text-uppercase fw-bold text-muted mb-1">Billed To (Client Details):</div>
                    <strong class="d-block text-dark fs-6">{{ $invoice->customer_name }}</strong>
                    @if($invoice->customer_company)
                        <div class="fw-semibold text-secondary small">{{ $invoice->customer_company }}</div>
                    @endif
                    <div class="text-muted small mt-1">
                        {{ $invoice->customer_address ?: 'Jodhpur, Rajasthan' }}<br>
                        Phone: {{ $invoice->customer_phone }}
                        @if($invoice->customer_email)
                            &bull; {{ $invoice->customer_email }}
                        @endif
                    </div>
                    @if($invoice->customer_gstin)
                        <div class="mt-1 small">
                            GSTIN: <strong class="font-monospace text-primary">{{ $invoice->customer_gstin }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="info-box h-100 p-3 rounded-2 border bg-light bg-opacity-50">
                    <div class="info-title small text-uppercase fw-bold text-muted mb-1">Payment & Invoice Terms:</div>
                    <table class="w-100 small" style="line-height: 1.8;">
                        <tr>
                            <td class="text-muted">Payment Mode:</td>
                            <td class="fw-bold text-dark text-end font-monospace">{{ $invoice->payment_mode }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Payment Status:</td>
                            <td class="fw-bold text-success text-end">
                                <span class="badge {{ $invoice->payment_status === 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $invoice->payment_status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Due Date:</td>
                            <td class="fw-semibold text-dark text-end">{{ $invoice->due_date ? $invoice->due_date->format('d M, Y') : 'On Delivery' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Line Items Table -->
        <table class="table-print w-100 mb-3">
            <thead>
                <tr>
                    <th class="text-center" style="width: 32px;">#</th>
                    <th>Item Description & Specifications</th>
                    <th class="text-center" style="width: 70px;">SKU</th>
                    <th class="text-center" style="width: 45px;">Qty</th>
                    <th class="text-end" style="width: 95px;">Rate (₹)</th>
                    <th class="text-center" style="width: 55px;">GST %</th>
                    <th class="text-end" style="width: 110px;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoice->items as $index => $item)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <strong class="text-dark">{{ $item->item_name }}</strong>
                            @if($item->product && $item->product->specs)
                                <div class="text-muted" style="font-size: 8pt; line-height: 1.3;">
                                    {{ \Illuminate\Support\Str::limit($item->product->specs, 90) }}
                                </div>
                            @endif
                        </td>
                        <td class="text-center font-monospace small text-muted">{{ $item->sku ?: 'PROD' }}</td>
                        <td class="text-center fw-bold">{{ $item->quantity }}</td>
                        <td class="text-end font-monospace">₹{{ number_format($item->unit_rate, 2) }}</td>
                        <td class="text-center font-monospace">{{ (float) $item->gst_rate }}%</td>
                        <td class="text-end fw-bold font-monospace">₹{{ number_format($item->total_amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-3 text-muted">No line items in this invoice.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tax Breakdown & Bank Details Grid -->
        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="info-box h-100 p-3 rounded-2 border">
                    <div class="info-title small text-uppercase fw-bold text-muted mb-1">Direct Bank Account Transfer:</div>
                    <div class="small" style="line-height: 1.7;">
                        Beneficiary: <strong>HARI OM COMPUTER</strong><br>
                        Bank Name: <strong>HDFC Bank Ltd</strong><br>
                        A/C No: <strong class="font-monospace">50200087654321</strong><br>
                        IFSC Code: <strong class="font-monospace">HDFC0001234</strong><br>
                        Branch: Sojati Gate, Jodhpur (Raj.)
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="info-box h-100 p-3 rounded-2 border bg-light bg-opacity-25">
                    <table class="w-100 small" style="line-height: 1.8;">
                        <tr>
                            <td class="text-muted">Taxable Base Amount:</td>
                            <td class="text-end fw-semibold font-monospace">₹{{ number_format($invoice->taxable_amount, 2) }}</td>
                        </tr>
                        @if($invoice->discount_total > 0)
                            <tr>
                                <td class="text-muted">Total Discount:</td>
                                <td class="text-end fw-semibold text-danger font-monospace">-₹{{ number_format($invoice->discount_total, 2) }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-muted">Central GST (CGST 9%):</td>
                            <td class="text-end fw-semibold font-monospace">₹{{ number_format($invoice->cgst_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">State GST (SGST 9%):</td>
                            <td class="text-end fw-semibold font-monospace">₹{{ number_format($invoice->sgst_amount, 2) }}</td>
                        </tr>
                        @if($invoice->round_off != 0)
                            <tr>
                                <td class="text-muted">Round Off:</td>
                                <td class="text-end font-monospace">₹{{ number_format($invoice->round_off, 2) }}</td>
                            </tr>
                        @endif
                        <tr style="border-top: 2px solid #10b981;">
                            <td class="fw-bold fs-6 text-slate-900 pt-1">Invoice Grand Total:</td>
                            <td class="text-end fw-extrabold fs-6 text-success pt-1 font-monospace">
                                ₹{{ number_format($invoice->grand_total, 2) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Declaration & Signature -->
        <div class="row g-2 align-items-end mt-4 pt-3 border-top">
            <div class="col-7">
                <div class="small text-muted" style="font-size: 8pt; line-height: 1.5;">
                    <strong>Declaration:</strong><br>
                    We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct. Standard manufacturer hardware warranty applies.
                </div>
            </div>
            <div class="col-5 text-end">
                <div class="d-inline-block text-center">
                    <div style="height: 45px;"></div>
                    <div class="signature-line border-top pt-1 small fw-bold text-dark" style="min-width: 170px;">
                        For <strong>HARI OM COMPUTER</strong><br>
                        <span class="text-muted" style="font-size: 7.5pt;">(Authorized Signatory)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

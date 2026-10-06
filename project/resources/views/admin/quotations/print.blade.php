<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation_{{ str_replace('/', '_', $quotation->quotation_no) }}_HariOmComputer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
</head>
<body class="bg-secondary bg-opacity-10 py-4">

    <!-- Top Action Control Bar (Hidden during Print) -->
    <div class="container mb-3 no-print" style="max-width: 210mm;">
        <div class="card border-0 shadow-sm p-3 d-flex flex-row justify-content-between align-items-center rounded-3 bg-white">
            <div>
                <span class="badge bg-primary px-3 py-2 fs-6">
                    <i class="bi bi-file-earmark-pdf me-1"></i> A4 Commercial Quotation Preview
                </span>
                <span class="text-muted small ms-2 d-none d-md-inline">({{ $quotation->quotation_no }})</span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary fw-bold px-4" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print / Save as PDF
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="window.close()">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- A4 Printable Sheet Container -->
    <div class="print-page-container">
        
        <!-- Letterhead Header -->
        <div class="quotation-header d-flex justify-content-between align-items-start">
            <div>
                <div class="quotation-logo-text">HARI OM COMPUTER</div>
                <div class="quotation-logo-sub">Your Trusted Computer & Technology Partner</div>
                <div class="small text-muted mt-1" style="font-size: 8.5pt;">
                    Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001<br>
                    Phone: <strong>+91 98290 12345 / 0291-2654321</strong> &bull; Email: sales@hariomcomputer.com<br>
                    GSTIN: <strong>08AABCH1234F1Z9</strong> &bull; State Code: 08 (Rajasthan)
                </div>
            </div>
            <div class="text-end">
                <div class="quotation-title-badge">COMMERCIAL QUOTATION</div>
                <div class="mt-2 text-dark font-monospace fw-bold fs-6">{{ $quotation->quotation_no }}</div>
            </div>
        </div>

        <!-- Info Boxes (Customer & Quotation Meta) -->
        <div class="row g-2 mb-3">
            <!-- Customer Information -->
            <div class="col-6">
                <div class="info-box h-100">
                    <div class="info-title">Quotation To (Customer Details):</div>
                    <strong class="d-block text-dark fs-6">{{ $quotation->customer_name }}</strong>
                    @if($quotation->customer_company)
                        <div class="fw-semibold text-muted">{{ $quotation->customer_company }}</div>
                    @endif
                    <div class="text-muted">{{ $quotation->customer_address ?? 'Jodhpur, Rajasthan' }}</div>
                    <div class="mt-1">
                        <span>Mobile: <strong>{{ $quotation->customer_phone }}</strong></span><br>
                        <span>GSTIN: <strong>{{ $quotation->customer_gstin ?? 'Unregistered / Consumer' }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Quotation Meta -->
            <div class="col-6">
                <div class="info-box h-100">
                    <div class="info-title">Quotation Details:</div>
                    <table class="w-100 small">
                        <tr>
                            <td class="text-muted" style="width: 45%;">Quotation Date:</td>
                            <td class="fw-bold text-dark">{{ $quotation->quotation_date ? $quotation->quotation_date->format('d-M-Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Valid Until:</td>
                            <td class="fw-bold text-danger">{{ $quotation->valid_until ? $quotation->valid_until->format('d-M-Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Sales Executive:</td>
                            <td class="fw-semibold text-dark">{{ $quotation->creator->name ?? 'Sales Desk' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Payment Terms:</td>
                            <td class="fw-semibold text-dark">Against Delivery / Advance</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Product Line Items Table -->
        <table class="table-print">
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">#</th>
                    <th>Item Description & Specifications</th>
                    <th class="text-center" style="width: 50px;">Qty</th>
                    <th class="text-end" style="width: 85px;">Rate (₹)</th>
                    <th class="text-end" style="width: 75px;">Disc (₹)</th>
                    <th class="text-center" style="width: 55px;">GST %</th>
                    <th class="text-end" style="width: 100px;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotation->items as $idx => $item)
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td>
                            <strong>{{ $item->item_name }}</strong><br>
                            <span class="text-muted" style="font-size: 8pt;">
                                @if($item->sku) SKU: {{ $item->sku }} &bull; @endif HSN: 8471
                            </span>
                        </td>
                        <td class="text-center fw-bold">{{ $item->quantity }}</td>
                        <td class="text-end">₹{{ number_format($item->unit_rate, 2) }}</td>
                        <td class="text-end text-danger">{{ $item->discount > 0 ? '₹' . number_format($item->discount, 2) : '-' }}</td>
                        <td class="text-center">{{ $item->gst_rate }}%</td>
                        <td class="text-end fw-bold">₹{{ number_format($item->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals & Bank Details Row -->
        <div class="row g-2 mb-3 print-break-inside-avoid">
            <!-- Bank Details Box -->
            <div class="col-6">
                <div class="info-box h-100">
                    <div class="info-title">Bank Transfer Details for Payment:</div>
                    <table class="w-100" style="font-size: 8.5pt;">
                        <tr><td class="text-muted">Account Name:</td><td class="fw-bold">HARI OM COMPUTER</td></tr>
                        <tr><td class="text-muted">Bank Name:</td><td>HDFC Bank Ltd</td></tr>
                        <tr><td class="text-muted">Account No:</td><td class="fw-bold">50200087654321</td></tr>
                        <tr><td class="text-muted">IFSC Code:</td><td class="fw-bold">HDFC0001234</td></tr>
                        <tr><td class="text-muted">Branch:</td><td>Sojati Gate, Jodhpur</td></tr>
                        <tr><td class="text-muted">UPI ID:</td><td class="fw-bold text-primary">hariomcomputer@hdfcbank</td></tr>
                    </table>
                </div>
            </div>

            <!-- Calculation Summary Box -->
            <div class="col-6">
                <div class="info-box h-100">
                    <table class="w-100" style="font-size: 9pt;">
                        <tr>
                            <td class="text-muted">Taxable Subtotal:</td>
                            <td class="text-end fw-semibold text-dark">₹{{ number_format($quotation->taxable_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Total Discount:</td>
                            <td class="text-end fw-semibold text-danger">
                                {{ $quotation->discount_total > 0 ? '- ₹' . number_format($quotation->discount_total, 2) : '₹0.00' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Central GST (CGST 9%):</td>
                            <td class="text-end fw-semibold">₹{{ number_format($quotation->gst_total / 2, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">State GST (SGST 9%):</td>
                            <td class="text-end fw-semibold">₹{{ number_format($quotation->gst_total / 2, 2) }}</td>
                        </tr>
                        @if($quotation->round_off != 0)
                            <tr>
                                <td class="text-muted">Round Off:</td>
                                <td class="text-end">₹{{ number_format($quotation->round_off, 2) }}</td>
                            </tr>
                        @endif
                        <tr style="border-top: 1.5px solid #0284c7;">
                            <td class="fw-bold fs-6 pt-1">Grand Total:</td>
                            <td class="text-end fw-extrabold fs-6 text-primary pt-1">₹{{ number_format($quotation->grand_total, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Amount in Words -->
        <div class="info-box mb-3 print-break-inside-avoid" style="background: #f1f5f9;">
            <span class="text-muted small">Amount Chargeable (in words): </span>
            <strong class="text-dark" id="p-words">INR {{ number_format($quotation->grand_total, 2) }}</strong>
        </div>

        <!-- Terms & Signature Row -->
        <div class="row g-2 align-items-end print-break-inside-avoid mt-2">
            <div class="col-7">
                <div class="terms-box">
                    <strong>Terms & Conditions:</strong>
                    <ol class="ps-3 mb-0" style="margin-top: 2px;">
                        <li>Quotation is valid for 15 days from issue date.</li>
                        <li>Prices are inclusive of 18% GST (Input Tax Credit eligible).</li>
                        <li>Standard brand warranty applies directly from authorized service centers.</li>
                        <li>Goods once sold will not be taken back or exchanged.</li>
                    </ol>
                </div>
            </div>
            <div class="col-5 text-end">
                <div class="d-inline-block text-center">
                    <div class="signature-line">
                        For <strong>HARI OM COMPUTER</strong><br>
                        <span class="text-muted" style="font-size: 7.5pt;">(Authorized Signatory / Manager)</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/store-data.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (typeof HOC_UTILS !== 'undefined' && HOC_UTILS.numberToWordsINR) {
                document.getElementById("p-words").innerText = HOC_UTILS.numberToWordsINR({{ $quotation->grand_total }});
            }
        });
    </script>
</body>
</html>

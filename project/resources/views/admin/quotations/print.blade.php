<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation_{{ str_replace(['/', '\\', ' '], '_', $quotation->quotation_no) }}_HariOmComputer</title>
    
    <!-- Google Fonts: Plus Jakarta Sans (Headings), Inter (Body), JetBrains Mono (Data/Numbers) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --hoc-navy: #0f172a;
            --hoc-dark: #1e293b;
            --hoc-blue: #0284c7;
            --hoc-blue-dark: #0369a1;
            --hoc-blue-light: #e0f2fe;
            --hoc-slate: #475569;
            --hoc-light-slate: #64748b;
            --hoc-border: #e2e8f0;
            --hoc-card-bg: #f8fafc;
            --hoc-emerald: #059669;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
            margin: 0;
            padding: 24px 0;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Action Preview Toolbar */
        .preview-toolbar {
            max-width: 210mm;
            margin: 0 auto 20px auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.08);
            padding: 12px 20px;
        }

        /* A4 Page Container */
        .print-page-container {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.12), 0 0 1px 1px rgba(15, 23, 42, 0.05);
            padding: 12mm 15mm 15mm 15mm;
            box-sizing: border-box;
            position: relative;
            color: #1e293b;
        }

        /* Top decorative accent strip */
        .page-accent-bar {
            height: 4px;
            background: linear-gradient(90deg, #0f172a 0%, #0284c7 50%, #38bdf8 100%);
            border-radius: 4px 4px 0 0;
            margin: -12mm -15mm 10mm -15mm;
        }

        /* Header / Letterhead */
        .quotation-header {
            padding-bottom: 14px;
            margin-bottom: 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        .brand-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 21pt;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: var(--hoc-navy);
            line-height: 1.1;
        }

        .brand-subtitle {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 8pt;
            font-weight: 700;
            color: var(--hoc-blue);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .company-meta-item {
            font-size: 8.5pt;
            color: var(--hoc-slate);
            line-height: 1.45;
        }

        /* Document Badge Box */
        .doc-badge-card {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            border-radius: 8px;
            padding: 10px 18px;
            text-align: right;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
            display: inline-block;
        }

        .doc-badge-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13pt;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #ffffff;
            margin: 0;
        }

        .doc-badge-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11pt;
            font-weight: 700;
            color: #38bdf8;
            margin-top: 3px;
            letter-spacing: 0.02em;
        }

        /* Metadata Cards */
        .info-card {
            background: var(--hoc-card-bg);
            border: 1px solid var(--hoc-border);
            border-radius: 8px;
            padding: 12px 14px;
            height: 100%;
        }

        .info-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 6px;
            margin-bottom: 8px;
        }

        .info-card-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 8.2pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--hoc-blue-dark);
            margin: 0;
        }

        .meta-table {
            width: 100%;
            font-size: 8.6pt;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 2.5px 0;
            vertical-align: top;
        }

        .meta-label {
            color: var(--hoc-light-slate);
            font-weight: 500;
            width: 44%;
        }

        .meta-value {
            color: var(--hoc-navy);
            font-weight: 600;
        }

        /* Items Table */
        .table-print {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0;
            font-size: 8.8pt;
        }

        .table-print thead th {
            background-color: #0f172a;
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 8.2pt;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 9px 10px;
            border: 1px solid #0f172a;
        }

        .table-print thead th:first-child {
            border-top-left-radius: 6px;
        }

        .table-print thead th:last-child {
            border-top-right-radius: 6px;
        }

        .table-print tbody td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            vertical-align: middle;
            color: #1e293b;
        }

        .table-print tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .table-print .item-name {
            font-weight: 700;
            color: #0f172a;
            font-size: 9.2pt;
        }

        .table-print .item-specs {
            color: #64748b;
            font-size: 7.8pt;
            margin-top: 2px;
            line-height: 1.35;
        }

        .table-print .tabular-num {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
            font-size: 8.8pt;
        }

        /* Financial Summary & Bank Row */
        .summary-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
        }

        .bank-card {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 14px;
            height: 100%;
        }

        .bank-meta-table {
            width: 100%;
            font-size: 8.4pt;
        }

        .bank-meta-table td {
            padding: 2.5px 0;
        }

        .summary-table {
            width: 100%;
            font-size: 8.7pt;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 5px 14px;
        }

        .summary-table .subtotal-row {
            color: #475569;
        }

        .summary-table .grand-total-row {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            color: #ffffff;
            border-top: 1px solid #0f172a;
        }

        .grand-total-row td {
            padding: 9px 14px;
        }

        .grand-total-label {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 10.5pt;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .grand-total-value {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 800;
            font-size: 14pt;
            color: #38bdf8;
            text-align: right;
        }

        /* Words Banner */
        .words-banner {
            background: #f1f5f9;
            border-left: 4px solid #0284c7;
            border-radius: 0 6px 6px 0;
            padding: 8px 14px;
            font-size: 8.5pt;
            margin: 12px 0;
        }

        /* Terms & Signature */
        .terms-box {
            background: #fafafa;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            padding: 9px 12px;
            font-size: 7.8pt;
            color: #475569;
            line-height: 1.45;
        }

        .signature-box {
            text-align: center;
            width: 190px;
            margin-left: auto;
        }

        .signature-line {
            border-top: 1.5px solid #0f172a;
            padding-top: 5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 8.5pt;
            font-weight: 700;
            color: #0f172a;
            margin-top: 45px;
        }

        .doc-watermark-tag {
            font-size: 6.8pt;
            letter-spacing: 0.1em;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* PRINT MEDIA QUERIES */
        @page {
            size: A4 portrait;
            margin: 10mm 12mm 12mm 12mm;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                font-size: 9.5pt;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .no-print,
            .preview-toolbar {
                display: none !important;
            }

            .print-page-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                width: 100% !important;
                min-height: auto !important;
                margin: 0 !important;
            }

            .page-accent-bar {
                margin: 0 0 8mm 0 !important;
            }

            .print-break-inside-avoid {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .table-print thead th {
                background-color: #0f172a !important;
                color: #ffffff !important;
            }

            .grand-total-row {
                background: #0f172a !important;
                color: #ffffff !important;
            }

            .grand-total-value {
                color: #38bdf8 !important;
            }
        }
    </style>
</head>
<body>

    <!-- Top Action Control Bar (Hidden during Print) -->
    <div class="preview-toolbar no-print">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary px-3 py-2 fw-bold fs-7 shadow-sm">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> A4 Commercial Quotation
                </span>
                <span class="badge bg-light text-dark border font-monospace px-2.5 py-1.5 fs-7">
                    {{ $quotation->quotation_no }}
                </span>
                <span class="badge {{ $quotation->status === 'Approved' ? 'bg-success' : ($quotation->status === 'Converted' ? 'bg-info text-dark' : 'bg-warning text-dark') }} px-2.5 py-1.5 fs-7">
                    {{ $quotation->status }}
                </span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-primary fw-bold px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2" onclick="window.print()">
                    <i class="bi bi-printer-fill fs-6"></i>
                    <span>Print / Save as PDF</span>
                </button>
                <a href="{{ route('admin.quotations') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3">
                    <i class="bi bi-arrow-left me-1"></i> Back to Quotations
                </a>
            </div>
        </div>
    </div>

    <!-- A4 Printable Sheet Container -->
    <div class="print-page-container">
        
        <!-- Top Colored Accent Bar -->
        <div class="page-accent-bar"></div>

        <!-- Letterhead Header -->
        <div class="quotation-header d-flex justify-content-between align-items-start">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div style="background: linear-gradient(135deg, #0f172a 0%, #0284c7 100%); width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="bi bi-cpu-fill fs-5"></i>
                    </div>
                    <div>
                        <div class="brand-title">HARI OM COMPUTER</div>
                    </div>
                </div>
                <div class="brand-subtitle">Commercial IT Systems & Workstation Enterprise</div>
                
                <div class="company-meta-item mt-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-primary" style="font-size: 8pt;"></i>
                        <span>Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-0.5">
                        <span><i class="bi bi-telephone-fill text-primary me-1" style="font-size: 7.5pt;"></i>+91 98290 12345 / 0291-2654321</span>
                        <span><i class="bi bi-envelope-fill text-primary me-1" style="font-size: 7.5pt;"></i>sales@hariomcomputer.com</span>
                    </div>
                    <div class="mt-1 d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark border font-monospace" style="font-size: 7.8pt;">
                            GSTIN: <strong>08AABCH1234F1Z9</strong>
                        </span>
                        <span class="badge bg-light text-muted border font-monospace" style="font-size: 7.8pt;">
                            State Code: 08 (Rajasthan)
                        </span>
                        <span class="badge bg-light text-muted border font-monospace" style="font-size: 7.8pt;">
                            PAN: <strong>AABCH1234F</strong>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Top Right Document Tag -->
            <div class="text-end">
                <div class="doc-badge-card">
                    <div class="doc-badge-title">Commercial Quotation</div>
                    <div class="doc-badge-number">{{ $quotation->quotation_no }}</div>
                </div>
                <div class="doc-watermark-tag mt-2">Original Copy &bull; Proforma Estimate</div>
            </div>
        </div>

        <!-- Info Cards (Customer & Quotation Meta) -->
        <div class="row g-3 mb-3">
            <!-- Customer Information -->
            <div class="col-6">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-title">
                            <i class="bi bi-person-badge-fill me-1"></i> Quotation Issued To:
                        </div>
                        <span class="badge bg-white text-secondary border px-2 py-0.5" style="font-size: 7pt;">CLIENT</span>
                    </div>
                    
                    <div class="fw-bold fs-6 text-dark mb-0.5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        {{ $quotation->customer_name }}
                    </div>
                    
                    @if($quotation->customer_company)
                        <div class="fw-bold text-primary small mb-1">
                            <i class="bi bi-building me-1"></i>{{ $quotation->customer_company }}
                        </div>
                    @endif

                    <div class="text-muted small mb-1" style="line-height: 1.4;">
                        {{ $quotation->customer_address ?: 'Jodhpur, Rajasthan' }}
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-2 pt-1 border-top border-light-subtle">
                        <span class="badge bg-white text-dark border font-monospace small">
                            <i class="bi bi-phone me-1 text-primary"></i>{{ $quotation->customer_phone }}
                        </span>
                        @if($quotation->customer_gstin)
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle font-monospace small">
                                GSTIN: {{ $quotation->customer_gstin }}
                            </span>
                        @else
                            <span class="badge bg-light text-muted border small">Retail Consumer</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quotation Meta -->
            <div class="col-6">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-title">
                            <i class="bi bi-file-earmark-check-fill me-1"></i> Quotation Specifications:
                        </div>
                        <span class="badge bg-white text-secondary border px-2 py-0.5" style="font-size: 7pt;">TERMS</span>
                    </div>

                    <table class="meta-table">
                        <tr>
                            <td class="meta-label">Quotation Date:</td>
                            <td class="meta-value font-monospace">
                                {{ $quotation->quotation_date ? $quotation->quotation_date->format('d-M-Y') : date('d-M-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-label">Valid Until:</td>
                            <td class="meta-value text-danger font-monospace">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-1.5 py-0.5 font-monospace">
                                    {{ $quotation->valid_until ? $quotation->valid_until->format('d-M-Y') : date('d-M-Y', strtotime('+15 days')) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-label">Prepared By:</td>
                            <td class="meta-value">
                                <i class="bi bi-person-check text-success me-1"></i>{{ $quotation->creator->name ?? 'Commercial Desk' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-label">Payment Terms:</td>
                            <td class="meta-value text-slate-800">
                                Against Delivery / Advance Transfer
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Product Line Items Table -->
        <table class="table-print">
            <thead>
                <tr>
                    <th class="text-center" style="width: 32px;">#</th>
                    <th>Item Description & Technical Specifications</th>
                    <th class="text-center" style="width: 48px;">Qty</th>
                    <th class="text-end" style="width: 95px;">Rate (₹)</th>
                    <th class="text-end" style="width: 75px;">Disc (₹)</th>
                    <th class="text-center" style="width: 55px;">GST %</th>
                    <th class="text-end" style="width: 105px;">Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotation->items as $idx => $item)
                    <tr>
                        <td class="text-center font-monospace text-muted">{{ $idx + 1 }}</td>
                        <td>
                            <div class="item-name">{{ $item->item_name }}</div>
                            <div class="item-specs">
                                @if($item->sku)
                                    <span class="badge bg-light text-dark border font-monospace px-1 py-0.5 me-1">SKU: {{ $item->sku }}</span>
                                @endif
                                <span class="badge bg-light text-muted border font-monospace px-1 py-0.5 me-1">HSN: 8471</span>
                                @if($item->product && $item->product->specs)
                                    <span class="text-muted">{{ Str::limit($item->product->specs, 85) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border px-2 py-1 tabular-num">{{ $item->quantity }}</span>
                        </td>
                        <td class="text-end tabular-num">
                            ₹{{ number_format($item->unit_rate ?? $item->unit_price, 2) }}
                        </td>
                        <td class="text-end tabular-num">
                            @if(($item->discount ?? 0) > 0)
                                <span class="text-danger">-₹{{ number_format($item->discount, 2) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border px-1.5 py-0.5 font-monospace" style="font-size: 7.8pt;">
                                {{ number_format($item->gst_rate, 0) }}%
                            </span>
                        </td>
                        <td class="text-end tabular-num fw-bold text-slate-900">
                            ₹{{ number_format($item->total_amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-3 text-muted">No line items in this quotation.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Totals & Bank Details Row -->
        <div class="row g-3 print-break-inside-avoid">
            <!-- Bank Details Box -->
            <div class="col-6">
                <div class="bank-card">
                    <div class="d-flex align-items-center justify-content-between pb-1 mb-2 border-bottom border-secondary border-opacity-10">
                        <div class="fw-bold small text-uppercase" style="font-family: 'Plus Jakarta Sans', sans-serif; color: var(--hoc-blue-dark); letter-spacing: 0.05em;">
                            <i class="bi bi-bank2 me-1"></i> Bank Payment Details
                        </div>
                        <span class="badge bg-white text-success border border-success-subtle px-1.5 py-0.5" style="font-size: 6.8pt;">
                            <i class="bi bi-shield-check me-1"></i>VERIFIED ACCOUNT
                        </span>
                    </div>

                    <table class="bank-meta-table">
                        <tr>
                            <td class="meta-label">Beneficiary Name:</td>
                            <td class="meta-value">HARI OM COMPUTER</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Bank Name:</td>
                            <td class="meta-value">HDFC Bank Ltd</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Account Number:</td>
                            <td class="meta-value font-monospace fw-bold text-primary">50200087654321</td>
                        </tr>
                        <tr>
                            <td class="meta-label">IFSC Code:</td>
                            <td class="meta-value font-monospace fw-bold">HDFC0001234</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Branch:</td>
                            <td class="meta-value">Sojati Gate, Jodhpur</td>
                        </tr>
                        <tr>
                            <td class="meta-label">UPI ID:</td>
                            <td class="meta-value font-monospace text-primary fw-bold">hariomcomputer@hdfcbank</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Calculation Summary Box -->
            <div class="col-6">
                <div class="summary-card">
                    <table class="summary-table">
                        <tr class="subtotal-row">
                            <td>Taxable Subtotal:</td>
                            <td class="text-end font-monospace fw-bold text-dark">
                                ₹{{ number_format($quotation->taxable_amount, 2) }}
                            </td>
                        </tr>
                        <tr class="subtotal-row">
                            <td>Total Discount:</td>
                            <td class="text-end font-monospace {{ $quotation->discount_total > 0 ? 'text-danger' : 'text-muted' }}">
                                {{ $quotation->discount_total > 0 ? '- ₹' . number_format($quotation->discount_total, 2) : '₹0.00' }}
                            </td>
                        </tr>
                        <tr class="subtotal-row">
                            <td>Central GST (CGST 9%):</td>
                            <td class="text-end font-monospace">
                                ₹{{ number_format($quotation->gst_total / 2, 2) }}
                            </td>
                        </tr>
                        <tr class="subtotal-row">
                            <td>State GST (SGST 9%):</td>
                            <td class="text-end font-monospace">
                                ₹{{ number_format($quotation->gst_total / 2, 2) }}
                            </td>
                        </tr>
                        @if($quotation->round_off != 0)
                            <tr class="subtotal-row">
                                <td>Round Off:</td>
                                <td class="text-end font-monospace">
                                    {{ $quotation->round_off > 0 ? '+' : '' }}₹{{ number_format($quotation->round_off, 2) }}
                                </td>
                            </tr>
                        @endif
                        <tr class="grand-total-row">
                            <td class="grand-total-label">Grand Total (INR):</td>
                            <td class="grand-total-value">
                                ₹{{ number_format($quotation->grand_total, 2) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Amount Chargeable in Words Banner -->
        <div class="words-banner print-break-inside-avoid">
            <span class="text-muted fw-bold text-uppercase me-1" style="font-size: 7.8pt;">Amount in Words:</span>
            <strong class="text-dark" id="p-words">
                {{-- Fallback will be enhanced via HOC_UTILS script below --}}
                INR {{ number_format($quotation->grand_total, 2) }}
            </strong>
        </div>

        <!-- Terms & Signature Row -->
        <div class="row g-3 align-items-end print-break-inside-avoid mt-1">
            <div class="col-7">
                <div class="terms-box">
                    <strong class="text-dark d-block mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        <i class="bi bi-info-circle me-1 text-primary"></i>Terms & Conditions:
                    </strong>
                    <ol class="ps-3 mb-0" style="padding-left: 14px !important;">
                        <li>Quotation is valid for 15 days from date of issuance.</li>
                        <li>Prices include 18% GST with full eligible Input Tax Credit (ITC).</li>
                        <li>Manufacturer warranty honored directly by brand authorized service centers.</li>
                        <li>Payments should be remitted directly to the official HDFC Bank account above.</li>
                    </ol>
                </div>
            </div>
            
            <div class="col-5">
                <div class="signature-box">
                    <div style="font-size: 7.8pt; color: #64748b; margin-bottom: 2px;">For <strong>HARI OM COMPUTER</strong></div>
                    <div class="signature-line">
                        Authorized Signatory
                    </div>
                    <div class="text-muted" style="font-size: 6.8pt; margin-top: 2px;">Jodhpur, Rajasthan &bull; Computer ERP</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script to populate exact INR words -->
    <script src="{{ asset('assets/js/store-data.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const grandTotal = {{ (float) $quotation->grand_total }};
            const wordsEl = document.getElementById("p-words");

            if (typeof HOC_UTILS !== 'undefined' && HOC_UTILS.numberToWordsINR) {
                const words = HOC_UTILS.numberToWordsINR(grandTotal);
                if (words && words.trim() !== "") {
                    wordsEl.innerText = words;
                    return;
                }
            }

            // Client-side fallback Indian numbering system converter
            function inrWords(num) {
                const a = ['', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen '];
                const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
                
                num = Math.round(num);
                if (num === 0) return 'Zero Rupees Only';
                
                let str = '';
                const crores = Math.floor(num / 10000000);
                num %= 10000000;
                const lakhs = Math.floor(num / 100000);
                num %= 100000;
                const thousands = Math.floor(num / 1000);
                num %= 1000;
                const hundreds = Math.floor(num / 100);
                const remainder = num % 100;

                function getTens(n) {
                    if (n < 20) return a[n];
                    return b[Math.floor(n / 10)] + (n % 10 ? ' ' + a[n % 10] : ' ');
                }

                if (crores > 0) str += getTens(crores) + 'Crore ';
                if (lakhs > 0) str += getTens(lakhs) + 'Lakh ';
                if (thousands > 0) str += getTens(thousands) + 'Thousand ';
                if (hundreds > 0) str += a[hundreds] + 'Hundred ';
                if (remainder > 0) str += getTens(remainder);

                return str.trim() + ' Rupees Only';
            }

            wordsEl.innerText = inrWords(grandTotal);
        });
    </script>
</body>
</html>

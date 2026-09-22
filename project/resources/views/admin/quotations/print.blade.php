<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Quotation | Hari Om Computer</title>
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
                <span class="text-muted small ms-2 d-none d-md-inline">(Ready for Print / DomPDF conversion)</span>
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
                    Phone: <strong>+91 98290 12345 / 0291-2654321</strong> &bull; Email: info@hariomcomputer.com<br>
                    GSTIN: <strong>08AABCH1234F1Z9</strong> &bull; State Code: 08 (Rajasthan)
                </div>
            </div>
            <div class="text-end">
                <div class="quotation-title-badge">ESTIMATE / QUOTATION</div>
                <div class="mt-2 text-dark font-monospace fw-bold fs-6" id="p-quote-no">HOC/QTN/2026/0001</div>
            </div>
        </div>

        <!-- Info Boxes (Customer & Quotation Meta) -->
        <div class="row g-2 mb-3">
            <!-- Customer Information -->
            <div class="col-6">
                <div class="info-box h-100">
                    <div class="info-title">Quotation To (Customer Details):</div>
                    <strong class="d-block text-dark fs-6" id="p-cust-name">Customer Name</strong>
                    <div id="p-cust-company" class="fw-semibold text-muted">Company Name</div>
                    <div id="p-cust-address" class="text-muted">Address</div>
                    <div class="mt-1">
                        <span>Mobile: <strong id="p-cust-mobile">+91 98290 XXXXX</strong></span><br>
                        <span>GSTIN: <strong id="p-cust-gstin">Unregistered</strong></span>
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
                            <td class="fw-bold text-dark" id="p-quote-date">14-Aug-2026</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Valid Until:</td>
                            <td class="fw-bold text-danger" id="p-quote-validity">29-Aug-2026</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Sales Executive:</td>
                            <td class="fw-semibold text-dark" id="p-quote-salesperson">Sunil Sharma</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Payment Terms:</td>
                            <td class="fw-semibold text-dark">Against Delivery / 100% Advance</td>
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
            <tbody id="p-items-tbody">
                <!-- Injected via JS -->
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
                            <td class="text-end fw-semibold text-dark" id="p-subtotal">₹0</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Total Discount:</td>
                            <td class="text-end fw-semibold text-danger" id="p-discount">₹0</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Central GST (CGST 9%):</td>
                            <td class="text-end fw-semibold" id="p-cgst">₹0</td>
                        </tr>
                        <tr>
                            <td class="text-muted">State GST (SGST 9%):</td>
                            <td class="text-end fw-semibold" id="p-sgst">₹0</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Round Off:</td>
                            <td class="text-end" id="p-roundoff">₹0</td>
                        </tr>
                        <tr style="border-top: 1.5px solid #0284c7;">
                            <td class="fw-bold fs-6 pt-1">Grand Total:</td>
                            <td class="text-end fw-extrabold fs-6 text-primary pt-1" id="p-grandtotal">₹0</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Amount in Words -->
        <div class="info-box mb-3 print-break-inside-avoid" style="background: #f1f5f9;">
            <span class="text-muted small">Amount Chargeable (in words): </span>
            <strong class="text-dark" id="p-words">Rupees Only</strong>
        </div>

        <!-- Terms & Signature Row -->
        <div class="row g-2 align-items-end print-break-inside-avoid mt-2">
            <div class="col-7">
                <div class="terms-box">
                    <strong>Terms & Conditions:</strong>
                    <ol class="ps-3 mb-0" style="margin-top: 2px;">
                        <li>Quotation is valid for 15 days from issue date.</li>
                        <li>Prices are inclusive of 18% GST (ITC eligible).</li>
                        <li>Standard manufacturer warranty applies directly on genuine hardware.</li>
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
            const urlParams = new URLSearchParams(window.location.search);
            const qId = urlParams.get("id") || "{{ $quotationId ?? 'HOC/QTN/2026/0001' }}";
            const q = DataStore.getQuotationById(qId) || DataStore.getQuotations()[0];

            if (!q) return;

            document.title = `Quotation_${q.id.replace(/\//g, '_')}_HariOmComputer`;
            document.getElementById("p-quote-no").innerText = q.id;
            document.getElementById("p-quote-date").innerText = q.date;
            document.getElementById("p-quote-validity").innerText = q.validUntil;
            document.getElementById("p-quote-salesperson").innerText = q.salesPerson || "Sunil Sharma";

            document.getElementById("p-cust-name").innerText = q.customerName;
            document.getElementById("p-cust-company").innerText = q.company || "Retail Buyer";
            document.getElementById("p-cust-address").innerText = q.address || "Jodhpur, Rajasthan";
            document.getElementById("p-cust-mobile").innerText = q.mobile;
            document.getElementById("p-cust-gstin").innerText = q.gstin || "Unregistered / Consumer";

            let html = "";
            (q.items || []).forEach((item, idx) => {
                html += `
                    <tr>
                        <td class="text-center">${idx + 1}</td>
                        <td>
                            <strong>${item.name}</strong><br>
                            <span class="text-muted" style="font-size: 8pt;">SKU: ${item.sku} &bull; HSN: 8471</span>
                        </td>
                        <td class="text-center fw-bold">${item.qty}</td>
                        <td class="text-end">${HOC_UTILS.formatINR(item.rate)}</td>
                        <td class="text-end text-danger">${HOC_UTILS.formatINR(item.discount || 0)}</td>
                        <td class="text-center">${item.gstRate || 18}%</td>
                        <td class="text-end fw-bold">${HOC_UTILS.formatINR(item.amount)}</td>
                    </tr>
                `;
            });
            document.getElementById("p-items-tbody").innerHTML = html;

            // Calculations
            document.getElementById("p-subtotal").innerText = HOC_UTILS.formatINR(q.subtotal);
            document.getElementById("p-discount").innerText = HOC_UTILS.formatINR(q.discountTotal);
            document.getElementById("p-cgst").innerText = HOC_UTILS.formatINR(q.gstTotal / 2);
            document.getElementById("p-sgst").innerText = HOC_UTILS.formatINR(q.gstTotal / 2);
            document.getElementById("p-roundoff").innerText = HOC_UTILS.formatINR(q.roundOff || 0);
            document.getElementById("p-grandtotal").innerText = HOC_UTILS.formatINR(q.grandTotal);
            document.getElementById("p-words").innerText = HOC_UTILS.numberToWordsINR(q.grandTotal);
        });
    </script>
</body>
</html>

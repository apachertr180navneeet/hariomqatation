<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Invoice | Hari Om Computer</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/print.css">
</head>
<body class="bg-secondary bg-opacity-10 py-4">

  <!-- Control Bar -->
  <div class="container mb-3 no-print" style="max-width: 210mm;">
    <div class="card border-0 shadow-sm p-3 d-flex flex-row justify-content-between align-items-center rounded-3 bg-white">
      <div>
        <span class="badge bg-success px-3 py-2 fs-6">
          <i class="bi bi-receipt me-1"></i> Official GST Tax Invoice
        </span>
      </div>
      <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary fw-bold px-4" onclick="window.print()">
          <i class="bi bi-printer me-1"></i> Print Invoice
        </button>
        <a href="sales.php" class="btn btn-outline-secondary">Back to Sales</a>
      </div>
    </div>
  </div>

  <!-- A4 Invoice Sheet -->
  <div class="print-page-container">
    <div class="quotation-header d-flex justify-content-between align-items-start">
      <div>
        <div class="quotation-logo-text">HARI OM COMPUTER</div>
        <div class="quotation-logo-sub">Your Trusted Computer & Technology Partner</div>
        <div class="small text-muted mt-1" style="font-size: 8.5pt;">
          Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001<br>
          Phone: +91 98290 12345 &bull; GSTIN: <strong>08AABCH1234F1Z9</strong>
        </div>
      </div>
      <div class="text-end">
        <div class="quotation-title-badge bg-success">TAX INVOICE</div>
        <div class="mt-2 text-dark font-monospace fw-bold fs-6" id="inv-no">HOC/INV/2026/0001</div>
      </div>
    </div>

    <div class="row g-2 mb-3">
      <div class="col-6">
        <div class="info-box h-100">
          <div class="info-title">Billed To (Customer Details):</div>
          <strong class="d-block text-dark fs-6" id="inv-cust-name">Customer Name</strong>
          <div id="inv-cust-company" class="fw-semibold text-muted">Company</div>
          <div class="mt-1 text-muted">Jodhpur, Rajasthan</div>
        </div>
      </div>
      <div class="col-6">
        <div class="info-box h-100">
          <div class="info-title">Invoice Details:</div>
          <table class="w-100 small">
            <tr><td class="text-muted">Invoice Date:</td><td class="fw-bold text-dark" id="inv-date">14-Aug-2026</td></tr>
            <tr><td class="text-muted">Payment Status:</td><td class="fw-bold text-success">PAID (Full Settlement)</td></tr>
            <tr><td class="text-muted">Mode of Payment:</td><td class="fw-semibold text-dark" id="inv-mode">Bank Transfer</td></tr>
          </table>
        </div>
      </div>
    </div>

    <!-- Items -->
    <table class="table-print">
      <thead>
        <tr>
          <th class="text-center" style="width: 30px;">#</th>
          <th>Description of Goods</th>
          <th class="text-center" style="width: 50px;">Qty</th>
          <th class="text-end" style="width: 90px;">Rate (₹)</th>
          <th class="text-center" style="width: 55px;">GST %</th>
          <th class="text-end" style="width: 100px;">Amount (₹)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">1</td>
          <td>
            <strong>HP Pavilion 15 / Computer Equipment & Hardware</strong><br>
            <span class="text-muted" style="font-size: 8pt;">HSN: 8471 &bull; 1 Year Comprehensive Onsite Warranty</span>
          </td>
          <td class="text-center fw-bold">1</td>
          <td class="text-end" id="inv-item-rate">₹1,29,644</td>
          <td class="text-center">18%</td>
          <td class="text-end fw-bold" id="inv-item-amount">₹1,52,980</td>
        </tr>
      </tbody>
    </table>

    <div class="row g-2 mb-3">
      <div class="col-6">
        <div class="info-box h-100">
          <div class="info-title">Payment Settlement:</div>
          <div class="text-success fw-bold">✓ Amount Received in Full</div>
          <small class="text-muted">Thank you for your business with Hari Om Computer!</small>
        </div>
      </div>
      <div class="col-6">
        <div class="info-box h-100">
          <table class="w-100" style="font-size: 9pt;">
            <tr><td class="text-muted">Total Taxable Value:</td><td class="text-end fw-semibold text-dark" id="inv-subtotal">₹1,29,644</td></tr>
            <tr><td class="text-muted">Integrated GST (18%):</td><td class="text-end fw-semibold text-dark" id="inv-gst">₹23,336</td></tr>
            <tr style="border-top: 1.5px solid #10b981;">
              <td class="fw-bold fs-6 pt-1">Invoice Total:</td>
              <td class="text-end fw-extrabold fs-6 text-success pt-1" id="inv-grandtotal">₹1,52,980</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="row g-2 align-items-end mt-4">
      <div class="col-7">
        <div class="terms-box">
          <strong>Declaration:</strong>
          <p class="mb-0">We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
        </div>
      </div>
      <div class="col-5 text-end">
        <div class="d-inline-block text-center">
          <div class="signature-line">For <strong>HARI OM COMPUTER</strong><br><span class="text-muted" style="font-size: 7.5pt;">(Authorized Signatory)</span></div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/store-data.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const urlParams = new URLSearchParams(window.location.search);
      const invId = urlParams.get("id") || "HOC/INV/2026/0001";
      const sales = DataStore.get().sales || [];
      const s = sales.find(item => item.invoiceNo === invId) || sales[0];

      if (!s) return;

      document.getElementById("inv-no").innerText = s.invoiceNo;
      document.getElementById("inv-cust-name").innerText = s.customerName;
      document.getElementById("inv-cust-company").innerText = s.company || "Retail";
      document.getElementById("inv-date").innerText = s.date;
      document.getElementById("inv-mode").innerText = s.paymentMethod;

      const base = s.amount / 1.18;
      const gst = s.amount - base;
      document.getElementById("inv-item-rate").innerText = HOC_UTILS.formatINR(base);
      document.getElementById("inv-item-amount").innerText = HOC_UTILS.formatINR(s.amount);
      document.getElementById("inv-subtotal").innerText = HOC_UTILS.formatINR(base);
      document.getElementById("inv-gst").innerText = HOC_UTILS.formatINR(gst);
      document.getElementById("inv-grandtotal").innerText = HOC_UTILS.formatINR(s.amount);
    });
  </script>
</body>
</html>

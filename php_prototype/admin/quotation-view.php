<?php
$pageTitle = "View Quotation | Hari Om Computer ERP";
$currentPage = "quotations";
include 'includes/header.php';
?>

<!-- Page Actions Bar -->
      <div class="page-header">
        <div>
          <div class="d-flex align-items-center gap-2">
            <h1 class="page-title" id="view-quote-id">HOC/QTN/2026/0001</h1>
            <span class="badge" id="view-quote-status-badge">Status</span>
          </div>
          <div class="page-breadcrumb">
            Generated on <span id="view-quote-date">Date</span> &bull; Valid until <span id="view-quote-validity">Date</span>
          </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
          <button type="button" class="btn btn-success fw-bold shadow-sm" id="btn-convert-to-sale">
            <i class="bi bi-receipt-cutoff me-1"></i> Convert to Sales Invoice
          </button>
          <a href="#" target="_blank" class="btn btn-outline-primary fw-bold" id="btn-open-print-preview">
            <i class="bi bi-printer me-1"></i> Print / Generate PDF
          </a>
          <button type="button" class="btn btn-outline-success btn-sm" id="btn-send-quote-wa">
            <i class="bi bi-whatsapp me-1"></i> Send on WhatsApp
          </button>
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
                <h5 class="fw-bold mb-1">HARI OM COMPUTER</h5>
                <p class="text-muted small mb-0">
                  Plot No. 42, Near Sojati Gate, Station Road, Jodhpur<br>
                  GSTIN: <strong>08AABCH1234F1Z9</strong> &bull; Phone: +91 98290 12345
                </p>
              </div>
              <div class="col-sm-6 text-sm-end">
                <div class="fw-bold text-primary text-uppercase small mb-1">Quotation For:</div>
                <h5 class="fw-bold mb-1" id="view-cust-name">Customer Name</h5>
                <p class="text-muted small mb-0">
                  <span id="view-cust-company">Company</span><br>
                  <span id="view-cust-address">Address</span><br>
                  Mobile: <strong id="view-cust-mobile">+91 98290 XXXXX</strong><br>
                  GSTIN: <span id="view-cust-gstin">-</span>
                </p>
              </div>
            </div>

            <!-- Items Table -->
            <div class="table-responsive mb-4">
              <table class="table table-bordered align-middle mb-0">
                <thead class="table-light small">
                  <tr>
                    <th class="text-center" style="width: 40px;">#</th>
                    <th>Product & Description</th>
                    <th class="text-center" style="width: 70px;">Qty</th>
                    <th class="text-end" style="width: 120px;">Rate (₹)</th>
                    <th class="text-end" style="width: 100px;">Disc (₹)</th>
                    <th class="text-center" style="width: 80px;">GST %</th>
                    <th class="text-end" style="width: 130px;">Amount (₹)</th>
                  </tr>
                </thead>
                <tbody id="view-items-tbody">
                  <!-- Populated via JS -->
                </tbody>
              </table>
            </div>

            <!-- Calculation Breakup -->
            <div class="row justify-content-end mb-4">
              <div class="col-md-6">
                <div class="bg-light p-3 rounded border">
                  <div class="d-flex justify-content-between small text-muted mb-2">
                    <span>Taxable Subtotal:</span>
                    <strong id="view-calc-subtotal" class="text-dark">₹0</strong>
                  </div>
                  <div class="d-flex justify-content-between small text-muted mb-2">
                    <span>Discount:</span>
                    <strong id="view-calc-discount" class="text-danger">₹0</strong>
                  </div>
                  <div class="d-flex justify-content-between small text-muted mb-2">
                    <span>GST (18% Total):</span>
                    <strong id="view-calc-gst" class="text-dark">₹0</strong>
                  </div>
                  <div class="d-flex justify-content-between align-items-baseline border-top pt-2 mt-2">
                    <span class="fw-bold">Grand Total (INR):</span>
                    <span class="fs-4 fw-extrabold text-primary" id="view-calc-grandtotal">₹0</span>
                  </div>
                  <div class="mt-2 pt-2 border-top small text-muted">
                    <strong>Amount in Words:</strong><br>
                    <span id="view-amount-words" class="fst-italic text-dark">-</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Terms & Notes -->
            <div class="p-3 bg-light rounded border text-muted small">
              <div class="fw-bold text-dark mb-1">Terms & Conditions:</div>
              <p class="mb-1">1. Quotation is valid for 15 days from issue date.</p>
              <p class="mb-1">2. Standard manufacturer warranty applies on all genuine hardware.</p>
              <p class="mb-0" id="view-quote-notes">Notes: None</p>
            </div>

          </div>
        </div>

        <!-- Right: Status Control & Audit Log -->
        <div class="col-lg-4">
          <div class="admin-card p-4 mb-4">
            <h6 class="fw-bold mb-3 border-bottom pb-2">Status & Sales Management</h6>
            
            <div class="mb-3">
              <label class="form-label small fw-bold">Update Quotation Status</label>
              <select id="view-change-status-select" class="form-select">
                <option value="Draft">Draft</option>
                <option value="Sent">Sent to Customer</option>
                <option value="Pending">Pending Customer Decision</option>
                <option value="Approved">Approved (Ready to Convert)</option>
                <option value="Rejected">Rejected</option>
                <option value="Expired">Expired</option>
              </select>
            </div>

            <div class="d-grid gap-2 mb-3">
              <button class="btn btn-primary fw-bold" id="btn-save-status-change">
                <i class="bi bi-check2-circle me-1"></i> Update Status
              </button>
            </div>

            <div class="p-3 bg-light rounded border small">
              <strong><i class="bi bi-info-circle text-primary me-1"></i> Commercial Tip:</strong>
              <p class="text-muted mb-0 mt-1">Once the customer accepts the pricing, click <strong>"Convert to Sales Invoice"</strong>. This will automatically decrement physical inventory and log a paid invoice entry.</p>
            </div>
          </div>
        </div>

      </div>

<?php
ob_start();
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
      const urlParams = new URLSearchParams(window.location.search);
      const quoteId = urlParams.get("id") || "HOC/QTN/2026/0001";
      const q = DataStore.getQuotationById(quoteId) || DataStore.getQuotations()[0];

      if (!q) return;

      document.getElementById("view-quote-id").innerText = q.id;
      document.getElementById("header-quote-no").innerText = `Quotation: ${q.id}`;
      document.getElementById("view-quote-date").innerText = q.date;
      document.getElementById("view-quote-validity").innerText = q.validUntil;
      document.getElementById("view-cust-name").innerText = q.customerName;
      document.getElementById("view-cust-company").innerText = q.company || "Retail Buyer";
      document.getElementById("view-cust-address").innerText = q.address || "Jodhpur, Rajasthan";
      document.getElementById("view-cust-mobile").innerText = q.mobile;
      document.getElementById("view-cust-gstin").innerText = q.gstin || "Unregistered / Consumer";
      document.getElementById("view-quote-notes").innerText = `Notes: ${q.notes || 'Standard terms apply.'}`;

      const badge = document.getElementById("view-quote-status-badge");
      badge.innerText = q.status;
      badge.className = `badge ${q.status === 'Approved' ? 'bg-success' : q.status === 'Sent' ? 'bg-primary' : 'bg-warning text-dark'}`;

      document.getElementById("view-change-status-select").value = q.status;

      // Render items
      let html = "";
      (q.items || []).forEach((item, idx) => {
        html += `
          <tr>
            <td class="text-center">${idx + 1}</td>
            <td>
              <strong>${item.name}</strong><br>
              <small class="text-muted">SKU: ${item.sku}</small>
            </td>
            <td class="text-center">${item.qty}</td>
            <td class="text-end">${HOC_UTILS.formatINR(item.rate)}</td>
            <td class="text-end text-danger">${HOC_UTILS.formatINR(item.discount || 0)}</td>
            <td class="text-center">${item.gstRate || 18}%</td>
            <td class="text-end fw-bold">${HOC_UTILS.formatINR(item.amount)}</td>
          </tr>
        `;
      });
      document.getElementById("view-items-tbody").innerHTML = html;

      // Render totals
      document.getElementById("view-calc-subtotal").innerText = HOC_UTILS.formatINR(q.subtotal);
      document.getElementById("view-calc-discount").innerText = HOC_UTILS.formatINR(q.discountTotal);
      document.getElementById("view-calc-gst").innerText = HOC_UTILS.formatINR(q.gstTotal);
      document.getElementById("view-calc-grandtotal").innerText = HOC_UTILS.formatINR(q.grandTotal);
      document.getElementById("view-amount-words").innerText = HOC_UTILS.numberToWordsINR(q.grandTotal);

      // Print Preview Link
      document.getElementById("btn-open-print-preview").href = `quotation-print.php?id=${encodeURIComponent(q.id)}`;

      // Save Status button
      document.getElementById("btn-save-status-change").onclick = () => {
        const newStatus = document.getElementById("view-change-status-select").value;
        q.status = newStatus;
        DataStore.saveQuotation(q);
        HOC_UTILS.showToast(`Quotation ${q.id} updated to ${newStatus}`);
        setTimeout(() => window.location.reload(), 500);
      };

      // Convert to Sale action
      document.getElementById("btn-convert-to-sale").onclick = () => {
        if (confirm(`Convert Quotation ${q.id} to Sales Invoice? Stock will be decremented.`)) {
          const sale = DataStore.convertQuotationToSale(q.id, "Bank Transfer");
          if (sale) {
            HOC_UTILS.showToast(`Invoice ${sale.invoiceNo} successfully created!`);
            setTimeout(() => window.location.href = "sales.php", 700);
          }
        }
      };

      // WhatsApp share
      document.getElementById("btn-send-quote-wa").onclick = () => {
        const waMsg = `*HARI OM COMPUTER - QUOTATION*\nQuotation No: *${q.id}*\nCustomer: ${q.customerName}\nGrand Total: *${HOC_UTILS.formatINR(q.grandTotal)}*\nValid Until: ${q.validUntil}\n\nPlease check the attached quotation sheet. Thank you!`;
        window.open(`https://wa.me/?text=${encodeURIComponent(waMsg)}`, "_blank");
      };
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

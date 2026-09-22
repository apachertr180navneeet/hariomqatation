<?php
$pageTitle = "Create New Quotation | Hari Om Computer ERP";
$currentPage = "quotation-create";
include 'includes/header.php';
?>

<!-- Page Header -->
      <div class="page-header">
        <div>
          <h1 class="page-title">Generate Business Quotation</h1>
          <div class="page-breadcrumb">
            <a href="quotations.php">Quotations</a> &bull; <span>New Commercial Quotation</span>
          </div>
        </div>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-primary fw-bold shadow-sm" id="btn-save-quotation">
            <i class="bi bi-save me-1"></i> Save & Generate Quotation
          </button>
        </div>
      </div>

      <form id="quotation-create-form">
        <div class="row g-4">
          
          <!-- Customer & Quotation Meta Details Card -->
          <div class="col-12">
            <div class="admin-card">
              <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-person-lines-fill text-primary me-2"></i> Customer & Quotation Details</h5>
                <div style="max-width: 320px; width: 100%;">
                  <select id="quote-customer-picker" class="form-select form-select-sm">
                    <!-- Populated via quotation.js -->
                  </select>
                </div>
              </div>

              <div class="p-4">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label small fw-bold">Customer Full Name *</label>
                    <input type="text" id="cust-name" class="form-control" required placeholder="e.g. Vikram Rathore">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold">Company / Firm Name</label>
                    <input type="text" id="cust-company" class="form-control" placeholder="e.g. Rathore Infotech Pvt Ltd">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold">Mobile Number *</label>
                    <input type="tel" id="cust-mobile" class="form-control" required placeholder="e.g. +91 98290 12345">
                  </div>

                  <div class="col-md-4">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" id="cust-email" class="form-control" placeholder="e.g. vikram@example.com">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold">GSTIN (For 18% ITC)</label>
                    <input type="text" id="cust-gstin" class="form-control" placeholder="e.g. 08AABCR1234F1Z3">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small fw-bold">Billing / Delivery Address</label>
                    <input type="text" id="cust-address" class="form-control" placeholder="e.g. 14, Industrial Area, Jodhpur">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label small fw-bold">Quotation Number</label>
                    <input type="text" id="quote-number" class="form-control bg-light" readonly>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small fw-bold">Quotation Date</label>
                    <input type="date" id="quote-date" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small fw-bold">Valid Until Date</label>
                    <input type="date" id="quote-validity" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small fw-bold">Initial Status</label>
                    <select id="quote-status" class="form-select">
                      <option value="Draft">Draft</option>
                      <option value="Sent">Sent</option>
                      <option value="Pending">Pending</option>
                      <option value="Approved">Approved</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product Line Items Card -->
          <div class="col-12">
            <div class="admin-card">
              <div class="admin-card-header bg-light">
                <h5 class="admin-card-title"><i class="bi bi-box-seam text-primary me-2"></i> Product Line Items & Taxes</h5>
                <span class="badge bg-primary">Auto-Calculates Subtotal + GST + Discounts</span>
              </div>

              <!-- Quick Add Bar -->
              <div class="p-3 border-bottom bg-white">
                <div class="row g-2 align-items-center">
                  <div class="col-md-7">
                    <select id="quote-product-picker" class="form-select">
                      <!-- Populated via quotation.js -->
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
                      <th class="text-center" style="width: 100px;">Qty</th>
                      <th class="text-end" style="width: 140px;">Base Rate (Excl GST)</th>
                      <th class="text-end" style="width: 120px;">Discount (₹)</th>
                      <th class="text-center" style="width: 90px;">GST %</th>
                      <th class="text-end" style="width: 140px;">Total (₹)</th>
                      <th class="text-center" style="width: 60px;">Action</th>
                    </tr>
                  </thead>
                  <tbody id="quote-items-tbody">
                    <!-- Populated dynamically by quotation.js -->
                  </tbody>
                </table>
              </div>

              <!-- Summary & Totals Calculation Box -->
              <div class="p-4 bg-light border-top">
                <div class="row justify-content-end">
                  <div class="col-md-6 col-lg-5">
                    <div class="bg-white p-3 rounded border shadow-sm">
                      <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>Taxable Subtotal:</span>
                        <strong id="quote-subtotal" class="text-dark">₹0</strong>
                      </div>
                      <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>Total Discounts Applied:</span>
                        <strong id="quote-discount-total" class="text-danger">₹0</strong>
                      </div>
                      <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>Total GST (18% SGST + CGST):</span>
                        <strong id="quote-gst-total" class="text-dark">₹0</strong>
                      </div>
                      <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>Round Off:</span>
                        <span id="quote-roundoff">₹0</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-baseline border-top pt-2 mt-2">
                        <span class="fw-bold fs-6">Grand Total:</span>
                        <span class="fs-4 fw-extrabold text-primary" id="quote-grand-total">₹0</span>
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
                    <label class="form-label small fw-bold">Internal Notes / Customer Requirements</label>
                    <textarea id="quote-notes" class="form-control" rows="3" placeholder="e.g. Free onsite installation agreed, payment against delivery."></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small fw-bold">Standard Terms & Conditions</label>
                    <div class="p-2 bg-light rounded small text-muted border" style="max-height: 85px; overflow-y: auto;">
                      1. Quotation validity: 15 days from issue date.<br>
                      2. Prices include 18% GST under HSN codes.<br>
                      3. Standard brand warranty applies directly from authorized service centers.<br>
                      4. Goods once sold will not be returned.
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </form>

<?php
ob_start();
?>
<script src="../assets/js/quotation.js"></script>
  
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // Set default dates & Quotation Number
      document.getElementById("quote-number").value = DataStore.generateQuotationNumber();
      document.getElementById("quote-date").value = new Date().toISOString().split("T")[0];
      document.getElementById("quote-validity").value = new Date(Date.now() + 15 * 86400000).toISOString().split("T")[0];

      QuotationEngine.initCreatePage();
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

<?php
$pageTitle = "Purchase Orders | Hari Om Computer ERP";
$currentPage = "purchases";
include 'includes/header.php';
?>

<div class="page-header">
        <div>
          <h1 class="page-title">Purchase Invoices</h1>
          <div class="page-breadcrumb"><a href="dashboard.php">Dashboard</a> &bull; <span>Distributor Inwards</span></div>
        </div>
      </div>

      <div class="admin-card">
        <div class="table-responsive">
          <table class="table table-hoc align-middle mb-0">
            <thead>
              <tr>
                <th>Purchase ID</th>
                <th>Supplier Distributor</th>
                <th>Supplier Invoice No</th>
                <th>Date</th>
                <th>Products Inward</th>
                <th>Qty</th>
                <th>GST (₹)</th>
                <th>Total (₹)</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="purchases-table-body">
              <!-- Populated via JS -->
            </tbody>
          </table>
        </div>
      </div>

<?php
ob_start();
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
      const tbody = document.getElementById("purchases-table-body");
      const purchases = DataStore.get().purchases || [];

      let html = "";
      purchases.forEach(p => {
        html += `
          <tr>
            <td class="fw-bold text-primary">${p.id}</td>
            <td><strong>${p.supplier}</strong></td>
            <td><span class="badge bg-light text-dark border">${p.invoiceNo}</span></td>
            <td>${p.date}</td>
            <td>${p.product}</td>
            <td class="text-center fw-bold">${p.qty}</td>
            <td>${HOC_UTILS.formatINR(p.gst)}</td>
            <td class="fw-bold text-dark">${HOC_UTILS.formatINR(p.total)}</td>
            <td><span class="badge badge-soft-success">${p.status}</span></td>
          </tr>
        `;
      });
      tbody.innerHTML = html;
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

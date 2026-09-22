<?php
$pageTitle = "Quotations Directory | Hari Om Computer ERP";
$currentPage = "quotations";
include 'includes/header.php';
?>

<!-- Page Header -->
      <div class="page-header">
        <div>
          <h1 class="page-title">Quotations Directory</h1>
          <div class="page-breadcrumb">
            <a href="dashboard.php">Dashboard</a> &bull; <span>All Price Quotations (HOC/QTN/2026/XXXX)</span>
          </div>
        </div>
        <div class="d-flex gap-2">
          <a href="quotation-create.php" class="btn btn-primary fw-bold shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> New Quotation
          </a>
        </div>
      </div>

      <!-- Filters & Search Bar -->
      <div class="admin-card mb-4">
        <div class="p-3">
          <div class="row g-3 align-items-center">
            <div class="col-md-5">
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                <input type="text" id="search-quote-input" class="form-control" placeholder="Search by Quotation No, Customer, Company, Phone...">
              </div>
            </div>
            <div class="col-md-3">
              <select id="filter-quote-status" class="form-select form-select-sm">
                <option value="ALL">All Statuses (Draft, Sent, Pending, Approved)</option>
                <option value="Draft">Draft</option>
                <option value="Sent">Sent</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Expired">Expired</option>
              </select>
            </div>
            <div class="col-md-4 text-md-end">
              <span class="badge bg-light text-dark border p-2 small">
                <i class="bi bi-info-circle text-primary me-1"></i> Workflow: Pending $\rightarrow$ Approved $\rightarrow$ Convert to Sale
              </span>
            </div>
          </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-hoc align-middle">
            <thead>
              <tr>
                <th>Quotation No</th>
                <th>Customer & Firm</th>
                <th>Issue Date</th>
                <th>Valid Until</th>
                <th class="text-center">Items</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody id="quotations-table-body">
              <!-- Populated by admin.js loadQuotationsPage() -->
            </tbody>
          </table>
        </div>
      </div>

<?php
ob_start();
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
      AdminApp.loadQuotationsPage();
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

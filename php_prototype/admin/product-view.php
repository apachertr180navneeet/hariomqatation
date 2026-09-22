<?php
$pageTitle = "Product Details | Hari Om Computer ERP";
$currentPage = "products";
include 'includes/header.php';
?>

<div class="page-header">
        <div>
          <h1 class="page-title" id="view-prod-title">Product Name</h1>
          <div class="page-breadcrumb">SKU: <strong id="view-prod-sku">SKU</strong> &bull; Brand: <strong id="view-prod-brand">Brand</strong></div>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-primary" onclick="alert('Product update saved successfully!')"><i class="bi bi-pencil me-1"></i> Edit Details</button>
          <a href="../shop/product-details.php?id=PROD-1001" target="_blank" id="btn-view-in-store" class="btn btn-outline-secondary"><i class="bi bi-box-arrow-up-right me-1"></i> View in Store</a>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-8">
          <div class="admin-card p-4 mb-4">
            <h5 class="admin-card-title mb-3">Product Specifications</h5>
            <p class="text-muted" id="view-prod-specs">Specifications</p>
            
            <table class="table table-bordered small">
              <tbody>
                <tr><th class="bg-light" style="width: 30%;">Category</th><td id="view-prod-cat">-</td></tr>
                <tr><th class="bg-light">Sub Category</th><td id="view-prod-subcat">-</td></tr>
                <tr><th class="bg-light">Warranty</th><td id="view-prod-warranty">-</td></tr>
                <tr><th class="bg-light">Status</th><td id="view-prod-status">-</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="admin-card p-4 mb-4">
            <h5 class="admin-card-title mb-3">Stock & Pricing Matrix</h5>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted small">Purchase Price:</span>
              <strong class="text-dark" id="view-prod-purchase">₹0</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-muted small">Selling Price (GST Incl):</span>
              <strong class="text-primary fs-5" id="view-prod-selling">₹0</strong>
            </div>
            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
              <span class="text-muted small">MRP:</span>
              <span class="text-decoration-line-through text-muted" id="view-prod-mrp">₹0</span>
            </div>

            <div class="p-3 bg-light rounded text-center mb-3">
              <div class="text-muted small">Current Physical Stock</div>
              <div class="display-6 fw-bold text-success" id="view-prod-stock">0</div>
              <small class="text-muted">Min Reorder Alert: <span id="view-prod-minstock">0</span> units</small>
            </div>

            <div class="d-grid gap-2">
              <a href="inventory.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-slash-minus me-1"></i> Adjust Stock</a>
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
      const id = urlParams.get("id") || "PROD-1002";
      const p = DataStore.getProductById(id) || DataStore.getProducts()[0];

      if (!p) return;

      document.getElementById("view-prod-title").innerText = p.name;
      document.getElementById("header-prod-name").innerText = p.name;
      document.getElementById("view-prod-sku").innerText = p.sku;
      document.getElementById("view-prod-brand").innerText = p.brand;
      document.getElementById("view-prod-specs").innerText = p.specs;
      document.getElementById("view-prod-cat").innerText = p.category;
      document.getElementById("view-prod-subcat").innerText = p.subcategory || p.category;
      document.getElementById("view-prod-warranty").innerText = p.warranty || "1 Year";
      document.getElementById("view-prod-status").innerText = p.status;

      document.getElementById("view-prod-purchase").innerText = HOC_UTILS.formatINR(p.purchasePrice);
      document.getElementById("view-prod-selling").innerText = HOC_UTILS.formatINR(p.sellingPrice);
      document.getElementById("view-prod-mrp").innerText = p.mrp ? HOC_UTILS.formatINR(p.mrp) : '-';
      document.getElementById("view-prod-stock").innerText = `${p.stock} Units`;
      document.getElementById("view-prod-minstock").innerText = p.minStock;

      document.getElementById("btn-view-in-store").href = `../shop/product-details.php?id=${p.id}`;
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

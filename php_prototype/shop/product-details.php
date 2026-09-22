<?php
$pageTitle = "Product Details | Hari Om Computer";
$currentPage = "products";
include 'includes/header.php';
?>

<!-- Product Details Breadcrumb -->
  <div class="bg-white border-bottom py-3">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small" id="prod-breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="products.php">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page" id="prod-crumb-name">Product Name</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Product Details Content -->
  <main class="container my-5" id="product-detail-container">
    <div class="row g-5">
      
      <!-- Product Gallery Side -->
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-4 rounded-4 text-center bg-white">
          <div class="d-flex align-items-center justify-content-center bg-light rounded-3 p-4 mb-3" style="min-height: 320px;">
            <i id="prod-main-icon" class="bi bi-laptop text-secondary" style="font-size: 8rem;"></i>
          </div>
          <div class="row g-2 justify-content-center">
            <div class="col-3">
              <div class="border rounded p-2 bg-light text-center cursor-pointer border-primary">
                <i class="bi bi-image text-muted fs-4"></i>
              </div>
            </div>
            <div class="col-3">
              <div class="border rounded p-2 bg-light text-center cursor-pointer">
                <i class="bi bi-cpu text-muted fs-4"></i>
              </div>
            </div>
            <div class="col-3">
              <div class="border rounded p-2 bg-light text-center cursor-pointer">
                <i class="bi bi-hdd-network text-muted fs-4"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Trust Badges -->
        <div class="card border-0 shadow-sm p-3 mt-4 rounded-3 bg-white">
          <div class="d-flex align-items-center gap-3 mb-2">
            <i class="bi bi-patch-check-fill text-success fs-3"></i>
            <div>
              <div class="fw-bold small">100% Genuine Retail Product</div>
              <small class="text-muted">Direct authorized distribution & brand warranty</small>
            </div>
          </div>
          <div class="d-flex align-items-center gap-3">
            <i class="bi bi-receipt text-primary fs-3"></i>
            <div>
              <div class="fw-bold small">Official GST Input Tax Credit</div>
              <small class="text-muted">18% GST Invoice available for firms and corporates</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Info Side -->
      <div class="col-lg-7">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge bg-primary px-3 py-1" id="prod-brand">Brand</span>
          <span class="badge bg-light text-dark border px-3 py-1" id="prod-category">Category</span>
          <span class="stock-pill stock-in ms-auto" id="prod-stock-status"><i class="bi bi-check-circle-fill"></i> In Stock</span>
        </div>

        <h2 class="fw-bold text-slate-900 mb-2" id="prod-name">Product Name</h2>
        <div class="small text-muted mb-3">Model / SKU: <strong id="prod-sku">SKU</strong> &bull; Rating: ⭐ 4.8 / 5.0</div>

        <div class="p-3 bg-light rounded-3 mb-4 d-flex align-items-baseline gap-3">
          <div class="display-6 fw-extrabold text-primary" id="prod-selling-price">₹0</div>
          <div class="fs-5 text-muted text-decoration-line-through" id="prod-mrp-price">₹0</div>
          <div class="badge bg-danger ms-auto" id="prod-discount-badge">15% OFF</div>
        </div>

        <div class="mb-4">
          <h6 class="fw-bold mb-2">Key Specifications:</h6>
          <p class="text-muted" id="prod-specs-text">Full specification summary details.</p>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-sm-6">
            <div class="border rounded p-3 bg-white">
              <div class="text-muted small">Manufacturer Warranty</div>
              <div class="fw-bold" id="prod-warranty">1 Year Brand Warranty</div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="border rounded p-3 bg-white">
              <div class="text-muted small">Showroom Availability</div>
              <div class="fw-bold text-success">Ready for Instant Pickup (Jodhpur)</div>
            </div>
          </div>
        </div>

        <!-- Action CTAs -->
        <div class="d-flex flex-wrap gap-3 mb-4">
          <button class="btn btn-primary btn-lg px-4 py-2 fw-bold" id="btn-details-add-enquiry">
            <i class="bi bi-cart-plus me-2"></i> Add to Enquiry Cart
          </button>
          <button class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold" id="btn-details-get-quote">
            <i class="bi bi-file-earmark-text me-2"></i> Request Official Quote
          </button>
          <a href="#" target="_blank" class="btn btn-success btn-lg px-4 py-2 fw-bold" id="btn-details-whatsapp">
            <i class="bi bi-whatsapp me-2"></i> Inquire on WhatsApp
          </a>
        </div>

        <!-- Detailed Specifications Table -->
        <div class="card border-0 shadow-sm rounded-3">
          <div class="card-header bg-white py-3">
            <h6 class="fw-bold mb-0">Hardware Breakdown & Technical Details</h6>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered mb-0 small">
              <tbody id="prod-tech-specs-table">
                <tr><th class="bg-light" style="width: 35%;">Category</th><td id="spec-cat-val">-</td></tr>
                <tr><th class="bg-light">Brand & Model</th><td id="spec-brand-val">-</td></tr>
                <tr><th class="bg-light">Primary Specs</th><td id="spec-specs-val">-</td></tr>
                <tr><th class="bg-light">Warranty Type</th><td id="spec-warranty-val">-</td></tr>
                <tr><th class="bg-light">Tax Details</th><td>18% GST Included (Input Credit Eligible)</td></tr>
                <tr><th class="bg-light">Store Location</th><td>Hari Om Computer, Near Sojati Gate, Jodhpur</td></tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>
  </main>

<?php
ob_start();
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
      const urlParams = new URLSearchParams(window.location.search);
      const prodId = urlParams.get("id") || "PROD-1002";
      const p = DataStore.getProductById(prodId) || DataStore.getProducts()[0];

      if (!p) return;

      document.title = `${p.name} | Hari Om Computer`;
      document.getElementById("prod-crumb-name").innerText = p.name;
      document.getElementById("prod-name").innerText = p.name;
      document.getElementById("prod-brand").innerText = p.brand;
      document.getElementById("prod-category").innerText = p.category;
      document.getElementById("prod-sku").innerText = p.sku;
      document.getElementById("prod-selling-price").innerText = HOC_UTILS.formatINR(p.sellingPrice);
      document.getElementById("prod-mrp-price").innerText = p.mrp ? HOC_UTILS.formatINR(p.mrp) : '';
      document.getElementById("prod-specs-text").innerText = p.specs;
      document.getElementById("prod-warranty").innerText = p.warranty || "1 Year Onsite Brand Warranty";

      // Tech specs table
      document.getElementById("spec-cat-val").innerText = `${p.category} (${p.subcategory || ''})`;
      document.getElementById("spec-brand-val").innerText = `${p.brand} - ${p.model || p.name}`;
      document.getElementById("spec-specs-val").innerText = p.specs;
      document.getElementById("spec-warranty-val").innerText = p.warranty || "1 Year";

      // Discount badge
      if (p.mrp && p.mrp > p.sellingPrice) {
        const pct = Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100);
        document.getElementById("prod-discount-badge").innerText = `${pct}% OFF`;
      } else {
        document.getElementById("prod-discount-badge").style.display = "none";
      }

      // Icon
      const mainIcon = document.getElementById("prod-main-icon");
      if (p.category === 'Laptops') mainIcon.className = "bi bi-laptop text-secondary";
      else if (p.category === 'Desktop Computers') mainIcon.className = "bi bi-pc-display text-primary";
      else if (p.category === 'Display & Monitors') mainIcon.className = "bi bi-display text-secondary";
      else mainIcon.className = "bi bi-cpu text-primary";

      // Buttons
      document.getElementById("btn-details-add-enquiry").onclick = () => {
        DataStore.addToEnquiryCart(p.id, 1);
        HOC_UTILS.showToast(`${p.name} added to your Enquiry Cart!`);
      };

      document.getElementById("btn-details-get-quote").onclick = () => {
        DataStore.addToEnquiryCart(p.id, 1);
        window.location.href = "enquiry.php";
      };

      const waMsg = `Hello Hari Om Computer, I would like to enquire about the price and availability of: *${p.name}* (SKU: ${p.sku}) listed at ${HOC_UTILS.formatINR(p.sellingPrice)}.`;
      document.getElementById("btn-details-whatsapp").href = `https://wa.me/919829012345?text=${encodeURIComponent(waMsg)}`;
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

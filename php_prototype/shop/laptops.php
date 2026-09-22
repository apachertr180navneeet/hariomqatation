<?php
$pageTitle = "Brand New Laptops | Hari Om Computer (Jodhpur)";
$currentPage = "laptops";
include 'includes/header.php';
?>

<!-- Laptop Showcase Hero Banner -->
  <div class="bg-dark text-white py-5" style="background: linear-gradient(135deg, #0b1329 0%, #1e293b 100%);">
    <div class="container">
      <div class="row align-items-center gy-3">
        <div class="col-lg-8">
          <span class="badge bg-primary px-3 py-1 mb-2">OFFICIAL LAPTOP SHOWROOM</span>
          <h2 class="fw-bold display-6 mb-2">Brand New Genuine Laptops in Jodhpur</h2>
          <p class="text-light text-opacity-75 lead mb-0">Authorized Dell, HP, Lenovo, ASUS & Acer laptops with genuine manufacturer onsite warranty and 18% GST invoice.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a href="enquiry.php" class="btn btn-primary btn-lg fw-bold"><i class="bi bi-file-earmark-text me-1"></i> Get Bulk Quote</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Laptops Grid -->
  <main class="container my-5">
    <div class="row g-4" id="laptops-grid">
      <!-- Populated dynamically via JS -->
    </div>
  </main>

<?php
ob_start();
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
      const grid = document.getElementById("laptops-grid");
      const laptops = DataStore.getProducts().filter(p => p.category === "Laptops");

      let html = "";
      laptops.forEach(p => {
        const discountPct = p.mrp ? Math.round(((p.mrp - p.sellingPrice) / p.mrp) * 100) : 0;
        const specParts = (p.specs || "").split("|").map(s => s.trim()).filter(s => s.length > 0).slice(0, 3);
        const pillsHtml = specParts.map(s => `<span class="spec-micro-pill">${s}</span>`).join("");

        html += `
          <div class="col-md-6 col-lg-4">
            <div class="product-card-v3">
              <div class="product-visual-art art-laptop">
                ${discountPct > 0 ? `<span class="product-badge-discount">${discountPct}% OFF</span>` : ''}
                <span class="product-badge-brand">${p.brand}</span>
                <i class="bi bi-laptop product-art-icon"></i>
              </div>
              <div class="product-body-v3">
                <div class="product-category-sub">${p.subcategory || 'Laptop'}</div>
                <a href="product-details.php?id=${p.id}" class="product-title">${p.name}</a>
                
                <div class="product-specs-pill-row">
                  ${pillsHtml}
                </div>

                <div class="product-pricing">
                  <div class="d-flex align-items-baseline justify-content-between mb-3">
                    <div>
                      <span class="price-current">${HOC_UTILS.formatINR(p.sellingPrice)}</span>
                      ${p.mrp ? `<span class="price-mrp">${HOC_UTILS.formatINR(p.mrp)}</span>` : ''}
                    </div>
                    <span class="stock-pill stock-in"><span class="pulse-dot me-1"></span> In Stock (${p.stock})</span>
                  </div>
                  <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-sm btn-add-enquiry" data-id="${p.id}">
                      <i class="bi bi-cart-plus me-1"></i> Add to Enquiry
                    </button>
                    <a href="product-details.php?id=${p.id}" class="btn btn-outline-secondary btn-sm">View Full Specs</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        `;
      });
      grid.innerHTML = html;
    });
  </script>
<?php
$pageScripts = ob_get_clean();
include 'includes/footer.php';
?>

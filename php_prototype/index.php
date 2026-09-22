<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hari Om Computer | Prototype Gateway & Navigation Hub</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/store.css">
  <style>
    .portal-hero {
      background: radial-gradient(circle at top right, #1e293b 0%, #0f172a 45%, #070c14 100%);
      color: white;
      padding: 85px 0 65px;
      position: relative;
      overflow: hidden;
    }
    .portal-hero::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(6, 182, 212, 0.18) 0%, transparent 70%);
      top: -100px;
      right: -100px;
      border-radius: 50%;
      pointer-events: none;
      filter: blur(40px);
    }
    .launcher-card {
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 32px;
      height: 100%;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }
    .launcher-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 35px -8px rgba(2, 132, 199, 0.15);
      border-color: #0284c7;
    }
    .icon-square {
      width: 60px;
      height: 60px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.85rem;
      margin-bottom: 22px;
    }
  </style>
</head>
<body>

  <!-- Top Announcement -->
  <div class="top-bar text-center">
    <div class="container">
      <span>🚀 <strong>HARI OM COMPUTER</strong> &bull; Complete Commercial Prototype (Shop + Custom PC Builder + Admin ERP + GST Invoicing + A4 PDF Generator)</span>
    </div>
  </div>

  <!-- Gateway Hero -->
  <header class="portal-hero text-center">
    <div class="container position-relative">
      <div class="d-inline-flex align-items-center gap-2 px-3 py-1 bg-white bg-opacity-10 border border-white border-opacity-10 rounded-pill text-cyan mb-3 small fw-bold">
        <i class="bi bi-cpu-fill text-info"></i> Western Rajasthan's Premier Computer & Hardware Showroom (Jodhpur)
      </div>
      <h1 class="display-4 fw-extrabold mb-3">HARI OM COMPUTER</h1>
      <p class="lead text-light text-opacity-75 mx-auto mb-4" style="max-width: 680px;">
        "Your Trusted Computer & Technology Partner" — Commercial Web & ERP prototype with live component compatibility checking, real-time GST pricing, and print-ready quotations.
      </p>
      <div class="d-flex justify-content-center flex-wrap gap-3">
        <a href="shop/index.php" class="btn btn-primary btn-lg px-4 py-3 fw-bold shadow-lg">
          <i class="bi bi-shop me-2"></i> Launch Storefront
        </a>
        <a href="admin/login.php" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">
          <i class="bi bi-shield-lock me-2"></i> Admin ERP Suite
        </a>
      </div>
    </div>
  </header>

  <!-- Prototype Explorer Sections -->
  <main class="container my-5">
    <div class="row g-4 mb-5">
      
      <!-- Frontend Portal Card -->
      <div class="col-lg-6">
        <div class="launcher-card">
          <div class="icon-square bg-primary-subtle text-primary">
            <i class="bi bi-cart4"></i>
          </div>
          <h3 class="fw-bold mb-2">1. Customer Store Experience</h3>
          <p class="text-muted mb-4">
            Browse genuine hardware catalog, configure custom rigs with real-time socket validation, and request instant GST quotations.
          </p>
          
          <div class="list-group list-group-flush mb-4">
            <a href="shop/index.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-house text-primary me-2"></i> Store Homepage</span>
              <i class="bi bi-chevron-right text-muted"></i>
            </a>
            <a href="shop/pc-builder.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-motherboard text-primary me-2"></i> Interactive Custom PC Builder</span>
              <span class="badge bg-success-subtle text-success">Live Engine</span>
            </a>
            <a href="shop/products.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-laptop text-primary me-2"></i> Products & Hardware Catalog</span>
              <i class="bi bi-chevron-right text-muted"></i>
            </a>
            <a href="shop/product-details.php?id=PROD-1002" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-file-earmark-richtext text-primary me-2"></i> Product Detail View</span>
              <i class="bi bi-chevron-right text-muted"></i>
            </a>
            <a href="shop/enquiry.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-chat-quote text-primary me-2"></i> Enquiry Cart & Quotation Request</span>
              <span class="badge bg-info-subtle text-info">WhatsApp / Web</span>
            </a>
          </div>
          
          <div class="mt-auto">
            <a href="shop/index.php" class="btn btn-outline-primary w-100 fw-bold py-2">
              Visit Storefront <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Admin Portal Card -->
      <div class="col-lg-6">
        <div class="launcher-card">
          <div class="icon-square bg-dark text-white">
            <i class="bi bi-speedometer2"></i>
          </div>
          <h3 class="fw-bold mb-2">2. Admin ERP & Quotation Suite</h3>
          <p class="text-muted mb-4">
            Complete business operations, instant quotation generator with dynamic GST and discount calculators, 1-click conversion to sales invoice, and stock tracking.
          </p>

          <div class="list-group list-group-flush mb-4">
            <a href="admin/dashboard.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-grid text-dark me-2"></i> Admin KPI Dashboard & Charts</span>
              <span class="badge bg-primary">Metrics</span>
            </a>
            <a href="admin/quotations.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-file-earmark-text text-dark me-2"></i> Quotation Management (Status Tracking)</span>
              <span class="badge bg-warning-subtle text-warning-emphasis">HOC/QTN/2026</span>
            </a>
            <a href="admin/quotation-create.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-plus-circle text-dark me-2"></i> Create Dynamic Quotation</span>
              <span class="badge bg-success-subtle text-success">Live Rates & GST</span>
            </a>
            <a href="admin/quotation-print.php?id=HOC/QTN/2026/0001" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-printer text-dark me-2"></i> Professional A4 Quotation Print / PDF</span>
              <span class="badge bg-danger-subtle text-danger">Print Ready</span>
            </a>
            <a href="admin/sales.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-receipt text-dark me-2"></i> Sales Invoices & POS Conversions</span>
              <i class="bi bi-chevron-right text-muted"></i>
            </a>
            <a href="admin/inventory.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-0">
              <span><i class="bi bi-boxes text-dark me-2"></i> Inventory & Stock Alerts</span>
              <i class="bi bi-chevron-right text-muted"></i>
            </a>
          </div>

          <div class="mt-auto">
            <a href="admin/dashboard.php" class="btn btn-dark w-100 fw-bold py-2">
              Enter Admin Portal <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- Commercial Flow Walkthrough Banner -->
    <div class="card border-0 bg-light p-4 rounded-4 shadow-sm">
      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
          <h5 class="fw-bold mb-1"><i class="bi bi-arrow-repeat text-primary me-2"></i>Complete End-to-End Business Flow Simulated</h5>
          <p class="text-muted mb-0 small">Customer Submits Enquiry / PC Build $\rightarrow$ Admin Creates Quotation $\rightarrow$ Applies GST & Discounts $\rightarrow$ Generates PDF $\rightarrow$ Customer Approves $\rightarrow$ Converted to Sale $\rightarrow$ Inventory Auto-Updated.</p>
        </div>
        <div>
          <span class="badge bg-dark px-3 py-2">Demo Login: admin@hariomcomputer.com / password</span>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer-hoc mt-auto">
    <div class="container text-center text-light text-opacity-75 small">
      <p class="mb-1"><strong>Hari Om Computer</strong> &bull; Plot No. 42, Station Road, Near Sojati Gate, Jodhpur, Rajasthan</p>
      <p class="mb-0">&copy; 2026 Hari Om Computer. All rights reserved. Commercial Prototype.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/store-data.js"></script>
</body>
</html>

<?php
if (!isset($pageTitle)) {
    $pageTitle = "Hari Om Computer | Your Trusted Computer & Technology Partner (Jodhpur)";
}
if (!isset($currentPage)) {
    $currentPage = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/store.css">
  <?php if (!empty($extraCss)) echo $extraCss; ?>
</head>
<body>

  <?php if (!empty($showPromoStrip)): ?>
  <!-- Top Flash Promo Strip -->
  <div class="promo-strip-top">
    <div class="container d-flex justify-content-center align-items-center flex-wrap gap-2">
      <span><span class="promo-badge-flash">SHOWROOM SPECIAL</span> ⚡ Get FREE RGB Gaming Keyboard & Mouse Combo on all Custom PC Builds above ₹50,000 this week!</span>
    </div>
  </div>
  <?php endif; ?>

  <!-- Top Announcement Bar -->
  <div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div class="d-flex align-items-center gap-3">
        <span><i class="bi bi-geo-alt-fill text-info me-1"></i> Plot No. 42, Station Road, Near Sojati Gate, Jodhpur, Rajasthan</span>
        <span class="d-none d-md-inline">&bull;</span>
        <span class="d-none d-md-inline"><i class="bi bi-telephone-fill text-info me-1"></i> +91 98290 12345 / 0291-2654321</span>
      </div>
      <div class="d-flex align-items-center gap-3">
        <a href="contact.php"><i class="bi bi-clock me-1"></i> Showroom Hours: 10:00 AM - 8:30 PM</a>
        <span>&bull;</span>
        <a href="../admin/login.php" class="badge bg-primary text-white text-decoration-none px-2 py-1">
          <i class="bi bi-shield-lock-fill me-1"></i> Admin Portal
        </a>
      </div>
    </div>
  </div>

  <!-- Main Navbar -->
  <nav class="navbar navbar-expand-xl navbar-hoc">
    <div class="container-fluid px-lg-4">
      <a class="navbar-brand-logo d-flex align-items-center gap-3 text-decoration-none" href="index.php">
        <div class="brand-icon-box">
          <i class="bi bi-cpu"></i>
        </div>
        <div>
          <div class="brand-text-main">HARI OM COMPUTER</div>
          <div class="brand-tagline">Your Trusted Technology Partner</div>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storeNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="storeNavbar">
        <ul class="navbar-nav mx-auto mb-2 mb-xl-0">
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'home') ? 'active' : ''; ?>" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'computers') ? 'active' : ''; ?>" href="computers.php">Desktop PCs</a></li>
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'laptops') ? 'active' : ''; ?>" href="laptops.php">Laptops</a></li>
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'components') ? 'active' : ''; ?>" href="components.php">Components</a></li>
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'products') ? 'active' : ''; ?>" href="products.php">All Catalog</a></li>
          <li class="nav-item">
            <a class="nav-link-custom btn-pc-builder-nav ms-xl-2 <?php echo ($currentPage === 'pc-builder') ? 'active' : ''; ?>" href="pc-builder.php">
              <i class="bi bi-motherboard me-1"></i> Custom PC Builder
            </a>
          </li>
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'about') ? 'active' : ''; ?>" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link-custom <?php echo ($currentPage === 'contact') ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
        </ul>

        <div class="d-flex align-items-center gap-3">
          <form class="header-search d-none d-xl-block" id="header-search-form">
            <i class="bi bi-search search-icon text-muted" style="position: absolute; left: 16px; top: 12px;"></i>
            <input type="text" class="form-control" id="header-search-input" placeholder="Search RTX 4060, i7 14th Gen, Dell...">
          </form>

          <a href="enquiry.php" class="btn btn-outline-primary position-relative d-flex align-items-center gap-2 fw-semibold text-nowrap">
            <i class="bi bi-cart4 fs-5"></i>
            <span class="d-none d-sm-inline">Enquiry Cart</span>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none;">
              0
            </span>
          </a>
        </div>
      </div>
    </div>
  </nav>

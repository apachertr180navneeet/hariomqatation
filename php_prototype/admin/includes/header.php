<?php
if (!isset($pageTitle)) {
    $pageTitle = "Admin ERP | Hari Om Computer";
}
if (!isset($currentPage)) {
    $currentPage = "dashboard";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <?php if (!empty($extraCss)) echo $extraCss; ?>
</head>
<body class="admin-body">

  <!-- Admin Sidebar Navigation -->
  <aside class="admin-sidebar">
    <a href="dashboard.php" class="sidebar-brand">
      <div class="sidebar-brand-icon"><i class="bi bi-cpu"></i></div>
      <div class="sidebar-brand-title">
        HARI OM COMPUTER
        <span>Admin ERP Portal</span>
      </div>
    </a>

    <div class="sidebar-nav-section">Core Modules</div>
    <ul class="sidebar-menu">
      <li class="sidebar-item">
        <a href="dashboard.php" class="sidebar-link <?php echo ($currentPage === 'dashboard') ? 'active' : ''; ?>">
          <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="quotations.php" class="sidebar-link <?php echo ($currentPage === 'quotations') ? 'active' : ''; ?>">
          <i class="bi bi-file-earmark-text"></i> <span>Quotations</span>
          <span class="badge-counter" id="badge-pending-quotes">0</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="quotation-create.php" class="sidebar-link <?php echo ($currentPage === 'quotation-create') ? 'active' : ''; ?>">
          <i class="bi bi-plus-circle"></i> <span>Create Quotation</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="pc-builder.php" class="sidebar-link <?php echo ($currentPage === 'pc-builder') ? 'active' : ''; ?>">
          <i class="bi bi-motherboard"></i> <span>Custom PC Builder</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="sales.php" class="sidebar-link <?php echo ($currentPage === 'sales') ? 'active' : ''; ?>">
          <i class="bi bi-receipt"></i> <span>Sales & Invoices</span>
        </a>
      </li>
    </ul>

    <div class="sidebar-nav-section">Catalog & Inventory</div>
    <ul class="sidebar-menu">
      <li class="sidebar-item">
        <a href="products.php" class="sidebar-link <?php echo ($currentPage === 'products') ? 'active' : ''; ?>">
          <i class="bi bi-box-seam"></i> <span>Products</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="laptops.php" class="sidebar-link <?php echo ($currentPage === 'laptops') ? 'active' : ''; ?>">
          <i class="bi bi-laptop"></i> <span>Laptops</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="computers.php" class="sidebar-link <?php echo ($currentPage === 'computers') ? 'active' : ''; ?>">
          <i class="bi bi-pc-display"></i> <span>Desktop PCs</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="categories.php" class="sidebar-link <?php echo ($currentPage === 'categories') ? 'active' : ''; ?>">
          <i class="bi bi-tags"></i> <span>Categories</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="brands.php" class="sidebar-link <?php echo ($currentPage === 'brands') ? 'active' : ''; ?>">
          <i class="bi bi-award"></i> <span>Brands</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="inventory.php" class="sidebar-link <?php echo ($currentPage === 'inventory') ? 'active' : ''; ?>">
          <i class="bi bi-boxes"></i> <span>Inventory Stock</span>
          <span class="badge-counter bg-warning text-dark" id="badge-low-stock">0</span>
        </a>
      </li>
    </ul>

    <div class="sidebar-nav-section">Business Operations</div>
    <ul class="sidebar-menu">
      <li class="sidebar-item">
        <a href="customers.php" class="sidebar-link <?php echo ($currentPage === 'customers') ? 'active' : ''; ?>">
          <i class="bi bi-people"></i> <span>Customers</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="purchases.php" class="sidebar-link <?php echo ($currentPage === 'purchases') ? 'active' : ''; ?>">
          <i class="bi bi-cart-check"></i> <span>Purchases</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="suppliers.php" class="sidebar-link <?php echo ($currentPage === 'suppliers') ? 'active' : ''; ?>">
          <i class="bi bi-truck"></i> <span>Suppliers</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="payments.php" class="sidebar-link <?php echo ($currentPage === 'payments') ? 'active' : ''; ?>">
          <i class="bi bi-credit-card"></i> <span>Payments</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="reports.php" class="sidebar-link <?php echo ($currentPage === 'reports') ? 'active' : ''; ?>">
          <i class="bi bi-bar-chart-line"></i> <span>Reports & GST</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="website-mgmt.php" class="sidebar-link <?php echo ($currentPage === 'website-mgmt') ? 'active' : ''; ?>">
          <i class="bi bi-globe"></i> <span>Website CMS</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="settings.php" class="sidebar-link <?php echo ($currentPage === 'settings') ? 'active' : ''; ?>">
          <i class="bi bi-gear"></i> <span>Settings</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- Admin Main Wrapper -->
  <div class="admin-wrapper">
    
    <!-- Top Header -->
    <header class="admin-navbar">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light d-lg-none" id="sidebar-toggle-btn">
          <i class="bi bi-list fs-5"></i>
        </button>
        <div class="admin-search-wrapper d-none d-sm-block">
          <i class="bi bi-search"></i>
          <input type="text" class="admin-search-input" placeholder="Search quotations, products, clients...">
        </div>
      </div>

      <div class="d-flex align-items-center gap-3">
        <a href="../shop/index.php" target="_blank" class="btn btn-sm btn-outline-primary fw-semibold">
          <i class="bi bi-shop me-1"></i> View Storefront
        </a>

        <div class="dropdown">
          <a href="#" class="admin-user-btn" data-bs-toggle="dropdown">
            <div class="admin-user-avatar">HO</div>
            <div class="d-none d-md-block text-start">
              <div class="fw-bold small text-slate-800">Hari Om Admin</div>
              <div class="text-muted" style="font-size: 0.72rem;">Super Administrator</div>
            </div>
            <i class="bi bi-chevron-down text-muted small ms-1"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li><a class="dropdown-item" href="settings.php"><i class="bi bi-person me-2"></i>Profile & Store Details</a></li>
            <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear me-2"></i>GST & Bank Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="login.php"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a></li>
          </ul>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="admin-content">

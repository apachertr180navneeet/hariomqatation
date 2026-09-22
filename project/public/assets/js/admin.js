/**
 * Hari Om Computer - Admin ERP Operations Script
 * Handles table filtering, dashboard metric loading, status changes, and conversion workflows.
 */

const AdminApp = {
  init() {
    this.bindSidebar();
    this.updateNotificationBadges();
  },

  getUrl(routeKey, fallback, param) {
    if (window.HOC_ADMIN_ROUTES && window.HOC_ADMIN_ROUTES[routeKey]) {
      const val = window.HOC_ADMIN_ROUTES[routeKey];
      return typeof val === 'function' ? val(param) : val;
    }
    return fallback;
  },

  bindSidebar() {
    const toggleBtn = document.getElementById("sidebar-toggle-btn");
    const closeBtn = document.getElementById("sidebar-close-btn");
    const backdrop = document.getElementById("sidebar-backdrop");
    const sidebar = document.querySelector(".admin-sidebar");
    
    const openSidebar = () => {
      if (sidebar) sidebar.classList.add("show");
      if (backdrop) backdrop.classList.add("show");
      document.body.style.overflow = "hidden";
    };

    const closeSidebar = () => {
      if (sidebar) sidebar.classList.remove("show");
      if (backdrop) backdrop.classList.remove("show");
      document.body.style.overflow = "";
    };

    if (toggleBtn) {
      toggleBtn.addEventListener("click", () => {
        if (sidebar && sidebar.classList.contains("show")) {
          closeSidebar();
        } else {
          openSidebar();
        }
      });
    }

    if (closeBtn) {
      closeBtn.addEventListener("click", closeSidebar);
    }

    if (backdrop) {
      backdrop.addEventListener("click", closeSidebar);
    }
  },

  updateNotificationBadges() {
    const quotes = DataStore.getQuotations();
    const pendingQuotes = quotes.filter(q => q.status === "Pending" || q.status === "Draft").length;
    const pendingBadge = document.getElementById("badge-pending-quotes");
    if (pendingBadge) {
      pendingBadge.innerText = pendingQuotes;
      pendingBadge.style.display = pendingQuotes > 0 ? "inline-block" : "none";
    }

    const products = DataStore.getProducts();
    const lowStock = products.filter(p => p.stock <= p.minStock).length;
    const lowStockBadge = document.getElementById("badge-low-stock");
    if (lowStockBadge) {
      lowStockBadge.innerText = lowStock;
      lowStockBadge.style.display = lowStock > 0 ? "inline-block" : "none";
    }
  },

  // Dashboard Metrics & Charts Loader
  loadDashboard() {
    const data = DataStore.get();
    const products = data.products || [];
    const quotes = data.quotations || [];
    const sales = data.sales || [];
    const customers = data.customers || [];

    // KPI 1: Today's Sales
    const today = new Date().toISOString().split("T")[0];
    const todaySales = sales
      .filter(s => s.date === today)
      .reduce((sum, s) => sum + Number(s.amount), 0);
    const todaySalesEl = document.getElementById("kpi-today-sales");
    if (todaySalesEl) todaySalesEl.innerText = HOC_UTILS.formatINR(todaySales || 152980);

    // KPI 2: Monthly Sales
    const monthSales = sales.reduce((sum, s) => sum + Number(s.amount), 0);
    const monthSalesEl = document.getElementById("kpi-month-sales");
    if (monthSalesEl) monthSalesEl.innerText = HOC_UTILS.formatINR(monthSales || 845000);

    // KPI 3: Quotation Counts
    const pendingQuotes = quotes.filter(q => q.status === "Pending" || q.status === "Draft").length;
    const approvedQuotes = quotes.filter(q => q.status === "Approved").length;
    const pendingEl = document.getElementById("kpi-pending-quotes");
    const approvedEl = document.getElementById("kpi-approved-quotes");
    if (pendingEl) pendingEl.innerText = pendingQuotes;
    if (approvedEl) approvedEl.innerText = approvedQuotes;

    // KPI 4: Total Products & Low Stock
    const lowStockCount = products.filter(p => p.stock <= p.minStock).length;
    const prodCountEl = document.getElementById("kpi-total-products");
    const lowStockEl = document.getElementById("kpi-low-stock");
    if (prodCountEl) prodCountEl.innerText = products.length;
    if (lowStockEl) lowStockEl.innerText = lowStockCount;

    // KPI 5: Customers & Pending Payments
    const custEl = document.getElementById("kpi-total-customers");
    if (custEl) custEl.innerText = customers.length;

    // Populate Recent Quotations Table
    const recentQuotesTbody = document.getElementById("dashboard-recent-quotes");
    if (recentQuotesTbody) {
      let html = "";
      quotes.slice(0, 5).forEach(q => {
        const badgeClass = {
          "Approved": "badge-soft-success",
          "Sent": "badge-soft-primary",
          "Pending": "badge-soft-warning",
          "Draft": "badge-soft-secondary",
          "Rejected": "badge-soft-danger",
          "Expired": "badge-soft-secondary"
        }[q.status] || "badge-soft-secondary";

        const qViewUrl = AdminApp.getUrl('quotationView', `quotation-view.php?id=${encodeURIComponent(q.id)}`, q.id);
        const qPrintUrl = AdminApp.getUrl('quotationPrint', `quotation-print.php?id=${encodeURIComponent(q.id)}`, q.id);

        html += `
          <tr>
            <td>
              <a href="${qViewUrl}" class="fw-bold text-primary text-decoration-none">
                ${q.id}
              </a>
            </td>
            <td>
              <div class="fw-semibold">${q.customerName}</div>
              <small class="text-muted">${q.company || 'Retail'}</small>
            </td>
            <td>${q.date}</td>
            <td class="fw-bold">${HOC_UTILS.formatINR(q.grandTotal)}</td>
            <td><span class="badge ${badgeClass}">${q.status}</span></td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-light border dropdown-toggle" data-bs-toggle="dropdown">
                  Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                  <li><a class="dropdown-item" href="${qViewUrl}"><i class="bi bi-eye text-primary me-2"></i>View Quotation</a></li>
                  <li><a class="dropdown-item" href="${qPrintUrl}" target="_blank"><i class="bi bi-printer text-dark me-2"></i>Print / PDF</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item btn-convert-sale" href="#" data-id="${q.id}"><i class="bi bi-receipt-cutoff text-success me-2"></i>Convert to Sale</a></li>
                </ul>
              </div>
            </td>
          </tr>
        `;
      });
      recentQuotesTbody.innerHTML = html;
    }

    // Populate Low Stock Table
    const lowStockTbody = document.getElementById("dashboard-low-stock-table");
    if (lowStockTbody) {
      let html = "";
      const lowItems = products.filter(p => p.stock <= p.minStock);
      if (lowItems.length === 0) {
        html = `<tr><td colspan="5" class="text-center text-success py-3"><i class="bi bi-check-circle me-1"></i>All inventory items are currently well-stocked.</td></tr>`;
      } else {
        const invUrl = AdminApp.getUrl('inventory', 'inventory.php');
        lowItems.slice(0, 5).forEach(p => {
          html += `
            <tr>
              <td>
                <div class="fw-bold">${p.name}</div>
                <small class="text-muted">SKU: ${p.sku}</small>
              </td>
              <td>${p.category}</td>
              <td class="text-danger fw-bold">${p.stock} units</td>
              <td class="text-muted">${p.minStock} units</td>
              <td>
                <a href="${invUrl}" class="btn btn-xs btn-outline-primary py-1 px-2 text-xs">
                  <i class="bi bi-plus-lg"></i> Stock In
                </a>
              </td>
            </tr>
          `;
        });
      }
      lowStockTbody.innerHTML = html;
    }

    // Initialize Charts if Chart.js is present
    this.initDashboardCharts();
  },

  initDashboardCharts() {
    if (typeof Chart === 'undefined') return;

    // Sales Overview Chart (Jan - Aug)
    const salesChartCanvas = document.getElementById("salesOverviewChart");
    if (salesChartCanvas) {
      new Chart(salesChartCanvas, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
          datasets: [
            {
              label: 'Sales Revenue (₹ Lakhs)',
              data: [3.8, 4.5, 5.2, 4.8, 6.1, 7.4, 6.8, 8.45],
              borderColor: '#0284c7',
              backgroundColor: 'rgba(2, 132, 199, 0.1)',
              fill: true,
              tension: 0.35,
              borderWidth: 2.5,
              pointBackgroundColor: '#0284c7',
              pointRadius: 4
            },
            {
              label: 'Quotation Volume (₹ Lakhs)',
              data: [4.5, 5.8, 6.9, 6.2, 8.1, 9.5, 8.8, 11.2],
              borderColor: '#94a3b8',
              backgroundColor: 'transparent',
              borderDash: [5, 5],
              borderWidth: 1.8,
              pointRadius: 0
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { position: 'top', labels: { boxWidth: 12, font: { family: 'Inter', size: 12 } } }
          },
          scales: {
            y: {
              grid: { color: '#f1f5f9' },
              ticks: { callback: val => `₹${val}L`, font: { family: 'Inter', size: 11 } }
            },
            x: {
              grid: { display: false },
              ticks: { font: { family: 'Inter', size: 11 } }
            }
          }
        }
      });
    }

    // Category Distribution Doughnut Chart
    const categoryChartCanvas = document.getElementById("categorySalesChart");
    if (categoryChartCanvas) {
      new Chart(categoryChartCanvas, {
        type: 'doughnut',
        data: {
          labels: ['Laptops', 'Desktops & PCs', 'Monitors', 'CPUs & GPUs', 'RAM & Storage', 'Peripherals'],
          datasets: [{
            data: [35, 25, 12, 15, 8, 5],
            backgroundColor: ['#0284c7', '#38bdf8', '#0f172a', '#6366f1', '#10b981', '#f59e0b'],
            borderWidth: 2,
            borderColor: '#ffffff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 10, font: { family: 'Inter', size: 11 } } }
          },
          cutout: '65%'
        }
      });
    }
  },

  // Setup Quotations List View
  loadQuotationsPage() {
    const tbody = document.getElementById("quotations-table-body");
    if (!tbody) return;

    const quotes = DataStore.getQuotations();
    const render = (list) => {
      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="9" class="text-center py-4 text-muted">No quotations found matching criteria.</td></tr>`;
        return;
      }
      let html = "";
      list.forEach(q => {
        const badgeClass = {
          "Approved": "badge-soft-success",
          "Sent": "badge-soft-primary",
          "Pending": "badge-soft-warning",
          "Draft": "badge-soft-secondary",
          "Rejected": "badge-soft-danger",
          "Expired": "badge-soft-secondary"
        }[q.status] || "badge-soft-secondary";

        const qViewUrl = AdminApp.getUrl('quotationView', `quotation-view.php?id=${encodeURIComponent(q.id)}`, q.id);
        const qPrintUrl = AdminApp.getUrl('quotationPrint', `quotation-print.php?id=${encodeURIComponent(q.id)}`, q.id);

        html += `
          <tr>
            <td>
              <a href="${qViewUrl}" class="fw-bold text-primary text-decoration-none">
                ${q.id}
              </a>
            </td>
            <td>
              <div class="fw-bold text-dark">${q.customerName}</div>
              <small class="text-muted">${q.company ? q.company + ' • ' : ''}${q.mobile}</small>
            </td>
            <td>${q.date}</td>
            <td>${q.validUntil}</td>
            <td class="text-center"><span class="badge bg-light text-dark border">${q.items ? q.items.length : 0} items</span></td>
            <td class="fw-bold text-dark">${HOC_UTILS.formatINR(q.grandTotal)}</td>
            <td>
              <select class="form-select form-select-sm quote-status-select" data-id="${q.id}" style="width: 110px;">
                <option value="Draft" ${q.status === 'Draft' ? 'selected' : ''}>Draft</option>
                <option value="Sent" ${q.status === 'Sent' ? 'selected' : ''}>Sent</option>
                <option value="Pending" ${q.status === 'Pending' ? 'selected' : ''}>Pending</option>
                <option value="Approved" ${q.status === 'Approved' ? 'selected' : ''}>Approved</option>
                <option value="Rejected" ${q.status === 'Rejected' ? 'selected' : ''}>Rejected</option>
                <option value="Expired" ${q.status === 'Expired' ? 'selected' : ''}>Expired</option>
              </select>
            </td>
            <td class="text-end">
              <div class="btn-group btn-group-sm">
                <a href="${qViewUrl}" class="btn btn-outline-secondary" title="View Details">
                  <i class="bi bi-eye"></i>
                </a>
                <a href="${qPrintUrl}" target="_blank" class="btn btn-outline-primary" title="Print / PDF">
                  <i class="bi bi-printer"></i>
                </a>
                <button type="button" class="btn btn-outline-success btn-convert-sale" data-id="${q.id}" title="Convert to Sale Invoice">
                  <i class="bi bi-receipt-cutoff"></i>
                </button>
              </div>
            </td>
          </tr>
        `;
      });
      tbody.innerHTML = html;
    };

    render(quotes);

    // Search and Status filters
    const searchInput = document.getElementById("search-quote-input");
    const statusFilter = document.getElementById("filter-quote-status");

    const filterHandler = () => {
      const qText = (searchInput?.value || "").toLowerCase();
      const statusVal = statusFilter?.value || "ALL";

      const filtered = quotes.filter(q => {
        const matchesText = q.id.toLowerCase().includes(qText) ||
          q.customerName.toLowerCase().includes(qText) ||
          (q.company && q.company.toLowerCase().includes(qText)) ||
          q.mobile.includes(qText);
        const matchesStatus = statusVal === "ALL" || q.status === statusVal;
        return matchesText && matchesStatus;
      });
      render(filtered);
    };

    if (searchInput) searchInput.addEventListener("input", filterHandler);
    if (statusFilter) statusFilter.addEventListener("change", filterHandler);

    // Status change event
    tbody.addEventListener("change", (e) => {
      if (e.target.classList.contains("quote-status-select")) {
        const qId = e.target.getAttribute("data-id");
        const newStatus = e.target.value;
        const q = DataStore.getQuotationById(qId);
        if (q) {
          q.status = newStatus;
          DataStore.saveQuotation(q);
          HOC_UTILS.showToast(`Quotation ${qId} updated to ${newStatus}`);
        }
      }
    });

    // Convert to sale click handler
    document.addEventListener("click", (e) => {
      const convertBtn = e.target.closest(".btn-convert-sale");
      if (convertBtn) {
        e.preventDefault();
        const qId = convertBtn.getAttribute("data-id");
        if (confirm(`Do you want to convert Quotation ${qId} into a final Sales Invoice? This will decrement product stock and record payment.`)) {
          const sale = DataStore.convertQuotationToSale(qId, "Bank Transfer");
          if (sale) {
            HOC_UTILS.showToast(`Invoice ${sale.invoiceNo} successfully generated from quotation!`);
            setTimeout(() => {
              window.location.href = AdminApp.getUrl('sales', 'sales.php');
            }, 800);
          }
        }
      }
    });
  },

  // Setup Products List View
  loadProductsPage() {
    const tbody = document.getElementById("products-table-body");
    if (!tbody) return;

    const products = DataStore.getProducts();
    const render = (list) => {
      if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8" class="text-center py-4 text-muted">No products found matching filters.</td></tr>`;
        return;
      }
      let html = "";
      list.forEach(p => {
        const isLow = p.stock <= p.minStock;
        const pViewUrl = AdminApp.getUrl('productView', `product-view.php?id=${p.id}`, p.id);
        html += `
          <tr>
            <td>
              <div class="d-flex align-items-center gap-3">
                <div class="bg-light rounded p-1 text-center" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                  <i class="bi ${p.category === 'Laptops' ? 'bi-laptop' : p.category === 'Desktop Computers' ? 'bi-pc-display' : 'bi-cpu'} text-secondary fs-4"></i>
                </div>
                <div>
                  <a href="${pViewUrl}" class="fw-bold text-dark text-decoration-none d-block">${p.name}</a>
                  <small class="text-muted">SKU: ${p.sku} | Brand: <strong>${p.brand}</strong></small>
                </div>
              </div>
            </td>
            <td>
              <span class="badge bg-light text-dark border">${p.category}</span>
              <div class="small text-muted">${p.subcategory || ''}</div>
            </td>
            <td class="text-muted">${HOC_UTILS.formatINR(p.purchasePrice)}</td>
            <td class="fw-bold text-dark">${HOC_UTILS.formatINR(p.sellingPrice)}</td>
            <td>
              <span class="badge ${isLow ? (p.stock === 0 ? 'bg-danger' : 'bg-warning text-dark') : 'bg-success'}">
                ${p.stock} Units ${isLow ? '(Low)' : ''}
              </span>
            </td>
            <td>${p.warranty || '1 Year'}</td>
            <td>
              <span class="badge ${p.status === 'Active' ? 'badge-soft-success' : 'badge-soft-secondary'}">${p.status}</span>
            </td>
            <td class="text-end">
              <div class="btn-group btn-group-sm">
                <a href="${pViewUrl}" class="btn btn-outline-secondary" title="View"><i class="bi bi-eye"></i></a>
                <button type="button" class="btn btn-outline-primary btn-edit-product" data-id="${p.id}" title="Edit"><i class="bi bi-pencil"></i></button>
                <button type="button" class="btn btn-outline-danger btn-delete-product" data-id="${p.id}" title="Delete"><i class="bi bi-trash"></i></button>
              </div>
            </td>
          </tr>
        `;
      });
      tbody.innerHTML = html;
    };

    render(products);

    // Search and Category filter
    const searchInput = document.getElementById("search-product-input");
    const categoryFilter = document.getElementById("filter-category-select");

    const filterProducts = () => {
      const q = (searchInput?.value || "").toLowerCase();
      const cat = categoryFilter?.value || "ALL";
      const filtered = products.filter(p => {
        const matchesQ = p.name.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q) || p.brand.toLowerCase().includes(q);
        const matchesCat = cat === "ALL" || p.category === cat;
        return matchesQ && matchesCat;
      });
      render(filtered);
    };

    if (searchInput) searchInput.addEventListener("input", filterProducts);
    if (categoryFilter) categoryFilter.addEventListener("change", filterProducts);
  }
};

document.addEventListener("DOMContentLoaded", () => {
  AdminApp.init();
});

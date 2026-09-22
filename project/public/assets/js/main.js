/**
 * Hari Om Computer - Store Frontend Script
 * Handles customer interactions, enquiry cart, catalog filtering, WhatsApp enquiry link generator.
 */

const StoreApp = {
  init() {
    this.updateCartBadge();
    this.bindEvents();
    this.bindCartListeners();
  },

  updateCartBadge() {
    const cart = DataStore.getEnquiryCart();
    const count = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
    const badges = document.querySelectorAll(".enquiry-count-badge");
    badges.forEach(b => {
      b.innerText = count;
      b.style.display = count > 0 ? "inline-block" : "none";
    });
  },

  bindCartListeners() {
    window.addEventListener("hoc_cart_updated", () => {
      this.updateCartBadge();
      this.renderEnquiryPage();
    });
  },

  bindEvents() {
    // Add to enquiry click
    document.addEventListener("click", (e) => {
      const addBtn = e.target.closest(".btn-add-enquiry");
      if (addBtn) {
        e.preventDefault();
        const prodId = addBtn.getAttribute("data-id");
        DataStore.addToEnquiryCart(prodId, 1);
        HOC_UTILS.showToast("Product added to your Enquiry list!");
      }

      const quickQuoteBtn = e.target.closest(".btn-get-quick-quote");
      if (quickQuoteBtn) {
        e.preventDefault();
        const prodId = quickQuoteBtn.getAttribute("data-id");
        DataStore.addToEnquiryCart(prodId, 1);
        window.location.href = (window.HOC_ROUTES && window.HOC_ROUTES.enquiry) || "/enquiry";
      }
    });

    // Header quick search
    const headerSearch = document.getElementById("header-search-form");
    if (headerSearch) {
      headerSearch.addEventListener("submit", (e) => {
        e.preventDefault();
        const query = document.getElementById("header-search-input")?.value.trim();
        if (query) {
          const baseUrl = (window.HOC_ROUTES && window.HOC_ROUTES.products) || "/products";
          window.location.href = `${baseUrl}?search=${encodeURIComponent(query)}`;
        }
      });
    }
  },

  // Renders the Enquiry / Request Quotation Page
  renderEnquiryPage() {
    const tableBody = document.getElementById("enquiry-cart-tbody");
    const summaryBox = document.getElementById("enquiry-summary-box");
    if (!tableBody) return;

    const cart = DataStore.getEnquiryCart();

    if (cart.length === 0) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="6" class="text-center py-5">
            <div class="mb-3"><i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i></div>
            <h5 class="text-muted">Your Enquiry Cart is empty</h5>
            <p class="text-muted small">Explore our laptops, desktop PCs, or build a custom rig to request a price quotation.</p>
            <a href="${(window.HOC_ROUTES && window.HOC_ROUTES.products) || '/products'}" class="btn btn-primary mt-2"><i class="bi bi-shop me-1"></i> Browse Products</a>
          </td>
        </tr>
      `;
      if (summaryBox) summaryBox.style.display = "none";
      return;
    }

    if (summaryBox) summaryBox.style.display = "block";

    let html = "";
    let totalEst = 0;

    cart.forEach((item, index) => {
      const lineTotal = (item.price || 0) * (item.qty || 1);
      totalEst += lineTotal;

      html += `
        <tr>
          <td class="text-center">${index + 1}</td>
          <td>
            <div class="d-flex align-items-center gap-3">
              <div class="bg-light rounded p-2 text-center" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-cpu text-primary fs-4"></i>
              </div>
              <div>
                <strong class="d-block text-dark">${item.name}</strong>
                <small class="text-muted">${item.specs || item.sku}</small>
              </div>
            </div>
          </td>
          <td class="fw-semibold text-slate-800">${HOC_UTILS.formatINR(item.price)}</td>
          <td style="width: 120px;">
            <div class="input-group input-group-sm">
              <button class="btn btn-outline-secondary btn-cart-qty-dec" data-id="${item.id}">-</button>
              <input type="text" class="form-control text-center bg-white" readonly value="${item.qty}">
              <button class="btn btn-outline-secondary btn-cart-qty-inc" data-id="${item.id}">+</button>
            </div>
          </td>
          <td class="fw-bold text-end text-primary">${HOC_UTILS.formatINR(lineTotal)}</td>
          <td class="text-center" style="width: 60px;">
            <button type="button" class="btn btn-sm btn-outline-danger btn-cart-remove" data-id="${item.id}" title="Remove">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      `;
    });

    tableBody.innerHTML = html;

    // Update Summary side
    const countEl = document.getElementById("enquiry-total-items");
    const estEl = document.getElementById("enquiry-est-total");
    const gstEstEl = document.getElementById("enquiry-gst-est");

    if (countEl) countEl.innerText = `${cart.reduce((s, i) => s + i.qty, 0)} Items`;
    if (estEl) estEl.innerText = HOC_UTILS.formatINR(totalEst);
    if (gstEstEl) gstEstEl.innerText = HOC_UTILS.formatINR(totalEst * 0.18 / 1.18);

    // Bind Cart quantity and removal buttons
    tableBody.querySelectorAll(".btn-cart-qty-inc").forEach(btn => {
      btn.onclick = () => {
        const id = btn.getAttribute("data-id");
        DataStore.addToEnquiryCart(id, 1);
      };
    });

    tableBody.querySelectorAll(".btn-cart-qty-dec").forEach(btn => {
      btn.onclick = () => {
        const id = btn.getAttribute("data-id");
        const existing = DataStore.getEnquiryCart().find(i => i.id === id);
        if (existing && existing.qty > 1) {
          existing.qty -= 1;
          DataStore.saveEnquiryCart(DataStore.getEnquiryCart().map(i => i.id === id ? existing : i));
        } else {
          DataStore.removeFromEnquiryCart(id);
        }
      };
    });

    tableBody.querySelectorAll(".btn-cart-remove").forEach(btn => {
      btn.onclick = () => {
        const id = btn.getAttribute("data-id");
        DataStore.removeFromEnquiryCart(id);
      };
    });

    // Form Submission for Quotation Request
    const form = document.getElementById("enquiry-request-form");
    if (form && !form.dataset.bound) {
      form.dataset.bound = "true";
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        const name = document.getElementById("enq-name").value.trim();
        const mobile = document.getElementById("enq-mobile").value.trim();
        const email = document.getElementById("enq-email")?.value.trim() || "";
        const company = document.getElementById("enq-company")?.value.trim() || "";
        const gstin = document.getElementById("enq-gstin")?.value.trim() || "";
        const address = document.getElementById("enq-address")?.value.trim() || "";
        const notes = document.getElementById("enq-notes")?.value.trim() || "";

        if (!name || !mobile) {
          HOC_UTILS.showToast("Please fill in your name and mobile number.", "danger");
          return;
        }

        const quoteItems = cart.map(item => ({
          productId: item.id,
          name: item.name,
          sku: item.sku || "PROD",
          qty: item.qty,
          rate: Number(((item.price || 0) / 1.18).toFixed(2)),
          gstRate: 18,
          discount: 0,
          amount: (item.price || 0) * item.qty
        }));

        const subtotal = totalEst / 1.18;
        const gst = totalEst - subtotal;
        const quoteNo = DataStore.generateQuotationNumber();

        const newQuote = {
          id: quoteNo,
          customerId: `CUST-ENQ-${Date.now().toString().slice(-4)}`,
          customerName: name,
          company: company,
          mobile: mobile,
          email: email,
          gstin: gstin,
          address: address,
          date: new Date().toISOString().split("T")[0],
          validUntil: new Date(Date.now() + 15 * 86400000).toISOString().split("T")[0],
          salesPerson: "Online Web Enquiry",
          status: "Pending",
          items: quoteItems,
          subtotal: Number(subtotal.toFixed(2)),
          discountTotal: 0,
          gstTotal: Number(gst.toFixed(2)),
          roundOff: 0,
          grandTotal: totalEst,
          notes: notes ? `Customer Note: ${notes}` : "Submitted via Hari Om Computer Online Portal"
        };

        DataStore.saveQuotation(newQuote);
        DataStore.clearEnquiryCart();

        // Redirect to success page with quote number
        sessionStorage.setItem("HOC_LATEST_ENQUIRY", JSON.stringify(newQuote));
        window.location.href = (window.HOC_ROUTES && window.HOC_ROUTES.quotationSuccess) || "/quotation-success";
      });
    }

    // WhatsApp Enquiry Button Handler
    const waBtn = document.getElementById("btn-whatsapp-enquiry");
    if (waBtn) {
      waBtn.onclick = () => {
        let msg = `*Namaste Hari Om Computer!*\nI would like to inquire about the following products:\n\n`;
        cart.forEach((i, idx) => {
          msg += `${idx + 1}. *${i.name}* (Qty: ${i.qty}) - ${HOC_UTILS.formatINR(i.price * i.qty)}\n`;
        });
        msg += `\n*Estimated Total: ${HOC_UTILS.formatINR(totalEst)}*\nPlease share the best quotation and availability.`;

        const waUrl = `https://wa.me/919829012345?text=${encodeURIComponent(msg)}`;
        window.open(waUrl, "_blank");
      };
    }
  }
};

document.addEventListener("DOMContentLoaded", () => {
  StoreApp.init();
});

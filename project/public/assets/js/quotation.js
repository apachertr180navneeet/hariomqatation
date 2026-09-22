/**
 * Hari Om Computer - Quotation Management Script
 * Handles quotation creation, line-item modifications, tax/discount computations, and PDF/Print preparation.
 */

const QuotationEngine = {
  items: [],

  initCreatePage() {
    this.tableBody = document.getElementById("quote-items-tbody");
    this.productSelect = document.getElementById("quote-product-picker");
    
    if (!this.tableBody) return;

    this.populateProductPicker();
    this.populateCustomerPicker();
    this.bindEvents();

    // Add 1 default row
    this.addItem("PROD-1002", 1);
  },

  populateProductPicker() {
    if (!this.productSelect) return;
    const products = DataStore.getProducts();
    let html = '<option value="">-- Choose Product to Add --</option>';
    products.forEach(p => {
      html += `<option value="${p.id}">${p.name} (${p.sku}) - ${HOC_UTILS.formatINR(p.sellingPrice)} [Stock: ${p.stock}]</option>`;
    });
    this.productSelect.innerHTML = html;
  },

  populateCustomerPicker() {
    const custSelect = document.getElementById("quote-customer-picker");
    if (!custSelect) return;
    const data = DataStore.get();
    let html = '<option value="">-- Select Existing Customer (or enter new details) --</option>';
    (data.customers || []).forEach(c => {
      html += `<option value="${c.id}">${c.name} - ${c.company || 'Retail'} (${c.mobile})</option>`;
    });
    custSelect.innerHTML = html;

    custSelect.addEventListener("change", (e) => {
      const selectedId = e.target.value;
      if (!selectedId) return;
      const c = data.customers.find(item => item.id === selectedId);
      if (c) {
        document.getElementById("cust-name").value = c.name || "";
        document.getElementById("cust-company").value = c.company || "";
        document.getElementById("cust-mobile").value = c.mobile || "";
        document.getElementById("cust-email").value = c.email || "";
        document.getElementById("cust-gstin").value = c.gstin || "";
        document.getElementById("cust-address").value = c.address || "";
      }
    });
  },

  addItem(productId, qty = 1) {
    const prod = DataStore.getProductById(productId);
    if (!prod) return;

    // Selling price includes 18% GST by standard retail; calculate base rate
    const baseRate = Number((prod.sellingPrice / 1.18).toFixed(2));

    this.items.push({
      productId: prod.id,
      name: prod.name,
      sku: prod.sku,
      qty: qty,
      rate: baseRate,
      gstRate: prod.gstRate || 18,
      discount: 0,
      amount: Math.round(baseRate * qty * 1.18)
    });

    this.renderItems();
    this.calculateTotals();
  },

  removeItem(index) {
    this.items.splice(index, 1);
    this.renderItems();
    this.calculateTotals();
  },

  updateItem(index, field, value) {
    const item = this.items[index];
    if (!item) return;

    item[field] = Number(value) || 0;
    
    // Recalculate item amount: (rate * qty - discount) * (1 + gstRate/100)
    const taxable = Math.max(0, (item.rate * item.qty) - item.discount);
    const tax = taxable * (item.gstRate / 100);
    item.amount = Math.round(taxable + tax);

    this.renderItems();
    this.calculateTotals();
  },

  renderItems() {
    if (!this.tableBody) return;

    if (this.items.length === 0) {
      this.tableBody.innerHTML = `<tr><td colspan="8" class="text-center text-muted py-4">No items added to quotation yet. Select a product above to add.</td></tr>`;
      return;
    }

    let html = "";
    this.items.forEach((item, index) => {
      html += `
        <tr>
          <td class="text-center">${index + 1}</td>
          <td>
            <strong>${item.name}</strong><br>
            <small class="text-muted">SKU: ${item.sku}</small>
          </td>
          <td style="width: 100px;">
            <input type="number" min="1" class="form-control form-control-sm text-center item-qty" data-index="${index}" value="${item.qty}">
          </td>
          <td style="width: 130px;">
            <input type="number" step="0.01" class="form-control form-control-sm text-end item-rate" data-index="${index}" value="${item.rate}">
          </td>
          <td style="width: 110px;">
            <input type="number" class="form-control form-control-sm text-end item-discount" data-index="${index}" value="${item.discount}">
          </td>
          <td style="width: 90px;" class="text-center">
            <span class="badge bg-light text-dark border">${item.gstRate}%</span>
          </td>
          <td class="text-end fw-bold text-slate-800" style="width: 130px;">
            ${HOC_UTILS.formatINR(item.amount)}
          </td>
          <td class="text-center" style="width: 60px;">
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" data-index="${index}" title="Remove Item">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      `;
    });
    this.tableBody.innerHTML = html;
  },

  calculateTotals() {
    let subtotal = 0;
    let discountTotal = 0;
    let gstTotal = 0;
    let grandTotal = 0;

    this.items.forEach(item => {
      const itemTaxable = Math.max(0, (item.rate * item.qty) - item.discount);
      const itemGst = itemTaxable * (item.gstRate / 100);
      subtotal += item.rate * item.qty;
      discountTotal += item.discount;
      gstTotal += itemGst;
      grandTotal += (itemTaxable + itemGst);
    });

    const roundedGrandTotal = Math.round(grandTotal);
    const roundOff = Number((roundedGrandTotal - grandTotal).toFixed(2));

    // Update UI elements
    const subtotalEl = document.getElementById("quote-subtotal");
    const discountEl = document.getElementById("quote-discount-total");
    const gstEl = document.getElementById("quote-gst-total");
    const roundOffEl = document.getElementById("quote-roundoff");
    const grandTotalEl = document.getElementById("quote-grand-total");
    const wordsEl = document.getElementById("quote-amount-words");

    if (subtotalEl) subtotalEl.innerText = HOC_UTILS.formatINR(subtotal);
    if (discountEl) discountEl.innerText = HOC_UTILS.formatINR(discountTotal);
    if (gstEl) gstEl.innerText = HOC_UTILS.formatINR(gstTotal);
    if (roundOffEl) roundOffEl.innerText = HOC_UTILS.formatINR(roundOff);
    if (grandTotalEl) grandTotalEl.innerText = HOC_UTILS.formatINR(roundedGrandTotal);
    if (wordsEl) wordsEl.innerText = HOC_UTILS.numberToWordsINR(roundedGrandTotal);

    return {
      subtotal: Number(subtotal.toFixed(2)),
      discountTotal: Number(discountTotal.toFixed(2)),
      gstTotal: Number(gstTotal.toFixed(2)),
      roundOff: roundOff,
      grandTotal: roundedGrandTotal
    };
  },

  bindEvents() {
    // Add product button
    const addBtn = document.getElementById("btn-add-product-line");
    if (addBtn) {
      addBtn.addEventListener("click", () => {
        const prodId = this.productSelect.value;
        const qty = parseInt(document.getElementById("quote-add-qty")?.value) || 1;
        if (!prodId) {
          HOC_UTILS.showToast("Please select a product first", "danger");
          return;
        }
        this.addItem(prodId, qty);
        this.productSelect.value = "";
      });
    }

    // Dynamic row input events
    if (this.tableBody) {
      this.tableBody.addEventListener("change", (e) => {
        const index = e.target.getAttribute("data-index");
        if (index === null) return;

        if (e.target.classList.contains("item-qty")) {
          this.updateItem(index, "qty", e.target.value);
        } else if (e.target.classList.contains("item-rate")) {
          this.updateItem(index, "rate", e.target.value);
        } else if (e.target.classList.contains("item-discount")) {
          this.updateItem(index, "discount", e.target.value);
        }
      });

      this.tableBody.addEventListener("click", (e) => {
        const removeBtn = e.target.closest(".btn-remove-item");
        if (removeBtn) {
          const index = parseInt(removeBtn.getAttribute("data-index"));
          this.removeItem(index);
        }
      });
    }

    // Save quotation form submission
    const saveQuoteBtn = document.getElementById("btn-save-quotation");
    if (saveQuoteBtn) {
      saveQuoteBtn.addEventListener("click", (e) => {
        e.preventDefault();
        this.saveQuotationFromForm();
      });
    }
  },

  saveQuotationFromForm() {
    if (this.items.length === 0) {
      HOC_UTILS.showToast("Please add at least one product item to the quotation.", "danger");
      return;
    }

    const custName = document.getElementById("cust-name")?.value.trim();
    const custMobile = document.getElementById("cust-mobile")?.value.trim();

    if (!custName || !custMobile) {
      HOC_UTILS.showToast("Customer Name and Mobile Number are required.", "danger");
      return;
    }

    const totals = this.calculateTotals();
    const quoteNo = document.getElementById("quote-number")?.value || DataStore.generateQuotationNumber();
    const quoteDate = document.getElementById("quote-date")?.value || new Date().toISOString().split("T")[0];
    const validUntil = document.getElementById("quote-validity")?.value || new Date(Date.now() + 15*86400000).toISOString().split("T")[0];
    const salesPerson = document.getElementById("quote-salesperson")?.value || "Sunil Sharma";
    const status = document.getElementById("quote-status")?.value || "Draft";
    const notes = document.getElementById("quote-notes")?.value || "";

    const newQuotation = {
      id: quoteNo,
      customerId: document.getElementById("quote-customer-picker")?.value || `CUST-AUTO-${Date.now().toString().slice(-4)}`,
      customerName: custName,
      company: document.getElementById("cust-company")?.value || "",
      mobile: custMobile,
      email: document.getElementById("cust-email")?.value || "",
      gstin: document.getElementById("cust-gstin")?.value || "",
      address: document.getElementById("cust-address")?.value || "",
      date: quoteDate,
      validUntil: validUntil,
      salesPerson: salesPerson,
      status: status,
      items: this.items,
      subtotal: totals.subtotal,
      discountTotal: totals.discountTotal,
      gstTotal: totals.gstTotal,
      roundOff: totals.roundOff,
      grandTotal: totals.grandTotal,
      notes: notes
    };

    DataStore.saveQuotation(newQuotation);
    HOC_UTILS.showToast(`Quotation ${newQuotation.id} saved successfully!`);

    setTimeout(() => {
      const destUrl = (window.HOC_ADMIN_ROUTES && typeof window.HOC_ADMIN_ROUTES.quotationView === 'function')
        ? window.HOC_ADMIN_ROUTES.quotationView(newQuotation.id)
        : `quotation-view.php?id=${encodeURIComponent(newQuotation.id)}`;
      window.location.href = destUrl;
    }, 600);
  }
};


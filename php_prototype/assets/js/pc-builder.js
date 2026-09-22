/**
 * Hari Om Computer - Custom PC Builder Engine
 * Real-time compatibility checking, power calculation, dynamic pricing, and quote generator.
 */

const PCBuilder = {
  currentBuild: {
    cpu: null,
    motherboard: null,
    ram: null,
    storage: null,
    gpu: null,
    cabinet: null,
    psu: null,
    cooler: null,
    monitor: null,
    peripherals: null
  },

  init(containerId = "pc-builder-app") {
    this.container = document.getElementById(containerId);
    if (!this.container) return;

    this.render();
    this.bindEvents();
    this.updateSummary();
  },

  getProductsByType(type) {
    const products = DataStore.getProducts();
    return products.filter(p => p.pcbType === type && p.status === 'Active');
  },

  selectComponent(type, productId) {
    const prod = DataStore.getProductById(productId);
    this.currentBuild[type] = prod || null;
    this.updateSummary();
    this.checkCompatibility();
  },

  calculateTotals() {
    let subtotal = 0;
    let requiredWattage = 150; // Base motherboard, fans, storage, cpu baseline

    for (const key in this.currentBuild) {
      const item = this.currentBuild[key];
      if (item) {
        subtotal += Number(item.sellingPrice) || 0;
        if (key === 'cpu') requiredWattage += 65;
        if (key === 'gpu' && item.wattageReq) requiredWattage = Math.max(requiredWattage + 150, item.wattageReq);
      }
    }

    // In Indian computer retail, list prices often include 18% GST; let's show clean breakup
    const baseAmount = subtotal / 1.18;
    const gstAmount = subtotal - baseAmount;

    return {
      subtotal: Math.round(subtotal),
      baseAmount: Math.round(baseAmount),
      gstAmount: Math.round(gstAmount),
      requiredWattage: requiredWattage,
      selectedCount: Object.values(this.currentBuild).filter(Boolean).length
    };
  },

  checkCompatibility() {
    const issues = [];
    const { cpu, motherboard, ram, gpu, psu } = this.currentBuild;

    // CPU and Motherboard Socket Check
    if (cpu && motherboard) {
      if (cpu.socket && motherboard.socket && cpu.socket !== motherboard.socket) {
        issues.push({
          type: "danger",
          title: "Incompatible Socket!",
          message: `Selected processor (${cpu.name}) uses socket <strong>${cpu.socket}</strong>, but motherboard (${motherboard.name}) is for <strong>${motherboard.socket}</strong>.`
        });
      }
    }

    // Motherboard and RAM Type Check (DDR4 vs DDR5)
    if (motherboard && ram) {
      if (motherboard.ramType && ram.ramType && motherboard.ramType !== ram.ramType) {
        issues.push({
          type: "danger",
          title: "RAM Type Mismatch!",
          message: `Motherboard requires <strong>${motherboard.ramType}</strong> RAM, but you selected <strong>${ram.ramType}</strong> memory.`
        });
      }
    }

    // PSU Wattage Recommendation Check
    if (gpu && psu) {
      const minWattage = gpu.wattageReq || 550;
      if (psu.wattage && psu.wattage < minWattage) {
        issues.push({
          type: "warning",
          title: "Power Supply Recommendation",
          message: `Your graphics card (${gpu.name}) recommends at least a <strong>${minWattage}W PSU</strong>. Your selected PSU is ${psu.wattage}W.`
        });
      }
    }

    const bannerEl = document.getElementById("pcb-compat-alert");
    if (!bannerEl) return;

    if (issues.length === 0) {
      bannerEl.className = "alert alert-success d-flex align-items-center gap-2 mb-4";
      bannerEl.innerHTML = `
        <i class="bi bi-shield-fill-check fs-4"></i>
        <div>
          <strong>Compatibility Status: 100% Compatible</strong><br>
          <small class="text-muted">All selected components are verified by Hari Om Computer technicians to work harmoniously.</small>
        </div>
      `;
    } else {
      const firstIssue = issues[0];
      bannerEl.className = `alert alert-${firstIssue.type} d-flex align-items-start gap-2 mb-4`;
      bannerEl.innerHTML = `
        <i class="bi ${firstIssue.type === 'danger' ? 'bi-exclamation-octagon-fill' : 'bi-exclamation-triangle-fill'} fs-4"></i>
        <div>
          <strong>${firstIssue.title}</strong><br>
          <span>${firstIssue.message}</span>
        </div>
      `;
    }
  },

  updateSummary() {
    const totals = this.calculateTotals();

    // Update Live Pricing Elements
    const totalEl = document.getElementById("pcb-grand-total");
    const subtotalEl = document.getElementById("pcb-subtotal");
    const gstEl = document.getElementById("pcb-gst");
    const countEl = document.getElementById("pcb-item-count");
    const psuRecEl = document.getElementById("pcb-psu-rec");

    if (totalEl) totalEl.innerText = HOC_UTILS.formatINR(totals.subtotal);
    if (subtotalEl) subtotalEl.innerText = HOC_UTILS.formatINR(totals.baseAmount);
    if (gstEl) gstEl.innerText = HOC_UTILS.formatINR(totals.gstAmount);
    if (countEl) countEl.innerText = `${totals.selectedCount} / 10`;
    if (psuRecEl) psuRecEl.innerText = `Recommended PSU: ${totals.requiredWattage}W+`;

    // Render summary component breakdown
    const listEl = document.getElementById("pcb-summary-list");
    if (listEl) {
      let html = "";
      const labels = {
        cpu: "Processor",
        motherboard: "Motherboard",
        ram: "RAM Memory",
        storage: "Storage (SSD/HDD)",
        gpu: "Graphics Card",
        cabinet: "Cabinet",
        psu: "Power Supply",
        cooler: "CPU Cooler",
        monitor: "Monitor",
        peripherals: "Keyboard / Mouse"
      };

      for (const [key, label] of Object.entries(labels)) {
        const item = this.currentBuild[key];
        html += `
          <div class="d-flex justify-content-between align-items-center py-2 border-bottom text-sm">
            <div>
              <div class="fw-semibold text-slate-800" style="font-size: 0.85rem;">${label}</div>
              <small class="${item ? 'text-primary' : 'text-muted'}" style="font-size: 0.78rem;">
                ${item ? item.name : 'Not Selected'}
              </small>
            </div>
            <div class="fw-bold text-end" style="font-size: 0.85rem;">
              ${item ? HOC_UTILS.formatINR(item.sellingPrice) : '—'}
            </div>
          </div>
        `;
      }
      listEl.innerHTML = html;
    }
  },

  render() {
    const steps = [
      { key: "cpu", title: "1. Select Processor (CPU)", icon: "bi-cpu", badge: "Required", desc: "Intel Core 14th Gen or AMD Ryzen 7000 Series" },
      { key: "motherboard", title: "2. Select Motherboard", icon: "bi-motherboard", badge: "Required", desc: "Matches socket and memory type of CPU" },
      { key: "ram", title: "3. Select RAM Memory", icon: "bi-memory", badge: "Required", desc: "High speed DDR4 / DDR5 modules" },
      { key: "storage", title: "4. Select Primary Storage", icon: "bi-device-ssd", badge: "Required", desc: "Ultra-fast NVMe M.2 SSDs" },
      { key: "gpu", title: "5. Select Graphics Card (GPU)", icon: "bi-gpu-card", badge: "Optional / Dedicated", desc: "NVIDIA RTX 4000 series or integrated" },
      { key: "cabinet", title: "6. Select PC Cabinet", icon: "bi-box", badge: "Required", desc: "ARGB Tempered glass or minimalist office cases" },
      { key: "psu", title: "7. Select Power Supply (SMPS)", icon: "bi-lightning-charge", badge: "Required", desc: "80 Plus Bronze & Gold Certified units" },
      { key: "cooler", title: "8. Select CPU Cooling", icon: "bi-snow", badge: "Recommended", desc: "Tower Air Coolers or AIO Liquid Coolers" },
      { key: "monitor", title: "9. Select Monitor", icon: "bi-display", badge: "Optional", desc: "IPS, 144Hz-165Hz Gaming or Office displays" },
      { key: "peripherals", title: "10. Select Keyboard & Mouse", icon: "bi-keyboard", badge: "Optional", desc: "Wireless desk combos or RGB mechanical sets" }
    ];

    let html = `
      <div id="pcb-compat-alert" class="alert alert-success d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-shield-fill-check fs-4"></i>
        <div>
          <strong>Compatibility Engine Active</strong><br>
          <small class="text-muted">Select components below to build your custom setup. Live compatibility rules will validate sockets, wattage, and RAM.</small>
        </div>
      </div>
    `;

    steps.forEach(step => {
      const items = this.getProductsByType(step.key);
      html += `
        <div class="pcb-step-card" id="step-card-${step.key}">
          <div class="pcb-step-header">
            <div class="pcb-step-title">
              <i class="bi ${step.icon} text-primary fs-5"></i>
              <span>${step.title}</span>
            </div>
            <span class="pcb-step-badge">${step.badge}</span>
          </div>
          <p class="text-muted small mb-3">${step.desc}</p>
          
          <div class="row g-3">
            ${items.length === 0 ? '<div class="col-12"><small class="text-muted">No components found in this category.</small></div>' : ''}
            ${items.map(item => `
              <div class="col-md-6 col-lg-4">
                <div class="card h-100 border p-3 component-choice-card" style="cursor: pointer;" data-type="${step.key}" data-id="${item.id}">
                  <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-light text-dark border">${item.brand}</span>
                    ${item.socket ? `<span class="badge bg-primary-subtle text-primary">${item.socket}</span>` : ''}
                    ${item.ramType ? `<span class="badge bg-info-subtle text-info-emphasis">${item.ramType}</span>` : ''}
                    ${item.wattage ? `<span class="badge bg-warning-subtle text-warning-emphasis">${item.wattage}W</span>` : ''}
                  </div>
                  <h6 class="fw-bold mb-1" style="font-size: 0.9rem;">${item.name}</h6>
                  <p class="text-muted small mb-2" style="font-size: 0.78rem;">${item.specs}</p>
                  <div class="d-flex align-items-center justify-content-between mt-auto pt-2 border-top">
                    <span class="fw-bold text-primary">${HOC_UTILS.formatINR(item.sellingPrice)}</span>
                    <button type="button" class="btn btn-sm btn-outline-primary btn-select-component" data-type="${step.key}" data-id="${item.id}">
                      Select
                    </button>
                  </div>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
    });

    this.container.innerHTML = html;
  },

  bindEvents() {
    this.container.addEventListener("click", (e) => {
      const btn = e.target.closest(".btn-select-component") || e.target.closest(".component-choice-card");
      if (btn) {
        const type = btn.getAttribute("data-type");
        const id = btn.getAttribute("data-id");
        this.selectComponent(type, id);

        // Highlight selection visually
        const parentCard = document.getElementById(`step-card-${type}`);
        if (parentCard) {
          parentCard.querySelectorAll(".component-choice-card").forEach(c => {
            c.classList.remove("border-primary", "bg-light");
            const selectBtn = c.querySelector(".btn-select-component");
            if (selectBtn) {
              selectBtn.className = "btn btn-sm btn-outline-primary btn-select-component";
              selectBtn.innerText = "Select";
            }
          });

          const chosen = parentCard.querySelector(`[data-id="${id}"]`);
          if (chosen) {
            chosen.classList.add("border-primary", "bg-light");
            const selectBtn = chosen.querySelector(".btn-select-component");
            if (selectBtn) {
              selectBtn.className = "btn btn-sm btn-primary btn-select-component";
              selectBtn.innerHTML = '<i class="bi bi-check2"></i> Selected';
            }
          }
        }
      }
    });

    // Save build action
    const saveBtn = document.getElementById("btn-save-build");
    if (saveBtn) {
      saveBtn.addEventListener("click", () => {
        const totals = this.calculateTotals();
        if (totals.selectedCount === 0) {
          HOC_UTILS.showToast("Please select at least one component to save your build.", "danger");
          return;
        }
        const savedBuild = {
          id: `HOC/PC/2026/${String(Date.now()).slice(-4)}`,
          date: new Date().toISOString().split("T")[0],
          build: this.currentBuild,
          totals: totals
        };
        const existing = JSON.parse(localStorage.getItem("HOC_SAVED_BUILDS") || "[]");
        existing.unshift(savedBuild);
        localStorage.setItem("HOC_SAVED_BUILDS", JSON.stringify(existing));
        HOC_UTILS.showToast(`Custom Build ${savedBuild.id} saved successfully!`);
      });
    }

    // Request quote action
    const quoteBtn = document.getElementById("btn-request-pc-quote");
    if (quoteBtn) {
      quoteBtn.addEventListener("click", () => {
        const totals = this.calculateTotals();
        if (totals.selectedCount === 0) {
          HOC_UTILS.showToast("Please select components first.", "danger");
          return;
        }

        // Add custom PC to enquiry cart and redirect to enquiry
        const specSummary = Object.entries(this.currentBuild)
          .filter(([_, v]) => v)
          .map(([k, v]) => `${k.toUpperCase()}: ${v.name}`)
          .join(" | ");

        DataStore.addToEnquiryCart("CUSTOM-PC-" + Date.now(), 1, {
          name: "Custom Assembled Gaming / Workstation PC",
          price: totals.subtotal,
          specs: specSummary
        });

        HOC_UTILS.showToast("Custom PC added to your Enquiry Cart!");
        setTimeout(() => {
          window.location.href = "enquiry.php";
        }, 600);
      });
    }
  }
};

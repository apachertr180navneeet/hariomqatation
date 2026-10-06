@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Edit Product SKU</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                SKU: {{ $product->sku }}
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <a href="{{ route('admin.products') }}" class="text-decoration-none text-muted">Products Master</a>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">{{ $product->name }}</span>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.products.view', ['id' => $product->id]) }}" class="btn btn-outline-primary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-eye"></i>
            <span>View Inspection</span>
        </a>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Catalog</span>
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.update', $product->id) }}" id="editProductForm">
    @csrf
    @method('PUT')

    <!-- Step 1: General Product Information Card -->
    <div class="form-step-card">
        <div class="form-step-header">
            <div class="form-step-badge">1</div>
            <div>
                <h5 class="form-step-title">General Product Details & Classification</h5>
                <div class="form-step-desc">Modify product name, SKU codes, taxonomies, and hardware branding</div>
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold text-slate-800">Product Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control rounded-3 py-2" required value="{{ old('name', $product->name) }}" placeholder="e.g. Dell Inspiron 15 3520 Laptop">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">SKU Code <span class="text-danger">*</span></label>
                <input type="text" name="sku" class="form-control rounded-3 py-2 font-monospace" required value="{{ old('sku', $product->sku) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Barcode / EAN / UPC</label>
                <input type="text" name="barcode" class="form-control rounded-3 py-2 font-monospace" value="{{ old('barcode', $product->barcode) }}" placeholder="e.g. 890123456789">
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Category <span class="text-danger">*</span></label>
                <select name="category_id" id="category_select" class="form-select rounded-3 py-2" required onchange="updateSubcategories()">
                    <option value="">-- Choose Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Sub Category</label>
                <select name="subcategory_id" id="subcategory_select" class="form-select rounded-3 py-2">
                    <option value="">-- Select Subcategory --</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Hardware Brand <span class="text-danger">*</span></label>
                <select name="brand_id" class="form-select rounded-3 py-2" required>
                    <option value="">-- Choose Brand --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ (old('brand_id', $product->brand_id) == $brand->id) ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Manufacturer Model Number</label>
                <input type="text" name="model" class="form-control rounded-3 py-2" value="{{ old('model', $product->model) }}" placeholder="e.g. 15-eg3027TU / PRO H610M">
            </div>

            <div class="col-md-8">
                <label class="form-label small fw-bold text-slate-800">Specifications Summary <span class="text-danger">*</span></label>
                <input type="text" name="specs" class="form-control rounded-3 py-2" required value="{{ old('specs', $product->specs) }}" placeholder="Summary of CPU, RAM, Storage, Screen, GPU...">
                <div class="form-text small text-muted" style="font-size: 0.72rem;">This appears in quotations and invoice summaries.</div>
            </div>

            <div class="col-12">
                <label class="form-label small fw-bold text-slate-800">Detailed Technical Description & Box Inclusions</label>
                <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Storefront Featured SKU Card -->
            <div class="col-12 mt-3">
                <div class="toggle-setting-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="catalog-avatar-box bg-warning-subtle text-warning-emphasis border-warning-subtle" style="width: 44px; height: 44px; font-size: 1.25rem;">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <strong class="d-block text-slate-900 fs-6">Showcase as Featured SKU</strong>
                            <small class="text-muted">Highlight this product in homepage hero banners and recommended products showcase</small>
                        </div>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Pricing, Tax & Inventory Stock Card -->
    <div class="form-step-card">
        <div class="form-step-header">
            <div class="form-step-badge" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">2</div>
            <div>
                <h5 class="form-step-title">Commercial Pricing, Taxes & Physical Stock</h5>
                <div class="form-step-desc">Cost calculation, sales margin, GST rates, and inventory thresholds</div>
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Purchase Price (₹ Cost) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted">₹</span>
                    <input type="number" step="0.01" name="purchase_price" id="input_purchase_price" class="form-control py-2" required value="{{ old('purchase_price', $product->purchase_price) }}">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Selling Price (₹ Incl GST) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted">₹</span>
                    <input type="number" step="0.01" name="selling_price" id="input_selling_price" class="form-control py-2 fw-bold text-primary" required value="{{ old('selling_price', $product->selling_price) }}">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">MRP (₹ Max Retail Price)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted">₹</span>
                    <input type="number" step="0.01" name="mrp" id="input_mrp" class="form-control py-2" value="{{ old('mrp', $product->mrp) }}">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Applicable GST Rate (%) <span class="text-danger">*</span></label>
                <select name="gst_rate" class="form-select rounded-3 py-2" required>
                    <option value="18" {{ old('gst_rate', (int)$product->gst_rate) == 18 ? 'selected' : '' }}>18% (Standard Hardware & Peripherals)</option>
                    <option value="28" {{ old('gst_rate', (int)$product->gst_rate) == 28 ? 'selected' : '' }}>28% (Luxury Displays / Monitors &gt; 32")</option>
                    <option value="12" {{ old('gst_rate', (int)$product->gst_rate) == 12 ? 'selected' : '' }}>12% (Select Cables & Parts)</option>
                    <option value="0" {{ old('gst_rate', (int)$product->gst_rate) == 0 ? 'selected' : '' }}>0% (Exempt)</option>
                </select>
            </div>

            <!-- Dynamic Profit Margin Live Bar -->
            <div class="col-12">
                <div class="profit-calculator-bar">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success text-white p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <span class="text-muted small fw-bold text-uppercase d-block" style="font-size: 0.72rem;">Live Gross Profit Margin:</span>
                            <span id="live_profit_amount" class="fs-5 fw-extrabold text-success">₹0.00</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <div>
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">Markup Percentage:</span>
                            <span id="live_margin_pct" class="badge bg-success-subtle text-success border border-success-subtle fw-bold fs-7">0.0%</span>
                        </div>
                        <div>
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">Customer Discount:</span>
                            <span id="live_discount_pct" class="badge bg-primary-subtle text-primary border border-primary-subtle fw-bold fs-7">0.0% vs MRP</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Physical Stock Balance</label>
                <div class="input-group">
                    <input type="text" class="form-control rounded-3 py-2 bg-light fw-bold text-success" readonly value="{{ $product->stock }} Units">
                    <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-boxes me-1"></i> Ledger
                    </a>
                </div>
                <div class="form-text small text-muted" style="font-size: 0.72rem;">Stock balances are altered via inward/audit ledger.</div>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Minimum Stock Alert Threshold <span class="text-danger">*</span></label>
                <input type="number" name="min_stock" class="form-control rounded-3 py-2" required value="{{ old('min_stock', $product->min_stock) }}" min="1">
                <div class="form-text small text-muted" style="font-size: 0.72rem;">Triggers low stock warnings when reached.</div>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Warranty Period & Terms <span class="text-danger">*</span></label>
                <input type="text" name="warranty" class="form-control rounded-3 py-2" required value="{{ old('warranty', $product->warranty) }}">
            </div>
        </div>
    </div>

    <!-- Step 3: Hardware Compatibility Card -->
    <div class="form-step-card">
        <div class="form-step-header">
            <div class="form-step-badge" style="background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);">3</div>
            <div>
                <h5 class="form-step-title">Custom PC Builder & Rig Compatibility (Optional)</h5>
                <div class="form-step-desc">Define component roles for interactive custom PC configurator</div>
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Component Role</label>
                <select name="pcb_type" class="form-select rounded-3 py-2">
                    <option value="">-- Not Applicable / Complete Rig --</option>
                    <option value="cpu" {{ old('pcb_type', $product->pcb_type) == 'cpu' ? 'selected' : '' }}>Processor (CPU)</option>
                    <option value="motherboard" {{ old('pcb_type', $product->pcb_type) == 'motherboard' ? 'selected' : '' }}>Motherboard</option>
                    <option value="ram" {{ old('pcb_type', $product->pcb_type) == 'ram' ? 'selected' : '' }}>RAM Memory</option>
                    <option value="storage" {{ old('pcb_type', $product->pcb_type) == 'storage' ? 'selected' : '' }}>Storage (SSD / HDD)</option>
                    <option value="gpu" {{ old('pcb_type', $product->pcb_type) == 'gpu' ? 'selected' : '' }}>Graphics Card (GPU)</option>
                    <option value="psu" {{ old('pcb_type', $product->pcb_type) == 'psu' ? 'selected' : '' }}>Power Supply (SMPS)</option>
                    <option value="cabinet" {{ old('pcb_type', $product->pcb_type) == 'cabinet' ? 'selected' : '' }}>Cabinet Case</option>
                    <option value="cooler" {{ old('pcb_type', $product->pcb_type) == 'cooler' ? 'selected' : '' }}>CPU Cooler</option>
                    <option value="monitor" {{ old('pcb_type', $product->pcb_type) == 'monitor' ? 'selected' : '' }}>Monitor / Display</option>
                    <option value="peripherals" {{ old('pcb_type', $product->pcb_type) == 'peripherals' ? 'selected' : '' }}>Peripherals</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Socket</label>
                <input type="text" name="socket" class="form-control rounded-3 py-2" value="{{ old('socket', $product->socket) }}" placeholder="e.g. LGA1700, AM5">
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">RAM Gen</label>
                <input type="text" name="ram_type" class="form-control rounded-3 py-2" value="{{ old('ram_type', $product->ram_type) }}" placeholder="e.g. DDR4, DDR5">
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Wattage / Req (Watts)</label>
                <input type="number" name="wattage" class="form-control rounded-3 py-2" value="{{ old('wattage', $product->wattage) }}" placeholder="e.g. 650">
            </div>
        </div>
    </div>

    <!-- Submit Action Bar -->
    <div class="catalog-card p-4 shadow-sm d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="text-muted small">
            <i class="bi bi-clock-history text-primary me-1"></i> Last updated: {{ $product->updated_at->format('d M Y, h:i A') }}
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 fw-semibold">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary fw-bold px-4 py-2.5 shadow-sm rounded-3 d-flex align-items-center gap-2">
                <i class="bi bi-check-lg fs-5"></i>
                <span>Update Product SKU</span>
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    const categoryData = @json($categories->keyBy('id'));
    const currentSubcatId = "{{ old('subcategory_id', $product->subcategory_id) }}";

    function updateSubcategories() {
        const catSelect = document.getElementById('category_select');
        const subSelect = document.getElementById('subcategory_select');
        const catId = catSelect.value;

        subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

        if (catId && categoryData[catId] && categoryData[catId].subcategories) {
            categoryData[catId].subcategories.forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id;
                opt.text = sub.name;
                if (currentSubcatId && String(sub.id) === String(currentSubcatId)) {
                    opt.selected = true;
                }
                subSelect.appendChild(opt);
            });
        }
    }

    function calculateMargin() {
        const purchase = parseFloat(document.getElementById('input_purchase_price').value) || 0;
        const selling = parseFloat(document.getElementById('input_selling_price').value) || 0;
        const mrp = parseFloat(document.getElementById('input_mrp').value) || 0;

        const profit = selling - purchase;
        const marginPct = purchase > 0 ? ((profit / purchase) * 100).toFixed(1) : '0.0';
        const discountPct = mrp > selling && mrp > 0 ? (((mrp - selling) / mrp) * 100).toFixed(1) : '0.0';

        const profitElem = document.getElementById('live_profit_amount');
        const marginElem = document.getElementById('live_margin_pct');
        const discountElem = document.getElementById('live_discount_pct');

        if (profit >= 0) {
            profitElem.className = 'fs-5 fw-extrabold text-success';
            profitElem.innerText = '₹' + profit.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            marginElem.className = 'badge bg-success-subtle text-success border border-success-subtle fw-bold fs-7';
            marginElem.innerText = '+' + marginPct + '% markup';
        } else {
            profitElem.className = 'fs-5 fw-extrabold text-danger';
            profitElem.innerText = '-₹' + Math.abs(profit).toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            marginElem.className = 'badge bg-danger-subtle text-danger border border-danger-subtle fw-bold fs-7';
            marginElem.innerText = marginPct + '% loss';
        }

        discountElem.innerText = discountPct + '% vs MRP';
    }

    document.getElementById('input_purchase_price').addEventListener('input', calculateMargin);
    document.getElementById('input_selling_price').addEventListener('input', calculateMargin);
    document.getElementById('input_mrp').addEventListener('input', calculateMargin);

    document.addEventListener("DOMContentLoaded", () => {
        updateSubcategories();
        calculateMargin();
    });
</script>
@endpush

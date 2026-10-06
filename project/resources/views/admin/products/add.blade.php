@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Add Product SKU</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                Catalog Registry
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <a href="{{ route('admin.products') }}" class="text-decoration-none text-muted">Products Master</a>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">New Hardware Entry</span>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Catalog</span>
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.store') }}" id="addProductForm">
    @csrf

    <!-- Step 1: General Product Information Card -->
    <div class="form-step-card">
        <div class="form-step-header">
            <div class="form-step-badge">1</div>
            <div>
                <h5 class="form-step-title">General Product Details & Classification</h5>
                <div class="form-step-desc">Name, SKU codes, taxonomies, and hardware branding</div>
            </div>
        </div>
        
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold text-slate-800">Product Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control rounded-3 py-2" required value="{{ old('name') }}" placeholder="e.g. Dell Inspiron 15 3520 Laptop (Intel Core i5 12th Gen)">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">SKU Code</label>
                <input type="text" name="sku" class="form-control rounded-3 py-2 font-monospace" value="{{ old('sku') }}" placeholder="Auto-generated if left blank">
                <div class="form-text small text-muted" style="font-size: 0.72rem;">e.g. DELL-INSP-3520</div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Barcode / EAN / UPC</label>
                <input type="text" name="barcode" class="form-control rounded-3 py-2 font-monospace" value="{{ old('barcode') }}" placeholder="e.g. 890123456789">
            </div>

            <div class="col-md-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-bold text-slate-800 mb-0">Category <span class="text-danger">*</span></label>
                    <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none fw-bold small text-primary" data-bs-toggle="modal" data-bs-target="#quickAddCategoryModal">
                        <i class="bi bi-plus-circle me-1"></i>New Category
                    </button>
                </div>
                <select name="category_id" id="category_select" class="form-select rounded-3 py-2" required onchange="updateSubcategories()">
                    <option value="">-- Choose Category --</option>
                    @forelse($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @empty
                        <option value="" disabled id="empty_cat_opt">No categories yet. Click '+ New Category'.</option>
                    @endforelse
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Sub Category</label>
                <select name="subcategory_id" id="subcategory_select" class="form-select rounded-3 py-2">
                    <option value="">-- Select Subcategory --</option>
                </select>
            </div>

            <div class="col-md-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-bold text-slate-800 mb-0">Hardware Brand <span class="text-danger">*</span></label>
                    <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none fw-bold small text-primary" data-bs-toggle="modal" data-bs-target="#quickAddBrandModal">
                        <i class="bi bi-plus-circle me-1"></i>New Brand
                    </button>
                </div>
                <select name="brand_id" id="brand_select" class="form-select rounded-3 py-2" required>
                    <option value="">-- Choose Brand --</option>
                    @forelse($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @empty
                        <option value="" disabled id="empty_brand_opt">No brands yet. Click '+ New Brand'.</option>
                    @endforelse
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Manufacturer Model Number</label>
                <input type="text" name="model" class="form-control rounded-3 py-2" value="{{ old('model') }}" placeholder="e.g. 15-eg3027TU / PRO H610M-E">
            </div>

            <div class="col-md-8">
                <label class="form-label small fw-bold text-slate-800">Specifications Summary <span class="text-danger">*</span></label>
                <input type="text" name="specs" class="form-control rounded-3 py-2" required value="{{ old('specs') }}" placeholder="e.g. Intel Core i5 12th Gen | 16GB DDR4 RAM | 512GB NVMe SSD | 15.6 FHD 120Hz">
                <div class="form-text small text-muted" style="font-size: 0.72rem;">This appears in quotations and invoice summaries.</div>
            </div>

            <div class="col-12">
                <label class="form-label small fw-bold text-slate-800">Detailed Technical Description & Box Inclusions</label>
                <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Enter complete hardware datasheet, ports, display characteristics, bundled accessories, etc.">{{ old('description') }}</textarea>
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
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
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
                    <input type="number" step="0.01" name="purchase_price" id="input_purchase_price" class="form-control py-2" required value="{{ old('purchase_price', 0) }}" placeholder="42000">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Selling Price (₹ Incl GST) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted">₹</span>
                    <input type="number" step="0.01" name="selling_price" id="input_selling_price" class="form-control py-2 fw-bold text-primary" required value="{{ old('selling_price', 0) }}" placeholder="47990">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">MRP (₹ Max Retail Price)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted">₹</span>
                    <input type="number" step="0.01" name="mrp" id="input_mrp" class="form-control py-2" value="{{ old('mrp') }}" placeholder="58990">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Applicable GST Rate (%) <span class="text-danger">*</span></label>
                <select name="gst_rate" class="form-select rounded-3 py-2" required>
                    <option value="18" {{ old('gst_rate', 18) == 18 ? 'selected' : '' }}>18% (Standard Hardware & Peripherals)</option>
                    <option value="28" {{ old('gst_rate') == 28 ? 'selected' : '' }}>28% (Luxury Displays / Monitors &gt; 32")</option>
                    <option value="12" {{ old('gst_rate') == 12 ? 'selected' : '' }}>12% (Select Cables & Parts)</option>
                    <option value="0" {{ old('gst_rate') == 0 ? 'selected' : '' }}>0% (Exempt)</option>
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
                <label class="form-label small fw-bold text-slate-800">Opening Stock Quantity <span class="text-danger">*</span></label>
                <input type="number" name="stock" class="form-control rounded-3 py-2" required value="{{ old('stock', 10) }}" min="0">
                <div class="form-text small text-muted" style="font-size: 0.72rem;">Recorded as opening balance transaction.</div>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Minimum Stock Alert Threshold <span class="text-danger">*</span></label>
                <input type="number" name="min_stock" class="form-control rounded-3 py-2" required value="{{ old('min_stock', 3) }}" min="1">
                <div class="form-text small text-muted" style="font-size: 0.72rem;">Triggers low stock warnings when reached.</div>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold text-slate-800">Warranty Period & Terms <span class="text-danger">*</span></label>
                <input type="text" name="warranty" class="form-control rounded-3 py-2" required value="{{ old('warranty', '1 Year Onsite Manufacturer Warranty') }}">
            </div>
        </div>
    </div>

    <!-- Step 3: Hardware Compatibility & Custom PC Builder Card -->
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
                    <option value="cpu" {{ old('pcb_type') == 'cpu' ? 'selected' : '' }}>Processor (CPU)</option>
                    <option value="motherboard" {{ old('pcb_type') == 'motherboard' ? 'selected' : '' }}>Motherboard</option>
                    <option value="ram" {{ old('pcb_type') == 'ram' ? 'selected' : '' }}>RAM Memory</option>
                    <option value="storage" {{ old('pcb_type') == 'storage' ? 'selected' : '' }}>Storage (SSD / HDD)</option>
                    <option value="gpu" {{ old('pcb_type') == 'gpu' ? 'selected' : '' }}>Graphics Card (GPU)</option>
                    <option value="psu" {{ old('pcb_type') == 'psu' ? 'selected' : '' }}>Power Supply (SMPS)</option>
                    <option value="cabinet" {{ old('pcb_type') == 'cabinet' ? 'selected' : '' }}>Cabinet Case</option>
                    <option value="cooler" {{ old('pcb_type') == 'cooler' ? 'selected' : '' }}>CPU Cooler</option>
                    <option value="monitor" {{ old('pcb_type') == 'monitor' ? 'selected' : '' }}>Monitor / Display</option>
                    <option value="peripherals" {{ old('pcb_type') == 'peripherals' ? 'selected' : '' }}>Peripherals</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Socket (CPU / Mobo)</label>
                <input type="text" name="socket" class="form-control rounded-3 py-2" value="{{ old('socket') }}" placeholder="e.g. LGA1700, AM5, AM4">
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">RAM Gen</label>
                <input type="text" name="ram_type" class="form-control rounded-3 py-2" value="{{ old('ram_type') }}" placeholder="e.g. DDR4, DDR5">
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold text-slate-800">Wattage / Req (Watts)</label>
                <input type="number" name="wattage" class="form-control rounded-3 py-2" value="{{ old('wattage') }}" placeholder="e.g. 650">
            </div>
        </div>
    </div>

    <!-- Form Submit Actions Bar -->
    <div class="catalog-card p-4 shadow-sm d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="text-muted small">
            <i class="bi bi-shield-check text-success me-1"></i> Changes will immediately take effect across the ERP and customer storefront.
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 fw-semibold">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary fw-bold px-4 py-2.5 shadow-sm rounded-3 d-flex align-items-center gap-2">
                <i class="bi bi-check-lg fs-5"></i>
                <span>Save Product to Catalog</span>
            </button>
        </div>
    </div>
</form>

<!-- Modal: Quick Add Category -->
<div class="modal fade" id="quickAddCategoryModal" tabindex="-1" aria-labelledby="quickAddCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form id="quickCategoryForm">
                @csrf
                <div class="modal-header bg-primary text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-25 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-tags fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="quickAddCategoryModalLabel">Quick Add Category</h5>
                            <small class="text-white-50">Create master classification</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="quick_cat_name" name="name" class="form-control rounded-3 py-2" required placeholder="e.g. Laptops, Processors, Monitors">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Bootstrap Icon Class</label>
                        <input type="text" id="quick_cat_icon" name="icon" class="form-control rounded-3 py-2" value="bi-tags" placeholder="e.g. bi-laptop, bi-cpu">
                    </div>
                    <input type="hidden" name="status" value="active">
                    <div id="quick_cat_msg" class="small"></div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm" onclick="submitQuickCategory()">
                        <i class="bi bi-check-lg me-1"></i> Save & Select
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Quick Add Brand -->
<div class="modal fade" id="quickAddBrandModal" tabindex="-1" aria-labelledby="quickAddBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form id="quickBrandForm">
                @csrf
                <div class="modal-header bg-primary text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-25 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-award fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="quickAddBrandModalLabel">Quick Add Brand</h5>
                            <small class="text-white-50">Create hardware partner</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" id="quick_brand_name" name="name" class="form-control rounded-3 py-2" required placeholder="e.g. Dell, HP, Intel, ASUS">
                    </div>
                    <input type="hidden" name="status" value="active">
                    <div id="quick_brand_msg" class="small"></div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm" onclick="submitQuickBrand()">
                        <i class="bi bi-check-lg me-1"></i> Save & Select
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const categoryData = @json($categories->keyBy('id'));
    const oldSubcat = "{{ old('subcategory_id') }}";

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
                if (oldSubcat && String(sub.id) === String(oldSubcat)) {
                    opt.selected = true;
                }
                subSelect.appendChild(opt);
            });
        }
    }

    // Live Margin & Profit Calculator
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

    function submitQuickCategory() {
        const nameInput = document.getElementById('quick_cat_name');
        const iconInput = document.getElementById('quick_cat_icon');
        const msgDiv = document.getElementById('quick_cat_msg');
        
        if (!nameInput.value.trim()) {
            msgDiv.innerHTML = '<span class="text-danger">Category name is required.</span>';
            return;
        }

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', nameInput.value.trim());
        formData.append('icon', iconInput.value.trim() || 'bi-tags');
        formData.append('status', 'active');

        fetch("{{ route('admin.categories.store') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.category) {
                const select = document.getElementById('category_select');
                const emptyOpt = document.getElementById('empty_cat_opt');
                if (emptyOpt) emptyOpt.remove();

                const opt = document.createElement('option');
                opt.value = data.category.id;
                opt.text = data.category.name;
                opt.selected = true;
                select.appendChild(opt);

                categoryData[data.category.id] = data.category;
                categoryData[data.category.id].subcategories = [];
                updateSubcategories();

                nameInput.value = '';
                msgDiv.innerHTML = '';
                bootstrap.Modal.getInstance(document.getElementById('quickAddCategoryModal')).hide();
            } else {
                msgDiv.innerHTML = '<span class="text-danger">' + (data.message || 'Error creating category.') + '</span>';
            }
        })
        .catch(err => {
            msgDiv.innerHTML = '<span class="text-danger">Error saving category. Check if name already exists.</span>';
        });
    }

    function submitQuickBrand() {
        const nameInput = document.getElementById('quick_brand_name');
        const msgDiv = document.getElementById('quick_brand_msg');
        
        if (!nameInput.value.trim()) {
            msgDiv.innerHTML = '<span class="text-danger">Brand name is required.</span>';
            return;
        }

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('name', nameInput.value.trim());
        formData.append('status', 'active');

        fetch("{{ route('admin.brands.store') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.brand) {
                const select = document.getElementById('brand_select');
                const emptyOpt = document.getElementById('empty_brand_opt');
                if (emptyOpt) emptyOpt.remove();

                const opt = document.createElement('option');
                opt.value = data.brand.id;
                opt.text = data.brand.name;
                opt.selected = true;
                select.appendChild(opt);

                nameInput.value = '';
                msgDiv.innerHTML = '';
                bootstrap.Modal.getInstance(document.getElementById('quickAddBrandModal')).hide();
            } else {
                msgDiv.innerHTML = '<span class="text-danger">' + (data.message || 'Error creating brand.') + '</span>';
            }
        })
        .catch(err => {
            msgDiv.innerHTML = '<span class="text-danger">Error saving brand. Check if name already exists.</span>';
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (document.getElementById('category_select').value) {
            updateSubcategories();
        }
        calculateMargin();
    });
</script>
@endpush

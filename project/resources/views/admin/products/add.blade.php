@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Create Product Entry</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.products') }}">Products</a> &bull; <span>New Hardware SKU</span>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Catalog
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

    <!-- General Product Information Card -->
    <div class="admin-card p-4 mb-4 shadow-sm">
        <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-info-circle me-2"></i> General Product Information</h5>
        
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold">Product Name *</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="e.g. Dell Inspiron 15 3520 Laptop">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">SKU Code (Auto-generated if blank)</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="e.g. DELL-INSP-3520">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Barcode / EAN</label>
                <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}" placeholder="e.g. 890123456789">
            </div>

            <div class="col-md-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-bold mb-0">Category *</label>
                    <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none fw-semibold" data-bs-toggle="modal" data-bs-target="#quickAddCategoryModal">
                        <i class="bi bi-plus-circle me-1"></i>New Category
                    </button>
                </div>
                <select name="category_id" id="category_select" class="form-select" required onchange="updateSubcategories()">
                    <option value="">-- Select Category --</option>
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
                <label class="form-label small fw-bold">Sub Category</label>
                <select name="subcategory_id" id="subcategory_select" class="form-select">
                    <option value="">-- Select Subcategory --</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-bold mb-0">Brand *</label>
                    <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none fw-semibold" data-bs-toggle="modal" data-bs-target="#quickAddBrandModal">
                        <i class="bi bi-plus-circle me-1"></i>New Brand
                    </button>
                </div>
                <select name="brand_id" id="brand_select" class="form-select" required>
                    <option value="">-- Select Brand --</option>
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
                <label class="form-label small fw-bold">Model Number</label>
                <input type="text" name="model" class="form-control" value="{{ old('model') }}" placeholder="e.g. 15-eg3027TU / PRO H610M">
            </div>

            <div class="col-md-8">
                <label class="form-label small fw-bold">Key Specifications Summary *</label>
                <input type="text" name="specs" class="form-control" required value="{{ old('specs') }}" placeholder="e.g. Intel Core i5 12th Gen | 16GB DDR4 | 512GB SSD | 15.6 FHD 120Hz">
            </div>

            <div class="col-12">
                <label class="form-label small fw-bold">Detailed Technical Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Full technical datasheet & package inclusions...">{{ old('description') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Pricing & Inventory Stock Card -->
    <div class="admin-card p-4 mb-4 shadow-sm">
        <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-currency-rupee me-2"></i> Pricing, Tax & Inventory</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Purchase Price (Excl/Incl ₹) *</label>
                <input type="number" step="0.01" name="purchase_price" class="form-control" required value="{{ old('purchase_price', 0) }}" placeholder="42000">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Selling Price (Incl GST ₹) *</label>
                <input type="number" step="0.01" name="selling_price" class="form-control" required value="{{ old('selling_price', 0) }}" placeholder="47990">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">MRP (₹)</label>
                <input type="number" step="0.01" name="mrp" class="form-control" value="{{ old('mrp') }}" placeholder="58990">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">GST Rate (%) *</label>
                <select name="gst_rate" class="form-select" required>
                    <option value="18" {{ old('gst_rate', 18) == 18 ? 'selected' : '' }}>18% (Standard Computer Hardware)</option>
                    <option value="28" {{ old('gst_rate') == 28 ? 'selected' : '' }}>28% (Monitors >32" / Luxury)</option>
                    <option value="12" {{ old('gst_rate') == 12 ? 'selected' : '' }}>12%</option>
                    <option value="0" {{ old('gst_rate') == 0 ? 'selected' : '' }}>0% (Exempt)</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold">Opening Stock Qty *</label>
                <input type="number" name="stock" class="form-control" required value="{{ old('stock', 10) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Minimum Stock Alert Threshold *</label>
                <input type="number" name="min_stock" class="form-control" required value="{{ old('min_stock', 3) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Warranty Period *</label>
                <input type="text" name="warranty" class="form-control" required value="{{ old('warranty', '1 Year Onsite Warranty') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Catalog Status *</label>
                <select name="status" class="form-select" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Hardware Compatibility & PC Builder Options Card -->
    <div class="admin-card p-4 mb-4 shadow-sm">
        <h5 class="admin-card-title mb-3 text-secondary"><i class="bi bi-motherboard me-2"></i> Custom PC Builder Specs (Optional)</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Component Type (PCB Role)</label>
                <select name="pcb_type" class="form-select">
                    <option value="">-- Not Applicable / System --</option>
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
                <label class="form-label small fw-bold">Socket (CPU / Mobo)</label>
                <input type="text" name="socket" class="form-control" value="{{ old('socket') }}" placeholder="e.g. LGA1700, AM5">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">RAM Memory Gen</label>
                <input type="text" name="ram_type" class="form-control" value="{{ old('ram_type') }}" placeholder="DDR4, DDR5">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Wattage / Req (Watts)</label>
                <input type="number" name="wattage" class="form-control" value="{{ old('wattage') }}" placeholder="e.g. 650">
            </div>
            <div class="col-md-2 d-flex align-items-center mt-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label small fw-bold" for="is_featured">Featured Product</label>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
            <i class="bi bi-check-lg me-1"></i> Save Product to Catalog
        </button>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary py-2">Cancel</a>
    </div>
</form>

<!-- Modal: Quick Add Category -->
<div class="modal fade" id="quickAddCategoryModal" tabindex="-1" aria-labelledby="quickAddCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="quickCategoryForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="quickAddCategoryModalLabel"><i class="bi bi-tags text-primary me-2"></i>Quick Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name *</label>
                        <input type="text" id="quick_cat_name" name="name" class="form-control" required placeholder="e.g. Laptops, Processors, Monitors">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Bootstrap Icon Class</label>
                        <input type="text" id="quick_cat_icon" name="icon" class="form-control" value="bi-tags" placeholder="e.g. bi-laptop, bi-cpu">
                    </div>
                    <input type="hidden" name="status" value="active">
                    <div id="quick_cat_msg" class="small"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary fw-bold" onclick="submitQuickCategory()"><i class="bi bi-check-lg me-1"></i>Save & Select</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Quick Add Brand -->
<div class="modal fade" id="quickAddBrandModal" tabindex="-1" aria-labelledby="quickAddBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="quickBrandForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="quickAddBrandModalLabel"><i class="bi bi-award text-primary me-2"></i>Quick Add Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Brand Name *</label>
                        <input type="text" id="quick_brand_name" name="name" class="form-control" required placeholder="e.g. Dell, HP, Intel, ASUS">
                    </div>
                    <input type="hidden" name="status" value="active">
                    <div id="quick_brand_msg" class="small"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary fw-bold" onclick="submitQuickBrand()"><i class="bi bi-check-lg me-1"></i>Save & Select</button>
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
    });
</script>
@endpush

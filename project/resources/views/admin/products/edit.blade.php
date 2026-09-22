@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Product SKU</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.products') }}">Products</a> &bull; <span>{{ $product->name }} ({{ $product->sku }})</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.view', ['id' => $product->id]) }}" class="btn btn-outline-primary">
            <i class="bi bi-eye me-1"></i> View Inspection
        </a>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Catalog
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.update', $product->id) }}">
    @csrf
    @method('PUT')

    <!-- General Product Information Card -->
    <div class="admin-card p-4 mb-4 shadow-sm">
        <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-info-circle me-2"></i> General Product Information</h5>
        
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold">Product Name *</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">SKU Code *</label>
                <input type="text" name="sku" class="form-control" required value="{{ old('sku', $product->sku) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Barcode / EAN</label>
                <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $product->barcode) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold">Category *</label>
                <select name="category_id" id="category_select" class="form-select" required onchange="updateSubcategories()">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Sub Category</label>
                <select name="subcategory_id" id="subcategory_select" class="form-select">
                    <option value="">-- Select Subcategory --</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Brand *</label>
                <select name="brand_id" class="form-select" required>
                    <option value="">-- Select Brand --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ (old('brand_id', $product->brand_id) == $brand->id) ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold">Model Number</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $product->model) }}">
            </div>

            <div class="col-md-8">
                <label class="form-label small fw-bold">Key Specifications Summary *</label>
                <input type="text" name="specs" class="form-control" required value="{{ old('specs', $product->specs) }}">
            </div>

            <div class="col-12">
                <label class="form-label small fw-bold">Detailed Technical Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>
    </div>

    <!-- Pricing & Inventory Stock Card -->
    <div class="admin-card p-4 mb-4 shadow-sm">
        <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-currency-rupee me-2"></i> Pricing, Tax & Inventory</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Purchase Price (Excl/Incl ₹) *</label>
                <input type="number" step="0.01" name="purchase_price" class="form-control" required value="{{ old('purchase_price', $product->purchase_price) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Selling Price (Incl GST ₹) *</label>
                <input type="number" step="0.01" name="selling_price" class="form-control" required value="{{ old('selling_price', $product->selling_price) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">MRP (₹)</label>
                <input type="number" step="0.01" name="mrp" class="form-control" value="{{ old('mrp', $product->mrp) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">GST Rate (%) *</label>
                <select name="gst_rate" class="form-select" required>
                    <option value="18" {{ old('gst_rate', (int)$product->gst_rate) == 18 ? 'selected' : '' }}>18% (Standard Computer Hardware)</option>
                    <option value="28" {{ old('gst_rate', (int)$product->gst_rate) == 28 ? 'selected' : '' }}>28% (Monitors >32" / Luxury)</option>
                    <option value="12" {{ old('gst_rate', (int)$product->gst_rate) == 12 ? 'selected' : '' }}>12%</option>
                    <option value="0" {{ old('gst_rate', (int)$product->gst_rate) == 0 ? 'selected' : '' }}>0% (Exempt)</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold">Physical Stock Balance</label>
                <input type="text" class="form-control bg-light fw-bold text-success" readonly value="{{ $product->stock }} Units">
                <small class="text-muted">Use the <a href="{{ route('admin.inventory') }}">Stock Ledger</a> to adjust inventory.</small>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Minimum Stock Alert Threshold *</label>
                <input type="number" name="min_stock" class="form-control" required value="{{ old('min_stock', $product->min_stock) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Warranty Period *</label>
                <input type="text" name="warranty" class="form-control" required value="{{ old('warranty', $product->warranty) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Catalog Status *</label>
                <select name="status" class="form-select" required>
                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="out_of_stock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Hardware Compatibility Card -->
    <div class="admin-card p-4 mb-4 shadow-sm">
        <h5 class="admin-card-title mb-3 text-secondary"><i class="bi bi-motherboard me-2"></i> Custom PC Builder Specs</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Component Type (PCB Role)</label>
                <select name="pcb_type" class="form-select">
                    <option value="">-- Not Applicable / System --</option>
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
                <label class="form-label small fw-bold">Socket</label>
                <input type="text" name="socket" class="form-control" value="{{ old('socket', $product->socket) }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">RAM Gen</label>
                <input type="text" name="ram_type" class="form-control" value="{{ old('ram_type', $product->ram_type) }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Wattage / Req</label>
                <input type="number" name="wattage" class="form-control" value="{{ old('wattage', $product->wattage) }}">
            </div>
            <div class="col-md-2 d-flex align-items-center mt-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label small fw-bold" for="is_featured">Featured</label>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3">
        <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
            <i class="bi bi-check-lg me-1"></i> Update Product
        </button>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary py-2">Cancel</a>
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

    document.addEventListener("DOMContentLoaded", () => {
        updateSubcategories();
    });
</script>
@endpush

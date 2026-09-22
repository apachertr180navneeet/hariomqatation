@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Create Product Entry</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.products') }}">Products</a> &bull; <span>New Hardware SKU</span>
        </div>
    </div>
</div>

<form id="add-product-form" onsubmit="event.preventDefault(); saveNewProduct();">
    <div class="admin-card p-4 mb-4">
        <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-info-circle me-2"></i> General Product Information</h5>
        
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold">Product Name *</label>
                <input type="text" id="p-name" class="form-control" required placeholder="e.g. Dell Inspiron 15 3520 Laptop">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">SKU Code *</label>
                <input type="text" id="p-sku" class="form-control" required placeholder="e.g. DELL-INSP-3520">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Barcode / EAN</label>
                <input type="text" id="p-barcode" class="form-control" placeholder="e.g. 890123456789">
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-bold">Category *</label>
                <select id="p-category" class="form-select" required>
                    <option value="Laptops">Laptops</option>
                    <option value="Desktop Computers">Desktop Computers</option>
                    <option value="Components">Components</option>
                    <option value="Display & Monitors">Display & Monitors</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Networking">Networking</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Sub Category</label>
                <input type="text" id="p-subcategory" class="form-control" placeholder="e.g. Student Laptop / Processor / SSD">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Brand *</label>
                <select id="p-brand" class="form-select" required>
                    <option value="Dell">Dell</option>
                    <option value="HP">HP</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="ASUS">ASUS</option>
                    <option value="Acer">Acer</option>
                    <option value="Intel">Intel</option>
                    <option value="AMD">AMD</option>
                    <option value="NVIDIA">NVIDIA</option>
                    <option value="Kingston">Kingston</option>
                    <option value="Samsung">Samsung</option>
                    <option value="Corsair">Corsair</option>
                    <option value="Logitech">Logitech</option>
                    <option value="TP-Link">TP-Link</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label small fw-bold">Key Specifications Summary *</label>
                <input type="text" id="p-specs" class="form-control" required placeholder="e.g. Intel Core i5 12th Gen | 16GB DDR4 | 512GB SSD | 15.6 FHD 120Hz">
            </div>

            <div class="col-12">
                <label class="form-label small fw-bold">Detailed Description</label>
                <textarea id="p-description" class="form-control" rows="3" placeholder="Full technical datasheet & inclusions..."></textarea>
            </div>
        </div>
    </div>

    <!-- Pricing & Stock Card -->
    <div class="admin-card p-4 mb-4">
        <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-currency-rupee me-2"></i> Pricing, Tax & Inventory</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Purchase Price (₹) *</label>
                <input type="number" id="p-purchase" class="form-control" required placeholder="42000">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Selling Price (Incl GST) *</label>
                <input type="number" id="p-selling" class="form-control" required placeholder="47990">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">MRP (₹)</label>
                <input type="number" id="p-mrp" class="form-control" placeholder="58990">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">GST Rate (%)</label>
                <select id="p-gst" class="form-select">
                    <option value="18" selected>18% (Standard Computer Hardware)</option>
                    <option value="28">28% (Monitors &gt;32" / Luxury)</option>
                    <option value="12">12%</option>
                    <option value="0">0% (Exempt)</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-bold">Opening Stock Qty *</label>
                <input type="number" id="p-stock" class="form-control" required value="10">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Minimum Stock Alert</label>
                <input type="number" id="p-minstock" class="form-control" value="3">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Warranty Period</label>
                <input type="text" id="p-warranty" class="form-control" value="1 Year Onsite Warranty">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Status</label>
                <select id="p-status" class="form-select">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
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
@endsection

@push('scripts')
<script>
    function saveNewProduct() {
        const data = DataStore.get();
        const newProd = {
            id: `PROD-${Date.now().toString().slice(-4)}`,
            name: document.getElementById("p-name").value.trim(),
            sku: document.getElementById("p-sku").value.trim(),
            category: document.getElementById("p-category").value,
            subcategory: document.getElementById("p-subcategory").value.trim() || document.getElementById("p-category").value,
            brand: document.getElementById("p-brand").value,
            specs: document.getElementById("p-specs").value.trim(),
            purchasePrice: Number(document.getElementById("p-purchase").value) || 0,
            sellingPrice: Number(document.getElementById("p-selling").value) || 0,
            mrp: Number(document.getElementById("p-mrp").value) || 0,
            gstRate: Number(document.getElementById("p-gst").value) || 18,
            stock: Number(document.getElementById("p-stock").value) || 0,
            minStock: Number(document.getElementById("p-minstock").value) || 2,
            warranty: document.getElementById("p-warranty").value,
            status: document.getElementById("p-status").value,
            rating: 4.8
        };

        if (!data.products) data.products = [];
        data.products.unshift(newProd);
        DataStore.save(data);

        HOC_UTILS.showToast(`Product ${newProd.name} added successfully!`);
        setTimeout(() => {
            const redirectUrl = window.HOC_ADMIN_ROUTES?.products || "{{ route('admin.products') }}";
            window.location.href = redirectUrl;
        }, 700);
    }
</script>
@endpush

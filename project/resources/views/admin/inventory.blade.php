@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Stock Ledger & Inventory Management</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Physical Stock vs Reorder Level</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#generalInwardModal">
            <i class="bi bi-plus-circle me-1"></i> Stock In / Inward
        </button>
        <button type="button" class="btn btn-outline-secondary fw-semibold" data-bs-toggle="modal" data-bs-target="#generalAdjustModal">
            <i class="bi bi-sliders me-1"></i> Physical Count Audit
        </button>
    </div>
</div>

<!-- KPI Metrics Cards Row -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 shadow-sm border-start border-primary border-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Total Catalog SKUs</span>
                    <h3 class="fw-bold mb-0 text-slate-900 mt-1">{{ $totalSkus }}</h3>
                </div>
                <div class="bg-primary-subtle text-primary p-3 rounded-circle fs-4">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 shadow-sm border-start border-success border-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Total Stock Units</span>
                    <h3 class="fw-bold mb-0 text-success mt-1">{{ number_format($totalUnits) }}</h3>
                </div>
                <div class="bg-success-subtle text-success p-3 rounded-circle fs-4">
                    <i class="bi bi-boxes"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 shadow-sm border-start border-info border-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Inventory Valuation</span>
                    <h4 class="fw-bold mb-0 text-slate-900 mt-1">₹{{ number_format($totalInventoryValue, 2) }}</h4>
                    <small class="text-muted" style="font-size: 0.72rem;">At Purchase Cost</small>
                </div>
                <div class="bg-info-subtle text-info p-3 rounded-circle fs-4">
                    <i class="bi bi-currency-rupee"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-card p-3 shadow-sm border-start {{ $lowStockCount > 0 ? 'border-warning' : 'border-secondary' }} border-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase">Low Stock Reorder Alerts</span>
                    <h3 class="fw-bold mb-0 text-warning mt-1">{{ $lowStockCount }}</h3>
                    <small class="text-danger" style="font-size: 0.72rem;">{{ $outOfStockCount }} Out of Stock</small>
                </div>
                <div class="bg-warning-subtle text-warning p-3 rounded-circle fs-4">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search Bar -->
<div class="admin-card mb-4 shadow-sm">
    <div class="p-3 border-bottom bg-light bg-opacity-25">
        <form method="GET" action="{{ route('admin.inventory') }}" class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ $currentSearch }}" class="form-control" placeholder="Search by SKU, Product Name, Brand...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="ALL">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string)$currentCategory === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="ALL" {{ $currentStatus === 'ALL' ? 'selected' : '' }}>All Stock Levels</option>
                    <option value="low_stock" {{ $currentStatus === 'low_stock' ? 'selected' : '' }}>⚠️ Low Stock (&le; Min)</option>
                    <option value="out_of_stock" {{ $currentStatus === 'out_of_stock' ? 'selected' : '' }}>❌ Out of Stock (0)</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-primary flex-grow-1">Filter</button>
                <a href="{{ route('admin.inventory') }}" class="btn btn-sm btn-outline-secondary" title="Reset Filters"><i class="bi bi-arrow-clockwise"></i></a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Product & SKU</th>
                    <th>Category</th>
                    <th>Cost (₹)</th>
                    <th class="text-center">Current Stock</th>
                    <th class="text-center">Min Alert</th>
                    <th>Inventory Status</th>
                    <th class="text-end">Quick Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    @php
                        $isLow = $p->stock <= $p->min_stock;
                        $isOut = $p->stock <= 0;
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light rounded p-2 text-center" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi {{ $p->category->icon ?? 'bi-box' }} text-primary fs-5"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="fw-bold text-slate-900 text-decoration-none d-block">
                                        {{ $p->name }}
                                    </a>
                                    <small class="text-muted">
                                        SKU: <code class="text-primary">{{ $p->sku }}</code> &bull; Brand: <strong>{{ $p->brand->name ?? 'Generic' }}</strong>
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $p->category->name ?? '-' }}</span></td>
                        <td class="text-slate-800 fw-semibold">₹{{ number_format($p->purchase_price, 2) }}</td>
                        <td class="text-center">
                            <span class="fw-bold fs-6 {{ $isOut ? 'text-danger' : ($isLow ? 'text-warning text-dark' : 'text-success') }}">
                                {{ $p->stock }}
                            </span>
                            <small class="text-muted d-block" style="font-size: 0.72rem;">Units</small>
                        </td>
                        <td class="text-center text-muted fw-semibold">{{ $p->min_stock }}</td>
                        <td>
                            @if($isOut)
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i> Out of Stock
                                </span>
                            @elseif($isLow)
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Low Stock
                                </span>
                            @else
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i> Healthy
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-success" 
                                        onclick="triggerInward({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->purchase_price }})"
                                        title="Stock Inward (+Units)">
                                    <i class="bi bi-plus-lg"></i> Inward
                                </button>
                                <button type="button" class="btn btn-outline-warning text-dark" 
                                        onclick="triggerAdjust({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->stock }})"
                                        title="Physical Count Adjust">
                                    <i class="bi bi-sliders"></i>
                                </button>
                                <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="btn btn-outline-secondary" title="View Full Ledger">
                                    <i class="bi bi-clock-history"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-boxes display-5 d-block mb-2"></i>
                            No products match the selected filters.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} stock items</small>
            <div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

<!-- Modal: Quick Inward for specific or selected product -->
<div class="modal fade" id="inwardModal" tabindex="-1" aria-labelledby="inwardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.inventory.inward') }}">
                @csrf
                <input type="hidden" name="product_id" id="modal_inward_prod_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="inwardModalLabel"><i class="bi bi-box-arrow-in-down text-success me-2"></i>Inward Stock Receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 bg-light rounded mb-3">
                        <small class="text-muted d-block">Target Product:</small>
                        <strong class="text-dark fs-6" id="modal_inward_prod_name"></strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Quantity to Inward *</label>
                        <input type="number" name="quantity" class="form-control" min="1" required value="5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Supplier Invoice / PO Reference</label>
                        <input type="text" name="reference_no" class="form-control" placeholder="e.g. RPTECH/JAI/44892">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Unit Purchase Cost (₹)</label>
                        <input type="number" step="0.01" name="unit_cost" id="modal_inward_unit_cost" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notes</label>
                        <input type="text" name="notes" class="form-control" placeholder="Supplier inwards delivery batch...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success fw-bold"><i class="bi bi-check-lg me-1"></i>Confirm Inward</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Quick Adjust for specific product -->
<div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.inventory.adjust') }}">
                @csrf
                <input type="hidden" name="product_id" id="modal_adjust_prod_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="adjustModalLabel"><i class="bi bi-sliders text-warning me-2"></i>Physical Count Adjustment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 bg-light rounded mb-3">
                        <small class="text-muted d-block">Target Product:</small>
                        <strong class="text-dark fs-6" id="modal_adjust_prod_name"></strong>
                        <div class="small text-muted mt-1">Current Ledger: <strong id="modal_adjust_curr_stock" class="text-primary"></strong> units</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Actual Physical Shelf Count *</label>
                        <input type="number" name="new_stock" id="modal_adjust_new_stock" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Reason for Adjustment *</label>
                        <input type="text" name="reason" class="form-control" required placeholder="e.g. Month-end physical audit / damaged unit write-off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning fw-bold"><i class="bi bi-check-lg me-1"></i>Save Adjustment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- General Inward Modal (with product selector dropdown) -->
<div class="modal fade" id="generalInwardModal" tabindex="-1" aria-labelledby="generalInwardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.inventory.inward') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="generalInwardModalLabel"><i class="bi bi-box-arrow-in-down text-primary me-2"></i>Stock Inward / Vendor Receiving</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Hardware SKU *</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">-- Choose Product --</option>
                            @foreach($allProducts as $ap)
                                <option value="{{ $ap->id }}">{{ $ap->name }} (SKU: {{ $ap->sku }} | Current: {{ $ap->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Inward Quantity to Add *</label>
                        <input type="number" name="quantity" class="form-control" min="1" required value="5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Supplier Invoice Number</label>
                        <input type="text" name="reference_no" class="form-control" placeholder="e.g. INV-VENDOR-2026-9901">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Unit Cost (₹)</label>
                        <input type="number" step="0.01" name="unit_cost" class="form-control" placeholder="Leave empty to retain existing cost">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notes / Batch Remarks</label>
                        <input type="text" name="notes" class="form-control" placeholder="Vendor receiving notes...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Record Inward</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- General Adjust Modal (with product selector dropdown) -->
<div class="modal fade" id="generalAdjustModal" tabindex="-1" aria-labelledby="generalAdjustModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.inventory.adjust') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="generalAdjustModalLabel"><i class="bi bi-sliders text-warning me-2"></i>Physical Count Audit Adjustment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Hardware SKU *</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">-- Choose Product --</option>
                            @foreach($allProducts as $ap)
                                <option value="{{ $ap->id }}">{{ $ap->name }} (Current: {{ $ap->stock }} units)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Correct Physical Shelf Count *</label>
                        <input type="number" name="new_stock" class="form-control" min="0" required placeholder="Enter verified shelf count">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Reason for Adjustment *</label>
                        <input type="text" name="reason" class="form-control" required placeholder="e.g. Audit reconciliation, damaged write-off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning fw-bold"><i class="bi bi-check-lg me-1"></i>Save Physical Count</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function triggerInward(prodId, prodName, unitCost) {
        document.getElementById('modal_inward_prod_id').value = prodId;
        document.getElementById('modal_inward_prod_name').innerText = prodName;
        document.getElementById('modal_inward_unit_cost').value = unitCost;
        
        const modal = new bootstrap.Modal(document.getElementById('inwardModal'));
        modal.show();
    }

    function triggerAdjust(prodId, prodName, currStock) {
        document.getElementById('modal_adjust_prod_id').value = prodId;
        document.getElementById('modal_adjust_prod_name').innerText = prodName;
        document.getElementById('modal_adjust_curr_stock').innerText = currStock;
        document.getElementById('modal_adjust_new_stock').value = currStock;
        
        const modal = new bootstrap.Modal(document.getElementById('adjustModal'));
        modal.show();
    }
</script>
@endpush

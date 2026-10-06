@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Stock Ledger & Inventory</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $totalSkus }} Managed SKUs
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Catalog & Inventory</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Physical Stock vs Reorder Level</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" data-bs-target="#generalAdjustModal">
            <i class="bi bi-sliders"></i>
            <span>Physical Audit</span>
        </button>
        <button type="button" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" data-bs-target="#generalInwardModal">
            <i class="bi bi-box-arrow-in-down fs-6"></i>
            <span>Stock Inward</span>
        </button>
    </div>
</div>

<!-- KPI Metrics Cards Row -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Total Catalog SKUs</div>
                    <div class="catalog-kpi-val">{{ $totalSkus }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-box-seam text-primary"></i> Distinct hardware lines</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Total Stock Units</div>
                    <div class="catalog-kpi-val text-success">{{ number_format($totalUnits) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-boxes text-success"></i> Physical warehouse pieces</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-boxes"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Inventory Valuation</div>
                    <div class="catalog-kpi-val text-indigo fs-4 mt-2">₹{{ number_format($totalInventoryValue, 2) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-cash-stack text-indigo"></i> Valued at cost price</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-currency-rupee"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $lowStockCount > 0 ? 'kpi-amber' : 'kpi-emerald' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Reorder Level Alerts</div>
                    <div class="catalog-kpi-val {{ $lowStockCount > 0 ? 'text-warning' : 'text-success' }}">{{ $lowStockCount }}</div>
                    <div class="catalog-kpi-sub text-danger">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $outOfStockCount }} completely out of stock
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $lowStockCount > 0 ? 'icon-amber' : 'icon-emerald' }}">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Filters & Search Bar -->
<div class="catalog-filter-card">
    <form method="GET" action="{{ route('admin.inventory') }}">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-5">
                <div class="catalog-search-wrap">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" value="{{ $currentSearch }}" class="catalog-search-input" 
                           placeholder="Search by SKU, Product Name, Brand...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select catalog-select" onchange="this.form.submit()">
                    <option value="ALL">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string)$currentCategory === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select catalog-select" onchange="this.form.submit()">
                    <option value="ALL" {{ $currentStatus === 'ALL' ? 'selected' : '' }}>All Stock Levels</option>
                    <option value="low_stock" {{ $currentStatus === 'low_stock' ? 'selected' : '' }}>⚠️ Low Stock (&le; Min)</option>
                    <option value="out_of_stock" {{ $currentStatus === 'out_of_stock' ? 'selected' : '' }}>❌ Out of Stock (0)</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold flex-grow-1 rounded-3">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary rounded-3" title="Reset Filters">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </div>

        <!-- Quick Status Filter Pills -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-2 border-top">
            <div class="filter-pills-bar">
                <span class="text-muted small fw-bold me-1 text-uppercase">Status Filter:</span>
                <a href="{{ route('admin.inventory', array_merge(request()->except('status', 'page'), ['status' => 'ALL'])) }}" 
                   class="filter-pill {{ $currentStatus === 'ALL' ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap"></i> All Items ({{ $totalSkus }})
                </a>
                <a href="{{ route('admin.inventory', array_merge(request()->except('page'), ['status' => 'low_stock'])) }}" 
                   class="filter-pill {{ $currentStatus === 'low_stock' ? 'active-warning' : '' }}">
                    <i class="bi bi-exclamation-triangle-fill text-warning"></i> Low Stock Reorder ({{ $lowStockCount }})
                </a>
                <a href="{{ route('admin.inventory', array_merge(request()->except('page'), ['status' => 'out_of_stock'])) }}" 
                   class="filter-pill {{ $currentStatus === 'out_of_stock' ? 'active-danger' : '' }}">
                    <i class="bi bi-x-circle-fill text-danger"></i> Out of Stock ({{ $outOfStockCount }})
                </a>
            </div>

            <div class="text-muted small">
                Showing <strong>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> stock ledger records
            </div>
        </div>
    </form>
</div>

<!-- Modern Inventory Stock Table -->
<div class="catalog-card shadow-sm">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 280px;">Hardware SKU & Product</th>
                    <th>Category</th>
                    <th class="text-end">Cost Price (₹)</th>
                    <th class="text-center">Current Stock</th>
                    <th class="text-center">Min Alert</th>
                    <th>Inventory Status</th>
                    <th class="text-end" style="min-width: 140px;">Stock Operations</th>
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
                                <div class="catalog-avatar-box">
                                    <i class="bi {{ $p->category->icon ?? 'bi-box' }}"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $p->id]) }}" class="catalog-item-name">
                                        {{ $p->name }}
                                    </a>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="catalog-sku-code">{{ $p->sku }}</span>
                                        <span class="badge bg-light text-secondary border font-monospace px-1.5 py-0.5" style="font-size: 0.7rem;">
                                            {{ $p->brand->name ?? 'Generic' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-slate-800 border px-2.5 py-1 fw-semibold">
                                {{ $p->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <span class="text-slate-800 fw-semibold">₹{{ number_format($p->purchase_price, 2) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="fw-bold fs-6 {{ $isOut ? 'text-danger' : ($isLow ? 'text-warning' : 'text-success') }}">
                                {{ $p->stock }}
                            </div>
                            <small class="text-muted" style="font-size: 0.7rem;">Units on Hand</small>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-muted border font-monospace px-2 py-1">
                                {{ $p->min_stock }}
                            </span>
                        </td>
                        <td>
                            @if($isOut)
                                <span class="stock-status-pill out">
                                    <span class="stock-dot"></span>
                                    <span>Out of Stock</span>
                                </span>
                            @elseif($isLow)
                                <span class="stock-status-pill low" title="Minimum alert threshold: {{ $p->min_stock }}">
                                    <span class="stock-dot"></span>
                                    <span>Reorder Alert</span>
                                </span>
                            @else
                                <span class="stock-status-pill healthy">
                                    <span class="stock-dot"></span>
                                    <span>Healthy Stock</span>
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <button type="button" class="catalog-action-btn btn-stock" 
                                        onclick="triggerInward({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->purchase_price }})"
                                        title="Stock Inward (+Units)">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                                <button type="button" class="catalog-action-btn btn-edit" 
                                        onclick="triggerAdjust({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->stock }})"
                                        title="Physical Count Adjust">
                                    <i class="bi bi-sliders"></i>
                                </button>
                                <a href="{{ route('admin.inventory.movements', $p->id) }}" class="catalog-action-btn btn-view" title="Stock Movement Ledger">
                                    <i class="bi bi-clock-history"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-boxes display-5 text-muted mb-3 d-block opacity-50"></i>
                                <h5 class="fw-bold text-slate-900 mb-1">No Inventory Records Found</h5>
                                <p class="text-muted small mb-0">No items match your active filters.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $products->firstItem() }}</strong> to <strong>{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> total stock ledger items
            </div>
            <div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

<!-- Modal: Quick Inward for specific product -->
<div class="modal fade" id="inwardModal" tabindex="-1" aria-labelledby="inwardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.inventory.inward') }}">
                @csrf
                <input type="hidden" name="product_id" id="modal_inward_prod_id" value="">
                <div class="modal-header bg-success text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-25 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-box-arrow-in-down fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="inwardModalLabel">Inward Stock Receipt</h5>
                            <small class="text-white-50">Add received goods to inventory</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.7rem;">Target Hardware Item:</small>
                        <strong class="text-slate-900 fs-6" id="modal_inward_prod_name"></strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Quantity to Inward <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control rounded-3 py-2" min="1" required value="5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Supplier Invoice / PO Reference</label>
                        <input type="text" name="reference_no" class="form-control rounded-3 py-2" placeholder="e.g. RPTECH/JAI/44892">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Unit Purchase Cost (₹)</label>
                        <input type="number" step="0.01" name="unit_cost" id="modal_inward_unit_cost" class="form-control rounded-3 py-2">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Notes & Delivery Details</label>
                        <input type="text" name="notes" class="form-control rounded-3 py-2" placeholder="Supplier inwards delivery batch...">
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Confirm Inward
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Quick Adjust for specific product -->
<div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.inventory.adjust') }}">
                @csrf
                <input type="hidden" name="product_id" id="modal_adjust_prod_id" value="">
                <div class="modal-header bg-warning text-dark p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-dark bg-opacity-10 p-2 text-dark d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-sliders fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-dark" id="adjustModalLabel">Physical Count Audit</h5>
                            <small class="text-dark text-opacity-75">Adjust inventory based on shelf count</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.7rem;">Target Hardware Item:</small>
                        <strong class="text-slate-900 fs-6 d-block" id="modal_adjust_prod_name"></strong>
                        <div class="small text-muted mt-1">Current Ledger: <strong id="modal_adjust_curr_stock" class="text-primary"></strong> units</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Actual Physical Shelf Count <span class="text-danger">*</span></label>
                        <input type="number" name="new_stock" id="modal_adjust_new_stock" class="form-control rounded-3 py-2" min="0" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Reason for Adjustment <span class="text-danger">*</span></label>
                        <input type="text" name="reason" class="form-control rounded-3 py-2" required placeholder="e.g. Month-end physical audit / damaged unit write-off">
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Save Adjustment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- General Inward Modal (with product selector dropdown) -->
<div class="modal fade" id="generalInwardModal" tabindex="-1" aria-labelledby="generalInwardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.inventory.inward') }}">
                @csrf
                <div class="modal-header bg-primary text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-25 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-box-arrow-in-down fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="generalInwardModalLabel">Stock Inward / Vendor Receiving</h5>
                            <small class="text-white-50">Receive incoming stock deliveries</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Select Hardware SKU <span class="text-danger">*</span></label>
                        <select name="product_id" class="form-select rounded-3 py-2" required>
                            <option value="">-- Choose Product --</option>
                            @foreach($allProducts as $ap)
                                <option value="{{ $ap->id }}">{{ $ap->name }} (SKU: {{ $ap->sku }} | Current: {{ $ap->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Inward Quantity to Add <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control rounded-3 py-2" min="1" required value="5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Supplier Invoice Number</label>
                        <input type="text" name="reference_no" class="form-control rounded-3 py-2" placeholder="e.g. INV-VENDOR-2026-9901">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Unit Cost (₹)</label>
                        <input type="number" step="0.01" name="unit_cost" class="form-control rounded-3 py-2" placeholder="Leave empty to retain existing cost">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Notes / Batch Remarks</label>
                        <input type="text" name="notes" class="form-control rounded-3 py-2" placeholder="Vendor receiving notes...">
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Record Inward
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- General Adjust Modal (with product selector dropdown) -->
<div class="modal fade" id="generalAdjustModal" tabindex="-1" aria-labelledby="generalAdjustModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.inventory.adjust') }}">
                @csrf
                <div class="modal-header bg-warning text-dark p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-dark bg-opacity-10 p-2 text-dark d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-sliders fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-dark" id="generalAdjustModalLabel">Physical Count Audit Adjustment</h5>
                            <small class="text-dark text-opacity-75">Reconcile differences between shelf and software</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Select Hardware SKU <span class="text-danger">*</span></label>
                        <select name="product_id" class="form-select rounded-3 py-2" required>
                            <option value="">-- Choose Product --</option>
                            @foreach($allProducts as $ap)
                                <option value="{{ $ap->id }}">{{ $ap->name }} (Current: {{ $ap->stock }} units)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Correct Physical Shelf Count <span class="text-danger">*</span></label>
                        <input type="number" name="new_stock" class="form-control rounded-3 py-2" min="0" required placeholder="Enter verified shelf count">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Reason for Adjustment <span class="text-danger">*</span></label>
                        <input type="text" name="reason" class="form-control rounded-3 py-2" required placeholder="e.g. Audit reconciliation, damaged write-off">
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Save Physical Count
                    </button>
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

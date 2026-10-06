@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">{{ $product->name }}</h1>
            <span class="stock-status-pill {{ $product->stock > $product->min_stock ? 'healthy' : ($product->stock > 0 ? 'low' : 'out') }}">
                <span class="stock-dot"></span>
                <span>{{ $product->stock > $product->min_stock ? 'In Stock' : ($product->stock > 0 ? 'Low Stock' : 'Out of Stock') }}</span>
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <a href="{{ route('admin.products') }}" class="text-decoration-none text-muted">Products Catalog</a>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">SKU: {{ $product->sku }}</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('product.details', ['id' => $product->id]) }}" target="_blank" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-box-arrow-up-right"></i>
            <span>Storefront View</span>
        </a>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-pencil-square"></i>
            <span>Edit Product</span>
        </a>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Catalog
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <!-- Specifications Card -->
        <div class="catalog-card p-4 mb-4 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="catalog-avatar-box" style="width: 52px; height: 52px; font-size: 1.5rem;">
                        <i class="bi {{ $product->category->icon ?? 'bi-box-seam' }}"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-slate-900 mb-0">Hardware Specifications & Datasheet</h5>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="catalog-sku-code">{{ $product->sku }}</span>
                            <span class="badge bg-light text-slate-700 border">Brand: <strong>{{ $product->brand->name ?? 'Generic' }}</strong></span>
                            <span class="badge bg-light text-slate-700 border">Category: <strong>{{ $product->category->name ?? 'General' }}</strong></span>
                        </div>
                    </div>
                </div>

                <div>
                    <span class="badge {{ $product->status === 'active' ? 'badge-soft-success' : 'badge-soft-secondary' }} rounded-pill px-3 py-1.5 fw-bold">
                        {{ ucfirst($product->status) }}
                    </span>
                </div>
            </div>

            <!-- Specs Highlight Banner -->
            <div class="p-3 bg-light rounded-3 border mb-4">
                <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-cpu text-primary fs-5 mt-0.5"></i>
                    <div>
                        <div class="text-uppercase small fw-bold text-muted" style="font-size: 0.72rem; letter-spacing: 0.05em;">Key Specifications Summary</div>
                        <div class="text-slate-900 fw-bold fs-6 mt-1">{{ $product->specs }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Technical Datasheet Table -->
            <div class="table-responsive rounded-3 border mb-4 overflow-hidden">
                <table class="table table-sm table-bordered align-middle mb-0 small">
                    <tbody>
                        <tr>
                            <th class="bg-light text-slate-600 px-3 py-2.5" style="width: 25%;">Model Number</th>
                            <td class="text-slate-900 fw-semibold px-3 py-2.5">{{ $product->model ?: 'N/A' }}</td>
                            <th class="bg-light text-slate-600 px-3 py-2.5" style="width: 25%;">Barcode / EAN</th>
                            <td class="text-slate-900 font-monospace px-3 py-2.5">{{ $product->barcode ?: 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-slate-600 px-3 py-2.5">Category</th>
                            <td class="px-3 py-2.5">{{ $product->category->name ?? '-' }}</td>
                            <th class="bg-light text-slate-600 px-3 py-2.5">Sub Category</th>
                            <td class="px-3 py-2.5">{{ $product->subcategory->name ?? 'Standard' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-slate-600 px-3 py-2.5">Brand Partner</th>
                            <td class="px-3 py-2.5"><strong>{{ $product->brand->name ?? 'Generic' }}</strong></td>
                            <th class="bg-light text-slate-600 px-3 py-2.5">Warranty Terms</th>
                            <td class="px-3 py-2.5">{{ $product->warranty }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light text-slate-600 px-3 py-2.5">Storefront Featured</th>
                            <td class="px-3 py-2.5">
                                @if($product->is_featured)
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"><i class="bi bi-star-fill me-1"></i>Yes</span>
                                @else
                                    <span class="text-muted">Standard</span>
                                @endif
                            </td>
                            <th class="bg-light text-slate-600 px-3 py-2.5">Catalog Status</th>
                            <td class="px-3 py-2.5">
                                <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                        </tr>
                        @if($product->pcb_type || $product->socket || $product->ram_type)
                            <tr>
                                <th class="bg-light text-slate-600 px-3 py-2.5">PC Builder Compatibility</th>
                                <td colspan="3" class="px-3 py-2.5">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light text-dark border">Role: <code>{{ $product->pcb_type ?: 'General' }}</code></span>
                                        @if($product->socket)
                                            <span class="badge bg-light text-dark border">Socket: <code>{{ $product->socket }}</code></span>
                                        @endif
                                        @if($product->ram_type)
                                            <span class="badge bg-light text-dark border">RAM Gen: <code>{{ $product->ram_type }}</code></span>
                                        @endif
                                        @if($product->wattage)
                                            <span class="badge bg-light text-dark border">Wattage: <code>{{ $product->wattage }}W</code></span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($product->description)
                <h6 class="fw-bold text-slate-900 mb-2">Detailed Datasheet & Package Description:</h6>
                <div class="p-3 bg-light rounded-3 border text-slate-700 small leading-relaxed">
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif
        </div>

        <!-- Stock Movements Ledger for this SKU -->
        <div class="catalog-card shadow-sm">
            <div class="catalog-card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock-history text-primary fs-5"></i>
                    <h5 class="fw-bold text-slate-900 mb-0">Recent Stock Transactions</h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark border">{{ $product->stockMovements->count() }} Total</span>
                    <a href="{{ route('admin.inventory.movements', $product->id) }}" class="btn btn-sm btn-outline-primary fw-semibold px-2.5 py-1">
                        Full Ledger &rarr;
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-catalog align-middle mb-0 small">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Type</th>
                            <th>Reference</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Balance</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product->stockMovements->take(8) as $mov)
                            @php
                                $isPositive = $mov->quantity > 0;
                            @endphp
                            <tr>
                                <td>
                                    <span class="fw-semibold text-slate-900">{{ $mov->created_at->format('d M Y') }}</span>
                                    <small class="text-muted font-monospace d-block">{{ $mov->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $mov->type === 'inward' || $mov->type === 'initial' ? 'bg-success-subtle text-success border border-success-subtle' : ($mov->type === 'adjustment' ? 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle') }} rounded-pill px-2 py-0.5">
                                        {{ ucfirst($mov->type) }}
                                    </span>
                                </td>
                                <td><span class="catalog-sku-code">{{ $mov->reference_no ?: '-' }}</span></td>
                                <td class="text-center fw-bold {{ $isPositive ? 'text-success' : 'text-danger' }}">
                                    {{ $isPositive ? '+' . $mov->quantity : $mov->quantity }}
                                </td>
                                <td class="text-center fw-bold font-monospace">{{ $mov->balance_after }}</td>
                                <td class="text-muted">{{ $mov->notes ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No stock movements recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Matrix -->
    <div class="col-lg-4">
        <!-- Stock Balance Card -->
        <div class="catalog-card p-4 mb-4 shadow-sm">
            <h5 class="fw-bold text-slate-900 mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-boxes text-primary"></i>
                <span>Warehouse Stock</span>
            </h5>

            <div class="p-4 bg-light rounded-3 text-center mb-3 border">
                <div class="text-muted small fw-semibold text-uppercase">Current Units on Hand</div>
                <div class="display-5 fw-extrabold my-1 {{ $product->isLowStock() ? 'text-danger' : 'text-success' }}">
                    {{ $product->stock }}
                </div>
                <div class="small text-muted">
                    Reorder Alert: <strong>{{ $product->min_stock }}</strong> units
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="button" class="btn btn-success fw-bold py-2 rounded-3 shadow-xs d-flex align-items-center justify-content-center gap-2" 
                        data-bs-toggle="modal" data-bs-target="#inwardModal">
                    <i class="bi bi-box-arrow-in-down fs-6"></i>
                    <span>Inward Stock (+Qty)</span>
                </button>
                <button type="button" class="btn btn-outline-warning text-dark fw-bold py-2 rounded-3 d-flex align-items-center justify-content-center gap-2" 
                        data-bs-toggle="modal" data-bs-target="#adjustModal">
                    <i class="bi bi-sliders fs-6"></i>
                    <span>Adjust Physical Stock</span>
                </button>
                <a href="{{ route('admin.inventory.movements', $product->id) }}" class="btn btn-outline-secondary py-2 rounded-3 fw-semibold">
                    <i class="bi bi-clock-history me-1"></i> Stock Ledger Audit
                </a>
            </div>
        </div>

        <!-- Commercial Pricing Matrix Card -->
        <div class="catalog-card p-4 mb-4 shadow-sm">
            <h5 class="fw-bold text-slate-900 mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-currency-rupee text-primary"></i>
                <span>Commercial Pricing</span>
            </h5>

            <div class="p-3 bg-light rounded-3 border mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Purchase / Cost:</span>
                    <strong class="text-slate-800">₹{{ number_format($product->purchase_price, 2) }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">GST Tax Rate:</span>
                    <span class="badge bg-light text-slate-800 border">{{ (int)$product->gst_rate }}%</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">MRP (List Price):</span>
                    <span class="text-decoration-line-through text-muted">{{ $product->formattedMrp() }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                    <span class="text-slate-900 fw-bold">Selling Price:</span>
                    <span class="text-primary fw-extrabold fs-5">₹{{ number_format($product->selling_price, 2) }}</span>
                </div>
            </div>

            @php
                $profitMargin = $product->purchase_price > 0 
                    ? round((($product->selling_price - $product->purchase_price) / $product->purchase_price) * 100, 1) 
                    : 0;
            @endphp
            <div class="p-3 bg-success-subtle border border-success-subtle rounded-3 text-success d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="small fw-bold text-uppercase d-block" style="font-size: 0.7rem;">Gross Profit Margin</span>
                    <span class="fs-5 fw-extrabold">{{ $profitMargin }}%</span>
                </div>
                <i class="bi bi-graph-up-arrow fs-3"></i>
            </div>

            <div class="d-grid">
                <a href="{{ route('admin.quotations.create') }}" class="btn btn-outline-primary fw-bold py-2 rounded-3">
                    <i class="bi bi-file-earmark-plus me-1"></i> Add to Customer Quote
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Inward Stock -->
<div class="modal fade" id="inwardModal" tabindex="-1" aria-labelledby="inwardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.inventory.inward') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header bg-success text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-25 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-box-arrow-in-down fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="inwardModalLabel">Record Stock Inward</h5>
                            <small class="text-white-50">SKU: {{ $product->sku }}</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.7rem;">Target Hardware Item:</small>
                        <strong class="text-slate-900 fs-6">{{ $product->name }}</strong>
                        <div class="small text-muted mt-1">Current Balance: <strong class="text-primary">{{ $product->stock }}</strong> units</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Inward Quantity to Add <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" class="form-control rounded-3 py-2" min="1" required value="5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Vendor Invoice / Reference Number</label>
                        <input type="text" name="reference_no" class="form-control rounded-3 py-2" placeholder="e.g. PUR-2026-003">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Unit Purchase Cost (₹)</label>
                        <input type="number" step="0.01" name="unit_cost" class="form-control rounded-3 py-2" value="{{ $product->purchase_price }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Notes & Delivery Batch</label>
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

<!-- Modal: Adjust Stock -->
<div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.inventory.adjust') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header bg-warning text-dark p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-dark bg-opacity-10 p-2 text-dark d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-sliders fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-dark" id="adjustModalLabel">Physical Stock Adjustment</h5>
                            <small class="text-dark text-opacity-75">Audit and balance reconciliation</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <small class="text-muted d-block fw-semibold text-uppercase" style="font-size: 0.7rem;">Target Hardware Item:</small>
                        <strong class="text-slate-900 fs-6">{{ $product->name }}</strong>
                        <div class="small text-muted mt-1">Current Ledger: <strong class="text-primary">{{ $product->stock }}</strong> units</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Actual Physical Count Balance <span class="text-danger">*</span></label>
                        <input type="number" name="new_stock" class="form-control rounded-3 py-2" min="0" required value="{{ $product->stock }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Reason for Adjustment <span class="text-danger">*</span></label>
                        <input type="text" name="reason" class="form-control rounded-3 py-2" required placeholder="e.g. Physical inventory audit, damaged item write-off">
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Apply Adjustment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

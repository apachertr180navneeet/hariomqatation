@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">{{ $product->name }}</h1>
        <div class="page-breadcrumb">
            SKU: <code class="fw-bold text-primary">{{ $product->sku }}</code> &bull; 
            Brand: <strong>{{ $product->brand->name ?? 'Generic' }}</strong> &bull; 
            Category: <strong>{{ $product->category->name ?? 'Uncategorized' }}</strong>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i> Edit Details
        </a>
        <a href="{{ route('product.details', ['id' => $product->id]) }}" target="_blank" class="btn btn-outline-secondary">
            <i class="bi bi-box-arrow-up-right me-1"></i> Storefront View
        </a>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Catalog
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <!-- Specifications Card -->
        <div class="admin-card p-4 mb-4 shadow-sm">
            <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-cpu me-2"></i>Product Specifications</h5>
            <p class="text-slate-700 bg-light p-3 rounded border mb-4 fs-6">{{ $product->specs }}</p>
            
            <table class="table table-bordered small mb-0">
                <tbody>
                    <tr>
                        <th class="bg-light" style="width: 25%;">Model Number</th>
                        <td>{{ $product->model ?: 'N/A' }}</td>
                        <th class="bg-light" style="width: 25%;">Barcode / EAN</th>
                        <td>{{ $product->barcode ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Category</th>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <th class="bg-light">Sub Category</th>
                        <td>{{ $product->subcategory->name ?? 'Standard' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Brand Partner</th>
                        <td><strong>{{ $product->brand->name ?? '-' }}</strong></td>
                        <th class="bg-light">Warranty</th>
                        <td>{{ $product->warranty }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Catalog Status</th>
                        <td>
                            <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <th class="bg-light">Featured SKU</th>
                        <td>{{ $product->is_featured ? 'Yes (Showcased on storefront)' : 'No' }}</td>
                    </tr>
                    @if($product->pcb_type || $product->socket || $product->ram_type)
                        <tr>
                            <th class="bg-light">PCB Builder Specs</th>
                            <td colspan="3">
                                Role: <code>{{ $product->pcb_type ?: 'General' }}</code> &bull; 
                                Socket: <code>{{ $product->socket ?: 'N/A' }}</code> &bull; 
                                RAM Gen: <code>{{ $product->ram_type ?: 'N/A' }}</code> &bull; 
                                Wattage: <code>{{ $product->wattage ? $product->wattage . 'W' : 'N/A' }}</code>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            @if($product->description)
                <h6 class="fw-bold mt-4 mb-2 text-slate-800">Extended Description:</h6>
                <div class="small text-muted border p-3 rounded bg-white">
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif
        </div>

        <!-- Stock Movements Ledger for this SKU -->
        <div class="admin-card p-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="admin-card-title mb-0 text-primary"><i class="bi bi-clock-history me-2"></i>Stock Movement Ledger</h5>
                <span class="badge bg-light text-dark border">{{ $product->stockMovements->count() }} Transactions</span>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th>Date & Time</th>
                            <th>Type</th>
                            <th>Reference</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Balance After</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product->stockMovements->take(10) as $mov)
                            <tr>
                                <td>{{ $mov->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <span class="badge {{ $mov->type === 'inward' || $mov->type === 'initial' ? 'bg-success' : ($mov->type === 'adjustment' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ ucfirst($mov->type) }}
                                    </span>
                                </td>
                                <td><code>{{ $mov->reference_no ?: '-' }}</code></td>
                                <td class="text-center fw-bold {{ $mov->quantity > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $mov->quantity > 0 ? '+' . $mov->quantity : $mov->quantity }}
                                </td>
                                <td class="text-center fw-bold">{{ $mov->balance_after }}</td>
                                <td class="text-muted">{{ $mov->notes }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">No stock movements recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Stock & Pricing Matrix -->
        <div class="admin-card p-4 mb-4 shadow-sm">
            <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-cash-stack me-2"></i>Pricing Matrix</h5>
            
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Purchase Price:</span>
                <strong class="text-dark">₹{{ number_format($product->purchase_price, 2) }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">GST Rate:</span>
                <span class="badge bg-light text-dark border">{{ (int)$product->gst_rate }}%</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">Selling Price (Incl GST):</span>
                <strong class="text-primary fs-5">₹{{ number_format($product->selling_price, 2) }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                <span class="text-muted small">MRP (List Price):</span>
                <span class="text-decoration-line-through text-muted">{{ $product->formattedMrp() }}</span>
            </div>

            @php
                $profitMargin = $product->purchase_price > 0 
                    ? round((($product->selling_price - $product->purchase_price) / $product->purchase_price) * 100, 1) 
                    : 0;
            @endphp
            <div class="p-2 bg-primary-subtle text-primary rounded small text-center mb-3">
                Estimated Gross Margin: <strong>{{ $profitMargin }}%</strong>
            </div>

            <h5 class="admin-card-title mb-3 text-primary"><i class="bi bi-boxes me-2"></i>Physical Stock Status</h5>
            <div class="p-3 bg-light rounded text-center mb-3 border">
                <div class="text-muted small">Current Physical Stock</div>
                <div class="display-6 fw-bold {{ $product->isLowStock() ? 'text-danger' : 'text-success' }}">
                    {{ $product->stock }}
                </div>
                <small class="text-muted">Min Reorder Alert: <strong>{{ $product->min_stock }}</strong> units</small>
            </div>

            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-primary fw-bold" data-bs-toggle="modal" data-bs-target="#inwardModal">
                    <i class="bi bi-plus-circle me-1"></i> Inward Stock (+Qty)
                </button>
                <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-toggle="modal" data-bs-target="#adjustModal">
                    <i class="bi bi-sliders me-1"></i> Adjust Stock Balance
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Inward Stock -->
<div class="modal fade" id="inwardModal" tabindex="-1" aria-labelledby="inwardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.inventory.inward') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="inwardModalLabel"><i class="bi bi-box-arrow-in-down text-primary me-2"></i>Record Stock Inward</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-muted mb-3">Product: <strong>{{ $product->name }}</strong> (Current: {{ $product->stock }} units)</p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Inward Quantity to Add *</label>
                        <input type="number" name="quantity" class="form-control" min="1" required value="5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Vendor Invoice / Reference Number</label>
                        <input type="text" name="reference_no" class="form-control" placeholder="e.g. PUR-2026-003">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Unit Purchase Cost (₹)</label>
                        <input type="number" step="0.01" name="unit_cost" class="form-control" value="{{ $product->purchase_price }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notes</label>
                        <input type="text" name="notes" class="form-control" placeholder="Supplier inwards delivery batch...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Confirm Inward</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Adjust Stock -->
<div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.inventory.adjust') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="adjustModalLabel"><i class="bi bi-sliders text-warning me-2"></i>Physical Stock Adjustment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-muted mb-3">Product: <strong>{{ $product->name }}</strong></p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Current Count Recorded</label>
                        <input type="text" class="form-control bg-light" readonly value="{{ $product->stock }} Units">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Actual Physical Count Balance *</label>
                        <input type="number" name="new_stock" class="form-control" min="0" required value="{{ $product->stock }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Reason for Adjustment *</label>
                        <input type="text" name="reason" class="form-control" required placeholder="e.g. Physical inventory audit, damaged item write-off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning fw-bold"><i class="bi bi-check-lg me-1"></i>Apply Adjustment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

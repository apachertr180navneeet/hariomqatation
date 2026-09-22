@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Stock Ledger: {{ $product->name }}</h1>
        <div class="page-breadcrumb">
            SKU: <code class="text-primary">{{ $product->sku }}</code> &bull; 
            Current Balance: <strong class="text-success">{{ $product->stock }} units</strong>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.view', ['id' => $product->id]) }}" class="btn btn-outline-primary">
            <i class="bi bi-eye me-1"></i> Product Inspection
        </a>
        <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Inventory
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Type</th>
                    <th>Reference</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Balance After</th>
                    <th>Unit Cost (₹)</th>
                    <th>Notes</th>
                    <th>Recorded By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $m)
                    <tr>
                        <td>{{ $m->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <span class="badge {{ $m->type === 'inward' || $m->type === 'initial' ? 'bg-success' : ($m->type === 'adjustment' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                {{ ucfirst($m->type) }}
                            </span>
                        </td>
                        <td><code>{{ $m->reference_no ?: '-' }}</code></td>
                        <td class="text-center fw-bold {{ $m->quantity > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $m->quantity > 0 ? '+' . $m->quantity : $m->quantity }}
                        </td>
                        <td class="text-center fw-bold">{{ $m->balance_after }}</td>
                        <td>{{ $m->unit_cost ? '₹' . number_format($m->unit_cost, 2) : '-' }}</td>
                        <td class="text-muted">{{ $m->notes }}</td>
                        <td><small class="text-muted">{{ $m->user->name ?? 'System' }}</small></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-clock-history fs-2 d-block mb-2"></i>
                            No stock movement transactions recorded for this product yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($movements->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing {{ $movements->firstItem() }} to {{ $movements->lastItem() }} of {{ $movements->total() }} transactions</small>
            <div>
                {{ $movements->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

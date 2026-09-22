@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Laptops Catalog</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Dedicated Laptop Specifications ({{ $laptops->count() }} models)</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.add') }}" class="btn btn-primary fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Add Laptop
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Model & Brand</th>
                    <th>Processor & Specs</th>
                    <th>MRP (₹)</th>
                    <th>Selling (₹)</th>
                    <th class="text-center">Stock</th>
                    <th>Warranty</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laptops as $laptop)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary rounded p-2 text-center" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-laptop fs-4"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.view', ['id' => $laptop->id]) }}" class="fw-bold text-slate-900 text-decoration-none d-block">
                                        {{ $laptop->name }}
                                    </a>
                                    <small class="text-muted">
                                        SKU: <code class="text-primary">{{ $laptop->sku }}</code> &bull; Brand: <strong>{{ $laptop->brand->name ?? 'Generic' }}</strong>
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <small class="text-slate-700 d-block mb-1">{{ $laptop->specs }}</small>
                            <span class="badge bg-light text-dark border">{{ $laptop->subcategory->name ?? 'Laptop' }}</span>
                        </td>
                        <td class="text-muted text-decoration-line-through">
                            {{ $laptop->mrp ? '₹' . number_format($laptop->mrp, 2) : '-' }}
                        </td>
                        <td class="fw-bold text-primary">
                            ₹{{ number_format($laptop->selling_price, 2) }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $laptop->stock > $laptop->min_stock ? 'bg-success' : ($laptop->stock > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                {{ $laptop->stock }} Units
                            </span>
                        </td>
                        <td><small class="text-muted">{{ $laptop->warranty }}</small></td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.products.view', ['id' => $laptop->id]) }}" class="btn btn-outline-secondary" title="View Inspection">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $laptop->id) }}" class="btn btn-outline-primary" title="Edit Laptop">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-laptop display-5 d-block mb-2"></i>
                            No laptop models found in the database. Click "Add Laptop" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Hardware Brands</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Partner Brands</span>
        </div>
    </div>
    <div>
        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addBrandModal">
            <i class="bi bi-plus-lg me-1"></i> Add Brand
        </button>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Active Products</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light rounded p-2 text-center" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-award text-primary fs-4"></i>
                                </div>
                                <div>
                                    <strong class="d-block text-slate-900">{{ $brand->name }}</strong>
                                    <small class="text-muted">Slug: <code>{{ $brand->slug }}</code></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-box-seam me-1 text-primary"></i> {{ $brand->products_count }} Products
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $brand->status === 'active' ? 'badge-soft-success' : 'badge-soft-secondary' }}">
                                {{ ucfirst($brand->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" 
                                    onclick="editBrandModal({{ json_encode($brand) }})" title="Edit Brand">
                                <i class="bi bi-pencil"></i>
                            </button>
                            @if($brand->products_count === 0)
                                <form method="POST" action="{{ route('admin.brands.destroy', $brand->id) }}" class="d-inline" onsubmit="return confirm('Delete brand {{ $brand->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Brand">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-award fs-1 d-block mb-2"></i>
                            No brands found. Click "Add Brand" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.brands.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addBrandModalLabel"><i class="bi bi-award text-primary me-2"></i>Add Hardware Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Brand Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Dell, Intel, Corsair">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Save Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editBrandForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editBrandModalLabel"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Brand Name *</label>
                        <input type="text" name="name" id="edit_brand_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status *</label>
                        <select name="status" id="edit_brand_status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Update Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function editBrandModal(brand) {
        document.getElementById('edit_brand_name').value = brand.name;
        document.getElementById('edit_brand_status').value = brand.status || 'active';
        
        const form = document.getElementById('editBrandForm');
        form.action = "{{ url('admin/brands') }}/" + brand.id;
        
        const modal = new bootstrap.Modal(document.getElementById('editBrandModal'));
        modal.show();
    }
</script>
@endpush

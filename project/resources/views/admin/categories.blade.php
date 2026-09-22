@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Categories & Taxonomy</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Catalog Taxonomy</span>
        </div>
    </div>
    <div>
        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-lg me-1"></i> Add Category
        </button>
    </div>
</div>

<div class="row g-4" id="categories-container">
    @forelse($categories as $cat)
        <div class="col-md-6 col-lg-4">
            <div class="admin-card h-100 p-4 d-flex flex-column shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-primary-subtle text-primary p-3 fs-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi {{ $cat->icon ?? 'bi-tags' }}"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-slate-900">{{ $cat->name }}</h5>
                            <small class="text-muted">{{ $cat->subcategories->count() }} Subcategories &bull; <strong>{{ $cat->products_count }}</strong> Products</small>
                        </div>
                    </div>
                    <span class="badge {{ $cat->status === 'active' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                        {{ ucfirst($cat->status) }}
                    </span>
                </div>

                @if($cat->description)
                    <p class="small text-muted mb-3">{{ $cat->description }}</p>
                @endif

                <h6 class="small fw-bold text-muted text-uppercase mb-2">Subcategories:</h6>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @forelse($cat->subcategories as $sub)
                        <span class="badge bg-light text-dark border d-flex align-items-center gap-1 py-1 px-2">
                            <span>{{ $sub->name }}</span>
                            <form method="POST" action="{{ route('admin.categories.subcategories.destroy', $sub->id) }}" class="d-inline" onsubmit="return confirm('Remove subcategory {{ $sub->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-close btn-close-dark ms-1" style="font-size: 0.55rem;" title="Delete subcategory"></button>
                            </form>
                        </span>
                    @empty
                        <span class="text-muted small fst-italic">No subcategories defined yet.</span>
                    @endforelse
                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-primary" 
                                onclick="editCategoryModal({{ json_encode($cat) }})">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </button>
                        <button type="button" class="btn btn-outline-secondary" 
                                onclick="addSubcategoryModal({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                            <i class="bi bi-plus"></i> Add Sub
                        </button>
                    </div>

                    @if($cat->products_count === 0)
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('Are you sure you want to delete category {{ $cat->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Category">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="admin-card p-5 text-center">
                <i class="bi bi-folder2-open display-4 text-muted mb-3"></i>
                <h5>No Categories Found</h5>
                <p class="text-muted">Get started by creating your first product category taxonomy.</p>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-lg me-1"></i> Add Category
                </button>
            </div>
        </div>
    @endforelse
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addCategoryModalLabel"><i class="bi bi-folder-plus text-primary me-2"></i>Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Graphics Cards">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Bootstrap Icon Class</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-tags"></i></span>
                            <input type="text" name="icon" class="form-control" value="bi-tags" placeholder="e.g. bi-gpu-card, bi-laptop, bi-cpu">
                        </div>
                        <small class="text-muted">Use any standard Bootstrap icon class (e.g. <code>bi-laptop</code>, <code>bi-cpu</code>, <code>bi-motherboard</code>).</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Brief category description..."></textarea>
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
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editCategoryForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editCategoryModalLabel"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name *</label>
                        <input type="text" name="name" id="edit_cat_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Bootstrap Icon Class</label>
                        <input type="text" name="icon" id="edit_cat_icon" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="description" id="edit_cat_desc" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status *</label>
                        <select name="status" id="edit_cat_status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Subcategory Modal -->
<div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="addSubcategoryForm" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addSubcategoryModalLabel"><i class="bi bi-plus-circle text-primary me-2"></i>Add Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3">Adding new subcategory under: <strong id="subcat_parent_name" class="text-dark"></strong></p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Subcategory Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Mechanical Keyboards, Gaming Laptops">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="bi bi-check-lg me-1"></i>Add Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function editCategoryModal(cat) {
        document.getElementById('edit_cat_name').value = cat.name;
        document.getElementById('edit_cat_icon').value = cat.icon || 'bi-tags';
        document.getElementById('edit_cat_desc').value = cat.description || '';
        document.getElementById('edit_cat_status').value = cat.status || 'active';
        
        const form = document.getElementById('editCategoryForm');
        form.action = "{{ url('admin/categories') }}/" + cat.id;
        
        const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        modal.show();
    }

    function addSubcategoryModal(catId, catName) {
        document.getElementById('subcat_parent_name').innerText = catName;
        const form = document.getElementById('addSubcategoryForm');
        form.action = "{{ url('admin/categories') }}/" + catId + "/subcategories";
        
        const modal = new bootstrap.Modal(document.getElementById('addSubcategoryModal'));
        modal.show();
    }
</script>
@endpush

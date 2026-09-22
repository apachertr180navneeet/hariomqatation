@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Categories & Taxonomy</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 fw-bold fs-7">
                {{ $categories->count() }} Categories
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Catalog Taxonomy</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Hardware Classification</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Add Category</span>
        </button>
    </div>
</div>

<!-- Top KPI Summary Cards -->
@php
    $totalCategories = $categories->count();
    $totalSubcategories = $categories->sum(fn($c) => $c->subcategories->count());
    $totalProducts = $categories->sum('products_count');
    $activeCount = $categories->where('status', 'active')->count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="cat-kpi-card">
            <div class="cat-kpi-icon bg-primary-subtle text-primary">
                <i class="bi bi-tags-fill"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase cat-kpi-label">Master Categories</div>
                <div class="fs-4 fw-extrabold text-slate-900 leading-tight">{{ $totalCategories }}</div>
                <small class="text-muted cat-kpi-subtext">Main hardware groups</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="cat-kpi-card">
            <div class="cat-kpi-icon bg-info-subtle text-info-emphasis">
                <i class="bi bi-diagram-3-fill"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase cat-kpi-label">Subcategories</div>
                <div class="fs-4 fw-extrabold text-slate-900 leading-tight">{{ $totalSubcategories }}</div>
                <small class="text-muted cat-kpi-subtext">Classified segments</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="cat-kpi-card">
            <div class="cat-kpi-icon bg-success-subtle text-success">
                <i class="bi bi-boxes"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase cat-kpi-label">Linked Inventory</div>
                <div class="fs-4 fw-extrabold text-slate-900 leading-tight">{{ $totalProducts }}</div>
                <small class="text-muted cat-kpi-subtext">Products classified</small>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="cat-kpi-card">
            <div class="cat-kpi-icon bg-warning-subtle text-warning-emphasis">
                <i class="bi bi-shield-check"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold text-uppercase cat-kpi-label">Active Taxonomy</div>
                <div class="fs-4 fw-extrabold text-slate-900 leading-tight">{{ $activeCount }} / {{ $totalCategories }}</div>
                <small class="text-success fw-semibold cat-kpi-subtext"><i class="bi bi-check-circle-fill me-1"></i>Catalog Ready</small>
            </div>
        </div>
    </div>
</div>

<!-- Modern Filter & View Switcher Bar -->
<div class="admin-card p-3 mb-4 shadow-sm">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Live Instant Search -->
        <div class="position-relative cat-search-box">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            <input type="text" id="categorySearchInput" class="form-control ps-5 rounded-pill border-slate-200" 
                   placeholder="Search category, subcategory, icon...">
        </div>

        <!-- Filter Pill Chips -->
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <button type="button" class="filter-tab-btn active" data-filter="all">All ({{ $totalCategories }})</button>
            <button type="button" class="filter-tab-btn" data-filter="has-sub">With Subcategories</button>
            <button type="button" class="filter-tab-btn" data-filter="no-sub">No Subcategories</button>
        </div>

        <!-- View Switcher Toggle -->
        <div class="d-flex align-items-center gap-1 bg-light p-1 rounded-3 border">
            <button type="button" class="btn btn-sm btn-white shadow-xs fw-bold px-2 py-1 active" id="btn-view-grid" title="Grid Cards View">
                <i class="bi bi-grid-fill me-1"></i> Grid
            </button>
            <button type="button" class="btn btn-sm text-muted fw-bold px-2 py-1" id="btn-view-table" title="Table View">
                <i class="bi bi-list-ul me-1"></i> Table
            </button>
        </div>
    </div>
</div>

<!-- Category Cards Grid View -->
<div class="row g-4" id="categories-grid-view">
    @forelse($categories as $index => $cat)
        @php
            $gradClass = 'cat-grad-' . ($index % 6);
        @endphp
        <div class="col-md-6 col-xl-4 category-item-wrapper" 
             data-name="{{ strtolower($cat->name) }}" 
             data-desc="{{ strtolower($cat->description ?? '') }}"
             data-subcat-count="{{ $cat->subcategories->count() }}"
             data-subcat-names="{{ strtolower($cat->subcategories->pluck('name')->implode(' ')) }}">
            
            <div class="category-card h-100 p-4">
                <!-- Top Row: Icon + Title & Slug + One-Click Status Toggle -->
                <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="cat-avatar {{ $gradClass }}">
                            <i class="bi {{ $cat->icon ?? 'bi-tags' }}"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-slate-900 mb-0 category-card-name">{{ $cat->name }}</h5>
                            <span class="badge bg-light text-muted border font-monospace mt-1 px-2 py-0.5 cat-slug-badge">
                                /{{ $cat->slug }}
                            </span>
                        </div>
                    </div>

                    <!-- Clickable Category Status Toggle Button -->
                    <form method="POST" action="{{ route('admin.categories.toggle-status', $cat->id) }}" class="d-inline m-0 p-0">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="cat-status-badge {{ $cat->status === 'active' ? 'status-active' : 'status-inactive' }}" 
                                title="Click to toggle category status (Currently {{ ucfirst($cat->status) }})">
                            <i class="bi bi-circle-fill cat-status-dot"></i>
                            <span>{{ ucfirst($cat->status) }}</span>
                            <i class="bi bi-arrow-repeat cat-status-icon"></i>
                        </button>
                    </form>
                </div>

                <!-- Description -->
                <p class="small text-muted mb-3 flex-grow-0 cat-desc-text">
                    {{ $cat->description ?: 'No detailed taxonomy description added yet.' }}
                </p>

                <!-- Metric Badges Row -->
                <div class="d-flex align-items-center gap-2 mb-3 pb-3 border-bottom">
                    <a href="{{ route('admin.products') }}?category_id={{ $cat->id }}" class="text-decoration-none">
                        <span class="badge cat-meta-prod rounded-pill py-1.5 px-3 fw-bold d-inline-flex align-items-center gap-1">
                            <i class="bi bi-box-seam"></i>
                            <span>{{ $cat->products_count }} Products</span>
                        </span>
                    </a>
                    <span class="badge cat-meta-subcat rounded-pill py-1.5 px-3 fw-semibold d-inline-flex align-items-center gap-1">
                        <i class="bi bi-diagram-2"></i>
                        <span>{{ $cat->subcategories->count() }} Subcategories</span>
                    </span>
                </div>

                <!-- Subcategories List with Edit and Delete options -->
                <div class="mb-3 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted cat-subcat-header">Subcategories</span>
                        <button type="button" class="btn-add-sub-pill" 
                                onclick="addSubcategoryModal({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                            <i class="bi bi-plus"></i> Add
                        </button>
                    </div>

                    <div class="d-flex flex-wrap gap-1.5 align-items-center cat-subcat-container">
                        @forelse($cat->subcategories as $sub)
                            <span class="subcat-chip {{ $sub->status === 'inactive' ? 'subcat-inactive' : '' }}">
                                <span>{{ $sub->name }}</span>
                                <span class="subcat-actions">
                                    <button type="button" class="subcat-action-btn subcat-edit-btn" 
                                            onclick="editSubcategoryModal({{ json_encode($sub) }}, '{{ addslashes($cat->name) }}')" 
                                            title="Edit Subcategory &quot;{{ $sub->name }}&quot;">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.categories.subcategories.destroy', $sub->id) }}" class="d-inline m-0 p-0" onsubmit="return confirm('Delete subcategory &quot;{{ $sub->name }}&quot;?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="subcat-action-btn subcat-del-btn" title="Delete Subcategory &quot;{{ $sub->name }}&quot;">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </span>
                            </span>
                        @empty
                            <div class="w-100 text-center py-2 px-3 border border-dashed rounded-3 bg-light">
                                <span class="text-muted small fst-italic">No subcategories defined yet.</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Card Footer Actions -->
                <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-primary fw-semibold px-2.5 py-1.5 rounded-start-3" 
                                onclick="editCategoryModal({{ json_encode($cat) }})">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </button>
                        <button type="button" class="btn btn-outline-secondary fw-semibold px-2.5 py-1.5 rounded-end-3" 
                                onclick="addSubcategoryModal({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                            <i class="bi bi-plus-lg me-1"></i> Add Sub
                        </button>
                    </div>

                    @if($cat->products_count === 0)
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('Are you sure you want to delete category &quot;{{ $cat->name }}&quot;?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-2.5 py-1.5 rounded-3" title="Delete Category">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    @else
                        <span class="text-muted small" title="Category has active products and cannot be deleted">
                            <i class="bi bi-lock-fill text-slate-400"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="admin-card p-5 text-center">
                <i class="bi bi-folder2-open display-4 text-muted mb-3"></i>
                <h5 class="fw-bold">No Categories Found</h5>
                <p class="text-muted">Get started by creating your first product category taxonomy.</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-lg me-1"></i> Add Category
                </button>
            </div>
        </div>
    @endforelse
</div>

<!-- Category Table List View (Hidden by default, toggleable) -->
<div class="admin-card d-none shadow-sm" id="categories-table-view">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th class="col-cat-main">Category</th>
                    <th>Slug</th>
                    <th>Subcategories</th>
                    <th class="text-center">Assigned Products</th>
                    <th>Status</th>
                    <th class="text-end col-cat-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                    <tr class="table-cat-row" 
                        data-name="{{ strtolower($cat->name) }}" 
                        data-desc="{{ strtolower($cat->description ?? '') }}"
                        data-subcat-count="{{ $cat->subcategories->count() }}"
                        data-subcat-names="{{ strtolower($cat->subcategories->pluck('name')->implode(' ')) }}">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 bg-primary-subtle text-primary p-2 fs-5 d-flex align-items-center justify-content-center cat-table-icon">
                                    <i class="bi {{ $cat->icon ?? 'bi-tags' }}"></i>
                                </div>
                                <div>
                                    <strong class="text-slate-900">{{ $cat->name }}</strong>
                                    <div class="small text-muted text-truncate cat-table-desc">{{ $cat->description ?: 'No description' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-muted font-monospace border">/{{ $cat->slug }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @forelse($cat->subcategories as $sub)
                                    <span class="subcat-chip {{ $sub->status === 'inactive' ? 'subcat-inactive' : '' }}">
                                        <span>{{ $sub->name }}</span>
                                        <span class="subcat-actions">
                                            <button type="button" class="subcat-action-btn subcat-edit-btn" 
                                                    onclick="editSubcategoryModal({{ json_encode($sub) }}, '{{ addslashes($cat->name) }}')" 
                                                    title="Edit {{ $sub->name }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.categories.subcategories.destroy', $sub->id) }}" class="d-inline m-0 p-0" onsubmit="return confirm('Delete subcategory &quot;{{ $sub->name }}&quot;?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="subcat-action-btn subcat-del-btn" title="Delete {{ $sub->name }}">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </span>
                                @empty
                                    <span class="text-muted small fst-italic">None</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.products') }}?category_id={{ $cat->id }}" class="text-decoration-none">
                                <span class="badge cat-meta-prod rounded-pill px-2.5 py-1 fw-bold">
                                    {{ $cat->products_count }} Items
                                </span>
                            </a>
                        </td>
                        <td>
                            <!-- Clickable Category Status Toggle Button in Table -->
                            <form method="POST" action="{{ route('admin.categories.toggle-status', $cat->id) }}" class="d-inline m-0 p-0">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="cat-status-badge {{ $cat->status === 'active' ? 'status-active' : 'status-inactive' }}" 
                                        title="Click to toggle status">
                                    <i class="bi bi-circle-fill cat-status-dot"></i>
                                    <span>{{ ucfirst($cat->status) }}</span>
                                    <i class="bi bi-arrow-repeat cat-status-icon"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" 
                                        onclick="editCategoryModal({{ json_encode($cat) }})" title="Edit Category">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" 
                                        onclick="addSubcategoryModal({{ $cat->id }}, '{{ addslashes($cat->name) }}')" title="Add Subcategory">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                                @if($cat->products_count === 0)
                                    <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" class="d-inline" onsubmit="return confirm('Delete category {{ $cat->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Add New Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="modal-header border-bottom py-3 px-4 bg-light rounded-top-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-primary text-white p-2 d-flex align-items-center justify-content-center cat-modal-header-icon">
                            <i class="bi bi-folder-plus fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-slate-900 mb-0" id="addCategoryModalLabel">Add New Category</h5>
                            <small class="text-muted">Define master classification for catalog products</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Graphics Cards, Processors, Monitors">
                    </div>

                    <!-- Interactive Visual Icon Picker -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold d-flex justify-content-between align-items-center">
                            <span>Category Icon</span>
                            <span class="text-muted fw-normal small">Click a hardware preset below</span>
                        </label>

                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="icon-preview-box" id="add_icon_preview">
                                <i class="bi bi-tags"></i>
                            </div>
                            <div class="flex-grow-1">
                                <input type="text" name="icon" id="add_icon_input" class="form-control font-monospace form-control-sm rounded-3" 
                                       value="bi-tags" placeholder="e.g. bi-cpu, bi-gpu-card">
                            </div>
                        </div>

                        <!-- Hardware Preset Icon Badges -->
                        <div class="icon-picker-grid" id="add_icon_presets">
                            <button type="button" class="icon-preset-btn active" data-icon="bi-tags" title="Tags / Accessories"><i class="bi bi-tags"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-cpu" title="Processor (CPU)"><i class="bi bi-cpu"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-gpu-card" title="Graphics Card (GPU)"><i class="bi bi-gpu-card"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-motherboard" title="Motherboard"><i class="bi bi-motherboard"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-memory" title="RAM Memory"><i class="bi bi-memory"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-hdd" title="Storage SSD / HDD"><i class="bi bi-hdd"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-laptop" title="Laptops"><i class="bi bi-laptop"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-pc-display" title="Desktop Computers"><i class="bi bi-pc-display"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-display" title="Monitors / Screens"><i class="bi bi-display"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-keyboard" title="Keyboards"><i class="bi bi-keyboard"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-mouse" title="Mice & Trackpads"><i class="bi bi-mouse"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-headphones" title="Headphones & Audio"><i class="bi bi-headphones"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-lightning-charge" title="Power Supply (PSU)"><i class="bi bi-lightning-charge"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-fan" title="Cooling Fans & Liquid"><i class="bi bi-fan"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-router" title="Networking / Routers"><i class="bi bi-router"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-printer" title="Printers & Scanners"><i class="bi bi-printer"></i></button>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Description <span class="text-muted fw-normal">(Optional)</span></label>
                        <textarea name="description" class="form-control rounded-3" rows="2" placeholder="Brief category description for website catalog..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top py-3 px-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary fw-semibold rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold rounded-3 px-4">
                        <i class="bi bi-check-lg me-1"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Category -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form method="POST" id="editCategoryForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom py-3 px-4 bg-light rounded-top-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-primary text-white p-2 d-flex align-items-center justify-content-center cat-modal-header-icon">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-slate-900 mb-0" id="editCategoryModalLabel">Edit Category</h5>
                            <small class="text-muted">Modify taxonomy metadata and display icon</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_cat_name" class="form-control rounded-3" required>
                    </div>

                    <!-- Interactive Visual Icon Picker (Edit) -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold d-flex justify-content-between align-items-center">
                            <span>Category Icon</span>
                            <span class="text-muted fw-normal small">Pick a preset or enter class</span>
                        </label>

                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="icon-preview-box" id="edit_icon_preview">
                                <i class="bi bi-tags"></i>
                            </div>
                            <div class="flex-grow-1">
                                <input type="text" name="icon" id="edit_cat_icon" class="form-control font-monospace form-control-sm rounded-3" placeholder="e.g. bi-cpu, bi-gpu-card">
                            </div>
                        </div>

                        <!-- Hardware Preset Icon Badges -->
                        <div class="icon-picker-grid" id="edit_icon_presets">
                            <button type="button" class="icon-preset-btn" data-icon="bi-tags" title="Tags / Accessories"><i class="bi bi-tags"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-cpu" title="Processor (CPU)"><i class="bi bi-cpu"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-gpu-card" title="Graphics Card (GPU)"><i class="bi bi-gpu-card"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-motherboard" title="Motherboard"><i class="bi bi-motherboard"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-memory" title="RAM Memory"><i class="bi bi-memory"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-hdd" title="Storage SSD / HDD"><i class="bi bi-hdd"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-laptop" title="Laptops"><i class="bi bi-laptop"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-pc-display" title="Desktop Computers"><i class="bi bi-pc-display"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-display" title="Monitors / Screens"><i class="bi bi-display"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-keyboard" title="Keyboards"><i class="bi bi-keyboard"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-mouse" title="Mice & Trackpads"><i class="bi bi-mouse"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-headphones" title="Headphones & Audio"><i class="bi bi-headphones"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-lightning-charge" title="Power Supply (PSU)"><i class="bi bi-lightning-charge"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-fan" title="Cooling Fans & Liquid"><i class="bi bi-fan"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-router" title="Networking / Routers"><i class="bi bi-router"></i></button>
                            <button type="button" class="icon-preset-btn" data-icon="bi-printer" title="Printers & Scanners"><i class="bi bi-printer"></i></button>
                        </div>
                    </div>

                    <!-- Status Change Option in Edit Category Modal -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" id="edit_cat_status" class="form-select rounded-3">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="description" id="edit_cat_desc" class="form-control rounded-3" rows="2"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top py-3 px-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary fw-semibold rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold rounded-3 px-4">
                        <i class="bi bi-check-lg me-1"></i> Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Subcategory -->
<div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form method="POST" id="addSubcategoryForm" action="">
                @csrf
                <div class="modal-header border-bottom py-3 px-4 bg-light rounded-top-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-primary text-white p-2 d-flex align-items-center justify-content-center cat-modal-header-icon">
                            <i class="bi bi-plus-circle fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-slate-900 mb-0" id="addSubcategoryModalLabel">Add Subcategory</h5>
                            <small class="text-muted">Create a subcategory segment under parent category</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <div class="text-muted small">Parent Category:</div>
                        <div class="fs-6 fw-bold text-slate-900 d-flex align-items-center gap-2 mt-1">
                            <i class="bi bi-folder-check text-primary"></i>
                            <span id="subcat_parent_name"></span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Subcategory Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" required 
                               placeholder="e.g. Mechanical Keyboards, Gaming Laptops, DDR5 RAM">
                    </div>
                </div>

                <div class="modal-footer border-top py-3 px-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary fw-semibold rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold rounded-3 px-4">
                        <i class="bi bi-check-lg me-1"></i> Add Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Subcategory -->
<div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form method="POST" id="editSubcategoryForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom py-3 px-4 bg-light rounded-top-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-primary text-white p-2 d-flex align-items-center justify-content-center cat-modal-header-icon">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-slate-900 mb-0" id="editSubcategoryModalLabel">Edit Subcategory</h5>
                            <small class="text-muted">Update subcategory details and active status</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <div class="text-muted small">Parent Category:</div>
                        <div class="fs-6 fw-bold text-slate-900 d-flex align-items-center gap-2 mt-1">
                            <i class="bi bi-folder-check text-primary"></i>
                            <span id="edit_subcat_parent_name"></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Subcategory Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_subcat_name" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" id="edit_subcat_status" class="form-select rounded-3">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer border-top py-3 px-4 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary fw-semibold rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold rounded-3 px-4">
                        <i class="bi bi-check-lg me-1"></i> Update Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Setup Icon Picker Interactions
    function setupIconPicker(presetsContainerId, inputId, previewBoxId) {
        const container = document.getElementById(presetsContainerId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewBoxId);
        if (!container || !input || !preview) return;

        // Button clicks
        container.querySelectorAll('.icon-preset-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const icon = btn.getAttribute('data-icon');
                input.value = icon;
                preview.innerHTML = `<i class="bi ${icon}"></i>`;
                
                container.querySelectorAll('.icon-preset-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });

        // Typing in input updates preview
        input.addEventListener('input', () => {
            const val = input.value.trim() || 'bi-tags';
            preview.innerHTML = `<i class="bi ${val}"></i>`;
            
            // Highlight preset if matching
            container.querySelectorAll('.icon-preset-btn').forEach(b => {
                if (b.getAttribute('data-icon') === val) {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        setupIconPicker('add_icon_presets', 'add_icon_input', 'add_icon_preview');
        setupIconPicker('edit_icon_presets', 'edit_cat_icon', 'edit_icon_preview');

        // View Switcher (Grid vs Table)
        const btnGrid = document.getElementById('btn-view-grid');
        const btnTable = document.getElementById('btn-view-table');
        const gridView = document.getElementById('categories-grid-view');
        const tableView = document.getElementById('categories-table-view');

        const savedView = localStorage.getItem('hoc_categories_view') || 'grid';
        if (savedView === 'table') {
            switchToTable();
        }

        function switchToGrid() {
            gridView.classList.remove('d-none');
            tableView.classList.add('d-none');
            btnGrid.classList.add('active', 'btn-white', 'shadow-xs');
            btnGrid.classList.remove('text-muted');
            btnTable.classList.remove('active', 'btn-white', 'shadow-xs');
            btnTable.classList.add('text-muted');
            localStorage.setItem('hoc_categories_view', 'grid');
        }

        function switchToTable() {
            gridView.classList.add('d-none');
            tableView.classList.remove('d-none');
            btnTable.classList.add('active', 'btn-white', 'shadow-xs');
            btnTable.classList.remove('text-muted');
            btnGrid.classList.remove('active', 'btn-white', 'shadow-xs');
            btnGrid.classList.add('text-muted');
            localStorage.setItem('hoc_categories_view', 'table');
        }

        btnGrid.addEventListener('click', switchToGrid);
        btnTable.addEventListener('click', switchToTable);

        // Live Search Filter
        const searchInput = document.getElementById('categorySearchInput');
        const filterBtns = document.querySelectorAll('.filter-tab-btn');
        let currentFilter = 'all';

        function applyFilters() {
            const query = (searchInput.value || '').trim().toLowerCase();

            // Filter Grid Items
            document.querySelectorAll('.category-item-wrapper').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const desc = item.getAttribute('data-desc') || '';
                const subnames = item.getAttribute('data-subcat-names') || '';
                const subcount = parseInt(item.getAttribute('data-subcat-count') || '0', 10);

                const matchesQuery = !query || name.includes(query) || desc.includes(query) || subnames.includes(query);
                
                let matchesFilter = true;
                if (currentFilter === 'has-sub') {
                    matchesFilter = subcount > 0;
                } else if (currentFilter === 'no-sub') {
                    matchesFilter = subcount === 0;
                }

                if (matchesQuery && matchesFilter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            // Filter Table Rows
            document.querySelectorAll('.table-cat-row').forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const desc = row.getAttribute('data-desc') || '';
                const subnames = row.getAttribute('data-subcat-names') || '';
                const subcount = parseInt(row.getAttribute('data-subcat-count') || '0', 10);

                const matchesQuery = !query || name.includes(query) || desc.includes(query) || subnames.includes(query);

                let matchesFilter = true;
                if (currentFilter === 'has-sub') {
                    matchesFilter = subcount > 0;
                } else if (currentFilter === 'no-sub') {
                    matchesFilter = subcount === 0;
                }

                if (matchesQuery && matchesFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', applyFilters);

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.getAttribute('data-filter');
                applyFilters();
            });
        });
    });

    // Populate Edit Category Modal
    function editCategoryModal(cat) {
        document.getElementById('edit_cat_name').value = cat.name;
        const iconVal = cat.icon || 'bi-tags';
        document.getElementById('edit_cat_icon').value = iconVal;
        document.getElementById('edit_cat_desc').value = cat.description || '';

        if (document.getElementById('edit_cat_status')) {
            document.getElementById('edit_cat_status').value = cat.status || 'active';
        }

        // Update preview icon
        const preview = document.getElementById('edit_icon_preview');
        if (preview) {
            preview.innerHTML = `<i class="bi ${iconVal}"></i>`;
        }

        // Highlight matching preset button
        const presets = document.getElementById('edit_icon_presets');
        if (presets) {
            presets.querySelectorAll('.icon-preset-btn').forEach(btn => {
                if (btn.getAttribute('data-icon') === iconVal) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        const form = document.getElementById('editCategoryForm');
        form.action = "{{ url('admin/categories') }}/" + cat.id;

        const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        modal.show();
    }

    // Populate Add Subcategory Modal
    function addSubcategoryModal(catId, catName) {
        document.getElementById('subcat_parent_name').innerText = catName;
        const form = document.getElementById('addSubcategoryForm');
        form.action = "{{ url('admin/categories') }}/" + catId + "/subcategories";

        const modal = new bootstrap.Modal(document.getElementById('addSubcategoryModal'));
        modal.show();
    }

    // Populate Edit Subcategory Modal
    function editSubcategoryModal(sub, parentName) {
        document.getElementById('edit_subcat_parent_name').innerText = parentName;
        document.getElementById('edit_subcat_name').value = sub.name;
        if (document.getElementById('edit_subcat_status')) {
            document.getElementById('edit_subcat_status').value = sub.status || 'active';
        }

        const form = document.getElementById('editSubcategoryForm');
        form.action = "{{ url('admin/categories/subcategories') }}/" + sub.id;

        const modal = new bootstrap.Modal(document.getElementById('editSubcategoryModal'));
        modal.show();
    }
</script>
@endpush

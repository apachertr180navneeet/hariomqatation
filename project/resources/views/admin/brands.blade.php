@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Hardware Brands</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $brands->count() }} Partner Brands
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Catalog & Inventory</span>
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">OEM & Component Partners</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-box-seam me-1"></i> View Products
        </a>
        <button type="button" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" data-bs-target="#addBrandModal">
            <i class="bi bi-plus-circle-fill fs-6"></i>
            <span>Add Brand</span>
        </button>
    </div>
</div>

<!-- Top KPI Summary Cards -->
@php
    $totalBrands = $brands->count();
    $totalLinkedProducts = $brands->sum('products_count');
    $activeBrandsCount = $brands->where('status', 'active')->count();
    $brandsWithProducts = $brands->where('products_count', '>', 0)->count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Total Brands</div>
                    <div class="catalog-kpi-val">{{ $totalBrands }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-award text-primary"></i> Certified OEM vendors</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-award-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Active Partners</div>
                    <div class="catalog-kpi-val text-success">{{ $activeBrandsCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-check-circle-fill text-success"></i> Operational status</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Catalog Products</div>
                    <div class="catalog-kpi-val text-indigo">{{ $totalLinkedProducts }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-boxes text-indigo"></i> Active SKUs assigned</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-boxes"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-amber">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Active Coverage</div>
                    <div class="catalog-kpi-val text-amber">{{ $brandsWithProducts }} / {{ $totalBrands }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-pie-chart-fill text-warning"></i> Brands with inventory</div>
                </div>
                <div class="catalog-kpi-icon icon-amber">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Search & Filter Toolbar -->
<div class="catalog-filter-card">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Live Instant Search -->
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 380px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="brandSearchInput" class="catalog-search-input" 
                   placeholder="Search brand name, slug, products...">
        </div>

        <!-- Filter Pill Chips -->
        <div class="filter-pills-bar">
            <button type="button" class="filter-pill active" data-filter="all">All ({{ $totalBrands }})</button>
            <button type="button" class="filter-pill" data-filter="with-products">With Products ({{ $brandsWithProducts }})</button>
            <button type="button" class="filter-pill" data-filter="empty-products">No Products ({{ $totalBrands - $brandsWithProducts }})</button>
        </div>

        <!-- View Switcher Toggle -->
        <div class="d-flex align-items-center gap-1 bg-light p-1 rounded-3 border">
            <button type="button" class="btn btn-sm btn-white shadow-xs fw-bold px-2.5 py-1 active" id="btn-brand-grid" title="Grid Cards View">
                <i class="bi bi-grid-fill me-1"></i> Grid
            </button>
            <button type="button" class="btn btn-sm text-muted fw-bold px-2.5 py-1" id="btn-brand-table" title="Table View">
                <i class="bi bi-list-ul me-1"></i> Table
            </button>
        </div>
    </div>
</div>

<!-- Brands Cards Grid View -->
<div class="row g-4" id="brands-grid-view">
    @forelse($brands as $index => $brand)
        @php
            $initial = strtoupper(substr($brand->name, 0, 1));
            $gradPresets = [
                'background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); color: #fff;',
                'background: linear-gradient(135deg, #7c3aed 0%, #c084fc 100%); color: #fff;',
                'background: linear-gradient(135deg, #059669 0%, #34d399 100%); color: #fff;',
                'background: linear-gradient(135deg, #d97706 0%, #fbbf24 100%); color: #fff;',
                'background: linear-gradient(135deg, #e11d48 0%, #fb7185 100%); color: #fff;',
                'background: linear-gradient(135deg, #0d9488 0%, #2dd4bf 100%); color: #fff;',
            ];
            $avatarGrad = $gradPresets[$index % count($gradPresets)];
        @endphp
        <div class="col-sm-6 col-md-4 col-xl-3 brand-item-wrapper" 
             data-name="{{ strtolower($brand->name) }}" 
             data-slug="{{ strtolower($brand->slug) }}"
             data-product-count="{{ $brand->products_count }}">
            <div class="brand-grid-card">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="brand-avatar-box" style="{{ $avatarGrad }}">
                        <span>{{ $initial }}</span>
                    </div>
                    <span class="stock-status-pill {{ $brand->status === 'active' ? 'healthy' : 'low' }}">
                        <span class="stock-dot"></span>
                        <span>{{ ucfirst($brand->status) }}</span>
                    </span>
                </div>

                <h5 class="fw-bold text-slate-900 mb-1 brand-title">{{ $brand->name }}</h5>
                <small class="text-muted font-monospace d-block mb-3">
                    <i class="bi bi-link-45deg me-1"></i>{{ $brand->slug }}
                </small>

                <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.products', ['brand_id' => $brand->id]) }}" class="text-decoration-none">
                        <span class="badge cat-meta-prod rounded-pill px-2.5 py-1.5 fw-semibold d-inline-flex align-items-center gap-1">
                            <i class="bi bi-box-seam"></i>
                            <span>{{ $brand->products_count }} Products</span>
                        </span>
                    </a>

                    <div class="d-flex align-items-center gap-1">
                        <button type="button" class="catalog-action-btn btn-edit" 
                                onclick="editBrandModal({{ json_encode($brand) }})" title="Edit Brand">
                            <i class="bi bi-pencil"></i>
                        </button>
                        @if($brand->products_count === 0)
                            <form method="POST" action="{{ route('admin.brands.destroy', $brand->id) }}" class="d-inline delete-form m-0" data-confirm-title="Delete Brand?" data-confirm="Are you sure you want to delete brand &quot;{{ $brand->name }}&quot;?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="catalog-action-btn btn-danger" title="Delete Brand">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        @else
                            <span class="catalog-action-btn text-muted opacity-50" title="Has active products">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="catalog-card p-5 text-center">
                <i class="bi bi-award display-4 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-slate-900">No Brands Added Yet</h5>
                <p class="text-muted">Register your computer hardware brand partners to organize products.</p>
                <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                    <i class="bi bi-plus-lg me-1"></i> Add First Brand
                </button>
            </div>
        </div>
    @endforelse
</div>

<!-- Brands Table View (Toggleable) -->
<div class="catalog-card d-none shadow-sm" id="brands-table-view">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th>Brand & Identifier</th>
                    <th>Slug / URL</th>
                    <th>Active Products</th>
                    <th>Catalog Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $index => $brand)
                    @php
                        $initial = strtoupper(substr($brand->name, 0, 1));
                    @endphp
                    <tr class="brand-table-row" 
                        data-name="{{ strtolower($brand->name) }}" 
                        data-slug="{{ strtolower($brand->slug) }}"
                        data-product-count="{{ $brand->products_count }}">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="catalog-avatar-box fw-bold">
                                    {{ $initial }}
                                </div>
                                <div>
                                    <strong class="d-block text-slate-900 fs-6">{{ $brand->name }}</strong>
                                    <small class="text-muted">ID: #{{ $brand->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="catalog-sku-code">/{{ $brand->slug }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.products', ['brand_id' => $brand->id]) }}" class="text-decoration-none">
                                <span class="badge cat-meta-prod rounded-pill px-3 py-1.5 fw-semibold d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-box-seam"></i>
                                    <span>{{ $brand->products_count }} Items</span>
                                </span>
                            </a>
                        </td>
                        <td>
                            <span class="stock-status-pill {{ $brand->status === 'active' ? 'healthy' : 'low' }}">
                                <span class="stock-dot"></span>
                                <span>{{ ucfirst($brand->status) }}</span>
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <button type="button" class="catalog-action-btn btn-edit" 
                                        onclick="editBrandModal({{ json_encode($brand) }})" title="Edit Brand">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @if($brand->products_count === 0)
                                    <form method="POST" action="{{ route('admin.brands.destroy', $brand->id) }}" class="d-inline delete-form m-0" data-confirm-title="Delete Brand?" data-confirm="Are you sure you want to delete brand &quot;{{ $brand->name }}&quot;?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="catalog-action-btn btn-danger" title="Delete Brand">
                                            <i class="bi bi-trash3"></i>
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

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" action="{{ route('admin.brands.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-25 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-award fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="addBrandModalLabel">Add Hardware Brand</h5>
                            <small class="text-white-50">Create a new component or device manufacturer</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" required placeholder="e.g. Dell, Intel, Asus, Corsair">
                        <div class="form-text small text-muted">Slug will automatically be generated from the name.</div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Status</label>
                        <select name="status" class="form-select rounded-3 py-2">
                            <option value="active" selected>Active (Visible in Catalog)</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Save Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form method="POST" id="editBrandForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header bg-slate-900 text-white p-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-3 bg-white bg-opacity-10 p-2 text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white" id="editBrandModalLabel">Edit Brand Details</h5>
                            <small class="text-white-50">Update partner information</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-slate-800">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_brand_name" class="form-control rounded-3 py-2" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-slate-800">Status</label>
                        <select name="status" id="edit_brand_status" class="form-select rounded-3 py-2">
                            <option value="active">Active (Visible)</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Update Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gridView = document.getElementById('brands-grid-view');
        const tableView = document.getElementById('brands-table-view');
        const btnGrid = document.getElementById('btn-brand-grid');
        const btnTable = document.getElementById('btn-brand-table');

        // View toggle
        const savedView = localStorage.getItem('hoc_brands_view') || 'grid';
        if (savedView === 'table') {
            switchToTable();
        }

        function switchToGrid() {
            if (gridView && tableView) {
                gridView.classList.remove('d-none');
                tableView.classList.add('d-none');
                btnGrid.classList.add('active', 'btn-white', 'shadow-xs');
                btnGrid.classList.remove('text-muted');
                btnTable.classList.remove('active', 'btn-white', 'shadow-xs');
                btnTable.classList.add('text-muted');
                localStorage.setItem('hoc_brands_view', 'grid');
            }
        }

        function switchToTable() {
            if (gridView && tableView) {
                gridView.classList.add('d-none');
                tableView.classList.remove('d-none');
                btnTable.classList.add('active', 'btn-white', 'shadow-xs');
                btnTable.classList.remove('text-muted');
                btnGrid.classList.remove('active', 'btn-white', 'shadow-xs');
                btnGrid.classList.add('text-muted');
                localStorage.setItem('hoc_brands_view', 'table');
            }
        }

        if (btnGrid) btnGrid.addEventListener('click', switchToGrid);
        if (btnTable) btnTable.addEventListener('click', switchToTable);

        // Search & Filter
        const searchInput = document.getElementById('brandSearchInput');
        const filterBtns = document.querySelectorAll('.filter-pills-bar .filter-pill');
        let currentFilter = 'all';

        function applyBrandFilter() {
            const query = (searchInput.value || '').trim().toLowerCase();

            // Filter Grid Items
            document.querySelectorAll('.brand-item-wrapper').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const slug = item.getAttribute('data-slug') || '';
                const pCount = parseInt(item.getAttribute('data-product-count') || '0', 10);

                const matchesQuery = !query || name.includes(query) || slug.includes(query);
                let matchesFilter = true;
                if (currentFilter === 'with-products') matchesFilter = pCount > 0;
                else if (currentFilter === 'empty-products') matchesFilter = pCount === 0;

                item.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });

            // Filter Table Rows
            document.querySelectorAll('.brand-table-row').forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const slug = row.getAttribute('data-slug') || '';
                const pCount = parseInt(row.getAttribute('data-product-count') || '0', 10);

                const matchesQuery = !query || name.includes(query) || slug.includes(query);
                let matchesFilter = true;
                if (currentFilter === 'with-products') matchesFilter = pCount > 0;
                else if (currentFilter === 'empty-products') matchesFilter = pCount === 0;

                row.style.display = (matchesQuery && matchesFilter) ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyBrandFilter);

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.getAttribute('data-filter');
                applyBrandFilter();
            });
        });
    });

    function editBrandModal(brand) {
        document.getElementById('edit_brand_name').value = brand.name;
        if (document.getElementById('edit_brand_status')) {
            document.getElementById('edit_brand_status').value = brand.status || 'active';
        }
        
        const form = document.getElementById('editBrandForm');
        form.action = "{{ url('admin/brands') }}/" + brand.id;
        
        const modal = new bootstrap.Modal(document.getElementById('editBrandModal'));
        modal.show();
    }
</script>
@endpush

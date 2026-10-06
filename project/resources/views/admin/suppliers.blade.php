@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Suppliers & Distributors</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $totalSuppliers }} Registered Vendors
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">Procurement & Inventory</span> 
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">National Distributors & Inward Accounts</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.purchases') }}" class="btn btn-outline-secondary fw-semibold px-3 py-2 rounded-3 d-flex align-items-center gap-2">
            <i class="bi bi-receipt"></i>
            <span>Inward Bills</span>
        </a>
        <button type="button" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" data-bs-target="#addSupplierModal">
            <i class="bi bi-building-add fs-6"></i>
            <span>Add Supplier</span>
        </button>
    </div>
</div>

<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm mb-4 border-0" role="alert">
        <i class="bi bi-check-circle-fill fs-5 text-success"></i>
        <div class="fw-medium">{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm mb-4 border-0" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
        <div class="fw-medium">{{ session('error') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4 border-0" role="alert">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-exclamation-circle-fill fs-5 text-danger"></i>
            <strong>Please correct the following errors:</strong>
        </div>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Registered Vendors</div>
                    <div class="catalog-kpi-val">{{ $totalSuppliers }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-truck text-primary"></i> Tier-1 & Regional Partners</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-truck"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Active Distis</div>
                    <div class="catalog-kpi-val text-indigo">{{ $activeSuppliers }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-check2-circle text-indigo"></i> In regular procurement</div>
                </div>
                <div class="catalog-kpi-icon icon-indigo">
                    <i class="bi bi-building-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-emerald">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Inward Purchases</div>
                    <div class="catalog-kpi-val text-success">₹{{ number_format($totalInwardValue, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-arrow-down-left text-success"></i> Lifetime stock inward value</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-box-arrow-in-down"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $totalOutstandingPayables > 0 ? 'kpi-rose' : 'kpi-emerald' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Vendor Payables</div>
                    <div class="catalog-kpi-val {{ $totalOutstandingPayables > 0 ? 'text-danger' : 'text-success' }}">
                        ₹{{ number_format($totalOutstandingPayables, 0) }}
                    </div>
                    <div class="catalog-kpi-sub">
                        @if($totalOutstandingPayables > 0)
                            <span class="text-danger fw-bold"><i class="bi bi-exclamation-circle-fill"></i> Pending distributor bills</span>
                        @else
                            <span class="text-success fw-bold"><i class="bi bi-shield-check"></i> No pending payables</span>
                        @endif
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $totalOutstandingPayables > 0 ? 'icon-rose' : 'icon-emerald' }}">
                    <i class="bi {{ $totalOutstandingPayables > 0 ? 'bi-hourglass-split' : 'bi-shield-check' }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Status Filter Toolbar -->
<div class="catalog-filter-card mb-4">
    <form method="GET" action="{{ route('admin.suppliers') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 m-0">
        <!-- Search Box -->
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 420px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="catalog-search-input" 
                   value="{{ request('search') }}"
                   placeholder="Search company, contact person, phone, GSTIN, city...">
        </div>

        <!-- Filter Pill Tabs -->
        <div class="filter-pills-bar">
            <a href="{{ route('admin.suppliers', array_merge(request()->except('status'), ['status' => 'ALL'])) }}" 
               class="filter-pill {{ ($currentStatus === 'ALL' || !$currentStatus) ? 'active' : '' }}">
                All Vendors ({{ $totalSuppliers }})
            </a>
            <a href="{{ route('admin.suppliers', array_merge(request()->except('status'), ['status' => 'active'])) }}" 
               class="filter-pill {{ $currentStatus === 'active' ? 'active' : '' }}">
                Active ({{ $activeSuppliers }})
            </a>
            <a href="{{ route('admin.suppliers', array_merge(request()->except('status'), ['status' => 'inactive'])) }}" 
               class="filter-pill {{ $currentStatus === 'inactive' ? 'active' : '' }}">
                Inactive ({{ $totalSuppliers - $activeSuppliers }})
            </a>
        </div>
    </form>
</div>

<!-- Suppliers Directory Table -->
<div class="catalog-card shadow-sm p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table catalog-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Distributor Company</th>
                    <th>Contact Person</th>
                    <th>Phone / Email</th>
                    <th>GSTIN</th>
                    <th>Hub / City</th>
                    <th>Payment Terms</th>
                    <th>Inwards</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle bg-primary-subtle text-primary fw-bold fs-6">
                                    {{ strtoupper(substr($supplier->company, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark fs-6">{{ $supplier->company }}</div>
                                    <small class="text-muted d-block font-monospace">ID: #SUP-{{ str_pad($supplier->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold text-slate-800">{{ $supplier->name }}</div>
                        </td>
                        <td>
                            <div class="text-dark fw-medium"><i class="bi bi-telephone text-muted me-1"></i>{{ $supplier->phone }}</div>
                            @if($supplier->email)
                                <div class="text-muted small"><i class="bi bi-envelope text-muted me-1"></i>{{ $supplier->email }}</div>
                            @endif
                        </td>
                        <td>
                            @if($supplier->gstin)
                                <span class="badge bg-light text-dark border font-monospace px-2.5 py-1.5">{{ $supplier->gstin }}</span>
                            @else
                                <span class="text-muted small">Unregistered</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium text-dark">{{ $supplier->city ?: 'N/A' }}</div>
                            @if($supplier->state)
                                <small class="text-muted">{{ $supplier->state }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2.5 py-1 fw-semibold">
                                {{ $supplier->payment_terms }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5 py-1 fw-bold">
                                {{ $supplier->purchases_count }} Bills
                            </span>
                        </td>
                        <td>
                            @if($supplier->status === 'active')
                                <span class="badge badge-soft-success">Active</span>
                            @else
                                <span class="badge badge-soft-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex align-items-center justify-content-end gap-1">
                                <button type="button" class="btn btn-sm btn-light border text-primary edit-supplier-btn" 
                                        title="Edit Distributor"
                                        data-id="{{ $supplier->id }}"
                                        data-company="{{ $supplier->company }}"
                                        data-name="{{ $supplier->name }}"
                                        data-phone="{{ $supplier->phone }}"
                                        data-email="{{ $supplier->email }}"
                                        data-gstin="{{ $supplier->gstin }}"
                                        data-address="{{ $supplier->address }}"
                                        data-city="{{ $supplier->city }}"
                                        data-state="{{ $supplier->state }}"
                                        data-payment_terms="{{ $supplier->payment_terms }}"
                                        data-bank_details="{{ $supplier->bank_details }}"
                                        data-status="{{ $supplier->status }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete distributor {{ $supplier->company }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete Distributor">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <div class="py-4">
                                <i class="bi bi-truck display-5 text-muted mb-3 d-block"></i>
                                <h5>No Distributors Found</h5>
                                <p class="text-muted small">No suppliers match your active filter criteria.</p>
                                <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                                    <i class="bi bi-building-add me-1"></i> Register New Distributor
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($suppliers->hasPages())
        <div class="p-3 border-top d-flex align-items-center justify-content-between">
            <div class="text-muted small">
                Showing {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }} of {{ $suppliers->total() }} vendors
            </div>
            <div>
                {{ $suppliers->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-slate-900 text-white p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary text-white rounded-3 p-2.5">
                        <i class="bi bi-building-add fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold m-0" id="addSupplierModalLabel">Register Hardware Distributor</h5>
                        <small class="text-white-50">Add distributor firm, warehouse contact, GSTIN and billing terms</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.suppliers.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold text-slate-800">Distributor Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company" class="form-control form-control-lg rounded-3" 
                                   placeholder="e.g. Savex Technologies Pvt Ltd" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-slate-800">Contact Person / Manager <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-3" 
                                   placeholder="e.g. Rajesh Sharma" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control rounded-3" 
                                   placeholder="+91 98200 11223" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3" 
                                   placeholder="disti.orders@company.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">GSTIN Number</label>
                            <input type="text" name="gstin" class="form-control font-monospace rounded-3 text-uppercase" 
                                   placeholder="27AAACS1429B1ZX" maxlength="15">
                            <small class="text-muted">15-digit GST identification number for ITC claims</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Payment Terms <span class="text-danger">*</span></label>
                            <select name="payment_terms" class="form-select rounded-3" required>
                                <option value="Net 30" selected>Net 30 Days (Credit)</option>
                                <option value="Net 15">Net 15 Days (Credit)</option>
                                <option value="Immediate">Immediate / COD</option>
                                <option value="Advance">100% Advance Payment</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Hub / City</label>
                            <input type="text" name="city" class="form-control rounded-3" placeholder="e.g. Mumbai">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">State</label>
                            <input type="text" name="state" class="form-control rounded-3" placeholder="e.g. Maharashtra">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-slate-800">Warehouse / Billing Address</label>
                            <textarea name="address" class="form-control rounded-3" rows="2" 
                                      placeholder="Full warehouse or head office address..."></textarea>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-slate-800">Bank RTGS / NEFT Details</label>
                            <input type="text" name="bank_details" class="form-control rounded-3" 
                                   placeholder="Bank Name, Account No, IFSC Code">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-slate-800">Account Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary px-4 rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold rounded-3">Register Distributor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-slate-900 text-white p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary text-white rounded-3 p-2.5">
                        <i class="bi bi-pencil-square fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold m-0" id="editSupplierModalLabel">Edit Distributor Account</h5>
                        <small class="text-white-50">Update vendor details, contact info and payment terms</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSupplierForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold text-slate-800">Distributor Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company" id="edit_company" class="form-control form-control-lg rounded-3" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold text-slate-800">Contact Person / Manager <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_name" class="form-control form-control-lg rounded-3" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" id="edit_phone" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Email Address</label>
                            <input type="email" name="email" id="edit_email" class="form-control rounded-3">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">GSTIN Number</label>
                            <input type="text" name="gstin" id="edit_gstin" class="form-control font-monospace rounded-3 text-uppercase" maxlength="15">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Payment Terms <span class="text-danger">*</span></label>
                            <select name="payment_terms" id="edit_payment_terms" class="form-select rounded-3" required>
                                <option value="Net 30">Net 30 Days (Credit)</option>
                                <option value="Net 15">Net 15 Days (Credit)</option>
                                <option value="Immediate">Immediate / COD</option>
                                <option value="Advance">100% Advance Payment</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">Hub / City</label>
                            <input type="text" name="city" id="edit_city" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-slate-800">State</label>
                            <input type="text" name="state" id="edit_state" class="form-control rounded-3">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-slate-800">Warehouse / Billing Address</label>
                            <textarea name="address" id="edit_address" class="form-control rounded-3" rows="2"></textarea>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold text-slate-800">Bank RTGS / NEFT Details</label>
                            <input type="text" name="bank_details" id="edit_bank_details" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-slate-800">Account Status <span class="text-danger">*</span></label>
                            <select name="status" id="edit_status" class="form-select rounded-3" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary px-4 rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold rounded-3">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editModal = new bootstrap.Modal(document.getElementById('editSupplierModal'));
    const editForm = document.getElementById('editSupplierForm');

    document.querySelectorAll('.edit-supplier-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            editForm.action = `/admin/suppliers/${id}`;

            document.getElementById('edit_company').value = this.getAttribute('data-company') || '';
            document.getElementById('edit_name').value = this.getAttribute('data-name') || '';
            document.getElementById('edit_phone').value = this.getAttribute('data-phone') || '';
            document.getElementById('edit_email').value = this.getAttribute('data-email') || '';
            document.getElementById('edit_gstin').value = this.getAttribute('data-gstin') || '';
            document.getElementById('edit_address').value = this.getAttribute('data-address') || '';
            document.getElementById('edit_city').value = this.getAttribute('data-city') || '';
            document.getElementById('edit_state').value = this.getAttribute('data-state') || '';
            document.getElementById('edit_payment_terms').value = this.getAttribute('data-payment_terms') || 'Net 30';
            document.getElementById('edit_bank_details').value = this.getAttribute('data-bank_details') || '';
            document.getElementById('edit_status').value = this.getAttribute('data-status') || 'active';

            editModal.show();
        });
    });
});
</script>
@endpush

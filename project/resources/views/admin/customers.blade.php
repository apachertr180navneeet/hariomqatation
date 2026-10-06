@extends('admin.includes.app')

@section('content')
<!-- Page Header -->
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="page-title fs-2 fw-bold text-slate-900 m-0">Customer CRM Accounts</h1>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-bold fs-7">
                {{ $totalCustomers }} Registered Clients
            </span>
        </div>
        <div class="page-breadcrumb text-muted small">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted"><i class="bi bi-house me-1"></i>Dashboard</a> 
            <span class="mx-1">&bull;</span>
            <span class="text-secondary">CRM & Commercial</span> 
            <span class="mx-1">&bull;</span>
            <span class="text-dark fw-semibold">Client Directory & Ledgers</span>
        </div>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn btn-primary fw-bold px-3 py-2 shadow-sm rounded-3 d-flex align-items-center gap-2" 
                data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="bi bi-person-plus-fill fs-6"></i>
            <span>Add Customer</span>
        </button>
    </div>
</div>

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Total Clients</div>
                    <div class="catalog-kpi-val">{{ $totalCustomers }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-people text-primary"></i> Retail & Corporate base</div>
                </div>
                <div class="catalog-kpi-icon icon-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card kpi-indigo">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">B2B GST Accounts</div>
                    <div class="catalog-kpi-val text-indigo">{{ $corporateCount }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-building text-indigo"></i> Input Tax Credit eligible</div>
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
                    <div class="catalog-kpi-label">Total Invoiced</div>
                    <div class="catalog-kpi-val text-success">₹{{ number_format($totalSalesIssued, 0) }}</div>
                    <div class="catalog-kpi-sub"><i class="bi bi-receipt text-success"></i> Gross billed revenue</div>
                </div>
                <div class="catalog-kpi-icon icon-emerald">
                    <i class="bi bi-cash-coin"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="catalog-kpi-card {{ $totalPendingBalance > 0 ? 'kpi-rose' : 'kpi-emerald' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="catalog-kpi-label">Outstanding Balance</div>
                    <div class="catalog-kpi-val {{ $totalPendingBalance > 0 ? 'text-danger' : 'text-success' }}">
                        ₹{{ number_format($totalPendingBalance, 0) }}
                    </div>
                    <div class="catalog-kpi-sub">
                        @if($totalPendingBalance > 0)
                            <span class="text-danger fw-bold"><i class="bi bi-exclamation-circle-fill"></i> Pending receivable</span>
                        @else
                            <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> All accounts cleared</span>
                        @endif
                    </div>
                </div>
                <div class="catalog-kpi-icon {{ $totalPendingBalance > 0 ? 'icon-rose' : 'icon-emerald' }}">
                    <i class="bi {{ $totalPendingBalance > 0 ? 'bi-hourglass-split' : 'bi-shield-check' }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Type Filter Toolbar -->
<div class="catalog-filter-card mb-4">
    <form method="GET" action="{{ route('admin.customers') }}" class="d-flex flex-wrap align-items-center justify-content-between gap-3 m-0">
        <!-- Live Search -->
        <div class="catalog-search-wrap flex-grow-1" style="max-width: 420px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="catalog-search-input" 
                   value="{{ request('search') }}"
                   placeholder="Search client name, company, phone, GSTIN...">
        </div>

        <!-- Filter Pill Tabs -->
        <div class="filter-pills-bar">
            <a href="{{ route('admin.customers', array_merge(request()->except('type'), ['type' => 'ALL'])) }}" 
               class="filter-pill {{ ($currentType === 'ALL' || !$currentType) ? 'active' : '' }}">
                All ({{ $totalCustomers }})
            </a>
            <a href="{{ route('admin.customers', array_merge(request()->except('type'), ['type' => 'Retail'])) }}" 
               class="filter-pill {{ $currentType === 'Retail' ? 'active' : '' }}">
                Retail
            </a>
            <a href="{{ route('admin.customers', array_merge(request()->except('type'), ['type' => 'Corporate'])) }}" 
               class="filter-pill {{ $currentType === 'Corporate' ? 'active' : '' }}">
                Corporate
            </a>
            <a href="{{ route('admin.customers', array_merge(request()->except('type'), ['type' => 'Institutional'])) }}" 
               class="filter-pill {{ $currentType === 'Institutional' ? 'active' : '' }}">
                Institutional
            </a>
            <a href="{{ route('admin.customers', array_merge(request()->except('type'), ['type' => 'Reseller'])) }}" 
               class="filter-pill {{ $currentType === 'Reseller' ? 'active' : '' }}">
                Reseller
            </a>
        </div>
    </form>
</div>

<!-- Customers Table -->
<div class="catalog-card shadow-sm p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table-catalog align-middle mb-0">
            <thead>
                <tr>
                    <th style="min-width: 250px;">Customer & Firm</th>
                    <th>Contact Details</th>
                    <th>Client Type</th>
                    <th>GSTIN</th>
                    <th class="text-center">Invoices</th>
                    <th class="text-end">Total Purchases</th>
                    <th class="text-end">Balance</th>
                    <th class="text-end" style="min-width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    @php
                        $initial = strtoupper(substr($customer->name, 0, 1));
                        $totalPurchases = $customer->totalPurchases();
                        $balance = $customer->pendingBalance();
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="catalog-avatar-box fw-bold" style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); color: #0369a1;">
                                    {{ $initial }}
                                </div>
                                <div>
                                    <strong class="d-block text-slate-900 fs-6">{{ $customer->name }}</strong>
                                    <small class="text-muted">{{ $customer->company ?: 'Individual Retail' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-slate-800 fw-semibold"><i class="bi bi-telephone text-muted me-1 small"></i>{{ $customer->phone }}</div>
                            @if($customer->email)
                                <small class="text-muted d-block"><i class="bi bi-envelope text-muted me-1 small"></i>{{ $customer->email }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-slate-700 border font-monospace px-2 py-1" style="font-size: 0.75rem;">
                                {{ $customer->type }}
                            </span>
                        </td>
                        <td>
                            @if($customer->gstin)
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle font-monospace px-2 py-1" style="font-size: 0.75rem;">
                                    {{ $customer->gstin }}
                                </span>
                            @else
                                <span class="text-muted small">&mdash;</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-slate-800 border px-2.5 py-1 fw-bold">
                                {{ $customer->invoices_count }}
                            </span>
                        </td>
                        <td class="text-end fw-bold text-slate-900">
                            ₹{{ number_format($totalPurchases, 2) }}
                        </td>
                        <td class="text-end fw-bold {{ $balance > 0 ? 'text-danger' : 'text-success' }}">
                            ₹{{ number_format($balance, 2) }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <button type="button" class="catalog-action-btn btn-edit" 
                                        onclick="editCustomerModal({{ json_encode($customer) }})" title="Edit Customer">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.customers.destroy', $customer->id) }}" class="d-inline delete-form m-0"
                                      data-confirm-title="Delete Client?" 
                                      data-confirm="Are you sure you want to remove client account &quot;{{ $customer->name }}&quot;?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="catalog-action-btn btn-danger" title="Delete Client" {{ $customer->invoices_count > 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-people display-5 d-block mb-2 opacity-50"></i>
                            <h5>No Client Accounts Found</h5>
                            <p class="small text-muted mb-3">Register your retail or corporate clients to track tax invoices and quotations.</p>
                            <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                <i class="bi bi-person-plus-fill me-1"></i> Register First Customer
                            </button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($customers->hasPages())
        <div class="p-3 px-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3 bg-light bg-opacity-50">
            <div class="text-muted small">
                Showing <strong>{{ $customers->firstItem() ?? 0 }}-{{ $customers->lastItem() ?? 0 }}</strong> of <strong>{{ $customers->total() }}</strong> clients
            </div>
            <div>
                {{ $customers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

<!-- Modal: Add Customer -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form method="POST" action="{{ route('admin.customers.store') }}">
                @csrf
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold text-slate-900">
                        <i class="bi bi-person-plus-fill text-primary me-2"></i> Register New Client Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Customer Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. Vikram Rathore">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Company / Firm Name</label>
                            <input type="text" name="company" class="form-control" placeholder="e.g. Rathore Infotech Pvt Ltd">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Mobile Phone <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control" required placeholder="e.g. 9829012345">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="e.g. vikram@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">GSTIN (Input Tax Credit)</label>
                            <input type="text" name="gstin" class="form-control text-uppercase" placeholder="e.g. 08AABCR1234F1Z3">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Client Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="Retail">Retail</option>
                                <option value="Corporate">Corporate</option>
                                <option value="Institutional">Institutional</option>
                                <option value="Reseller">Reseller</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Account Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Billing Address</label>
                            <input type="text" name="address" class="form-control" placeholder="e.g. Plot 14, Light Industrial Area">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">City</label>
                            <input type="text" name="city" class="form-control" value="Jodhpur">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Internal Account Notes</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Credit term notes, preferred delivery address, etc."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary fw-semibold px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Customer -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form id="editCustomerForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom p-4">
                    <h5 class="modal-title fw-bold text-slate-900">
                        <i class="bi bi-pencil-square text-primary me-2"></i> Update Client Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Customer Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit-cust-name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Company / Firm Name</label>
                            <input type="text" name="company" id="edit-cust-company" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Mobile Phone <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" id="edit-cust-phone" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" id="edit-cust-email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">GSTIN (Input Tax Credit)</label>
                            <input type="text" name="gstin" id="edit-cust-gstin" class="form-control text-uppercase">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Client Type <span class="text-danger">*</span></label>
                            <select name="type" id="edit-cust-type" class="form-select" required>
                                <option value="Retail">Retail</option>
                                <option value="Corporate">Corporate</option>
                                <option value="Institutional">Institutional</option>
                                <option value="Reseller">Reseller</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Account Status</label>
                            <select name="status" id="edit-cust-status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Billing Address</label>
                            <input type="text" name="address" id="edit-cust-address" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">City</label>
                            <input type="text" name="city" id="edit-cust-city" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Internal Account Notes</label>
                            <textarea name="notes" id="edit-cust-notes" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3 bg-light">
                    <button type="button" class="btn btn-outline-secondary fw-semibold px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function editCustomerModal(customer) {
        document.getElementById('editCustomerForm').action = `/admin/customers/${customer.id}`;
        document.getElementById('edit-cust-name').value = customer.name || '';
        document.getElementById('edit-cust-company').value = customer.company || '';
        document.getElementById('edit-cust-phone').value = customer.phone || '';
        document.getElementById('edit-cust-email').value = customer.email || '';
        document.getElementById('edit-cust-gstin').value = customer.gstin || '';
        document.getElementById('edit-cust-type').value = customer.type || 'Retail';
        document.getElementById('edit-cust-status').value = customer.status || 'active';
        document.getElementById('edit-cust-address').value = customer.address || '';
        document.getElementById('edit-cust-city').value = customer.city || 'Jodhpur';
        document.getElementById('edit-cust-notes').value = customer.notes || '';

        new bootstrap.Modal(document.getElementById('editCustomerModal')).show();
    }
</script>
@endpush

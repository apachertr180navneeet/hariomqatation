@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Company Configuration</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Legal Entity, GST & Bank Info</span>
        </div>
    </div>
    <button class="btn btn-primary" onclick="HOC_UTILS.showToast('Settings saved successfully!')">
        <i class="bi bi-save me-1"></i> Save Changes
    </button>
</div>

<div class="row g-4">
    <!-- Firm Details -->
    <div class="col-lg-6">
        <div class="admin-card p-4 h-100">
            <h5 class="admin-card-title mb-3"><i class="bi bi-building me-2 text-primary"></i> Business Identity</h5>
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Company / Shop Name</label>
                <input type="text" class="form-control" value="Hari Om Computer">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Official Tagline</label>
                <input type="text" class="form-control" value="Your Trusted Computer & Technology Partner">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">GSTIN Number</label>
                <input type="text" class="form-control font-monospace" value="08AABCH1234F1Z9">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">PAN Number</label>
                <input type="text" class="form-control font-monospace" value="AABCH1234F">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Showroom Address</label>
                <textarea class="form-control" rows="2">Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001</textarea>
            </div>
        </div>
    </div>

    <!-- Bank Details for Invoice & Quotation -->
    <div class="col-lg-6">
        <div class="admin-card p-4 h-100">
            <h5 class="admin-card-title mb-3"><i class="bi bi-bank me-2 text-primary"></i> Bank Account for Client Transfers</h5>
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Beneficiary Name</label>
                <input type="text" class="form-control" value="HARI OM COMPUTER">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Bank Name</label>
                <input type="text" class="form-control" value="HDFC Bank Ltd">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Account Number</label>
                <input type="text" class="form-control font-monospace" value="50200087654321">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">IFSC Code</label>
                <input type="text" class="form-control font-monospace" value="HDFC0001234">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Branch</label>
                <input type="text" class="form-control" value="Sojati Gate, Jodhpur">
            </div>
        </div>
    </div>

    <!-- Numbering Formats -->
    <div class="col-12">
        <div class="admin-card p-4">
            <h5 class="admin-card-title mb-3"><i class="bi bi-123 me-2 text-primary"></i> Document Numbering Prefix Sequences</h5>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Quotation Prefix</label>
                    <input type="text" class="form-control font-monospace" value="HOC/QTN/2026/">
                    <small class="text-muted">Sample: HOC/QTN/2026/0001</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Tax Invoice Prefix</label>
                    <input type="text" class="form-control font-monospace" value="HOC/INV/2026/">
                    <small class="text-muted">Sample: HOC/INV/2026/0001</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Custom PC Build ID</label>
                    <input type="text" class="form-control font-monospace" value="HOC/PC/2026/">
                    <small class="text-muted">Sample: HOC/PC/2026/0001</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

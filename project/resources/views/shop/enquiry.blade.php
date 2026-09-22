@extends('shop.includes.app')

@section('content')
<!-- Page Header -->
<div class="bg-white border-bottom py-3">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-0">Product Enquiry & Quotation Request</h4>
            <small class="text-muted">Review selected products and submit to receive an official GST quotation from Hari Om Computer.</small>
        </div>
        <button class="btn btn-outline-danger btn-sm" onclick="if(confirm('Clear all enquiry items?')) { DataStore.clearEnquiryCart(); }">
            <i class="bi bi-trash me-1"></i> Clear Cart
        </button>
    </div>
</div>

<!-- Main Enquiry Cart & Form -->
<main class="container my-5">
    <div class="row g-4">
        <!-- Left: Products In Cart Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-list-check text-primary me-2"></i> Selected Products</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light small text-uppercase">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Product Details</th>
                                <th>Est. Unit Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="enquiry-cart-tbody">
                            <!-- Populated via main.js -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Help Box -->
            <div class="alert alert-info border-0 rounded-3 d-flex align-items-center gap-3">
                <i class="bi bi-info-circle-fill fs-3 text-primary"></i>
                <small>
                    <strong>Note on Pricing:</strong> All estimated prices shown include 18% GST. When our sales manager prepares your official quotation, eligible volume discounts, cash discounts, and exchange valuations will be applied.
                </small>
            </div>
        </div>

        <!-- Right: Summary & Customer Contact Form -->
        <div class="col-lg-4" id="enquiry-summary-box">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold mb-3 border-bottom pb-2 text-slate-900">Quotation Summary</h5>
                
                <div class="d-flex justify-content-between text-muted small mb-2">
                    <span>Total Items:</span>
                    <strong id="enquiry-total-items">0 Items</strong>
                </div>
                <div class="d-flex justify-content-between text-muted small mb-2">
                    <span>Estimated 18% GST:</span>
                    <span id="enquiry-gst-est">₹0</span>
                </div>
                <div class="d-flex justify-content-between align-items-baseline border-top pt-2 mb-4">
                    <span class="fw-bold">Estimated Grand Total:</span>
                    <span class="fs-4 fw-extrabold text-primary" id="enquiry-est-total">₹0</span>
                </div>

                <!-- Customer Request Form -->
                <form id="enquiry-request-form">
                    <h6 class="fw-bold mb-3 small text-uppercase text-muted">Customer & Delivery Details</h6>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-name">Full Name *</label>
                        <input type="text" id="enq-name" class="form-control form-control-sm" required placeholder="e.g. Vikram Rathore">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-mobile">Mobile Number *</label>
                        <input type="tel" id="enq-mobile" class="form-control form-control-sm" required placeholder="e.g. +91 98290 12345">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-email">Email Address</label>
                        <input type="email" id="enq-email" class="form-control form-control-sm" placeholder="e.g. vikram@example.com">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-company">Company / Firm Name (Optional)</label>
                        <input type="text" id="enq-company" class="form-control form-control-sm" placeholder="e.g. Rathore Infotech">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-gstin">GSTIN (Optional for Tax Credit)</label>
                        <input type="text" id="enq-gstin" class="form-control form-control-sm" placeholder="e.g. 08AABCH1234F1Z9">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-address">Address / City</label>
                        <input type="text" id="enq-address" class="form-control form-control-sm" placeholder="e.g. Sardarpura, Jodhpur">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold" for="enq-notes">Special Instructions / Requirements</label>
                        <textarea id="enq-notes" class="form-control form-control-sm" rows="2" placeholder="e.g. Need quotation with 2TB HDD extra or urgency requirement"></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">
                            <i class="bi bi-send-check me-1"></i> Submit Quotation Request
                        </button>
                        <button type="button" class="btn btn-outline-success btn-sm py-2" id="btn-whatsapp-enquiry">
                            <i class="bi bi-whatsapp me-1"></i> Send Enquiry via WhatsApp
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof StoreApp !== 'undefined') {
            StoreApp.renderEnquiryPage();
        }
    });
</script>
@endpush

@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-4 text-white" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">OFFICIAL QUOTATION CART &mdash;</span>
            <h2 class="fw-black mb-1 text-white" style="font-family: var(--hoc-font-heading);">Product Enquiry &amp; <span class="hero-highlight-cyan">GST Quotation</span></h2>
            <p class="text-light text-opacity-75 small mb-0">Review selected hardware and request an official 18% GST quotation or order instantly via WhatsApp.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2 fw-semibold" id="btn-clear-enquiry-cart" type="button">
                <i class="bi bi-trash3 me-1"></i> Clear Cart
            </button>
            <a href="{{ route('products') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2 fw-semibold">
                <i class="bi bi-plus-circle me-1"></i> Add More Items
            </a>
        </div>
    </div>
</div>

<!-- Main Enquiry Cart & Form -->
<main class="container my-5">
    <div class="row g-4">
        <!-- Left: Products In Cart Table -->
        <div class="col-lg-8">
            <div class="card border rounded-4 overflow-hidden mb-4 bg-white shadow-xs">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold mb-0 text-slate-900"><i class="bi bi-cart-check-fill text-primary me-2"></i> Items in Your Quotation Request</h6>
                    <span class="text-muted small">Wholesale Pricing Applicable</span>
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
            <div class="alert alert-info border-0 rounded-3 d-flex align-items-center gap-3 shadow-xs">
                <i class="bi bi-info-circle-fill fs-3 text-primary"></i>
                <small>
                    <strong>Note on Pricing:</strong> All estimated prices shown include 18% GST. When our sales manager prepares your official quotation, eligible volume discounts, institutional schemes, and payment terms will be clearly applied.
                </small>
            </div>
        </div>

        <!-- Right: Summary & Customer Contact Form -->
        <div class="col-lg-4" id="enquiry-summary-box">
            <div class="card border rounded-4 p-4 mb-4 bg-white shadow-xs">
                <h5 class="fw-bold mb-3 border-bottom pb-2 text-slate-900" style="font-family: var(--hoc-font-heading);">
                    Quotation Summary
                </h5>
                
                <div class="d-flex justify-content-between text-muted small mb-2">
                    <span>Total Items:</span>
                    <strong id="enquiry-total-items" class="text-dark">0 Items</strong>
                </div>
                <div class="d-flex justify-content-between text-muted small mb-2">
                    <span>Estimated 18% GST:</span>
                    <span id="enquiry-gst-est" class="text-dark">₹0</span>
                </div>
                <div class="d-flex justify-content-between align-items-baseline border-top pt-2 mb-4">
                    <span class="fw-bold text-slate-900">Estimated Total:</span>
                    <span class="fs-4 fw-extrabold text-primary" id="enquiry-est-total">₹0</span>
                </div>

                <!-- Customer Request Form -->
                <form id="enquiry-request-form">
                    <h6 class="fw-bold mb-3 small text-uppercase text-muted">Customer &amp; Delivery Details</h6>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-name">Full Name *</label>
                        <input type="text" id="enq-name" class="form-control form-control-sm rounded-3" required placeholder="e.g. Vikram Rathore">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-mobile">Mobile Number *</label>
                        <input type="tel" id="enq-mobile" class="form-control form-control-sm rounded-3" required placeholder="e.g. +91 98290 12345">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-email">Email Address</label>
                        <input type="email" id="enq-email" class="form-control form-control-sm rounded-3" placeholder="e.g. vikram@example.com">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-company">Company / Firm Name (Optional)</label>
                        <input type="text" id="enq-company" class="form-control form-control-sm rounded-3" placeholder="e.g. Rathore Infotech">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-gstin">GSTIN (Optional for Tax Credit)</label>
                        <input type="text" id="enq-gstin" class="form-control form-control-sm rounded-3" placeholder="e.g. 08AABCH1234F1Z9">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold" for="enq-address">Address / City</label>
                        <input type="text" id="enq-address" class="form-control form-control-sm rounded-3" placeholder="e.g. Sardarpura, Jodhpur">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold" for="enq-notes">Special Instructions / Requirements</label>
                        <textarea id="enq-notes" class="form-control form-control-sm rounded-3" rows="2" placeholder="e.g. Need quotation with 2TB HDD extra or urgency requirement"></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold py-2 rounded-pill shadow-sm">
                            <i class="bi bi-send-check me-1"></i> Submit Quotation Request
                        </button>
                        <button type="button" class="btn btn-outline-success btn-sm py-2 rounded-pill fw-semibold" id="btn-whatsapp-enquiry">
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

        const clearBtn = document.getElementById("btn-clear-enquiry-cart");
        if (clearBtn) {
            clearBtn.addEventListener("click", () => {
                const cart = DataStore.getEnquiryCart();
                if (!cart || cart.length === 0) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart is empty',
                            text: 'There are no items in your enquiry cart to clear.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        HOC_UTILS.showToast('Enquiry cart is already empty.', 'info');
                    }
                    return;
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Clear Enquiry Cart?',
                        text: 'Are you sure you want to remove all items from your enquiry cart?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, Clear Cart',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        focusCancel: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            DataStore.clearEnquiryCart();
                            Swal.fire({
                                icon: 'success',
                                title: 'Cart Cleared',
                                text: 'All items removed from enquiry cart.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
                } else if (confirm('Clear all enquiry items?')) {
                    DataStore.clearEnquiryCart();
                }
            });
        }
    });
</script>
@endpush

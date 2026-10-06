@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-4 text-white text-center" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <span class="text-uppercase fw-bold text-success small letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 1.5px;">SUBMISSION CONFIRMED &mdash;</span>
        <h2 class="fw-black mb-1 text-white" style="font-family: var(--hoc-font-heading);">
            Quotation Request <span class="hero-highlight-cyan">Received!</span>
        </h2>
        <p class="text-light text-opacity-75 small mb-0">Our sales engineering team is preparing your official GST quotation.</p>
    </div>
</div>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border rounded-4 p-4 p-md-5 text-center bg-white shadow-xs">
                <div class="mb-4">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2.8rem;">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                </div>
                
                <h3 class="fw-bold text-slate-900 mb-2" style="font-family: var(--hoc-font-heading);">Thank You!</h3>
                <p class="text-muted small mb-4">
                    Your enquiry has been securely logged with <strong>Hari Om Computer</strong>. An official GST quotation with current distributor pricing has been initialized.
                </p>

                <!-- Summary Receipt Box -->
                <div class="p-3 bg-light rounded-3 text-start mb-4 border">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Quotation Ref ID:</span>
                        <strong class="text-primary" id="success-quote-ref">HOC/QTN/2026/0005</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Customer Name:</span>
                        <span class="fw-semibold text-dark" id="success-cust-name">Valued Customer</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Estimated Total:</span>
                        <strong class="text-slate-900 fs-5" id="success-quote-total">₹0</strong>
                    </div>
                </div>

                <!-- Fast WhatsApp Action -->
                <div class="mb-4">
                    <a href="#" id="btn-success-whatsapp" target="_blank" class="btn btn-success fw-bold w-100 py-2 rounded-pill shadow-sm" rel="noopener noreferrer">
                        <i class="bi bi-whatsapp me-2"></i> Track Quotation on WhatsApp
                    </a>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('products') }}" class="btn btn-primary fw-bold py-2 rounded-pill">
                        <i class="bi bi-shop me-1"></i> Continue Browsing Store
                    </a>
                    <a href="{{ route('pc.builder') }}" class="btn btn-outline-dark btn-sm py-2 rounded-pill fw-semibold">
                        <i class="bi bi-motherboard me-1"></i> Configure Another PC
                    </a>
                </div>

                <div class="mt-4 pt-3 border-top small text-muted">
                    Need instant showroom assistance? Call us directly: <a href="tel:+919829012345" class="text-primary fw-bold text-decoration-none">+91 98290 12345</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dataStr = sessionStorage.getItem("HOC_LATEST_ENQUIRY");
        let refId = "HOC/QTN/2026/0005";
        let custName = "Customer";
        let amount = "₹0";

        if (dataStr) {
            try {
                const q = JSON.parse(dataStr);
                if (q.id) {
                    refId = q.id;
                    document.getElementById("success-quote-ref").innerText = q.id;
                }
                if (q.customerName) {
                    custName = q.customerName;
                    document.getElementById("success-cust-name").innerText = q.customerName;
                }
                if (q.grandTotal) {
                    amount = HOC_UTILS.formatINR(q.grandTotal);
                    document.getElementById("success-quote-total").innerText = amount;
                }
            } catch (err) {
                console.error("Failed to parse quote summary", err);
            }
        }

        const waMsg = `Hello Hari Om Computer, I just submitted Quotation Request *${refId}* for ${custName} (Est. Amount: ${amount}). Please share the official quotation PDF.`;
        const waBtn = document.getElementById("btn-success-whatsapp");
        if (waBtn) {
            waBtn.href = `https://wa.me/919829012345?text=${encodeURIComponent(waMsg)}`;
        }
    });
</script>
@endpush

@extends('layouts.shop')

@section('content')
<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4 text-center bg-white">
                <div class="mb-4">
                    <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2.8rem;">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                </div>
                
                <h2 class="fw-bold text-slate-900 mb-2">Thank You!</h2>
                <p class="text-muted mb-4">
                    Your quotation request has been submitted successfully to <strong>Hari Om Computer</strong>. Our sales specialist will review your hardware configuration and contact you shortly.
                </p>

                <div class="p-3 bg-light rounded-3 text-start mb-4 border">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Generated Quotation Ref:</span>
                        <strong class="text-primary" id="success-quote-ref">HOC/QTN/2026/0005</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Customer Name:</span>
                        <span class="fw-semibold" id="success-cust-name">Customer</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Estimated Amount:</span>
                        <strong class="text-dark" id="success-quote-total">₹0</strong>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('products') }}" class="btn btn-primary fw-bold py-2">
                        <i class="bi bi-shop me-1"></i> Continue Browsing Store
                    </a>
                    <a href="{{ route('pc.builder') }}" class="btn btn-outline-dark btn-sm py-2">
                        <i class="bi bi-motherboard me-1"></i> Configure Another PC
                    </a>
                </div>

                <div class="mt-4 pt-3 border-top small text-muted">
                    Need urgent assistance? Call our Jodhpur showroom: <strong>+91 98290 12345</strong>
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
        if (dataStr) {
            try {
                const q = JSON.parse(dataStr);
                if (q.id) document.getElementById("success-quote-ref").innerText = q.id;
                if (q.customerName) document.getElementById("success-cust-name").innerText = q.customerName;
                if (q.grandTotal) document.getElementById("success-quote-total").innerText = HOC_UTILS.formatINR(q.grandTotal);
            } catch (err) {
                console.error("Failed to parse quote summary", err);
            }
        }
    });
</script>
@endpush

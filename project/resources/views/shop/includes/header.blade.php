@if (!empty($showPromoStrip))
<!-- Top Flash Promo Strip -->
<div class="promo-strip-top">
    <div class="container d-flex justify-content-center align-items-center flex-wrap gap-2">
        <span><span class="promo-badge-flash">SHOWROOM SPECIAL</span> ⚡ Get FREE RGB Gaming Keyboard & Mouse Combo on all Custom PC Builds above ₹50,000 this week!</span>
    </div>
</div>
@endif

<!-- Top Announcement Bar -->
<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <span><i class="bi bi-geo-alt-fill text-info me-1"></i> Plot No. 42, Station Road, Near Sojati Gate, Jodhpur, Rajasthan</span>
            <span class="d-none d-md-inline">&bull;</span>
            <span class="d-none d-md-inline"><i class="bi bi-telephone-fill text-info me-1"></i> +91 98290 12345 / 0291-2654321</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('contact') }}"><i class="bi bi-clock me-1"></i> Showroom Hours: 10:00 AM - 8:30 PM</a>
            <span>&bull;</span>
            <span class="badge bg-primary text-white px-2 py-1">
                <i class="bi bi-patch-check-fill me-1"></i> Authorized Store
            </span>
            <span>&bull;</span>
            <a href="{{ route('admin.login') }}" class="text-white text-opacity-75 text-decoration-none small">
                <i class="bi bi-shield-lock-fill text-warning me-1"></i> Admin ERP
            </a>
        </div>
    </div>
</div>

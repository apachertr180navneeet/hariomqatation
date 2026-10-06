@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-5 text-white text-center" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container py-3">
        <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">ABOUT HARI OM COMPUTER &mdash;</span>
        <h1 class="fw-black display-5 mb-3 text-white" style="font-family: var(--hoc-font-heading);">
            Empowering Jodhpur with <span class="hero-highlight-cyan">Cutting-Edge Technology</span>
        </h1>
        <p class="text-light text-opacity-75 lead mx-auto mb-0" style="max-width: 720px; font-size: 1.05rem;">
            Western Rajasthan's premier destination for genuine brand laptops, custom liquid-cooled gaming PCs, original components, and institutional IT solutions.
        </p>
    </div>
</div>

<!-- 4 Key Stat Badges -->
<section class="py-4 bg-white border-bottom shadow-xs">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <div class="fs-2 fw-extrabold text-primary" style="font-family: var(--hoc-font-heading);">15,000+</div>
                    <div class="text-muted small fw-semibold">PCs Assembled &amp; Delivered</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <div class="fs-2 fw-extrabold text-success" style="font-family: var(--hoc-font-heading);">100%</div>
                    <div class="text-muted small fw-semibold">Genuine Sourced Hardware</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <div class="fs-2 fw-extrabold text-info" style="font-family: var(--hoc-font-heading);">15+ Years</div>
                    <div class="text-muted small fw-semibold">Showroom Legacy (Est. 2011)</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-3 border rounded-3 bg-light">
                    <div class="fs-2 fw-extrabold text-warning" style="font-family: var(--hoc-font-heading);">4.9 ★</div>
                    <div class="text-muted small fw-semibold">Google Customer Rating</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Story & Vision -->
<main class="container my-5">
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6">
            <div class="d-inline-block badge bg-primary-subtle text-primary fw-bold px-3 py-1 mb-2 text-uppercase" style="font-size: 0.72rem; letter-spacing: 1px;">
                OUR HERITAGE &bull; SOJATI GATE, JODHPUR
            </div>
            <h3 class="fw-bold mb-3 text-slate-900" style="font-family: var(--hoc-font-heading);">
                Over 15 Years of Excellence in Computer Retail &amp; Custom Assembly
            </h3>
            <p class="text-muted leading-relaxed">
                Founded with a mission to deliver transparent pricing and authentic computer hardware, <strong>Hari Om Computer</strong> has grown to become Western Rajasthan's most trusted technology landmark. Located conveniently near Sojati Gate on Station Road in Jodhpur, we serve thousands of retail consumers, competitive gamers, software developers, colleges, and corporate organizations every year.
            </p>
            <p class="text-muted leading-relaxed">
                We strictly distribute 100% genuine retail boxed products sourced directly from authorized tier-1 national distributors including Rashi Peripherals, CompAge, Supertron, and Redington. Every single component comes with verifiable serial numbers and full manufacturer warranty.
            </p>
            
            <div class="d-flex flex-wrap gap-2 pt-2">
                <a href="{{ route('pc.builder') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                    <i class="bi bi-motherboard me-1"></i> Try Custom PC Builder
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                    <i class="bi bi-geo-alt me-1"></i> Visit Showroom
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border rounded-4 p-4 bg-white shadow-xs">
                <h5 class="fw-bold mb-3 text-slate-900 border-bottom pb-2" style="font-family: var(--hoc-font-heading);">
                    Why Customers Choose Hari Om Computer
                </h5>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 fs-5"><i class="bi bi-patch-check-fill"></i></div>
                        <div>
                            <strong class="d-block text-slate-900">100% Genuine Brand Guarantee:</strong>
                            <span class="text-muted small">Every laptop and component comes with original sealed packaging and manufacturer warranty.</span>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success p-2 fs-5"><i class="bi bi-receipt"></i></div>
                        <div>
                            <strong class="d-block text-slate-900">Wholesale Pricing &amp; GST Invoicing:</strong>
                            <span class="text-muted small">Guaranteed competitive rates in Jodhpur with full 18% GST input credit support for businesses.</span>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 text-info p-2 fs-5"><i class="bi bi-cpu"></i></div>
                        <div>
                            <strong class="d-block text-slate-900">Custom Rig Assembly &amp; Thermal Testing:</strong>
                            <span class="text-muted small">Zero assembly fee, premium thermal paste application, clean cable routing, and 24-hr stress testing.</span>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-2 fs-5"><i class="bi bi-tools"></i></div>
                        <div>
                            <strong class="d-block text-slate-900">Certified Hardware Technicians:</strong>
                            <span class="text-muted small">In-house engineers for on-the-spot hardware diagnostics, BIOS updates, and prompt warranty support.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection

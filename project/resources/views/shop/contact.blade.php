@extends('shop.includes.app')

@section('content')
<!-- PCMart Inner Page Hero Banner -->
<div class="pcmart-page-banner py-5 text-white text-center" style="background: linear-gradient(135deg, #020b18 0%, #061936 60%, #0a2540 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container py-3">
        <span class="text-uppercase fw-bold text-info small letter-spacing-1 d-block mb-2" style="font-size: 0.75rem; letter-spacing: 2px;">CUSTOMER DESK &amp; SHOWROOM &mdash;</span>
        <h1 class="fw-black display-5 mb-2 text-white" style="font-family: var(--hoc-font-heading);">
            Visit Our Showroom or <span class="hero-highlight-cyan">Get in Touch</span>
        </h1>
        <p class="text-light text-opacity-75 lead mb-0 mx-auto" style="max-width: 680px; font-size: 1.05rem;">
            Centrally located near Sojati Gate on Station Road, Jodhpur. Chat on WhatsApp, call our desk, or drop in for live PC demos.
        </p>
    </div>
</div>

<!-- Contact Body -->
<main class="container my-5">
    <div class="row g-4">
        <!-- Contact Info & Showroom Cards -->
        <div class="col-lg-5">
            <div class="card border rounded-4 p-4 mb-4 bg-white shadow-xs">
                <h5 class="fw-bold mb-4 text-slate-900 border-bottom pb-2" style="font-family: var(--hoc-font-heading);">
                    Hari Om Computer Showroom
                </h5>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 fs-5"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <strong class="d-block text-slate-900">Showroom Address:</strong>
                        <span class="text-muted small">Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001 (India)</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success p-2 fs-5"><i class="bi bi-telephone-fill"></i></div>
                    <div>
                        <strong class="d-block text-slate-900">Phone Numbers:</strong>
                        <span class="text-muted small"><a href="tel:+919829012345" class="text-decoration-none text-muted">+91 98290 12345</a> / 0291-2654321</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-info bg-opacity-10 text-info p-2 fs-5"><i class="bi bi-envelope-fill"></i></div>
                    <div>
                        <strong class="d-block text-slate-900">Official Email:</strong>
                        <span class="text-muted small">sales@hariomcomputer.com / info@hariomcomputer.com</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning-emphasis p-2 fs-5"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <strong class="d-block text-slate-900">Store Timings:</strong>
                        <span class="text-muted small">Monday &ndash; Saturday: 10:00 AM &ndash; 8:30 PM<br>(Sunday Open for Phone Inquiries)</span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20am%20inquiring%20from%20your%20website" target="_blank" class="btn btn-success fw-bold py-2 rounded-pill shadow-sm" rel="noopener noreferrer">
                        <i class="bi bi-whatsapp me-2"></i> Chat with Us on WhatsApp
                    </a>
                    <a href="tel:+919829012345" class="btn btn-outline-primary fw-bold py-2 rounded-pill">
                        <i class="bi bi-telephone me-2"></i> Call Store Specialist
                    </a>
                </div>
            </div>

            <!-- Showroom Location Direction Card -->
            <div class="card border rounded-4 overflow-hidden bg-white p-3 text-center shadow-xs">
                <div class="rounded-3 p-4 border d-flex flex-column align-items-center justify-content-center" style="min-height: 160px; background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);">
                    <i class="bi bi-geo-alt-fill text-danger fs-1 mb-2"></i>
                    <strong class="text-slate-900">Sojati Gate Landmark, Jodhpur</strong>
                    <small class="text-muted mb-2">Walking distance from Jodhpur Junction Railway Station</small>
                    <a href="https://maps.google.com/?q=Hari+Om+Computer+Jodhpur" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3" rel="noopener noreferrer">
                        <i class="bi bi-map me-1"></i> Open in Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- Direct Message Form -->
        <div class="col-lg-7">
            <div class="card border rounded-4 p-4 p-md-5 bg-white shadow-xs">
                <h4 class="fw-bold mb-2 text-slate-900" style="font-family: var(--hoc-font-heading);">Send Us a Direct Message</h4>
                <p class="text-muted small mb-4">Have questions regarding stock availability, bulk quotation pricing, PC compatibility, or warranty? Fill out the form below.</p>

                <form id="contact-page-form" onsubmit="event.preventDefault(); if (typeof Swal !== 'undefined') { Swal.fire({ icon: 'success', title: 'Message Sent!', text: 'Thank you for contacting Hari Om Computer. Our team will contact you shortly.', timer: 3000, showConfirmButton: false }); } else { HOC_UTILS.showToast('Thank you for contacting Hari Om Computer! Our team will respond shortly.'); } this.reset();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-slate-800">Your Full Name *</label>
                            <input type="text" class="form-control rounded-3" required placeholder="e.g. Ramesh Chandra">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-slate-800">Mobile Number *</label>
                            <input type="tel" class="form-control rounded-3" required placeholder="e.g. +91 98290 XXXXX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-slate-800">Email Address</label>
                            <input type="email" class="form-control rounded-3" placeholder="e.g. ramesh@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-slate-800">Interested In</label>
                            <select class="form-select rounded-3">
                                <option>Laptops &amp; Notebooks</option>
                                <option>Custom Gaming / 3D Workstation PC</option>
                                <option>Office &amp; Lab Bulk Computers</option>
                                <option>Individual Components (RAM/SSD/GPU/CPU)</option>
                                <option>Technical Service &amp; Upgrades</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-slate-800">Your Message or Query *</label>
                            <textarea class="form-control rounded-3" rows="4" required placeholder="Tell us your requirements, budget, or model name..."></textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2 px-4 rounded-pill shadow-sm">
                                <i class="bi bi-send-fill me-1"></i> Send Message Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

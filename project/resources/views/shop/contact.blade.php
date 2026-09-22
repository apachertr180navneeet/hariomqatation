@extends('layouts.shop')

@section('content')
<!-- Header -->
<div class="bg-dark text-white py-5" style="background: linear-gradient(135deg, #090e1a 0%, #1e293b 100%);">
    <div class="container text-center">
        <span class="badge bg-primary px-3 py-1 mb-2">GET IN TOUCH</span>
        <h1 class="fw-bold display-5 mb-2">Visit Our Showroom or Send an Enquiry</h1>
        <p class="text-light text-opacity-75 lead mb-0">We are located centrally on Station Road near Sojati Gate in Jodhpur, Rajasthan.</p>
    </div>
</div>

<!-- Contact Body -->
<main class="container my-5">
    <div class="row g-4">
        <!-- Contact Info & Showroom Cards -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 rounded-4 mb-4 bg-white">
                <h5 class="fw-bold mb-4 text-slate-900 border-bottom pb-2">Hari Om Computer Showroom</h5>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-primary-subtle text-primary p-2 fs-5"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <strong class="d-block text-dark">Showroom Address:</strong>
                        <span class="text-muted small">Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001 (India)</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-success-subtle text-success p-2 fs-5"><i class="bi bi-telephone-fill"></i></div>
                    <div>
                        <strong class="d-block text-dark">Phone Numbers:</strong>
                        <span class="text-muted small">+91 98290 12345 / 0291-2654321</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-info-subtle text-info p-2 fs-5"><i class="bi bi-envelope-fill"></i></div>
                    <div>
                        <strong class="d-block text-dark">Official Email:</strong>
                        <span class="text-muted small">info@hariomcomputer.com / sales@hariomcomputer.com</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle bg-warning-subtle text-warning-emphasis p-2 fs-5"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <strong class="d-block text-dark">Store Timings:</strong>
                        <span class="text-muted small">Monday - Saturday: 10:00 AM - 8:30 PM<br>(Sunday Closed for Store Pickup)</span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20am%20inquiring%20from%20your%20website" target="_blank" class="btn btn-success fw-bold py-2" rel="noopener noreferrer">
                        <i class="bi bi-whatsapp me-2"></i> Chat with Us on WhatsApp
                    </a>
                    <a href="tel:+919829012345" class="btn btn-outline-primary fw-bold py-2">
                        <i class="bi bi-telephone me-2"></i> Call Store Now
                    </a>
                </div>
            </div>

            <!-- Google Maps Embed Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-3 text-center">
                <div class="bg-light rounded-3 p-4 border d-flex flex-column align-items-center justify-content-center" style="height: 180px;">
                    <i class="bi bi-geo-alt text-primary fs-1 mb-2"></i>
                    <strong class="text-dark">Showroom Location Map</strong>
                    <small class="text-muted">Plot 42, Station Road, Near Sojati Gate, Jodhpur, Rajasthan</small>
                </div>
            </div>
        </div>

        <!-- Quick Message Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
                <h4 class="fw-bold mb-2 text-slate-900">Send Us a Direct Message</h4>
                <p class="text-muted small mb-4">Have questions about stock, bulk corporate quotations, PC compatibility, or warranty? Fill out the form below.</p>

                <form id="contact-page-form" onsubmit="event.preventDefault(); HOC_UTILS.showToast('Thank you for contacting Hari Om Computer! Our team will respond shortly.'); this.reset();">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Your Name *</label>
                            <input type="text" class="form-control" required placeholder="e.g. Ramesh Chandra">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Mobile Number *</label>
                            <input type="tel" class="form-control" required placeholder="e.g. +91 98290 XXXXX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" class="form-control" placeholder="e.g. ramesh@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Interested In</label>
                            <select class="form-select">
                                <option>Laptops & Notebooks</option>
                                <option>Custom Gaming / Editing PC Build</option>
                                <option>Office & Institutional Computer Lab Setup</option>
                                <option>Components & Upgrades (RAM/SSD/GPU)</option>
                                <option>Technical Service & Warranty</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Your Message / Query *</label>
                            <textarea class="form-control" rows="4" required placeholder="Describe your computer requirement or quotation details..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg px-4 py-2 fw-bold">
                                <i class="bi bi-send-check me-2"></i> Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

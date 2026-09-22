<!-- Floating WhatsApp Action -->
<a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20have%20an%20inquiry%20regarding%20computer%20hardware" target="_blank" class="whatsapp-float" title="Chat on WhatsApp" rel="noopener noreferrer">
    <i class="bi bi-whatsapp"></i>
</a>

<!-- Main Showroom Footer -->
<footer class="store-footer">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-lg-5">
                <div class="footer-logo mb-3">HARI OM COMPUTER</div>
                <p class="text-light text-opacity-75 small mb-3" style="max-width: 420px; line-height: 1.7;">
                    Western Rajasthan's premier destination for custom gaming rigs, official branded laptops, enterprise workstations, genuine hardware components, and instant GST quotations.
                </p>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill text-info"></i>
                    <span>Plot No. 42, Station Road, Near Sojati Gate, Jodhpur - 342001 (Raj.)</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill text-info"></i>
                    <span>+91 98290 12345 / 0291-2654321</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill text-info"></i>
                    <span>sales@hariomcomputer.com / info@hariomcomputer.com</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-file-earmark-text-fill text-info"></i>
                    <span>GSTIN: <strong>08AABCH1234F1Z9</strong> (Input Tax Credit Eligible)</span>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2 offset-lg-1">
                <div class="footer-title">Hardware Categories</div>
                <ul class="footer-links">
                    <li><a href="{{ route('computers') }}">Custom Gaming Rigs</a></li>
                    <li><a href="{{ route('laptops') }}">14th Gen Laptops</a></li>
                    <li><a href="{{ route('components') }}">Genuine GPUs & CPUs</a></li>
                    <li><a href="{{ route('pc.builder') }}">Interactive PC Builder</a></li>
                    <li><a href="{{ route('products') }}">Monitors & Displays</a></li>
                    <li><a href="{{ route('products') }}">Networking & Accessories</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="footer-title">Quick Links</div>
                <ul class="footer-links">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Store Location</a></li>
                    <li><a href="{{ route('enquiry') }}">Enquiry Cart</a></li>
                    <li><a href="{{ route('products') }}">All Catalog</a></li>
                    <li><a href="{{ route('admin.login') }}"><i class="bi bi-shield-lock me-1"></i> Staff ERP Portal</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="footer-title">Business Hours</div>
                <p class="small text-light text-opacity-75 mb-2">Monday - Saturday:<br><strong class="text-white">10:00 AM - 8:30 PM</strong></p>
                <p class="small text-light text-opacity-75 mb-0">Sunday:<br><strong class="text-white">Closed (Online Enquiries Open)</strong></p>
            </div>
        </div>

        <div class="pt-4 border-top border-white border-opacity-10 d-flex flex-wrap justify-content-between align-items-center small text-light text-opacity-75">
            <p class="mb-0">&copy; {{ date('Y') }} Hari Om Computer. All rights reserved.</p>
            <p class="mb-0">GSTIN: 08AABCH1234F1Z9 &bull; Jodhpur, Rajasthan</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/store-data.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof StoreApp !== 'undefined' && StoreApp.init) {
            StoreApp.init();
        }
    });
</script>

@stack('scripts')

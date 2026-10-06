<!-- Floating WhatsApp Action (Desktop Only, on Mobile it is in the Bottom App Bar) -->
<a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20have%20an%20inquiry%20regarding%20computer%20hardware" target="_blank" class="whatsapp-float d-none d-lg-flex" title="Chat on WhatsApp" rel="noopener noreferrer">
    <i class="bi bi-whatsapp"></i>
</a>

<!-- =========================================================================
     Sticky Mobile Bottom App Bar (Mobile & Tablet App Feel)
     ========================================================================= -->
<nav class="mobile-bottom-nav d-lg-none" aria-label="Mobile Navigation">
    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
        <div class="mobile-nav-icon"><i class="bi bi-house-door-fill"></i></div>
        <span class="mobile-nav-label">Home</span>
    </a>
    <a href="{{ route('products') }}" class="mobile-nav-link {{ request()->routeIs('products') ? 'active' : '' }}">
        <div class="mobile-nav-icon"><i class="bi bi-grid-fill"></i></div>
        <span class="mobile-nav-label">Catalog</span>
    </a>
    <a href="{{ route('pc.builder') }}" class="mobile-nav-link mobile-nav-builder-link {{ request()->routeIs('pc.builder') ? 'active' : '' }}">
        <div class="mobile-nav-icon position-relative">
            <i class="bi bi-motherboard-fill"></i>
            <span class="mobile-badge-hot">HOT</span>
        </div>
        <span class="mobile-nav-label">Builder</span>
    </a>
    <a href="{{ route('enquiry') }}" class="mobile-nav-link position-relative {{ request()->routeIs('enquiry') ? 'active' : '' }}">
        <div class="mobile-nav-icon position-relative">
            <i class="bi bi-cart-fill"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none; font-size: 0.6rem; padding: 2px 4px;">0</span>
        </div>
        <span class="mobile-nav-label">Cart</span>
    </a>
    <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer" target="_blank" class="mobile-nav-link mobile-nav-whatsapp">
        <div class="mobile-nav-icon text-success"><i class="bi bi-whatsapp"></i></div>
        <span class="mobile-nav-label">WhatsApp</span>
    </a>
</nav>

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
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/store-data.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (typeof StoreApp !== 'undefined' && StoreApp.init) {
            StoreApp.init();
        }
    });
</script>

@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Swal !== 'undefined') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: {!! json_encode(session('success')) !!}
            });
        }
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Swal !== 'undefined') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4500,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'error',
                title: {!! json_encode(session('error')) !!}
            });
        }
    });
</script>
@endif

@stack('scripts')

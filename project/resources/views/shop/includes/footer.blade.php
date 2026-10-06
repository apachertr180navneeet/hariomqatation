<!-- Floating WhatsApp Action (Desktop Only, on Mobile it is in the Bottom App Bar) -->
<a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20PCMart,%20I%20have%20an%20inquiry%20regarding%20custom%20PCs%20and%20hardware" target="_blank" class="whatsapp-float d-none d-lg-flex" title="Chat on WhatsApp" rel="noopener noreferrer">
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
    <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20PCMart" target="_blank" class="mobile-nav-link mobile-nav-whatsapp">
        <div class="mobile-nav-icon text-success"><i class="bi bi-whatsapp"></i></div>
        <span class="mobile-nav-label">WhatsApp</span>
    </a>
</nav>

<!-- =========================================================================
     PCMart 4-Column Service & Trust Badges Strip (Reference Design)
     ========================================================================= -->
<section class="pcmart-trust-strip py-4 bg-white border-top border-bottom">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-6 col-md-3">
                <div class="pcmart-trust-item d-flex align-items-center gap-3">
                    <div class="trust-icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-truck fs-3"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Free Shipping</div>
                        <div class="text-muted small">On orders above ₹999</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="pcmart-trust-item d-flex align-items-center gap-3">
                    <div class="trust-icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Easy Returns</div>
                        <div class="text-muted small">7 days return policy</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="pcmart-trust-item d-flex align-items-center gap-3">
                    <div class="trust-icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-credit-card fs-3"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Secure Payment</div>
                        <div class="text-muted small">100% secure payment</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="pcmart-trust-item d-flex align-items-center gap-3">
                    <div class="trust-icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-headset fs-3"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Expert Support</div>
                        <div class="text-muted small">Dedicated customer support</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Showroom Footer -->
<footer class="pcmart-footer bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Brand & Address -->
            <div class="col-lg-4">
                <div class="pcmart-brand-logo d-flex align-items-center gap-2 mb-3">
                    <div class="brand-pc-box">
                        <i class="bi bi-display-fill"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="brand-pc-title text-white">HARI OM <span class="text-primary">PCMart</span></div>
                        <div class="text-muted small">Custom PC & Hardware Megastore</div>
                    </div>
                </div>
                <p class="text-light text-opacity-75 small mb-3" style="line-height: 1.7;">
                    Western Rajasthan's premier destination for custom gaming rigs, official branded laptops, genuine hardware components, and instant GST quotations.
                </p>
                <div class="d-flex flex-column gap-2 small text-light text-opacity-75">
                    <div><i class="bi bi-geo-alt-fill text-primary me-2"></i> Plot No. 42, Station Road, Near Sojati Gate, Jodhpur - 342001 (Raj.)</div>
                    <div><i class="bi bi-telephone-fill text-primary me-2"></i> +91 98290 12345 / 0291-2654321</div>
                    <div><i class="bi bi-envelope-fill text-primary me-2"></i> sales@hariomcomputer.com</div>
                    <div><i class="bi bi-file-earmark-text text-primary me-2"></i> GSTIN: <strong>08AABCH1234F1Z9</strong> (Input Tax Credit Eligible)</div>
                </div>
            </div>

            <!-- Hardware Categories -->
            <div class="col-6 col-md-3 col-lg-2 offset-lg-1">
                <h6 class="fw-bold text-white mb-3 text-uppercase small" style="letter-spacing: 0.05em;">Hardware</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    @php
                        $compCat = ($globalCategories ?? collect())->firstWhere('name', 'Components');
                        $hardwareSubs = $compCat ? $compCat->subcategories->take(6) : collect();
                    @endphp
                    @forelse($hardwareSubs as $sub)
                        <li><a href="{{ route('components', ['sub' => $sub->name]) }}" class="text-light text-opacity-75 text-decoration-none hover-white">{{ $sub->name }}</a></li>
                    @empty
                        <li><a href="{{ route('components', ['sub' => 'Processor']) }}" class="text-light text-opacity-75 text-decoration-none hover-white">Processors (CPUs)</a></li>
                        <li><a href="{{ route('components', ['sub' => 'Graphics Card']) }}" class="text-light text-opacity-75 text-decoration-none hover-white">Graphics Cards (GPUs)</a></li>
                        <li><a href="{{ route('components', ['sub' => 'Motherboard']) }}" class="text-light text-opacity-75 text-decoration-none hover-white">Motherboards</a></li>
                        <li><a href="{{ route('components', ['sub' => 'RAM']) }}" class="text-light text-opacity-75 text-decoration-none hover-white">RAM Memory (DDR5)</a></li>
                        <li><a href="{{ route('components', ['sub' => 'SSD']) }}" class="text-light text-opacity-75 text-decoration-none hover-white">Storage (NVMe SSD)</a></li>
                        <li><a href="{{ route('products', ['cat' => 'Display']) }}" class="text-light text-opacity-75 text-decoration-none hover-white">Gaming Monitors</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Custom PC Builds -->
            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="fw-bold text-white mb-3 text-uppercase small" style="letter-spacing: 0.05em;">PC Builds</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="{{ route('pc.builder') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Custom PC Configurator</a></li>
                    <li><a href="{{ route('computers') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Budget Gaming PCs</a></li>
                    <li><a href="{{ route('computers') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Mid-Range RTX Rigs</a></li>
                    <li><a href="{{ route('computers') }}" class="text-light text-opacity-75 text-decoration-none hover-white">High-End Gaming Rigs</a></li>
                    <li><a href="{{ route('computers') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Creator Workstations</a></li>
                    <li><a href="{{ route('laptops') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Gaming & Work Laptops</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="col-6 col-md-3 col-lg-3">
                <h6 class="fw-bold text-white mb-3 text-uppercase small" style="letter-spacing: 0.05em;">Customer Service</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small mb-4">
                    <li><a href="{{ route('enquiry') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Track Quotation / Order</a></li>
                    <li><a href="{{ route('about') }}" class="text-light text-opacity-75 text-decoration-none hover-white">About Showroom</a></li>
                    <li><a href="{{ route('contact') }}" class="text-light text-opacity-75 text-decoration-none hover-white">Store Location & Directions</a></li>
                    <li><a href="{{ route('admin.login') }}" class="text-warning text-decoration-none"><i class="bi bi-shield-lock me-1"></i> Staff ERP Portal</a></li>
                </ul>
                <div class="p-3 rounded-3 bg-secondary bg-opacity-25 small">
                    <div class="fw-bold mb-1"><i class="bi bi-clock me-1 text-primary"></i> Showroom Hours:</div>
                    <div class="text-light text-opacity-75">Mon - Sat: 10:00 AM - 8:30 PM<br>Sunday: Online Quotations Open</div>
                </div>
            </div>
        </div>

        <div class="pt-4 border-top border-secondary border-opacity-25 d-flex flex-wrap justify-content-between align-items-center small text-light text-opacity-50">
            <p class="mb-0">&copy; {{ date('Y') }} Hari Om PCMart (Hari Om Computer). All rights reserved.</p>
            <div class="d-flex align-items-center gap-3">
                <span>100% Genuine Warranty</span>
                <span>&bull;</span>
                <span>GST Tax Invoice</span>
                <span>&bull;</span>
                <span>Jodhpur, Rajasthan</span>
            </div>
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

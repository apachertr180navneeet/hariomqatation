<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Hari Om Computer | Your Trusted Computer & Technology Partner (Jodhpur)' }}</title>
    <meta name="description" content="Hari Om Computer is Western Rajasthan's premier computer showroom in Jodhpur offering custom PC builds, laptops, genuine hardware components, and instant GST quotations.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Storefront CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/store.css') }}">

    @stack('styles')

    <script>
        window.HOC_ROUTES = {
            home: "{{ route('home') }}",
            computers: "{{ route('computers') }}",
            laptops: "{{ route('laptops') }}",
            components: "{{ route('components') }}",
            products: "{{ route('products') }}",
            productDetails: "{{ route('product.details') }}",
            pcBuilder: "{{ route('pc.builder') }}",
            enquiry: "{{ route('enquiry') }}",
            quotationSuccess: "{{ route('quotation.success') }}",
            about: "{{ route('about') }}",
            contact: "{{ route('contact') }}"
        };
    </script>
</head>
<body>

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
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-xl navbar-hoc sticky-top">
        <div class="container-fluid px-lg-4">
            <a class="navbar-brand-logo d-flex align-items-center gap-3 text-decoration-none" href="{{ route('home') }}">
                <div class="brand-icon-box">
                    <i class="bi bi-cpu"></i>
                </div>
                <div>
                    <div class="brand-text-main">HARI OM COMPUTER</div>
                    <div class="brand-tagline">Your Trusted Technology Partner</div>
                </div>
            </a>

            <div class="d-flex align-items-center gap-2 d-xl-none">
                <a href="{{ route('enquiry') }}" class="btn btn-sm btn-outline-primary position-relative d-flex align-items-center gap-1 fw-semibold text-nowrap px-2 py-1" title="Enquiry Cart">
                    <i class="bi bi-cart4 fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none;">
                        0
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storeNavbar" aria-controls="storeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="storeNavbar">
                <div class="d-xl-none mb-2 mt-3">
                    <form class="position-relative w-100" action="{{ route('products') }}" method="GET">
                        <i class="bi bi-search text-muted position-absolute" style="left: 14px; top: 11px;"></i>
                        <input type="text" name="search" class="form-control rounded-pill ps-5" placeholder="Search RTX 4060, i7, Dell..." value="{{ request('search') }}">
                    </form>
                </div>

                <ul class="navbar-nav mx-auto mb-2 mb-xl-0">
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('computers') ? 'active' : '' }}" href="{{ route('computers') }}">Desktop PCs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('laptops') ? 'active' : '' }}" href="{{ route('laptops') }}">Laptops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('components') ? 'active' : '' }}" href="{{ route('components') }}">Components</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">All Catalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom btn-pc-builder-nav ms-xl-2 {{ request()->routeIs('pc.builder') ? 'active' : '' }}" href="{{ route('pc.builder') }}">
                            <i class="bi bi-motherboard me-1"></i> Custom PC Builder
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <div class="d-none d-xl-flex align-items-center gap-3">
                    <form class="header-search" id="header-search-form" action="{{ route('products') }}" method="GET">
                        <i class="bi bi-search search-icon text-muted" style="position: absolute; left: 16px; top: 12px;"></i>
                        <input type="text" name="search" class="form-control" id="header-search-input" placeholder="Search RTX 4060, i7, Dell..." value="{{ request('search') }}">
                    </form>

                    <a href="{{ route('enquiry') }}" class="btn btn-outline-primary position-relative d-flex align-items-center gap-2 fw-semibold text-nowrap">
                        <i class="bi bi-cart4 fs-5"></i>
                        <span class="d-none d-sm-inline">Enquiry Cart</span>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger enquiry-count-badge" style="display: none;">
                            0
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Page Content -->
    @yield('content')

    <!-- Floating WhatsApp Action -->
    <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20have%20an%20inquiry%20regarding%20computer%20hardware" target="_blank" class="whatsapp-float" title="Chat on WhatsApp" rel="noopener noreferrer">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Store Footer -->
    <footer class="footer-hoc">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="brand-icon-box" style="width: 38px; height: 38px; font-size: 1.2rem;">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <span class="text-white fw-bold fs-5">HARI OM COMPUTER</span>
                    </div>
                    <p class="small text-light text-opacity-75 mb-3">
                        Your Trusted Computer & Technology Partner in Jodhpur, Rajasthan. Providing genuine laptops, pre-built PCs, workstation rigs, and components since 2010.
                    </p>
                    <div class="footer-contact-info">
                        <p><i class="bi bi-geo-alt-fill text-info"></i> <span>Plot No. 42, Station Road, Near Sojati Gate, Jodhpur</span></p>
                        <p><i class="bi bi-telephone-fill text-info"></i> <span>+91 98290 12345 / 0291-2654321</span></p>
                        <p><i class="bi bi-envelope-fill text-info"></i> <span>info@hariomcomputer.com</span></p>
                    </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2">
                    <div class="footer-title">Products</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('laptops') }}">Laptops</a></li>
                        <li><a href="{{ route('computers') }}">Desktop PCs</a></li>
                        <li><a href="{{ route('components') }}">Processors</a></li>
                        <li><a href="{{ route('components') }}">Graphics Cards</a></li>
                        <li><a href="{{ route('products', ['cat' => 'Display']) }}">Monitors</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-3 col-lg-2">
                    <div class="footer-title">Custom Builds</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('pc.builder') }}">PC Builder Tool</a></li>
                        <li><a href="{{ route('computers') }}">Gaming Towers</a></li>
                        <li><a href="{{ route('computers') }}">Editing Workstations</a></li>
                        <li><a href="{{ route('enquiry') }}">Request Quotation</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-3 col-lg-2">
                    <div class="footer-title">Quick Links</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Store Location</a></li>
                        <li><a href="{{ route('enquiry') }}">Enquiry Cart</a></li>
                        <li><a href="{{ route('products') }}">All Catalog</a></li>
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
</body>
</html>

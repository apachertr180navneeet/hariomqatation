@extends('layouts.shop')

@section('content')
<!-- About Hero -->
<div class="bg-dark text-white py-5" style="background: linear-gradient(135deg, #090e1a 0%, #1e293b 100%);">
    <div class="container text-center py-4">
        <span class="badge bg-primary px-3 py-1 mb-2">ABOUT OUR SHOWROOM</span>
        <h1 class="fw-bold display-5 mb-3">Empowering Jodhpur with Cutting-Edge Technology</h1>
        <p class="text-light text-opacity-75 lead mx-auto" style="max-width: 700px;">
            "Hari Om Computer is a trusted computer and technology store providing laptops, desktop computers, custom PC builds, computer components, accessories and technology solutions."
        </p>
    </div>
</div>

<!-- Story & Vision -->
<main class="container my-5">
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6">
            <h3 class="fw-bold mb-3 text-slate-900">Over 15 Years of Excellence in Computer Retail & Assembly</h3>
            <p class="text-muted leading-relaxed">
                Founded with a passion for quality and authentic computer hardware, <strong>Hari Om Computer</strong> has grown to become Western Rajasthan's preferred technology destination. Located in the heart of Jodhpur near Sojati Gate, we serve thousands of retail consumers, college students, software engineers, professional video editors, and institutional establishments.
            </p>
            <p class="text-muted leading-relaxed">
                We pride ourselves on offering 100% genuine products sourced directly from authorized national distributors (Rashi Peripherals, CompAge, Supertron, Redington). Whether you need a student notebook or an extreme RTX 4090 liquid-cooled workstation, our certified technicians are ready to guide you.
            </p>
            
            <div class="row g-3 mt-3">
                <div class="col-6">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="fs-3 fw-bold text-primary">15,000+</div>
                        <small class="text-muted">Computers Assembled & Delivered</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="fs-3 fw-bold text-primary">100%</div>
                        <small class="text-muted">Genuine Brand Sourced Parts</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 p-4 bg-white">
                <h5 class="fw-bold mb-3 text-slate-900 border-bottom pb-2">Why Choose Hari Om Computer?</h5>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-shield-fill-check text-primary fs-4"></i>
                        <div>
                            <strong>Genuine Products Guarantee:</strong> All laptops and components come with authentic serial numbers and manufacturer warranties.
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-currency-rupee text-success fs-4"></i>
                        <div>
                            <strong>Competitive Pricing & GST Benefits:</strong> Unmatched wholesale rates in Jodhpur with full 18% GST input credit support.
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-cpu text-info fs-4"></i>
                        <div>
                            <strong>Custom PC Assembly & Stress Testing:</strong> Zero assembly fee, premium thermal paste, stress-tested before dispatch.
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3">
                        <i class="bi bi-headset text-warning fs-4"></i>
                        <div>
                            <strong>Expert Technical Support:</strong> In-house chip level engineers for diagnostics, BIOS updates, and prompt servicing.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection

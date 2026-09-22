@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Storefront Content & SEO</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Banners, Offers, About Us & SEO</span>
        </div>
    </div>
    <button class="btn btn-primary" onclick="HOC_UTILS.showToast('Website settings saved successfully!')">
        <i class="bi bi-save me-1"></i> Save Changes
    </button>
</div>

<div class="row g-4">
    <!-- Hero Banner Settings -->
    <div class="col-lg-6">
        <div class="admin-card p-4 h-100">
            <h5 class="admin-card-title mb-3"><i class="bi bi-image me-2 text-primary"></i> Homepage Hero Banner</h5>
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Hero Headline</label>
                <input type="text" class="form-control" value="Build Your Dream Computer & Empower Your Workflow">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Hero Sub-Text</label>
                <textarea class="form-control" rows="2">Powerful Custom Gaming Rigs, Latest 14th Gen Laptops, Genuine Computer Components & Enterprise Workstations at Unbeatable Wholesale Rates.</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Featured PC Setup Name</label>
                <input type="text" class="form-control" value="Hari Om Beast Gaming PC - RTX 4060">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Featured PC Promo Price (₹)</label>
                <input type="number" class="form-control" value="72990">
            </div>
        </div>
    </div>

    <!-- SEO & Meta Tags -->
    <div class="col-lg-6">
        <div class="admin-card p-4 h-100">
            <h5 class="admin-card-title mb-3"><i class="bi bi-search me-2 text-primary"></i> Search Engine Optimization (SEO)</h5>
            
            <div class="mb-3">
                <label class="form-label small fw-bold">Meta Title Tag</label>
                <input type="text" class="form-control" value="Hari Om Computer | Best Computer Shop & Custom PC Builder in Jodhpur">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Meta Description</label>
                <textarea class="form-control" rows="2">Hari Om Computer Jodhpur: Buy latest laptops, gaming PCs, Intel 14th Gen CPUs, NVIDIA RTX 4000 GPUs and request instant GST quotations.</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Keywords</label>
                <input type="text" class="form-control" value="computer shop jodhpur, laptop store sojati gate, custom pc builder rajasthan, gaming pc jodhpur">
            </div>
        </div>
    </div>

    <!-- Showroom Contact Info in CMS -->
    <div class="col-12">
        <div class="admin-card p-4">
            <h5 class="admin-card-title mb-3"><i class="bi bi-telephone me-2 text-primary"></i> Store Contact & Social Channels</h5>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">WhatsApp Hotline</label>
                    <input type="text" class="form-control" value="+91 98290 12345">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Landline Phone</label>
                    <input type="text" class="form-control" value="0291-2654321">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Inquiry Email</label>
                    <input type="email" class="form-control" value="info@hariomcomputer.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Physical Showroom Address</label>
                    <input type="text" class="form-control" value="Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Opening Hours</label>
                    <input type="text" class="form-control" value="Mon - Sat: 10:00 AM - 8:30 PM (Sunday Closed)">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.includes.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Analytics & GST Returns</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>GSTR-1, GSTR-3B & Profit Margins</span>
        </div>
    </div>
</div>

<!-- Quick Metrics Summary -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="kpi-label">Gross Sales (Aug 2026)</div>
            <div class="kpi-value">₹8,45,000</div>
            <small class="text-success">Net Taxable: ₹7,16,101</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="kpi-label">Output GST (18%)</div>
            <div class="kpi-value text-primary">₹1,28,899</div>
            <small class="text-muted">CGST + SGST (9%+9%)</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="kpi-label">Input Tax Credit (ITC)</div>
            <div class="kpi-value text-info">₹1,20,150</div>
            <small class="text-muted">From Distributor Inwards</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="kpi-label">Net GST Payable</div>
            <div class="kpi-value text-success">₹8,749</div>
            <small class="text-success">After ITC Adjustment</small>
        </div>
    </div>
</div>

<!-- Report Tabs -->
<div class="admin-card">
    <div class="admin-card-header">
        <ul class="nav nav-tabs card-header-tabs" id="reportTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sales-rep">Sales Report</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#gst-rep">GST Statement (GSTR-1)</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#profit-rep">Profitability by Category</button></li>
        </ul>
    </div>

    <div class="p-4 tab-content">
        <!-- Sales Report Tab -->
        <div class="tab-pane fade show active" id="sales-rep">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold text-slate-900 m-0"><i class="bi bi-calendar3 me-2 text-primary"></i>Daily Sales Breakdown (August 2026)</h6>
                <span class="badge bg-light text-slate-700 border px-3 py-1.5 font-monospace">Consolidated Net</span>
            </div>
            <div class="table-responsive">
                <table class="table table-catalog align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Date</th>
                            <th class="text-center">Invoices Issued</th>
                            <th class="text-end">Gross Revenue (₹)</th>
                            <th class="text-end">Taxable Base (₹)</th>
                            <th class="text-end pe-4">GST Collected (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-semibold text-slate-800">14-Aug-2026</td>
                            <td class="text-center"><span class="badge bg-light text-slate-800 border rounded-pill px-2.5 py-1">4 Bills</span></td>
                            <td class="text-end fw-bold text-slate-900">₹1,52,980.00</td>
                            <td class="text-end text-slate-700">₹1,29,644.00</td>
                            <td class="text-end pe-4 fw-semibold text-primary">₹23,336.00</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-semibold text-slate-800">13-Aug-2026</td>
                            <td class="text-center"><span class="badge bg-light text-slate-800 border rounded-pill px-2.5 py-1">5 Bills</span></td>
                            <td class="text-end fw-bold text-slate-900">₹1,85,000.00</td>
                            <td class="text-end text-slate-700">₹1,56,780.00</td>
                            <td class="text-end pe-4 fw-semibold text-primary">₹28,220.00</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-semibold text-slate-800">12-Aug-2026</td>
                            <td class="text-center"><span class="badge bg-light text-slate-800 border rounded-pill px-2.5 py-1">3 Bills</span></td>
                            <td class="text-end fw-bold text-slate-900">₹1,12,400.00</td>
                            <td class="text-end text-slate-700">₹95,254.00</td>
                            <td class="text-end pe-4 fw-semibold text-primary">₹17,146.00</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-semibold text-slate-800">11-Aug-2026</td>
                            <td class="text-center"><span class="badge bg-light text-slate-800 border rounded-pill px-2.5 py-1">6 Bills</span></td>
                            <td class="text-end fw-bold text-slate-900">₹2,45,000.00</td>
                            <td class="text-end text-slate-700">₹2,07,627.00</td>
                            <td class="text-end pe-4 fw-semibold text-primary">₹37,373.00</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-semibold text-slate-800">10-Aug-2026</td>
                            <td class="text-center"><span class="badge bg-light text-slate-800 border rounded-pill px-2.5 py-1">4 Bills</span></td>
                            <td class="text-end fw-bold text-slate-900">₹1,49,620.00</td>
                            <td class="text-end text-slate-700">₹1,26,796.00</td>
                            <td class="text-end pe-4 fw-semibold text-primary">₹22,824.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- GST Statement Tab -->
        <div class="tab-pane fade" id="gst-rep">
            <div class="alert alert-light border rounded-3 p-3 mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <span class="fw-bold text-slate-900"><i class="bi bi-shield-check text-primary me-1"></i> Hari Om Computer GSTIN:</span> 
                    <code class="fs-6 text-primary ms-1">08AABCH1234F1Z9</code> 
                    <span class="text-muted ms-2">&bull; State Code: 08 (Rajasthan)</span>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 fw-bold">GSTR-1 Ready</span>
            </div>
            <div class="table-responsive">
                <table class="table table-catalog align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Customer GSTIN</th>
                            <th>Customer / Firm</th>
                            <th>Invoice No</th>
                            <th class="text-end">Taxable Value</th>
                            <th class="text-end">CGST (9%)</th>
                            <th class="text-end">SGST (9%)</th>
                            <th class="text-end pe-4">Total GST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4"><span class="badge bg-light text-slate-700 border font-monospace px-2.5 py-1">08AABCR1234F1Z3</span></td>
                            <td><strong class="text-slate-900">Rathore Infotech Pvt Ltd</strong></td>
                            <td><span class="badge bg-light text-dark border font-monospace">HOC/INV/2026/0001</span></td>
                            <td class="text-end fw-semibold text-slate-900">₹1,29,644.00</td>
                            <td class="text-end text-slate-700">₹11,668.00</td>
                            <td class="text-end text-slate-700">₹11,668.00</td>
                            <td class="text-end pe-4 fw-bold text-primary fs-6">₹23,336.00</td>
                        </tr>
                        <tr>
                            <td class="ps-4"><span class="badge bg-light text-slate-700 border font-monospace px-2.5 py-1">08AAGSM4433E1ZK</span></td>
                            <td><strong class="text-slate-900">Mehta Diagnostic & Imaging</strong></td>
                            <td><span class="badge bg-light text-dark border font-monospace">HOC/INV/2026/0002</span></td>
                            <td class="text-end fw-semibold text-slate-900">₹1,56,780.00</td>
                            <td class="text-end text-slate-700">₹14,110.00</td>
                            <td class="text-end text-slate-700">₹14,110.00</td>
                            <td class="text-end pe-4 fw-bold text-primary fs-6">₹28,220.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Profitability Tab -->
        <div class="tab-pane fade" id="profit-rep">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold text-slate-900 m-0"><i class="bi bi-pie-chart text-primary me-2"></i>Gross Margin by Hardware Category</h6>
                <span class="badge bg-emerald-subtle text-emerald border px-3 py-1.5 fw-bold" style="background: #dcfce7; color: #15803d;">Net Positive Margins</span>
            </div>
            <div class="table-responsive">
                <table class="table table-catalog align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Hardware Category</th>
                            <th class="text-end">Purchase Cost</th>
                            <th class="text-end">Sales Revenue</th>
                            <th class="text-end">Gross Profit Margin</th>
                            <th class="text-center pe-4">Margin %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="catalog-avatar-box" style="width: 32px; height: 32px;"><i class="bi bi-display"></i></div>
                                    <strong class="text-slate-900">Desktop Gaming PCs & Workstations</strong>
                                </div>
                            </td>
                            <td class="text-end text-slate-700">₹1,85,000.00</td>
                            <td class="text-end fw-bold text-slate-900">₹2,22,980.00</td>
                            <td class="text-end text-success fw-bold fs-6">₹37,980.00</td>
                            <td class="text-center pe-4"><span class="stock-status-pill healthy"><span class="stock-dot"></span><span>17.0%</span></span></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="catalog-avatar-box" style="width: 32px; height: 32px;"><i class="bi bi-laptop"></i></div>
                                    <strong class="text-slate-900">Laptops & Notebooks</strong>
                                </div>
                            </td>
                            <td class="text-end text-slate-700">₹3,15,000.00</td>
                            <td class="text-end fw-bold text-slate-900">₹3,56,490.00</td>
                            <td class="text-end text-success fw-bold fs-6">₹41,490.00</td>
                            <td class="text-center pe-4"><span class="stock-status-pill healthy"><span class="stock-dot"></span><span>11.6%</span></span></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="catalog-avatar-box" style="width: 32px; height: 32px;"><i class="bi bi-cpu"></i></div>
                                    <strong class="text-slate-900">Components (CPUs / GPUs / RAM)</strong>
                                </div>
                            </td>
                            <td class="text-end text-slate-700">₹1,42,000.00</td>
                            <td class="text-end fw-bold text-slate-900">₹1,68,900.00</td>
                            <td class="text-end text-success fw-bold fs-6">₹26,900.00</td>
                            <td class="text-center pe-4"><span class="stock-status-pill healthy"><span class="stock-dot"></span><span>15.9%</span></span></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="catalog-avatar-box" style="width: 32px; height: 32px;"><i class="bi bi-keyboard"></i></div>
                                    <strong class="text-slate-900">Accessories & Networking</strong>
                                </div>
                            </td>
                            <td class="text-end text-slate-700">₹45,000.00</td>
                            <td class="text-end fw-bold text-slate-900">₹62,500.00</td>
                            <td class="text-end text-success fw-bold fs-6">₹17,500.00</td>
                            <td class="text-center pe-4"><span class="stock-status-pill healthy"><span class="stock-dot"></span><span>28.0%</span></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

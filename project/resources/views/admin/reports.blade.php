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
            <h6 class="fw-bold mb-3">Daily Sales Breakdown (August 2026)</h6>
            <div class="table-responsive">
                <table class="table table-bordered small align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Invoices Issued</th>
                            <th>Gross Revenue (₹)</th>
                            <th>Taxable Base (₹)</th>
                            <th>GST Collected (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>14-Aug-2026</td><td>4</td><td>₹1,52,980</td><td>₹1,29,644</td><td>₹23,336</td></tr>
                        <tr><td>13-Aug-2026</td><td>5</td><td>₹1,85,000</td><td>₹1,56,780</td><td>₹28,220</td></tr>
                        <tr><td>12-Aug-2026</td><td>3</td><td>₹1,12,400</td><td>₹95,254</td><td>₹17,146</td></tr>
                        <tr><td>11-Aug-2026</td><td>6</td><td>₹2,45,000</td><td>₹2,07,627</td><td>₹37,373</td></tr>
                        <tr><td>10-Aug-2026</td><td>4</td><td>₹1,49,620</td><td>₹1,26,796</td><td>₹22,824</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- GST Statement Tab -->
        <div class="tab-pane fade" id="gst-rep">
            <h6 class="fw-bold mb-3">GST Return Data (Eligible for Input Tax Credit)</h6>
            <div class="alert alert-light border small">
                <strong>Hari Om Computer GSTIN:</strong> <code>08AABCH1234F1Z9</code> | State Code: 08 (Rajasthan)
            </div>
            <div class="table-responsive">
                <table class="table table-bordered small align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Customer GSTIN</th>
                            <th>Customer / Firm</th>
                            <th>Invoice No</th>
                            <th>Taxable Value</th>
                            <th>CGST (9%)</th>
                            <th>SGST (9%)</th>
                            <th>Total GST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>08AABCR1234F1Z3</code></td>
                            <td>Rathore Infotech Pvt Ltd</td>
                            <td>HOC/INV/2026/0001</td>
                            <td>₹1,29,644</td>
                            <td>₹11,668</td>
                            <td>₹11,668</td>
                            <td>₹23,336</td>
                        </tr>
                        <tr>
                            <td><code>08AAGSM4433E1ZK</code></td>
                            <td>Mehta Diagnostic & Imaging</td>
                            <td>HOC/INV/2026/0002</td>
                            <td>₹1,56,780</td>
                            <td>₹14,110</td>
                            <td>₹14,110</td>
                            <td>₹28,220</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Profitability Tab -->
        <div class="tab-pane fade" id="profit-rep">
            <h6 class="fw-bold mb-3">Gross Margin by Category</h6>
            <div class="table-responsive">
                <table class="table table-bordered small align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Category</th>
                            <th>Purchase Cost</th>
                            <th>Sales Revenue</th>
                            <th>Gross Profit Margin</th>
                            <th>Margin %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Desktop Gaming PCs & Workstations</td><td>₹1,85,000</td><td>₹2,22,980</td><td class="text-success fw-bold">₹37,980</td><td>17.0%</td></tr>
                        <tr><td>Laptops & Notebooks</td><td>₹3,15,000</td><td>₹3,56,490</td><td class="text-success fw-bold">₹41,490</td><td>11.6%</td></tr>
                        <tr><td>Components (CPUs / GPUs / RAM)</td><td>₹1,42,000</td><td>₹1,68,900</td><td class="text-success fw-bold">₹26,900</td><td>15.9%</td></tr>
                        <tr><td>Accessories & Networking</td><td>₹45,000</td><td>₹62,500</td><td class="text-success fw-bold">₹17,500</td><td>28.0%</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

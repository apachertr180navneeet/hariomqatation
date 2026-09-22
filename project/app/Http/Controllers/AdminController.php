<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Executive Dashboard with KPI cards, Chart.js trends, and recent quotes.
     */
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'pageTitle' => 'Admin Dashboard | Hari Om Computer ERP',
            'currentPage' => 'dashboard',
        ]);
    }

    /**
     * Quotations Directory list.
     */
    public function quotations(): View
    {
        return view('admin.quotations.index', [
            'pageTitle' => 'Quotations Directory | Hari Om Computer ERP',
            'currentPage' => 'quotations',
        ]);
    }

    /**
     * Generate commercial quotation.
     */
    public function quotationCreate(): View
    {
        return view('admin.quotations.create', [
            'pageTitle' => 'Create New Quotation | Hari Om Computer ERP',
            'currentPage' => 'quotation-create',
        ]);
    }

    /**
     * View detailed quotation.
     */
    public function quotationView(Request $request): View
    {
        return view('admin.quotations.view', [
            'pageTitle' => 'View Quotation | Hari Om Computer ERP',
            'currentPage' => 'quotations',
            'quotationId' => $request->query('id', 'HOC/QTN/2026/0001'),
        ]);
    }

    /**
     * Printable A4 letterhead quotation preview.
     */
    public function quotationPrint(Request $request): View
    {
        return view('admin.quotations.print', [
            'pageTitle' => 'Print Quotation | Hari Om Computer',
            'currentPage' => 'quotations',
            'quotationId' => $request->query('id', 'HOC/QTN/2026/0001'),
        ]);
    }

    /**
     * Admin Custom PC Builder & Rig Configurator.
     */
    public function pcBuilder(): View
    {
        return view('admin.pc-builder', [
            'pageTitle' => 'Custom PC Builder ERP | Hari Om Computer',
            'currentPage' => 'pc-builder',
        ]);
    }

    /**
     * Sales Orders & Invoices directory.
     */
    public function sales(): View
    {
        return view('admin.sales.index', [
            'pageTitle' => 'Sales & Invoices | Hari Om Computer ERP',
            'currentPage' => 'sales',
        ]);
    }

    /**
     * GST Tax Invoice Printable A4 preview.
     */
    public function invoiceView(Request $request): View
    {
        return view('admin.sales.invoice', [
            'pageTitle' => 'Sales Invoice | Hari Om Computer',
            'currentPage' => 'sales',
            'invoiceId' => $request->query('id', 'HOC/INV/2026/0001'),
        ]);
    }

    /**
     * Products catalog directory.
     */
    public function products(): View
    {
        return view('admin.products.index', [
            'pageTitle' => 'Products Catalog | Hari Om Computer ERP',
            'currentPage' => 'products',
        ]);
    }

    /**
     * Create product SKU entry.
     */
    public function productAdd(): View
    {
        return view('admin.products.add', [
            'pageTitle' => 'Add New Product | Hari Om Computer ERP',
            'currentPage' => 'product-add',
        ]);
    }

    /**
     * Product details and physical stock breakdown.
     */
    public function productView(Request $request): View
    {
        return view('admin.products.view', [
            'pageTitle' => 'Product Details | Hari Om Computer ERP',
            'currentPage' => 'products',
            'productId' => $request->query('id', 'PROD-1001'),
        ]);
    }

    /**
     * Laptops dedicated catalog.
     */
    public function laptops(): View
    {
        return view('admin.laptops', [
            'pageTitle' => 'Laptops Catalog | Hari Om Computer ERP',
            'currentPage' => 'laptops',
        ]);
    }

    /**
     * Desktop PCs & workstations catalog.
     */
    public function computers(): View
    {
        return view('admin.computers', [
            'pageTitle' => 'Desktop PCs Catalog | Hari Om Computer ERP',
            'currentPage' => 'computers',
        ]);
    }

    /**
     * Categories taxonomy.
     */
    public function categories(): View
    {
        return view('admin.categories', [
            'pageTitle' => 'Categories & Taxonomy | Hari Om Computer ERP',
            'currentPage' => 'categories',
        ]);
    }

    /**
     * Partner brands management.
     */
    public function brands(): View
    {
        return view('admin.brands', [
            'pageTitle' => 'Brands Management | Hari Om Computer ERP',
            'currentPage' => 'brands',
        ]);
    }

    /**
     * Physical stock ledger and reorder alerts.
     */
    public function inventory(): View
    {
        return view('admin.inventory', [
            'pageTitle' => 'Inventory Stock Management | Hari Om Computer ERP',
            'currentPage' => 'inventory',
        ]);
    }

    /**
     * Customer CRM accounts.
     */
    public function customers(): View
    {
        return view('admin.customers', [
            'pageTitle' => 'Customer CRM | Hari Om Computer ERP',
            'currentPage' => 'customers',
        ]);
    }

    /**
     * Purchase orders & vendor inwards.
     */
    public function purchases(): View
    {
        return view('admin.purchases', [
            'pageTitle' => 'Purchase Orders | Hari Om Computer ERP',
            'currentPage' => 'purchases',
        ]);
    }

    /**
     * Suppliers & distributor directory.
     */
    public function suppliers(): View
    {
        return view('admin.suppliers', [
            'pageTitle' => 'Suppliers Directory | Hari Om Computer ERP',
            'currentPage' => 'suppliers',
        ]);
    }

    /**
     * Received payments ledger.
     */
    public function payments(): View
    {
        return view('admin.payments', [
            'pageTitle' => 'Payments & Accounts | Hari Om Computer ERP',
            'currentPage' => 'payments',
        ]);
    }

    /**
     * Reports, analytics, and GST statements.
     */
    public function reports(): View
    {
        return view('admin.reports', [
            'pageTitle' => 'Reports & GST Filing | Hari Om Computer ERP',
            'currentPage' => 'reports',
        ]);
    }

    /**
     * Storefront CMS & SEO settings.
     */
    public function websiteMgmt(): View
    {
        return view('admin.website-mgmt', [
            'pageTitle' => 'Website CMS Management | Hari Om Computer ERP',
            'currentPage' => 'website-mgmt',
        ]);
    }

    /**
     * Store legal entity, GST & Bank configuration.
     */
    public function settings(): View
    {
        return view('admin.settings', [
            'pageTitle' => 'Store & GST Settings | Hari Om Computer ERP',
            'currentPage' => 'settings',
        ]);
    }

    /**
     * Admin login portal redirect.
     */
    public function login(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('admin.login');
    }
}

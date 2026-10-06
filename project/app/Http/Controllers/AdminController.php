<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Executive Dashboard with live DB KPI cards, Chart.js trends, and recent quotes.
     */
    public function dashboard(): View
    {
        $todayStart = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        // Quotations & Sales metrics from DB
        $todayQuotesSum = Quotation::where('created_at', '>=', $todayStart)->sum('grand_total');
        $monthlyQuotesSum = Quotation::where('created_at', '>=', $monthStart)->sum('grand_total');
        $approvedSalesSum = Quotation::whereIn('status', ['Approved', 'Converted'])->sum('grand_total');

        $totalQuotes = Quotation::count();
        $pendingQuotes = Quotation::whereIn('status', ['Pending', 'Draft'])->count();
        $approvedQuotes = Quotation::where('status', 'Approved')->count();
        $convertedQuotes = Quotation::where('status', 'Converted')->count();

        // Invoiced Sales & Financials
        $totalInvoiced = Invoice::where('status', 'Issued')->sum('grand_total');
        $totalCollected = Invoice::where('status', 'Issued')->sum('paid_amount');
        $totalOutstanding = Invoice::where('status', 'Issued')->sum('balance_amount');
        $totalInvoicesCount = Invoice::count();
        $totalCustomers = Customer::count();
        $totalSuppliers = Supplier::count();
        $totalPurchasesValue = Purchase::where('status', 'Received')->sum('grand_total');

        // Inventory & Products metrics
        $totalProducts = Product::count();
        $lowStockCount = Product::lowStock()->count();
        $totalStockUnits = Product::sum('stock');
        $inventoryCostValue = Product::selectRaw('SUM(stock * purchase_price) as val')->value('val') ?? 0;
        $lowStockItems = Product::lowStock()->with(['category', 'brand'])->take(5)->get();

        // Recent real quotations from DB
        $recentQuotations = Quotation::latest()->take(6)->get();
        $recentInvoices = Invoice::latest()->take(5)->get();

        // Monthly trends (Last 6 months)
        $chartMonths = [];
        $chartRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $chartMonths[] = $monthDate->format('M Y');
            $rev = Quotation::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->sum('grand_total');
            $chartRevenue[] = (float) $rev;
        }

        // Category distribution for pie chart
        $categoriesWithCount = Category::withCount('products')->having('products_count', '>', 0)->get();
        $catLabels = $categoriesWithCount->pluck('name')->toArray();
        $catCounts = $categoriesWithCount->pluck('products_count')->toArray();

        return view('admin.dashboard', [
            'pageTitle' => 'Admin Dashboard | Hari Om Computer ERP',
            'currentPage' => 'dashboard',
            'todaySales' => $todayQuotesSum,
            'monthlySales' => $monthlyQuotesSum,
            'approvedSales' => $approvedSalesSum,
            'totalQuotes' => $totalQuotes,
            'pendingQuotes' => $pendingQuotes,
            'approvedQuotes' => $approvedQuotes,
            'convertedQuotes' => $convertedQuotes,
            'totalInvoiced' => $totalInvoiced,
            'totalCollected' => $totalCollected,
            'totalOutstanding' => $totalOutstanding,
            'totalInvoicesCount' => $totalInvoicesCount,
            'totalCustomers' => $totalCustomers,
            'totalSuppliers' => $totalSuppliers,
            'totalPurchasesValue' => $totalPurchasesValue,
            'totalProducts' => $totalProducts,
            'lowStockCount' => $lowStockCount,
            'totalStockUnits' => $totalStockUnits,
            'inventoryCostValue' => $inventoryCostValue,
            'lowStockItems' => $lowStockItems,
            'recentQuotations' => $recentQuotations,
            'recentInvoices' => $recentInvoices,
            'chartMonths' => $chartMonths,
            'chartRevenue' => $chartRevenue,
            'catLabels' => $catLabels,
            'catCounts' => $catCounts,
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

    // Note: Products, Categories, Brands, Laptops, Computers, and Inventory are now managed
    // by their respective specialized controllers: ProductController, CategoryController,
    // BrandController, and InventoryController.

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

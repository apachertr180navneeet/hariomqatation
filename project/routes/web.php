<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Hari Om Computer Customer Storefront
|--------------------------------------------------------------------------
*/

Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/computers', 'computers')->name('computers');
    Route::get('/laptops', 'laptops')->name('laptops');
    Route::get('/components', 'components')->name('components');
    Route::get('/products', 'products')->name('products');
    Route::get('/product-details', 'productDetails')->name('product.details');
    Route::get('/pc-builder', 'pcBuilder')->name('pc.builder');
    Route::get('/enquiry', 'enquiry')->name('enquiry');
    Route::post('/enquiry', 'submitEnquiry')->name('enquiry.submit');
    Route::get('/quotation-success', 'quotationSuccess')->name('quotation.success');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
});

/*
|--------------------------------------------------------------------------
| Web Routes - Hari Om Computer Admin Authentication (Guest Only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
        Route::get('/login.php', [AuthController::class, 'showLoginForm']);
    });
});

/*
|--------------------------------------------------------------------------
| Web Routes - Hari Om Computer Admin ERP Portal (Authenticated Only)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);

    // ==========================================
    // Catalog & Inventory Modules
    // ==========================================

    // Products Catalog
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/add', 'create')->name('products.add');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/view', 'show')->name('products.view');
        Route::get('/products/{id}/edit', 'edit')->name('products.edit');
        Route::put('/products/{id}', 'update')->name('products.update');
        Route::delete('/products/{id}', 'destroy')->name('products.destroy');
        Route::get('/laptops', 'laptops')->name('laptops');
        Route::get('/computers', 'computers')->name('computers');
        Route::get('/api/categories/{category}/subcategories', 'getSubcategoriesByCategory')->name('categories.subcategories.api');

        // Legacy compatibility
        Route::get('/products.php', 'index');
        Route::get('/product-add.php', 'create');
        Route::get('/product-view.php', 'show');
        Route::get('/laptops.php', 'laptops');
        Route::get('/computers.php', 'computers');
    });

    // Categories Taxonomy
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');
        Route::post('/categories', 'store')->name('categories.store');
        Route::put('/categories/{id}', 'update')->name('categories.update');
        Route::delete('/categories/{id}', 'destroy')->name('categories.destroy');
        Route::patch('/categories/{id}/toggle-status', 'toggleStatus')->name('categories.toggle-status');

        // Subcategories
        Route::post('/categories/{category}/subcategories', 'storeSubcategory')->name('categories.subcategories.store');
        Route::put('/categories/subcategories/{id}', 'updateSubcategory')->name('categories.subcategories.update');
        Route::delete('/categories/subcategories/{id}', 'destroySubcategory')->name('categories.subcategories.destroy');
        Route::patch('/categories/subcategories/{id}/toggle-status', 'toggleSubcategoryStatus')->name('categories.subcategories.toggle-status');

        // Legacy compatibility
        Route::get('/categories.php', 'index');
    });

    // Hardware Brands
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'index')->name('brands');
        Route::post('/brands', 'store')->name('brands.store');
        Route::put('/brands/{id}', 'update')->name('brands.update');
        Route::delete('/brands/{id}', 'destroy')->name('brands.destroy');

        // Legacy compatibility
        Route::get('/brands.php', 'index');
    });

    // Inventory Stock Ledger & Tracking
    Route::controller(InventoryController::class)->group(function () {
        Route::get('/inventory', 'index')->name('inventory');
        Route::post('/inventory/inward', 'inward')->name('inventory.inward');
        Route::post('/inventory/adjust', 'adjust')->name('inventory.adjust');
        Route::get('/inventory/movements/{id}', 'movements')->name('inventory.movements');

        // Legacy compatibility
        Route::get('/inventory.php', 'index');
    });

    // Quotation Management (Full Database CRUD)
    Route::controller(QuotationController::class)->group(function () {
        Route::get('/quotations', 'index')->name('quotations');
        Route::get('/quotations/create', 'create')->name('quotations.create');
        Route::post('/quotations', 'store')->name('quotations.store');
        Route::get('/quotations/view', 'show')->name('quotations.view');
        Route::get('/quotations/print', 'print')->name('quotations.print');
        Route::get('/quotations/{id}', 'show')->name('quotations.show');
        Route::get('/quotations/{id}/print', 'print')->name('quotations.print.id');
        Route::patch('/quotations/{id}/status', 'updateStatus')->name('quotations.status');
        Route::delete('/quotations/{id}', 'destroy')->name('quotations.destroy');

        // Legacy compatibility
        Route::get('/quotations.php', 'index');
        Route::get('/quotation-create.php', 'create');
        Route::get('/quotation-view.php', 'show');
        Route::get('/quotation-print.php', 'print');
    });

    // ==========================================
    // Customer CRM Accounts
    // ==========================================
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index')->name('customers');
        Route::post('/customers', 'store')->name('customers.store');
        Route::put('/customers/{id}', 'update')->name('customers.update');
        Route::delete('/customers/{id}', 'destroy')->name('customers.destroy');
        Route::get('/customers.php', 'index');
    });

    // ==========================================
    // Sales Orders & GST Tax Invoices
    // ==========================================
    Route::controller(SalesController::class)->group(function () {
        Route::get('/sales', 'index')->name('sales');
        Route::get('/invoices/view', 'invoice')->name('invoices.view');
        Route::get('/invoices/{id}', 'invoice')->name('invoices.show');
        Route::post('/quotations/{id}/convert', 'convertFromQuotation')->name('quotations.convert');
        Route::get('/sales.php', 'index');
        Route::get('/invoice-view.php', 'invoice');
    });

    // ==========================================
    // Suppliers Directory & Vendor Accounts
    // ==========================================
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('suppliers');
        Route::post('/suppliers', 'store')->name('suppliers.store');
        Route::put('/suppliers/{id}', 'update')->name('suppliers.update');
        Route::delete('/suppliers/{id}', 'destroy')->name('suppliers.destroy');
        Route::get('/suppliers.php', 'index');
    });

    // ==========================================
    // Purchases & Stock Inward Bills
    // ==========================================
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchases', 'index')->name('purchases');
        Route::get('/purchases/create', 'create')->name('purchases.create');
        Route::post('/purchases', 'store')->name('purchases.store');
        Route::get('/purchases/{id}', 'show')->name('purchases.show');
        Route::get('/purchases.php', 'index');
    });

    // ==========================================
    // General ERP Modules
    // ==========================================
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard');
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        // Custom PC Builder ERP
        Route::get('/pc-builder', 'pcBuilder')->name('pc.builder');

        // Operations & Accounting
        Route::get('/payments', 'payments')->name('payments');
        Route::get('/reports', 'reports')->name('reports');
        Route::get('/website-mgmt', 'websiteMgmt')->name('website.mgmt');
        Route::get('/settings', 'settings')->name('settings');

        // Legacy Prototype compatibility aliases (.php extension support)
        Route::get('/dashboard.php', 'dashboard');
        Route::get('/pc-builder.php', 'pcBuilder');
        Route::get('/payments.php', 'payments');
        Route::get('/reports.php', 'reports');
        Route::get('/website-mgmt.php', 'websiteMgmt');
        Route::get('/settings.php', 'settings');
    });
});


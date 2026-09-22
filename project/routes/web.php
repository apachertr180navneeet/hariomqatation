<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
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
        Route::post('/categories/{category}/subcategories', 'storeSubcategory')->name('categories.subcategories.store');
        Route::delete('/categories/subcategories/{id}', 'destroySubcategory')->name('categories.subcategories.destroy');

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

    // ==========================================
    // General ERP Modules
    // ==========================================
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard');
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        // Quotation Management
        Route::get('/quotations', 'quotations')->name('quotations');
        Route::get('/quotations/create', 'quotationCreate')->name('quotations.create');
        Route::get('/quotations/view', 'quotationView')->name('quotations.view');
        Route::get('/quotations/print', 'quotationPrint')->name('quotations.print');

        // Custom PC Builder ERP
        Route::get('/pc-builder', 'pcBuilder')->name('pc.builder');

        // Sales & Tax Invoices
        Route::get('/sales', 'sales')->name('sales');
        Route::get('/invoices/view', 'invoiceView')->name('invoices.view');

        // Operations & Accounting
        Route::get('/customers', 'customers')->name('customers');
        Route::get('/purchases', 'purchases')->name('purchases');
        Route::get('/suppliers', 'suppliers')->name('suppliers');
        Route::get('/payments', 'payments')->name('payments');
        Route::get('/reports', 'reports')->name('reports');
        Route::get('/website-mgmt', 'websiteMgmt')->name('website.mgmt');
        Route::get('/settings', 'settings')->name('settings');

        // Legacy Prototype compatibility aliases (.php extension support)
        Route::get('/dashboard.php', 'dashboard');
        Route::get('/quotations.php', 'quotations');
        Route::get('/quotation-create.php', 'quotationCreate');
        Route::get('/quotation-view.php', 'quotationView');
        Route::get('/quotation-print.php', 'quotationPrint');
        Route::get('/pc-builder.php', 'pcBuilder');
        Route::get('/sales.php', 'sales');
        Route::get('/invoice-view.php', 'invoiceView');
        Route::get('/customers.php', 'customers');
        Route::get('/purchases.php', 'purchases');
        Route::get('/suppliers.php', 'suppliers');
        Route::get('/payments.php', 'payments');
        Route::get('/reports.php', 'reports');
        Route::get('/website-mgmt.php', 'websiteMgmt');
        Route::get('/settings.php', 'settings');
    });
});


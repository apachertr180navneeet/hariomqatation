<?php

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
| Web Routes - Hari Om Computer Admin ERP Portal
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::redirect('/', '/admin/dashboard');

    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/login', 'login')->name('login');

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

    // Catalog & Products
    Route::get('/products', 'products')->name('products');
    Route::get('/products/add', 'productAdd')->name('products.add');
    Route::get('/products/view', 'productView')->name('products.view');
    Route::get('/laptops', 'laptops')->name('laptops');
    Route::get('/computers', 'computers')->name('computers');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/brands', 'brands')->name('brands');

    // Operations & Accounting
    Route::get('/inventory', 'inventory')->name('inventory');
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
    Route::get('/products.php', 'products');
    Route::get('/product-add.php', 'productAdd');
    Route::get('/product-view.php', 'productView');
    Route::get('/laptops.php', 'laptops');
    Route::get('/computers.php', 'computers');
    Route::get('/categories.php', 'categories');
    Route::get('/brands.php', 'brands');
    Route::get('/inventory.php', 'inventory');
    Route::get('/customers.php', 'customers');
    Route::get('/purchases.php', 'purchases');
    Route::get('/suppliers.php', 'suppliers');
    Route::get('/payments.php', 'payments');
    Route::get('/reports.php', 'reports');
    Route::get('/website-mgmt.php', 'websiteMgmt');
    Route::get('/settings.php', 'settings');
    Route::get('/login.php', 'login');
});


<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class AdminPrototypeModulesTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        if (Product::count() === 0) {
            $this->seed(DatabaseSeeder::class);
        }
        $admin = User::where('email', 'admin@hariomcomputer.com')->first();
        if (!$admin) {
            $this->seed(AdminUserSeeder::class);
            $admin = User::where('email', 'admin@hariomcomputer.com')->first();
        }
        $this->admin = $admin;
    }

    public function test_admin_dashboard_renders(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Admin Dashboard');
        $response->assertSee('Quotations');
    }

    public function test_admin_quotations_directory_renders(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/quotations');

        $response->assertStatus(200);
        $response->assertSee('Quotations Directory');
    }

    public function test_admin_quotation_create_page_renders(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/quotations/create');

        $response->assertStatus(200);
        $response->assertSee('Create New Quotation');
    }

    public function test_admin_can_store_quotation(): void
    {
        $product = Product::active()->first();

        $postData = [
            'quotation_no' => 'HOC/QTN/TEST/' . rand(1000, 9999),
            'customer_name' => 'Test Business Solutions',
            'customer_company' => 'TBS Pvt Ltd',
            'customer_phone' => '9829099999',
            'customer_email' => 'tbs@example.com',
            'customer_gstin' => '08AABCT9999F1Z1',
            'customer_address' => 'High Court Road, Jodhpur',
            'quotation_date' => now()->format('Y-m-d'),
            'valid_until' => now()->addDays(15)->format('Y-m-d'),
            'status' => 'Pending',
            'notes' => 'Quotation generated via automated test',
            'items' => [
                [
                    'product_id' => $product?->id,
                    'item_name' => $product?->name ?? 'Core i7 Rig',
                    'sku' => $product?->sku ?? 'RIG-001',
                    'quantity' => 2,
                    'unit_rate' => 45000,
                    'discount' => 1000,
                    'gst_rate' => 18,
                ]
            ],
        ];

        $response = $this->actingAs($this->admin)->post('/admin/quotations', $postData);

        $response->assertRedirect();
        $this->assertDatabaseHas('quotations', [
            'quotation_no' => $postData['quotation_no'],
            'customer_name' => 'Test Business Solutions',
        ]);
    }

    public function test_admin_quotation_view_and_print_render(): void
    {
        $quotation = Quotation::first();
        $this->assertNotNull($quotation);

        $viewResponse = $this->actingAs($this->admin)->get('/admin/quotations/' . $quotation->id);
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee($quotation->quotation_no);

        // Also test query parameter format /admin/quotations/view?id=...
        $viewQueryResponse = $this->actingAs($this->admin)->get('/admin/quotations/view?id=' . $quotation->id);
        $viewQueryResponse->assertStatus(200);

        $printResponse = $this->actingAs($this->admin)->get('/admin/quotations/' . $quotation->id . '/print');
        $printResponse->assertStatus(200);
        $printResponse->assertSee($quotation->quotation_no);
    }

    public function test_admin_can_update_quotation_status(): void
    {
        $quotation = Quotation::first();
        $this->assertNotNull($quotation);

        $response = $this->actingAs($this->admin)->patch('/admin/quotations/' . $quotation->id . '/status', [
            'status' => 'Approved',
        ]);

        $response->assertRedirect();
        $this->assertEquals('Approved', $quotation->fresh()->status);
    }

    public function test_admin_sales_orders_directory_renders(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/sales');

        $response->assertStatus(200);
        $response->assertSee('Sales Orders & Tax Invoices', false);
    }

    public function test_admin_invoice_view_renders(): void
    {
        $invoice = Invoice::first();
        $this->assertNotNull($invoice);

        $response = $this->actingAs($this->admin)->get('/admin/invoices/' . $invoice->id);
        $response->assertStatus(200);
        $response->assertSee($invoice->invoice_no);

        $queryResponse = $this->actingAs($this->admin)->get('/admin/invoices/view?id=' . $invoice->id);
        $queryResponse->assertStatus(200);
    }

    public function test_admin_can_convert_quotation_to_invoice(): void
    {
        $quotation = Quotation::whereDoesntHave('invoice')->first();
        if (!$quotation) {
            $quotation = Quotation::create([
                'quotation_no' => 'HOC/QTN/CONVERT/' . rand(1000, 9999),
                'customer_name' => 'Convert Test Corp',
                'customer_phone' => '9829011111',
                'quotation_date' => now(),
                'valid_until' => now()->addDays(15),
                'status' => 'Approved',
                'subtotal' => 10000,
                'discount_total' => 0,
                'taxable_amount' => 10000,
                'gst_total' => 1800,
                'round_off' => 0,
                'grand_total' => 11800,
            ]);
            $quotation->items()->create([
                'item_name' => 'Testing Component',
                'quantity' => 1,
                'unit_rate' => 10000,
                'gst_rate' => 18,
                'taxable_amount' => 10000,
                'gst_amount' => 1800,
                'total_amount' => 11800,
            ]);
        }

        $response = $this->actingAs($this->admin)->post('/admin/quotations/' . $quotation->id . '/convert');

        $response->assertRedirect();
        $this->assertDatabaseHas('invoices', [
            'quotation_id' => $quotation->id,
        ]);
    }

    public function test_admin_categories_taxonomy_and_crud(): void
    {
        $indexResponse = $this->actingAs($this->admin)->get('/admin/categories');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Categories');

        // Create Category
        $catName = 'Test Peripherals ' . rand(100, 999);
        $createResponse = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => $catName,
            'description' => 'Test category for accessories',
        ]);
        $createResponse->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => $catName]);

        $createdCategory = Category::where('name', $catName)->first();

        // Add Subcategory
        $subName = 'Gaming Mice ' . rand(100, 999);
        $subResponse = $this->actingAs($this->admin)->post('/admin/categories/' . $createdCategory->id . '/subcategories', [
            'name' => $subName,
        ]);
        $subResponse->assertRedirect();
        $this->assertDatabaseHas('subcategories', ['name' => $subName]);

        // Toggle Status
        $toggleResponse = $this->actingAs($this->admin)->patch('/admin/categories/' . $createdCategory->id . '/toggle-status');
        $toggleResponse->assertRedirect();
        $this->assertEquals('inactive', $createdCategory->fresh()->status);
    }

    public function test_admin_brands_directory_and_crud(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/brands');
        $response->assertStatus(200);
        $response->assertSee('Brands');

        $brandName = 'Test Brand ' . rand(100, 999);
        $createResponse = $this->actingAs($this->admin)->post('/admin/brands', [
            'name' => $brandName,
        ]);
        $createResponse->assertRedirect();
        $this->assertDatabaseHas('brands', ['name' => $brandName]);
    }

    public function test_admin_products_catalog_and_crud(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('Products');

        $addResponse = $this->actingAs($this->admin)->get('/admin/products/add');
        $addResponse->assertStatus(200);
        $addResponse->assertSee('Add New Product');

        $category = Category::first();
        $brand = Brand::first();

        $prodName = 'Test Monitor Pro ' . rand(100, 999);
        $storeResponse = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => $prodName,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'specs' => '27 inch 144Hz IPS Gaming Monitor',
            'purchase_price' => 12000,
            'selling_price' => 15500,
            'mrp' => 18000,
            'gst_rate' => 18,
            'stock' => 5,
            'min_stock' => 2,
            'warranty' => '3 Years Onsite',
        ]);
        $storeResponse->assertRedirect();
        $this->assertDatabaseHas('products', ['name' => $prodName]);

        $product = Product::where('name', $prodName)->first();

        $viewResponse = $this->actingAs($this->admin)->get('/admin/products/view?id=' . $product->id);
        $viewResponse->assertStatus(200);

        $editResponse = $this->actingAs($this->admin)->get('/admin/products/' . $product->id . '/edit');
        $editResponse->assertStatus(200);

        $updateResponse = $this->actingAs($this->admin)->put('/admin/products/' . $product->id, [
            'name' => $prodName . ' Updated',
            'sku' => $product->sku,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'specs' => '27 inch 165Hz IPS Gaming Monitor',
            'purchase_price' => 12000,
            'selling_price' => 16000,
            'mrp' => 19000,
            'gst_rate' => 18,
            'min_stock' => 2,
            'warranty' => '3 Years Onsite',
        ]);
        $updateResponse->assertRedirect();
        $this->assertEquals($prodName . ' Updated', $product->fresh()->name);
    }

    public function test_admin_laptops_and_computers_subcatalogs(): void
    {
        $laptops = $this->actingAs($this->admin)->get('/admin/laptops');
        $laptops->assertStatus(200);
        $laptops->assertSee('Laptops');

        $computers = $this->actingAs($this->admin)->get('/admin/computers');
        $computers->assertStatus(200);
        $computers->assertSee('Desktop PCs');
    }

    public function test_admin_inventory_ledger_inward_and_adjust(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/inventory');
        $response->assertStatus(200);
        $response->assertSee('Inventory');

        $product = Product::first();
        $prevStock = $product->stock;

        // Inward
        $inwardResponse = $this->actingAs($this->admin)->post('/admin/inventory/inward', [
            'product_id' => $product->id,
            'quantity' => 10,
            'unit_cost' => $product->purchase_price,
            'notes' => 'Test Inward Delivery',
        ]);
        $inwardResponse->assertRedirect();
        $this->assertEquals($prevStock + 10, $product->fresh()->stock);

        // Adjust
        $adjustResponse = $this->actingAs($this->admin)->post('/admin/inventory/adjust', [
            'product_id' => $product->id,
            'new_stock' => $prevStock + 5,
            'reason' => 'Cycle Count Adjustment',
        ]);
        $adjustResponse->assertRedirect();
        $this->assertEquals($prevStock + 5, $product->fresh()->stock);

        // Movement ledger
        $movements = $this->actingAs($this->admin)->get('/admin/inventory/movements/' . $product->id);
        $movements->assertStatus(200);
    }

    public function test_admin_customers_crm(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/customers');
        $response->assertStatus(200);
        $response->assertSee('Customer');

        $custName = 'Test Client ' . rand(100, 999);
        $custPhone = '9829' . rand(100000, 999999);

        $storeResponse = $this->actingAs($this->admin)->post('/admin/customers', [
            'name' => $custName,
            'phone' => $custPhone,
            'type' => 'Retail',
            'status' => 'active',
        ]);
        $storeResponse->assertRedirect();
        $this->assertDatabaseHas('customers', ['phone' => $custPhone]);

        $customer = Customer::where('phone', $custPhone)->first();
        $updateResponse = $this->actingAs($this->admin)->put('/admin/customers/' . $customer->id, [
            'name' => $custName . ' Updated',
            'phone' => $custPhone,
            'type' => 'Corporate',
            'status' => 'active',
        ]);
        $updateResponse->assertRedirect();
        $this->assertEquals($custName . ' Updated', $customer->fresh()->name);
    }

    public function test_admin_suppliers_and_purchases(): void
    {
        // Suppliers Directory
        $supResponse = $this->actingAs($this->admin)->get('/admin/suppliers');
        $supResponse->assertStatus(200);
        $supResponse->assertSee('Suppliers');

        $company = 'National Tech Distro ' . rand(100, 999);
        $phone = '0291-' . rand(100000, 999999);
        $supCreateResponse = $this->actingAs($this->admin)->post('/admin/suppliers', [
            'company' => $company,
            'name' => 'Vikram Sharma',
            'phone' => $phone,
            'payment_terms' => 'Net 15',
            'status' => 'active',
        ]);
        $supCreateResponse->assertRedirect();
        $this->assertDatabaseHas('suppliers', ['company' => $company]);

        $supplier = Supplier::where('company', $company)->first();

        // Purchases Directory
        $purResponse = $this->actingAs($this->admin)->get('/admin/purchases');
        $purResponse->assertStatus(200);
        $purResponse->assertSee('Purchase');

        // Purchase Create Page
        $purCreatePage = $this->actingAs($this->admin)->get('/admin/purchases/create');
        $purCreatePage->assertStatus(200);

        // Store Purchase
        $product = Product::first();
        $purStoreResponse = $this->actingAs($this->admin)->post('/admin/purchases', [
            'supplier_id' => $supplier->id,
            'supplier_invoice_no' => 'INV-SUP-' . rand(1000, 9999),
            'purchase_date' => now()->format('Y-m-d'),
            'payment_status' => 'Paid',
            'items' => [
                [
                    'product_id' => $product?->id,
                    'item_name' => $product?->name ?? 'Hardware Component',
                    'quantity' => 5,
                    'unit_cost' => 5000,
                    'gst_rate' => 18,
                ]
            ],
        ]);
        $purStoreResponse->assertRedirect();

        $purchase = Purchase::latest()->first();
        $purShow = $this->actingAs($this->admin)->get('/admin/purchases/' . $purchase->id);
        $purShow->assertStatus(200);
        $purShow->assertSee($purchase->purchase_no);
    }

    public function test_admin_miscellaneous_pages_render(): void
    {
        // Custom PC Builder ERP
        $pcb = $this->actingAs($this->admin)->get('/admin/pc-builder');
        $pcb->assertStatus(200);
        $pcb->assertSee('Custom Rig Configurator');

        // Payments Ledger
        $payments = $this->actingAs($this->admin)->get('/admin/payments');
        $payments->assertStatus(200);
        $payments->assertSee('Received Payments');

        // Reports & Analytics
        $reports = $this->actingAs($this->admin)->get('/admin/reports');
        $reports->assertStatus(200);
        $reports->assertSee('Analytics & GST Returns', false);

        // Website CMS Management
        $cms = $this->actingAs($this->admin)->get('/admin/website-mgmt');
        $cms->assertStatus(200);
        $cms->assertSee('Storefront Content & SEO', false);

        // Store Settings
        $settings = $this->actingAs($this->admin)->get('/admin/settings');
        $settings->assertStatus(200);
        $settings->assertSee('Company Configuration');
    }

    public function test_legacy_prototype_php_extension_aliases(): void
    {
        $urls = [
            '/admin/dashboard.php',
            '/admin/products.php',
            '/admin/product-add.php',
            '/admin/product-view.php',
            '/admin/laptops.php',
            '/admin/computers.php',
            '/admin/categories.php',
            '/admin/brands.php',
            '/admin/inventory.php',
            '/admin/quotations.php',
            '/admin/quotation-create.php',
            '/admin/quotation-view.php',
            '/admin/quotation-print.php',
            '/admin/customers.php',
            '/admin/sales.php',
            '/admin/invoice-view.php',
            '/admin/suppliers.php',
            '/admin/purchases.php',
            '/admin/payments.php',
            '/admin/reports.php',
            '/admin/pc-builder.php',
            '/admin/website-mgmt.php',
            '/admin/settings.php',
        ];

        foreach ($urls as $url) {
            $response = $this->actingAs($this->admin)->get($url);
            $this->assertEquals(200, $response->status(), "Legacy route {$url} failed to return HTTP 200");
        }
    }
}

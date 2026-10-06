<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Quotation;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class StorefrontPrototypeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (Product::count() === 0) {
            $this->seed(DatabaseSeeder::class);
        }
    }

    public function test_storefront_home_page_renders_with_featured_products(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('HARI OM COMPUTER');
        $response->assertSee('Build Your Dream Computer');
    }

    public function test_storefront_computers_page_renders(): void
    {
        $response = $this->get('/computers');

        $response->assertStatus(200);
        $response->assertSee('Desktop PCs');
    }

    public function test_storefront_laptops_page_renders(): void
    {
        $response = $this->get('/laptops');

        $response->assertStatus(200);
        $response->assertSee('Brand New Laptops');
    }

    public function test_storefront_components_page_renders(): void
    {
        $response = $this->get('/components');

        $response->assertStatus(200);
        $response->assertSee('Genuine Computer Components');
    }

    public function test_storefront_products_catalog_renders_and_filters(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('Products & Hardware Catalog');

        $searchResponse = $this->get('/products?search=Intel');
        $searchResponse->assertStatus(200);
    }

    public function test_storefront_product_details_page_renders(): void
    {
        $product = Product::active()->first();

        $response = $this->get('/product-details' . ($product ? '?id=' . $product->id : ''));
        $response->assertStatus(200);
        if ($product) {
            $response->assertSee($product->name);
        }
    }

    public function test_storefront_pc_builder_tool_renders(): void
    {
        $response = $this->get('/pc-builder');

        $response->assertStatus(200);
        $response->assertSee('Build Your Dream PC');
        $response->assertSee('Custom PC Summary');
    }

    public function test_storefront_enquiry_page_renders(): void
    {
        $response = $this->get('/enquiry');

        $response->assertStatus(200);
        $response->assertSee('Enquiry Cart & GST Quotation Request');
    }

    public function test_storefront_submit_enquiry_creates_quotation_and_redirects(): void
    {
        $product = Product::active()->first();

        $items = [
            [
                'id' => $product ? $product->id : 1,
                'name' => $product ? $product->name : 'Gaming PC Test',
                'sku' => $product ? $product->sku : 'TEST-SKU',
                'price' => 50000,
                'qty' => 1,
            ]
        ];

        $postData = [
            'name' => 'Ramesh Test Kumar',
            'mobile' => '9829012345',
            'email' => 'ramesh.test@example.com',
            'company' => 'Ramesh Technologies',
            'gstin' => '08AABCR1234F1Z3',
            'address' => 'Station Road Jodhpur',
            'notes' => 'Urgent quotation needed for office PC',
            'items' => json_encode($items),
        ];

        $response = $this->post('/enquiry', $postData);

        $response->assertRedirect();
        $this->assertDatabaseHas('quotations', [
            'customer_name' => 'Ramesh Test Kumar',
            'customer_phone' => '9829012345',
        ]);
    }

    public function test_storefront_quotation_success_page_renders(): void
    {
        $quote = Quotation::latest()->first();

        $response = $this->get('/quotation-success' . ($quote ? '?quote=' . $quote->quotation_no : ''));
        $response->assertStatus(200);
        $response->assertSee('Quotation Request Received');
    }

    public function test_storefront_about_page_renders(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('Hari Om Computer');
        $response->assertSee('About');
    }

    public function test_storefront_contact_page_renders(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Contact');
        $response->assertSee('Jodhpur');
    }

    public function test_storefront_product_details_with_route_param(): void
    {
        $product = Product::active()->first();
        if ($product) {
            $response = $this->get('/product-details/' . $product->id);
            $response->assertStatus(200);
            $response->assertSee($product->name);
        }
    }

    public function test_storefront_quotation_success_fallback(): void
    {
        $response = $this->get('/quotation-success');
        $response->assertStatus(200);
        $response->assertSee('Quotation Request Received');
    }

    public function test_legacy_storefront_php_extension_aliases(): void
    {
        $urls = [
            '/index.php',
            '/computers.php',
            '/laptops.php',
            '/components.php',
            '/products.php',
            '/product-details.php',
            '/pc-builder.php',
            '/enquiry.php',
            '/quotation-success.php',
            '/about.php',
            '/contact.php',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $this->assertEquals(200, $response->status(), "Legacy storefront route {$url} failed to return HTTP 200");
        }
    }
}

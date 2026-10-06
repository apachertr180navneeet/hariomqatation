<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HardwareCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Brands
        $brandsData = [
            ['name' => 'Dell', 'status' => 'active'],
            ['name' => 'HP', 'status' => 'active'],
            ['name' => 'Lenovo', 'status' => 'active'],
            ['name' => 'ASUS', 'status' => 'active'],
            ['name' => 'Intel', 'status' => 'active'],
            ['name' => 'AMD', 'status' => 'active'],
            ['name' => 'NVIDIA', 'status' => 'active'],
            ['name' => 'Gigabyte', 'status' => 'active'],
            ['name' => 'Corsair', 'status' => 'active'],
            ['name' => 'Kingston', 'status' => 'active'],
            ['name' => 'Samsung', 'status' => 'active'],
            ['name' => 'Logitech', 'status' => 'active'],
        ];

        $brandMap = [];
        foreach ($brandsData as $b) {
            $brand = Brand::firstOrCreate(
                ['slug' => Str::slug($b['name'])],
                ['name' => $b['name'], 'status' => $b['status']]
            );
            $brandMap[$b['name']] = $brand->id;
        }

        // 2. Categories & Subcategories
        $categoriesData = [
            [
                'name' => 'Laptops',
                'icon' => 'bi-laptop',
                'subs' => ['Business Laptop', 'Gaming Laptop', 'Student Laptop', 'Ultrabook']
            ],
            [
                'name' => 'Desktop Computers',
                'icon' => 'bi-pc-display',
                'subs' => ['Office PC', 'Gaming PC', 'Workstation Rig']
            ],
            [
                'name' => 'Components',
                'icon' => 'bi-cpu',
                'subs' => ['Processor', 'Motherboard', 'RAM', 'SSD', 'Graphics Card', 'SMPS/PSU', 'Cabinet']
            ],
            [
                'name' => 'Display & Monitors',
                'icon' => 'bi-display',
                'subs' => ['Gaming Monitor', 'LED Monitor', '4K Professional Monitor']
            ],
            [
                'name' => 'Accessories',
                'icon' => 'bi-keyboard',
                'subs' => ['Keyboard & Mouse', 'Headphones', 'UPS']
            ],
        ];

        $catMap = [];
        $subMap = [];
        foreach ($categoriesData as $c) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($c['name'])],
                ['name' => $c['name'], 'icon' => $c['icon'], 'status' => 'active']
            );
            $catMap[$c['name']] = $category->id;

            foreach ($c['subs'] as $subName) {
                $sub = Subcategory::firstOrCreate(
                    ['category_id' => $category->id, 'slug' => Str::slug($subName)],
                    ['name' => $subName, 'status' => 'active']
                );
                $subMap[$c['name'] . '_' . $subName] = $sub->id;
            }
        }

        // 3. Hardware Products
        $products = [
            [
                'name' => 'Dell Inspiron 15 3520 Laptop',
                'sku' => 'DELL-INSP-3520',
                'cat' => 'Laptops',
                'sub' => 'Student Laptop',
                'brand' => 'Dell',
                'specs' => 'Intel Core i5 12th Gen | 16GB DDR4 RAM | 512GB NVMe SSD | 15.6" FHD 120Hz | Win 11',
                'purchase_price' => 42000,
                'selling_price' => 47990,
                'mrp' => 58990,
                'stock' => 14,
                'warranty' => '1 Year Onsite Warranty',
                'is_featured' => true,
            ],
            [
                'name' => 'HP Pavilion 15 (2025 Edition)',
                'sku' => 'HP-PAV-15-EG',
                'cat' => 'Laptops',
                'sub' => 'Business Laptop',
                'brand' => 'HP',
                'specs' => 'Intel Core i7 13th Gen 1355U | 16GB DDR4 | 1TB NVMe SSD | Iris Xe | 15.6" FHD IPS',
                'purchase_price' => 61000,
                'selling_price' => 68490,
                'mrp' => 79990,
                'stock' => 9,
                'warranty' => '1 Year Onsite Warranty',
                'is_featured' => true,
            ],
            [
                'name' => 'ASUS ROG Strix G16 Gaming Laptop',
                'sku' => 'ROG-G16-RTX4060',
                'cat' => 'Laptops',
                'sub' => 'Gaming Laptop',
                'brand' => 'ASUS',
                'specs' => 'Intel Core i7 13650HX | 16GB DDR5 4800MHz | 1TB Gen4 SSD | NVIDIA RTX 4060 8GB | 165Hz',
                'purchase_price' => 104000,
                'selling_price' => 114990,
                'mrp' => 134990,
                'stock' => 5,
                'warranty' => '1 Year International Warranty',
                'is_featured' => true,
            ],
            [
                'name' => 'Intel Core i7-14700K Desktop Processor',
                'sku' => 'CPU-INTEL-14700K',
                'cat' => 'Components',
                'sub' => 'Processor',
                'brand' => 'Intel',
                'specs' => '20 Cores (8P + 12E), 28 Threads | Up to 5.6 GHz Turbo | LGA1700 | Intel UHD 770',
                'purchase_price' => 36000,
                'selling_price' => 39490,
                'mrp' => 44990,
                'stock' => 12,
                'warranty' => '3 Years Manufacturer Warranty',
                'is_featured' => true,
                'socket' => 'LGA1700',
                'wattage_req' => 253,
                'pcb_type' => 'cpu',
            ],
            [
                'name' => 'AMD Ryzen 7 7800X3D Gaming Processor',
                'sku' => 'CPU-AMD-7800X3D',
                'cat' => 'Components',
                'sub' => 'Processor',
                'brand' => 'AMD',
                'specs' => '8 Cores, 16 Threads | 5.0 GHz Max Boost | 104MB Cache with 3D V-Cache | AM5',
                'purchase_price' => 38000,
                'selling_price' => 41990,
                'mrp' => 48990,
                'stock' => 8,
                'warranty' => '3 Years Manufacturer Warranty',
                'is_featured' => true,
                'socket' => 'AM5',
                'wattage_req' => 120,
                'pcb_type' => 'cpu',
            ],
            [
                'name' => 'Gigabyte GeForce RTX 4070 Super Eagle OC 12GB',
                'sku' => 'GPU-RTX4070S-GB',
                'cat' => 'Components',
                'sub' => 'Graphics Card',
                'brand' => 'Gigabyte',
                'specs' => '12GB GDDR6X 192-bit | WINDFORCE 3X Cooling System | DLSS 3 | DisplayPort 1.4a x 3, HDMI 2.1a',
                'purchase_price' => 56500,
                'selling_price' => 61990,
                'mrp' => 72000,
                'stock' => 7,
                'warranty' => '3 Years Brand Warranty',
                'is_featured' => true,
                'wattage_req' => 220,
                'pcb_type' => 'gpu',
            ],
            [
                'name' => 'Corsair Vengeance RGB 32GB (16GBx2) DDR5 6000MHz',
                'sku' => 'RAM-COR-DDR5-32GB',
                'cat' => 'Components',
                'sub' => 'RAM',
                'brand' => 'Corsair',
                'specs' => '32GB Kit (2x16GB) | DDR5 6000MHz CL36 | Intel XMP 3.0 & AMD EXPO | Dynamic Ten-Zone RGB',
                'purchase_price' => 9200,
                'selling_price' => 10490,
                'mrp' => 13500,
                'stock' => 18,
                'warranty' => '10 Years Limited Lifetime Warranty',
                'is_featured' => true,
                'ram_type' => 'DDR5',
                'pcb_type' => 'ram',
            ],
            [
                'name' => 'Samsung 990 PRO 1TB PCIe 4.0 NVMe M.2 SSD',
                'sku' => 'SSD-SAM-990PRO-1TB',
                'cat' => 'Components',
                'sub' => 'SSD',
                'brand' => 'Samsung',
                'specs' => 'Up to 7,450 MB/s Read, 6,900 MB/s Write | V-NAND TLC | PCIe 4.0 x4, NVMe 2.0 | 600 TBW',
                'purchase_price' => 8800,
                'selling_price' => 9990,
                'mrp' => 13999,
                'stock' => 22,
                'warranty' => '5 Years Brand Warranty',
                'is_featured' => true,
                'pcb_type' => 'storage',
            ],
            [
                'name' => 'Hari Om "Apex Pro" Core i7 RTX 4070 Custom Rig',
                'sku' => 'RIG-APEX-I7-4070',
                'cat' => 'Desktop Computers',
                'sub' => 'Gaming PC',
                'brand' => 'Intel',
                'specs' => 'Intel Core i7 14700K | RTX 4070 Super 12GB | 32GB DDR5 6000MHz | 1TB Gen4 NVMe | 360mm AIO Cooler | 750W 80+ Gold PSU | Lian Li Glass Case',
                'purchase_price' => 138000,
                'selling_price' => 154990,
                'mrp' => 179990,
                'stock' => 3,
                'warranty' => '2 Years In-House Hardware Warranty',
                'is_featured' => true,
            ]
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['sku' => $p['sku']],
                [
                    'name' => $p['name'],
                    'slug' => Str::slug($p['name'] . '-' . $p['sku']),
                    'category_id' => $catMap[$p['cat']] ?? 1,
                    'subcategory_id' => $subMap[$p['cat'] . '_' . $p['sub']] ?? null,
                    'brand_id' => $brandMap[$p['brand']] ?? null,
                    'specs' => $p['specs'],
                    'purchase_price' => $p['purchase_price'],
                    'selling_price' => $p['selling_price'],
                    'mrp' => $p['mrp'],
                    'gst_rate' => 18.00,
                    'stock' => $p['stock'],
                    'min_stock' => 3,
                    'warranty' => $p['warranty'],
                    'status' => 'active',
                    'is_featured' => $p['is_featured'] ?? false,
                    'socket' => $p['socket'] ?? null,
                    'ram_type' => $p['ram_type'] ?? null,
                    'wattage_req' => $p['wattage_req'] ?? null,
                    'pcb_type' => $p['pcb_type'] ?? null,
                ]
            );
        }

        // 4. Sample Commercial Quotation
        $sampleProd = Product::first();
        if ($sampleProd) {
            $quote = \App\Models\Quotation::firstOrCreate(
                ['quotation_no' => 'HOC/QTN/2026/0001'],
                [
                    'customer_name' => 'Vikram Rathore',
                    'customer_company' => 'Rathore Infotech Pvt Ltd',
                    'customer_phone' => '9829012345',
                    'customer_email' => 'vikram@example.com',
                    'customer_gstin' => '08AABCR1234F1Z3',
                    'customer_address' => 'Plot 14, Light Industrial Area, Jodhpur',
                    'quotation_date' => now()->toDateString(),
                    'valid_until' => now()->addDays(15)->toDateString(),
                    'status' => 'Pending',
                    'subtotal' => 40669.49,
                    'discount_total' => 0,
                    'taxable_amount' => 40669.49,
                    'gst_total' => 7320.51,
                    'round_off' => 0,
                    'grand_total' => 47990,
                    'notes' => 'Free delivery and setup agreed.',
                    'created_by' => 1,
                ]
            );

            if ($quote->items()->count() === 0) {
                $quote->items()->create([
                    'product_id' => $sampleProd->id,
                    'item_name' => $sampleProd->name,
                    'sku' => $sampleProd->sku,
                    'quantity' => 1,
                    'unit_rate' => 40669.49,
                    'discount' => 0,
                    'gst_rate' => 18,
                    'gst_amount' => 7320.51,
                    'total_amount' => 47990,
                ]);
            }
        }
    }
}

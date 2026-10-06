<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerAndSalesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $products = Product::take(4)->get();

        // 1. Customers
        $customersData = [
            [
                'name' => 'Vikram Rathore',
                'company' => 'Rathore Architect & Associates',
                'phone' => '+91 98290 12345',
                'email' => 'vikram@rathorearch.com',
                'gstin' => '08AABCR1234M1Z2',
                'address' => '402 High-Tech Tower, Paota C Road, Jodhpur - 342006',
                'city' => 'Jodhpur',
                'type' => 'Corporate',
                'status' => 'active',
            ],
            [
                'name' => 'Pooja Choudhary',
                'company' => 'Sun City Creatives Studio',
                'phone' => '+91 94140 67890',
                'email' => 'pooja@suncitycreatives.in',
                'gstin' => '08AAECS5678N1Z4',
                'address' => '12 Residency Road, Sardarpura, Jodhpur - 342003',
                'city' => 'Jodhpur',
                'type' => 'Corporate',
                'status' => 'active',
            ],
            [
                'name' => 'Amit Sharma',
                'company' => null,
                'phone' => '+91 98281 99887',
                'email' => 'amit.sharma99@gmail.com',
                'gstin' => null,
                'address' => 'Plot 88, BJS Colony, Jodhpur - 342010',
                'city' => 'Jodhpur',
                'type' => 'Retail',
                'status' => 'active',
            ],
            [
                'name' => 'Dr. K. L. Gehlot',
                'company' => 'Gehlot Diagnostics & Imaging Center',
                'phone' => '+91 94141 33221',
                'email' => 'admin@gehlotdiagnostics.com',
                'gstin' => '08AABCG4433P1Z9',
                'address' => 'Near MG Hospital, Station Road, Jodhpur - 342001',
                'city' => 'Jodhpur',
                'type' => 'Institutional',
                'status' => 'active',
            ],
        ];

        $savedCustomers = [];
        foreach ($customersData as $cData) {
            $customer = Customer::firstOrCreate(['phone' => $cData['phone']], $cData);
            $savedCustomers[] = $customer;
        }

        // 2. Quotations (if less than 3 exist)
        if (Quotation::count() < 3 && $products->isNotEmpty()) {
            // Quotation 1: Approved
            $q1 = Quotation::create([
                'quotation_no' => Quotation::generateNextQuotationNumber(),
                'customer_name' => $savedCustomers[0]->name,
                'customer_phone' => $savedCustomers[0]->phone,
                'customer_email' => $savedCustomers[0]->email,
                'customer_company' => $savedCustomers[0]->company,
                'customer_gstin' => $savedCustomers[0]->gstin,
                'customer_address' => $savedCustomers[0]->address,
                'status' => 'Approved',
                'valid_until' => now()->addDays(15),
                'subtotal' => 45000.00,
                'discount_total' => 0.00,
                'taxable_amount' => 45000.00,
                'gst_total' => 8100.00,
                'round_off' => 0.00,
                'grand_total' => 53100.00,
                'notes' => 'Commercial workstation proposal with 3-year on-site warranty',
                'created_by' => $admin?->id,
            ]);

            $p1 = $products[0];
            $q1->items()->create([
                'product_id' => $p1->id,
                'item_name' => $p1->name,
                'sku' => $p1->sku,
                'quantity' => 1,
                'unit_rate' => 45000.00,
                'discount' => 0.00,
                'gst_rate' => 18.00,
                'gst_amount' => 8100.00,
                'total_amount' => 53100.00,
            ]);

            // Quotation 2: Pending
            $q2 = Quotation::create([
                'quotation_no' => Quotation::generateNextQuotationNumber(),
                'customer_name' => $savedCustomers[1]->name,
                'customer_phone' => $savedCustomers[1]->phone,
                'customer_email' => $savedCustomers[1]->email,
                'customer_company' => $savedCustomers[1]->company,
                'customer_gstin' => $savedCustomers[1]->gstin,
                'customer_address' => $savedCustomers[1]->address,
                'status' => 'Pending',
                'valid_until' => now()->addDays(10),
                'subtotal' => 65000.00,
                'discount_total' => 1000.00,
                'taxable_amount' => 64000.00,
                'gst_total' => 11520.00,
                'round_off' => 0.00,
                'grand_total' => 75520.00,
                'notes' => 'Video editing studio workstation proposal',
                'created_by' => $admin?->id,
            ]);

            $p2 = $products[1] ?? $p1;
            $q2->items()->create([
                'product_id' => $p2->id,
                'item_name' => $p2->name,
                'sku' => $p2->sku,
                'quantity' => 1,
                'unit_rate' => 64000.00,
                'discount' => 1000.00,
                'gst_rate' => 18.00,
                'gst_amount' => 11520.00,
                'total_amount' => 75520.00,
            ]);
        }

        // 3. Invoices (if less than 2 exist)
        if (Invoice::count() < 2 && $products->isNotEmpty()) {
            $invNo = Invoice::generateNextInvoiceNumber();
            $cust = $savedCustomers[0];
            $prod = $products[0];

            $inv = Invoice::create([
                'invoice_no' => $invNo,
                'customer_id' => $cust->id,
                'customer_name' => $cust->name,
                'customer_company' => $cust->company,
                'customer_phone' => $cust->phone,
                'customer_email' => $cust->email,
                'customer_gstin' => $cust->gstin,
                'customer_address' => $cust->address,
                'invoice_date' => now()->subDays(2),
                'due_date' => now()->addDays(5),
                'payment_mode' => 'Bank Transfer',
                'payment_status' => 'Paid',
                'status' => 'Issued',
                'subtotal' => 45000.00,
                'discount_total' => 0.00,
                'taxable_amount' => 45000.00,
                'cgst_amount' => 4050.00,
                'sgst_amount' => 4050.00,
                'gst_total' => 8100.00,
                'round_off' => 0.00,
                'grand_total' => 53100.00,
                'paid_amount' => 53100.00,
                'balance_amount' => 0.00,
                'notes' => 'Official GST Tax Invoice - Delivered via showroom',
                'created_by' => $admin?->id,
            ]);

            $inv->items()->create([
                'product_id' => $prod->id,
                'item_name' => $prod->name,
                'sku' => $prod->sku,
                'quantity' => 1,
                'unit_rate' => 45000.00,
                'discount' => 0.00,
                'gst_rate' => 18.00,
                'gst_amount' => 8100.00,
                'total_amount' => 53100.00,
            ]);
        }
    }
}

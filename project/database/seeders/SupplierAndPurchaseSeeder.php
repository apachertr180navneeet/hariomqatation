<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class SupplierAndPurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $suppliersData = [
            [
                'name' => 'Rajesh Sharma',
                'company' => 'Savex Technologies Pvt Ltd',
                'phone' => '+91 98200 11223',
                'email' => 'orders.west@savex.org',
                'gstin' => '27AAACS1429B1ZX',
                'address' => 'Plot 45, MIDC Industrial Area, Andheri East',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'payment_terms' => 'Net 30',
                'bank_details' => 'HDFC Bank, A/C: 50200012345678, IFSC: HDFC0000060',
                'opening_balance' => 0.00,
                'status' => 'active',
            ],
            [
                'name' => 'K. Venkatraman',
                'company' => 'Redington India Ltd',
                'phone' => '+91 94440 55667',
                'email' => 'commercial@redington.co.in',
                'gstin' => '33AAACR2891J1ZT',
                'address' => 'Redington House, Centre Point, Guindy',
                'city' => 'Chennai',
                'state' => 'Tamil Nadu',
                'payment_terms' => 'Net 15',
                'bank_details' => 'ICICI Bank, A/C: 000405001234, IFSC: ICIC0000004',
                'opening_balance' => 0.00,
                'status' => 'active',
            ],
            [
                'name' => 'Anil Deshmukh',
                'company' => 'Ingram Micro India Pvt Ltd',
                'phone' => '+91 98211 88990',
                'email' => 'sales.india@ingrammicro.com',
                'gstin' => '27AAACI3472L1ZG',
                'address' => 'Godrej Eternia, C Wing, Shivajinagar',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'payment_terms' => 'Net 30',
                'bank_details' => 'Standard Chartered Bank, A/C: 2220501199, IFSC: SCBL0036001',
                'opening_balance' => 0.00,
                'status' => 'active',
            ],
            [
                'name' => 'Pradeep Khemka',
                'company' => 'Supertron Electronics Pvt Ltd',
                'phone' => '+91 98300 44332',
                'email' => 'gujarat.sales@supertronindia.com',
                'gstin' => '19AAACS6340K1ZM',
                'address' => 'Supertron House, 2 Cooper Lane',
                'city' => 'Kolkata',
                'state' => 'West Bengal',
                'payment_terms' => 'Immediate',
                'bank_details' => 'State Bank of India, A/C: 31005544221, IFSC: SBIN0000001',
                'opening_balance' => 0.00,
                'status' => 'active',
            ],
        ];

        foreach ($suppliersData as $sData) {
            $supplier = Supplier::firstOrCreate(['gstin' => $sData['gstin']], $sData);
        }

        // Create sample purchase inward if none exist
        if (Purchase::count() === 0) {
            $savex = Supplier::where('company', 'like', '%Savex%')->first();
            $products = Product::take(2)->get();

            if ($savex && $products->isNotEmpty()) {
                $purchaseNo = Purchase::generateNextPurchaseNumber();
                $subtotal = 0;
                $taxable = 0;
                $gstTotal = 0;

                $itemsToCreate = [];
                foreach ($products as $p) {
                    $qty = 5;
                    $unitCost = $p->purchase_price ?: round($p->price * 0.82, 2);
                    $lineTotal = round($unitCost * $qty, 2);
                    $lineGst = round($lineTotal * 0.18, 2);
                    $lineGrand = $lineTotal + $lineGst;

                    $taxable += $lineTotal;
                    $gstTotal += $lineGst;

                    $itemsToCreate[] = [
                        'product' => $p,
                        'name' => $p->name,
                        'sku' => $p->sku,
                        'qty' => $qty,
                        'unit_cost' => $unitCost,
                        'gst_rate' => 18.00,
                        'gst_amount' => $lineGst,
                        'total_amount' => $lineGrand,
                    ];
                }

                $grandTotal = $taxable + $gstTotal;

                $purchase = Purchase::create([
                    'purchase_no' => $purchaseNo,
                    'supplier_id' => $savex->id,
                    'supplier_invoice_no' => 'SVX/INW/2026/9821',
                    'purchase_date' => now()->subDays(5),
                    'due_date' => now()->addDays(25),
                    'payment_status' => 'Paid',
                    'status' => 'Received',
                    'subtotal' => $taxable,
                    'discount_total' => 0.00,
                    'taxable_amount' => $taxable,
                    'cgst_amount' => round($gstTotal / 2, 2),
                    'sgst_amount' => round($gstTotal / 2, 2),
                    'gst_total' => $gstTotal,
                    'grand_total' => $grandTotal,
                    'paid_amount' => $grandTotal,
                    'balance_amount' => 0.00,
                    'notes' => 'Q3 Stock Replenishment for Western Hub',
                    'created_by' => $admin?->id,
                ]);

                foreach ($itemsToCreate as $item) {
                    $purchase->items()->create([
                        'product_id' => $item['product']->id,
                        'item_name' => $item['name'],
                        'sku' => $item['sku'],
                        'quantity' => $item['qty'],
                        'unit_cost' => $item['unit_cost'],
                        'gst_rate' => $item['gst_rate'],
                        'gst_amount' => $item['gst_amount'],
                        'total_amount' => $item['total_amount'],
                    ]);

                    // Add inward movement
                    StockMovement::create([
                        'product_id' => $item['product']->id,
                        'type' => 'inward',
                        'quantity' => $item['qty'],
                        'balance_after' => $item['product']->stock + $item['qty'],
                        'unit_cost' => $item['unit_cost'],
                        'reference_no' => $purchaseNo,
                        'notes' => "Supplier Inward: {$savex->company} (Inv: SVX/INW/2026/9821)",
                        'user_id' => $admin?->id,
                    ]);

                    $item['product']->increment('stock', $item['qty']);
                }
            }
        }
    }
}

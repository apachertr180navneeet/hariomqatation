<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalesController extends Controller
{
    /**
     * Display a listing of sales orders and GST tax invoices.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'ALL');
        $search = $request->query('search');

        $query = Invoice::with(['items', 'customer'])->latest();

        if ($status && $status !== 'ALL') {
            $query->where('payment_status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_no', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_company', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('customer_gstin', 'like', "%{$search}%");
            });
        }

        $invoices = $query->paginate(15)->withQueryString();

        // Financial KPI Metrics
        $totalInvoiced = Invoice::where('status', 'Issued')->sum('grand_total');
        $totalCollected = Invoice::where('status', 'Issued')->sum('paid_amount');
        $totalOutstanding = Invoice::where('status', 'Issued')->sum('balance_amount');
        $paidInvoicesCount = Invoice::where('payment_status', 'Paid')->count();
        $totalInvoicesCount = Invoice::count();

        return view('admin.sales.index', [
            'pageTitle' => 'Sales Orders & Invoices | Hari Om Computer ERP',
            'currentPage' => 'sales',
            'invoices' => $invoices,
            'totalInvoiced' => $totalInvoiced,
            'totalCollected' => $totalCollected,
            'totalOutstanding' => $totalOutstanding,
            'paidInvoicesCount' => $paidInvoicesCount,
            'totalInvoicesCount' => $totalInvoicesCount,
            'currentStatus' => $status,
            'search' => $search,
        ]);
    }

    /**
     * Printable A4 GST Tax Invoice view.
     */
    public function invoice(Request $request, $id = null): View
    {
        $invoiceId = $id ?: $request->query('id');
        $invoice = null;

        if ($invoiceId) {
            $invoice = is_numeric($invoiceId)
                ? Invoice::with(['items.product', 'customer', 'creator', 'quotation'])->find($invoiceId)
                : Invoice::with(['items.product', 'customer', 'creator', 'quotation'])->where('invoice_no', $invoiceId)->first();
        }

        if (!$invoice) {
            $invoice = Invoice::with(['items.product', 'customer', 'creator', 'quotation'])->latest()->firstOrFail();
        }

        return view('admin.sales.invoice', [
            'pageTitle' => "GST Tax Invoice {$invoice->invoice_no} | Hari Om Computer",
            'currentPage' => 'sales',
            'invoice' => $invoice,
        ]);
    }

    /**
     * One-Click Conversion: Turn an Approved Quotation into an Official GST Tax Invoice.
     */
    public function convertFromQuotation($quotationId): RedirectResponse
    {
        $quotation = is_numeric($quotationId)
            ? Quotation::with('items')->findOrFail($quotationId)
            : Quotation::with('items')->where('quotation_no', $quotationId)->firstOrFail();

        // Check if invoice already exists for this quotation
        $existingInvoice = Invoice::where('quotation_id', $quotation->id)->first();
        if ($existingInvoice) {
            return redirect()->route('admin.invoices.view', ['id' => $existingInvoice->id])
                ->with('info', "Tax invoice {$existingInvoice->invoice_no} already exists for this quotation.");
        }

        DB::beginTransaction();
        try {
            // Find or create customer
            $customer = Customer::firstOrCreate(
                ['phone' => $quotation->customer_phone],
                [
                    'name' => $quotation->customer_name,
                    'company' => $quotation->customer_company,
                    'email' => $quotation->customer_email,
                    'gstin' => $quotation->customer_gstin,
                    'address' => $quotation->customer_address,
                    'type' => !empty($quotation->customer_gstin) ? 'Corporate' : 'Retail',
                    'status' => 'active',
                ]
            );

            $invoiceNo = Invoice::generateNextInvoiceNumber();
            $cgst = round($quotation->gst_total / 2, 2);
            $sgst = round($quotation->gst_total - $cgst, 2);

            $invoice = Invoice::create([
                'invoice_no' => $invoiceNo,
                'quotation_id' => $quotation->id,
                'customer_id' => $customer->id,
                'customer_name' => $quotation->customer_name,
                'customer_company' => $quotation->customer_company,
                'customer_phone' => $quotation->customer_phone,
                'customer_email' => $quotation->customer_email,
                'customer_gstin' => $quotation->customer_gstin,
                'customer_address' => $quotation->customer_address,
                'invoice_date' => now(),
                'due_date' => now()->addDays(7),
                'payment_mode' => 'UPI',
                'payment_status' => 'Paid',
                'status' => 'Issued',
                'subtotal' => $quotation->subtotal,
                'discount_total' => $quotation->discount_total,
                'taxable_amount' => $quotation->taxable_amount,
                'cgst_amount' => $cgst,
                'sgst_amount' => $sgst,
                'gst_total' => $quotation->gst_total,
                'round_off' => $quotation->round_off,
                'grand_total' => $quotation->grand_total,
                'paid_amount' => $quotation->grand_total,
                'balance_amount' => 0.00,
                'notes' => "Generated from Quotation {$quotation->quotation_no}. " . ($quotation->notes ?: ''),
                'created_by' => Auth::id(),
            ]);

            // Copy line items and deduct inventory
            foreach ($quotation->items as $qItem) {
                $unitRate = $qItem->unit_rate ?? $qItem->unit_price ?? 0;
                $sku = $qItem->sku ?? $qItem->item_sku ?? null;
                $discount = $qItem->discount ?? 0;

                $invoice->items()->create([
                    'product_id' => $qItem->product_id,
                    'item_name' => $qItem->item_name,
                    'sku' => $sku,
                    'quantity' => $qItem->quantity,
                    'unit_rate' => $unitRate,
                    'discount' => $discount,
                    'gst_rate' => $qItem->gst_rate ?? 18.00,
                    'gst_amount' => $qItem->gst_amount ?? 0,
                    'total_amount' => $qItem->total_amount,
                ]);

                // Inventory Stock Deduction
                if ($qItem->product_id) {
                    $product = Product::find($qItem->product_id);
                    if ($product) {
                        $prevStock = $product->stock;
                        $newStock = max(0, $prevStock - $qItem->quantity);
                        $product->update(['stock' => $newStock]);

                        StockMovement::create([
                            'product_id' => $product->id,
                            'type' => 'outward',
                            'quantity' => $qItem->quantity,
                            'balance_after' => $newStock,
                            'unit_cost' => $product->purchase_price,
                            'reference_no' => $invoiceNo,
                            'notes' => "Invoice sales delivery: {$invoiceNo}",
                            'user_id' => Auth::id(),
                        ]);
                    }
                }
            }

            // Mark Quotation as Converted
            $quotation->update(['status' => 'Converted']);

            DB::commit();

            return redirect()->route('admin.invoices.view', ['id' => $invoice->id])
                ->with('success', "Quotation {$quotation->quotation_no} successfully converted to GST Tax Invoice {$invoiceNo}!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', "Failed to convert quotation to invoice: {$e->getMessage()}");
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    /**
     * Display a listing of inward purchases and vendor invoices.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'ALL');
        $search = $request->query('search');

        $query = Purchase::with(['supplier', 'items'])->latest();

        if ($status && $status !== 'ALL') {
            $query->where('payment_status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('purchase_no', 'like', "%{$search}%")
                  ->orWhere('supplier_invoice_no', 'like', "%{$search}%")
                  ->orWhereHas('supplier', function ($sq) use ($search) {
                      $sq->where('company', 'like', "%{$search}%")
                         ->orWhere('name', 'like', "%{$search}%")
                         ->orWhere('gstin', 'like', "%{$search}%");
                  });
            });
        }

        $purchases = $query->paginate(15)->withQueryString();

        // Inward Purchasing KPI Metrics
        $totalPurchased = Purchase::where('status', 'Received')->sum('grand_total');
        $totalPaid = Purchase::where('status', 'Received')->sum('paid_amount');
        $totalOutstanding = Purchase::where('status', 'Received')->sum('balance_amount');
        $totalInputGst = Purchase::where('status', 'Received')->sum('gst_total');
        $totalPurchasesCount = Purchase::count();

        return view('admin.purchases.index', [
            'pageTitle' => 'Distributor Inwards & Purchases | Hari Om Computer ERP',
            'currentPage' => 'purchases',
            'purchases' => $purchases,
            'totalPurchased' => $totalPurchased,
            'totalPaid' => $totalPaid,
            'totalOutstanding' => $totalOutstanding,
            'totalInputGst' => $totalInputGst,
            'totalPurchasesCount' => $totalPurchasesCount,
            'currentStatus' => $status,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new inward purchase bill.
     */
    public function create(): View
    {
        $suppliers = Supplier::where('status', 'active')->orderBy('company')->get();
        $products = Product::where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name', 'sku', 'selling_price', 'purchase_price', 'stock']);
        $nextPurchaseNo = Purchase::generateNextPurchaseNumber();

        return view('admin.purchases.create', [
            'pageTitle' => 'Record Inward Purchase Bill | Hari Om Computer ERP',
            'currentPage' => 'purchases',
            'suppliers' => $suppliers,
            'products' => $products,
            'nextPurchaseNo' => $nextPurchaseNo,
        ]);
    }

    /**
     * Store a newly created inward purchase in storage and synchronize stock.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'supplier_invoice_no' => 'required|string|max:100',
            'purchase_date' => 'required|date',
            'due_date' => 'nullable|date',
            'payment_status' => 'required|in:Paid,Partial,Unpaid',
            'paid_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.sku' => 'nullable|string|max:100',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_cost' => 'required|numeric|min:0',
            'items.*.gst_rate' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $purchaseNo = Purchase::generateNextPurchaseNumber();
            $supplier = Supplier::findOrFail($validated['supplier_id']);

            $subtotal = 0;
            $taxableAmount = 0;
            $gstTotal = 0;
            $itemsCalculated = [];

            foreach ($validated['items'] as $rawItem) {
                $qty = (int) $rawItem['quantity'];
                $unitCost = (float) $rawItem['unit_cost'];
                $gstRate = isset($rawItem['gst_rate']) ? (float) $rawItem['gst_rate'] : 18.00;

                $lineTaxable = round($qty * $unitCost, 2);
                $lineGst = round($lineTaxable * ($gstRate / 100), 2);
                $lineTotal = round($lineTaxable + $lineGst, 2);

                $subtotal += $lineTaxable;
                $taxableAmount += $lineTaxable;
                $gstTotal += $lineGst;

                $itemsCalculated[] = [
                    'product_id' => $rawItem['product_id'] ?? null,
                    'item_name' => $rawItem['item_name'],
                    'sku' => $rawItem['sku'] ?? null,
                    'hsn_code' => $rawItem['hsn_code'] ?? '8471',
                    'quantity' => $qty,
                    'unit_cost' => $unitCost,
                    'gst_rate' => $gstRate,
                    'gst_amount' => $lineGst,
                    'total_amount' => $lineTotal,
                ];
            }

            $grandTotal = $taxableAmount + $gstTotal;
            $cgst = round($gstTotal / 2, 2);
            $sgst = round($gstTotal - $cgst, 2);

            $paidAmount = (float) ($validated['paid_amount'] ?? 0);
            if ($validated['payment_status'] === 'Paid') {
                $paidAmount = $grandTotal;
            } elseif ($validated['payment_status'] === 'Unpaid') {
                $paidAmount = 0;
            }

            $balanceAmount = max(0, round($grandTotal - $paidAmount, 2));

            $purchase = Purchase::create([
                'purchase_no' => $purchaseNo,
                'supplier_id' => $supplier->id,
                'supplier_invoice_no' => $validated['supplier_invoice_no'],
                'purchase_date' => $validated['purchase_date'],
                'due_date' => $validated['due_date'] ?? null,
                'payment_status' => $validated['payment_status'],
                'status' => 'Received',
                'subtotal' => $subtotal,
                'discount_total' => 0.00,
                'taxable_amount' => $taxableAmount,
                'cgst_amount' => $cgst,
                'sgst_amount' => $sgst,
                'gst_total' => $gstTotal,
                'grand_total' => $grandTotal,
                'paid_amount' => $paidAmount,
                'balance_amount' => $balanceAmount,
                'notes' => $validated['notes'] ?? null,
                'created_by' => Auth::id(),
            ]);

            // Save items and update product stock & inventory ledger
            foreach ($itemsCalculated as $calcItem) {
                $purchase->items()->create($calcItem);

                if (!empty($calcItem['product_id'])) {
                    $product = Product::find($calcItem['product_id']);
                    if ($product) {
                        $prevStock = $product->stock;
                        $newStock = $prevStock + $calcItem['quantity'];

                        $product->update([
                            'stock' => $newStock,
                            'purchase_price' => $calcItem['unit_cost'],
                        ]);

                        StockMovement::create([
                            'product_id' => $product->id,
                            'type' => 'inward',
                            'quantity' => $calcItem['quantity'],
                            'balance_after' => $newStock,
                            'unit_cost' => $calcItem['unit_cost'],
                            'reference_no' => $purchaseNo,
                            'notes' => "Inward stock from {$supplier->company} (Bill #{$validated['supplier_invoice_no']})",
                            'user_id' => Auth::id(),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.purchases.show', $purchase->id)
                ->with('success', "Inward bill {$purchaseNo} from {$supplier->company} recorded successfully! Inventory has been updated.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', "Failed to record inward purchase: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified purchase bill receipt.
     */
    public function show($id): View
    {
        $purchase = is_numeric($id)
            ? Purchase::with(['supplier', 'items.product', 'creator'])->findOrFail($id)
            : Purchase::with(['supplier', 'items.product', 'creator'])->where('purchase_no', $id)->firstOrFail();

        return view('admin.purchases.show', [
            'pageTitle' => "Purchase Bill {$purchase->purchase_no} | Hari Om Computer",
            'currentPage' => 'purchases',
            'purchase' => $purchase,
        ]);
    }
}

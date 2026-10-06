<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuotationController extends Controller
{
    /**
     * Display a listing of quotations with filtering and search.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'ALL');
        $search = $request->query('search');

        $query = Quotation::withCount('items')->latest();

        if ($status && $status !== 'ALL') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('quotation_no', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_company', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $quotations = $query->paginate(15)->withQueryString();

        // Metrics for summary KPIs
        $metrics = [
            'total' => Quotation::count(),
            'pending' => Quotation::whereIn('status', ['Pending', 'Draft'])->count(),
            'approved' => Quotation::where('status', 'Approved')->count(),
            'converted' => Quotation::where('status', 'Converted')->count(),
            'total_value' => Quotation::where('status', '!=', 'Rejected')->sum('grand_total'),
        ];

        return view('admin.quotations.index', [
            'pageTitle' => 'Quotations Directory | Hari Om Computer ERP',
            'currentPage' => 'quotations',
            'quotations' => $quotations,
            'metrics' => $metrics,
            'currentStatus' => $status,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new commercial quotation.
     */
    public function create(): View
    {
        $products = Product::where('status', 'active')
            ->select('id', 'name', 'sku', 'selling_price', 'gst_rate', 'stock')
            ->orderBy('name')
            ->get();

        $nextQuotationNo = Quotation::generateNextQuotationNumber();

        return view('admin.quotations.create', [
            'pageTitle' => 'Create New Quotation | Hari Om Computer ERP',
            'currentPage' => 'quotation-create',
            'products' => $products,
            'nextQuotationNo' => $nextQuotationNo,
        ]);
    }

    /**
     * Store a newly created quotation in database storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'quotation_no' => 'required|string|unique:quotations,quotation_no',
            'customer_name' => 'required|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_gstin' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string',
            'quotation_date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:quotation_date',
            'status' => 'required|string|in:Draft,Sent,Pending,Approved,Converted,Rejected,Expired',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|integer|exists:products,id',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.sku' => 'nullable|string|max:100',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_rate' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
            'items.*.gst_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $discountTotal = 0;
            $taxableAmount = 0;
            $gstTotal = 0;
            $calculatedItems = [];

            foreach ($validated['items'] as $item) {
                $qty = intval($item['quantity']);
                $rate = floatval($item['unit_rate']);
                $discount = floatval($item['discount'] ?? 0);
                $gstRate = floatval($item['gst_rate'] ?? 18);

                $lineSubtotal = $rate * $qty;
                $lineTaxable = max(0, $lineSubtotal - $discount);
                $lineGst = $lineTaxable * ($gstRate / 100);
                $lineTotal = round($lineTaxable + $lineGst, 2);

                $subtotal += $lineSubtotal;
                $discountTotal += $discount;
                $taxableAmount += $lineTaxable;
                $gstTotal += $lineGst;

                $calculatedItems[] = [
                    'product_id' => $item['product_id'] ?? null,
                    'item_name' => $item['item_name'],
                    'sku' => $item['sku'] ?? null,
                    'quantity' => $qty,
                    'unit_rate' => $rate,
                    'discount' => $discount,
                    'gst_rate' => $gstRate,
                    'gst_amount' => round($lineGst, 2),
                    'total_amount' => $lineTotal,
                ];
            }

            $rawGrandTotal = $taxableAmount + $gstTotal;
            $grandTotal = round($rawGrandTotal);
            $roundOff = round($grandTotal - $rawGrandTotal, 2);

            $quotation = Quotation::create([
                'quotation_no' => $validated['quotation_no'],
                'customer_name' => $validated['customer_name'],
                'customer_company' => $validated['customer_company'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'],
                'customer_gstin' => $validated['customer_gstin'],
                'customer_address' => $validated['customer_address'],
                'quotation_date' => $validated['quotation_date'],
                'valid_until' => $validated['valid_until'],
                'status' => $validated['status'],
                'subtotal' => round($subtotal, 2),
                'discount_total' => round($discountTotal, 2),
                'taxable_amount' => round($taxableAmount, 2),
                'gst_total' => round($gstTotal, 2),
                'round_off' => $roundOff,
                'grand_total' => $grandTotal,
                'notes' => $validated['notes'],
                'created_by' => Auth::id(),
            ]);

            foreach ($calculatedItems as $cItem) {
                $quotation->items()->create($cItem);
            }

            DB::commit();

            return redirect()->route('admin.quotations.view', ['id' => $quotation->id])
                ->with('success', "Quotation {$quotation->quotation_no} generated successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to save quotation: ' . $e->getMessage());
        }
    }

    /**
     * Display a single detailed quotation.
     */
    public function show(Request $request, $id = null): View
    {
        $targetId = $id ?: $request->query('id');
        $quotation = null;

        if ($targetId) {
            $quotation = is_numeric($targetId) 
                ? Quotation::with(['items.product', 'creator'])->find($targetId)
                : Quotation::with(['items.product', 'creator'])->where('quotation_no', $targetId)->first();
        }

        if (!$quotation) {
            $quotation = Quotation::with(['items.product', 'creator'])->latest()->firstOrFail();
        }

        return view('admin.quotations.view', [
            'pageTitle' => "Quotation {$quotation->quotation_no} | Hari Om Computer ERP",
            'currentPage' => 'quotations',
            'quotation' => $quotation,
        ]);
    }

    /**
     * Printable A4 letterhead quotation preview.
     */
    public function print(Request $request, $id = null): View
    {
        $targetId = $id ?: $request->query('id');
        $quotation = null;

        if ($targetId) {
            $quotation = is_numeric($targetId) 
                ? Quotation::with(['items.product', 'creator'])->find($targetId)
                : Quotation::with(['items.product', 'creator'])->where('quotation_no', $targetId)->first();
        }

        if (!$quotation) {
            $quotation = Quotation::with(['items.product', 'creator'])->latest()->firstOrFail();
        }

        return view('admin.quotations.print', [
            'pageTitle' => "Print {$quotation->quotation_no} | Hari Om Computer",
            'currentPage' => 'quotations',
            'quotation' => $quotation,
        ]);
    }

    /**
     * Update quotation status.
     */
    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $quotation = is_numeric($id) 
            ? Quotation::with('items')->findOrFail($id)
            : Quotation::with('items')->where('quotation_no', $id)->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|string|in:Draft,Sent,Pending,Approved,Converted,Rejected,Expired',
        ]);

        $oldStatus = $quotation->status;
        $newStatus = $validated['status'];

        // If converted into a sale, deduct inventory stock and record movements
        if ($newStatus === 'Converted' && $oldStatus !== 'Converted') {
            foreach ($quotation->items as $qItem) {
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
                            'reference_no' => $quotation->quotation_no,
                            'notes' => "Stock deduction for converted quotation {$quotation->quotation_no}",
                            'user_id' => Auth::id(),
                        ]);
                    }
                }
            }
        }

        $quotation->update(['status' => $newStatus]);

        return back()->with('success', "Quotation {$quotation->quotation_no} marked as {$newStatus}.");
    }

    /**
     * Remove the specified quotation.
     */
    public function destroy($id): RedirectResponse
    {
        $quotation = is_numeric($id) 
            ? Quotation::findOrFail($id)
            : Quotation::where('quotation_no', $id)->firstOrFail();

        $quoteNo = $quotation->quotation_no;
        $quotation->delete();

        return redirect()->route('admin.quotations')
            ->with('success', "Quotation {$quoteNo} has been deleted.");
    }
}

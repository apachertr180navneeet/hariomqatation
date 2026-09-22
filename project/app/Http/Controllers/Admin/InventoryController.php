<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InventoryController extends Controller
{
    /**
     * Physical stock ledger and reorder alerts.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'brand']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhereHas('brand', function ($b) use ($search) {
                      $b->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Category filter
        if ($request->filled('category_id') && $request->input('category_id') !== 'ALL') {
            $query->where('category_id', $request->input('category_id'));
        }

        // Stock status filter
        if ($request->input('status') === 'low_stock') {
            $query->lowStock();
        } elseif ($request->input('status') === 'out_of_stock') {
            $query->where('stock', '<=', 0);
        }

        $products = $query->orderBy('stock', 'asc')->paginate(20)->withQueryString();

        // Calculate KPI summary stats
        $totalSkus = Product::count();
        $totalUnits = (int) Product::sum('stock');
        $totalInventoryValue = (float) Product::select(DB::raw('SUM(stock * purchase_price) as total_value'))->value('total_value');
        $lowStockCount = Product::lowStock()->count();
        $outOfStockCount = Product::where('stock', '<=', 0)->count();

        $categories = Category::active()->orderBy('name')->get();
        $allProducts = Product::select('id', 'name', 'sku', 'stock', 'purchase_price')->orderBy('name')->get();

        return view('admin.inventory', [
            'pageTitle' => 'Inventory Stock Management | Hari Om Computer ERP',
            'currentPage' => 'inventory',
            'products' => $products,
            'allProducts' => $allProducts,
            'categories' => $categories,
            'totalSkus' => $totalSkus,
            'totalUnits' => $totalUnits,
            'totalInventoryValue' => $totalInventoryValue,
            'lowStockCount' => $lowStockCount,
            'outOfStockCount' => $outOfStockCount,
            'currentSearch' => $request->input('search', ''),
            'currentCategory' => $request->input('category_id', 'ALL'),
            'currentStatus' => $request->input('status', 'ALL'),
        ]);
    }

    /**
     * Record stock inward (e.g. from vendor purchase receipt).
     */
    public function inward(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'nullable|numeric|min:0',
            'reference_no' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $newStock = $product->stock + $validated['quantity'];

        DB::transaction(function () use ($product, $validated, $newStock) {
            $product->update([
                'stock' => $newStock,
                'status' => $newStock > 0 ? 'active' : $product->status,
                'purchase_price' => !empty($validated['unit_cost']) && $validated['unit_cost'] > 0 
                    ? $validated['unit_cost'] 
                    : $product->purchase_price,
            ]);

            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'inward',
                'quantity' => $validated['quantity'],
                'balance_after' => $newStock,
                'unit_cost' => $validated['unit_cost'] ?? $product->purchase_price,
                'reference_no' => $validated['reference_no'] ?? ('INW-' . date('YmdHis')),
                'notes' => $validated['notes'] ?? 'Vendor inward stock receipt.',
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->back()
            ->with('success', "Stock Inward of +{$validated['quantity']} units for '{$product->name}' recorded. New balance: {$newStock} units.");
    }

    /**
     * Record manual stock adjustment (audits / discrepancies).
     */
    public function adjust(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'new_stock' => 'required|integer|min:0',
            'reason' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $diff = $validated['new_stock'] - $product->stock;

        if ($diff === 0) {
            return redirect()->back()->with('info', 'Stock was unchanged as the new count equals the current balance.');
        }

        DB::transaction(function () use ($product, $validated, $diff) {
            $product->update([
                'stock' => $validated['new_stock'],
                'status' => $validated['new_stock'] > 0 ? 'active' : 'out_of_stock',
            ]);

            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'adjustment',
                'quantity' => $diff,
                'balance_after' => $validated['new_stock'],
                'unit_cost' => $product->purchase_price,
                'reference_no' => 'ADJ-' . date('YmdHi'),
                'notes' => 'Stock physical count adjustment: ' . $validated['reason'],
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->back()
            ->with('success', "Stock for '{$product->name}' adjusted to {$validated['new_stock']} units (Diff: " . ($diff > 0 ? "+{$diff}" : $diff) . ").");
    }

    /**
     * Show movement history ledger for a product.
     */
    public function movements($productId): View
    {
        $product = Product::with(['category', 'brand'])->findOrFail($productId);
        $movements = StockMovement::with('user')
            ->where('product_id', $productId)
            ->latest()
            ->paginate(25);

        return view('admin.inventory-movements', [
            'pageTitle' => "Stock Ledger: {$product->name} | Hari Om Computer ERP",
            'currentPage' => 'inventory',
            'product' => $product,
            'movements' => $movements,
        ]);
    }
}

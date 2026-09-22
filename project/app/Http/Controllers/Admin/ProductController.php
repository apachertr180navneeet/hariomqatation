<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display product catalog directory.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'subcategory', 'brand']);

        // Search by keyword
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('specs', 'like', "%{$search}%")
                  ->orWhereHas('brand', function ($b) use ($search) {
                      $b->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->filled('category_id') && $request->input('category_id') !== 'ALL') {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filter by brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        // Filter by stock status
        if ($request->input('filter') === 'low_stock') {
            $query->lowStock();
        } elseif ($request->input('filter') === 'out_of_stock') {
            $query->where('stock', '<=', 0);
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('admin.products.index', [
            'pageTitle' => 'Products Catalog | Hari Om Computer ERP',
            'currentPage' => 'products',
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'currentSearch' => $request->input('search', ''),
            'currentCategory' => $request->input('category_id', 'ALL'),
        ]);
    }

    /**
     * Show form to create new product.
     */
    public function create(): View
    {
        $categories = Category::active()->with('subcategories')->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('admin.products.add', [
            'pageTitle' => 'Add New Product SKU | Hari Om Computer ERP',
            'currentPage' => 'product-add',
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created product in database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'barcode' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'model' => 'nullable|string|max:255',
            'specs' => 'required|string',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',
            'gst_rate' => 'required|numeric|in:0,12,18,28',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'warranty' => 'required|string|max:255',
            'status' => 'nullable|in:active,inactive,out_of_stock',
            'socket' => 'nullable|string|max:100',
            'ram_type' => 'nullable|string|max:50',
            'wattage_req' => 'nullable|integer',
            'wattage' => 'nullable|integer',
            'pcb_type' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
        ]);

        if (empty($validated['sku'])) {
            $validated['sku'] = 'HOC-' . strtoupper(Str::random(6));
        }

        $validated['status'] = $validated['status'] ?? ($validated['stock'] > 0 ? 'active' : 'out_of_stock');
        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::lower(Str::random(4));
        $validated['is_featured'] = $request->has('is_featured');

        $product = Product::create($validated);

        // Record initial stock movement
        if ($product->stock > 0) {
            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'initial',
                'quantity' => $product->stock,
                'balance_after' => $product->stock,
                'unit_cost' => $product->purchase_price,
                'reference_no' => 'INIT-' . $product->sku,
                'notes' => 'Initial opening inventory recorded.',
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.products.view', ['id' => $product->id])
            ->with('success', "Product '{$product->name}' SKU: {$product->sku} added successfully!");
    }

    /**
     * Show detailed product view.
     */
    public function show(Request $request): View
    {
        $id = $request->query('id');
        $product = null;

        if (is_numeric($id)) {
            $product = Product::with(['category', 'subcategory', 'brand', 'stockMovements.user'])->find($id);
        }

        if (!$product) {
            $product = Product::with(['category', 'subcategory', 'brand', 'stockMovements.user'])
                ->where('sku', $id)
                ->first();
        }

        if (!$product) {
            $product = Product::with(['category', 'subcategory', 'brand', 'stockMovements.user'])->firstOrFail();
        }

        return view('admin.products.view', [
            'pageTitle' => "{$product->name} | Hari Om Computer ERP",
            'currentPage' => 'products',
            'product' => $product,
        ]);
    }

    /**
     * Show form to edit an existing product.
     */
    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::active()->with('subcategories')->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('admin.products.edit', [
            'pageTitle' => "Edit Product: {$product->name} | Hari Om Computer ERP",
            'currentPage' => 'products',
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'barcode' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'model' => 'nullable|string|max:255',
            'specs' => 'required|string',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',
            'gst_rate' => 'required|numeric|in:0,12,18,28',
            'min_stock' => 'required|integer|min:0',
            'warranty' => 'required|string|max:255',
            'status' => 'nullable|in:active,inactive,out_of_stock',
            'socket' => 'nullable|string|max:100',
            'ram_type' => 'nullable|string|max:50',
            'wattage_req' => 'nullable|integer',
            'wattage' => 'nullable|integer',
            'pcb_type' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['status'] = $validated['status'] ?? $product->status ?? 'active';
        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.view', ['id' => $product->id])
            ->with('success', "Product '{$product->name}' updated successfully!");
    }

    /**
     * Delete product.
     */
    public function destroy($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products')
            ->with('success', "Product '{$name}' deleted successfully.");
    }

    /**
     * Dedicated Laptops catalog.
     */
    public function laptops(): View
    {
        $laptops = Product::laptops()
            ->with(['brand', 'subcategory'])
            ->latest()
            ->get();

        return view('admin.laptops', [
            'pageTitle' => 'Laptops Catalog | Hari Om Computer ERP',
            'currentPage' => 'laptops',
            'laptops' => $laptops,
        ]);
    }

    /**
     * Dedicated Desktop PCs & Workstations catalog.
     */
    public function computers(): View
    {
        $computers = Product::computers()
            ->with(['brand', 'subcategory'])
            ->latest()
            ->get();

        return view('admin.computers', [
            'pageTitle' => 'Desktop PCs & Workstations | Hari Om Computer ERP',
            'currentPage' => 'computers',
            'computers' => $computers,
        ]);
    }

    /**
     * Fetch subcategories by category for dynamic dropdown AJAX.
     */
    public function getSubcategoriesByCategory($categoryId): JsonResponse
    {
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($subcategories);
    }
}

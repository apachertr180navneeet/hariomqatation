<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Store Homepage with interactive rig configurator hero, budget wizard, and featured hardware.
     */
    public function index(): View
    {
        $featuredProducts = Product::active()
            ->where('is_featured', true)
            ->with(['category', 'brand', 'subcategory'])
            ->take(8)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::active()->with(['category', 'brand', 'subcategory'])->take(8)->get();
        }

        $allProducts = Product::active()->with(['category', 'brand', 'subcategory'])->get();
        $heroGamingRig = Product::active()->computers()->with(['category', 'brand', 'subcategory'])->first();
        $popularBuilds = Product::active()->computers()->with(['category', 'brand', 'subcategory'])->take(4)->get();
        $componentProducts = Product::active()
            ->whereDoesntHave('category', function ($q) {
                $q->whereIn('slug', ['laptops', 'desktop-computers', 'computers']);
            })
            ->with(['category', 'brand', 'subcategory'])
            ->take(12)
            ->get();

        $categories = Category::active()->withCount('products')->get();
        $brands = Brand::where('status', 'active')->take(12)->get();

        $productsJson = $allProducts->map(function ($p) {
            return [
                'id' => (string) $p->id,
                'name' => $p->name,
                'sku' => $p->sku,
                'brand' => $p->brand->name ?? 'Branded',
                'category' => $p->category->name ?? 'Components',
                'subcategory' => $p->subcategory->name ?? '',
                'sellingPrice' => (float) $p->selling_price,
                'mrp' => (float) $p->mrp,
                'stock' => (int) $p->stock,
                'specs' => $p->specs,
                'status' => 'Active',
                'rating' => (float) ($p->rating ?: 4.8),
            ];
        });

        return view('shop.index', [
            'pageTitle' => 'Hari Om Computer | Western Rajasthan\'s Premier Computer & Technology Store (Jodhpur)',
            'currentPage' => 'home',
            'showPromoStrip' => true,
            'featuredProducts' => $featuredProducts,
            'allProducts' => $allProducts,
            'allProductsJson' => $productsJson->toJson(),
            'heroGamingRig' => $heroGamingRig,
            'popularBuilds' => $popularBuilds,
            'componentProducts' => $componentProducts,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Desktop PCs & Workstations showroom.
     */
    public function computers(): View
    {
        $computers = Product::active()
            ->computers()
            ->with(['category', 'brand', 'subcategory'])
            ->get();

        return view('shop.computers', [
            'pageTitle' => 'Desktop PCs, Gaming Rigs & Workstations | Hari Om Computer (Jodhpur)',
            'currentPage' => 'computers',
            'computers' => $computers,
        ]);
    }

    /**
     * Laptops showroom.
     */
    public function laptops(): View
    {
        $laptops = Product::active()
            ->laptops()
            ->with(['category', 'brand', 'subcategory'])
            ->get();

        return view('shop.laptops', [
            'pageTitle' => 'Brand New Laptops (Dell, HP, Lenovo, ASUS) | Hari Om Computer (Jodhpur)',
            'currentPage' => 'laptops',
            'laptops' => $laptops,
        ]);
    }

    /**
     * Components catalog.
     */
    public function components(): View
    {
        $components = Product::active()
            ->whereDoesntHave('category', function ($q) {
                $q->whereIn('slug', ['laptops', 'desktop-computers', 'computers']);
            })
            ->with(['category', 'brand', 'subcategory'])
            ->get();

        $subcategories = \App\Models\Subcategory::whereHas('category', function ($q) {
            $q->whereNotIn('slug', ['laptops', 'desktop-computers', 'computers']);
        })->where('status', 'active')->distinct()->get();

        $componentsJson = $components->map(function ($p) {
            return [
                'id' => (string) $p->id,
                'name' => $p->name,
                'brand' => $p->brand->name ?? 'Branded',
                'category' => 'Components',
                'subcategory' => $p->subcategory->name ?? 'General',
                'sellingPrice' => (float) $p->selling_price,
                'mrp' => (float) $p->mrp,
                'stock' => (int) $p->stock,
                'specs' => $p->specs,
                'status' => 'Active',
            ];
        });

        return view('shop.components', [
            'pageTitle' => 'Genuine Computer Components (CPU, GPU, RAM, SSD) | Hari Om Computer (Jodhpur)',
            'currentPage' => 'components',
            'components' => $components,
            'subcategories' => $subcategories,
            'componentsJson' => $componentsJson,
        ]);
    }

    /**
     * Full hardware catalog with faceted filtering.
     */
    public function products(Request $request): View
    {
        $query = Product::active()->with(['category', 'brand', 'subcategory']);

        if ($request->filled('cat') && $request->query('cat') !== 'ALL') {
            $cat = $request->query('cat');
            $query->whereHas('category', function ($q) use ($cat) {
                $q->where('name', $cat)->orWhere('slug', $cat);
            });
        }

        if ($request->filled('brand') && $request->query('brand') !== 'ALL') {
            $brand = $request->query('brand');
            $query->whereHas('brand', function ($q) use ($brand) {
                $q->where('name', $brand)->orWhere('slug', $brand);
            });
        }

        if ($request->filled('search')) {
            $kw = $request->query('search');
            $query->where(function ($q) use ($kw) {
                $q->where('name', 'like', "%{$kw}%")
                  ->orWhere('sku', 'like', "%{$kw}%")
                  ->orWhere('specs', 'like', "%{$kw}%")
                  ->orWhere('model', 'like', "%{$kw}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->get();
        $brands = Brand::where('status', 'active')->get();

        $allActiveProducts = Product::active()->with(['category', 'brand', 'subcategory'])->get();
        $productsJson = $allActiveProducts->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'sku' => $p->sku,
                'brand' => $p->brand->name ?? 'Branded',
                'category' => $p->category->name ?? 'Components',
                'subcategory' => $p->subcategory->name ?? '',
                'sellingPrice' => (float) $p->selling_price,
                'mrp' => (float) $p->mrp,
                'stock' => (int) $p->stock,
                'specs' => $p->specs,
                'warranty' => $p->warranty ?: '1 Year Warranty',
                'rating' => (float) ($p->rating ?: 4.8),
            ];
        });

        return view('shop.products', [
            'pageTitle' => 'Products & Hardware Catalog | Hari Om Computer (Jodhpur)',
            'currentPage' => 'products',
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'productsJson' => $productsJson,
        ]);
    }

    /**
     * Detailed product specifications and enquiry view.
     */
    public function productDetails(Request $request, $id = null): View
    {
        $targetId = $id ?: $request->query('id');
        $product = null;

        if ($targetId) {
            $product = is_numeric($targetId)
                ? Product::with(['category', 'brand', 'subcategory'])->find($targetId)
                : Product::with(['category', 'brand', 'subcategory'])->where('sku', $targetId)->orWhere('slug', $targetId)->first();
        }

        if (!$product) {
            $product = Product::active()->with(['category', 'brand', 'subcategory'])->first();
        }

        if (!$product) {
            $product = Product::with(['category', 'brand', 'subcategory'])->latest()->firstOrFail();
        }

        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.product-details', [
            'pageTitle' => ($product->name ?? 'Product Details') . ' | Hari Om Computer',
            'currentPage' => 'products',
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * Interactive Custom PC Builder Tool.
     */
    public function pcBuilder(): View
    {
        $allProducts = Product::active()->with(['category', 'brand', 'subcategory'])->get();

        $productsJson = $allProducts->map(function ($p) {
            $catSlug = strtolower($p->category->slug ?? '');
            $subSlug = strtolower($p->subcategory->slug ?? '');
            $nameLower = strtolower($p->name);

            // Derive pcbType if not explicitly stored
            $pcbType = $p->pcb_type;
            if (!$pcbType) {
                if (str_contains($catSlug, 'cpu') || str_contains($catSlug, 'processor') || str_contains($subSlug, 'processor') || str_contains($nameLower, 'intel core') || str_contains($nameLower, 'ryzen')) {
                    $pcbType = 'cpu';
                } elseif (str_contains($catSlug, 'motherboard') || str_contains($subSlug, 'motherboard') || str_contains($nameLower, 'motherboard') || str_contains($nameLower, 'b760') || str_contains($nameLower, 'b650') || str_contains($nameLower, 'h610')) {
                    $pcbType = 'motherboard';
                } elseif (str_contains($catSlug, 'ram') || str_contains($catSlug, 'memory') || str_contains($subSlug, 'ram') || str_contains($nameLower, 'ddr4') || str_contains($nameLower, 'ddr5')) {
                    $pcbType = 'ram';
                } elseif (str_contains($catSlug, 'storage') || str_contains($catSlug, 'ssd') || str_contains($subSlug, 'ssd') || str_contains($subSlug, 'hard-disk') || str_contains($nameLower, 'nvme') || str_contains($nameLower, 'ssd')) {
                    $pcbType = 'storage';
                } elseif (str_contains($catSlug, 'graphic') || str_contains($catSlug, 'gpu') || str_contains($subSlug, 'gpu') || str_contains($nameLower, 'geforce') || str_contains($nameLower, 'rtx') || str_contains($nameLower, 'gtx')) {
                    $pcbType = 'gpu';
                } elseif (str_contains($catSlug, 'case') || str_contains($catSlug, 'cabinet') || str_contains($subSlug, 'cabinet') || str_contains($nameLower, 'cabinet')) {
                    $pcbType = 'cabinet';
                } elseif (str_contains($catSlug, 'psu') || str_contains($catSlug, 'power') || str_contains($subSlug, 'power') || str_contains($nameLower, 'power supply') || str_contains($nameLower, '650w') || str_contains($nameLower, '750w')) {
                    $pcbType = 'psu';
                } elseif (str_contains($catSlug, 'cooler') || str_contains($subSlug, 'cooler') || str_contains($nameLower, 'cooler') || str_contains($nameLower, 'liquid cooling')) {
                    $pcbType = 'cooler';
                } elseif (str_contains($catSlug, 'monitor') || str_contains($subSlug, 'monitor') || str_contains($nameLower, 'monitor') || str_contains($nameLower, 'display')) {
                    $pcbType = 'monitor';
                } else {
                    $pcbType = 'peripherals';
                }
            }

            return [
                'id' => (string) $p->id,
                'name' => $p->name,
                'brand' => $p->brand->name ?? 'Branded',
                'category' => $p->category->name ?? 'Components',
                'sellingPrice' => (float) $p->selling_price,
                'mrp' => (float) $p->mrp,
                'stock' => (int) $p->stock,
                'specs' => $p->specs,
                'status' => 'Active',
                'pcbType' => $pcbType,
                'socket' => $p->socket ?: ($p->model ?: 'LGA1700'),
                'ramType' => $p->ram_type ?: 'DDR4',
                'wattageReq' => (int) ($p->wattage_req ?: 65),
                'wattage' => (int) ($p->wattage ?: 0),
            ];
        });

        return view('shop.pc-builder', [
            'pageTitle' => 'Custom PC Builder Tool & Instant Compatibility Check | Hari Om Computer',
            'currentPage' => 'pc-builder',
            'products' => $allProducts,
            'productsJson' => $productsJson,
        ]);
    }

    /**
     * Enquiry Cart & Quotation Request checkout.
     */
    public function enquiry(): View
    {
        return view('shop.enquiry', [
            'pageTitle' => 'Enquiry Cart & GST Quotation Request | Hari Om Computer',
            'currentPage' => 'enquiry',
        ]);
    }

    /**
     * Handle Customer Storefront Quotation Request Submission directly to MySQL.
     */
    public function submitEnquiry(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:150',
            'company' => 'nullable|string|max:150',
            'gstin' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
            'items' => 'nullable',
        ]);

        // Decode items
        $items = [];
        if (!empty($validated['items'])) {
            $items = is_array($validated['items']) ? $validated['items'] : json_decode($validated['items'], true);
            if (!is_array($items)) {
                $items = [];
            }
        }

        // Sequential Quotation Number HOC/QTN/YYYY/NNNN
        $year = date('Y');
        $lastQuote = Quotation::where('quotation_no', 'like', "HOC/QTN/{$year}/%")
            ->orderBy('id', 'desc')
            ->first();

        $nextNum = 1;
        if ($lastQuote) {
            $parts = explode('/', $lastQuote->quotation_no);
            $lastSeq = (int) end($parts);
            $nextNum = $lastSeq + 1;
        }
        $quotationNo = sprintf('HOC/QTN/%s/%04d', $year, $nextNum);

        $subtotal = 0;
        $gstTotal = 0;
        $grandTotal = 0;

        foreach ($items as $item) {
            $qty = max(1, (int) ($item['qty'] ?? 1));
            $price = (float) ($item['price'] ?? 0);
            $lineTotal = $price * $qty;
            $lineTaxable = round($lineTotal / 1.18, 2);
            $lineGst = $lineTotal - $lineTaxable;

            $subtotal += $lineTaxable;
            $gstTotal += $lineGst;
            $grandTotal += $lineTotal;
        }

        $quotation = Quotation::create([
            'quotation_no' => $quotationNo,
            'customer_name' => $validated['name'],
            'customer_company' => $validated['company'] ?? null,
            'customer_phone' => $validated['mobile'],
            'customer_email' => $validated['email'] ?? null,
            'customer_gstin' => $validated['gstin'] ?? null,
            'customer_address' => $validated['address'] ?? null,
            'quotation_date' => now(),
            'valid_until' => now()->addDays(15),
            'status' => 'Pending',
            'subtotal' => $subtotal,
            'discount_total' => 0,
            'taxable_amount' => $subtotal,
            'gst_total' => $gstTotal,
            'round_off' => 0,
            'grand_total' => $grandTotal,
            'notes' => $validated['notes'] ?? 'Web storefront quotation request',
            'created_by' => null,
        ]);

        foreach ($items as $item) {
            $qty = max(1, (int) ($item['qty'] ?? 1));
            $price = (float) ($item['price'] ?? 0);
            $lineTotal = $price * $qty;
            $rate = round($price / 1.18, 2);
            $taxable = round($lineTotal / 1.18, 2);
            $gst = $lineTotal - $taxable;

            $quotation->items()->create([
                'product_id' => is_numeric($item['id'] ?? null) ? $item['id'] : null,
                'item_name' => $item['name'] ?? 'Custom Hardware Item',
                'item_sku' => $item['sku'] ?? 'PROD',
                'quantity' => $qty,
                'unit_price' => $rate,
                'gst_rate' => 18.00,
                'taxable_amount' => $taxable,
                'gst_amount' => $gst,
                'total_amount' => $lineTotal,
            ]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'quotation_no' => $quotationNo,
                'redirect' => route('quotation.success', ['quote' => $quotationNo]),
            ]);
        }

        return redirect()->route('quotation.success', ['quote' => $quotationNo])
            ->with('success', "Quotation {$quotationNo} successfully created!");
    }

    /**
     * Quotation Submission Success page.
     */
    public function quotationSuccess(Request $request, $id = null): View
    {
        $target = $id ?: $request->query('quote') ?: $request->query('id');
        $quotation = null;

        if ($target) {
            $quotation = is_numeric($target)
                ? Quotation::with('items')->find($target)
                : Quotation::with('items')->where('quotation_no', $target)->first();
        }

        if (!$quotation) {
            $quotation = Quotation::with('items')->latest()->first();
        }

        return view('shop.quotation-success', [
            'pageTitle' => 'Quotation Request Received | Hari Om Computer',
            'currentPage' => 'enquiry',
            'quotation' => $quotation,
            'quotationNo' => $quotation?->quotation_no ?? $target ?? 'HOC/QTN/PENDING',
        ]);
    }

    /**
     * About Hari Om Computer showroom & story.
     */
    public function about(): View
    {
        return view('shop.about', [
            'pageTitle' => 'About Us - 15+ Years Computer Excellence | Hari Om Computer (Jodhpur)',
            'currentPage' => 'about',
        ]);
    }

    /**
     * Contact details, map location, and direct messaging form.
     */
    public function contact(): View
    {
        return view('shop.contact', [
            'pageTitle' => 'Contact & Showroom Location | Hari Om Computer (Jodhpur)',
            'currentPage' => 'contact',
        ]);
    }
}

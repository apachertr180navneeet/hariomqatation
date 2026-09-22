<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandController extends Controller
{
    /**
     * Display partner brands directory.
     */
    public function index(): View
    {
        $brands = Brand::withCount('products')
            ->orderBy('name')
            ->get();

        return view('admin.brands', [
            'pageTitle' => 'Brands Management | Hari Om Computer ERP',
            'currentPage' => 'brands',
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created brand.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'logo' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Brand::create($validated);

        return redirect()->route('admin.brands')
            ->with('success', "Brand '{$validated['name']}' created successfully.");
    }

    /**
     * Update an existing brand.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'logo' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $brand->update($validated);

        return redirect()->route('admin.brands')
            ->with('success', "Brand '{$brand->name}' updated successfully.");
    }

    /**
     * Delete brand entry.
     */
    public function destroy($id): RedirectResponse
    {
        $brand = Brand::withCount('products')->findOrFail($id);

        if ($brand->products_count > 0) {
            return redirect()->route('admin.brands')
                ->with('error', "Cannot delete brand '{$brand->name}' because {$brand->products_count} product(s) are linked to it.");
        }

        $name = $brand->name;
        $brand->delete();

        return redirect()->route('admin.brands')
            ->with('success', "Brand '{$name}' deleted successfully.");
    }
}

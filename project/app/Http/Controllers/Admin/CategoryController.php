<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display categories and subcategories taxonomy.
     */
    public function index(): View
    {
        $categories = Category::with(['subcategories'])
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('admin.categories', [
            'pageTitle' => 'Categories & Taxonomy | Hari Om Computer ERP',
            'currentPage' => 'categories',
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $validated['status'] = $validated['status'] ?? 'active';
        $validated['slug'] = Str::slug($validated['name']);
        if (empty($validated['icon'])) {
            $validated['icon'] = 'bi-tags';
        }

        $category = Category::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'category' => $category,
                'message' => "Category '{$category->name}' created successfully.",
            ]);
        }

        return redirect()->route('admin.categories')
            ->with('success', "Category '{$validated['name']}' created successfully.");
    }

    /**
     * Update an existing category.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $validated['status'] = $validated['status'] ?? $category->status ?? 'active';
        $validated['slug'] = Str::slug($validated['name']);
        if (empty($validated['icon'])) {
            $validated['icon'] = $category->icon ?: 'bi-tags';
        }

        $category->update($validated);

        return redirect()->route('admin.categories')
            ->with('success', "Category '{$category->name}' updated successfully.");
    }

    /**
     * Remove the specified category.
     */
    public function destroy($id): RedirectResponse
    {
        $category = Category::withCount('products')->findOrFail($id);

        if ($category->products_count > 0) {
            return redirect()->route('admin.categories')
                ->with('error', "Cannot delete category '{$category->name}' because it contains {$category->products_count} active product(s).");
        }

        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', "Category '{$name}' deleted successfully.");
    }

    /**
     * Store a subcategory under a category.
     */
    public function storeSubcategory(Request $request, $categoryId): RedirectResponse
    {
        $category = Category::findOrFail($categoryId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug = Str::slug($validated['name']);

        $category->subcategories()->updateOrCreate(
            ['slug' => $slug],
            [
                'name' => $validated['name'],
                'status' => 'active',
            ]
        );

        return redirect()->route('admin.categories')
            ->with('success', "Subcategory '{$validated['name']}' added to {$category->name}.");
    }

    /**
     * Delete a subcategory.
     */
    public function destroySubcategory($id): RedirectResponse
    {
        $subcategory = Subcategory::withCount('products')->findOrFail($id);

        if ($subcategory->products_count > 0) {
            return redirect()->route('admin.categories')
                ->with('error', "Cannot delete subcategory '{$subcategory->name}' because it is assigned to {$subcategory->products_count} product(s).");
        }

        $name = $subcategory->name;
        $subcategory->delete();

        return redirect()->route('admin.categories')
            ->with('success', "Subcategory '{$name}' removed.");
    }
}

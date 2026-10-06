<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of suppliers and distributors.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'ALL');
        $search = $request->query('search');

        $query = Supplier::withCount('purchases')->latest();

        if ($status && $status !== 'ALL') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('company', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('gstin', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $suppliers = $query->paginate(15)->withQueryString();

        // Financial & CRM KPI Metrics
        $totalSuppliers = Supplier::count();
        $activeSuppliers = Supplier::where('status', 'active')->count();
        $totalInwardValue = Purchase::where('status', 'Received')->sum('grand_total');
        $totalOutstandingPayables = Purchase::where('status', 'Received')->sum('balance_amount');

        return view('admin.suppliers', [
            'pageTitle' => 'Suppliers & National Distributors | Hari Om Computer ERP',
            'currentPage' => 'suppliers',
            'suppliers' => $suppliers,
            'totalSuppliers' => $totalSuppliers,
            'activeSuppliers' => $activeSuppliers,
            'totalInwardValue' => $totalInwardValue,
            'totalOutstandingPayables' => $totalOutstandingPayables,
            'currentStatus' => $status,
            'search' => $search,
        ]);
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'email' => 'nullable|email|max:255',
            'gstin' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'payment_terms' => 'required|string|max:50',
            'bank_details' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Supplier::create($validated);

        return redirect()->route('admin.suppliers')
            ->with('success', "Distributor \"{$validated['company']}\" registered successfully!");
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'email' => 'nullable|email|max:255',
            'gstin' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'payment_terms' => 'required|string|max:50',
            'bank_details' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.suppliers')
            ->with('success', "Distributor \"{$supplier->company}\" details updated successfully!");
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->purchases()->count() > 0) {
            return redirect()->route('admin.suppliers')
                ->with('error', "Cannot delete distributor \"{$supplier->company}\" because inward purchase bills are linked to this account.");
        }

        $company = $supplier->company;
        $supplier->delete();

        return redirect()->route('admin.suppliers')
            ->with('success', "Distributor \"{$company}\" deleted successfully.");
    }
}

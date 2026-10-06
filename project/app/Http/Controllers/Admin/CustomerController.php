<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of customer CRM accounts with live accounting statistics.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $type = $request->query('type', 'ALL');

        $query = Customer::withCount('invoices')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('gstin', 'like', "%{$search}%");
            });
        }

        if ($type && $type !== 'ALL') {
            $query->where('type', $type);
        }

        $customers = $query->paginate(15)->withQueryString();

        // Calculate KPI Metrics
        $totalCustomers = Customer::count();
        $corporateCount = Customer::whereNotNull('gstin')->where('gstin', '!=', '')->count();
        $totalSalesIssued = Invoice::where('status', 'Issued')->sum('grand_total');
        $totalPendingBalance = Invoice::where('status', 'Issued')->sum('balance_amount');

        return view('admin.customers', [
            'pageTitle' => 'Customer CRM | Hari Om Computer ERP',
            'currentPage' => 'customers',
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'corporateCount' => $corporateCount,
            'totalSalesIssued' => $totalSalesIssued,
            'totalPendingBalance' => $totalPendingBalance,
            'search' => $search,
            'currentType' => $type,
        ]);
    }

    /**
     * Store a newly created customer in database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'company' => 'nullable|string|max:150',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'email' => 'nullable|email|max:150',
            'gstin' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'type' => 'required|string|in:Retail,Corporate,Institutional,Reseller',
            'status' => 'required|string|in:active,inactive',
            'notes' => 'nullable|string|max:500',
        ]);

        $customer = Customer::create($validated);

        return redirect()->route('admin.customers')
            ->with('success', "Customer {$customer->name} registered successfully!");
    }

    /**
     * Update the specified customer in database.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'company' => 'nullable|string|max:150',
            'phone' => "required|string|max:20|unique:customers,phone,{$customer->id}",
            'email' => 'nullable|email|max:150',
            'gstin' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'type' => 'required|string|in:Retail,Corporate,Institutional,Reseller',
            'status' => 'required|string|in:active,inactive',
            'notes' => 'nullable|string|max:500',
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers')
            ->with('success', "Customer {$customer->name} updated successfully!");
    }

    /**
     * Remove the specified customer account.
     */
    public function destroy($id): RedirectResponse
    {
        $customer = Customer::withCount('invoices')->findOrFail($id);

        if ($customer->invoices_count > 0) {
            return back()->with('error', "Cannot delete customer {$customer->name} because they have {$customer->invoices_count} linked tax invoices.");
        }

        $name = $customer->name;
        $customer->delete();

        return redirect()->route('admin.customers')
            ->with('success', "Customer account {$name} has been removed.");
    }
}

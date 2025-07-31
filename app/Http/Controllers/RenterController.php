<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class RenterController extends Controller
{
    // ✅ Show all approved customers
    public function activeCustomers()
    {
        $pendingCount = Customer::where('status', 'pending')->count();
        $activeCount = Customer::where('status', 'approved')->count();
        $suspendedCount = Customer::where('status', 'rejected')->count();

        $activeCustomers = Customer::where('status', 'approved')->get();

        return view('admin.active-customers', [
            'activeCustomers' => $activeCustomers,
            'pendingCount' => $pendingCount,
            'activeCount' => $activeCount,
            'suspendedCount' => $suspendedCount,
            'totalCustomers' => $pendingCount + $activeCount + $suspendedCount,
        ]);
    }

    // ✅ Show all pending customers
    public function pendingCustomers()
    {
        $pendingCustomers = Customer::where('status', 'pending')->get();

       return view('admin.pencustomer', [
    'pendingCustomers' => Customer::where('status', 'pending')->get(),
    'pendingCount' => Customer::where('status', 'pending')->count(),
    'activeCount' => Customer::where('status', 'approved')->count(),
    'suspendedCount' => Customer::where('status', 'rejected')->count(),
]);

    }

    // ✅ Approve a customer
    public function accept($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = 'approved';
        $customer->save();

        return redirect()->back()->with('success', 'Customer approved successfully.');
    }

    // ✅ Delete a customer
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer deleted.');
    }
}

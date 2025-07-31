<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Store new customer as 'pending'
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:20',
            'preferred_location' => 'nullable|string|max:255',
            'password' => 'required|string|confirmed|min:6',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'pending'; // Default status

        Customer::create($data);

        return redirect()->back()->with('success', 'Your details have been submitted. Please wait for admin approval');
    }

    

    // Accept a pending customer (set status to active)
    public function acceptPendingCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = 'approved';
        $customer->save();

        return redirect()->route('pending.customers')->with('success', 'Customer accepted successfully.');
    }

     public function showActive()
    {
        $activeCustomers = Customer::where('status', 'approved')->get();
        return view('admin.actcustomer', compact('activeCustomers'));
    }

    // Delete a pending customer
    public function deletePendingCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->profile_photo) {
            Storage::disk('public')->delete($customer->profile_photo);
        }

        $customer->delete();

        return redirect()->route('pending.customers')->with('success', 'Customer deleted successfully.');
    }

   
public function pendingCustomers()
{
    $pendingCustomers = \App\Models\Customer::where('status', 'pending')->get();
    return view('admin.pencustomer', compact('pendingCustomers'));
}



public function activeCustomers()
{
    $activeCustomers = Customer::where('status', 'approved')->get();
    return view('admin.actcustomer', compact('activeCustomers'));
}


}

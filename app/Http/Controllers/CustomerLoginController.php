<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('customerlogin'); // Correct: only return the view here
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Find customer by email first
        $customer = Customer::where('email', $credentials['email'])->first();

        if (!$customer) {
            // No customer with this email
            return back()->with('error', 'Invalid email or password');
        }

        // Check if customer is approved
        if ($customer->status !== 'approved') {
            return back()->with('error', 'Your account is not approved yet.');
        }

        // Now attempt login using the 'customer' guard and credentials
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('/listings');
        }

        // If password incorrect
        return back()->with('error', 'Invalid email or password');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HouseOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HouseownerloginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('ownerslogin');  // Blade file: resources/views/ownerslogin.blade.php
    }

    // Handle login submission
    public function login(Request $request)
    {
        // Validate email and password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find house owner by email
        $houseOwner = HouseOwner::where('email', $credentials['email'])->first();

        // Check if user exists and password is correct
        if (!$houseOwner || !Hash::check($credentials['password'], $houseOwner->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Check if admin has approved the account
        if ($houseOwner->status !== 'approved') {
            return back()->with('error', 'Your account has not been approved by the admin yet.');
        }

        // Log the house owner in
        Auth::login($houseOwner); // or use Auth::guard('houseowner') if using custom guard

        // Redirect to the house listing form
        return redirect('/owner');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show the registration form
    public function showForm()
    {
        return view('sign'); // resources/views/sign.blade.php
    }

    // Handle the registration process
    public function register(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // password_confirmation field required
        ]);

        // Create a new user record in the database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before saving
        ]);

        // Redirect back to the sign-up form with a success message
        return back()->with('status', 'Account created successfully! You can now log in.');
    }
}

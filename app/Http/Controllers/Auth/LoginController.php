<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Hardcoded credentials
        $correctEmail = 'vishalni@gmail.com';
        $correctPassword = 'visha22';

        // Check if credentials match the hardcoded admin credentials
        if ($request->email === $correctEmail && $request->password === $correctPassword) {
            // Here, optionally, you can create a "fake" admin user instance or just redirect.
            // For now, just redirect to the admin dashboard route.
            return redirect()->route('admin.dashboard');
        }

        // Otherwise, try normal database user login

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email.'])->withInput();
        }

        // Check if the password matches
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
        }

        // Log the user in
        Auth::login($user);

        // Redirect to the intended page after successful login
        return redirect()->intended('admin/dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    private $adminEmail = 'vishavishalini@gmail.com';
    private $adminPassword = 'visha@22';

   public function showLoginForm()
{
    return view('admin.dashboardlogin');  // <-- updated to match your blade path
}
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (
            $request->email === $this->adminEmail &&
            $request->password === $this->adminPassword
        ) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid email or password');
    }

   public function dashboard()
{
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login.form');
    }


    return view('admin.dashboard', compact('totalProperties'));
}


    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login.form');
    }

    // In AdminAuthController.php

}

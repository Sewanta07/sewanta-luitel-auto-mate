<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Try to authenticate with Admin guard
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->status === 'active') {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.admin'));
            } else {
                Auth::guard('admin')->logout();
                throw ValidationException::withMessages([
                    'email' => ['Your admin account is not active. Please contact support.'],
                ]);
            }
        }

        // Try to authenticate with Staff guard
        if (Auth::guard('staff')->attempt($credentials, $remember)) {
            $staffMember = Auth::guard('staff')->user();
            if ($staffMember->status === 'active') {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.staff'));
            } else {
                Auth::guard('staff')->logout();
                throw ValidationException::withMessages([
                    'email' => ['Your account is pending approval. Please wait for admin approval.'],
                ]);
            }
        }

        // Try to authenticate with Customer guard
        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $customer = Auth::guard('customer')->user();
            if ($customer->status === 'active') {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard.customer'));
            } else {
                Auth::guard('customer')->logout();
                throw ValidationException::withMessages([
                    'email' => ['Your account is not active. Please contact support.'],
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Handle a logout request.
     */
    public function logout(Request $request)
    {
        // Logout from all guards
        Auth::guard('admin')->logout();
        Auth::guard('staff')->logout();
        Auth::guard('customer')->logout();
        Auth::logout(); // Default guard

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}


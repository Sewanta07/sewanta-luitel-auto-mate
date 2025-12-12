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

        // Try to authenticate with Admin first
        $admin = \App\Models\Admin::where('email', $credentials['email'])->first();
        if ($admin && \Illuminate\Support\Facades\Hash::check($credentials['password'], $admin->password)) {
            if ($admin->status === 'active') {
                Auth::login($admin, $remember);
                // Regenerate session AFTER login to prevent session fixation attacks
                $request->session()->regenerate();
                // Clear any intended URL
                $request->session()->forget('url.intended');
                // Store user type in session for fallback detection
                $request->session()->put('auth_user_type', 'admin');
                
                return redirect()->route('dashboard.admin');
            } else {
                throw ValidationException::withMessages([
                    'email' => ['Your admin account is not active. Please contact support.'],
                ]);
            }
        }

        // Try to authenticate with StaffMember
        $staffMember = \App\Models\StaffMember::where('email', $credentials['email'])->first();
        if ($staffMember && \Illuminate\Support\Facades\Hash::check($credentials['password'], $staffMember->password)) {
            if ($staffMember->status === 'active') {
                Auth::login($staffMember, $remember);
                // Regenerate session AFTER login to prevent session fixation attacks
                $request->session()->regenerate();
                // Clear any intended URL
                $request->session()->forget('url.intended');
                // Store user type in session for fallback detection
                $request->session()->put('auth_user_type', 'staff');
                
                return redirect()->route('dashboard.staff');
            } else {
                throw ValidationException::withMessages([
                    'email' => ['Your account is pending approval. Please wait for admin approval.'],
                ]);
            }
        }

        // Try to authenticate with CustomerUser
        $customer = \App\Models\CustomerUser::where('email', $credentials['email'])->first();
        if ($customer && \Illuminate\Support\Facades\Hash::check($credentials['password'], $customer->password)) {
            if ($customer->status === 'active') {
                Auth::login($customer, $remember);
                // Regenerate session AFTER login to prevent session fixation attacks
                $request->session()->regenerate();
                // Clear any intended URL
                $request->session()->forget('url.intended');
                // Store user type in session for fallback detection
                $request->session()->put('auth_user_type', 'customer');
                
                return redirect()->route('dashboard.customer');
            } else {
                throw ValidationException::withMessages([
                    'email' => ['Your account is not active. Please contact support.'],
                ]);
            }
        }

        // Try default User model (for backward compatibility) - ONLY if not found in other tables
        if (!\App\Models\Admin::where('email', $credentials['email'])->exists() &&
            !\App\Models\StaffMember::where('email', $credentials['email'])->exists() &&
            !\App\Models\CustomerUser::where('email', $credentials['email'])->exists()) {
            
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                $user = Auth::user();
                
                // Clear any intended URL
                $request->session()->forget('url.intended');
                
                // Redirect based on role - use direct redirect, not intended
                if (isset($user->role)) {
                    switch ($user->role) {
                        case 'admin':
                            return redirect()->route('dashboard.admin');
                        case 'staff':
                            return redirect()->route('dashboard.staff');
                        case 'customer':
                        default:
                            return redirect()->route('dashboard.customer');
                    }
                }
                
                // Default fallback
                return redirect()->route('dashboard.customer');
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
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}


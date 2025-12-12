<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerUser;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $role = $request->role;
        
        // Validation rules
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'current_address' => 'required|string|max:500',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'required|in:customer,staff',
        ];

        // Add unique email validation based on role
        if ($role === 'staff') {
            $validationRules['email'] .= '|unique:staff_members,email';
        } else {
            $validationRules['email'] .= '|unique:customers,email';
        }

        $request->validate($validationRules);

        $status = $role === 'staff' ? 'pending' : 'active';

        // Create user based on role
        if ($role === 'staff') {
            $user = StaffMember::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'current_address' => $request->current_address,
                'password' => Hash::make($request->password),
                'status' => $status,
            ]);
            
            // Staff members are NOT logged in - they must wait for admin approval
            return redirect()->route('register.success')->with([
                'message' => 'Your staff registration has been submitted successfully! Your account is pending admin approval. You will be able to login once an admin approves your application.',
                'role' => 'staff'
            ]);
        } else {
            $user = CustomerUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'current_address' => $request->current_address,
                'password' => Hash::make($request->password),
                'status' => $status,
            ]);
            
            // Customers are logged in immediately
            Auth::login($user);
            return redirect()->route('dashboard.customer')->with('success', 'Registration successful! Welcome to AutoMate.');
        }
    }
}


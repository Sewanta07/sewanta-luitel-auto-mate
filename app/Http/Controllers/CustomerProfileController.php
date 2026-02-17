<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class CustomerProfileController extends Controller
{
    private function customerUser()
    {
        return Auth::guard('customer')->user() ?? Auth::user();
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('multi.auth');
    }

    /**
     * Show the customer profile page.
     */
    public function index()
    {
        $user = $this->customerUser();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Ensure user is a customer
        if (!($user instanceof \App\Models\CustomerUser)) {
            $role = $this->getUserRole($user);
            return redirect()->route('dashboard.' . $role);
        }

        $vehicles = Vehicle::where('customer_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('customer.profile', ['user' => $user, 'vehicles' => $vehicles]);
    }

    /**
     * Update the customer profile.
     */
    public function updateProfile(Request $request)
    {
        $user = $this->customerUser();
        
        // Ensure user is a customer
        if (!($user instanceof \App\Models\CustomerUser)) {
            return redirect()->route('dashboard.' . $this->getUserRole($user));
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:customers,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'current_address' => 'nullable|string|max:500',
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $validated['profile_image'] = $imagePath;
        } else {
            // Keep existing image if no new one uploaded
            unset($validated['profile_image']);
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the customer password.
     */
    public function updatePassword(Request $request)
    {
        $user = $this->customerUser();
        
        // Ensure user is a customer
        if (!($user instanceof \App\Models\CustomerUser)) {
            return redirect()->route('dashboard.' . $this->getUserRole($user));
        }

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Get the role of the authenticated user.
     */
    private function getUserRole($user): string
    {
        if (!$user) {
            return 'customer';
        }

        if ($user instanceof \App\Models\Admin) {
            return 'admin';
        }
        if ($user instanceof \App\Models\StaffMember) {
            return 'staff';
        }
        if ($user instanceof \App\Models\CustomerUser) {
            return 'customer';
        }
        return 'customer';
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class StaffProfileController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the staff profile page.
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Ensure user is staff
        if (!($user instanceof \App\Models\StaffMember)) {
            $role = $this->getUserRole($user);
            return redirect()->route('dashboard.' . $role);
        }

        return view('staff.profile', ['user' => $user]);
    }

    /**
     * Update the staff profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        // Ensure user is staff
        if (!($user instanceof \App\Models\StaffMember)) {
            return redirect()->route('dashboard.' . $this->getUserRole($user));
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff_members,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'current_address' => 'nullable|string|max:500',
            'position' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
     * Update the staff password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        // Ensure user is staff
        if (!($user instanceof \App\Models\StaffMember)) {
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


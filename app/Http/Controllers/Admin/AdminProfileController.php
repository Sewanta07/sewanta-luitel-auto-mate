<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    use AuthorizesAdmin;

    /**
     * Show the admin profile page.
     */
    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);
        
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Update the admin profile.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);
        
        $admin = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'current_address' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $validated['profile_image'] = $imagePath;
        } else {
            // Keep existing image if no new one uploaded
            unset($validated['profile_image']);
        }

        $admin->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);
        
        $admin = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}


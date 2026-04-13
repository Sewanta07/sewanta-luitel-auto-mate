<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    private function adminUser()
    {
        return Auth::guard('admin')->user();
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('multi.auth');
    }

    /**
     * Show the admin profile page.
     */
    public function index()
    {
        $user = $this->adminUser();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Ensure user is admin
        if (!($user instanceof \App\Models\Admin)) {
            $role = $this->getUserRole($user);
            return redirect()->route('dashboard.' . $role);
        }

        return view('admin.profile', ['user' => $user, 'admin' => $user]);
    }

    /**
     * Update the admin profile.
     */
    public function updateProfile(Request $request)
    {
        $user = $this->adminUser();
        
        // Ensure user is admin
        if (!($user instanceof \App\Models\Admin)) {
            return redirect()->route('dashboard.' . $this->getUserRole($user));
        }

        $validated = $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        $validated['profile_image'] = $imagePath;

        $user->update($validated);

        return back()->with('success', 'Profile photo updated successfully!');
    }

    /**
     * Send password reset link for the authenticated admin.
     */
    public function sendPasswordResetLink(Request $request)
    {
        $user = $this->adminUser();
        
        // Ensure user is admin
        if (!($user instanceof \App\Models\Admin)) {
            return redirect()->route('dashboard.' . $this->getUserRole($user));
        }

        try {
            $status = Password::broker('admins')->sendResetLink([
                'email' => (string) $user->email,
            ]);
        } catch (\Throwable $exception) {
            Log::error('Admin password reset link send failed', [
                'admin_id' => $user->id,
                'email' => (string) $user->email,
                'error' => $exception->getMessage(),
            ]);

            if (config('app.debug')) {
                /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
                $broker = app(PasswordBrokerManager::class)->broker('admins');
                $token = $broker->createToken($user);
                $resetUrl = route('password.reset', [
                    'token' => $token,
                    'email' => (string) $user->email,
                ]);

                return back()
                    ->with('success', 'SMTP is failing, but a temporary reset link was generated for local debugging.')
                    ->with('password_reset_url', $resetUrl);
            }

            return back()->withErrors([
                'password_reset' => 'Unable to send reset email right now. Please check MAIL settings (SMTP username/app password) and try again.',
            ]);
        }

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Password reset link sent to your admin email.');
        }

        return back()->withErrors([
            'password_reset' => __($status),
        ]);
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


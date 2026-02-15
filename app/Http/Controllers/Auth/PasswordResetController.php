<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerUser;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Show the forgot password form.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset link to the user's email.
     * Only allows customers and staff, NOT admin.
     * Searches in customers and staff_members tables.
     */
    public function sendResetLink(Request $request)
    {
        // Trim email to remove whitespace
        $email = trim($request->input('email'));
        
        // Validate email format first
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        // Check both customers and staff_members tables (case-insensitive)
        $user = CustomerUser::whereRaw('LOWER(email) = ?', [strtolower($email)])->first();
        $broker = 'customers';
        
        if (!$user) {
            $user = StaffMember::whereRaw('LOWER(email) = ?', [strtolower($email)])->first();
            $broker = 'staff_members';
        }

        // If email doesn't exist
        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with this email address. Please check and try again.',
            ])->withInput($request->only('email'));
        }

        // Send the password reset link using the correct broker
        $status = Password::broker($broker)->sendResetLink(
            ['email' => $email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors([
            'email' => __($status),
        ])->withInput($request->only('email'));
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Reset the user's password.
     * Only allows customers and staff, NOT admin.
     * Searches in customers and staff_members tables.
     */
    public function resetPassword(Request $request)
    {
        // Trim email to remove whitespace
        $email = trim($request->input('email'));
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check both customers and staff_members tables (case-insensitive)
        $user = CustomerUser::whereRaw('LOWER(email) = ?', [strtolower($email)])->first();
        $broker = 'customers';
        
        if (!$user) {
            $user = StaffMember::whereRaw('LOWER(email) = ?', [strtolower($email)])->first();
            $broker = 'staff_members';
        }

        // If email doesn't exist
        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with this email address.',
            ]);
        }

        // Reset the password using the correct broker
        $status = Password::broker($broker)->reset(
            [
                'email' => $email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'token' => $request->token
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If password was reset successfully, redirect to login
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}

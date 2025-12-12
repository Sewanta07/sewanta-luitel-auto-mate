<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SettingsController extends Controller
{
    use AuthorizesAdmin;

    /**
     * Show the settings page.
     */
    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);
        
        // Get all settings from cache or config
        $settings = [
            'general' => $this->getSettings('general'),
            'service' => $this->getSettings('service'),
            'notification' => $this->getSettings('notification'),
            'display' => $this->getSettings('display'),
            'security' => $this->getSettings('security'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function updateGeneral(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'business_address' => 'nullable|string|max:500',
            'business_hours' => 'nullable|string|max:255',
        ]);

        $this->saveSettings('general', $validated);

        return back()->with('success', 'General settings updated successfully!');
    }

    /**
     * Update service settings.
     */
    public function updateService(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'slot_duration' => 'required|integer|min:15|max:480',
            'advance_booking_days' => 'required|integer|min:1|max:90',
            'auto_approve_bookings' => 'nullable',
            'require_phone_for_booking' => 'nullable',
            'max_bookings_per_day' => 'required|integer|min:1|max:100',
        ]);

        // Convert checkbox values to boolean
        $validated['auto_approve_bookings'] = $request->has('auto_approve_bookings');
        $validated['require_phone_for_booking'] = $request->has('require_phone_for_booking');

        $this->saveSettings('service', $validated);

        return back()->with('success', 'Service settings updated successfully!');
    }

    /**
     * Update notification settings.
     */
    public function updateNotification(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'email_notifications' => 'nullable',
            'sms_notifications' => 'nullable',
            'notify_on_new_booking' => 'nullable',
            'notify_on_status_change' => 'nullable',
            'notify_on_payment' => 'nullable',
            'notification_email' => 'nullable|email|max:255',
        ]);

        // Convert checkbox values to boolean
        $validated['email_notifications'] = $request->has('email_notifications');
        $validated['sms_notifications'] = $request->has('sms_notifications');
        $validated['notify_on_new_booking'] = $request->has('notify_on_new_booking');
        $validated['notify_on_status_change'] = $request->has('notify_on_status_change');
        $validated['notify_on_payment'] = $request->has('notify_on_payment');

        $this->saveSettings('notification', $validated);

        return back()->with('success', 'Notification settings updated successfully!');
    }

    /**
     * Update display settings.
     */
    public function updateDisplay(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'timezone' => 'required|string|max:100',
            'date_format' => 'required|string|max:50',
            'time_format' => 'required|in:12,24',
            'currency' => 'required|string|max:10',
            'currency_symbol' => 'required|string|max:10',
        ]);

        $this->saveSettings('display', $validated);

        return back()->with('success', 'Display settings updated successfully!');
    }

    /**
     * Update security settings.
     */
    public function updateSecurity(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'session_timeout' => 'required|integer|min:5|max:480',
            'password_min_length' => 'required|integer|min:6|max:32',
            'require_strong_password' => 'nullable',
            'two_factor_auth' => 'nullable',
            'login_attempts_limit' => 'required|integer|min:3|max:10',
        ]);

        // Convert checkbox values to boolean
        $validated['require_strong_password'] = $request->has('require_strong_password');
        $validated['two_factor_auth'] = $request->has('two_factor_auth');

        $this->saveSettings('security', $validated);

        return back()->with('success', 'Security settings updated successfully!');
    }

    /**
     * Get settings for a specific category.
     */
    private function getSettings(string $category): array
    {
        $defaults = $this->getDefaultSettings();
        
        return Cache::remember("settings.{$category}", 3600, function () use ($category, $defaults) {
            $settings = [];
            $settingsFile = storage_path("app/settings_{$category}.json");
            
            if (file_exists($settingsFile)) {
                $savedSettings = json_decode(file_get_contents($settingsFile), true) ?? [];
                foreach ($defaults[$category] as $key => $defaultValue) {
                    $settings[$key] = $savedSettings[$key] ?? $defaultValue;
                }
            } else {
                $settings = $defaults[$category];
            }
            
            return $settings;
        });
    }

    /**
     * Save settings for a specific category.
     */
    private function saveSettings(string $category, array $settings): void
    {
        $settingsFile = storage_path("app/settings_{$category}.json");
        
        // Merge with existing settings
        $existingSettings = [];
        if (file_exists($settingsFile)) {
            $existingSettings = json_decode(file_get_contents($settingsFile), true) ?? [];
        }
        
        $mergedSettings = array_merge($existingSettings, $settings);
        
        // Save to file
        file_put_contents($settingsFile, json_encode($mergedSettings, JSON_PRETTY_PRINT));
        
        // Update cache
        Cache::put("settings.{$category}", $mergedSettings, 86400);
    }

    /**
     * Get default settings.
     */
    private function getDefaultSettings(): array
    {
        return [
            'general' => [
                'site_name' => 'AutoMate',
                'site_description' => 'Smart Vehicle Service Management',
                'contact_email' => 'support@automate.com',
                'contact_phone' => '',
                'business_address' => '',
                'business_hours' => 'Mon-Sat: 8:00 AM - 6:00 PM',
            ],
            'service' => [
                'slot_duration' => 60,
                'advance_booking_days' => 30,
                'auto_approve_bookings' => false,
                'require_phone_for_booking' => true,
                'max_bookings_per_day' => 20,
            ],
            'notification' => [
                'email_notifications' => true,
                'sms_notifications' => false,
                'notify_on_new_booking' => true,
                'notify_on_status_change' => true,
                'notify_on_payment' => true,
                'notification_email' => '',
            ],
            'display' => [
                'timezone' => 'UTC',
                'date_format' => 'Y-m-d',
                'time_format' => '24',
                'currency' => 'USD',
                'currency_symbol' => '$',
            ],
            'security' => [
                'session_timeout' => 120,
                'password_min_length' => 8,
                'require_strong_password' => true,
                'two_factor_auth' => false,
                'login_attempts_limit' => 5,
            ],
        ];
    }
}


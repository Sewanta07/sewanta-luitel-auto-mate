@extends('layouts.app')

@section('title', 'Settings')

@section('content')
@php($user = auth()->user())
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <span class="user-info">Welcome, {{ $user?->name }}</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-section">
                <div class="sidebar-title">Navigation</div>
                <a href="{{ route('dashboard.admin') }}" class="sidebar-link">Overview</a>
                <a href="{{ route('admin.profile') }}" class="sidebar-link">Profile</a>
                <a href="{{ route('admin.users') }}" class="sidebar-link">Manage Users</a>
                <a href="{{ route('admin.staff-applications.index') }}" class="sidebar-link">Staff Applications</a>
                <a href="{{ route('admin.vehicles') }}" class="sidebar-link">Vehicles</a>
                <a href="{{ route('admin.analytics') }}" class="sidebar-link">Analytics</a>
                <a href="{{ route('admin.settings') }}" class="sidebar-link active">Settings</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-title">Shortcuts</div>
                <a href="{{ route('logout') }}" class="sidebar-link"
                   onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                    Logout
                </a>
                <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="container">
                <div class="admin-topbar">
                    <div>
                        <div class="admin-breadcrumb">Admin / Settings</div>
                        <h2>System Settings</h2>
                        <p>Configure system preferences and operational parameters</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Settings Tabs -->
                <div class="settings-tabs">
                    <button class="tab-button active" onclick="showTab('general')">General</button>
                    <button class="tab-button" onclick="showTab('service')">Service</button>
                    <button class="tab-button" onclick="showTab('notification')">Notifications</button>
                    <button class="tab-button" onclick="showTab('display')">Display</button>
                    <button class="tab-button" onclick="showTab('security')">Security</button>
                </div>

                <!-- General Settings -->
                <div id="general-tab" class="tab-content active">
                    <div class="dashboard-section">
                        <h3>General Settings</h3>
                        <p class="section-description">Configure basic business information and contact details</p>
                        
                        <form method="POST" action="{{ route('admin.settings.general') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="site_name">Site Name <span class="required">*</span></label>
                                <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['general']['site_name']) }}" required class="form-control">
                                <small class="text-muted">The name displayed throughout the application</small>
                            </div>

                            <div class="form-group">
                                <label for="site_description">Site Description</label>
                                <textarea id="site_description" name="site_description" rows="2" class="form-control">{{ old('site_description', $settings['general']['site_description']) }}</textarea>
                                <small class="text-muted">Brief description of your business</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_email">Contact Email <span class="required">*</span></label>
                                    <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['general']['contact_email']) }}" required class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="contact_phone">Contact Phone</label>
                                    <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['general']['contact_phone']) }}" class="form-control" placeholder="+1234567890">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="business_address">Business Address</label>
                                <textarea id="business_address" name="business_address" rows="2" class="form-control">{{ old('business_address', $settings['general']['business_address']) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="business_hours">Business Hours</label>
                                <input type="text" id="business_hours" name="business_hours" value="{{ old('business_hours', $settings['general']['business_hours']) }}" class="form-control" placeholder="Mon-Sat: 8:00 AM - 6:00 PM">
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save General Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Service Settings -->
                <div id="service-tab" class="tab-content">
                    <div class="dashboard-section">
                        <h3>Service Settings</h3>
                        <p class="section-description">Configure booking and service management preferences</p>
                        
                        <form method="POST" action="{{ route('admin.settings.service') }}">
                            @csrf
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="slot_duration">Service Slot Duration (minutes) <span class="required">*</span></label>
                                    <input type="number" id="slot_duration" name="slot_duration" value="{{ old('slot_duration', $settings['service']['slot_duration']) }}" required min="15" max="480" step="15" class="form-control">
                                    <small class="text-muted">Default duration for each service slot</small>
                                </div>

                                <div class="form-group">
                                    <label for="advance_booking_days">Advance Booking Days <span class="required">*</span></label>
                                    <input type="number" id="advance_booking_days" name="advance_booking_days" value="{{ old('advance_booking_days', $settings['service']['advance_booking_days']) }}" required min="1" max="90" class="form-control">
                                    <small class="text-muted">How many days in advance customers can book</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_bookings_per_day">Maximum Bookings Per Day <span class="required">*</span></label>
                                <input type="number" id="max_bookings_per_day" name="max_bookings_per_day" value="{{ old('max_bookings_per_day', $settings['service']['max_bookings_per_day']) }}" required min="1" max="100" class="form-control">
                                <small class="text-muted">Limit the number of bookings accepted per day</small>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="auto_approve_bookings" value="1" {{ old('auto_approve_bookings', $settings['service']['auto_approve_bookings']) ? 'checked' : '' }}>
                                    <span>Auto-approve bookings</span>
                                </label>
                                <small class="text-muted">Automatically approve new bookings without manual review</small>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="require_phone_for_booking" value="1" {{ old('require_phone_for_booking', $settings['service']['require_phone_for_booking']) ? 'checked' : '' }}>
                                    <span>Require phone number for booking</span>
                                </label>
                                <small class="text-muted">Make phone number mandatory when creating a booking</small>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Service Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div id="notification-tab" class="tab-content">
                    <div class="dashboard-section">
                        <h3>Notification Settings</h3>
                        <p class="section-description">Configure email and SMS notification preferences</p>
                        
                        <form method="POST" action="{{ route('admin.settings.notification') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="notification_email">Notification Email</label>
                                <input type="email" id="notification_email" name="notification_email" value="{{ old('notification_email', $settings['notification']['notification_email']) }}" class="form-control">
                                <small class="text-muted">Email address to receive system notifications</small>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="email_notifications" value="1" {{ old('email_notifications', $settings['notification']['email_notifications']) ? 'checked' : '' }}>
                                    <span>Enable Email Notifications</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="sms_notifications" value="1" {{ old('sms_notifications', $settings['notification']['sms_notifications']) ? 'checked' : '' }}>
                                    <span>Enable SMS Notifications</span>
                                </label>
                                <small class="text-muted">Requires SMS gateway configuration</small>
                            </div>

                            <div class="notification-options">
                                <h4>Notification Events</h4>
                                
                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="notify_on_new_booking" value="1" {{ old('notify_on_new_booking', $settings['notification']['notify_on_new_booking']) ? 'checked' : '' }}>
                                        <span>Notify on new booking</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="notify_on_status_change" value="1" {{ old('notify_on_status_change', $settings['notification']['notify_on_status_change']) ? 'checked' : '' }}>
                                        <span>Notify on service status change</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="notify_on_payment" value="1" {{ old('notify_on_payment', $settings['notification']['notify_on_payment']) ? 'checked' : '' }}>
                                        <span>Notify on payment received</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Notification Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Display Settings -->
                <div id="display-tab" class="tab-content">
                    <div class="dashboard-section">
                        <h3>Display Settings</h3>
                        <p class="section-description">Configure date, time, and currency display formats</p>
                        
                        <form method="POST" action="{{ route('admin.settings.display') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="timezone">Timezone <span class="required">*</span></label>
                                <select id="timezone" name="timezone" required class="form-control">
                                    <option value="UTC" {{ old('timezone', $settings['display']['timezone']) == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ old('timezone', $settings['display']['timezone']) == 'America/New_York' ? 'selected' : '' }}>America/New_York (EST)</option>
                                    <option value="America/Chicago" {{ old('timezone', $settings['display']['timezone']) == 'America/Chicago' ? 'selected' : '' }}>America/Chicago (CST)</option>
                                    <option value="America/Denver" {{ old('timezone', $settings['display']['timezone']) == 'America/Denver' ? 'selected' : '' }}>America/Denver (MST)</option>
                                    <option value="America/Los_Angeles" {{ old('timezone', $settings['display']['timezone']) == 'America/Los_Angeles' ? 'selected' : '' }}>America/Los_Angeles (PST)</option>
                                    <option value="Europe/London" {{ old('timezone', $settings['display']['timezone']) == 'Europe/London' ? 'selected' : '' }}>Europe/London (GMT)</option>
                                    <option value="Asia/Dubai" {{ old('timezone', $settings['display']['timezone']) == 'Asia/Dubai' ? 'selected' : '' }}>Asia/Dubai (GST)</option>
                                    <option value="Asia/Kolkata" {{ old('timezone', $settings['display']['timezone']) == 'Asia/Kolkata' ? 'selected' : '' }}>Asia/Kolkata (IST)</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="date_format">Date Format <span class="required">*</span></label>
                                    <select id="date_format" name="date_format" required class="form-control">
                                        <option value="Y-m-d" {{ old('date_format', $settings['display']['date_format']) == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD (2024-12-23)</option>
                                        <option value="m/d/Y" {{ old('date_format', $settings['display']['date_format']) == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY (12/23/2024)</option>
                                        <option value="d/m/Y" {{ old('date_format', $settings['display']['date_format']) == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY (23/12/2024)</option>
                                        <option value="F j, Y" {{ old('date_format', $settings['display']['date_format']) == 'F j, Y' ? 'selected' : '' }}>Month Day, Year (December 23, 2024)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="time_format">Time Format <span class="required">*</span></label>
                                    <select id="time_format" name="time_format" required class="form-control">
                                        <option value="24" {{ old('time_format', $settings['display']['time_format']) == '24' ? 'selected' : '' }}>24-hour (14:30)</option>
                                        <option value="12" {{ old('time_format', $settings['display']['time_format']) == '12' ? 'selected' : '' }}>12-hour (2:30 PM)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="currency">Currency <span class="required">*</span></label>
                                    <select id="currency" name="currency" required class="form-control">
                                        <option value="USD" {{ old('currency', $settings['display']['currency']) == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                        <option value="EUR" {{ old('currency', $settings['display']['currency']) == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                        <option value="GBP" {{ old('currency', $settings['display']['currency']) == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                                        <option value="INR" {{ old('currency', $settings['display']['currency']) == 'INR' ? 'selected' : '' }}>INR - Indian Rupee</option>
                                        <option value="AED" {{ old('currency', $settings['display']['currency']) == 'AED' ? 'selected' : '' }}>AED - UAE Dirham</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="currency_symbol">Currency Symbol <span class="required">*</span></label>
                                    <input type="text" id="currency_symbol" name="currency_symbol" value="{{ old('currency_symbol', $settings['display']['currency_symbol']) }}" required maxlength="10" class="form-control" placeholder="$">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Display Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div id="security-tab" class="tab-content">
                <div class="dashboard-section">
                        <h3>Security Settings</h3>
                        <p class="section-description">Configure security and authentication preferences</p>
                        
                        <form method="POST" action="{{ route('admin.settings.security') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="session_timeout">Session Timeout (minutes) <span class="required">*</span></label>
                                <input type="number" id="session_timeout" name="session_timeout" value="{{ old('session_timeout', $settings['security']['session_timeout']) }}" required min="5" max="480" class="form-control">
                                <small class="text-muted">Automatically log out users after inactivity</small>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password_min_length">Minimum Password Length <span class="required">*</span></label>
                                    <input type="number" id="password_min_length" name="password_min_length" value="{{ old('password_min_length', $settings['security']['password_min_length']) }}" required min="6" max="32" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="login_attempts_limit">Login Attempts Limit <span class="required">*</span></label>
                                    <input type="number" id="login_attempts_limit" name="login_attempts_limit" value="{{ old('login_attempts_limit', $settings['security']['login_attempts_limit']) }}" required min="3" max="10" class="form-control">
                                    <small class="text-muted">Lock account after failed attempts</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="require_strong_password" value="1" {{ old('require_strong_password', $settings['security']['require_strong_password']) ? 'checked' : '' }}>
                                    <span>Require strong password</span>
                                </label>
                                <small class="text-muted">Enforce uppercase, lowercase, numbers, and special characters</small>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="two_factor_auth" value="1" {{ old('two_factor_auth', $settings['security']['two_factor_auth']) ? 'checked' : '' }}>
                                    <span>Enable Two-Factor Authentication</span>
                                </label>
                                <small class="text-muted">Add an extra layer of security to user accounts</small>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Security Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.settings-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 2rem;
    border-bottom: 2px solid var(--border-color);
    flex-wrap: wrap;
}

.tab-button {
    padding: 0.75rem 1.5rem;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    color: var(--text-secondary);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.95rem;
}

.tab-button:hover {
    color: var(--primary-color);
    background: rgba(37, 99, 235, 0.05);
}

.tab-button.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
    background: rgba(37, 99, 235, 0.05);
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.section-description {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.notification-options {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.notification-options h4 {
    margin-bottom: 1rem;
    color: var(--text-primary);
    font-size: 1.1rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    margin-bottom: 0.5rem;
}

.checkbox-label input[type="checkbox"] {
    width: auto;
    cursor: pointer;
}

@media (max-width: 768px) {
    .settings-tabs {
        overflow-x: auto;
    }
    
    .tab-button {
        white-space: nowrap;
        padding: 0.5rem 1rem;
    }
}
</style>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab
    document.getElementById(tabName + '-tab').classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}
</script>
@endsection

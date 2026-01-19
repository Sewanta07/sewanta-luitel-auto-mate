@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 flex-shrink-0 z-30">
        @include('components.admin-sidebar')
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-y-auto sm:ml-64 bg-gray-50 h-full w-full">
        <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">
            {{-- Page Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">System Settings</h1>
                    <p class="mt-2 text-lg text-gray-600">Configure system preferences and operational parameters.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Settings Container --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Tabs Header --}}
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px px-6 overflow-x-auto" aria-label="Tabs">
                        <button onclick="showTab('general')" id="general-tab-btn" class="tab-button active whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors border-[#ff5a1f] text-[#ff5a1f]">
                            General
                        </button>
                        <button onclick="showTab('service')" id="service-tab-btn" class="tab-button whitespace-nowrap py-4 px-6 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                            Service
                        </button>
                        <button onclick="showTab('notification')" id="notification-tab-btn" class="tab-button whitespace-nowrap py-4 px-6 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                            Notifications
                        </button>
                        <button onclick="showTab('display')" id="display-tab-btn" class="tab-button whitespace-nowrap py-4 px-6 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                            Display
                        </button>
                        <button onclick="showTab('security')" id="security-tab-btn" class="tab-button whitespace-nowrap py-4 px-6 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                            Security
                        </button>
                    </nav>
                </div>

                <div class="p-6 md:p-8">
                    <!-- General Settings -->
                    <div id="general-tab" class="tab-content block">
                        <div class="max-w-3xl">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-1">General Settings</h3>
                            <p class="text-sm text-gray-500 mb-6">Configure basic business information and contact details.</p>
                            
                            <form method="POST" action="{{ route('admin.settings.general') }}" class="space-y-6">
                                @csrf
                                <div>
                                    <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['general']['site_name']) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    <p class="mt-1 text-xs text-gray-500">The name displayed throughout the application</p>
                                </div>

                                <div>
                                    <label for="site_description" class="block text-sm font-medium text-gray-700">Site Description</label>
                                    <textarea id="site_description" name="site_description" rows="3" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">{{ old('site_description', $settings['general']['site_description']) }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500">Brief description of your business</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email <span class="text-red-500">*</span></label>
                                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['general']['contact_email']) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    </div>

                                    <div>
                                        <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                                        <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['general']['contact_phone']) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border" placeholder="+1234567890">
                                    </div>
                                </div>

                                <div>
                                    <label for="business_address" class="block text-sm font-medium text-gray-700">Business Address</label>
                                    <textarea id="business_address" name="business_address" rows="2" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">{{ old('business_address', $settings['general']['business_address']) }}</textarea>
                                </div>

                                <div>
                                    <label for="business_hours" class="block text-sm font-medium text-gray-700">Business Hours</label>
                                    <input type="text" id="business_hours" name="business_hours" value="{{ old('business_hours', $settings['general']['business_hours']) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border" placeholder="Mon-Sat: 8:00 AM - 6:00 PM">
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                        Save General Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Service Settings -->
                    <div id="service-tab" class="tab-content hidden">
                        <div class="max-w-3xl">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-1">Service Settings</h3>
                            <p class="text-sm text-gray-500 mb-6">Configure booking and service management preferences.</p>
                            
                            <form method="POST" action="{{ route('admin.settings.service') }}" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="slot_duration" class="block text-sm font-medium text-gray-700">Service Slot Duration (minutes) <span class="text-red-500">*</span></label>
                                        <input type="number" id="slot_duration" name="slot_duration" value="{{ old('slot_duration', $settings['service']['slot_duration']) }}" required min="15" max="480" step="15" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                        <p class="mt-1 text-xs text-gray-500">Default duration for each service</p>
                                    </div>

                                    <div>
                                        <label for="advance_booking_days" class="block text-sm font-medium text-gray-700">Advance Booking Days <span class="text-red-500">*</span></label>
                                        <input type="number" id="advance_booking_days" name="advance_booking_days" value="{{ old('advance_booking_days', $settings['service']['advance_booking_days']) }}" required min="1" max="90" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                        <p class="mt-1 text-xs text-gray-500">Max days in advance customers can book</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="max_bookings_per_day" class="block text-sm font-medium text-gray-700">Maximum Bookings Per Day <span class="text-red-500">*</span></label>
                                    <input type="number" id="max_bookings_per_day" name="max_bookings_per_day" value="{{ old('max_bookings_per_day', $settings['service']['max_bookings_per_day']) }}" required min="1" max="100" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    <p class="mt-1 text-xs text-gray-500">Limit the number of bookings accepted per day</p>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="auto_approve_bookings" name="auto_approve_bookings" type="checkbox" value="1" {{ old('auto_approve_bookings', $settings['service']['auto_approve_bookings']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="auto_approve_bookings" class="font-medium text-gray-700">Auto-approve bookings</label>
                                            <p class="text-gray-500">Automatically approve new bookings without manual review</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="require_phone_for_booking" name="require_phone_for_booking" type="checkbox" value="1" {{ old('require_phone_for_booking', $settings['service']['require_phone_for_booking']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="require_phone_for_booking" class="font-medium text-gray-700">Require phone number for booking</label>
                                            <p class="text-gray-500">Make phone number mandatory when creating a booking</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                        Save Service Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div id="notification-tab" class="tab-content hidden">
                        <div class="max-w-3xl">
                             <h3 class="text-lg font-medium leading-6 text-gray-900 mb-1">Notification Settings</h3>
                            <p class="text-sm text-gray-500 mb-6">Configure email and SMS notification preferences.</p>

                             <form method="POST" action="{{ route('admin.settings.notification') }}" class="space-y-6">
                                @csrf
                                
                                <div>
                                    <label for="notification_email" class="block text-sm font-medium text-gray-700">Notification Email</label>
                                    <input type="email" id="notification_email" name="notification_email" value="{{ old('notification_email', $settings['notification']['notification_email']) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    <p class="mt-1 text-xs text-gray-500">Email address to receive system notifications</p>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="email_notifications" name="email_notifications" type="checkbox" value="1" {{ old('email_notifications', $settings['notification']['email_notifications']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="email_notifications" class="font-medium text-gray-700">Enable Email Notifications</label>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="sms_notifications" name="sms_notifications" type="checkbox" value="1" {{ old('sms_notifications', $settings['notification']['sms_notifications']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="sms_notifications" class="font-medium text-gray-700">Enable SMS Notifications</label>
                                            <p class="text-gray-500">Requires SMS gateway configuration</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 pt-6 mt-6">
                                    <h4 class="text-base font-medium text-gray-900 mb-4">Notification Events</h4>
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex h-5 items-center">
                                                <input id="notify_on_new_booking" name="notify_on_new_booking" type="checkbox" value="1" {{ old('notify_on_new_booking', $settings['notification']['notify_on_new_booking']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="notify_on_new_booking" class="font-medium text-gray-700">Notify on new booking</label>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                             <div class="flex h-5 items-center">
                                                <input id="notify_on_status_change" name="notify_on_status_change" type="checkbox" value="1" {{ old('notify_on_status_change', $settings['notification']['notify_on_status_change']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="notify_on_status_change" class="font-medium text-gray-700">Notify on service status change</label>
                                            </div>
                                        </div>

                                         <div class="flex items-start">
                                             <div class="flex h-5 items-center">
                                                <input id="notify_on_payment" name="notify_on_payment" type="checkbox" value="1" {{ old('notify_on_payment', $settings['notification']['notify_on_payment']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="notify_on_payment" class="font-medium text-gray-700">Notify on payment received</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                        Save Notification Settings
                                    </button>
                                </div>
                             </form>
                        </div>
                    </div>

                    <!-- Display Settings -->
                    <div id="display-tab" class="tab-content hidden">
                         <div class="max-w-3xl">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-1">Display Settings</h3>
                            <p class="text-sm text-gray-500 mb-6">Configure date, time, and currency display formats.</p>

                             <form method="POST" action="{{ route('admin.settings.display') }}" class="space-y-6">
                                @csrf
                                
                                <div>
                                    <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone <span class="text-red-500">*</span></label>
                                    <select id="timezone" name="timezone" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
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

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="date_format" class="block text-sm font-medium text-gray-700">Date Format <span class="text-red-500">*</span></label>
                                        <select id="date_format" name="date_format" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                            <option value="Y-m-d" {{ old('date_format', $settings['display']['date_format']) == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD (2024-12-23)</option>
                                            <option value="m/d/Y" {{ old('date_format', $settings['display']['date_format']) == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY (12/23/2024)</option>
                                            <option value="d/m/Y" {{ old('date_format', $settings['display']['date_format']) == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY (23/12/2024)</option>
                                            <option value="F j, Y" {{ old('date_format', $settings['display']['date_format']) == 'F j, Y' ? 'selected' : '' }}>Month Day, Year (December 23, 2024)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="time_format" class="block text-sm font-medium text-gray-700">Time Format <span class="text-red-500">*</span></label>
                                        <select id="time_format" name="time_format" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                            <option value="24" {{ old('time_format', $settings['display']['time_format']) == '24' ? 'selected' : '' }}>24-hour (14:30)</option>
                                            <option value="12" {{ old('time_format', $settings['display']['time_format']) == '12' ? 'selected' : '' }}>12-hour (2:30 PM)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="currency" class="block text-sm font-medium text-gray-700">Currency <span class="text-red-500">*</span></label>
                                        <select id="currency" name="currency" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                            <option value="USD" {{ old('currency', $settings['display']['currency']) == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                            <option value="EUR" {{ old('currency', $settings['display']['currency']) == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                            <option value="GBP" {{ old('currency', $settings['display']['currency']) == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                                            <option value="INR" {{ old('currency', $settings['display']['currency']) == 'INR' ? 'selected' : '' }}>INR - Indian Rupee</option>
                                            <option value="AED" {{ old('currency', $settings['display']['currency']) == 'AED' ? 'selected' : '' }}>AED - UAE Dirham</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="currency_symbol" class="block text-sm font-medium text-gray-700">Currency Symbol <span class="text-red-500">*</span></label>
                                        <input type="text" id="currency_symbol" name="currency_symbol" value="{{ old('currency_symbol', $settings['display']['currency_symbol']) }}" required maxlength="10" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border" placeholder="$">
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                        Save Display Settings
                                    </button>
                                </div>
                             </form>
                         </div>
                    </div>

                    <!-- Security Settings -->
                    <div id="security-tab" class="tab-content hidden">
                         <div class="max-w-3xl">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-1">Security Settings</h3>
                            <p class="text-sm text-gray-500 mb-6">Configure security and authentication preferences.</p>

                             <form method="POST" action="{{ route('admin.settings.security') }}" class="space-y-6">
                                @csrf
                                
                                <div>
                                    <label for="session_timeout" class="block text-sm font-medium text-gray-700">Session Timeout (minutes) <span class="text-red-500">*</span></label>
                                    <input type="number" id="session_timeout" name="session_timeout" value="{{ old('session_timeout', $settings['security']['session_timeout']) }}" required min="5" max="480" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    <p class="mt-1 text-xs text-gray-500">Automatically log out users after inactivity</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                     <div>
                                        <label for="password_min_length" class="block text-sm font-medium text-gray-700">Minimum Password Length <span class="text-red-500">*</span></label>
                                        <input type="number" id="password_min_length" name="password_min_length" value="{{ old('password_min_length', $settings['security']['password_min_length']) }}" required min="6" max="32" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                     </div>

                                     <div>
                                        <label for="login_attempts_limit" class="block text-sm font-medium text-gray-700">Login Attempts Limit <span class="text-red-500">*</span></label>
                                        <input type="number" id="login_attempts_limit" name="login_attempts_limit" value="{{ old('login_attempts_limit', $settings['security']['login_attempts_limit']) }}" required min="3" max="10" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                        <p class="mt-1 text-xs text-gray-500">Lock account after failed attempts</p>
                                     </div>
                                </div>

                                <div class="space-y-4">
                                     <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="require_strong_password" name="require_strong_password" type="checkbox" value="1" {{ old('require_strong_password', $settings['security']['require_strong_password']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="require_strong_password" class="font-medium text-gray-700">Require strong password</label>
                                            <p class="text-gray-500">Enforce uppercase, lowercase, numbers, and special characters</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="two_factor_auth" name="two_factor_auth" type="checkbox" value="1" {{ old('two_factor_auth', $settings['security']['two_factor_auth']) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#ff5a1f] focus:ring-[#ff5a1f]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="two_factor_auth" class="font-medium text-gray-700">Enable Two-Factor Authentication</label>
                                            <p class="text-gray-500">Add an extra layer of security to user accounts</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                        Save Security Settings
                                    </button>
                                </div>
                             </form>
                         </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('block');
        tab.classList.add('hidden');
    });
    
    // Reset all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-[#ff5a1f]', 'text-[#ff5a1f]');
        button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    });
    
    // Show selected tab
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    document.getElementById(tabName + '-tab').classList.add('block');
    
    // Activate button
    const activeBtn = document.getElementById(tabName + '-tab-btn');
    activeBtn.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    activeBtn.classList.add('active', 'border-[#ff5a1f]', 'text-[#ff5a1f]');
}
</script>
@endsection

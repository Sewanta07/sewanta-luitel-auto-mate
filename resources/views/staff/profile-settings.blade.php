@extends('layouts.app')

@section('title', 'Profile Settings - AutoMate')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="sm:flex sm:items-center sm:justify-between mb-8 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
                <p class="mt-2 text-lg text-gray-600">Manage your account preferences and application settings.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
             {{-- Profile Settings --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 hover:shadow-md transition-shadow">
                <div class="p-6">
                     <div class="h-12 w-12 rounded-2xl bg-orange-100 flex items-center justify-center text-[#ff5a1f] mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Profile Information</h3>
                    <p class="mt-2 text-sm text-gray-500">Update your account details, profile picture, and change your password.</p>
                    <div class="mt-6">
                        <a href="{{ route('staff.profile') }}" class="inline-flex items-center text-sm font-medium text-[#ff5a1f] hover:text-[#e64b15]">
                            Manage Profile
                            <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
            </div>

             {{-- Notification Preferences --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 hover:shadow-md transition-shadow">
                <div class="p-6">
                     <div class="h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Notifications</h3>
                    <p class="mt-2 text-sm text-gray-500">Choose how you receive notifications about bookings and inventory updates.</p>
                     <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">Email Notifications</span>
                            <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] bg-[#ff5a1f]" aria-pressed="true">
                                <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </div>
                         <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">SMS Alerts</span>
                            <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] bg-gray-200" aria-pressed="false">
                                <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Display Settings --}}
             <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 hover:shadow-md transition-shadow">
                <div class="p-6">
                     <div class="h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600 mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Display</h3>
                    <p class="mt-2 text-sm text-gray-500">Customize your dashboard view and theme preferences.</p>
                     <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">Dark Mode</span>
                            <span class="text-xs text-gray-400">Coming Soon</span>
                        </div>
                         <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-700">Dense Layout</span>
                             <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] bg-gray-200" aria-pressed="false">
                                <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection


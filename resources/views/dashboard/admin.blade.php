@extends('layouts.app')

@section('title', 'Admin Dashboard - AutoMate')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 flex-shrink-0 z-30">
        @include('components.admin-sidebar')
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full"> 
        
        <main class="flex-1 max-w-7xl w-full mx-auto p-6">
            {{-- Page Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-4 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Admin Overview</h1>
                    <p class="mt-2 text-lg text-gray-600">Monitor system performance, user activity, and fleet status.</p>
                </div>
                <div class="flex space-x-2 bg-white p-1 rounded-xl shadow-sm border border-gray-200">
                    <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition">Today</button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition">Week</button>
                    <button class="px-4 py-2 text-sm font-bold text-[#ff5a1f] bg-orange-50 rounded-lg shadow-sm">Month</button>
                    <a href="{{ route('index') }}" target="_blank" class="px-3 py-2 text-gray-400 hover:text-[#ff5a1f] transition" title="View Site">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-4 gap-4 mb-5">
                {{-- Stat 1 --}}
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Services</p>
                            <p class="text-2xl font-bold text-gray-900">245</p>
                        </div>
                    </div>
                </div>

                {{-- Stat 2 --}}
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">In Progress</p>
                            <p class="text-2xl font-bold text-gray-900">42</p>
                        </div>
                    </div>
                </div>

                 {{-- Stat 3 --}}
                 <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Completed Today</p>
                            <p class="text-2xl font-bold text-gray-900">12</p>
                        </div>
                    </div>
                </div>

                {{-- Stat 4 --}}
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Pending Review</p>
                            <p class="text-2xl font-bold text-gray-900">8</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Chart / Panel --}}
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Performance Overview</h2>
                            <p class="text-sm text-gray-500">Year-over-year growth comparison</p>
                        </div>
                    </div>
                    <div class="h-64 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400 border border-dashed border-gray-200">
                        [Chart Placeholder]
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h2>
                    <div class="space-y-4">
                        <a href="{{ route('admin.users') }}" class="group flex items-center p-4 rounded-2xl bg-gray-50 hover:bg-orange-50 transition border border-gray-100 hover:border-orange-100">
                            <div class="p-2 bg-white rounded-xl shadow-sm group-hover:bg-[#ff5a1f] transition">
                                <svg class="w-5 h-5 text-gray-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <span class="ml-4 font-semibold text-gray-700 group-hover:text-[#ff5a1f] transition">Manage Users</span>
                            <svg class="ml-auto w-5 h-5 text-gray-400 group-hover:text-[#ff5a1f] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="{{ route('admin.staff-applications.index') }}" class="group flex items-center p-4 rounded-2xl bg-gray-50 hover:bg-orange-50 transition border border-gray-100 hover:border-orange-100">
                            <div class="p-2 bg-white rounded-xl shadow-sm group-hover:bg-[#ff5a1f] transition">
                                <svg class="w-5 h-5 text-gray-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <span class="ml-4 font-semibold text-gray-700 group-hover:text-[#ff5a1f] transition">Staff Applications</span>
                            <svg class="ml-auto w-5 h-5 text-gray-400 group-hover:text-[#ff5a1f] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        <a href="{{ route('admin.settings') }}" class="group flex items-center p-4 rounded-2xl bg-gray-50 hover:bg-orange-50 transition border border-gray-100 hover:border-orange-100">
                            <div class="p-2 bg-white rounded-xl shadow-sm group-hover:bg-[#ff5a1f] transition">
                                <svg class="w-5 h-5 text-gray-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="ml-4 font-semibold text-gray-700 group-hover:text-[#ff5a1f] transition">System Settings</span>
                            <svg class="ml-auto w-5 h-5 text-gray-400 group-hover:text-[#ff5a1f] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

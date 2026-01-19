@extends('layouts.app')

@section('title', 'Application Rejected')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">AutoMate</h1>
        </div>
        
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-8">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Application Rejected</h2>
                <p class="text-gray-600 mb-8">
                    We're sorry, but your application for a staff account has been rejected. If you believe this is an error, please contact the administrator.
                </p>

                <div class="border-t border-gray-100 pt-6 space-y-3">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                            Sign Out
                        </button>
                    </form>
                    <a href="{{ route('index') }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                        Return to Home
                    </a>
                </div>
            </div>
        </div>
        
        <div class="text-center">
             <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} AutoMate. All rights reserved.
            </p>
        </div>
    </div>
</div>
@endsection
@endsection


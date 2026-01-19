@extends('layouts.app')

@section('title', 'Registration Success - AutoMate')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('index') }}" class="flex justify-center mb-6">
            <span class="text-3xl font-extrabold tracking-tight text-[#ff5a1f]">AutoMate</span>
        </a>
        <div class="bg-white py-8 px-4 shadow-xl shadow-gray-100 sm:rounded-3xl sm:px-10 border border-gray-100 text-center">
            
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6 animate-bounce">
                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-2">Registration Successful!</h2>
            <p class="text-gray-500 mb-8">{{ session('message', 'Your account has been created successfully.') }}</p>


            <div class="bg-blue-50 rounded-xl p-4 mb-8 text-left border border-blue-100">
                @if(session('role') === 'staff')
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-blue-800">Pending Approval</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>Since you registered as a staff member:</p>
                                <ul class="list-disc pl-5 mt-1 space-y-1">
                                    <li>Your application is pending admin review.</li>
                                    <li>You will be notified once approved.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-blue-800">You're all set!</h3>
                            <p class="mt-1 text-sm text-blue-700">
                                You can now access your dashboard and start booking services.
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <a href="{{ route('login') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition transform hover:-translate-y-0.5 shadow-lg shadow-orange-100">
                    Sign In Now
                </a>
                <a href="{{ route('index') }}" class="block text-sm font-medium text-gray-500 hover:text-gray-900">
                    Back to Home
                </a>
            </div>
            
        </div>
    </div>
</div>
@endsection

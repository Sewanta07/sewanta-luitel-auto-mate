@extends('layouts.app')

@section('title', 'My Profile - AutoMate')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
            <p class="mt-2 text-lg text-gray-600">Manage your profile information and credentials.</p>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Profile Card & Credentials -->
            <div class="space-y-6">
                 <!-- Account Info Card -->
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="inline-block relative">
                            <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden mx-auto mb-4 bg-gray-100 flex items-center justify-center">
                                @if($staff->profile_image)
                                    <img src="{{ asset('storage/' . $staff->profile_image) }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <span class="text-4xl font-bold text-[#ff5a1f]">{{ strtoupper(substr($staff->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $staff->name }}</h2>
                        <p class="text-sm text-gray-500 mb-2">{{ $staff->email }}</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst($staff->role ?? 'Staff') }}
                        </span>
                    </div>
                    <div class="border-t border-gray-100 p-6 bg-gray-50">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Account Details</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Staff ID</span>
                                <span class="font-mono font-medium text-gray-900">#{{ $staff->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Position</span>
                                <span class="font-medium text-gray-900">{{ $staff->position ?? 'Not set' }}</span>
                            </div>
                             <div class="flex justify-between">
                                <span class="text-gray-500">Experience</span>
                                <span class="font-medium text-gray-900">{{ $staff->experience ?? 'Not set' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Joined</span>
                                <span class="font-medium text-gray-900">{{ $staff->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Edit Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Edit Profile Form -->
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Edit Profile</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('staff.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200" id="preview-container">
                                        @if($staff->profile_image)
                                            <img src="{{ asset('storage/' . $staff->profile_image) }}" id="profile-preview" class="w-full h-full object-cover">
                                        @else
                                            <svg class="h-8 w-8 text-gray-400" id="profile-placeholder" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(this)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#ff5a1f] hover:file:bg-orange-100 transition">
                                        <p class="mt-1 text-xs text-gray-500">JPG, GIF or PNG. Max size 2MB.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $staff->name) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $staff->email) }}" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $staff->phone) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>

                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                                    <input type="text" id="position" name="position" value="{{ old('position', $staff->position) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>

                                <div>
                                    <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                                    <input type="text" id="experience" name="experience" value="{{ old('experience', $staff->experience) }}" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="current_address" class="block text-sm font-medium text-gray-700">Current Address</label>
                                <textarea id="current_address" name="current_address" rows="3" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">{{ old('current_address', $staff->current_address) }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Form -->
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900">Change Password</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('staff.profile.password') }}" class="space-y-6">
                            @csrf
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <input type="password" id="current_password" name="current_password" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                    <input type="password" id="password" name="password" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex justify-center rounded-xl border border-gray-300 bg-white py-2 px-6 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function previewImage(input) {
    const container = document.getElementById('preview-container');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            container.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
        };
        
        reader.readAsDataURL(file);
    }
}
</script>
@endsection

